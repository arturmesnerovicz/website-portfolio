import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

// Card 3D instances
const cardInstances = [];
let intersectionObserver = null;
let isSectionVisible = true;

/**
 * Check if WebGL is supported by browser
 */
function isWebGLAvailable() {
    try {
        const canvas = document.createElement('canvas');
        return !!(window.WebGLRenderingContext && (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')));
    } catch (_) {
        return false;
    }
}

/**
 * Safely dispose 3D geometries and materials to avoid memory leaks
 */
function disposeHierarchy(obj) {
    if (!obj) return;
    obj.traverse((child) => {
        if (child.isMesh) {
            if (child.geometry) {
                child.geometry.dispose();
            }
            if (child.material) {
                if (Array.isArray(child.material)) {
                    child.material.forEach((m) => m.dispose());
                } else {
                    child.material.dispose();
                }
            }
        }
    });
}

/**
 * Setup a single 3D Card Viewer
 */
function createCardViewer(containerId, canvasId, loaderId, fallbackId, modelData, local3d = {}) {
    const container = document.getElementById(containerId);
    const canvas = document.getElementById(canvasId);
    const loaderEl = document.getElementById(loaderId);
    const fallbackEl = document.getElementById(fallbackId);

    if (!container || !canvas || !modelData || !modelData.modelUrl) {
        return null;
    }

    if (!isWebGLAvailable()) {
        if (fallbackEl) fallbackEl.classList.remove('hidden');
        if (canvas) canvas.classList.add('hidden');
        return null;
    }

    const width = container.clientWidth || 400;
    const height = container.clientHeight || 300;

    const scene = new THREE.Scene();

    // Camera with configurable FOV and distance
    const fov = parseFloat(local3d.fov) || 40;
    const camera = new THREE.PerspectiveCamera(fov, width / height, 0.1, 100);
    const camDist = parseFloat(local3d.camera_distance) || modelData.cameraSettings?.distance || 3.8;
    camera.position.set(0, 0, camDist);

    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true,
        powerPreference: 'high-performance',
    });

    const isMobile = window.innerWidth < 768;
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, isMobile ? 1.25 : 1.5));
    renderer.setSize(width, height);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.2;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFShadowMap;

    // Configurable Studio Lighting
    const lightMult = parseFloat(local3d.light_intensity) || 1.2;
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.95 * (lightMult / 1.2));
    scene.add(ambientLight);

    const keyLight = new THREE.DirectionalLight(0xffffff, 2.5 * (lightMult / 1.2));
    keyLight.position.set(4, 5, 4);
    keyLight.castShadow = true;
    keyLight.shadow.mapSize.width = 1024;
    keyLight.shadow.mapSize.height = 1024;
    keyLight.shadow.bias = -0.0005;
    scene.add(keyLight);

    const fillLight = new THREE.DirectionalLight(0xbad2e8, 1.1 * (lightMult / 1.2));
    fillLight.position.set(-4, 3, 2);
    scene.add(fillLight);

    const rimLight = new THREE.DirectionalLight(0xffecd2, 1.7 * (lightMult / 1.2));
    rimLight.position.set(0, -3, -3);
    scene.add(rimLight);

    const topLight = new THREE.DirectionalLight(0xffffff, 0.9 * (lightMult / 1.2));
    topLight.position.set(0, 6, 0);
    scene.add(topLight);

    // Initial rotations from local3d or default
    const initRotX = (parseFloat(local3d.rotation_x) || 0) * (Math.PI / 180) + 0.12;
    const initRotY = (parseFloat(local3d.rotation_y) || 0) * (Math.PI / 180) - 0.35;
    const autoSpeedVal = parseFloat(local3d.auto_rotate_speed);
    const autoSpeed = isNaN(autoSpeedVal) ? 0.003 : autoSpeedVal * 0.005;

    // Instance state
    const state = {
        container,
        canvas,
        loaderEl,
        fallbackEl,
        scene,
        camera,
        renderer,
        modelGroup: null,
        rafId: null,
        resizeObserver: null,
        targetRotationX: initRotX,
        targetRotationY: initRotY,
        currentRotationX: initRotX,
        currentRotationY: initRotY,
        pointerStartX: 0,
        pointerStartY: 0,
        isPointerDown: false,
        isUserInteracting: false,
        autoRotateSpeed: autoSpeed,
        interactTimeout: null,
    };

    // Load Model
    if (loaderEl) loaderEl.classList.remove('opacity-0', 'pointer-events-none');
    if (canvas) {
        canvas.classList.remove('is-loaded-model');
        canvas.classList.add('is-loading-model');
    }

    const loader = new GLTFLoader();
    loader.load(
        modelData.modelUrl,
        (gltf) => {
            const root = gltf.scene;

            // Auto-compute bounding box and center model perfectly at origin
            const box = new THREE.Box3().setFromObject(root);
            const center = box.getCenter(new THREE.Vector3());
            const size = box.getSize(new THREE.Vector3());

            // Center root on pivot
            root.position.x -= center.x;
            root.position.y -= center.y;
            root.position.z -= center.z;

            const maxDim = Math.max(size.x, size.y, size.z);
            const targetSize = 2.45; // Prominent size in container
            const baseScale = maxDim > 0 ? (targetSize / maxDim) : 1.0;
            const customScale = parseFloat(modelData.transformSettings?.scale) || 1.0;
            const localScale = parseFloat(local3d.scale) || 1.0;
            const finalScale = baseScale * customScale * localScale;

            const group = new THREE.Group();
            group.add(root);
            group.scale.set(finalScale, finalScale, finalScale);
            group.position.set(0, 0.05, 0);

            // Clone materials and enable shadow casting
            group.traverse((child) => {
                if (child.isMesh) {
                    child.castShadow = true;
                    child.receiveShadow = true;
                    if (child.material) {
                        child.material = child.material.clone();
                    }
                }
            });

            // Material overrides (Local 3D customization vs catalog parts)
            if (local3d.mat_override) {
                // Apply local material overrides
                group.traverse((child) => {
                    if (child.isMesh && child.material) {
                        if (local3d.tint_color) {
                            child.material.color = new THREE.Color(local3d.tint_color);
                        }
                        if (local3d.roughness !== null && local3d.roughness !== undefined && !isNaN(local3d.roughness)) {
                            child.material.roughness = parseFloat(local3d.roughness);
                        }
                        if (local3d.metalness !== null && local3d.metalness !== undefined && !isNaN(local3d.metalness)) {
                            child.material.metalness = parseFloat(local3d.metalness);
                        }
                        child.material.needsUpdate = true;
                    }
                });
            } else if (Array.isArray(modelData.parts)) {
                // Apply default materials and colors from global parts configuration
                modelData.parts.forEach((part) => {
                    if (!part.mesh_name || !Array.isArray(part.options)) return;
                    const opt = part.options.find(o => o.is_default) || part.options[0];
                    if (!opt) return;

                    const targetMeshName = part.mesh_name.toLowerCase();
                    group.traverse((child) => {
                        if (child.isMesh) {
                            const childName = (child.name || '').toLowerCase();
                            const matName = (child.material?.name || '').toLowerCase();
                            if (childName.includes(targetMeshName) || matName.includes(targetMeshName)) {
                                if (child.material) {
                                    if (opt.color) child.material.color = new THREE.Color(opt.color);
                                    if (opt.roughness !== undefined) child.material.roughness = parseFloat(opt.roughness);
                                    if (opt.metalness !== undefined) child.material.metalness = parseFloat(opt.metalness);
                                    child.material.needsUpdate = true;
                                }
                            }
                        }
                    });
                });
            }

            // Ground subtle pedestal reflection / shadow for grounding against dark container
            const shadowGeo = new THREE.PlaneGeometry(2.6, 2.6);
            const shadowCanvas = document.createElement('canvas');
            shadowCanvas.width = 128;
            shadowCanvas.height = 128;
            const ctx = shadowCanvas.getContext('2d');
            if (ctx) {
                const grad = ctx.createRadialGradient(64, 64, 8, 64, 64, 60);
                grad.addColorStop(0, 'rgba(255, 255, 255, 0.08)');
                grad.addColorStop(0.35, 'rgba(255, 255, 255, 0.025)');
                grad.addColorStop(1, 'rgba(0, 0, 0, 0)');
                ctx.fillStyle = grad;
                ctx.fillRect(0, 0, 128, 128);
            }
            const shadowTex = new THREE.CanvasTexture(shadowCanvas);
            const shadowMat = new THREE.MeshBasicMaterial({
                map: shadowTex,
                transparent: true,
                depthWrite: false,
                opacity: 0.9,
            });
            const shadowMesh = new THREE.Mesh(shadowGeo, shadowMat);
            shadowMesh.rotation.x = -Math.PI / 2;
            shadowMesh.position.y = -1.15;
            scene.add(shadowMesh);

            scene.add(group);
            state.modelGroup = group;

            if (loaderEl) {
                loaderEl.classList.add('opacity-0', 'pointer-events-none');
            }
            if (canvas) {
                requestAnimationFrame(() => {
                    canvas.classList.remove('is-loading-model');
                    canvas.classList.add('is-loaded-model');
                });
            }
        },
        undefined,
        (err) => {
            console.warn(`[MUP3 3D] Failed loading ${modelData.modelUrl}:`, err);
            if (loaderEl) loaderEl.classList.add('opacity-0', 'pointer-events-none');
            if (fallbackEl) fallbackEl.classList.remove('hidden');
            if (canvas) canvas.classList.add('hidden');
        }
    );

    // Setup User Interaction
    const handlePointerDown = (e) => {
        state.isPointerDown = true;
        state.isUserInteracting = true;
        state.pointerStartX = e.clientX;
        state.pointerStartY = e.clientY;
        if (state.interactTimeout) clearTimeout(state.interactTimeout);
    };

    const handlePointerMove = (e) => {
        if (!state.isPointerDown) return;
        const deltaX = e.clientX - state.pointerStartX;
        const deltaY = e.clientY - state.pointerStartY;

        state.targetRotationY += deltaX * 0.008;
        state.targetRotationX += deltaY * 0.006;

        // Clamp vertical rotation so product doesn't flip completely upside down
        state.targetRotationX = Math.max(-0.55, Math.min(0.55, state.targetRotationX));

        state.pointerStartX = e.clientX;
        state.pointerStartY = e.clientY;
    };

    const handlePointerUp = () => {
        state.isPointerDown = false;
        if (state.interactTimeout) clearTimeout(state.interactTimeout);
        state.interactTimeout = setTimeout(() => {
            if (!state.isPointerDown) {
                state.isUserInteracting = false;
            }
        }, 2000);
    };

    container.addEventListener('pointerdown', handlePointerDown);
    window.addEventListener('pointermove', handlePointerMove);
    window.addEventListener('pointerup', handlePointerUp);

    // Touch listeners
    container.addEventListener('touchstart', (e) => {
        if (e.touches.length === 1) {
            state.isPointerDown = true;
            state.isUserInteracting = true;
            state.pointerStartX = e.touches[0].clientX;
            state.pointerStartY = e.touches[0].clientY;
        }
    }, { passive: true });

    container.addEventListener('touchmove', (e) => {
        if (state.isPointerDown && e.touches.length === 1) {
            const deltaX = e.touches[0].clientX - state.pointerStartX;
            const deltaY = e.touches[0].clientY - state.pointerStartY;

            state.targetRotationY += deltaX * 0.008;
            state.targetRotationX += deltaY * 0.006;
            state.targetRotationX = Math.max(-0.55, Math.min(0.55, state.targetRotationX));

            state.pointerStartX = e.touches[0].clientX;
            state.pointerStartY = e.touches[0].clientY;
        }
    }, { passive: true });

    container.addEventListener('touchend', handlePointerUp);

    // ResizeObserver
    state.resizeObserver = new ResizeObserver(() => {
        if (!container || !renderer || !camera) return;
        const w = container.clientWidth;
        const h = container.clientHeight;
        if (w === 0 || h === 0) return;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
    });
    state.resizeObserver.observe(container);

    // Render loop
    const animate = () => {
        if (!isSectionVisible) {
            state.rafId = requestAnimationFrame(animate);
            return;
        }

        // Idle auto-rotation when user is not actively interacting
        if (!state.isUserInteracting) {
            state.targetRotationY += state.autoRotateSpeed;
        }

        // Smooth damping interpolation
        state.currentRotationX += (state.targetRotationX - state.currentRotationX) * 0.08;
        state.currentRotationY += (state.targetRotationY - state.currentRotationY) * 0.08;

        if (state.modelGroup) {
            state.modelGroup.rotation.x = state.currentRotationX;
            state.modelGroup.rotation.y = state.currentRotationY;
        }

        renderer.render(scene, camera);
        state.rafId = requestAnimationFrame(animate);
    };

    state.rafId = requestAnimationFrame(animate);

    state.destroy = () => {
        if (state.rafId) cancelAnimationFrame(state.rafId);
        if (state.interactTimeout) clearTimeout(state.interactTimeout);
        container.removeEventListener('pointerdown', handlePointerDown);
        window.removeEventListener('pointermove', handlePointerMove);
        window.removeEventListener('pointerup', handlePointerUp);
        if (state.resizeObserver) state.resizeObserver.disconnect();
        if (state.modelGroup) {
            disposeHierarchy(state.modelGroup);
            scene.remove(state.modelGroup);
        }
        renderer.dispose();
    };

    return state;
}

/**
 * Initialize MUP3 Showcase
 */
export function initMup3Showcase() {
    const rootEl = document.getElementById('mup3-presentation');
    const dataScript = document.getElementById('mup3-showcase-data');

    if (!rootEl || !dataScript) return;

    cleanupMup3Showcase();

    let data;
    try {
        data = JSON.parse(dataScript.textContent);
    } catch (e) {
        console.error('[MUP3] Failed parsing showcase JSON:', e);
        return;
    }

    if (!data) return;

    // Card 1
    if (data.card1 && data.card1.model) {
        const v1 = createCardViewer(
            'mup3-card-container-1',
            'mup3-card-canvas-1',
            'mup3-card-loader-1',
            'mup3-card-fallback-1',
            data.card1.model,
            data.card1.local3d || {}
        );
        if (v1) cardInstances.push(v1);
    }

    // Card 2
    if (data.card2 && data.card2.model) {
        const v2 = createCardViewer(
            'mup3-card-container-2',
            'mup3-card-canvas-2',
            'mup3-card-loader-2',
            'mup3-card-fallback-2',
            data.card2.model,
            data.card2.local3d || {}
        );
        if (v2) cardInstances.push(v2);
    }

    // IntersectionObserver to pause rendering when section is scrolled out
    intersectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            isSectionVisible = entry.isIntersecting;
        });
    }, { rootMargin: '100px 0px 100px 0px', threshold: 0.05 });

    intersectionObserver.observe(rootEl);
}

/**
 * Cleanup MUP3 Showcase instances, RAF, listeners & WebGL contexts
 */
export function cleanupMup3Showcase() {
    if (intersectionObserver) {
        intersectionObserver.disconnect();
        intersectionObserver = null;
    }

    while (cardInstances.length > 0) {
        const instance = cardInstances.pop();
        if (instance && typeof instance.destroy === 'function') {
            instance.destroy();
        }
    }
}

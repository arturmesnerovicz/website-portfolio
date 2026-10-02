import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { gsap } from 'gsap';

// State and instances
let scene, camera, renderer, currentModelGroup, rafId, intersectionObserver, resizeObserver;
let activeModelData = null;
let activePartId = null;
let isSectionVisible = false;
let isUserInteracting = false;
let isHovered = false;
let autoRotateSpeed = 0.003;
let targetRotationX = 0.12;
let targetRotationY = -0.35;
let currentRotationX = 0.12;
let currentRotationY = -0.35;
let targetDistance = 4.3;
let currentDistance = 4.3;
let minDistance = 2.0;
let maxDistance = 7.5;
let isZoomEnabled = true;
let pointerStartX = 0;
let pointerStartY = 0;
let isPointerDown = false;
let hasDragged = false;
let loader;
let globalConfig = null;

// Caches for memory & performance optimization
const modelCache = new Map();
const textureCache = new Map();
const activeSelections = new Map(); // modelSlug -> { partId: optionId }

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
 * Initialize 3D Product Configurator Section
 */
export function initProduct3DSection() {
    const container = document.getElementById('product-3d-container');
    const canvas = document.getElementById('product-3d-canvas');
    const dataScript = document.getElementById('product-3d-data');

    if (!container || !canvas || !dataScript) {
        return;
    }

    // Clean up any previous instance before re-initializing (e.g. on page transition)
    cleanupProduct3D();

    let config;
    try {
        config = JSON.parse(dataScript.textContent);
    } catch (e) {
        console.error('Failed to parse product-3d-data JSON:', e);
        return;
    }

    if (!config || !config.enabled || !config.models || config.models.length === 0) {
        return;
    }

    globalConfig = config;
    loader = new GLTFLoader();

    // Check WebGL support
    if (!isWebGLAvailable()) {
        showFallback(config.models[0]);
        setupDomControls(config, false);
        return;
    }

    try {
        setupThreeScene(container, canvas);
        setupLighting();
        setupInteraction(container, canvas);
        setupIntersectionObserver(container);
        setupResizeObserver(container, canvas);
        setupDomControls(config, true);

        // Load initial model
        const initialSlug = config.initialModelSlug || config.models[0].slug;
        const initialModel = config.models.find(m => m.slug === initialSlug) || config.models[0];
        loadModel(initialModel);
    } catch (err) {
        console.error('Three.js initialization failed:', err);
        showFallback(config.models[0]);
        setupDomControls(config, false);
    }
}

/**
 * Clean up Three.js scene, memory, observers and RAF
 */
export function cleanupProduct3D() {
    if (rafId) {
        cancelAnimationFrame(rafId);
        rafId = null;
    }
    if (intersectionObserver) {
        intersectionObserver.disconnect();
        intersectionObserver = null;
    }
    if (resizeObserver) {
        resizeObserver.disconnect();
        resizeObserver = null;
    }

    if (currentModelGroup && scene) {
        disposeObject(currentModelGroup);
        scene.remove(currentModelGroup);
        currentModelGroup = null;
    }

    if (renderer) {
        renderer.dispose();
        renderer = null;
    }

    scene = null;
    camera = null;
    activeModelData = null;
    activePartId = null;
    isSectionVisible = false;
    globalConfig = null;
    isZoomEnabled = true;
    currentDistance = 4.3;
    targetDistance = 4.3;
}

/**
 * Safely dispose 3D geometries and materials to avoid memory leaks
 */
function disposeObject(obj) {
    obj.traverse((child) => {
        if (child.isMesh) {
            if (child.geometry) {
                child.geometry.dispose();
            }
            if (child.material) {
                if (Array.isArray(child.material)) {
                    child.material.forEach(m => m.dispose());
                } else {
                    child.material.dispose();
                }
            }
        }
    });
}

/**
 * Setup Three.js Core Scene & Renderer
 */
function setupThreeScene(container, canvas) {
    scene = new THREE.Scene();

    const width = container.clientWidth || 800;
    const height = container.clientHeight || 600;

    camera = new THREE.PerspectiveCamera(40, width / height, 0.1, 100);
    camera.position.set(0, 0, 4.3);

    renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true,
        powerPreference: 'high-performance',
    });

    // Capped pixel ratio for maximum performance on mobile and retina displays
    const isMobile = window.innerWidth < 768;
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, isMobile ? 1.25 : 1.5));
    renderer.setSize(width, height);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.15;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFShadowMap;
}

/**
 * Setup Luxury Studio Lighting matching Apple presentation
 */
function setupLighting() {
    // 1. Soft Ambient / Hemispheric Fill
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.85);
    scene.add(ambientLight);

    // 2. Main Key Light (soft white directional)
    const keyLight = new THREE.DirectionalLight(0xffffff, 2.4);
    keyLight.position.set(4, 5, 4);
    keyLight.castShadow = true;
    keyLight.shadow.mapSize.width = 1024;
    keyLight.shadow.mapSize.height = 1024;
    keyLight.shadow.camera.near = 0.5;
    keyLight.shadow.camera.far = 15;
    keyLight.shadow.bias = -0.0005;
    scene.add(keyLight);

    // 3. Fill Light (cool studio tint)
    const fillLight = new THREE.DirectionalLight(0xb0c4de, 1.1);
    fillLight.position.set(-5, 3, 2);
    scene.add(fillLight);

    // 4. Rim / Edge Light (warm specular highlight on polished steel & edges)
    const rimLight = new THREE.DirectionalLight(0xffe6c2, 1.8);
    rimLight.position.set(0, -3, -4);
    scene.add(rimLight);

    // 5. Overhead Soft Spotlight
    const topLight = new THREE.DirectionalLight(0xffffff, 1.0);
    topLight.position.set(0, 6, 0);
    scene.add(topLight);
}

/**
 * Setup smooth pointer/touch orbit interaction
 */
function setupInteraction(container, canvas) {
    const stage = document.getElementById('product-3d-stage') || container;

    stage.addEventListener('pointerenter', () => { isHovered = true; });
    stage.addEventListener('pointerleave', () => { isHovered = false; isPointerDown = false; });

    stage.addEventListener('pointerdown', (e) => {
        isPointerDown = true;
        hasDragged = false;
        pointerStartX = e.clientX;
        pointerStartY = e.clientY;
        isUserInteracting = true;
    });

    window.addEventListener('pointerup', () => {
        isPointerDown = false;
        // Resume gentle auto-rotate after 2 seconds of inactivity
        setTimeout(() => {
            if (!isPointerDown) {
                isUserInteracting = false;
            }
        }, 2200);
    });

    stage.addEventListener('pointermove', (e) => {
        if (!isPointerDown) return;

        const deltaX = e.clientX - pointerStartX;
        const deltaY = e.clientY - pointerStartY;

        if (Math.abs(deltaX) > 3 || Math.abs(deltaY) > 3) {
            hasDragged = true;
        }

        targetRotationY += deltaX * 0.008;
        targetRotationX += deltaY * 0.006;

        // Clamp vertical pitch to avoid flipping upside down
        targetRotationX = Math.max(-0.6, Math.min(0.6, targetRotationX));

        pointerStartX = e.clientX;
        pointerStartY = e.clientY;
    });

    // Wheel zoom on stage with comfortable limits and natural scroll passthrough
    stage.addEventListener('wheel', (e) => {
        if (!isZoomEnabled) return;

        const defaultDist = activeModelData?.cameraSettings?.distance || 4.2;
        // Comfortable zoom out limit: ~25% depth change
        const comfortableMaxDist = defaultDist * 1.25;

        // Verify that container is within the active viewport region
        const rect = container.getBoundingClientRect();
        const isInActiveZone = rect.top < window.innerHeight * 0.75 && rect.bottom > window.innerHeight * 0.25;

        if (!isInActiveZone) {
            return;
        }

        if (e.deltaY > 0) {
            // Scrolling DOWN -> Zoom OUT
            if (targetDistance < comfortableMaxDist - 0.02) {
                e.preventDefault();
                const zoomDelta = e.deltaY * 0.0024;
                targetDistance = Math.min(comfortableMaxDist, targetDistance + zoomDelta);
            } else {
                // Reached comfortable zoom-out limit!
                // Let user naturally exit the section going down
                e.preventDefault();
                window.scrollBy({ top: e.deltaY, behavior: 'auto' });
            }
        } else if (e.deltaY < 0) {
            // Scrolling UP -> Zoom IN back towards default showcase framing
            if (targetDistance > defaultDist + 0.02) {
                e.preventDefault();
                const zoomDelta = e.deltaY * 0.0024;
                targetDistance = Math.max(defaultDist, targetDistance + zoomDelta);
            } else {
                // At or closer than default distance:
                // Let user naturally exit the section going up
                e.preventDefault();
                window.scrollBy({ top: e.deltaY, behavior: 'auto' });
            }
        }
    }, { passive: false });

    // Touch support for rotate and pinch-to-zoom
    let touchStartY = 0;
    let initialPinchDistance = 0;

    stage.addEventListener('touchstart', (e) => {
        if (e.touches.length === 2 && isZoomEnabled) {
            initialPinchDistance = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
        } else if (e.touches.length === 1) {
            touchStartY = e.touches[0].clientY;
        }
    }, { passive: true });

    stage.addEventListener('touchmove', (e) => {
        if (e.touches.length === 2 && isZoomEnabled && initialPinchDistance > 0) {
            if (e.cancelable) e.preventDefault();
            const currentDist = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            const pinchDelta = initialPinchDistance - currentDist;
            targetDistance = Math.max(minDistance, Math.min(maxDistance, targetDistance + pinchDelta * 0.008));
            initialPinchDistance = currentDist;
        }
    }, { passive: false });

    stage.addEventListener('touchend', (e) => {
        if (e.touches.length < 2) {
            initialPinchDistance = 0;
        }
    });

    // Zoom Buttons (+ / - / Reset)
    const zoomInBtn = document.getElementById('product-3d-zoom-in');
    const zoomOutBtn = document.getElementById('product-3d-zoom-out');
    const zoomResetBtn = document.getElementById('product-3d-zoom-reset');

    if (zoomInBtn) {
        zoomInBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (!isZoomEnabled) return;
            targetDistance = Math.max(minDistance, targetDistance - 0.55);
        });
    }

    if (zoomOutBtn) {
        zoomOutBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (!isZoomEnabled) return;
            targetDistance = Math.min(maxDistance, targetDistance + 0.55);
        });
    }

    if (zoomResetBtn) {
        zoomResetBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (activeModelData) {
                targetDistance = activeModelData.cameraSettings?.distance || 4.2;
                const defaultRot = activeModelData.transformSettings?.rotation || [0.12, -0.35, 0];
                targetRotationX = defaultRot[0] || 0.12;
                targetRotationY = defaultRot[1] || -0.35;
            }
        });
    }
}

/**
 * Animation & Render Loop with smooth lerp damping
 */
function startRenderLoop() {
    if (rafId) return;

    function render() {
        if (!isSectionVisible) {
            rafId = null;
            return;
        }

        // Idle slow rotation when not actively dragging
        if (!isUserInteracting && !isHovered) {
            targetRotationY += autoRotateSpeed;
        }

        // Smooth damping interpolation (lerp)
        currentRotationX += (targetRotationX - currentRotationX) * 0.06;
        currentRotationY += (targetRotationY - currentRotationY) * 0.06;

        if (currentModelGroup) {
            currentModelGroup.rotation.x = currentRotationX;
            currentModelGroup.rotation.y = currentRotationY;
        }

        // Camera distance lerp for buttery smooth zoom
        currentDistance += (targetDistance - currentDistance) * 0.08;
        if (camera) {
            camera.position.z = currentDistance;
        }

        if (renderer && scene && camera) {
            renderer.render(scene, camera);
        }

        rafId = requestAnimationFrame(render);
    }

    rafId = requestAnimationFrame(render);
}

/**
 * IntersectionObserver: Pause render loop when off-screen to achieve zero background CPU/GPU usage
 */
function setupIntersectionObserver(container) {
    intersectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            isSectionVisible = entry.isIntersecting;
            if (isSectionVisible) {
                startRenderLoop();
            } else if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
                // Softly reset camera distance to default when scrolled out of view
                if (activeModelData) {
                    const defaultDist = activeModelData.cameraSettings?.distance || 4.2;
                    targetDistance = defaultDist;
                    currentDistance = defaultDist;
                }
            }
        });
    }, { rootMargin: '100px 0px 100px 0px', threshold: 0.05 });

    intersectionObserver.observe(container);
}

/**
 * ResizeObserver: Smooth responsive adaptation
 */
function setupResizeObserver(container, canvas) {
    resizeObserver = new ResizeObserver(() => {
        if (!container || !renderer || !camera) return;
        const width = container.clientWidth;
        const height = container.clientHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();

        const isMobile = window.innerWidth < 768;
        renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, isMobile ? 1.25 : 1.5));
        renderer.setSize(width, height);
    });

    resizeObserver.observe(container);
}

/**
 * Load a 3D model by configuration object
 */
function loadModel(modelData) {
    if (!modelData || !modelData.modelUrl) return;

    activeModelData = modelData;
    updateModelMetadata(modelData);

    const loaderEl = document.getElementById('product-3d-loader');
    if (loaderEl) {
        loaderEl.classList.remove('opacity-0', 'pointer-events-none');
    }

    const canvas = document.getElementById('product-3d-canvas');
    if (canvas && !currentModelGroup) {
        canvas.classList.remove('is-loaded-model');
        canvas.classList.add('is-loading-model');
    }

    // Check if model is already cached in memory
    if (modelCache.has(modelData.slug)) {
        applyLoadedModel(modelCache.get(modelData.slug), modelData);
        if (loaderEl) loaderEl.classList.add('opacity-0', 'pointer-events-none');
        return;
    }

    loader.load(
        modelData.modelUrl,
        (gltf) => {
            modelCache.set(modelData.slug, gltf);
            applyLoadedModel(gltf, modelData);
            if (loaderEl) loaderEl.classList.add('opacity-0', 'pointer-events-none');
        },
        undefined,
        (err) => {
            console.warn(`Failed to load GLB model ${modelData.modelUrl}, falling back to image preview:`, err);
            if (loaderEl) loaderEl.classList.add('opacity-0', 'pointer-events-none');
            showFallback(modelData);
        }
    );
}

/**
 * Instantiates the loaded GLTF into the scene with GSAP rail transition and independent materials
 */
function applyLoadedModel(gltf, modelData) {
    hideFallback();

    const canvas = document.getElementById('product-3d-canvas');
    if (canvas) {
        requestAnimationFrame(() => {
            canvas.classList.remove('is-loading-model');
            canvas.classList.add('is-loaded-model');
        });
    }

    const newGroup = gltf.scene.clone(true);
    newGroup.name = `Instance_${modelData.slug}`;

    // Apply model default transform settings
    const transform = modelData.transformSettings || {};
    const scale = transform.scale !== undefined ? transform.scale : 1.0;
    const defaultRot = transform.rotation || [0.12, -0.35, 0];
    const defaultPos = transform.position || [0, 0.1, 0];

    // Determine zoom capability & camera distances
    const modelDist = modelData.cameraSettings?.distance || 4.2;
    targetDistance = modelDist;
    minDistance = Math.max(1.8, modelDist * 0.55);
    maxDistance = Math.min(8.0, modelDist * 1.6);

    const allowGlobal = globalConfig?.allowZoom !== false;
    const allowModel = modelData.cameraSettings?.allowZoom !== false;
    isZoomEnabled = allowGlobal && allowModel;

    const zoomControls = document.getElementById('product-3d-zoom-controls');
    if (zoomControls) {
        if (isZoomEnabled) {
            zoomControls.classList.remove('hidden');
        } else {
            zoomControls.classList.add('hidden');
        }
    }

    // Determine transition direction along the horizontal track (rail)
    let direction = 1;
    if (activeModelData && activeModelData.slug !== modelData.slug) {
        const prevIdx = (globalConfig?.models || []).findIndex(m => m.slug === activeModelData.slug);
        const nextIdx = (globalConfig?.models || []).findIndex(m => m.slug === modelData.slug);
        if (prevIdx !== -1 && nextIdx !== -1) {
            direction = nextIdx >= prevIdx ? 1 : -1;
        }
    }

    targetRotationX = defaultRot[0] || 0.12;
    targetRotationY = defaultRot[1] || -0.35;
    currentRotationX = targetRotationX;

    // Clone materials on each mesh so color/roughness modifications are 100% independent
    newGroup.traverse((child) => {
        if (child.isMesh) {
            child.castShadow = true;
            child.receiveShadow = true;
            if (child.material) {
                if (Array.isArray(child.material)) {
                    child.material = child.material.map(m => m ? m.clone() : new THREE.MeshStandardMaterial());
                } else {
                    child.material = child.material.clone();
                }
            } else {
                child.material = new THREE.MeshStandardMaterial({
                    color: 0xffffff,
                    roughness: 0.4,
                    metalness: 0.1,
                });
            }
        }
    });

    // Apply saved or default material selections directly to the incoming group
    applyStoredSelections(modelData, newGroup);

    // Elegant Rail Transition ("Estilo Trilho")
    if (currentModelGroup) {
        const outgoing = currentModelGroup;
        const exitX = (outgoing.position.x || 0) - (direction * 4.2);

        // Slide outgoing model smoothly along the rail to the side
        gsap.to(outgoing.position, {
            x: exitX,
            duration: 0.65,
            ease: 'power2.inOut',
            onComplete: () => {
                scene.remove(outgoing);
                disposeObject(outgoing);
            },
        });
        gsap.to(outgoing.rotation, {
            y: outgoing.rotation.y - (direction * 0.35),
            duration: 0.65,
            ease: 'power2.inOut',
        });

        // Incoming model glides in from opposite side of rail
        newGroup.scale.set(scale, scale, scale);
        newGroup.position.set(
            (defaultPos[0] || 0) + (direction * 4.2),
            defaultPos[1] !== undefined ? defaultPos[1] : 0.1,
            defaultPos[2] || 0
        );
        newGroup.rotation.x = targetRotationX;
        newGroup.rotation.y = targetRotationY + (direction * 0.35);
        currentRotationY = newGroup.rotation.y;

        scene.add(newGroup);
        currentModelGroup = newGroup;

        gsap.to(newGroup.position, {
            x: defaultPos[0] || 0,
            y: defaultPos[1] !== undefined ? defaultPos[1] : 0.1,
            z: defaultPos[2] || 0,
            duration: 0.75,
            ease: 'power3.out',
        });

        gsap.to(newGroup.rotation, {
            y: targetRotationY,
            duration: 0.8,
            ease: 'power3.out',
            onUpdate: () => {
                currentRotationY = newGroup.rotation.y;
            },
        });
    } else {
        // Initial entrance on page load: smooth settle
        newGroup.scale.set(scale * 0.96, scale * 0.96, scale * 0.96);
        newGroup.position.set(defaultPos[0] || 0, defaultPos[1] !== undefined ? defaultPos[1] : 0.1, defaultPos[2] || 0);
        newGroup.rotation.x = targetRotationX;
        newGroup.rotation.y = targetRotationY;
        currentRotationY = targetRotationY;

        scene.add(newGroup);
        currentModelGroup = newGroup;

        gsap.to(newGroup.scale, {
            x: scale,
            y: scale,
            z: scale,
            duration: 0.7,
            ease: 'power2.out',
        });
    }

    // Render Parts and Swatches UI
    renderPartsNav(modelData);
}

/**
 * Normalizes mesh/node strings for fuzzy matching across spaces, dashes, and underscores
 */
function normalizeMeshKey(str) {
    return String(str || '').toLowerCase().replace(/[-_ \t\r\n]/g, '');
}

/**
 * Apply stored or default options for model's parts to target model group
 */
function applyStoredSelections(modelData, targetGroup = currentModelGroup) {
    if (!modelData.parts || !Array.isArray(modelData.parts) || !targetGroup) return;

    if (!activeSelections.has(modelData.slug)) {
        activeSelections.set(modelData.slug, {});
    }
    const selections = activeSelections.get(modelData.slug);

    modelData.parts.forEach((part) => {
        let optionId = selections[part.id];
        if (!optionId && part.options && part.options.length > 0) {
            const defaultOpt = part.options.find(o => o.is_default) || part.options[0];
            optionId = defaultOpt.id;
            selections[part.id] = optionId;
        }

        if (optionId) {
            const opt = part.options.find(o => o.id === optionId) || part.options[0];
            if (opt) {
                applyMaterialOptionToMesh(part, opt, false, targetGroup);
            }
        }
    });
}

/**
 * Apply a specific color/material option to target mesh(es) in the 3D model
 */
function applyMaterialOptionToMesh(part, option, animate = true, targetGroup = currentModelGroup) {
    if (!targetGroup || !part || !option) return;

    const targetColor = new THREE.Color(option.color || '#ffffff');
    const targetRoughness = option.roughness !== undefined ? Number(option.roughness) : 0.4;
    const targetMetalness = option.metalness !== undefined ? Number(option.metalness) : 0.0;

    const normTarget = normalizeMeshKey(part.mesh_name);

    let totalMeshes = 0;
    targetGroup.traverse((c) => { if (c.isMesh) totalMeshes++; });

    targetGroup.traverse((child) => {
        if (child.isMesh) {
            const normChild = normalizeMeshKey(child.name);
            const normParent = normalizeMeshKey(child.parent ? child.parent.name : '');
            const materials = Array.isArray(child.material) ? child.material : [child.material];

            // Match if:
            // 1. Model only has 1 mesh, or target is empty, '*', or 'all'
            // 2. Child mesh name or parent node name matches targetMeshName
            let isMatch = (totalMeshes === 1)
                || normTarget === ''
                || normTarget === 'all'
                || normTarget === '*'
                || (normChild && (normChild.includes(normTarget) || normTarget.includes(normChild)))
                || (normParent && (normParent.includes(normTarget) || normTarget.includes(normParent)));

            if (!isMatch) {
                for (const mat of materials) {
                    if (mat && mat.name) {
                        const normMat = normalizeMeshKey(mat.name);
                        if (normMat && (normMat.includes(normTarget) || normTarget.includes(normMat))) {
                            isMatch = true;
                            break;
                        }
                    }
                }
            }

            if (isMatch) {
                materials.forEach((mat) => {
                    if (!mat) return;

                    if (animate) {
                        if (mat.color) {
                            gsap.to(mat.color, {
                                r: targetColor.r,
                                g: targetColor.g,
                                b: targetColor.b,
                                duration: 0.45,
                                ease: 'power2.out',
                            });
                        }

                        if (mat.roughness !== undefined) {
                            gsap.to(mat, {
                                roughness: targetRoughness,
                                metalness: targetMetalness,
                                duration: 0.45,
                                ease: 'power2.out',
                            });
                        }
                    } else {
                        if (mat.color) mat.color.copy(targetColor);
                        if (mat.roughness !== undefined) {
                            mat.roughness = targetRoughness;
                            mat.metalness = targetMetalness;
                        }
                    }

                    // Handle optional texture map
                    if (option.texture_url) {
                        loadAndApplyTexture(mat, option.texture_url);
                    } else if (mat.map) {
                        mat.map = null;
                        mat.needsUpdate = true;
                    }

                    mat.needsUpdate = true;
                });
            }
        }
    });
}

/**
 * Loads and applies texture map with caching
 */
function loadAndApplyTexture(material, url) {
    if (textureCache.has(url)) {
        material.map = textureCache.get(url);
        material.needsUpdate = true;
        return;
    }

    const texLoader = new THREE.TextureLoader();
    texLoader.load(url, (tex) => {
        tex.wrapS = THREE.RepeatWrapping;
        tex.wrapT = THREE.RepeatWrapping;
        textureCache.set(url, tex);
        material.map = tex;
        material.needsUpdate = true;
    });
}

/**
 * Updates DOM product metadata with zero artifacts when fields are empty
 */
function updateModelMetadata(modelData) {
    const badgeEl = document.getElementById('product-3d-badge');
    const nameEl = document.getElementById('product-3d-name');
    const subtitleEl = document.getElementById('product-3d-subtitle');
    const floatingDock = document.getElementById('product-3d-floating-dock');

    // Ensure no badge/eyebrow renders above product name
    if (badgeEl) {
        badgeEl.remove();
    }

    // Name: title
    if (nameEl) {
        gsap.to(nameEl, {
            opacity: 0,
            y: 4,
            duration: 0.15,
            onComplete: () => {
                nameEl.textContent = modelData.name || '';
                gsap.to(nameEl, { opacity: 1, y: 0, duration: 0.3, ease: 'norra-out' });
            }
        });
    }

    // Subtitle: zero artifacts when empty
    if (subtitleEl) {
        const hasSubtitle = Boolean(modelData.subtitle && String(modelData.subtitle).trim() !== '');
        if (hasSubtitle) {
            subtitleEl.textContent = String(modelData.subtitle).trim();
            subtitleEl.classList.remove('hidden');
            subtitleEl.classList.add('block');
        } else {
            subtitleEl.classList.add('hidden');
            subtitleEl.classList.remove('block');
            subtitleEl.textContent = '';
        }
    }

    // Small, elegant product description below title and subtitle
    const descriptionEl = document.getElementById('product-3d-description');
    if (descriptionEl) {
        const hasDescription = Boolean(modelData.description && String(modelData.description).trim() !== '');
        if (hasDescription) {
            descriptionEl.textContent = String(modelData.description).trim();
            descriptionEl.classList.remove('hidden');
            descriptionEl.classList.add('block');
        } else {
            descriptionEl.classList.add('hidden');
            descriptionEl.classList.remove('block');
            descriptionEl.textContent = '';
        }
    }

    // Floating dock: hide completely if model has no configurable parts
    if (floatingDock) {
        const hasParts = Boolean(modelData.parts && Array.isArray(modelData.parts) && modelData.parts.length > 0);
        if (hasParts) {
            floatingDock.classList.remove('hidden');
            floatingDock.classList.add('flex');
        } else {
            floatingDock.classList.add('hidden');
            floatingDock.classList.remove('flex');
        }
    }
}

/**
 * Render Parts Tabs ([Cabo] [Lâmina] [Guarda]) or hide when only 1 part exists
 */
function renderPartsNav(modelData) {
    const partsNav = document.getElementById('product-3d-parts-nav');
    const floatingDock = document.getElementById('product-3d-floating-dock');
    if (!floatingDock) return;

    if (!modelData.parts || modelData.parts.length === 0) {
        floatingDock.classList.add('hidden');
        floatingDock.classList.remove('flex');
        renderSwatches(null);
        return;
    }

    floatingDock.classList.remove('hidden');
    floatingDock.classList.add('flex');

    if (partsNav) {
        partsNav.innerHTML = '';

        // If only 1 part (e.g. Stam 803 with "gabarito" or Cabo with "Cabo"), keep parts nav hidden!
        // This removes the bulky "gabarito" rectangular button and keeps the UI ultra-clean.
        if (modelData.parts.length <= 1) {
            partsNav.classList.add('hidden');
            partsNav.classList.remove('flex');
        } else {
            partsNav.classList.remove('hidden');
            partsNav.classList.add('flex');

            const partExists = modelData.parts.some(p => p.id === activePartId);
            if (!partExists) {
                activePartId = modelData.parts[0].id;
            }

            modelData.parts.forEach((part) => {
                const isActive = part.id === activePartId;
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `px-2 py-0.5 text-xs transition-colors duration-200 cursor-pointer ${
                    isActive
                        ? 'text-white font-medium border-b border-white'
                        : 'text-[#a1a1a6] hover:text-white'
                }`;
                btn.textContent = part.name;
                btn.setAttribute('data-part-id', part.id);
                btn.setAttribute('role', 'tab');
                btn.setAttribute('aria-selected', isActive ? 'true' : 'false');

                btn.addEventListener('click', () => {
                    if (activePartId === part.id) return;
                    activePartId = part.id;
                    renderPartsNav(modelData);
                });

                partsNav.appendChild(btn);
            });
        }
    }

    const currentPart = (modelData.parts.length > 0)
        ? (modelData.parts.find(p => p.id === activePartId) || modelData.parts[0])
        : null;

    renderSwatches(currentPart);
}

/**
 * Render Material / Color Swatches directly floating over the 3D scene in the bottom-right
 */
function renderSwatches(part) {
    const swatchesContainer = document.getElementById('product-3d-swatches');

    if (!swatchesContainer) return;
    swatchesContainer.innerHTML = '';

    if (!part || !part.options || part.options.length === 0) {
        return;
    }

    const selections = activeSelections.get(activeModelData?.slug) || {};
    let selectedOptionId = selections[part.id] || part.options[0].id;

    part.options.forEach((opt) => {
        const isSelected = opt.id === selectedOptionId;
        const swatch = document.createElement('button');
        swatch.type = 'button';
        swatch.className = `group relative w-8 h-8 rounded-full transition-all duration-200 flex items-center justify-center cursor-pointer focus:outline-none backdrop-blur-sm bg-black/40 shadow-md ${
            isSelected
                ? 'ring-2 ring-white ring-offset-2 ring-offset-[#121212] scale-110'
                : 'ring-1 ring-white/20 hover:ring-white/60 hover:scale-105'
        }`;
        swatch.setAttribute('aria-label', opt.name);
        swatch.setAttribute('title', opt.name);

        // Circular color tile with luxury depth
        const innerCircle = document.createElement('span');
        innerCircle.className = 'w-5.5 h-5.5 rounded-full block shadow-inner transition-transform duration-200 group-hover:scale-95';
        innerCircle.style.backgroundColor = opt.color;

        if (opt.metalness > 0.3) {
            innerCircle.style.backgroundImage = 'radial-gradient(circle at 35% 35%, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0) 70%)';
            innerCircle.style.boxShadow = 'inset 0 1px 2px rgba(255,255,255,0.4), inset 0 -1px 2px rgba(0,0,0,0.5)';
        } else {
            innerCircle.style.boxShadow = 'inset 0 1px 2px rgba(255,255,255,0.25), inset 0 -1px 2px rgba(0,0,0,0.45)';
        }

        swatch.appendChild(innerCircle);

        swatch.addEventListener('click', () => {
            if (selections[part.id] === opt.id) return;

            selections[part.id] = opt.id;
            activeSelections.set(activeModelData.slug, selections);

            // Apply to 3D mesh with smooth GSAP transition
            applyMaterialOptionToMesh(part, opt, true, currentModelGroup);

            // Re-render swatches to update active ring
            renderSwatches(part);
        });

        swatchesContainer.appendChild(swatch);
    });

    // Stagger animation for swatches on display
    gsap.fromTo(
        swatchesContainer.children,
        { scale: 0.8, opacity: 0 },
        { scale: 1, opacity: 1, duration: 0.22, stagger: 0.02, ease: 'power2.out' }
    );
}

/**
 * Setup DOM Model Switcher with Elegant Sliding Rail Indicator strictly on CLICK
 */
function setupDomControls(config, has3D) {
    const switcher = document.getElementById('product-3d-model-switcher');
    const indicator = document.getElementById('product-model-indicator');
    const tabs = switcher ? switcher.querySelectorAll('.product-model-tab') : [];

    if (!switcher || tabs.length === 0) return;

    let currentActiveTab = switcher.querySelector('.product-model-tab[aria-selected="true"]') || tabs[0];

    function moveIndicator(targetTab, duration = 0.38, ease = 'power3.out') {
        if (!targetTab || !indicator || !switcher) return;
        const trackRect = switcher.getBoundingClientRect();
        const tabRect = targetTab.getBoundingClientRect();
        if (tabRect.width === 0) return;

        const x = tabRect.left - trackRect.left;
        const width = tabRect.width;

        if (duration === 0) {
            gsap.set(indicator, { x, width, opacity: 1 });
        } else {
            gsap.to(indicator, {
                x: x,
                width: width,
                opacity: 1,
                duration: duration,
                ease: ease,
                overwrite: 'auto',
            });
        }
    }

    function updateTabVisuals(activeTab) {
        tabs.forEach((t) => {
            const isActive = t === activeTab;
            t.setAttribute('aria-selected', isActive ? 'true' : 'false');
            if (isActive) {
                t.classList.add('text-black', 'font-semibold');
                t.classList.remove('text-[#a1a1a6]', 'hover:text-white');
            } else {
                t.classList.remove('text-black', 'font-semibold');
                t.classList.add('text-[#a1a1a6]', 'hover:text-white');
            }
        });
    }

    // Position indicator immediately on setup
    moveIndicator(currentActiveTab, 0);
    updateTabVisuals(currentActiveTab);

    // Re-verify after layout and fonts load to ensure exact pixel alignment
    requestAnimationFrame(() => {
        moveIndicator(currentActiveTab, 0);
        updateTabVisuals(currentActiveTab);
    });

    if (document.fonts?.ready) {
        document.fonts.ready.then(() => {
            moveIndicator(currentActiveTab, 0);
        });
    }

    window.addEventListener('resize', () => {
        moveIndicator(currentActiveTab, 0);
    });

    tabs.forEach((tab) => {
        // Rail sliding animation happens ONLY on click smoothly and professionally
        tab.addEventListener('click', () => {
            const slug = tab.getAttribute('data-model-slug');
            if (!slug) return;
            if (activeModelData && activeModelData.slug === slug) return;

            currentActiveTab = tab;

            tabs.forEach(t => t.setAttribute('aria-selected', 'false'));
            tab.setAttribute('aria-selected', 'true');

            // Smooth sliding rail animation
            moveIndicator(tab, 0.4, 'power3.out');
            updateTabVisuals(tab);

            const selectedModel = config.models.find(m => m.slug === slug);
            if (!selectedModel) return;

            if (has3D) {
                loadModel(selectedModel);
            } else {
                showFallback(selectedModel);
                updateModelMetadata(selectedModel);
                renderPartsNav(selectedModel);
            }
        });
    });
}

/**
 * Show Fallback Image when WebGL or GLB loading fails
 */
function showFallback(modelData) {
    const fallbackEl = document.getElementById('product-3d-fallback');
    const fallbackImg = document.getElementById('product-3d-fallback-img');
    const canvas = document.getElementById('product-3d-canvas');

    if (canvas) canvas.style.display = 'none';

    if (fallbackEl && fallbackImg && modelData) {
        fallbackEl.classList.remove('hidden');
        if (modelData.thumbnailUrl) {
            fallbackImg.src = modelData.thumbnailUrl;
            fallbackImg.alt = modelData.name || 'Produto Norra';
        }
    }
}

/**
 * Hide Fallback Image when 3D is active
 */
function hideFallback() {
    const fallbackEl = document.getElementById('product-3d-fallback');
    const canvas = document.getElementById('product-3d-canvas');

    if (fallbackEl) fallbackEl.classList.add('hidden');
    if (canvas) canvas.style.display = 'block';
}

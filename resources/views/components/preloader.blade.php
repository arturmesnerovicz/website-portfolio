<div id="norra-preloader" class="norra-preloader" aria-hidden="true">
    <div id="norra-preloader-mask" class="norra-preloader-mask">
        <!-- Layer 1: Base Faint Monogram Icon (Unloaded state: #ddddd5 at low opacity / subtle grey) -->
        <svg class="norra-preloader-icon norra-preloader-icon-bg" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9912 0C13.4453 0 0 13.5015 0 30.0762C1.65039 69.9746 58.3496 69.9746 60 30.0762C60 13.4834 46.5352 0 30.0088 0L29.9912 0ZM29.9912 57.6865C15.9395 57.6865 4.34668 47.0547 2.69629 33.4053C2.60449 32.6323 3.48535 32.1182 4.09082 32.5962L28.5234 52.1499C29.0928 52.6094 29.918 52.2056 29.918 51.4692L29.918 20.0508C29.8994 19.0938 31.2197 18.8545 31.5498 19.7559L43.9131 52.9775C44.0605 53.3828 43.9131 53.8237 43.5459 54.0444C39.5293 56.3438 34.9248 57.6689 29.9912 57.6689L29.9912 57.6865ZM49.2686 49.354L47.8203 49.354C47.4717 49.354 47.1787 49.1338 47.0312 48.8203L30.9453 11.3682C30.6143 10.5957 29.4951 10.7061 29.3125 11.5151L22.9473 40.4141C22.8193 40.9834 22.1582 41.2783 21.6631 40.9658L4.12793 30.2778C3.08203 29.6343 2.51172 28.4385 2.64258 27.2251C4.10938 12.8398 16.6182 1.69238 31.5137 2.50146C45.2334 3.23779 57.3037 15.8745 57.5059 29.6528C57.6152 37.1763 54.6992 44.0195 49.9111 49.0596C49.7461 49.2432 49.5088 49.3354 49.2686 49.3354L49.2686 49.354Z" fill="currentColor"/>
        </svg>

        <!-- Layer 2: Foreground Monogram Icon (Progressive vertical fill in solid #ddddd5) -->
        <div id="norra-preloader-filler" class="norra-preloader-filler">
            <svg class="norra-preloader-icon norra-preloader-icon-fill" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9912 0C13.4453 0 0 13.5015 0 30.0762C1.65039 69.9746 58.3496 69.9746 60 30.0762C60 13.4834 46.5352 0 30.0088 0L29.9912 0ZM29.9912 57.6865C15.9395 57.6865 4.34668 47.0547 2.69629 33.4053C2.60449 32.6323 3.48535 32.1182 4.09082 32.5962L28.5234 52.1499C29.0928 52.6094 29.918 52.2056 29.918 51.4692L29.918 20.0508C29.8994 19.0938 31.2197 18.8545 31.5498 19.7559L43.9131 52.9775C44.0605 53.3828 43.9131 53.8237 43.5459 54.0444C39.5293 56.3438 34.9248 57.6689 29.9912 57.6689L29.9912 57.6865ZM49.2686 49.354L47.8203 49.354C47.4717 49.354 47.1787 49.1338 47.0312 48.8203L30.9453 11.3682C30.6143 10.5957 29.4951 10.7061 29.3125 11.5151L22.9473 40.4141C22.8193 40.9834 22.1582 41.2783 21.6631 40.9658L4.12793 30.2778C3.08203 29.6343 2.51172 28.4385 2.64258 27.2251C4.10938 12.8398 16.6182 1.69238 31.5137 2.50146C45.2334 3.23779 57.3037 15.8745 57.5059 29.6528C57.6152 37.1763 54.6992 44.0195 49.9111 49.0596C49.7461 49.2432 49.5088 49.3354 49.2686 49.3354L49.2686 49.354Z" fill="currentColor"/>
            </svg>
        </div>
    </div>
</div>

<style>
/* Exo Ape Style Preloader Architecture */
.norra-preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100vw;
    height: 100vh;
    height: 100svh;
    z-index: 99999;
    background-color: #101010;
    color: #ddddd5;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    clip-path: polygon(0 0px, 100% 0px, 100% 100%, 0 100%);
    will-change: clip-path;
    pointer-events: auto;
}

/* Exact responsive proportions from Exo Ape */
.norra-preloader-mask {
    position: relative;
    display: block;
    width: 21.3333333333vw;
    height: 21.3333333333vw;
    min-width: 68px;
    min-height: 68px;
    max-width: 135px;
    max-height: 135px;
    will-change: transform, opacity;
    z-index: 1;
}

@media (min-width: 601px) {
    .norra-preloader-mask {
        width: 7.5vw;
        height: 7.5vw;
        min-width: 75px;
        min-height: 75px;
        max-width: 130px;
        max-height: 130px;
    }
}

.norra-preloader-icon {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
}

/* Faint gray unloaded base state matching Exo Ape (--color-light-grey-02) */
.norra-preloader-icon-bg {
    color: #ddddd5;
    opacity: 0.18;
    z-index: 1;
}

/* Solid filling layer - clips from top to bottom */
.norra-preloader-filler {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    clip-path: inset(100% 0 0 0);
    will-change: clip-path;
}

.norra-preloader-icon-fill {
    color: #ddddd5;
}
</style>

<script>
(function() {
    // Lock scroll during loading state
    document.body.classList.add('is-loading');
    document.body.style.overflow = 'hidden';

    const preloader = document.getElementById('norra-preloader');
    const mask = document.getElementById('norra-preloader-mask');
    const filler = document.getElementById('norra-preloader-filler');
    if (!preloader || !mask || !filler) return;

    let targetProgress = 0.08;
    let currentProgress = 0;
    let isWindowLoaded = false;
    let isDismissed = false;
    let animFrameId = null;
    const startTime = performance.now();
    const minLoadDuration = 1250; // Smooth agency minimum timing (ms)

    // Track images progress
    const images = Array.from(document.images);
    let loadedImagesCount = 0;
    const totalImages = Math.max(images.length, 1);

    function onImageProgress() {
        loadedImagesCount++;
        const imgRatio = loadedImagesCount / totalImages;
        targetProgress = Math.max(targetProgress, 0.2 + imgRatio * 0.65);
    }

    images.forEach(img => {
        if (img.complete) {
            onImageProgress();
        } else {
            img.addEventListener('load', onImageProgress, { once: true });
            img.addEventListener('error', onImageProgress, { once: true });
        }
    });

    // Check fonts & DOM readiness
    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        targetProgress = Math.max(targetProgress, 0.4);
    } else {
        document.addEventListener('DOMContentLoaded', () => {
            targetProgress = Math.max(targetProgress, 0.45);
        }, { once: true });
    }

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(() => {
            targetProgress = Math.max(targetProgress, 0.55);
        }).catch(() => {});
    }

    // Complete on window load
    function onCompleteLoad() {
        isWindowLoaded = true;
        targetProgress = 1.0;
    }

    if (document.readyState === 'complete') {
        onCompleteLoad();
    } else {
        window.addEventListener('load', onCompleteLoad, { once: true });
    }

    // Failsafe timeout after 3.5s to ensure preloader never blocks UX
    const safetyTimeout = setTimeout(() => {
        onCompleteLoad();
    }, 3500);

    // Animation Loop: Smoothly Lerp to targetProgress
    function render() {
        const elapsed = performance.now() - startTime;
        const timeRatio = Math.min(elapsed / minLoadDuration, 1);

        // Cap perceived progress by elapsed minimum duration until ready
        let effectiveTarget = isWindowLoaded
            ? 1.0
            : Math.min(targetProgress, 0.92);

        // Smooth interpolation
        const step = (effectiveTarget - currentProgress) * 0.08 + 0.003;
        currentProgress = Math.min(currentProgress + step, effectiveTarget);

        // Apply clip-path from bottom to top: inset(top right bottom left)
        const topClip = Math.max(0, (1 - currentProgress) * 100).toFixed(2);
        filler.style.clipPath = `inset(${topClip}% 0 0 0)`;

        // Check if finished
        if (isWindowLoaded && elapsed >= minLoadDuration && currentProgress >= 0.985) {
            filler.style.clipPath = 'inset(0% 0 0 0)';
            cancelAnimationFrame(animFrameId);
            clearTimeout(safetyTimeout);
            dismiss();
            return;
        }

        animFrameId = requestAnimationFrame(render);
    }

    animFrameId = requestAnimationFrame(render);

    // Exit transition strictly following Exo Ape mechanics
    function dismiss() {
        if (isDismissed) return;
        isDismissed = true;

        const gsap = window.gsap;
        if (gsap) {
            const tl = gsap.timeline();

            // 1. Icon scales down and fades out (Exo Ape exact: scale: 0, autoAlpha: 0)
            tl.to(mask, {
                scale: 0.78,
                autoAlpha: 0,
                duration: 0.45,
                ease: 'power2.in'
            });

            // 2. Curtain wipe upwards with authentic cubic-bezier curve
            tl.to(preloader, {
                clipPath: 'polygon(0 0px, 100% 0px, 100% 0px, 0 0px)',
                duration: 0.9,
                ease: 'M0,0 C0.496,0.004 0,1 1,1',
                onStart: () => {
                    // Dispatch event immediately as curtain starts lifting
                    window.dispatchEvent(new CustomEvent('norra-preloader-done'));
                    document.body.classList.remove('is-loading');
                    document.body.style.overflow = '';
                },
                onComplete: () => {
                    preloader.remove();
                }
            }, '-=0.12');
        } else {
            // Fallback for native execution
            mask.style.transition = 'transform 0.45s ease-in, opacity 0.45s ease-in';
            mask.style.transform = 'scale(0.78)';
            mask.style.opacity = '0';

            setTimeout(() => {
                preloader.style.transition = 'clip-path 0.9s cubic-bezier(0.496, 0.004, 0, 1)';
                preloader.style.clipPath = 'polygon(0 0px, 100% 0px, 100% 0px, 0 0px)';
                window.dispatchEvent(new CustomEvent('norra-preloader-done'));
                document.body.classList.remove('is-loading');
                document.body.style.overflow = '';

                setTimeout(() => {
                    preloader.remove();
                }, 950);
            }, 350);
        }
    }
})();
</script>

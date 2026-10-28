// Estúdio Norra - Exo Ape Page Transition System
// Exact 1:1 replica of https://www.exoape.com/ page transition architecture
import { gsap } from 'gsap';
import { CustomEase } from 'gsap/CustomEase';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(CustomEase, ScrollTrigger);

// Authentic Exo Ape cubic-bezier transition curve
CustomEase.create('exo-ease', 'M0,0 C0.496,0.004 0,1 1,1');

let isTransitioning = false;
const pageCache = new Map();

/**
 * Prefetches target page HTML in the background for zero-latency instant transitions.
 */
export async function prefetchPage(url) {
    const cleanUrl = url.split('#')[0];
    if (pageCache.has(cleanUrl)) {
        return pageCache.get(cleanUrl);
    }

    try {
        const response = await fetch(cleanUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (response.ok) {
            const html = await response.text();
            pageCache.set(cleanUrl, html);
            return html;
        }
    } catch (_) {
        // Silently fail prefetch
    }
    return null;
}

/**
 * Normalizes URL path for precise comparison (removes trailing slashes)
 */
function normalizeUrl(url) {
    try {
        const u = new URL(url, window.location.origin);
        let path = u.pathname;
        if (path.length > 1 && path.endsWith('/')) {
            path = path.slice(0, -1);
        }
        return u.origin + path;
    } catch (_) {
        return url.split('#')[0];
    }
}

/**
 * Updates navbar links and active classes to match the new document
 */
function updateNavbar(newDoc) {
    // 1. Desktop Nav links
    const currentDesktopNav = document.querySelector('#site-header nav');
    const newDesktopNav = newDoc.querySelector('#site-header nav');
    if (currentDesktopNav && newDesktopNav) {
        currentDesktopNav.innerHTML = newDesktopNav.innerHTML;
    }

    // 2. Mobile Nav links
    const currentMobileNav = document.querySelector('#mobile-menu nav');
    const newMobileNav = newDoc.querySelector('#mobile-menu nav');
    if (currentMobileNav && newMobileNav) {
        currentMobileNav.innerHTML = newMobileNav.innerHTML;
    }

    // 3. Language Switchers (Desktop & Mobile)
    const currentDesktopLang = document.querySelector('#site-header .nav-lang-switcher');
    const newDesktopLang = newDoc.querySelector('#site-header .nav-lang-switcher');
    if (currentDesktopLang && newDesktopLang) {
        currentDesktopLang.innerHTML = newDesktopLang.innerHTML;
    }

    const currentMobileLang = document.querySelector('#mobile-menu .nav-lang-switcher');
    const newMobileLang = newDoc.querySelector('#mobile-menu .nav-lang-switcher');
    if (currentMobileLang && newMobileLang) {
        currentMobileLang.innerHTML = newMobileLang.innerHTML;
    }

    // 4. Brand Logo href
    const currentLogo = document.querySelector('#site-header a[aria-label]');
    const newLogo = newDoc.querySelector('#site-header a[aria-label]');
    if (currentLogo && newLogo) {
        currentLogo.href = newLogo.href;
    }
}

/**
 * Closes mobile drawer if it was open when transition was triggered
 */
function closeMobileMenuIfOpen() {
    if (typeof window.closeMobileMenuDirectly === 'function') {
        window.closeMobileMenuDirectly();
    } else {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        if (btn && menu) {
            menu.classList.add('hidden');
            backdrop?.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
        }
    }
}

/**
 * Executes the authentic Exo Ape transition to targetUrl
 */
export async function transitionTo(targetUrl, isPopState = false) {
    if (isTransitioning) return;

    const currentNorm = normalizeUrl(window.location.href);
    const targetNorm = normalizeUrl(targetUrl);
    const targetHash = targetUrl.includes('#') ? targetUrl.split('#')[1] : null;

    // If staying on the same page, simply smooth-scroll to the anchor if present
    if (currentNorm === targetNorm) {
        closeMobileMenuIfOpen();
        if (targetHash) {
            const targetEl = document.getElementById(targetHash);
            if (targetEl) {
                if (typeof window.revealSection === 'function') {
                    const parent = targetEl.closest('section, footer') || targetEl;
                    window.revealSection(parent);
                }
                targetEl.scrollIntoView({ behavior: 'smooth' });
                if (!isPopState) {
                    window.history.pushState(null, '', targetUrl);
                }
            }
        }
        return;
    }

    isTransitioning = true;
    document.body.classList.add('is-loading');
    closeMobileMenuIfOpen();

    // Safety watchdog timer: force reset if anything gets stuck or takes longer than 2.8s
    const safetyTimer = setTimeout(() => {
        if (isTransitioning) {
            console.warn('Norra page transition timeout failsafe triggered');
            isTransitioning = false;
            document.body.style.overflow = '';
            document.body.classList.remove('is-loading');
            document.querySelectorAll('.exo-viewport-frame').forEach(f => f.remove());
        }
    }, 2800);

    try {
        // 1. Fetch HTML (or use cached version)
        const targetCleanUrl = targetUrl.split('#')[0];
        let html = pageCache.get(targetCleanUrl);
        if (!html) {
            const res = await fetch(targetCleanUrl);
            if (!res.ok) {
                clearTimeout(safetyTimer);
                isTransitioning = false;
                document.body.style.overflow = '';
                document.body.classList.remove('is-loading');
                window.location.href = targetUrl;
                return;
            }
            html = await res.text();
            pageCache.set(targetCleanUrl, html);
        }

        // 2. Parse new document
        const parser = new DOMParser();
        const newDoc = parser.parseFromString(html, 'text/html');
        const incomingContentSource = newDoc.getElementById('exo-page-content');

        const pageContainer = document.getElementById('exo-page-container');
        const outgoingContent = document.getElementById('exo-page-content');

        if (!incomingContentSource || !pageContainer || !outgoingContent) {
            clearTimeout(safetyTimer);
            isTransitioning = false;
            document.body.style.overflow = '';
            document.body.classList.remove('is-loading');
            window.location.href = targetUrl;
            return;
        }

        // 3. Freeze viewport scroll & prepare frames
        const scrollY = window.scrollY || window.pageYOffset || 0;
        document.body.style.overflow = 'hidden';

        // Kill existing ScrollTriggers and revert pin spacers before animating out
        try {
            ScrollTrigger.getAll().forEach(st => st.kill(true));
        } catch (_) {}

        // 4. Create Outgoing Viewport Frame
        const outgoingFrame = document.createElement('div');
        outgoingFrame.className = 'exo-viewport-frame outgoing-frame fixed inset-0 w-screen h-screen overflow-hidden z-20 pointer-events-none bg-[#101010]';
        outgoingFrame.style.transformOrigin = '50% 50%';
        outgoingFrame.style.willChange = 'transform';

        outgoingContent.style.width = '100vw';
        outgoingContent.style.marginTop = `-${scrollY}px`;
        outgoingFrame.appendChild(outgoingContent);

        // Dynamic dark veil overlay for outgoing page (only exists during transition)
        const outgoingOverlay = document.createElement('div');
        outgoingOverlay.className = 'absolute inset-0 bg-[#0d0e13] z-30 pointer-events-none';
        gsap.set(outgoingOverlay, { autoAlpha: 0 });
        outgoingFrame.appendChild(outgoingOverlay);

        document.body.appendChild(outgoingFrame);

        // 5. Create Incoming Viewport Frame (placed above outgoing at z-30, below navbar at z-40)
        const incomingFrame = document.createElement('div');
        incomingFrame.className = 'exo-viewport-frame incoming-frame fixed inset-0 w-screen h-screen overflow-hidden z-30 pointer-events-none';
        incomingFrame.style.transformOrigin = '50% 50%';
        incomingFrame.style.willChange = 'transform, clip-path';

        const incomingContent = incomingContentSource.cloneNode(true);
        incomingContent.style.width = '100vw';
        incomingContent.style.marginTop = '0px';

        incomingFrame.appendChild(incomingContent);
        document.body.appendChild(incomingFrame);

        // 6. Exo Ape GSAP Timeline
        const duration = 1.05;
        const tl = gsap.timeline({
            defaults: {
                ease: 'exo-ease',
                duration: duration
            },
            onComplete: () => {
                try {
                    // Instantly scroll window to top before replacing elements in normal DOM flow
                    window.scrollTo(0, 0);

                    // Restore incoming content to natural document flow with zero leftover transforms
                    incomingContent.style.width = '';
                    incomingContent.style.marginTop = '';
                    incomingContent.style.transform = '';
                    incomingContent.style.transformOrigin = '';
                    incomingContent.style.willChange = '';
                    pageContainer.innerHTML = '';
                    pageContainer.appendChild(incomingContent);

                    // Clean up temporary viewport frames
                    outgoingFrame.remove();
                    incomingFrame.remove();

                    // Restore scrolling and loading state
                    document.body.style.overflow = '';
                    document.body.classList.remove('is-loading');

                    // Update URL, history & document metadata
                    if (!isPopState) {
                        window.history.pushState(null, '', targetUrl);
                    }
                    document.title = newDoc.title;

                    // Sync Navbar links
                    updateNavbar(newDoc);

                    // Re-initialize all Norra components and refresh ScrollTrigger
                    if (typeof window.initAllNorraComponents === 'function') {
                        window.initAllNorraComponents();
                    }
                    ScrollTrigger.refresh();

                    // If link contained an anchor hash on the new page, smoothly scroll to it and reveal
                    if (targetHash) {
                        setTimeout(() => {
                            const targetEl = document.getElementById(targetHash);
                            if (targetEl) {
                                if (typeof window.revealSection === 'function') {
                                    const parent = targetEl.closest('section, footer') || targetEl;
                                    window.revealSection(parent);
                                }
                                targetEl.scrollIntoView({ behavior: 'smooth' });
                            }
                        }, 80);
                    }
                } catch (err) {
                    console.error('Error during transition onComplete:', err);
                } finally {
                    clearTimeout(safetyTimer);
                    isTransitioning = false;
                    document.body.style.overflow = '';
                    document.body.classList.remove('is-loading');
                }
            }
        });

        // --- A. LEAVE ANIMATION (Outgoing Page) ---
        // Recedes into distance: scales up to 1.3, rotates -7deg, moves up by half the screen
        tl.fromTo(outgoingFrame,
            { scale: 1, rotate: 0, y: 0 },
            { scale: 1.3, rotate: -7, y: -window.innerHeight / 2 },
            0
        );

        // Overlay dims outgoing page to black
        if (outgoingOverlay) {
            tl.fromTo(outgoingOverlay,
                { autoAlpha: 0 },
                { autoAlpha: 1 },
                0
            );
        }

        // --- B. ENTER ANIMATION (Incoming Page) ---
        // 1. Dynamic angled clip-path wipe from bottom
        tl.fromTo(incomingFrame,
            {
                clipPath: 'polygon(0% 100%, 100% 110%, 100% 100%, 0% 100%)',
                zIndex: 30
            },
            {
                clipPath: 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)',
                clearProps: 'clipPath'
            },
            0
        );

        // 2. Inner content counter-rotates and scales down to normal position
        tl.fromTo(incomingContent,
            {
                scale: 1.3,
                rotate: 7,
                y: window.innerHeight / 2,
                transformOrigin: '50% 50%'
            },
            {
                scale: 1,
                rotate: 0,
                y: 0,
                clearProps: 'transform'
            },
            0
        );

    } catch (err) {
        clearTimeout(safetyTimer);
        isTransitioning = false;
        document.body.style.overflow = '';
        document.body.classList.remove('is-loading');
        console.error('Page transition fallback triggered:', err);
        window.location.href = targetUrl;
    }
}

/**
 * Initializes global link click interception and hover prefetching
 */
export function initPageTransition() {
    // 1. Intercept link clicks
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');
        if (!href) return;

        // Skip non-HTTP links, hash-only anchors, modal triggers, and explicitly skipped links
        if (href === '#' || href === '' || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) return;
        if (link.target === '_blank' || link.hasAttribute('download') || link.dataset.noTransition !== undefined || link.hasAttribute('data-project-modal-trigger')) return;

        // Skip user modifier clicks (e.g. Cmd+click, Ctrl+click, middle click)
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;

        let targetUrl;
        try {
            targetUrl = new URL(link.href, window.location.origin);
        } catch (_) {
            return;
        }

        // Only handle internal origin
        if (targetUrl.origin !== window.location.origin) return;

        const currentNorm = normalizeUrl(window.location.href);
        const targetNorm = normalizeUrl(targetUrl.href);
        const isSamePath = (currentNorm === targetNorm);

        // If clicking an anchor on the exact same page, smooth-scroll and close mobile drawer
        if (isSamePath && targetUrl.hash) {
            closeMobileMenuIfOpen();
            const targetEl = document.querySelector(targetUrl.hash);
            if (targetEl) {
                if (typeof window.revealSection === 'function') {
                    const parent = targetEl.closest('section, footer') || targetEl;
                    window.revealSection(parent);
                }
                targetEl.scrollIntoView({ behavior: 'smooth' });
                window.history.pushState(null, '', targetUrl.href);
            }
            return;
        }

        // If clicking link to current exact URL without hash, scroll to top and close mobile drawer
        if (isSamePath && !targetUrl.hash) {
            e.preventDefault();
            closeMobileMenuIfOpen();
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return;
        }

        e.preventDefault();
        transitionTo(targetUrl.href);
    });

    // 2. Prefetch on mouse hover for zero-latency response
    document.addEventListener('mouseover', (e) => {
        const link = e.target.closest('a');
        if (!link) return;
        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
        if (link.target === '_blank' || link.dataset.noTransition !== undefined) return;

        try {
            const targetUrl = new URL(link.href, window.location.origin);
            if (targetUrl.origin === window.location.origin) {
                prefetchPage(targetUrl.href);
            }
        } catch (_) {}
    }, { passive: true });

    // 3. Browser Back/Forward navigation support
    window.addEventListener('popstate', () => {
        transitionTo(window.location.href, true);
    });
}

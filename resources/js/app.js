// Estúdio Norra - Frontend Interactions & GSAP Animations
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { CustomEase } from 'gsap/CustomEase';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, CustomEase, SplitText);
ScrollTrigger.config({ ignoreMobileResize: true });
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.CustomEase = CustomEase;
window.SplitText = SplitText;

import { initPageTransition } from './page-transition';

// Authentic Norra cubic-bezier ease matching Nog Arquitetura & Monolog / OH Architecture
CustomEase.create('norra-out', 'M0,0 C0.16,1 0.3,1 1,1');
CustomEase.create('ease-menu', '.7, 0, .22, 1');
CustomEase.create('ease-secondary', '0.16, 1, 0.35, 1');

export function initAllNorraComponents() {
    try { initHeaderScroll(); } catch (e) { console.error('initHeaderScroll:', e); }
    try { initMobileMenu(); } catch (e) { console.error('initMobileMenu:', e); }
    try { initContactForm(); } catch (e) { console.error('initContactForm:', e); }
    try { initFloatingWhatsApp(); } catch (e) { console.error('initFloatingWhatsApp:', e); }
    try { initModalKeyHandlers(); } catch (e) { console.error('initModalKeyHandlers:', e); }
    try { initHeroParallax(); } catch (e) { console.error('initHeroParallax:', e); }
    try { initJourneyScroll(); } catch (e) { console.error('initJourneyScroll:', e); }
    try { init3DTextSplit(); } catch (e) { console.error('init3DTextSplit:', e); }
    try { initTextReveals(); } catch (e) { console.error('initTextReveals:', e); }
    try { initManifestoBeamCycle(); } catch (e) { console.error('initManifestoBeamCycle:', e); }
    try {
        if (document.getElementById('experiencia-3d')) {
            import('./product-3d').then(({ initProduct3DSection, cleanupProduct3D }) => {
                window.cleanupProduct3D = cleanupProduct3D;
                try { initProduct3DSection(); } catch (e) { console.error('initProduct3DSection:', e); }
            });
        } else if (typeof window.cleanupProduct3D === 'function') {
            window.cleanupProduct3D();
        }
    } catch (e) { console.error('initProduct3DSection:', e); }
    try {
        if (document.getElementById('mup3-presentation')) {
            import('./mup3-showcase').then(({ initMup3Showcase, cleanupMup3Showcase }) => {
                window.cleanupMup3Showcase = cleanupMup3Showcase;
                try { initMup3Showcase(); } catch (e) { console.error('initMup3Showcase:', e); }
            });
        } else if (typeof window.cleanupMup3Showcase === 'function') {
            window.cleanupMup3Showcase();
        }
    } catch (e) { console.error('initMup3Showcase:', e); }
    try { initProjectsSection(); } catch (e) { console.error('initProjectsSection:', e); }
    try { initProjectsFilterPage(); } catch (e) { console.error('initProjectsFilterPage:', e); }
}
window.initAllNorraComponents = initAllNorraComponents;

document.addEventListener('DOMContentLoaded', () => {
    try {
        initAllNorraComponents();
    } catch (e) {
        console.error('initAllNorraComponents:', e);
    }
    try {
        initPageTransition();
    } catch (e) {
        console.error('initPageTransition:', e);
    }
});


// 1. Header scroll effect (maintains solid #101010 black background with zero opacity)
function initHeaderScroll() {
    const header = document.getElementById('site-header');
    if (!header || header._headerScrollInitialized) return;
    header._headerScrollInitialized = true;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            header.classList.add('shadow-2xl');
        } else {
            header.classList.remove('shadow-2xl');
        }
    }, { passive: true });
}

// 2. Mobile Menu Drawer & Backdrop Blur with Smooth Transitions
function initMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('mobile-menu-backdrop');
    const openIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (!btn || !menu || btn._mobileMenuInitialized) return;
    btn._mobileMenuInitialized = true;

    let isOpen = false;

    const openMenu = () => {
        if (isOpen) return;
        isOpen = true;

        btn.setAttribute('aria-expanded', 'true');

        // Smoothly crossfade and rotate button icon
        if (openIcon && closeIcon) {
            openIcon.classList.add('opacity-0', '-rotate-90', 'pointer-events-none');
            openIcon.classList.remove('opacity-100', 'rotate-0');
            closeIcon.classList.remove('opacity-0', 'rotate-90', 'pointer-events-none');
            closeIcon.classList.add('opacity-100', 'rotate-0');
        }

        // Fade in backdrop
        if (backdrop) {
            backdrop.classList.remove('hidden');
            gsap.killTweensOf(backdrop);
            gsap.to(backdrop, {
                opacity: 1,
                duration: 0.35,
                ease: 'power2.out',
                onStart: () => {
                    backdrop.classList.remove('pointer-events-none');
                    backdrop.classList.add('pointer-events-auto');
                }
            });
        }

        // Prepare drawer and elements
        menu.classList.remove('hidden');
        gsap.killTweensOf(menu);

        const items = menu.querySelectorAll('.mobile-nav-item');
        const footer = menu.querySelector('#mobile-menu-footer');
        if (items.length) gsap.killTweensOf(items);
        if (footer) gsap.killTweensOf(footer);

        // Calculate natural height dynamically
        gsap.set(menu, { height: 'auto', opacity: 0 });
        const targetHeight = menu.offsetHeight;
        gsap.set(menu, { height: 0, opacity: 0 });

        // Animate drawer expanding smoothly
        gsap.to(menu, {
            height: targetHeight,
            opacity: 1,
            duration: 0.42,
            ease: 'norra-out',
            onComplete: () => {
                menu.style.height = 'auto';
            }
        });

        // Staggered smooth entrance for each page link
        if (items.length) {
            gsap.fromTo(items,
                { opacity: 0, y: 16 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.4,
                    stagger: 0.08,
                    ease: 'norra-out',
                    delay: 0.1
                }
            );
        }

        // Soft fade-in for footer contact info
        if (footer) {
            gsap.fromTo(footer,
                { opacity: 0, y: 10 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.35,
                    ease: 'power2.out',
                    delay: 0.32
                }
            );
        }
    };

    const closeMenu = () => {
        if (!isOpen) return;
        isOpen = false;

        btn.setAttribute('aria-expanded', 'false');

        // Restore hamburger icon
        if (openIcon && closeIcon) {
            openIcon.classList.remove('opacity-0', '-rotate-90', 'pointer-events-none');
            openIcon.classList.add('opacity-100', 'rotate-0');
            closeIcon.classList.add('opacity-0', 'rotate-90', 'pointer-events-none');
            closeIcon.classList.remove('opacity-100', 'rotate-0');
        }

        // Fade out backdrop
        if (backdrop) {
            gsap.killTweensOf(backdrop);
            gsap.to(backdrop, {
                opacity: 0,
                duration: 0.25,
                ease: 'power2.inOut',
                onComplete: () => {
                    backdrop.classList.add('hidden', 'pointer-events-none');
                    backdrop.classList.remove('pointer-events-auto');
                }
            });
        }

        const items = menu.querySelectorAll('.mobile-nav-item');
        const footer = menu.querySelector('#mobile-menu-footer');
        if (items.length) gsap.killTweensOf(items);
        if (footer) gsap.killTweensOf(footer);
        gsap.killTweensOf(menu);

        // Smoothly fade/slide items away
        if (items.length) {
            gsap.to(items, {
                opacity: 0,
                y: -8,
                duration: 0.2,
                ease: 'power2.in'
            });
        }

        // Smoothly collapse drawer
        gsap.to(menu, {
            height: 0,
            opacity: 0,
            duration: 0.3,
            ease: 'power2.inOut',
            onComplete: () => {
                menu.classList.add('hidden');
                gsap.set(menu, { clearProps: 'all' });
                if (items.length) gsap.set(items, { clearProps: 'all' });
                if (footer) gsap.set(footer, { clearProps: 'all' });
            }
        });
    };

    const toggleMenu = () => {
        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    };

    window.closeMobileMenuDirectly = () => {
        if (isOpen) {
            closeMenu();
        } else if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            backdrop?.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
            if (openIcon && closeIcon) {
                openIcon.classList.remove('opacity-0', '-rotate-90', 'pointer-events-none');
                openIcon.classList.add('opacity-100', 'rotate-0');
                closeIcon.classList.add('opacity-0', 'rotate-90', 'pointer-events-none');
                closeIcon.classList.remove('opacity-100', 'rotate-0');
            }
        }
    };

    btn.addEventListener('click', toggleMenu);

    if (backdrop) {
        backdrop.addEventListener('click', closeMenu);
    }

    // Close when clicking any mobile nav link (delegated on document so dynamically swapped links always close the menu)
    document.addEventListener('click', (e) => {
        const link = e.target.closest('.mobile-nav-link');
        if (link && isOpen) {
            closeMenu();
        }
    });

    // Close on escape key
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) {
            closeMenu();
        }
    });

    // Auto-close if resized to desktop viewport
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768 && isOpen) {
            closeMenu();
        }
    }, { passive: true });
}

// 3. Project Preview Modal (supports full website image or motion/demo video)
window.openProjectModal = function(data) {
    const modal = document.getElementById('project-modal');
    const card = document.getElementById('project-modal-card');
    const modalImg = document.getElementById('modal-image');
    const modalVideoContainer = document.getElementById('modal-video-container');
    const modalVideo = document.getElementById('modal-video');

    if (!modal) return;

    let project = {};
    if (typeof data === 'object' && data !== null) {
        project = data;
    } else {
        project = {
            title: arguments[0],
            imageUrl: arguments[5],
        };
    }

    const title = project.title || project.name || 'Projeto';
    const rawVideo = project.modal_video_url || project.modal_video || '';
    const rawImg = project.modal_image_url || project.full_image_url || project.mockup_image || project.cover_image || project.imageUrl || '';

    // Check if project has video for the modal popup (Motions, 3D animations, full video presentation)
    if (rawVideo && modalVideo && modalVideoContainer) {
        let resolvedVideo = rawVideo;
        if (!resolvedVideo.startsWith('http') && !resolvedVideo.startsWith('/')) {
            resolvedVideo = '/storage/' + resolvedVideo;
        }

        modalVideo.src = resolvedVideo;
        modalVideoContainer.classList.remove('hidden');
        if (modalImg) modalImg.classList.add('hidden');

        // Play video
        const playPromise = modalVideo.play();
        if (playPromise !== undefined) {
            playPromise.catch(() => {});
        }
    } else {
        if (modalVideoContainer) modalVideoContainer.classList.add('hidden');
        if (modalVideo) {
            modalVideo.pause();
            modalVideo.src = '';
        }

        if (modalImg) {
            let resolvedImg = rawImg;
            if (resolvedImg && !resolvedImg.startsWith('http') && !resolvedImg.startsWith('/')) {
                resolvedImg = '/storage/' + resolvedImg;
            }
            modalImg.src = resolvedImg || '';
            modalImg.alt = `Design completo do projeto ${title}`;
            modalImg.classList.remove('hidden');
        }
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Pause any background project highlight videos while modal is open
    document.querySelectorAll('.project-highlight-video').forEach((v) => {
        v.pause();
    });

    requestAnimationFrame(() => {
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
        if (card) {
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }
    });
};

window.closeProjectModal = function() {
    const modal = document.getElementById('project-modal');
    const card = document.getElementById('project-modal-card');
    const modalVideo = document.getElementById('modal-video');
    if (!modal) return;

    if (modalVideo) {
        modalVideo.pause();
        modalVideo.currentTime = 0;
    }

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    if (card) {
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
    }

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        const modalImg = document.getElementById('modal-image');
        if (modalImg) modalImg.src = '';
        if (modalVideo) modalVideo.src = '';
    }, 300);
};

function initModalKeyHandlers() {
    // 1. Delegated click handler for any project modal trigger button/link
    if (!document._projectModalTriggerInitialized) {
        document._projectModalTriggerInitialized = true;
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('[data-project-modal-trigger]');
            if (!trigger) return;

            e.preventDefault();
            e.stopPropagation();

            const rawData = trigger.getAttribute('data-project');
            if (!rawData) return;

            try {
                const project = JSON.parse(rawData);
                window.openProjectModal(project);
            } catch (err) {
                console.error('Failed to parse project modal data:', err);
            }
        });
    }

    const modal = document.getElementById('project-modal');
    if (!modal || modal._modalKeyHandlersInitialized) return;
    modal._modalKeyHandlersInitialized = true;

    let isPointerDownOnCard = false;

    modal.addEventListener('pointerdown', (e) => {
        const card = document.getElementById('project-modal-card');
        isPointerDownOnCard = card ? card.contains(e.target) : false;
    });

    window.addEventListener('pointerup', () => {
        setTimeout(() => {
            isPointerDownOnCard = false;
        }, 50);
    });

    modal.addEventListener('click', (e) => {
        // If the interaction started on the card, do not close (prevents closing on drag/select)
        if (isPointerDownOnCard) {
            isPointerDownOnCard = false;
            return;
        }

        // Avoid closing if clicking the scrollbar on the modal (Windows desktop)
        if (e.clientX >= modal.clientWidth || e.clientY >= modal.clientHeight) {
            return;
        }

        const card = document.getElementById('project-modal-card');
        if (!card || !card.contains(e.target)) {
            window.closeProjectModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            window.closeProjectModal();
        }
    });
}

// 3.1 Projects Section: Highlight Video (Hover on Desktop, Scroll In-View on Mobile/Tablet)
let projectsVideoObserver = null;

function isMobileOrTabletDevice() {
    return window.matchMedia('(hover: none), (pointer: coarse), (max-width: 1023px)').matches;
}

function playHighlightVideo(video) {
    if (!video) return;
    video.muted = true;
    video.playsInline = true;
    const playPromise = video.play();
    if (playPromise !== undefined) {
        playPromise.catch(() => {});
    }
    video.classList.remove('opacity-0');
    video.classList.add('opacity-100');
}

function pauseHighlightVideo(video) {
    if (!video) return;
    video.pause();
    video.currentTime = 0;
    video.classList.remove('opacity-100');
    video.classList.add('opacity-0');
}

export function initProjectsSection() {
    const cards = Array.from(document.querySelectorAll('.project-card, .project-grid-card'));
    if (!cards.length) return;

    if (projectsVideoObserver) {
        projectsVideoObserver.disconnect();
        projectsVideoObserver = null;
    }

    // Mobile & Tablet: auto-play video when project scrolls into view, pause when out of view
    if ('IntersectionObserver' in window) {
        projectsVideoObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const video = entry.target.querySelector('.project-highlight-video');
                if (!video) return;

                // Only auto-play on scroll for mobile and tablet devices
                if (!isMobileOrTabletDevice()) {
                    return;
                }

                if (entry.isIntersecting) {
                    playHighlightVideo(video);
                } else {
                    pauseHighlightVideo(video);
                }
            });
        }, {
            rootMargin: '-10% 0px -10% 0px',
            threshold: 0.15
        });
    }

    cards.forEach(card => {
        const video = card.querySelector('.project-highlight-video');
        if (!video) return;

        // Observe card for mobile/tablet scroll in-view playback
        if (projectsVideoObserver) {
            projectsVideoObserver.observe(card);
        }

        // Desktop: mouseenter / mouseleave hover playback
        if (!card._videoHoverListenersAttached) {
            card._videoHoverListenersAttached = true;

            card.addEventListener('mouseenter', () => {
                if (isMobileOrTabletDevice()) return;
                video.currentTime = 0;
                playHighlightVideo(video);
            });

            card.addEventListener('mouseleave', () => {
                if (isMobileOrTabletDevice()) return;
                pauseHighlightVideo(video);
            });
        }
    });
}
window.initProjectsSection = initProjectsSection;

// 3.2 Projects Filter & Dynamic Pagination Controller (Projects Page)
export function initProjectsFilterPage() {
    const filterContainer = document.getElementById('project-filters');
    const projectGrid = document.getElementById('projects-grid');
    if (!filterContainer || !projectGrid) return;

    const filterButtons = document.querySelectorAll('.project-filter-btn');
    const projectCards = Array.from(document.querySelectorAll('.project-grid-card'));
    const noProjectsMsg = document.getElementById('no-projects-found');
    const paginationContainer = document.getElementById('projects-pagination');

    if (!filterButtons.length || !projectCards.length) return;

    const ITEMS_PER_PAGE = 6;
    let currentFilter = 'all';
    let currentPage = 1;

    function getFilteredCards() {
        return projectCards.filter(card => {
            if (currentFilter === 'all') return true;

            let tags = [];
            try {
                tags = JSON.parse(card.getAttribute('data-tags') || '[]');
            } catch (e) {
                tags = [];
            }
            const category = card.getAttribute('data-category') || '';
            const title = card.getAttribute('data-title') || '';
            const allTerms = [...tags, category, title].map(t => (t || '').toLowerCase().trim());
            const filter = currentFilter.toLowerCase().trim();

            if (filter === 'website' || filter === 'web site' || filter === 'web') {
                return allTerms.some(t => t.includes('web') || t.includes('site'));
            }
            if (filter === 'aplicativo' || filter === 'app' || filter === 'application' || filter === 'mobile') {
                return allTerms.some(t => t.includes('app') || t.includes('aplicativo') || t.includes('ui/ux') || t.includes('frontend'));
            }
            if (filter === 'design 3d' || filter === '3d' || filter === '3d design' || filter === 'motion') {
                return allTerms.some(t => t.includes('3d') || t.includes('motion'));
            }

            return allTerms.some(t => t === filter || t.includes(filter));
        });
    }

    function renderPagination(totalItems) {
        if (!paginationContainer) return;
        const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

        // If 6 or fewer projects, deactivate/hide pagination
        if (totalItems <= ITEMS_PER_PAGE || totalPages <= 1) {
            paginationContainer.innerHTML = '';
            paginationContainer.classList.add('opacity-0', 'pointer-events-none');
            return;
        }

        paginationContainer.classList.remove('opacity-0', 'pointer-events-none');
        let html = '';

        for (let i = 1; i <= totalPages; i++) {
            const isActive = (i === currentPage);
            if (isActive) {
                html += `<button type="button" class="w-[17px] h-[17px] bg-[#101010] text-[#ddddd5] flex items-center justify-center font-sans font-bold text-[13.6px] leading-none select-none border-none p-0 cursor-default" aria-current="page">${i}</button>`;
            } else {
                html += `<button type="button" data-page="${i}" class="project-page-btn w-[17px] h-[17px] text-[#101010] hover:text-[#b70606] flex items-center justify-center font-sans font-bold text-[13.6px] leading-none select-none cursor-pointer transition-colors border-none bg-transparent p-0">${i}</button>`;
            }
        }

        paginationContainer.innerHTML = html;
    }

    function updateDisplay(scrollUp = false) {
        const matchingCards = getFilteredCards();
        const totalMatching = matchingCards.length;
        const totalPages = Math.max(1, Math.ceil(totalMatching / ITEMS_PER_PAGE));

        if (currentPage > totalPages) {
            currentPage = 1;
        }

        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;

        // Update cards visibility
        projectCards.forEach(card => {
            const indexInMatching = matchingCards.indexOf(card);
            const isVisible = (indexInMatching >= startIndex && indexInMatching < endIndex);

            if (isVisible) {
                card.style.display = '';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 20);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(8px)';
                setTimeout(() => {
                    if (!matchingCards.includes(card) || matchingCards.indexOf(card) < startIndex || matchingCards.indexOf(card) >= endIndex) {
                        card.style.display = 'none';
                    }
                }, 200);
            }
        });

        // Empty state
        if (noProjectsMsg) {
            if (totalMatching === 0) {
                setTimeout(() => {
                    noProjectsMsg.classList.remove('hidden');
                }, 210);
            } else {
                noProjectsMsg.classList.add('hidden');
            }
        }

        renderPagination(totalMatching);

        // Re-observe visible project cards for mobile/tablet in-view video autoplay
        if (typeof window.initProjectsSection === 'function') {
            window.initProjectsSection();
        }

        // Refresh GSAP ScrollTrigger so the CTA pin accounts for new content height
        if (typeof ScrollTrigger !== 'undefined') {
            setTimeout(() => {
                ScrollTrigger.refresh();
            }, 250);
        }

        if (scrollUp) {
            const target = document.getElementById('todos-projetos');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }

    function setFilter(selectedCategory) {
        currentFilter = selectedCategory;
        currentPage = 1;

        filterButtons.forEach(btn => {
            const category = btn.getAttribute('data-filter');
            const isActive = (category.toLowerCase() === selectedCategory.toLowerCase());

            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            if (isActive) {
                btn.classList.remove('text-[#808080]');
                btn.classList.add('text-[#101010]');
            } else {
                btn.classList.remove('text-[#101010]');
                btn.classList.add('text-[#808080]');
            }
        });

        updateDisplay(false);
    }

    window.goToPage = function(pageNum) {
        currentPage = pageNum;
        updateDisplay(true);
    };

    window.resetProjectFilter = function() {
        setFilter('all');
    };

    // Attach click listeners to filter buttons
    filterButtons.forEach(button => {
        button.onclick = function() {
            const filter = this.getAttribute('data-filter');
            setFilter(filter);
        };
    });

    // Pagination delegated click handling
    if (paginationContainer) {
        paginationContainer.onclick = function(e) {
            const pageBtn = e.target.closest('.project-page-btn');
            if (pageBtn) {
                const pageNum = parseInt(pageBtn.getAttribute('data-page'), 10);
                if (!isNaN(pageNum)) {
                    window.goToPage(pageNum);
                }
            }
        };
    }

    // Reset filter button in empty state
    const resetBtn = document.getElementById('reset-project-filter-btn');
    if (resetBtn) {
        resetBtn.onclick = function() {
            window.resetProjectFilter();
        };
    }

    // Check if query param exists (e.g. ?filtro=Website)
    const urlParams = new URLSearchParams(window.location.search);
    const initialFilter = urlParams.get('filtro') || urlParams.get('categoria') || urlParams.get('servico');
    if (initialFilter) {
        setFilter(initialFilter);
    } else {
        updateDisplay(false);
    }
}
window.initProjectsFilterPage = initProjectsFilterPage;

// 4. Toast Notifications
window.showToast = function(title, message, isError = false) {
    const toast = document.getElementById('norra-toast');
    const toastCard = document.getElementById('norra-toast-card');
    const toastTitle = document.getElementById('norra-toast-title');
    const toastMsg = document.getElementById('norra-toast-msg');
    const toastIcon = document.getElementById('norra-toast-icon');

    if (!toast || !toastTitle || !toastMsg) return;

    toastTitle.textContent = title;
    toastMsg.textContent = message;

    if (toastIcon) {
        if (isError) {
            toastIcon.innerHTML = `<svg class="w-6 h-6 text-[#b70606]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`;
            if (toastCard) toastCard.className = 'bg-[#181212] border border-[#b70606]/40 rounded-2xl p-4 shadow-2xl flex items-start space-x-3 pointer-events-auto';
        } else {
            toastIcon.innerHTML = `<svg class="w-6 h-6 text-[#25d366]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`;
            if (toastCard) toastCard.className = 'bg-[#121812] border border-[#25d366]/40 rounded-2xl p-4 shadow-2xl flex items-start space-x-3 pointer-events-auto';
        }
    }

    toast.classList.remove('-translate-y-24', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');

    setTimeout(() => {
        window.hideToast();
    }, 5000);
};

window.hideToast = function() {
    const toast = document.getElementById('norra-toast');
    if (!toast) return;
    toast.classList.remove('translate-y-0', 'opacity-100');
    toast.classList.add('-translate-y-24', 'opacity-0');
};

// 5. AJAX Contact Form Submission
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form || form._contactFormInitialized) return;
    form._contactFormInitialized = true;

    form.addEventListener('submit', async (e) => {
        // Only intercept if fetch is available
        if (window.fetch) {
            e.preventDefault();

            const submitBtn = document.getElementById('drawer-submit-btn') || document.getElementById('submit-btn');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            const isEn = document.documentElement.lang === 'en';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline-block" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>${isEn ? 'Sending...' : 'Enviando...'}</span>
                `;
            }

            try {
                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    const successTitle = isEn ? 'Message Sent!' : 'Mensagem Enviada!';
                    const successDefault = isEn ? 'We have received your details successfully. We will get in touch within 24 hours!' : 'Recebemos suas informações com sucesso. Em até 24 horas entraremos em contato!';
                    window.showToast(successTitle, data.message || successDefault, false);
                    form.reset();
                    if (typeof window.closeContactModal === 'function') {
                        setTimeout(window.closeContactModal, 1200);
                    }
                } else {
                    const errorTitle = isEn ? 'Error Sending' : 'Erro no Envio';
                    const errorDefault = isEn ? 'An error occurred while sending your message. Please try again.' : 'Ocorreu um erro ao enviar sua mensagem. Tente novamente.';
                    const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(', ') : errorDefault);
                    window.showToast(errorTitle, errorMsg, true);
                }
            } catch (err) {
                // Fallback to regular submit if fetch throws network error
                form.submit();
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            }
        }
    });
}

// 6. GSAP Hero Floating Mockups Parallax
function initHeroParallax() {
    const floatLeft = document.querySelector('.hero-float-left');
    const floatRight = document.querySelector('.hero-float-right');
    const floatBottomRight = document.querySelector('.hero-float-bottom-right');

    const mm = gsap.matchMedia();
    mm.add('(min-width: 768px)', () => {
        if (floatLeft) {
            gsap.to(floatLeft, {
                y: -20,
                rotation: -2,
                ease: 'power1.out',
                scrollTrigger: {
                    trigger: '#hero',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 1.5,
                },
            });
        }

        if (floatRight) {
            gsap.to(floatRight, {
                y: 20,
                rotation: -6,
                ease: 'power1.out',
                scrollTrigger: {
                    trigger: '#hero',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 1.5,
                },
            });
        }

        if (floatBottomRight) {
            gsap.to(floatBottomRight, {
                y: -15,
                rotation: 3,
                ease: 'power1.out',
                scrollTrigger: {
                    trigger: '#hero',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 1.5,
                },
            });
        }
    });
}

// 7. GSAP ScrollTrigger Pinned Horizontal Scroll for Jornada do Projeto
function initJourneyScroll() {
    const section = document.querySelector('.journey-section');
    const container = document.querySelector('.journey-horizontal-container');
    const track = document.querySelector('.journey-track');

    if (!section || !container || !track) return;

    const mm = gsap.matchMedia();

    mm.add('(min-width: 0px)', () => {
        const getScrollDistance = () => {
            const stages = track.querySelectorAll('.journey-stage-item');
            if (stages.length >= 2) {
                return stages[stages.length - 1].offsetLeft - stages[0].offsetLeft;
            }
            return track.scrollWidth - window.innerWidth;
        };

        // Synchronize stage description heights to align titles and media to identical bottom baseline (desktop xl+ only)
        const syncStageBaselines = () => {
            if (window.innerWidth < 1280) {
                const descs = track.querySelectorAll('.journey-desc-text');
                descs.forEach((d) => { d.style.minHeight = ''; });
                return;
            }
            const descs = Array.from(track.querySelectorAll('.journey-desc-text'));
            if (!descs.length) return;
            descs.forEach((d) => { d.style.minHeight = ''; });
            let maxHeight = 0;
            descs.forEach((d) => {
                const h = d.getBoundingClientRect().height;
                if (h > maxHeight) maxHeight = h;
            });
            if (maxHeight > 0) {
                descs.forEach((d) => {
                    d.style.minHeight = `${maxHeight}px`;
                });
            }
        };

        syncStageBaselines();
        window.addEventListener('resize', syncStageBaselines);
        if (document.fonts?.ready) {
            document.fonts.ready.then(() => {
                syncStageBaselines();
                ScrollTrigger.refresh();
            });
        }

        // Autoplay stage video when active/in-view during horizontal scroll
        const checkActiveVideos = () => {
            const items = track.querySelectorAll('.journey-stage-item');
            items.forEach((item) => {
                const rect = item.getBoundingClientRect();
                const video = item.querySelector('.journey-stage-video');
                if (!video) return;
                const isVisible = rect.left < window.innerWidth * 0.7 && rect.right > window.innerWidth * 0.3;
                if (isVisible) {
                    if (video.paused) {
                        const playPromise = video.play();
                        if (playPromise !== undefined) playPromise.catch(() => {});
                    }
                } else {
                    if (!video.paused) {
                        video.pause();
                    }
                }
            });
        };

        // Fluid continuous transition without jerk/click
        const isMobile = window.innerWidth < 768;
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: () => `+=${getScrollDistance() * (window.innerWidth >= 1024 ? 1.25 : (window.innerWidth >= 768 ? 1.2 : 1.1))}`,
                pin: true,
                pinSpacing: true,
                scrub: isMobile ? 0.6 : 0.8,
                invalidateOnRefresh: true,
                anticipatePin: 1,
                onEnter: checkActiveVideos,
                onEnterBack: checkActiveVideos,
                onLeave: () => {
                    track.querySelectorAll('.journey-stage-video').forEach((v) => v.pause());
                },
                onLeaveBack: () => {
                    track.querySelectorAll('.journey-stage-video').forEach((v) => v.pause());
                },
            },
        });

        tl.to(track, {
            x: () => -getScrollDistance(),
            ease: 'none',
            onUpdate: checkActiveVideos,
        });

        checkActiveVideos();

        return () => {
            window.removeEventListener('resize', syncStageBaselines);
            const descs = track.querySelectorAll('.journey-desc-text');
            descs.forEach((d) => { d.style.minHeight = ''; });
            track.querySelectorAll('.journey-stage-video').forEach((v) => v.pause());
        };
    });
}

// 8. Section-Level Synchronized Reveal Manager
// When user reaches any section, the entire section and all its contents (reveals, lines, split text, signature) are rendered immediately!
window.revealSection = function(section) {
    if (!section || section.dataset.norraRevealed === 'true') return;
    section.dataset.norraRevealed = 'true';

    // 1. Reveal all .norra-reveal elements inside this section immediately
    const reveals = section.querySelectorAll('.norra-reveal');
    reveals.forEach((el) => {
        el.classList.add('is-revealed');
    });

    // 2. Reveal all .services-list inside this section
    const servicesLists = section.querySelectorAll('.services-list');
    servicesLists.forEach((list) => {
        list.classList.add('is-revealed');
    });

    // 3. Play any SplitText animations registered for this section
    if (section._splitTweens && section._splitTweens.length) {
        section._splitTweens.forEach((tween) => {
            if (tween && typeof tween.play === 'function') {
                tween.play();
            }
        });
    }
};

function initTextReveals() {
    const allSections = document.querySelectorAll('section, footer');

    // Reveal any sections currently visible or partially visible in viewport
    const checkSectionsInView = () => {
        allSections.forEach((section) => {
            const rect = section.getBoundingClientRect();
            // If any part of the section has entered viewport (top < 92% of screen and bottom > 0)
            if (rect.top < window.innerHeight * 0.92 && rect.bottom > 0) {
                window.revealSection(section);
            }
        });

        // Also check any orphan .norra-reveal elements not inside a section or footer
        document.querySelectorAll('.norra-reveal:not(.is-revealed)').forEach((el) => {
            const parentSection = el.closest('section, footer');
            if (!parentSection) {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.92) {
                    el.classList.add('is-revealed');
                }
            }
        });
    };

    // Run check on load, preloader done, and fallbacks
    checkSectionsInView();
    window.addEventListener('norra-preloader-done', () => {
        setTimeout(checkSectionsInView, 100);
    });
    setTimeout(checkSectionsInView, 1000);

    // Scroll listener for instant responsiveness
    window.addEventListener('scroll', checkSectionsInView, { passive: true });

    // ScrollTrigger for every section: when the section top reaches 85% of screen, reveal whole section
    allSections.forEach((section) => {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 85%',
            onEnter: () => window.revealSection(section),
            onEnterBack: () => window.revealSection(section),
            once: true,
        });

        // Also if ANY child reveal element inside the section enters early (top 90%), reveal the whole section!
        const childTriggers = section.querySelectorAll('.norra-reveal, [data-split], .services-list');
        childTriggers.forEach((child) => {
            ScrollTrigger.create({
                trigger: child,
                start: 'top 90%',
                onEnter: () => window.revealSection(section),
                once: true,
            });
        });
    });

    // Anchor link clicks: instantly reveal target section and smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const targetId = anchor.getAttribute('href');
            if (targetId && targetId !== '#') {
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    const parentSection = target.closest('section, footer') || target;
                    window.revealSection(parentSection);
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
}

// 9. 3D Masked Text Reveal (Nog Arquitetura project.blade.php & nog-orchestrator.js formula)
function init3DTextSplit() {
    const elements = document.querySelectorAll('[data-split]');
    if (!elements.length) return;

    elements.forEach((element) => {
        const section = element.closest('section, footer') || element;
        if (!section._splitTweens) {
            section._splitTweens = [];
        }

        try {
            const split = SplitText.create(element, {
                type: 'lines,words',
                autoSplit: true,
                aria: 'auto',
            });

            if (!split.words || !split.words.length) return;

            // Stagger sequential splits in the same section slightly (e.g. h2 then p)
            const splitIndexInSection = section._splitTweens.length;
            const delay = splitIndexInSection * 0.12;

            const tween = gsap.from(split.words, {
                opacity: 0,
                y: 28,
                rotateX: -20,
                transformOrigin: '50% 100%',
                duration: 0.95,
                delay: delay,
                stagger: { each: 0.025, from: 'start' },
                ease: 'norra-out',
                paused: true, // Controlled by section reveal
                onComplete: () => {
                    gsap.set(split.words, { clearProps: 'transform,opacity,rotateX' });
                },
            });

            section._splitTweens.push(tween);

            // If section was already revealed, play immediately
            if (section.dataset.norraRevealed === 'true') {
                tween.play();
            }
        } catch (e) {
            console.warn('SplitText initialization fallback:', e);
        }
    });
}

// 10. Manifesto Synchronized Slow Progress Bar & Stat Cycling
let manifestoProgressTween = null;
const MANIFESTO_CYCLE_DURATION = 5.5; // Duração lenta do carregamento em segundos

window.updateManifestoStatToIndex = function(newIndex) {
    const block = document.getElementById('manifesto-stat-block');
    const num = document.getElementById('manifesto-stat-num');
    const label = document.getElementById('manifesto-stat-label');
    if (!block || !num || !label) return;

    const stats = JSON.parse(block.getAttribute('data-stats') || '[]');
    if (!stats.length) return;

    const idx = (newIndex + stats.length) % stats.length;
    block.setAttribute('data-index', idx);

    gsap.to([num, label], {
        y: -12,
        opacity: 0,
        duration: 0.22,
        ease: 'power2.in',
        onComplete: () => {
            num.textContent = stats[idx].num;
            label.textContent = stats[idx].label;
            gsap.fromTo([num, label], {
                y: 12,
                opacity: 0,
            }, {
                y: 0,
                opacity: 1,
                duration: 0.35,
                ease: 'norra-out',
            });
        },
    });
};

function startManifestoLoadingCycle() {
    const fill = document.getElementById('manifesto-progress-fill');
    const block = document.getElementById('manifesto-stat-block');
    if (!fill || !block) return;

    if (manifestoProgressTween) {
        manifestoProgressTween.kill();
    }

    const isMobile = window.innerWidth < 768;

    if (isMobile) {
        // Mobile: Horizontal progress bar (fills from left to right)
        gsap.set(fill, {
            width: '0%',
            height: '100%',
            transformOrigin: 'left center',
        });

        manifestoProgressTween = gsap.to(fill, {
            width: '100%',
            duration: MANIFESTO_CYCLE_DURATION,
            ease: 'none',
            onComplete: () => {
                const currentIdx = parseInt(block.getAttribute('data-index') || '0', 10);
                window.updateManifestoStatToIndex(currentIdx + 1);

                gsap.delayedCall(0.2, () => {
                    startManifestoLoadingCycle();
                });
            },
        });
    } else {
        // Desktop: Vertical progress bar (fills from top to bottom)
        gsap.set(fill, {
            height: '0%',
            width: '100%',
            transformOrigin: 'top center',
        });

        manifestoProgressTween = gsap.to(fill, {
            height: '100%',
            duration: MANIFESTO_CYCLE_DURATION,
            ease: 'none',
            onComplete: () => {
                const currentIdx = parseInt(block.getAttribute('data-index') || '0', 10);
                window.updateManifestoStatToIndex(currentIdx + 1);

                gsap.delayedCall(0.2, () => {
                    startManifestoLoadingCycle();
                });
            },
        });
    }
}

window.cycleManifestoStatNext = function() {
    const block = document.getElementById('manifesto-stat-block');
    if (!block) return;
    const currentIdx = parseInt(block.getAttribute('data-index') || '0', 10);
    window.updateManifestoStatToIndex(currentIdx + 1);
    startManifestoLoadingCycle();
};

window.cycleManifestoStatPrev = function() {
    const block = document.getElementById('manifesto-stat-block');
    if (!block) return;
    const currentIdx = parseInt(block.getAttribute('data-index') || '0', 10);
    window.updateManifestoStatToIndex(currentIdx - 1);
    startManifestoLoadingCycle();
};

function initManifestoBeamCycle() {
    const section = document.getElementById('manifesto');
    const fill = document.getElementById('manifesto-progress-fill');
    if (!section || !fill) return;

    // Start cycle when section is visible or DOM is ready
    startManifestoLoadingCycle();

    // Adapt cleanly when resizing across mobile / desktop & tablet breakpoints (< 768px)
    let isLastMobile = window.innerWidth < 768;
    window.addEventListener('resize', () => {
        const currentMobile = window.innerWidth < 768;
        if (currentMobile !== isLastMobile) {
            isLastMobile = currentMobile;
            startManifestoLoadingCycle();
        }
    });

    // Pause / resume on tab visibility change
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            manifestoProgressTween?.pause();
        } else {
            manifestoProgressTween?.resume();
        }
    });
}

// 12. Dynamic Adaptive Contrast Controller for Floating WhatsApp Button
function initFloatingWhatsApp() {
    const btn = document.getElementById('whatsapp-floating-btn');
    if (!btn || btn._waInitialized) return;
    btn._waInitialized = true;

    const checkContrast = () => {
        const rect = btn.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        let isLight = false;

        // 1. Check if over Footer (always Light #ddddd5)
        const footer = document.querySelector('footer');
        const footerRect = footer?.getBoundingClientRect();
        if (footerRect && centerY >= footerRect.top && centerY <= footerRect.bottom) {
            isLight = true;
        }
        // 2. Check if over CTA section (#contato - always Dark #101010; takes precedence over pinned background sections)
        else {
            const cta = document.getElementById('contato');
            const ctaRect = cta?.getBoundingClientRect();
            if (ctaRect && centerY >= ctaRect.top && centerY <= ctaRect.bottom) {
                isLight = false;
            }
            // 3. Check if over Home "Projetos Selecionados" section (#projetos - Light #ddddd5)
            else {
                const projetos = document.getElementById('projetos');
                const projetosRect = projetos?.getBoundingClientRect();
                if (projetosRect && centerY >= projetosRect.top && centerY <= projetosRect.bottom) {
                    isLight = true;
                }
                // 4. Check if over Projects Page section (#todos-projetos - Light #ddddd5)
                else {
                    const todosProjetos = document.getElementById('todos-projetos');
                    const todosProjetosRect = todosProjetos?.getBoundingClientRect();
                    if (todosProjetosRect && centerY >= todosProjetosRect.top && centerY <= todosProjetosRect.bottom) {
                        isLight = true;
                    }
                    // 5. Fallback: query any other element marked with data-bg="light"
                    else {
                        const otherLight = document.querySelectorAll('[data-bg="light"]:not(#todos-projetos):not(#projetos):not(footer)');
                        for (let i = 0; i < otherLight.length; i++) {
                            const elRect = otherLight[i].getBoundingClientRect();
                            if (centerY >= elRect.top && centerY <= elRect.bottom && centerX >= elRect.left && centerX <= elRect.right) {
                                isLight = true;
                                break;
                            }
                        }
                    }
                }
            }
        }

        if (isLight) {
            btn.classList.add('is-light-bg');
            btn.classList.remove('is-dark-bg');
        } else {
            btn.classList.add('is-dark-bg');
            btn.classList.remove('is-light-bg');
        }
    };

    let ticking = false;
    const onScroll = () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                checkContrast();
                ticking = false;
            });
            ticking = true;
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', checkContrast, { passive: true });

    if (window.ScrollTrigger) {
        ScrollTrigger.addEventListener('scrollEnd', checkContrast);
    }

    // Initial checks and lifecycle triggers
    checkContrast();
    setTimeout(checkContrast, 150);
    setTimeout(checkContrast, 500);
    setTimeout(checkContrast, 1000);
    window.addEventListener('norra-preloader-done', () => setTimeout(checkContrast, 100));
}
window.initFloatingWhatsApp = initFloatingWhatsApp;




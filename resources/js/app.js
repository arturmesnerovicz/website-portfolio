// Estúdio Norra - Frontend Interactions & GSAP Animations
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { CustomEase } from 'gsap/CustomEase';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, CustomEase, SplitText);
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Authentic Norra cubic-bezier ease matching Nog Arquitetura
CustomEase.create('norra-out', 'M0,0 C0.16,1 0.3,1 1,1');

document.addEventListener('DOMContentLoaded', () => {
    initHeaderScroll();
    initMobileMenu();
    initContactForm();
    initModalKeyHandlers();
    initHeroParallax();
    initJourneyScroll();
    initFaqCtaTransition();
    initTextReveals();
    init3DTextSplit();
    initManifestoBeamCycle();
    initProjectsSection();
});


// 1. Header scroll effect
function initHeaderScroll() {
    const header = document.getElementById('site-header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            header.classList.add('bg-[#101010]/95', 'shadow-2xl');
            header.classList.remove('bg-[#101010]/80');
        } else {
            header.classList.remove('bg-[#101010]/95', 'shadow-2xl');
            header.classList.add('bg-[#101010]/80');
        }
    }, { passive: true });
}

// 2. Mobile Menu Drawer
function initMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const openIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (!btn || !menu) return;

    const toggleMenu = () => {
        const isClosed = menu.classList.contains('hidden');
        if (isClosed) {
            menu.classList.remove('hidden');
            openIcon?.classList.add('hidden');
            closeIcon?.classList.remove('hidden');
            btn.setAttribute('aria-expanded', 'true');
        } else {
            menu.classList.add('hidden');
            openIcon?.classList.remove('hidden');
            closeIcon?.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
        }
    };

    btn.addEventListener('click', toggleMenu);

    // Close when clicking any nav link
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.add('hidden');
            openIcon?.classList.remove('hidden');
            closeIcon?.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
        });
    });
}

// 3. Project Preview Modal
window.openProjectModal = function(title, client, year, category, description, imageUrl, tags) {
    const modal = document.getElementById('project-modal');
    const card = document.getElementById('project-modal-card');
    const modalTitle = document.getElementById('modal-title');
    const modalClient = document.getElementById('modal-client');
    const modalYear = document.getElementById('modal-year');
    const modalCategory = document.getElementById('modal-category');
    const modalDesc = document.getElementById('modal-description');
    const modalImg = document.getElementById('modal-image');
    const modalTags = document.getElementById('modal-tags');

    if (!modal) return;

    if (modalTitle) modalTitle.textContent = title || '';
    if (modalClient) modalClient.textContent = client || '';
    if (modalYear) modalYear.textContent = year || '';
    if (modalCategory) modalCategory.textContent = category || 'Web Design';
    if (modalDesc) modalDesc.textContent = description || '';
    if (modalImg) {
        modalImg.src = imageUrl || '';
        modalImg.alt = title || 'Projeto';
    }

    if (modalTags) {
        modalTags.innerHTML = '';
        if (Array.isArray(tags)) {
            tags.forEach(tag => {
                const badge = document.createElement('span');
                badge.className = 'px-3 py-1 rounded-full text-xs font-medium bg-[#101010] border border-white/10 text-[#ddddd5]';
                badge.textContent = tag;
                modalTags.appendChild(badge);
            });
        }
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

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
    if (!modal) return;

    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    if (card) {
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
    }

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
};

function initModalKeyHandlers() {
    const modal = document.getElementById('project-modal');
    if (!modal) return;

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            window.closeProjectModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            window.closeProjectModal();
        }
    });
}

// 3.1 Projects Section: Highlight Video Hover
function initProjectsSection() {
    const cards = Array.from(document.querySelectorAll('.project-card'));
    if (!cards.length) return;

    // Highlight Video on Hover (plays on enter, resets on leave)
    cards.forEach(card => {
        const video = card.querySelector('.project-highlight-video');
        if (!video) return;

        card.addEventListener('mouseenter', () => {
            video.currentTime = 0;
            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(() => {});
            }
            video.classList.remove('opacity-0');
            video.classList.add('opacity-100');
        });

        card.addEventListener('mouseleave', () => {
            video.pause();
            video.currentTime = 0;
            video.classList.remove('opacity-100');
            video.classList.add('opacity-0');
        });
    });
}

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
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        // Only intercept if fetch is available
        if (window.fetch) {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-btn');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Enviando...</span>
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
                    window.showToast('Mensagem Enviada!', data.message || 'Recebemos suas informações com sucesso. Em até 24 horas entraremos em contato!', false);
                    form.reset();
                } else {
                    const errorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(', ') : 'Ocorreu um erro ao enviar sua mensagem. Tente novamente.');
                    window.showToast('Erro no Envio', errorMsg, true);
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
                y: -30,
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
                y: 40,
                rotation: -8,
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
                y: -25,
                rotation: 4,
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

    // Mobile / IntersectionObserver Autoplay
    const allJourneyVideos = section.querySelectorAll('.journey-stage-video');
    if (allJourneyVideos.length && 'IntersectionObserver' in window) {
        const mobObserver = new IntersectionObserver((entries) => {
            if (window.innerWidth >= 1024) return; // Desktop handled by GSAP
            entries.forEach((entry) => {
                const vid = entry.target;
                if (entry.isIntersecting) {
                    const playPromise = vid.play();
                    if (playPromise !== undefined) playPromise.catch(() => {});
                } else {
                    vid.pause();
                }
            });
        }, { threshold: 0.35 });

        allJourneyVideos.forEach((v) => mobObserver.observe(v));
    }

    const mm = gsap.matchMedia();

    mm.add('(min-width: 1024px)', () => {
        const getScrollDistance = () => {
            const stages = track.querySelectorAll('.journey-stage-item');
            if (stages.length >= 2) {
                return stages[stages.length - 1].offsetLeft - stages[0].offsetLeft;
            }
            return track.scrollWidth - window.innerWidth;
        };

        // Synchronize stage description heights to align titles and media to identical bottom baseline
        const syncStageBaselines = () => {
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
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: () => `+=${getScrollDistance() * 1.25}`,
                pin: true,
                scrub: 0.8,
                invalidateOnRefresh: true,
                anticipatePin: 0,
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
            ease: 'power1.inOut',
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

// 8. Editorial Blur-and-Rise Reveal Animations (estudionorra.com signature)
function initTextReveals() {
    const reveals = document.querySelectorAll('.norra-reveal');
    if (!reveals.length) return;

    const revealVisible = () => {
        reveals.forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.92) {
                el.classList.add('is-revealed');
            }
        });
    };

    window.addEventListener('norra-preloader-done', () => {
        setTimeout(revealVisible, 150);
    });

    // Fallback if preloader already finished or not present
    setTimeout(revealVisible, 1200);

    // ScrollTrigger for all elements
    reveals.forEach((el) => {
        ScrollTrigger.create({
            trigger: el,
            start: 'top 88%',
            onEnter: () => el.classList.add('is-revealed'),
            once: true,
        });
    });

    // ScrollTrigger for Service Separator Lines (corygrossman.co style left-to-right entrance)
    const servicesList = document.querySelector('.services-list');
    if (servicesList) {
        ScrollTrigger.create({
            trigger: servicesList,
            start: 'top 85%',
            onEnter: () => servicesList.classList.add('is-revealed'),
            once: true,
        });
    }
}

// 9. 3D Masked Text Reveal (Nog Arquitetura project.blade.php & nog-orchestrator.js formula)
function init3DTextSplit() {
    const elements = document.querySelectorAll('[data-split]');
    if (!elements.length) return;

    elements.forEach((element) => {
        try {
            const split = SplitText.create(element, {
                type: 'lines,words',
                mask: 'lines',
                autoSplit: true,
                aria: 'auto',
            });

            if (!split.words || !split.words.length) return;

            gsap.from(split.words, {
                yPercent: 118,
                rotateX: -42,
                transformOrigin: '50% 100%',
                duration: 1.05,
                stagger: { each: 0.035, from: 'start' },
                ease: 'norra-out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 85%',
                    once: true,
                },
                onComplete: () => {
                    gsap.set(split.words, { clearProps: 'transform,opacity,willChange' });
                    split.revert();
                },
            });
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

    // Reset fill height to 0%
    gsap.set(fill, { height: '0%' });

    // Slow, progressive, continuous fill from top to bottom
    manifestoProgressTween = gsap.to(fill, {
        height: '100%',
        duration: MANIFESTO_CYCLE_DURATION,
        ease: 'none',
        onComplete: () => {
            // ONLY after loading completes 100%, switch to the next stat
            const currentIdx = parseInt(block.getAttribute('data-index') || '0', 10);
            window.updateManifestoStatToIndex(currentIdx + 1);

            // Subtle delay before next cycle begins
            gsap.delayedCall(0.2, () => {
                startManifestoLoadingCycle();
            });
        },
    });
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

    // Pause / resume on tab visibility change
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            manifestoProgressTween?.pause();
        } else {
            manifestoProgressTween?.resume();
        }
    });
}

// 12. Fluid FAQ to CTA Scroll Transition (Storey Architecture style)
function initFaqCtaTransition() {
    const faqSection = document.getElementById('faq');
    const ctaSection = document.getElementById('contato');

    if (!faqSection || !ctaSection) return;

    const faqInner = faqSection.querySelector('.faq-inner-container') || faqSection;
    const faqOverlay = faqSection.querySelector('.faq-dim-overlay');

    const mm = gsap.matchMedia();

    // Desktop and Tablet transition
    mm.add('(min-width: 768px)', () => {
        // Pin FAQ at bottom of viewport so CTA smoothly ascends over it
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: faqSection,
                start: 'bottom bottom',
                end: '+=100%',
                pin: true,
                pinSpacing: true,
                scrub: 0.8,
                anticipatePin: 1,
                invalidateOnRefresh: true,
            },
        });

        // 1. FAQ recedes: translates slightly upward, subtle scale down, and atmospheric dim
        tl.to(faqInner, {
            y: -100,
            scale: 0.96,
            ease: 'none',
        }, 0);

        if (faqOverlay) {
            tl.to(faqOverlay, {
                opacity: 0.65,
                ease: 'none',
            }, 0);
        }
    });

    // Mobile transition (< 768px)
    mm.add('(max-width: 767px)', () => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: faqSection,
                start: 'bottom bottom',
                end: '+=100%',
                pin: true,
                pinSpacing: true,
                scrub: 0.6,
                anticipatePin: 1,
                invalidateOnRefresh: true,
            },
        });

        tl.to(faqInner, {
            y: -40,
            scale: 0.98,
            ease: 'none',
        }, 0);

        if (faqOverlay) {
            tl.to(faqOverlay, {
                opacity: 0.5,
                ease: 'none',
            }, 0);
        }
    });
}



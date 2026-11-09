<div id="contact-modal"
     class="fixed inset-0 z-50 pointer-events-none hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="contact-drawer-title">

    <!-- Blurred Ambient Backdrop covering the rest of the site (OH Architecture smooth fade) -->
    <div id="contact-drawer-backdrop"
         onclick="closeContactModal()"
         class="absolute inset-0 bg-[#101010]/75 backdrop-blur-[16px] opacity-0 cursor-pointer pointer-events-none"
         aria-hidden="true"></div>

    <!-- Lateral Right-docked Form Drawer matching Penpot & OH Architecture clip-path reveal -->
    <div id="contact-modal-card"
         class="absolute top-0 right-0 bottom-0 h-full w-full max-w-[31.375rem] bg-[#ddddd5] text-[#101010] shadow-2xl flex flex-col justify-between z-10 overflow-y-auto overscroll-contain selection:bg-[#b70606] selection:text-white pointer-events-auto">

        <div class="w-full px-6 sm:px-[32.5px] pt-8 sm:pt-[42px] pb-8 sm:pb-[42px] flex flex-col min-h-full justify-between">
            <div>
                <!-- Top Row: Title & Minimalist Close Button -->
                <div class="flex items-start justify-between gap-4">
                    <div class="split-parent flex-1">
                        <h2 id="contact-drawer-title"
                            class="split-child font-sans font-bold text-[24px] sm:text-[30px] leading-[1.2] text-[#101010] tracking-[-0.5px] sm:tracking-[-1px]">
                            {{ __('Nos conte sobre seu projeto') }}
                        </h2>
                    </div>

                    <button type="button"
                            id="drawer-close-btn"
                            onclick="closeContactModal()"
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-[#101010]/60 hover:text-[#101010] hover:bg-black/5 transition-colors focus:outline-none"
                            aria-label="{{ __('Fechar') }}">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" class="stroke-current stroke-2">
                            <path d="M1 1L13 13M1 13L13 1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                <!-- Session Flash Messages -->
                @if(session('success'))
                    <div class="mt-4 p-3.5 rounded-[2px] bg-[#101010] text-[#ddddd5] text-xs font-sans font-medium flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[#25d366] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="mt-4 p-3.5 rounded-[2px] bg-[#b70606]/15 border border-[#b70606]/40 text-[#b70606] text-xs font-sans space-y-1">
                        @foreach($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Contact Form matching Penpot exact fields & dimensions with OH Architecture staggered reveal -->
                <form id="contact-form" action="{{ route(app()->getLocale() === 'en' ? 'en.contact.store' : 'contact.store') }}" method="POST" class="mt-6 sm:mt-8 space-y-4 sm:space-y-[18px]">
                    @csrf

                    <!-- Anti-spam Honeypot -->
                    <div class="hidden" aria-hidden="true">
                        <label for="drawer-website">Website</label>
                        <input type="text" name="website" id="drawer-website" tabindex="-1" autocomplete="off">
                    </div>

                    <!-- 1. Nome completo -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-name"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('Nome completo') }}
                            </label>
                        </div>
                        <div class="drawer-input-item">
                            <input type="text"
                                   id="drawer-name"
                                   name="name"
                                   required
                                   value="{{ old('name') }}"
                                   placeholder="{{ __('Seu nome') }}"
                                   class="w-full h-[40px] px-3.5 bg-[#c1c1c1] rounded-[2px] text-[#101010] placeholder-[#101010]/40 font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- 2. E-mail -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-email"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('E-mail') }}
                            </label>
                        </div>
                        <div class="drawer-input-item">
                            <input type="email"
                                   id="drawer-email"
                                   name="email"
                                   required
                                   value="{{ old('email') }}"
                                   placeholder="{{ __('seuemail@empresa.com') }}"
                                   class="w-full h-[40px] px-3.5 bg-[#c1c1c1] rounded-[2px] text-[#101010] placeholder-[#101010]/40 font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- 3. WhatsApp / Telefone -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-phone"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('WhatsApp / Telefone') }}
                            </label>
                        </div>
                        <div class="drawer-input-item">
                            <input type="text"
                                   id="drawer-phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="{{ __('(00) 00000-0000') }}"
                                   class="w-full h-[40px] px-3.5 bg-[#c1c1c1] rounded-[2px] text-[#101010] placeholder-[#101010]/40 font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- 4. Empresa / Marca -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-company"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('Empresa / Marca') }}
                            </label>
                        </div>
                        <div class="drawer-input-item">
                            <input type="text"
                                   id="drawer-company"
                                   name="company"
                                   value="{{ old('company') }}"
                                   placeholder="{{ __('Nome da sua marca') }}"
                                   class="w-full h-[40px] px-3.5 bg-[#c1c1c1] rounded-[2px] text-[#101010] placeholder-[#101010]/40 font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- 5. Serviço de interesse -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-service"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('Serviço de interesse') }}
                            </label>
                        </div>
                        <div class="drawer-input-item relative">
                            <select id="drawer-service"
                                    name="service"
                                    class="w-full h-[40px] px-3.5 pr-8 bg-[#c1c1c1] rounded-[2px] text-[#101010] font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all appearance-none cursor-pointer">
                                <option value="Web Design" {{ old('service') === 'Web Design' ? 'selected' : '' }}>{{ __('Web Design') }}</option>
                                <option value="Web Desenvolvimento" {{ old('service') === 'Web Desenvolvimento' ? 'selected' : '' }}>{{ __('Web Desenvolvimento') }}</option>
                                <option value="3D e Motion" {{ old('service') === '3D e Motion' ? 'selected' : '' }}>{{ __('3D e Motion') }}</option>
                                <option value="Identidade Visual" {{ old('service') === 'Identidade Visual' ? 'selected' : '' }}>{{ __('Identidade Visual') }}</option>
                                <option value="Projeto Completo" {{ old('service') === 'Projeto Completo' ? 'selected' : '' }}>{{ __('Projeto Completo (Design + Dev)') }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2.5 pointer-events-none text-[#101010]">
                                <svg class="w-4 h-4 fill-none stroke-current stroke-2" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Conte-nos um pouco sobre sua ideia -->
                    <div>
                        <div class="split-parent">
                            <label for="drawer-message"
                                   class="split-child font-sans font-bold text-[15px] sm:text-[18px] leading-[1.2] tracking-[-0.25px] sm:tracking-[-1px] text-[#101010] mb-1.5">
                                {{ __('Conte-nos um pouco sobre sua ideia') }}
                            </label>
                        </div>
                        <div class="drawer-input-item">
                            <textarea id="drawer-message"
                                      name="message"
                                      rows="4"
                                      required
                                      placeholder="{{ __('Descreva seu projeto, objetivos, prazos ou expectativas...') }}"
                                      class="w-full h-[120px] p-3.5 bg-[#c1c1c1] rounded-[2px] text-[#101010] placeholder-[#101010]/40 font-sans text-sm sm:text-[15px] border border-transparent focus:border-[#101010] focus:ring-1 focus:ring-[#101010] focus:outline-none transition-all resize-none">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <!-- Bottom Buttons Row: Enviar mensagem & Falar pelo Whats -->
                    <div class="pt-2 sm:pt-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                        <!-- Submit Button (Enviar mensagem) -->
                        <button type="submit"
                                id="drawer-submit-btn"
                                class="drawer-cta-btn group">
                            <span class="drawer-cta-text-contain">
                                <span class="drawer-cta-text">{{ __('Enviar mensagem') }}</span>
                            </span>
                            <span class="drawer-cta-aside">
                                <span class="drawer-cta-aside-bg"></span>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="drawer-cta-svg">
                                    <path d="M0 10L10 0M1 0H10V9" stroke="#101010" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="drawer-cta-svg is-absolute">
                                    <path d="M0 10L10 0M1 0H10V9" stroke="#101010" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </button>

                        <!-- WhatsApp Action Button (Falar pelo Whats) -->
                        <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}?text={{ urlencode(__('Olá! Gostaria de conversar sobre um projeto com o Estúdio Norra.')) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="drawer-cta-btn group">
                            <span class="drawer-cta-text-contain">
                                <span class="drawer-cta-text">{{ __('Falar pelo Whats') }}</span>
                            </span>
                            <span class="drawer-cta-aside">
                                <span class="drawer-cta-aside-bg"></span>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="drawer-cta-svg">
                                    <path d="M0 10L10 0M1 0H10V9" stroke="#101010" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" class="drawer-cta-svg is-absolute">
                                    <path d="M0 10L10 0M1 0H10V9" stroke="#101010" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
window.openContactModal = function() {
    const modal = document.getElementById('contact-modal');
    const backdrop = document.getElementById('contact-drawer-backdrop');
    const panel = document.getElementById('contact-modal-card');
    const closeBtn = document.getElementById('drawer-close-btn');
    if (!modal || !panel) return;

    // Kill any running tween
    if (window._contactDrawerTl) {
        window._contactDrawerTl.kill();
    }

    modal.classList.remove('hidden', 'pointer-events-none');
    modal.classList.add('pointer-events-auto');
    if (backdrop) {
        backdrop.classList.remove('pointer-events-none');
        backdrop.classList.add('pointer-events-auto');
    }
    panel.classList.remove('pointer-events-none');
    panel.classList.add('pointer-events-auto');

    document.body.style.overflow = 'hidden';

    // Split title lines dynamically if SplitText is available and not already split
    const titleEl = document.getElementById('contact-drawer-title');
    if (titleEl && !titleEl._splitInitialized && window.SplitText) {
        try {
            const parentSplit = new window.SplitText(titleEl, {
                type: 'lines',
                linesClass: 'split-parent'
            });
            const childSplit = new window.SplitText(parentSplit.lines, {
                type: 'lines',
                linesClass: 'split-child'
            });
            titleEl._splitInitialized = true;
            titleEl.parentSplit = parentSplit;
            titleEl.childSplit = childSplit;
        } catch (e) {
            console.warn('SplitText initialization fallback:', e);
        }
    }

    const textElements = panel.querySelectorAll('.split-child');
    const inputElements = panel.querySelectorAll('.drawer-input-item');
    const actionBtns = panel.querySelectorAll('.drawer-cta-btn');

    if (window.gsap) {
        // Set initial positions matching OH Architecture
        gsap.set(panel, { clipPath: 'polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)' });
        if (backdrop) gsap.set(backdrop, { opacity: 0 });
        gsap.set(textElements, { yPercent: 102 });
        gsap.set(inputElements, { opacity: 0, y: 16 });
        gsap.set(actionBtns, { opacity: 0, y: 20 });
        if (closeBtn) gsap.set(closeBtn, { opacity: 0, rotate: -90 });

        const tl = gsap.timeline({
            onComplete: () => {
                const firstInput = document.getElementById('drawer-name');
                if (firstInput) firstInput.focus();
            }
        });
        window._contactDrawerTl = tl;

        // 1. Unfold panel with OH Architecture ease-menu (.7, 0, .22, 1) over 1.0s
        tl.to(panel, {
            clipPath: 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)',
            duration: 1.0,
            ease: 'ease-menu'
        }, 0);

        // 2. Backdrop fade-in synchronized
        if (backdrop) {
            tl.to(backdrop, {
                opacity: 1,
                duration: 1.0,
                ease: 'ease-menu'
            }, 0);
        }

        // 3. Close button smooth reveal
        if (closeBtn) {
            tl.to(closeBtn, {
                opacity: 1,
                rotate: 0,
                duration: 0.85,
                ease: 'ease-secondary'
            }, 0.2);
        }

        // 4. Staggered typography reveal (letters & labels rise out of masks with ease-secondary)
        tl.to(textElements, {
            yPercent: 0,
            rotate: 0.001,
            duration: 1.15,
            stagger: 0.0425,
            ease: 'ease-secondary'
        }, '-=0.45');

        // 5. Staggered inputs reveal in tandem
        tl.to(inputElements, {
            opacity: 1,
            y: 0,
            duration: 1.0,
            stagger: 0.0425,
            ease: 'ease-secondary'
        }, '<');

        // 6. Action buttons rise smoothly
        tl.to(actionBtns, {
            opacity: 1,
            y: 0,
            duration: 1.1,
            stagger: 0.06,
            ease: 'ease-secondary'
        }, '-=0.75');
    } else {
        // Fallback if GSAP is unavailable
        panel.style.clipPath = 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)';
        if (backdrop) backdrop.style.opacity = '1';
    }
};

window.closeContactModal = function() {
    const modal = document.getElementById('contact-modal');
    const backdrop = document.getElementById('contact-drawer-backdrop');
    const panel = document.getElementById('contact-modal-card');
    if (!modal || !panel) return;

    if (window._contactDrawerTl) {
        window._contactDrawerTl.kill();
    }

    if (backdrop) {
        backdrop.style.pointerEvents = 'none';
    }
    panel.style.pointerEvents = 'none';

    const textElements = panel.querySelectorAll('.split-child');
    const inputElements = panel.querySelectorAll('.drawer-input-item');
    const actionBtns = panel.querySelectorAll('.drawer-cta-btn');

    if (window.gsap) {
        const tl = gsap.timeline({
            onComplete: () => {
                modal.classList.add('hidden', 'pointer-events-none');
                modal.classList.remove('pointer-events-auto');
                panel.style.pointerEvents = '';
                document.body.style.overflow = '';

                // Reset elements for next entrance
                gsap.set(textElements, { yPercent: 102 });
                gsap.set(inputElements, { opacity: 0, y: 16 });
                gsap.set(actionBtns, { opacity: 0, y: 20 });
            }
        });
        window._contactDrawerTl = tl;

        tl.to(panel, {
            clipPath: 'polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)',
            duration: 0.85,
            ease: 'ease-menu'
        }, 0);

        if (backdrop) {
            tl.to(backdrop, {
                opacity: 0,
                duration: 0.85,
                ease: 'ease-menu'
            }, 0);
        }
    } else {
        panel.style.clipPath = 'polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)';
        if (backdrop) backdrop.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 850);
    }
};

// Keyboard escape handler
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('contact-modal');
        if (modal && !modal.classList.contains('hidden')) {
            window.closeContactModal();
        }
    }
});

// Auto-open drawer if validation errors or session success occurred
@if((isset($errors) && $errors->any()) || session('success'))
    document.addEventListener('DOMContentLoaded', () => {
        window.openContactModal();
    });
@endif
</script>

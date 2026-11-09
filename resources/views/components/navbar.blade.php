<header id="site-header" class="relative w-full site-container pt-4 sm:pt-[1.3125rem] pb-4 sm:pb-[1.3125rem] min-h-[5rem] sm:min-h-[6.125rem] flex items-center justify-between z-40 bg-[#f6f6f6]">
    <!-- Brand Logo: Exact 114x77 SVG from Penpot at x=45, y=21 -->
    <a href="{{ app()->getLocale() === 'en' ? url('/en') : url('/') }}" class="flex items-center group focus:outline-none flex-shrink-0" aria-label="A.VICZ">
        <img src="{{ asset('assets/logos/vicz-logo.svg') }}" alt="A.VICZ" class="w-[5.5rem] h-[3.71rem] sm:w-[7.125rem] sm:h-[4.8125rem] object-contain select-none transition-transform duration-300 group-hover:scale-105" />
    </a>

    <!-- Desktop Navigation Links (Penpot: Column 5 start at x=482px / 30.125rem, compact 10px / 0.625rem gap, TeX Gyre Heros Bold 16px) -->
    <nav class="hidden md:flex lg:absolute lg:left-[30.125rem] lg:top-1/2 lg:-translate-y-1/2 items-center gap-2.5 lg:gap-[0.625rem]">
        <a href="{{ request()->routeIs('home', 'en.home') ? '#hero' : (app()->getLocale() === 'en' ? url('/en#hero') : url('/#hero')) }}" class="vicz-nav-link">
            {{ app()->getLocale() === 'en' ? 'About' : 'Sobre' }}
        </a>
        <a href="{{ request()->routeIs('home', 'en.home') ? '#expertise' : (app()->getLocale() === 'en' ? url('/en#expertise') : url('/#expertise')) }}" class="vicz-nav-link">
            {{ app()->getLocale() === 'en' ? 'Services' : 'Serviços' }}
        </a>
        <a href="{{ request()->routeIs('home', 'en.home') ? '#projects' : (app()->getLocale() === 'en' ? url('/en#projects') : url('/#projects')) }}" class="vicz-nav-link">
            {{ app()->getLocale() === 'en' ? 'Projects' : 'Projetos' }}
        </a>
        <a href="{{ request()->routeIs('home', 'en.home') ? '#jornada' : (app()->getLocale() === 'en' ? url('/en#jornada') : url('/#jornada')) }}" class="vicz-nav-link">
            {{ app()->getLocale() === 'en' ? 'Process' : 'Processo' }}
        </a>
    </nav>

    <!-- Right Side: Language Switcher and Contact CTA -->
    <div class="flex items-center gap-2 sm:gap-3 lg:gap-[1.375rem] flex-shrink-0">
        <!-- Language Switcher (EN | PT) matching Penpot dual-box design -->
        <div class="vicz-lang-switcher" role="group" aria-label="{{ __('Idioma / Language') }}">
            <a href="{{ $urlEn ?? url('/en') }}"
               class="vicz-lang-btn {{ app()->getLocale() === 'en' ? 'is-active' : '' }}"
               aria-label="English"
               aria-current="{{ app()->getLocale() === 'en' ? 'true' : 'false' }}">
                <span>EN</span>
            </a>
            <a href="{{ $urlPt ?? url('/') }}"
               class="vicz-lang-btn {{ app()->getLocale() !== 'en' ? 'is-active' : '' }}"
               aria-label="Português"
               aria-current="{{ app()->getLocale() !== 'en' ? 'true' : 'false' }}">
                <span>PT</span>
            </a>
        </div>

        <!-- Contact CTA matching Penpot BOTÃO DE CONTATO with suction animation -->
        <button type="button"
                onclick="openContactModal()"
                data-contact-modal-trigger
                class="vicz-suction-btn"
                aria-label="{{ app()->getLocale() === 'en' ? 'Get in touch' : 'Fale Conosco' }}">
            <span class="vicz-suction-icon vicz-suction-icon--left" aria-hidden="true">
                <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
                </svg>
            </span>
            <span class="vicz-suction-text">
                {{ app()->getLocale() === 'en' ? 'Get in touch' : 'Fale Conosco' }}
            </span>
            <span class="vicz-suction-icon vicz-suction-icon--right" aria-hidden="true">
                <svg viewBox="0 0 14 14" fill="none" class="w-3.5 h-3.5 stroke-current stroke-[2.2]" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2.5 11.5L11.5 2.5M11.5 2.5H4.5M11.5 2.5V9.5"/>
                </svg>
            </span>
        </button>

        <!-- Mobile Hamburger Button -->
        <button id="mobile-menu-btn"
                type="button"
                class="md:hidden relative w-9 h-9 inline-flex items-center justify-center text-[#101010] outline-none border border-[#101010]/20 rounded-[2px] bg-transparent transition-colors cursor-pointer select-none flex-shrink-0"
                aria-controls="mobile-menu"
                aria-expanded="false"
                aria-label="{{ __('Abrir Menu') }}">
            <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden fixed inset-x-0 top-20 bg-[#f6f6f6] border-b border-[#101010]/15 w-full shadow-2xl z-50">
        <div class="px-6 py-8 space-y-6">
            <div class="flex items-center justify-between pb-3 border-b border-[#101010]/10">
                <span class="text-xs uppercase tracking-widest text-[#888888] font-sans">{{ __('Idioma / Language') }}</span>
                <div class="vicz-lang-switcher" role="group" aria-label="{{ __('Idioma / Language') }}">
                    <a href="{{ $urlEn ?? url('/en') }}"
                       class="vicz-lang-btn {{ app()->getLocale() === 'en' ? 'is-active' : '' }}"
                       aria-label="English"
                       aria-current="{{ app()->getLocale() === 'en' ? 'true' : 'false' }}">
                        <span>EN</span>
                    </a>
                    <a href="{{ $urlPt ?? url('/') }}"
                       class="vicz-lang-btn {{ app()->getLocale() !== 'en' ? 'is-active' : '' }}"
                       aria-label="Português"
                       aria-current="{{ app()->getLocale() !== 'en' ? 'true' : 'false' }}">
                        <span>PT</span>
                    </a>
                </div>
            </div>

            <nav class="flex flex-col space-y-4">
                <a href="{{ request()->routeIs('home', 'en.home') ? '#hero' : (app()->getLocale() === 'en' ? url('/en#hero') : url('/#hero')) }}"
                   class="font-sans font-bold text-2xl tracking-[-0.055em] text-[#101010]">
                    {{ app()->getLocale() === 'en' ? 'About' : 'Sobre' }}
                </a>
                <a href="{{ request()->routeIs('home', 'en.home') ? '#expertise' : (app()->getLocale() === 'en' ? url('/en#expertise') : url('/#expertise')) }}"
                   class="font-sans font-bold text-2xl tracking-[-0.055em] text-[#101010]">
                    {{ app()->getLocale() === 'en' ? 'Services' : 'Serviços' }}
                </a>
                <a href="{{ request()->routeIs('home', 'en.home') ? '#projects' : (app()->getLocale() === 'en' ? url('/en#projects') : url('/#projects')) }}"
                   class="font-sans font-bold text-2xl tracking-[-0.055em] text-[#101010]">
                    {{ app()->getLocale() === 'en' ? 'Projects' : 'Projetos' }}
                </a>
                <a href="{{ request()->routeIs('home', 'en.home') ? '#jornada' : (app()->getLocale() === 'en' ? url('/en#jornada') : url('/#jornada')) }}"
                   class="font-sans font-bold text-2xl tracking-[-0.055em] text-[#101010]">
                    {{ app()->getLocale() === 'en' ? 'Process' : 'Processo' }}
                </a>
            </nav>
        </div>
    </div>
</header>

<header id="site-header" class="fixed top-0 left-0 w-full z-40 transition-all duration-300 bg-[#101010] border-b border-white/[0.04]">
    <div class="relative w-full px-[clamp(1.5rem,3.125vw,3.5rem)] h-20 flex items-center justify-between">
        <!-- Brand Logo: Monogram from Penpot -->
        <a href="{{ app()->getLocale() === 'en' ? url('/en') : url('/') }}" class="flex items-center gap-3 group focus:outline-none" aria-label="Estúdio Norra Início">
            <div class="w-8 h-8 text-[#ddddd5] group-hover:text-white transition-colors duration-300">
                <svg width="100%" height="100%" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9912 0C13.4453 0 0 13.5015 0 30.0762C1.65039 69.9746 58.3496 69.9746 60 30.0762C60 13.4834 46.5352 0 30.0088 0L29.9912 0ZM29.9912 57.6865C15.9395 57.6865 4.34668 47.0547 2.69629 33.4053C2.60449 32.6323 3.48535 32.1182 4.09082 32.5962L28.5234 52.1499C29.0928 52.6094 29.918 52.2056 29.918 51.4692L29.918 20.0508C29.8994 19.0938 31.2197 18.8545 31.5498 19.7559L43.9131 52.9775C44.0605 53.3828 43.9131 53.8237 43.5459 54.0444C39.5293 56.3438 34.9248 57.6689 29.9912 57.6689L29.9912 57.6865ZM49.2686 49.354L47.8203 49.354C47.4717 49.354 47.1787 49.1338 47.0312 48.8203L30.9453 11.3682C30.6143 10.5957 29.4951 10.7061 29.3125 11.5151L22.9473 40.4141C22.8193 40.9834 22.1582 41.2783 21.6631 40.9658L4.12793 30.2778C3.08203 29.6343 2.51172 28.4385 2.64258 27.2251C4.10938 12.8398 16.6182 1.69238 31.5137 2.50146C45.2334 3.23779 57.3037 15.8745 57.5059 29.6528C57.6152 37.1763 54.6992 44.0195 49.9111 49.0596C49.7461 49.2432 49.5088 49.3354 49.2686 49.3354L49.2686 49.354Z" fill="currentColor"/>
                </svg>
            </div>
            <span class="font-display font-bold text-sm tracking-widest text-[#ddddd5] uppercase group-hover:text-white transition-colors duration-300 hidden sm:inline-block">
                ESTÚDIO NORRA
            </span>
        </a>

        <!-- Desktop Navigation Links (Penpot Minimalist Menu - Centered & Balanced Spacing with Monolog Roll Hover) -->
        <nav class="hidden md:flex items-center gap-6 absolute left-1/2 -translate-x-1/2">
            <a href="{{ request()->routeIs('home', 'en.home') ? '#expertise' : (app()->getLocale() === 'en' ? url('/en#expertise') : url('/#expertise')) }}" class="nav-roll-link font-sans font-bold text-[16px] tracking-[-1px] text-[#ddddd5] py-2">
                <span class="nav-roll-contain">
                    <span class="nav-roll-text">{{ __('Serviços') }}</span>
                </span>
            </a>
            <a href="{{ request()->routeIs('home', 'en.home') ? '#projetos' : '#todos-projetos' }}" class="nav-roll-link font-sans font-bold text-[16px] tracking-[-1px] text-[#ddddd5] py-2">
                <span class="nav-roll-contain">
                    <span class="nav-roll-text">{{ __('Projetos') }}</span>
                </span>
            </a>
            <a href="{{ request()->routeIs('home', 'en.home') ? '#jornada' : (app()->getLocale() === 'en' ? url('/en#jornada') : url('/#jornada')) }}" class="nav-roll-link font-sans font-bold text-[16px] tracking-[-1px] text-[#ddddd5] py-2">
                <span class="nav-roll-contain">
                    <span class="nav-roll-text">{{ __('Processo') }}</span>
                </span>
            </a>
        </nav>

        <!-- Right Side CTA & Mobile Layout -->
        <div class="flex items-center gap-3">
            <!-- Language Switcher (PT | EN) -->
            <div class="flex items-center text-xs font-sans tracking-wider border border-white/10 rounded-full px-2.5 py-1 bg-white/[0.04] select-none">
                <a href="{{ $urlPt ?? url('/') }}"
                   class="px-1.5 py-0.5 rounded transition-colors duration-200 {{ app()->getLocale() !== 'en' ? 'text-white font-bold' : 'text-[#ddddd5]/50 hover:text-white' }}"
                   aria-label="Português">
                    PT
                </a>
                <span class="text-white/20 select-none text-[10px]">|</span>
                <a href="{{ $urlEn ?? url('/en') }}"
                   class="px-1.5 py-0.5 rounded transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'text-white font-bold' : 'text-[#ddddd5]/50 hover:text-white' }}"
                   aria-label="English">
                    EN
                </a>
            </div>

            <x-btn-cta :text="__('Iniciar Projeto')" size="sm" />

            <!-- Mobile Hamburger Button (clean toggle without any focus ring/circle) -->
            <button id="mobile-menu-btn"
                    type="button"
                    class="md:hidden relative w-10 h-10 inline-flex items-center justify-center text-[#ddddd5] hover:text-white outline-none focus:outline-none focus:ring-0 active:ring-0 focus-visible:outline-none border-none bg-transparent hover:bg-transparent active:bg-transparent transition-colors cursor-pointer select-none"
                    style="-webkit-tap-highlight-color: transparent;"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    aria-label="{{ __('Abrir Menu') }}">
                <span class="relative w-6 h-6 flex items-center justify-center pointer-events-none">
                    <svg id="hamburger-icon" class="w-6 h-6 absolute inset-0 transition-all duration-300 transform opacity-100 rotate-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 absolute inset-0 transition-all duration-300 transform opacity-0 rotate-90 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden md:hidden overflow-hidden bg-[#101010] border-b border-white/10 w-full shadow-2xl">
        <div class="px-6 sm:px-8 pt-6 pb-8 space-y-6">
            <!-- Mobile Language Switcher Row -->
            <div class="flex items-center justify-between pb-3 border-b border-white/10">
                <span class="text-xs uppercase tracking-widest text-[#888888] font-sans">Idioma / Language</span>
                <div class="flex items-center text-xs font-sans tracking-wider border border-white/10 rounded-full px-2.5 py-1 bg-white/[0.04]">
                    <a href="{{ $urlPt ?? url('/') }}"
                       class="px-2 py-0.5 rounded transition-colors {{ app()->getLocale() !== 'en' ? 'text-white font-bold' : 'text-[#ddddd5]/50 hover:text-white' }}">
                        PT
                    </a>
                    <span class="text-white/20 select-none text-[10px]">|</span>
                    <a href="{{ $urlEn ?? url('/en') }}"
                       class="px-2 py-0.5 rounded transition-colors {{ app()->getLocale() === 'en' ? 'text-white font-bold' : 'text-[#ddddd5]/50 hover:text-white' }}">
                        EN
                    </a>
                </div>
            </div>

            <nav class="flex flex-col">
                <div class="mobile-nav-item border-b border-white/10 pb-5">
                    <a href="{{ request()->routeIs('home', 'en.home') ? '#expertise' : (app()->getLocale() === 'en' ? url('/en#expertise') : url('/#expertise')) }}"
                       class="mobile-nav-link font-sans font-bold text-3xl sm:text-4xl tracking-[-0.5px] sm:tracking-[-1px] md:tracking-[-1.5px] leading-tight text-[#ddddd5] hover:text-white transition-colors duration-200 block">
                        {{ __('Serviços') }}
                    </a>
                </div>
                <div class="mobile-nav-item border-b border-white/10 py-5">
                    <a href="{{ request()->routeIs('home', 'en.home') ? '#projetos' : '#todos-projetos' }}"
                       class="mobile-nav-link font-sans font-bold text-3xl sm:text-4xl tracking-[-0.5px] sm:tracking-[-1px] md:tracking-[-1.5px] leading-tight text-[#ddddd5] hover:text-white transition-colors duration-200 block">
                        {{ __('Projetos') }}
                    </a>
                </div>
                <div class="mobile-nav-item border-b border-white/10 py-5">
                    <a href="{{ request()->routeIs('home', 'en.home') ? '#jornada' : (app()->getLocale() === 'en' ? url('/en#jornada') : url('/#jornada')) }}"
                       class="mobile-nav-link font-sans font-bold text-3xl sm:text-4xl tracking-[-0.5px] sm:tracking-[-1px] md:tracking-[-1.5px] leading-tight text-[#ddddd5] hover:text-white transition-colors duration-200 block">
                        {{ __('Processo') }}
                    </a>
                </div>
            </nav>

            <div id="mobile-menu-footer" class="pt-2">
                <span class="text-xs sm:text-sm font-sans text-[#888888]">contato@estudionorra.com</span>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu Backdrop Blur Overlay (gentle darkening and blur on rest of site) -->
<div id="mobile-menu-backdrop"
     class="fixed inset-0 top-20 z-30 bg-black/40 backdrop-blur-[4px] opacity-0 pointer-events-none hidden md:hidden"
     aria-hidden="true"></div>


<header id="site-header" class="fixed top-0 left-0 w-full z-40 transition-all duration-300 bg-[#101010]/80 backdrop-blur-md border-b border-white/[0.04]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Brand Logo: Monogram from Penpot -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 group focus:outline-none" aria-label="Estúdio Norra Início">
            <div class="w-8 h-8 text-[#ddddd5] group-hover:text-white transition-colors duration-300">
                <svg width="100%" height="100%" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9912 0C13.4453 0 0 13.5015 0 30.0762C1.65039 69.9746 58.3496 69.9746 60 30.0762C60 13.4834 46.5352 0 30.0088 0L29.9912 0ZM29.9912 57.6865C15.9395 57.6865 4.34668 47.0547 2.69629 33.4053C2.60449 32.6323 3.48535 32.1182 4.09082 32.5962L28.5234 52.1499C29.0928 52.6094 29.918 52.2056 29.918 51.4692L29.918 20.0508C29.8994 19.0938 31.2197 18.8545 31.5498 19.7559L43.9131 52.9775C44.0605 53.3828 43.9131 53.8237 43.5459 54.0444C39.5293 56.3438 34.9248 57.6689 29.9912 57.6689L29.9912 57.6865ZM49.2686 49.354L47.8203 49.354C47.4717 49.354 47.1787 49.1338 47.0312 48.8203L30.9453 11.3682C30.6143 10.5957 29.4951 10.7061 29.3125 11.5151L22.9473 40.4141C22.8193 40.9834 22.1582 41.2783 21.6631 40.9658L4.12793 30.2778C3.08203 29.6343 2.51172 28.4385 2.64258 27.2251C4.10938 12.8398 16.6182 1.69238 31.5137 2.50146C45.2334 3.23779 57.3037 15.8745 57.5059 29.6528C57.6152 37.1763 54.6992 44.0195 49.9111 49.0596C49.7461 49.2432 49.5088 49.3354 49.2686 49.3354L49.2686 49.354Z" fill="currentColor"/>
                </svg>
            </div>
            <span class="font-display font-bold text-sm tracking-widest text-[#ddddd5] uppercase group-hover:text-white transition-colors duration-300 hidden sm:inline-block">
                ESTÚDIO NORRA
            </span>
        </a>

        <!-- Desktop Navigation Links (Penpot Minimalist Menu) -->
        <nav class="hidden md:flex items-center space-x-8 lg:space-x-12">
            <a href="#expertise" class="text-xs uppercase tracking-widest text-[#ddddd5] hover:text-white font-bold transition-colors duration-200">
                Expertise
            </a>
            <a href="#projetos" class="text-xs uppercase tracking-widest text-[#ddddd5] hover:text-white font-bold transition-colors duration-200">
                Galeria
            </a>
            <a href="#manifesto" class="text-xs uppercase tracking-widest text-[#ddddd5] hover:text-white font-bold transition-colors duration-200">
                Sobre
            </a>
            <a href="#jornada" class="text-xs uppercase tracking-widest text-[#ddddd5] hover:text-white font-bold transition-colors duration-200">
                Processo
            </a>
            <a href="#faq" class="text-xs uppercase tracking-widest text-[#ddddd5] hover:text-white font-bold transition-colors duration-200">
                FAQ
            </a>
        </nav>

        <!-- Right Side CTA & Mobile Layout -->
        <div class="flex items-center gap-3">
            <!-- Penpot Top-Right Pill Button -->
            <a href="#contato" class="inline-flex items-center gap-1.5 px-4 sm:px-5 py-2 rounded-full bg-[#ddddd5] text-[#101010] text-xs font-bold uppercase tracking-wider hover:bg-white active:scale-95 transition-all duration-200 shadow-md">
                <span>Fale Conosco</span>
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn"
                    type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-full text-[#ddddd5] hover:text-white focus:outline-none focus:ring-1 focus:ring-[#ddddd5]"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    aria-label="Abrir Menu">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#101010] border-b border-white/10 px-6 py-8 space-y-6">
        <nav class="flex flex-col space-y-4">
            <a href="#expertise" class="mobile-nav-link text-base font-display uppercase font-bold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Expertise
            </a>
            <a href="#projetos" class="mobile-nav-link text-base font-display uppercase font-bold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Galeria
            </a>
            <a href="#manifesto" class="mobile-nav-link text-base font-display uppercase font-bold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Sobre
            </a>
            <a href="#jornada" class="mobile-nav-link text-base font-display uppercase font-bold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Processo
            </a>
            <a href="#faq" class="mobile-nav-link text-base font-display uppercase font-bold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                FAQ
            </a>
        </nav>

        <div class="pt-4 border-t border-white/10 flex flex-col gap-3">
            <a href="#contato" class="mobile-nav-link w-full py-3 rounded-full bg-[#ddddd5] text-[#101010] text-center font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                <span>Fale Conosco</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>
            <div class="text-center">
                <span class="text-xs text-[#888888]">contato@estudionorra.com</span>
            </div>
        </div>
    </div>
</header>


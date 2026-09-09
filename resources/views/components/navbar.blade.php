<header id="site-header" class="fixed top-0 left-0 w-full z-40 transition-all duration-300 bg-[#101010]/80 backdrop-blur-md border-b border-white/[0.06]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 group focus:outline-none" aria-label="Estúdio Norra Início">
            <span class="w-7 h-7 rounded-full bg-[#b70606] flex items-center justify-center text-white font-bold text-xs tracking-tighter group-hover:scale-105 transition-transform duration-300">
                N
            </span>
            <span class="font-display font-bold text-xl tracking-tight text-[#ddddd5] group-hover:text-white transition-colors duration-300">
                ESTÚDIO NORRA
            </span>
        </a>

        <!-- Desktop Navigation Menu -->
        <nav class="hidden md:flex items-center gap-1 bg-[#151515]/90 border border-white/10 rounded-full px-5 py-2 shadow-inner">
            <a href="#expertise" class="text-xs uppercase tracking-wider text-[#ddddd5]/80 hover:text-white px-3 py-1.5 rounded-full hover:bg-white/5 transition-all duration-200">
                Expertise
            </a>
            <a href="#projetos" class="text-xs uppercase tracking-wider text-[#ddddd5]/80 hover:text-white px-3 py-1.5 rounded-full hover:bg-white/5 transition-all duration-200">
                Galeria
            </a>
            <a href="#manifesto" class="text-xs uppercase tracking-wider text-[#ddddd5]/80 hover:text-white px-3 py-1.5 rounded-full hover:bg-white/5 transition-all duration-200">
                Sobre
            </a>
            <a href="#jornada" class="text-xs uppercase tracking-wider text-[#ddddd5]/80 hover:text-white px-3 py-1.5 rounded-full hover:bg-white/5 transition-all duration-200">
                Processo
            </a>
            <a href="#faq" class="text-xs uppercase tracking-wider text-[#ddddd5]/80 hover:text-white px-3 py-1.5 rounded-full hover:bg-white/5 transition-all duration-200">
                FAQ
            </a>
        </nav>

        <!-- Right Side CTA & Mobile Toggle -->
        <div class="flex items-center gap-3">
            <!-- Desktop / Tablet Pill Button -->
            <a href="#contato" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#ddddd5] text-[#101010] text-xs uppercase font-bold tracking-wider hover:bg-white active:scale-95 transition-all duration-200 shadow-lg shadow-black/30">
                <span>Fale Conosco</span>
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn"
                    type="button"
                    class="md:hidden inline-flex items-center justify-center p-2.5 rounded-full bg-[#151515] border border-white/10 text-[#ddddd5] hover:text-white hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-[#b70606]"
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
            <a href="#expertise" class="mobile-nav-link text-lg font-display uppercase font-semibold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Expertise
            </a>
            <a href="#projetos" class="mobile-nav-link text-lg font-display uppercase font-semibold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Galeria
            </a>
            <a href="#manifesto" class="mobile-nav-link text-lg font-display uppercase font-semibold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Sobre
            </a>
            <a href="#jornada" class="mobile-nav-link text-lg font-display uppercase font-semibold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                Processo
            </a>
            <a href="#faq" class="mobile-nav-link text-lg font-display uppercase font-semibold text-[#ddddd5] hover:text-[#b70606] transition-colors">
                FAQ
            </a>
        </nav>

        <div class="pt-6 border-t border-white/10 flex flex-col gap-4">
            <a href="#contato" class="mobile-nav-link w-full py-3 rounded-full bg-[#ddddd5] text-[#101010] text-center font-bold text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span>Fale Conosco</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>
            <div class="text-center">
                <span class="text-xs text-[#888888]">contato@estudionorra.com</span>
            </div>
        </div>
    </div>
</header>

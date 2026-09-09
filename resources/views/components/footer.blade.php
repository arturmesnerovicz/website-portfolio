<footer class="bg-[#ddddd5] text-[#101010] pt-20 pb-12 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Row: Big Brand Headline & Tagline -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 pb-16 border-b border-[#101010]/15">
            <div class="space-y-3 max-w-xl">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-[#b70606] flex items-center justify-center text-white font-bold text-sm tracking-tighter">
                        N
                    </span>
                    <span class="font-display font-extrabold text-2xl sm:text-3xl tracking-tight text-[#101010]">
                        ESTÚDIO NORRA
                    </span>
                </div>
                <p class="font-display text-lg sm:text-xl font-medium text-[#101010]/80">
                    {{ $settings['brand_tagline'] ?? 'Onde o conceito torna-se arte.' }}
                </p>
            </div>

            <!-- Back to top button -->
            <div>
                <a href="#site-header" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#101010] text-[#ddddd5] hover:bg-[#b70606] hover:text-white transition-all duration-300 text-xs uppercase font-bold tracking-wider">
                    <span>Voltar ao topo</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"/></svg>
                </a>
            </div>
        </div>

        <!-- Middle Row: Navigation Links Columns -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-16">
            <!-- Col 1: Expertise -->
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-widest font-bold text-[#101010]/60">Expertise</p>
                <ul class="space-y-2.5 text-sm font-medium">
                    <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Web Design</a></li>
                    <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Web Desenvolvimento</a></li>
                    <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">3D e Motion</a></li>
                    <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Identidade Visual</a></li>
                </ul>
            </div>

            <!-- Col 2: Explorar -->
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-widest font-bold text-[#101010]/60">Explorar</p>
                <ul class="space-y-2.5 text-sm font-medium">
                    <li><a href="{{ url('/') }}" class="hover:text-[#b70606] transition-colors">Início</a></li>
                    <li><a href="#projetos" class="hover:text-[#b70606] transition-colors">Galeria de Projetos</a></li>
                    <li><a href="#manifesto" class="hover:text-[#b70606] transition-colors">Sobre o Estúdio</a></li>
                    <li><a href="#jornada" class="hover:text-[#b70606] transition-colors">Jornada do Projeto</a></li>
                    <li><a href="#faq" class="hover:text-[#b70606] transition-colors">Perguntas Frequentes</a></li>
                </ul>
            </div>

            <!-- Col 3: Conexão -->
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-widest font-bold text-[#101010]/60">Conexão</p>
                <ul class="space-y-2.5 text-sm font-medium">
                    <li>
                        <a href="https://www.instagram.com/estudionorra/" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                            Instagram
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/company/estudio-norra/" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                            LinkedIn
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                            WhatsApp Direto
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $settings['contact_email'] ?? 'contato@estudionorra.com' }}" class="hover:text-[#b70606] transition-colors">
                            {{ $settings['contact_email'] ?? 'contato@estudionorra.com' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Localização & Atendimento -->
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-widest font-bold text-[#101010]/60">Estúdio</p>
                <p class="text-sm leading-relaxed text-[#101010]/80">
                    Atendimento nacional e internacional. Sediado no Brasil, operando de forma remota e ágil.
                </p>
                <div class="pt-2">
                    <a href="{{ url('/admin') }}" class="text-xs text-[#101010]/40 hover:text-[#b70606] transition-colors underline">
                        Painel Administrativo
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="pt-8 border-t border-[#101010]/15 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#101010]/60">
            <p>{{ $settings['footer_copyright'] ?? '© 2026 ESTÚDIO NORRA • MULTIDISCIPLINAR POR ESSÊNCIA • TODOS OS DIREITOS RESERVADOS' }}</p>
            <p>Construído com Laravel & Tailwind CSS</p>
        </div>
    </div>
</footer>

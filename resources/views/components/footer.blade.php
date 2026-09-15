<footer class="bg-[#ddddd5] text-[#101010] pt-16 sm:pt-20 pb-12 transition-colors border-t border-[#101010]/15">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        
        <!-- Top Section: Logo on Left, 3 Navigation Columns on Right -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start pb-16">
            
            <!-- Left: Brand Logo & Wordmark matching Penpot -->
            <div class="lg:col-span-6 space-y-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-4 group">
                    <div class="w-14 h-14 rounded-full bg-[#101010] flex items-center justify-center p-3 text-[#ddddd5] shadow-md group-hover:bg-[#b70606] transition-colors">
                        <img src="{{ asset('assets/logos/logo-monogram.svg') }}" alt="Estúdio Norra Monogram" class="w-full h-full object-contain filter invert" />
                    </div>
                    <div>
                        <span class="font-display font-bold text-2xl sm:text-3xl tracking-tight text-[#101010] block leading-none">
                            ESTÚDIO NORRA
                        </span>
                        <span class="font-sans text-xs uppercase tracking-widest text-[#101010]/60 mt-1 block">
                            Design & Engenharia Digital
                        </span>
                    </div>
                </a>
            </div>

            <!-- Right: 3 Nav Columns matching Penpot -->
            <div class="lg:col-span-6 grid grid-cols-2 sm:grid-cols-3 gap-8 sm:gap-12">
                <!-- Col 1: EXPERTISE -->
                <div class="space-y-4">
                    <p class="font-sans font-bold text-base sm:text-[18px] tracking-normal text-[#101010] leading-[1.2]">
                        EXPERTISE
                    </p>
                    <ul class="space-y-2 text-sm sm:text-[18px] font-sans font-normal text-[#101010]/75 leading-[1.2]">
                        <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Web Design</a></li>
                        <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Programação</a></li>
                        <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">3D e Motion</a></li>
                    </ul>
                </div>

                <!-- Col 2: EXPLORAR -->
                <div class="space-y-4">
                    <p class="font-sans font-bold text-base sm:text-[18px] tracking-normal text-[#101010] leading-[1.2]">
                        EXPLORAR
                    </p>
                    <ul class="space-y-2 text-sm sm:text-[18px] font-sans font-normal text-[#101010]/75 leading-[1.2]">
                        <li><a href="#expertise" class="hover:text-[#b70606] transition-colors">Expertise</a></li>
                        <li><a href="#projetos" class="hover:text-[#b70606] transition-colors">Galeria</a></li>
                        <li><a href="#manifesto" class="hover:text-[#b70606] transition-colors">Sobre</a></li>
                        <li><a href="#projetos" class="hover:text-[#b70606] transition-colors">Projetos</a></li>
                    </ul>
                </div>

                <!-- Col 3: Conexão -->
                <div class="space-y-4">
                    <p class="font-sans font-bold text-base sm:text-[18px] tracking-normal text-[#101010] leading-[1.2]">
                        Conexão
                    </p>
                    <ul class="space-y-2 text-sm sm:text-[18px] font-sans font-normal text-[#101010]/75 leading-[1.2]">
                        <li>
                            <a href="https://www.linkedin.com/company/estudio-norra/" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                                Linkedin
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/estudionorra/" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#b70606] transition-colors">
                                WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Full-width Divider Line from Penpot -->
        <div class="w-full h-px bg-[#101010]/20 mb-8"></div>

        <!-- Bottom Copyright Row matching Penpot -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 text-xs sm:text-[14px] text-[#101010]/70 font-normal">
            <div class="space-y-1">
                <p class="font-sans font-normal leading-[1.2]">@ {{ date('Y') }} ESTÚDIO NORRA</p>
                <p class="font-sans font-normal tracking-normal text-[#101010]/60 leading-[1.2]">MULTIDISCIPLINAR POR ESSÊNCIA - TODOS OS DIREITOS RESERVADOS</p>
            </div>
            <div>
                <p class="font-sans font-normal text-right leading-[1.2]">Onde o conceito torna-se arte</p>
            </div>
        </div>

    </div>
</footer>


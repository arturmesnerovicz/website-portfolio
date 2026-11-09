<section id="contato" class="w-full bg-[#f6f6f6] text-[#151515] py-24 sm:py-32 lg:py-44 select-none">
    <div class="w-full site-container">
        <!-- Interactive Big Typography CTA Button -->
        <button type="button"
                onclick="openContactModal()"
                data-contact-modal-trigger
                class="group text-left w-full block cursor-pointer select-none focus:outline-none focus:ring-0 border-none bg-transparent p-0 transition-opacity duration-300 hover:opacity-95">
            <span class="sr-only">{{ app()->getLocale() === 'en' ? 'Start Project' : 'Iniciar Projeto' }}</span>
            
            <div class="w-full font-display font-bold text-4xl sm:text-6xl md:text-7xl lg:text-[6.875rem] leading-[1.0] tracking-[-0.03em] text-[#151515]">
                @if(app()->getLocale() === 'en')
                    <!-- Line 1 (Longest) -->
                    <div class="block">
                        Let's create an experience
                    </div>
                    <!-- Line 2 (Medium) -->
                    <div class="block">
                        that lives up to your
                    </div>
                    <!-- Line 3 (Shortest + Heavy 85x85 Arrow) -->
                    <div class="flex items-center flex-wrap gap-4 lg:gap-6">
                        <span>ambitions</span>
                        <span class="inline-flex items-center justify-center transform group-hover:translate-x-4 sm:group-hover:translate-x-6 transition-transform duration-300 ease-out flex-shrink-0">
                            <!-- Exact Penpot Arrow (85x85, 14px stroke-width, round caps) -->
                            <svg class="w-10 h-10 sm:w-16 sm:h-16 lg:w-[5.3125rem] lg:h-[5.3125rem] stroke-current"
                                 viewBox="0 0 85 85"
                                 fill="none">
                                <line x1="7" y1="42.5" x2="78" y2="42.5" stroke-width="14" stroke-linecap="round"/>
                                <path d="M48 12.5L78 42.5L48 72.5" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                @else
                    <!-- Line 1 (Longest) -->
                    <div class="block">
                        Vamos criar uma experiência
                    </div>
                    <!-- Line 2 (Medium) -->
                    <div class="block">
                        à altura das suas
                    </div>
                    <!-- Line 3 (Shortest + Heavy 85x85 Arrow) -->
                    <div class="flex items-center flex-wrap gap-4 lg:gap-6">
                        <span>ambições</span>
                        <span class="inline-flex items-center justify-center transform group-hover:translate-x-4 sm:group-hover:translate-x-6 transition-transform duration-300 ease-out flex-shrink-0">
                            <svg class="w-10 h-10 sm:w-16 sm:h-16 lg:w-[5.3125rem] lg:h-[5.3125rem] stroke-current"
                                 viewBox="0 0 85 85"
                                 fill="none">
                                <line x1="7" y1="42.5" x2="78" y2="42.5" stroke-width="14" stroke-linecap="round"/>
                                <path d="M48 12.5L78 42.5L48 72.5" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                @endif
            </div>
        </button>
    </div>
</section>

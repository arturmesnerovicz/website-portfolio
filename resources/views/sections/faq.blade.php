<section id="faq" class="py-24 sm:py-32 md:py-40 bg-[#101010] text-[#ddddd5] relative border-t border-white/10">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Left Column: 'Ficou com dúvida?' & CTA button -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-32 order-2 lg:order-1 pt-6 lg:pt-0 norra-reveal">
                <span class="text-xs uppercase tracking-widest text-[#b70606] font-bold block">Perguntas Frequentes</span>
                <h3 class="font-sans font-normal text-3xl sm:text-4xl text-[#ddddd5] tracking-tight leading-tight">
                    Ficou com<br class="hidden sm:inline" /> dúvida?
                </h3>
                
                <div>
                    <button type="button"
                            onclick="openContactModal()"
                            class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-[#ddddd5] text-[#101010] font-sans font-bold text-xs uppercase tracking-wider hover:bg-[#b70606] hover:text-white transition-all duration-300 shadow-md">
                        <span>Fale Conosco</span>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="stroke-current stroke-2">
                            <path d="M2 10L10 2M10 2H4M10 2V8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Column: Big Title & Question List -->
            <div class="lg:col-span-8 order-1 lg:order-2 space-y-12 sm:space-y-16">
                <!-- Section Headline: 70px Penpot -->
                <h2 class="font-sans font-normal text-[clamp(2rem,4.2vw,4.375rem)] leading-[1.15] text-[#ddddd5] tracking-tight norra-reveal">
                    Tudo que você precisa saber para iniciarmos um projeto.
                </h2>

                <!-- Questions List -->
                <div class="border-t border-white/20 divide-y divide-white/20">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item group py-6 sm:py-8 cursor-pointer transition-colors hover:bg-white/[0.015] norra-reveal" onclick="toggleFaqAccordion(this)">
                            <div class="flex items-center justify-between gap-6">
                                <h3 class="font-sans font-normal text-lg sm:text-xl md:text-2xl text-[#ddddd5] group-hover:text-white transition-colors flex-1">
                                    {{ $faq->question }}
                                </h3>

                                <!-- Diagonal Arrow ↗ / rotate on expand -->
                                <div class="faq-chevron w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-[#ddddd5] group-hover:border-white group-hover:text-white flex-shrink-0 transition-all duration-300">
                                    <svg class="w-3.5 h-3.5 transform transition-transform duration-300" viewBox="0 0 12 12" fill="none" class="stroke-current stroke-2">
                                        <path d="M2 10L10 2M10 2H4M10 2V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="faq-body overflow-hidden transition-all duration-400 ease-in-out {{ $index === 0 ? 'max-h-80 opacity-100 mt-4' : 'max-h-0 opacity-0' }}">
                                <p class="font-sans font-normal text-base text-[#999999] leading-relaxed max-w-2xl pr-6">
                                    {{ $faq->answer }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<script>
function toggleFaqAccordion(element) {
    const body = element.querySelector('.faq-body');
    const chevron = element.querySelector('.faq-chevron svg');
    const isOpen = body.classList.contains('opacity-100');

    // Close all siblings
    document.querySelectorAll('.faq-item').forEach(item => {
        const b = item.querySelector('.faq-body');
        const c = item.querySelector('.faq-chevron svg');
        if (b && c) {
            b.classList.remove('opacity-100');
            b.classList.add('max-h-0', 'opacity-0');
            b.classList.remove('max-h-80', 'mt-4');
            c.style.transform = 'rotate(0deg)';
        }
    });

    if (!isOpen) {
        body.classList.remove('max-h-0', 'opacity-0');
        body.classList.add('max-h-80', 'opacity-100', 'mt-4');
        chevron.style.transform = 'rotate(45deg)';
    }
}
</script>


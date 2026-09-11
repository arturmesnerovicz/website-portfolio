<section id="faq" class="pt-24 sm:pt-32 md:pt-40 pb-24 sm:pb-32 md:pb-40 lg:pb-[40vh] bg-[#151515] text-[#ddddd5] relative z-10">
    <div class="faq-inner-container w-full">
        <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">

                <!-- Left Column: 'Ficou com dúvida?' & CTA button -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-32 order-2 lg:order-1 pt-6 lg:pt-0 norra-reveal">
                    <h3 class="font-sans font-bold text-3xl sm:text-4xl text-[#ddddd5] tracking-tight leading-tight">
                        Ficou com<br class="hidden sm:inline" /> dúvida?
                    </h3>

                    <div>
                        <x-btn-cta text="Fale Conosco" />
                    </div>
                </div>

                <!-- Right Column: Big Title & Question List -->
                <div class="lg:col-span-8 order-1 lg:order-2 space-y-12 sm:space-y-16">
                    <!-- Section Headline: 70px Penpot -->
                    <h2 class="font-sans font-bold text-[clamp(2rem,4.2vw,4.375rem)] leading-[1.15] text-[#ddddd5] tracking-tight norra-reveal">
                        Tudo que você precisa saber<br />para iniciarmos um projeto.
                    </h2>

                    <!-- Questions List -->
                    <div class="faq-list border-t border-white/20 divide-y divide-white/10 relative">
                        @foreach($faqs as $index => $faq)
                            <div class="faq-item relative rounded-[4px] py-6 sm:py-7 px-4 sm:px-8 cursor-pointer transition-all duration-500 ease-out overflow-hidden group norra-reveal"
                                 onclick="toggleFaqAccordion(this)">

                                <!-- Expanding Luminous Radial Gradient Background on Hover & Active (matching EXPERTISE) -->
                                <div class="faq-bg absolute inset-0 pointer-events-none rounded-[4px]"
                                     style="background: radial-gradient(circle at 50% 50%, #f7f7f2 0%, #eaeae4 100%);"></div>

                                <!-- Content relative on top of bg -->
                                <div class="relative z-10 w-full">
                                    <!-- Row Header -->
                                    <div class="flex items-center justify-between gap-6">
                                        <div class="faq-title-wrap min-w-0 flex-1">
                                            <span class="faq-title block font-sans font-normal text-lg sm:text-xl md:text-2xl leading-tight">
                                                {{ $faq->question }}
                                            </span>
                                        </div>

                                        <!-- Short Minimalist Arrow matching EXPERTISE (↗ in closed state, rotates to ↘ when opened) -->
                                        <div class="faq-arrow-wrap flex items-center justify-center w-8 h-8 flex-shrink-0">
                                            <svg class="faq-arrow-icon w-5 h-5 sm:w-6 sm:h-6 transform origin-center"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="2.2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="13 6 19 12 13 18"></polyline>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Expandable Body with CSS Grid transition (matching EXPERTISE) -->
                                    <div class="faq-accordion-grid">
                                        <div class="overflow-hidden">
                                            <div class="faq-accordion-content pt-4 sm:pt-5 min-w-0">
                                                @php
                                                    $faqWords = preg_split('/\s+/', trim($faq->answer ?? ''));
                                                @endphp
                                                <p class="faq-desc font-sans font-normal text-base sm:text-lg leading-relaxed max-w-2xl pr-6 flex flex-wrap transition-colors duration-500">
                                                    @foreach($faqWords as $wIdx => $word)
                                                        <span class="inline-block overflow-hidden mr-[0.3em] px-[0.03em] pb-1">
                                                            <span class="reveal-word inline-block"
                                                                  style="transition-delay: {{ 80 + ($wIdx * 15) }}ms;">
                                                                {{ $word }}
                                                            </span>
                                                        </span>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bottom Delimiter Line -->
                                <div class="faq-line absolute bottom-0 left-0 right-0 h-[1px] bg-white/10" aria-hidden="true"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Atmospheric Dim Overlay for Smooth Transition to CTA -->
    <div class="faq-dim-overlay absolute inset-0 bg-black/60 opacity-0 pointer-events-none z-20"></div>
</section>

<script>
function toggleFaqAccordion(element) {
    const isOpen = element.classList.contains('is-active');

    // Close all siblings
    document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('is-active');
    });

    // Toggle clicked item if it was closed
    if (!isOpen) {
        element.classList.add('is-active');
    }
}
</script>


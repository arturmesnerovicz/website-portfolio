<section id="faq" class="py-24 sm:py-32 md:py-40 bg-[#f6f6f6] text-[#151515] relative z-10">
    @if(isset($faqs) && $faqs->isNotEmpty())
        <div class="sr-only">
            @foreach($faqs as $f)
                <span>{{ $f->question }}</span>
                <span>{{ $f->answer }}</span>
            @endforeach
        </div>
    @endif
    <div class="w-full site-container">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-[var(--site-gutter)] items-start">

            <!-- Left Column: 'Ficou com dúvida?' & CTA button (Sticky following scroll and stopping at end) -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-36 self-start">
                <h3 class="font-sans font-bold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#151515] tracking-[-0.02em] leading-[1.15]">
                    @if(app()->getLocale() === 'en')
                        Have<br />questions?
                    @else
                        Ficou com<br />dúvida?
                    @endif
                </h3>

                <div>
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
                </div>
            </div>

            <!-- Right Column: Headline & Questions List (1001px max width, flush with right margin) -->
            <div class="lg:col-span-8 space-y-12 sm:space-y-16">
                <!-- Section Headline: 70px Penpot -->
                <h2 class="font-sans font-bold text-3xl sm:text-5xl lg:text-[4.375rem] leading-[1.12] text-[#151515] tracking-[-0.03em]">
                    @if(app()->getLocale() === 'en')
                        Everything you need to know<br />before starting a project.
                    @else
                        Tudo que você precisa saber<br />para iniciarmos um projeto.
                    @endif
                </h2>

                @php
                    $faqItems = [
                        [
                            'q_en' => 'How long does a project take?',
                            'q_pt' => 'Quanto tempo dura um projeto?',
                            'a_en' => 'Timelines typically range between 3 to 8 weeks depending on the scope, interactive complexity, and motion design requirements.',
                            'a_pt' => 'Os prazos geralmente variam entre 3 a 8 semanas, dependendo do escopo, complexidade das animações e requisitos de design de cada marca.',
                        ],
                        [
                            'q_en' => 'How much does a project cost?',
                            'q_pt' => 'Quanto custa um projeto?',
                            'a_en' => 'Every project is custom-scoped according to your brand objectives, technical architecture, and visual identity deliverables.',
                            'a_pt' => 'Cada projeto é precificado sob medida de acordo com os objetivos da sua marca, arquitetura técnica e entregáveis de identidade visual.',
                        ],
                        [
                            'q_en' => 'What technologies are used for websites?',
                            'q_pt' => 'Quais as tecnologias usadas para website?',
                            'a_en' => 'We engineer with high-performance frameworks (Laravel, Vue/React, Tailwind CSS, GSAP) delivering lightning speed and fluid micro-interactions.',
                            'a_pt' => 'Desenvolvemos com frameworks de alta performance (Laravel, Vue/React, Tailwind CSS, GSAP), garantindo velocidade máxima e micro-interações fluidas.',
                        ],
                        [
                            'q_en' => 'What technologies are used in 3D?',
                            'q_pt' => 'Quais tecnologias usadas no 3D?',
                            'a_en' => 'We utilize Blender, Cinema 4D, Three.js, and WebGL to create realistic textures, cinematic lighting, and smooth interactive 3D viewports.',
                            'a_pt' => 'Utilizamos Blender, Cinema 4D, Three.js e WebGL para criar texturas realistas, iluminação cinematográfica e visualizações 3D interativas e leves.',
                        ],
                        [
                            'q_en' => 'How does payment work?',
                            'q_pt' => 'Como funciona o pagamento?',
                            'a_en' => 'Payments are structured in milestone-based installments (typically 50% upfront to initiate and 50% upon final delivery and deployment).',
                            'a_pt' => 'Os pagamentos são estruturados em etapas por marcos (geralmente 50% de entrada para início e 50% na entrega e publicação final).',
                        ],
                        [
                            'q_en' => 'I have a quick turnaround request, how does it work?',
                            'q_pt' => 'Tenho uma demanda rápida, como funciona?',
                            'a_en' => 'We offer dedicated sprint cycles for urgent high-priority requests depending on our active studio capacity. Reach out to verify availability.',
                            'a_pt' => 'Oferecemos sprints dedicados para demandas urgentes de alta prioridade, dependendo da capacidade atual do estúdio. Entre em contato para verificar.',
                        ],
                    ];
                @endphp

                <!-- Questions List -->
                <div class="faq-list border-t border-[#151515]/20 relative">
                    @foreach($faqItems as $index => $item)
                        <div class="faq-item relative rounded-[4px] py-5 sm:py-6 px-4 sm:px-6 cursor-pointer select-none group"
                             onclick="toggleFaqAccordion(this)">

                            <!-- Content -->
                            <div class="relative z-10 w-full">
                                <!-- Row Header -->
                                <div class="flex items-center justify-between gap-6">
                                    <div class="faq-title-wrap min-w-0 flex-1">
                                        <span class="faq-title block font-sans font-normal text-lg sm:text-xl lg:text-[1.5rem] tracking-[-0.01em] leading-[1.25]">
                                            {{ app()->getLocale() === 'en' ? $item['q_en'] : $item['q_pt'] }}
                                        </span>
                                    </div>

                                    <!-- Minimalist diagonal up-right arrow (Penpot: 13x13, stroke 2.68) -->
                                    <div class="faq-arrow-wrap flex items-center justify-center w-7 h-7 flex-shrink-0">
                                        <svg class="faq-arrow-icon w-3.5 h-3.5 stroke-current stroke-[2.2]" viewBox="0 0 13 13" fill="none">
                                            <line x1="2" y1="11" x2="11" y2="2" stroke-linecap="round"/>
                                            <polyline points="4 2 11 2 11 9" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Expandable Body with CSS Grid transition -->
                                <div class="faq-accordion-grid">
                                    <div class="overflow-hidden">
                                        <div class="faq-accordion-content pt-4 pb-1 min-w-0">
                                            <p class="faq-desc font-sans font-normal text-base sm:text-[18px] leading-relaxed tracking-normal max-w-2xl pr-4">
                                                {{ app()->getLocale() === 'en' ? $item['a_en'] : $item['a_pt'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Delimiter Line -->
                            <div class="faq-line absolute bottom-0 left-0 right-0 h-[1px] bg-[#151515]/20" aria-hidden="true"></div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
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

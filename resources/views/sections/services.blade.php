<section id="expertise" class="services-slider-section py-24 sm:py-32 lg:py-36 bg-[#f6f6f6] text-[#101010] relative w-full overflow-hidden select-none">
    {{-- Semantic content for SEO & Screen Readers --}}
    <div class="sr-only">
        @if(isset($services) && $services->isNotEmpty())
            @foreach($services as $s)
                <span>{{ $s->title }}</span>
                <span>{{ $s->category }}</span>
            @endforeach
        @endif
        <span>{{ __('Iniciar Projeto') }}</span>
    </div>

    <div class="w-full">
        <!-- Section Header: Centered with decorative vertical line (Penpot & Realevate style) -->
        <div class="services-intro site-container mx-auto text-center flex flex-col items-center px-4 sm:px-6">
            <!-- Down Arrow Indicator -->
            <svg class="block w-[0.875rem] h-[2.25rem] sm:w-4 sm:h-[2.75rem] text-[#101010] mb-6 sm:mb-8 norra-reveal" viewBox="0 0 16 44" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="8" y1="1" x2="8" y2="41" />
                <polyline points="1.5 34.5 8 41 14.5 34.5" />
            </svg>

            <!-- Main Heading (Frase Principal do Penpot) -->
            <h2 class="font-['Roboto_Condensed',var(--font-display)] font-extrabold text-3xl sm:text-5xl md:text-6xl lg:text-[4.75rem] leading-[1.05] tracking-[-0.035em] text-[#101010] max-w-4xl mx-auto uppercase norra-reveal" data-split>
                {{ $settings['services_title'] ?? (app()->getLocale() === 'en' ? 'A Complete Website Experience' : 'Uma Experiência de Website Completa') }}
            </h2>

            <!-- Auxiliary Subtitle (Frase Auxiliar do Penpot) -->
            <p class="font-sans font-bold text-base sm:text-xl lg:text-2xl leading-snug tracking-[-0.02em] text-[#101010]/85 max-w-2xl mx-auto mt-4 sm:mt-6 norra-reveal" data-split>
                {{ $settings['services_subtitle'] ?? (app()->getLocale() === 'en' ? 'We create websites that make your brand not just seen, but understood' : 'Criamos websites que fazem a sua marca não ser só vista, mas entendida') }}
            </p>
        </div>

        @php
            $sliderCards = [];
            if (isset($services) && $services->isNotEmpty()) {
                foreach ($services as $service) {
                    $img = $service->image;
                    if (!empty($img)) {
                        $imageUrl = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://'])
                            ? $img
                            : asset('storage/' . ltrim($img, '/'));
                    } else {
                        $imageUrl = asset('storage/vicz-imac-mockup.png');
                    }

                    $sliderCards[] = [
                        'title' => (string) ($service->title ?? 'Service Mockup'),
                        'category' => (string) ($service->category ?? ''),
                        'image' => $imageUrl,
                    ];
                }
            }

            // Fallback mockups in case database has no services at all
            if (empty($sliderCards)) {
                $sliderCards = [
                    ['title' => 'iMac Interface & Digital Architecture', 'category' => 'Website Development', 'image' => asset('storage/vicz-imac-mockup.png')],
                    ['title' => 'BHLA Arquitetura', 'category' => 'Website Design', 'image' => asset('storage/projects/1783533747011-BHLA-ARQUITETURA.webp')],
                    ['title' => 'Projeto Meta', 'category' => 'Website Strategy', 'image' => asset('storage/projects/1783538518016-SITE-PROJETO-META.webp')],
                    ['title' => 'Nog Arquitetura', 'category' => 'Brand Strategy', 'image' => asset('storage/projects/1783548230799-NOG-ARQUITETURA.webp')],
                    ['title' => 'Hub Arquitetura', 'category' => 'Visual Identity', 'image' => asset('storage/projects/1783454102263-hub.webp')],
                ];
            }
        @endphp

        <!-- Slanted Infinite Carousel Viewport -->
        <div class="services-slider-wrapper" id="services-slider-wrapper">
            <div class="services-slider-viewport cursor-grab active:cursor-grabbing"
                 id="services-slider-viewport"
                 aria-label="{{ app()->getLocale() === 'en' ? 'Projects & Services Gallery' : 'Galeria de Projetos e Serviços' }}">
                <div class="services-slider-track" id="services-slider-track">
                    @foreach($sliderCards as $card)
                        <div class="services-slider-item flex-shrink-0 relative pointer-events-none select-none" aria-hidden="true">
                            <div class="services-card-inner w-full h-full relative rounded-sm overflow-hidden bg-[#e6e6e8]">
                                <img src="{{ $card['image'] }}"
                                     alt="{{ $card['title'] }}"
                                     loading="lazy"
                                     decoding="async"
                                     draggable="false"
                                     class="w-full h-full object-cover pointer-events-none select-none" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

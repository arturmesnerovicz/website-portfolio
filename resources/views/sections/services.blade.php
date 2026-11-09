<section id="expertise" class="py-24 sm:py-32 bg-[#f6f6f6] text-[#101010] relative w-full overflow-visible">
    @if(isset($services) && $services->isNotEmpty())
        <div class="sr-only">
            @foreach($services as $s)
                <span>{{ $s->title }}</span>
            @endforeach
        </div>
    @endif
    <div class="w-full site-container">

        <!-- Section Header: Penpot EXPERTISE 78px - Indented at 187px (45px canvas margin + 142px indent) -->
        <div class="mb-12 sm:mb-16 pl-0 lg:pl-[8.875rem]">
            <h2 class="font-display font-bold text-4xl sm:text-6xl lg:text-[4.875rem] leading-none uppercase tracking-[-0.03em] text-[#101010]">
                {{ __('EXPERTISE') }}
            </h2>
        </div>

        <!-- Services Wrapper: Lines span 100% (1350px width), text indented to 142px -->
        <div class="services-wrapper relative w-full" id="services-wrapper">
            <!-- Top Delimiter Line in #d1d1d1 -->
            <div class="w-full h-[1px] bg-[#d1d1d1]" aria-hidden="true"></div>

            @php
                $serviceList = [
                    ['en' => 'Website Development', 'pt' => 'Desenvolvimento de Websites', 'img' => asset('storage/vicz-imac-mockup.png')],
                    ['en' => 'Website Design', 'pt' => 'Design de Websites', 'img' => asset('storage/services/website-design.png')],
                    ['en' => 'Website Strategy', 'pt' => 'Estratégia de Websites', 'img' => asset('storage/services/website-strategy.png')],
                    ['en' => 'Brand Strategy', 'pt' => 'Estratégia de Marca', 'img' => asset('storage/services/brand-strategy.png')],
                    ['en' => 'Visual Identity', 'pt' => 'Identidade Visual', 'img' => asset('storage/services/visual-identity.png')],
                ];
            @endphp

            <div class="services-list relative w-full">
                @foreach($serviceList as $index => $s)
                    <div class="service-item relative py-6 sm:py-7 lg:py-8 pl-0 lg:pl-[8.875rem] pr-4 sm:pr-8 cursor-pointer select-none group transition-opacity duration-300 {{ $index === 0 ? 'is-active' : '' }}"
                         data-service-index="{{ $index }}"
                         style="opacity: {{ $index === 0 ? '1' : '0.35' }};">

                        <!-- Row Content -->
                        <div class="relative z-10 w-full flex items-center justify-between">
                            <div class="service-title-wrap min-w-0 flex-1">
                                <span class="service-title block font-sans font-bold tracking-[-0.03em] text-3xl sm:text-5xl lg:text-[4.375rem] leading-[1.1] transition-all duration-300 ease-out group-hover:translate-x-3">
                                    {{ app()->getLocale() === 'en' ? $s['en'] : $s['pt'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Bottom Delimiter Line of this service item -->
                        <div class="absolute bottom-0 left-0 right-0 h-[1px] bg-[#d1d1d1]" aria-hidden="true"></div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Right-Aligned Preview Card (Penpot 220x280px) -->
            <div id="services-preview-wrap"
                 class="services-preview-wrap absolute right-0 pointer-events-none z-20 hidden lg:block"
                 style="width: 13.75rem; top: 0px; will-change: transform;"
                 aria-hidden="true">
                <div class="services-preview-card w-[13.75rem] h-[17.5rem] rounded-[2px] overflow-hidden bg-transparent relative flex items-center justify-center">
                    @foreach($serviceList as $index => $s)
                        <img src="{{ $s['img'] }}"
                             alt="{{ $s['en'] }}"
                             data-preview-index="{{ $index }}"
                             class="service-preview-img absolute inset-0 w-full h-full object-contain transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" />
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

<script>
(function() {
    function initServicesInteractive() {
        const wrapper = document.getElementById('services-wrapper');
        if (!wrapper || wrapper._servicesInitialized) return;
        wrapper._servicesInitialized = true;

        const items = wrapper.querySelectorAll('.service-item');
        const previewWrap = document.getElementById('services-preview-wrap');
        const previewImgs = previewWrap ? previewWrap.querySelectorAll('.service-preview-img') : [];

        if (!items.length || !previewWrap) return;

        const gsap = window.gsap;
        let isDesktop = window.matchMedia('(min-width: 1024px)').matches;
        let isFirst = true;

        window.addEventListener('resize', function() {
            isDesktop = window.matchMedia('(min-width: 1024px)').matches;
        }, { passive: true });

        function getRowCenterY(itemEl) {
            const wrapperRect = wrapper.getBoundingClientRect();
            const itemRect = itemEl.getBoundingClientRect();
            // previewCard has transform: translateY(-50%), so target is exact center line of row
            return (itemRect.top - wrapperRect.top) + (itemRect.height / 2);
        }

        function setActiveService(index, itemEl) {
            // Highlight active item, dim others to 0.35
            items.forEach(function(item, idx) {
                const isActive = (idx === index);
                item.classList.toggle('is-active', isActive);
                item.classList.toggle('is-hovered', isActive);
                if (gsap) {
                    gsap.to(item, {
                        opacity: isActive ? 1 : 0.35,
                        duration: 0.25,
                        ease: 'power2.out',
                        overwrite: 'auto'
                    });
                } else {
                    item.style.opacity = isActive ? '1' : '0.35';
                }
            });

            // Crossfade preview images
            previewImgs.forEach(function(img) {
                const imgIdx = parseInt(img.getAttribute('data-preview-index'), 10);
                const isActive = (imgIdx === index);
                if (gsap) {
                    gsap.to(img, {
                        opacity: isActive ? 1 : 0,
                        duration: 0.25,
                        ease: 'power2.out',
                        overwrite: 'auto'
                    });
                } else {
                    img.style.opacity = isActive ? '1' : '0';
                }
            });

            // Glide previewWrap fluidly to the row's center line
            if (itemEl && isDesktop) {
                const targetY = getRowCenterY(itemEl);

                if (isFirst) {
                    isFirst = false;
                    if (gsap) {
                        gsap.set(previewWrap, { y: targetY });
                        gsap.to(previewWrap, { opacity: 1, duration: 0.4, ease: 'power2.out' });
                    } else {
                        previewWrap.style.transform = 'translate3d(0, ' + targetY + 'px, 0)';
                        previewWrap.style.opacity = '1';
                    }
                } else {
                    if (gsap) {
                        gsap.to(previewWrap, {
                            y: targetY,
                            duration: 0.65,
                            ease: 'power2.out',
                            overwrite: 'auto'
                        });
                    } else {
                        previewWrap.style.transform = 'translate3d(0, ' + targetY + 'px, 0)';
                    }
                }
            }
        }

        // Initialize with first service active on desktop
        if (isDesktop && items[0]) {
            setActiveService(0, items[0]);
        }

        items.forEach(function(item) {
            const index = parseInt(item.getAttribute('data-service-index'), 10);

            item.addEventListener('mouseenter', function() {
                if (isDesktop) {
                    setActiveService(index, item);
                }
            });
        });

        // NOTE: On mouseleave, do NOT revert to all active! Maintain selected item.
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initServicesInteractive);
    } else {
        initServicesInteractive();
    }

    window.initServicesInteractive = initServicesInteractive;
})();
</script>

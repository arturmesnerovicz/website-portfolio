<section id="expertise" class="py-24 sm:py-32 md:py-36 bg-[#101010] text-[#ddddd5] relative border-t border-white/10 w-full overflow-visible">
    <div class="w-full px-[clamp(1.5rem,3.125vw,3.5rem)]">

        <!-- Section Header: Penpot EXPERTISE 78px - Aligned with Service Titles -->
        <div class="mb-10 sm:mb-14 px-4 sm:px-8">
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-[-1.5px] sm:tracking-[-2.5px] md:tracking-[-3.5px] lg:tracking-[-4.85px] text-[#ddddd5]">
                {{ __('EXPERTISE') }}
            </h2>
        </div>

        <!-- Services Wrapper: Relative container holding the services list & the right-aligned hover preview card -->
        <div class="services-wrapper relative w-full" id="services-wrapper">
            <!-- Top Delimiter Line with entrance animation from left to right -->
            <div class="service-line w-full" aria-hidden="true"></div>

            <div class="services-list relative w-full">
                @foreach($services as $index => $service)
                    @php
                        $imgUrl = $service->image
                            ? (str_starts_with($service->image, 'assets/') ? asset($service->image) : asset('storage/' . $service->image))
                            : asset('assets/services/' . \Illuminate\Support\Str::slug($service->title) . '.png');
                    @endphp
                    <div class="service-item relative py-4 sm:py-5 lg:py-5 px-4 sm:px-8 cursor-pointer select-none group"
                         data-service-index="{{ $index }}"
                         data-service-image="{{ $imgUrl }}">

                        <!-- Row Content -->
                        <div class="relative z-10 w-full flex items-center justify-between">
                            <!-- Left: Title (TeX Gyre Heros Bold 70px) -->
                            <div class="service-title-wrap min-w-0 flex-1">
                                <span class="service-title block font-sans font-bold tracking-[-1px] sm:tracking-[-1.5px] md:tracking-[-2px] lg:tracking-[-3px] text-[clamp(1.75rem,4.5vw,4rem)] leading-[1.15] text-[#ddddd5] transition-all duration-300 ease-out group-hover:text-white group-hover:translate-x-3 sm:group-hover:translate-x-4">
                                    {{ __($service->title) }}
                                </span>
                            </div>
                        </div>

                        <!-- Mobile Inline Preview (Touch devices < 1024px when tapped) -->
                        <div class="service-mobile-preview lg:hidden max-h-0 opacity-0 overflow-hidden transition-all duration-400 ease-out">
                            <div class="pt-4 pb-2 flex justify-start sm:justify-end">
                                <div class="w-[180px] h-[230px] rounded-[2px] overflow-hidden bg-[#e2e2e2] shadow-xl border border-white/10">
                                    <img src="{{ $imgUrl }}"
                                         alt="{{ $service->title }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover" />
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Delimiter Line of this service item -->
                        <div class="service-line absolute bottom-0 left-0 right-0" aria-hidden="true"></div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Right-Aligned Mockup Preview Wrap (Smooth GSAP floating tracking matching bymonolog.com) -->
            <div id="services-preview-wrap"
                 class="services-preview-wrap absolute right-4 sm:right-8 lg:right-0 pointer-events-none z-20 hidden lg:block"
                 style="width: 220px; top: 0px; will-change: transform;"
                 aria-hidden="true">
                <div class="services-preview-card w-[220px] h-[280px] rounded-[2px] overflow-hidden bg-[#e2e2e2] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] border border-white/10 relative">
                    @foreach($services as $index => $service)
                        @php
                            $imgUrl = $service->image
                                ? (str_starts_with($service->image, 'assets/') ? asset($service->image) : asset('storage/' . $service->image))
                                : asset('assets/services/' . \Illuminate\Support\Str::slug($service->title) . '.png');
                        @endphp
                        <img src="{{ $imgUrl }}"
                             alt="{{ $service->title }}"
                             data-preview-index="{{ $index }}"
                             class="service-preview-img absolute inset-0 w-full h-full object-cover opacity-0 pointer-events-none" />
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
            return (itemRect.top - wrapperRect.top) + (itemRect.height / 2);
        }

        function setActiveService(index, itemEl) {
            // Highlight active item, dim others to 0.3
            items.forEach(function(item, idx) {
                const isActive = (idx === index);
                item.classList.toggle('is-hovered', isActive);
                if (gsap) {
                    gsap.to(item, {
                        opacity: isActive ? 1 : 0.3,
                        duration: 0.25,
                        ease: 'power2.out',
                        overwrite: 'auto'
                    });
                } else {
                    item.style.opacity = isActive ? '1' : '0.3';
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

            // Glide previewWrap fluidly to the row's center (no bottom clamping, extends symmetrically)
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
                            duration: 0.85,
                            ease: 'ease-transition',
                            overwrite: 'auto'
                        });
                    } else {
                        previewWrap.style.transform = 'translate3d(0, ' + targetY + 'px, 0)';
                    }
                }
            }
        }

        function resetServiceOpacity() {
            // Restore all items to full opacity when cursor leaves the wrapper
            items.forEach(function(item) {
                item.classList.remove('is-hovered');
                if (gsap) {
                    gsap.to(item, { opacity: 1, duration: 0.35, ease: 'power2.out', overwrite: 'auto' });
                } else {
                    item.style.opacity = '1';
                }
            });
        }

        // Initialize with first service active on desktop (matching Monolog)
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

            // Mobile/tablet touch tap
            item.addEventListener('click', function() {
                if (!isDesktop) {
                    const mobilePreview = item.querySelector('.service-mobile-preview');
                    const wasOpen = item.classList.contains('is-mobile-open');

                    items.forEach(function(other) {
                        other.classList.remove('is-mobile-open');
                        const mp = other.querySelector('.service-mobile-preview');
                        if (mp) {
                            mp.style.maxHeight = '0px';
                            mp.classList.remove('opacity-100');
                            mp.classList.add('opacity-0');
                        }
                    });

                    if (!wasOpen && mobilePreview) {
                        item.classList.add('is-mobile-open');
                        mobilePreview.style.maxHeight = '300px';
                        mobilePreview.classList.remove('opacity-0');
                        mobilePreview.classList.add('opacity-100');
                    }
                }
            });
        });

        wrapper.addEventListener('mouseleave', function() {
            if (isDesktop) {
                resetServiceOpacity();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initServicesInteractive);
    } else {
        initServicesInteractive();
    }

    window.initServicesInteractive = initServicesInteractive;
})();
</script>

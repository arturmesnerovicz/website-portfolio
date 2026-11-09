@extends('layouts.app')

@section('content')
    <!-- MUP3 Special Showcase Section: Clean Apple-like solid aesthetic matching References -->
    <section id="mup3-presentation" data-bg="dark" class="pt-28 sm:pt-36 lg:pt-44 pb-20 sm:pb-28 lg:pb-32 bg-[#101010] text-[#f5f5f5] relative w-full overflow-hidden select-none">
        <div class="w-full site-container">

            <!-- Top Centered Header (Exact composition from Reference 2) -->
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center">
                <!-- Large Bold Headline (Alte Haas Grotesk Bold uppercase) -->
                <h1 class="norra-reveal is-revealed font-display font-bold text-[clamp(2.25rem,5.2vw,4.5rem)] leading-[1.05] uppercase tracking-[-1px] sm:tracking-[-2px] text-[#f5f5f5]">
                    {{ $showcase['title'] }}
                </h1>

                <!-- Centered Editorial Description (TeX Gyre Heros 400) -->
                <p class="font-sans font-normal text-sm sm:text-base lg:text-[18px] text-[#888888] leading-[1.4] max-w-2xl mt-4 sm:mt-5 text-balance">
                    {{ $showcase['description'] }}
                </p>

                <!-- Pill CTA Button (Reference 2) -->
                <div class="mt-6 sm:mt-8">
                    <a href="{{ $showcase['cta_url'] }}"
                       class="inline-flex items-center justify-center px-7 sm:px-8 py-2.5 sm:py-3 rounded-full bg-[#f5f5f5] text-[#101010] font-sans font-bold text-sm sm:text-[15px] tracking-tight hover:bg-white hover:scale-105 active:scale-95 transition-all shadow-md">
                        {{ $showcase['cta_text'] }}
                    </a>
                </div>
            </div>

            <!-- Two Product Cards Grid (Inverted aesthetic: White Card Body, Dark 3D Container) -->
            <div class="mt-12 sm:mt-16 lg:mt-20 max-w-[840px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

                <!-- CARD 01 -->
                <article class="bg-[#141414] text-white rounded-[14px] p-4 sm:p-5 flex flex-col justify-between shadow-2xl relative border border-white/5">
                    <!-- Inner Light 3D Product Container (White background) -->
                    <div id="mup3-card-container-1"
                         class="w-full h-[290px] sm:h-[330px] bg-[#ffffff] rounded-[10px] relative overflow-hidden flex items-center justify-center">
                        
                        <!-- Top-Right Action / Favorite Icon Button (High contrast dark circle on white) -->
                        <div class="absolute top-3.5 right-3.5 z-20 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#1c1c1e] text-white flex items-center justify-center shadow-md pointer-events-auto hover:bg-black transition-colors">
                            <svg class="w-4 h-4 stroke-[2.2] fill-none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>

                        <!-- 3D Interactive Canvas -->
                        <canvas id="mup3-card-canvas-1" class="w-full h-full block outline-none cursor-grab active:cursor-grabbing relative z-10 canvas-3d-unblur is-loading-model"></canvas>

                        <!-- Subtle 3D Loading Spinner with Backdrop Blur & Pulse Ring -->
                        <div id="mup3-card-loader-1" class="absolute inset-0 z-15 flex flex-col items-center justify-center bg-white/60 backdrop-blur-md transition-all duration-500 opacity-0 pointer-events-none">
                            <div class="relative flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full border border-black/10 animate-pulse-ring absolute"></div>
                                <div class="w-7 h-7 border-2 border-black/15 border-t-black rounded-full animate-spin"></div>
                            </div>
                        </div>

                        <!-- Fallback Thumbnail if WebGL is unavailable -->
                        <div id="mup3-card-fallback-1" class="absolute inset-0 z-10 hidden flex items-center justify-center p-4">
                            @if(!empty($showcase['card1']['model']['thumbnailUrl']))
                                <img src="{{ $showcase['card1']['model']['thumbnailUrl'] }}"
                                     alt="{{ $showcase['card1']['title'] }}"
                                     class="max-w-[85%] max-h-[85%] object-contain" />
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Information Area (Dark card body with clean light typography) -->
                    <div class="pt-4 sm:pt-5 pb-1 px-1 flex flex-col justify-between flex-grow">
                        <div>
                            <!-- Product Title: Light, bold, crisp -->
                            <h2 class="font-sans font-bold text-xl sm:text-[22px] lg:text-2xl text-white tracking-tight leading-snug truncate">
                                {{ $showcase['card1']['title'] }}
                            </h2>

                            <!-- Brand / Subtitle: Subtle gray -->
                            <p class="font-sans font-normal text-xs sm:text-sm text-[#a1a1a6] mt-0.5 tracking-tight truncate">
                                {{ $showcase['card1']['brand'] }}
                            </p>
                        </div>

                        <!-- Bottom Metric / Price & Action Row -->
                        <div class="flex items-center justify-between mt-5 sm:mt-6 pt-2">
                            <!-- Price / Spec Highlight -->
                            <span class="font-sans font-bold text-2xl sm:text-[26px] lg:text-[28px] text-white tracking-tight">
                                {{ $showcase['card1']['price'] }}
                            </span>

                            <!-- Circular Action Button (Solid white circle with black icon) -->
                            <a href="{{ $showcase['card1']['button_url'] }}"
                               class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-black flex items-center justify-center hover:bg-[#eaeaea] hover:scale-105 active:scale-95 transition-all shadow-md group"
                               aria-label="{{ __('Ação para') }} {{ $showcase['card1']['title'] }}">
                                <svg class="w-5 h-5 stroke-[2] transform group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- CARD 02 -->
                <article class="bg-[#141414] text-white rounded-[14px] p-4 sm:p-5 flex flex-col justify-between shadow-2xl relative border border-white/5">
                    <!-- Inner Light 3D Product Container (White background) -->
                    <div id="mup3-card-container-2"
                         class="w-full h-[290px] sm:h-[330px] bg-[#ffffff] rounded-[10px] relative overflow-hidden flex items-center justify-center">
                        
                        <!-- Top-Right Action / Favorite Icon Button (High contrast dark circle on white) -->
                        <div class="absolute top-3.5 right-3.5 z-20 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#1c1c1e] text-white flex items-center justify-center shadow-md pointer-events-auto hover:bg-black transition-colors">
                            <svg class="w-4 h-4 stroke-[2.2] fill-none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>

                        <!-- 3D Interactive Canvas -->
                        <canvas id="mup3-card-canvas-2" class="w-full h-full block outline-none cursor-grab active:cursor-grabbing relative z-10 canvas-3d-unblur is-loading-model"></canvas>

                        <!-- Subtle 3D Loading Spinner with Backdrop Blur & Pulse Ring -->
                        <div id="mup3-card-loader-2" class="absolute inset-0 z-15 flex flex-col items-center justify-center bg-white/60 backdrop-blur-md transition-all duration-500 opacity-0 pointer-events-none">
                            <div class="relative flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full border border-black/10 animate-pulse-ring absolute"></div>
                                <div class="w-7 h-7 border-2 border-black/15 border-t-black rounded-full animate-spin"></div>
                            </div>
                        </div>

                        <!-- Fallback Thumbnail if WebGL is unavailable -->
                        <div id="mup3-card-fallback-2" class="absolute inset-0 z-10 hidden flex items-center justify-center p-4">
                            @if(!empty($showcase['card2']['model']['thumbnailUrl']))
                                <img src="{{ $showcase['card2']['model']['thumbnailUrl'] }}"
                                     alt="{{ $showcase['card2']['title'] }}"
                                     class="max-w-[85%] max-h-[85%] object-contain" />
                            @endif
                        </div>
                    </div>

                    <!-- Bottom Information Area (Dark card body with clean light typography) -->
                    <div class="pt-4 sm:pt-5 pb-1 px-1 flex flex-col justify-between flex-grow">
                        <div>
                            <!-- Product Title: Light, bold, crisp -->
                            <h2 class="font-sans font-bold text-xl sm:text-[22px] lg:text-2xl text-white tracking-tight leading-snug truncate">
                                {{ $showcase['card2']['title'] }}
                            </h2>

                            <!-- Brand / Subtitle: Subtle gray -->
                            <p class="font-sans font-normal text-xs sm:text-sm text-[#a1a1a6] mt-0.5 tracking-tight truncate">
                                {{ $showcase['card2']['brand'] }}
                            </p>
                        </div>

                        <!-- Bottom Metric / Price & Action Row -->
                        <div class="flex items-center justify-between mt-5 sm:mt-6 pt-2">
                            <!-- Price / Spec Highlight -->
                            <span class="font-sans font-bold text-2xl sm:text-[26px] lg:text-[28px] text-white tracking-tight">
                                {{ $showcase['card2']['price'] }}
                            </span>

                            <!-- Circular Action Button (Solid white circle with black icon) -->
                            <a href="{{ $showcase['card2']['button_url'] }}"
                               class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white text-black flex items-center justify-center hover:bg-[#eaeaea] hover:scale-105 active:scale-95 transition-all shadow-md group"
                               aria-label="{{ __('Ação para') }} {{ $showcase['card2']['title'] }}">
                                <svg class="w-5 h-5 stroke-[2] transform group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>

            </div>

        </div>

        <!-- 3D Engine Showcase Payload -->
        <script type="application/json" id="mup3-showcase-data">
            {!! json_encode([
                'card1' => [
                    'model' => $showcase['card1']['model'] ?? null,
                    'local3d' => $showcase['card1']['local3d'] ?? null,
                ],
                'card2' => [
                    'model' => $showcase['card2']['model'] ?? null,
                    'local3d' => $showcase['card2']['local3d'] ?? null,
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    </section>
@endsection

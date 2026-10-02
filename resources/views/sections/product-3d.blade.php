@php
    $eyebrow = app()->getLocale() === 'en' 
        ? ($settings['section_3d_eyebrow_en'] ?? 'DESIGN & ENGINEERING') 
        : ($settings['section_3d_eyebrow'] ?? 'DESIGN & ENGENHARIA');

    $title = app()->getLocale() === 'en' 
        ? ($settings['section_3d_title_en'] ?? "Unibody craft.\nA single work of art.") 
        : ($settings['section_3d_title'] ?? "Estrutura unibody.\nUma obra única.");

    $description = app()->getLocale() === 'en' 
        ? ($settings['section_3d_subtitle_en'] ?? $settings['section_3d_description_en'] ?? 'Explore millimeter precision, switch models and customize bespoke blade metals, custom grips and finishes in real time.') 
        : ($settings['section_3d_subtitle'] ?? $settings['section_3d_description'] ?? 'Explore proporções milimétricas, alterne modelos e customize ligas nobres, empunhaduras e acabamentos sob medida em tempo real.');

    $initialModel = !empty($product3dPayload['models']) ? $product3dPayload['models'][0] : null;
    if (!empty($product3dPayload['initialModelSlug'])) {
        foreach ($product3dPayload['models'] as $m) {
            if ($m['slug'] === $product3dPayload['initialModelSlug']) {
                $initialModel = $m;
                break;
            }
        }
    }
@endphp

<div id="experiencia-3d" class="pt-12 sm:pt-16 lg:pt-[3.5vw] relative w-full overflow-hidden select-none">
    <!-- Top Divider Line with Arrow Indicator matching Projects Flow -->
    <div class="w-full flex items-center gap-2 sm:gap-2.5 lg:gap-[10px] mb-6 sm:mb-8 lg:mb-10">
        <div class="flex-1 h-[1px] bg-[#a2a1a1]"></div>
        <span class="text-[#101010] flex-shrink-0 flex items-center">
            <svg width="31" height="12" viewBox="0 0 31 12" fill="none" class="stroke-current stroke-2 w-[24px] sm:w-[31px] h-auto">
                <path d="M0 6H29M29 6L21 1M29 6L21 11" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
        
        <!-- Section Header (Penpot & Projects Section Typography Harmony) -->
        <div class="max-w-4xl mb-8 sm:mb-12 lg:mb-14">
            @if(!empty($eyebrow))
                <span class="text-[#707070] font-mono text-[11px] sm:text-xs tracking-[0.25em] uppercase block mb-2 sm:mb-3 font-semibold">
                    {{ $eyebrow }}
                </span>
            @endif
            <h2 class="norra-reveal font-display font-bold text-[clamp(2.5rem,5.5vw,4.875rem)] leading-none uppercase tracking-[-1.5px] sm:tracking-[-2.5px] md:tracking-[-3px] lg:tracking-[-4px] text-[#101010] mb-3 sm:mb-4">
                {!! nl2br(e($title)) !!}
            </h2>
            @if(!empty($description))
                <p class="text-[#505050] font-sans text-sm sm:text-base md:text-lg max-w-2xl leading-relaxed font-light">
                    {{ $description }}
                </p>
            @endif
        </div>

        <!-- 3D Stage Container (Only region with stroke/border) -->
        <div id="product-3d-container" class="relative w-full rounded-[14px] bg-[#121212] border border-black/15 shadow-[0_24px_60px_-15px_rgba(0,0,0,0.35)] overflow-hidden min-h-[520px] sm:min-h-[580px] lg:min-h-[660px] flex flex-col justify-between p-5 sm:p-7 lg:p-9 transition-all">

            <!-- Top Bar Inside Stage: Model Switcher & 360 Hint (Solid, No Transparency, No Stroke) -->
            <div class="relative z-30 w-full flex flex-wrap items-center justify-between gap-4 pointer-events-auto">
                
                <!-- Product Model Selector Track (Solid Background, Zero Stroke) -->
                <div id="product-3d-model-switcher" class="relative flex items-center p-1 bg-[#1c1c1e] rounded-[4px] select-none" role="tablist" aria-label="Modelos 3D">
                    <!-- Sliding Rail Highlight Pill -->
                    <div id="product-model-indicator" class="absolute left-0 top-1 bottom-1 rounded-[2px] bg-white pointer-events-none z-0 shadow-sm transition-opacity duration-200"></div>

                    @if(!empty($product3dPayload['models']))
                        @foreach($product3dPayload['models'] as $idx => $model)
                            @php
                                $isInitial = ($model['slug'] === ($initialModel['slug'] ?? ''));
                            @endphp
                            <button type="button"
                                    class="product-model-tab relative z-10 inline-flex items-center justify-center text-center px-3.5 sm:px-5 py-1.5 sm:py-2 rounded-[2px] text-xs sm:text-sm font-medium transition-colors duration-200 cursor-pointer whitespace-nowrap {{ $isInitial ? 'text-black font-semibold' : 'text-[#a1a1a6] hover:text-white' }}"
                                    data-model-slug="{{ $model['slug'] }}"
                                    role="tab"
                                    aria-selected="{{ $isInitial ? 'true' : 'false' }}">
                                {{ $model['name'] }}
                            </button>
                        @endforeach
                    @endif
                </div>

                <!-- 360° Interactive Hint Pill (Solid Background, Zero Stroke) -->
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-[4px] bg-[#1c1c1e] text-[11px] text-[#a1a1a6] pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-[#a1a1a6] animate-spin-slow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56" stroke-linecap="round"/>
                        <path d="M21 3v6h-6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'en' ? 'Drag to rotate 360°' : 'Arraste para girar em 360°' }}</span>
                </div>
            </div>

            <!-- Discrete Zoom Controls (+ / - / Reset) (Solid Background, Zero Stroke) -->
            <div id="product-3d-zoom-controls" class="absolute right-5 sm:right-7 top-20 sm:top-24 flex flex-col gap-2 z-30 {{ ($product3dPayload['allowZoom'] ?? true) ? '' : 'hidden' }}">
                <button type="button" id="product-3d-zoom-in" class="w-8 h-8 rounded-[4px] bg-[#1c1c1e] text-[#a1a1a6] hover:text-white hover:bg-[#2c2c2e] flex items-center justify-center transition-colors cursor-pointer" aria-label="{{ app()->getLocale() === 'en' ? 'Zoom In' : 'Aproximar' }}" title="{{ app()->getLocale() === 'en' ? 'Zoom In' : 'Aproximar' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
                <button type="button" id="product-3d-zoom-out" class="w-8 h-8 rounded-[4px] bg-[#1c1c1e] text-[#a1a1a6] hover:text-white hover:bg-[#2c2c2e] flex items-center justify-center transition-colors cursor-pointer" aria-label="{{ app()->getLocale() === 'en' ? 'Zoom Out' : 'Afastar' }}" title="{{ app()->getLocale() === 'en' ? 'Zoom Out' : 'Afastar' }}">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
                <button type="button" id="product-3d-zoom-reset" class="w-8 h-8 rounded-[4px] bg-[#1c1c1e] text-[#a1a1a6] hover:text-white hover:bg-[#2c2c2e] flex items-center justify-center transition-colors cursor-pointer" aria-label="{{ app()->getLocale() === 'en' ? 'Reset View' : 'Redefinir Visão' }}" title="{{ app()->getLocale() === 'en' ? 'Reset View' : 'Redefinir Visão' }}">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </button>
            </div>

            <!-- Central 3D Canvas Stage -->
            <div id="product-3d-stage" class="absolute inset-0 z-10 w-full h-full flex items-center justify-center cursor-grab active:cursor-grabbing">
                <canvas id="product-3d-canvas" class="w-full h-full block outline-none canvas-3d-unblur is-loading-model"></canvas>

                <!-- Subtle Contact Shadow Plane Underneath -->
                <div class="absolute bottom-16 sm:bottom-20 left-1/2 -translate-x-1/2 w-[65%] max-w-[500px] h-[35px] bg-black/60 rounded-[100%] blur-[24px] pointer-events-none -z-1"></div>

                <!-- Sleek Minimalist Loading Indicator with Elegant Pulse & Backdrop Blur -->
                <div id="product-3d-loader" class="absolute inset-0 z-20 flex flex-col items-center justify-center bg-[#121212]/50 backdrop-blur-md transition-all duration-500 opacity-0 pointer-events-none">
                    <div class="relative flex items-center justify-center mb-3">
                        <div class="w-10 h-10 rounded-full border border-white/10 animate-pulse-ring absolute"></div>
                        <div class="w-7 h-7 rounded-full border-2 border-white/15 border-t-white animate-spin"></div>
                    </div>
                    <span class="text-[11px] uppercase tracking-[0.25em] text-[#a1a1a6] font-mono">
                        {{ app()->getLocale() === 'en' ? 'Loading 3D...' : 'Carregando 3D...' }}
                    </span>
                </div>

                <!-- Fallback Image (When WebGL or network unavailable) -->
                <div id="product-3d-fallback" class="absolute inset-0 z-15 hidden flex items-center justify-center pointer-events-none p-6">
                    <img id="product-3d-fallback-img"
                         src="{{ $initialModel['thumbnailUrl'] ?? '' }}"
                         alt="{{ $initialModel['name'] ?? 'Produto 3D Norra' }}"
                         class="max-w-[85%] max-h-[80%] object-contain drop-shadow-[0_20px_40px_rgba(0,0,0,0.8)] opacity-95">
                </div>
            </div>

            <!-- Bottom Controls: Metadata (Left) and Floating Swatches (Directly Over 3D on Bottom Right) -->
            <div class="relative z-30 w-full flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 pointer-events-none mt-auto">

                <!-- Left Column: Active Model Metadata (Clean, Pointer Events Enabled) -->
                <div class="max-w-sm pointer-events-auto">
                    <h3 id="product-3d-name" class="font-display font-bold text-2xl sm:text-3xl text-white tracking-tight mb-1">
                        {{ $initialModel['name'] ?? '' }}
                    </h3>
                    <p id="product-3d-subtitle" class="{{ !empty($initialModel['subtitle']) ? 'block' : 'hidden' }} text-xs sm:text-sm text-[#a1a1a6] font-light">
                        {{ $initialModel['subtitle'] ?? '' }}
                    </p>
                    <p id="product-3d-description" class="{{ !empty($initialModel['description']) ? 'block' : 'hidden' }} text-[11px] sm:text-xs text-[#8e8e93] font-normal leading-relaxed mt-1.5 max-w-xs sm:max-w-sm">
                        {{ $initialModel['description'] ?? '' }}
                    </p>
                </div>

                <!-- Right Column: Floating Swatches directly over 3D (No bulky card box, Clean & Minimal) -->
                <div id="product-3d-floating-dock" class="{{ (!empty($initialModel['parts']) && count($initialModel['parts']) > 0) ? 'flex' : 'hidden' }} flex-col items-start sm:items-end gap-2.5 pointer-events-auto mr-16 sm:mr-20 lg:mr-24">
                    
                    <!-- Sleek Part Selector (Rendered dynamically if > 1 part) -->
                    <div id="product-3d-parts-nav" class="hidden items-center gap-2">
                        <!-- Populated dynamically via JS when model has multiple parts -->
                    </div>

                    <!-- Material / Color Swatches (Floating directly over the 3D scene) -->
                    <div id="product-3d-swatches" class="flex items-center gap-2 sm:gap-2.5 flex-wrap sm:justify-end">
                        <!-- Populated dynamically via JS -->
                    </div>

                </div>

            </div>

        </div>

    <!-- Data Payload for Three.js Configurator -->
    <script type="application/json" id="product-3d-data">
        {!! json_encode($product3dPayload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
</div>

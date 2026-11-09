<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'en' ? 'en' : 'pt-BR' }}" class="scroll-smooth bg-[#f6f6f6] text-[#101010] antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & SEO Meta -->
    <title>{{ app()->getLocale() === 'en' ? ($settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering') : ($settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web') }}</title>
    <meta name="description" content="{{ app()->getLocale() === 'en' ? ($settings['seo_description_en'] ?? 'Digital design and engineering studio crafting modern websites, immersive interfaces, and high-end brand experiences.') : ($settings['seo_description'] ?? 'Estúdio de design e engenharia digital focado em websites modernos, interfaces imersivas e experiências de alto padrão.') }}">
    <meta name="keywords" content="{{ app()->getLocale() === 'en' ? ($settings['seo_keywords_en'] ?? 'web design, web development, modern websites, landing page, branding, 3D motion') : ($settings['seo_keywords'] ?? 'web design, desenvolvimento web, sites modernos, landing page, branding, 3D motion') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Multilingual Alternate Links (hreflang for SEO) -->
    <link rel="alternate" hreflang="pt-BR" href="{{ $urlPt ?? url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ $urlEn ?? url('/en') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('storage/' . ($settings['brand_favicon'] ?? 'settings/favicons/1779475070756-vkuzh.webp')) }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    @php
        $rawOgImage = $settings['og_image'] ?? null;
        if (!empty($rawOgImage)) {
            $ogImageUrl = str_starts_with($rawOgImage, 'http://') || str_starts_with($rawOgImage, 'https://')
                ? $rawOgImage
                : asset('storage/' . ltrim($rawOgImage, '/'));
        } else {
            $ogImageUrl = asset('assets/logos/norra-monogram.png');
        }
    @endphp

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'Estúdio Norra' }}">
    <meta property="og:title" content="{{ app()->getLocale() === 'en' ? ($settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering') : ($settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web') }}">
    <meta property="og:description" content="{{ app()->getLocale() === 'en' ? ($settings['seo_description_en'] ?? 'Crafting high-end digital experiences for ambitious brands and demanding founders.') : ($settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.') }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:image:secure_url" content="{{ $ogImageUrl }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $settings['site_name'] ?? 'Estúdio Norra' }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'pt_BR' }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ app()->getLocale() === 'en' ? ($settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering') : ($settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web') }}">
    <meta name="twitter:description" content="{{ app()->getLocale() === 'en' ? ($settings['seo_description_en'] ?? 'Crafting high-end digital experiences for ambitious brands and demanding founders.') : ($settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.') }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

    <!-- Fonts Preload -->
    <link rel="preload" href="{{ asset('fonts/alte-haas-grotesk-700.woff') }}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{ asset('fonts/tex-gyre-heros-400.woff') }}" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="{{ asset('fonts/tex-gyre-heros-700.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => $settings['site_name'] ?? 'Estúdio Norra',
        'url' => url('/'),
        'logo' => asset('assets/logos/logo.svg'),
        'description' => $settings['seo_description'] ?? 'Estúdio de design e engenharia digital especializado em websites modernos, interfaces e identidades de alto padrão.',
        'telephone' => '+5567981530042',
        'email' => 'contato@estudionorra.com',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Campo Grande',
            'addressRegion' => 'MS',
            'addressCountry' => 'BR',
        ],
        'priceRange' => '$$',
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'Brasil',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f6f6f6] text-[#101010] font-sans selection:bg-[#151515] selection:text-[#f6f6f6] flex flex-col relative overflow-x-clip">

    <!-- Subtle Film Grain / Noise Overlay (Basic Agency Style) -->
    @php
        $noiseEnabled = ($settings['site_noise_enabled'] ?? '1') !== '0';
        $noiseOpacity = (float) str_replace(',', '.', (string) ($settings['site_noise_opacity'] ?? '0.05'));
        $noiseOpacity = max(0.01, min(1.00, $noiseOpacity));
    @endphp
    @if($noiseEnabled)
        <div class="site-noise" style="--noise-bg: url('{{ asset('assets/noise.png') }}'); --site-noise-opacity: {{ $noiseOpacity }};" aria-hidden="true"></div>
    @endif

    <!-- Canvas Flow Field Preloader -->
    @include('components.preloader')

    <!-- Navigation Header -->
    @include('components.navbar')

    <!-- Exo Ape Page Transition Container -->
    <div id="exo-page-container" class="relative w-full flex-grow flex flex-col">
        <div id="exo-page-content" class="relative w-full flex-grow flex flex-col">
            <!-- Main Content Slot -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>

    <!-- Project Preview Modal -->
    @include('components.project-modal')

    <!-- Lateral Contact Drawer (Penpot 'formulário lateral') -->
    @include('components.contact-drawer')

    <!-- Notification Toast Container -->
    <div id="norra-toast" class="fixed top-6 right-6 z-50 transform -translate-y-24 opacity-0 transition-all duration-500 max-w-md w-full pointer-events-none">
        <div id="norra-toast-card" class="bg-[#151515] border border-white/10 rounded-2xl p-4 shadow-2xl flex items-start space-x-3 pointer-events-auto">
            <div id="norra-toast-icon" class="flex-shrink-0 w-6 h-6 mt-0.5"></div>
            <div class="flex-1">
                <p id="norra-toast-title" class="text-sm font-semibold text-white"></p>
                <p id="norra-toast-msg" class="text-xs text-[#888888] mt-0.5"></p>
            </div>
            <button onclick="hideToast()" class="text-white/40 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

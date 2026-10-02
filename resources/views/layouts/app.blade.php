<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'en' ? 'en' : 'pt-BR' }}" class="scroll-smooth bg-[#101010] text-[#f5f5f5] antialiased">
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

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'Estúdio Norra' }}">
    <meta property="og:title" content="{{ app()->getLocale() === 'en' ? ($settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering') : ($settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web') }}">
    <meta property="og:description" content="{{ app()->getLocale() === 'en' ? ($settings['seo_description_en'] ?? 'Crafting high-end digital experiences for ambitious brands and demanding founders.') : ($settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.') }}">
    <meta property="og:image" content="{{ asset('assets/logos/logo.svg') }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'pt_BR' }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ app()->getLocale() === 'en' ? ($settings['seo_title_en'] ?? 'Estúdio Norra | Web Design & Digital Engineering') : ($settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web') }}">
    <meta name="twitter:description" content="{{ app()->getLocale() === 'en' ? ($settings['seo_description_en'] ?? 'Crafting high-end digital experiences for ambitious brands and demanding founders.') : ($settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.') }}">
    <meta name="twitter:image" content="{{ asset('assets/logos/logo.svg') }}">

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
<body class="min-h-screen bg-[#101010] text-[#f5f5f5] font-sans selection:bg-[#b70606] selection:text-white flex flex-col relative overflow-x-hidden">

    <!-- Subtle Film Grain / Noise Overlay (Basic Agency Style) -->
    @php
        $noiseEnabled = ($settings['site_noise_enabled'] ?? '1') !== '0';
        $noiseOpacity = $settings['site_noise_opacity'] ?? '0.05';
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

    <!-- Floating WhatsApp Action Button (Dynamic Contrast & Proportional Icon) -->
    <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}?text={{ urlencode('Olá! Gostaria de conversar sobre um projeto com o Estúdio Norra.') }}"
       target="_blank"
       rel="noopener noreferrer"
       id="whatsapp-floating-btn"
       class="whatsapp-floating-btn is-dark-bg"
       aria-label="{{ __('Fale Conosco pelo WhatsApp') }}">
        <svg class="whatsapp-floating-icon" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.301-.15-1.78-.879-2.056-.98-.276-.1-.476-.15-.677.15-.2.302-.777.98-.952 1.18-.176.2-.351.226-.652.075-.3-.15-1.268-.468-2.416-1.493-.894-.799-1.498-1.787-1.674-2.088-.176-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.3.301-.501.1-.2.05-.376-.025-.526-.075-.15-.677-1.634-.927-2.235-.244-.587-.492-.507-.677-.517l-.577-.01c-.2 0-.527.075-.802.376s-1.054 1.03-1.054 2.511 1.079 2.912 1.23 3.113c.15.2 2.123 3.243 5.143 4.547.719.31 1.28.497 1.718.636.722.23 1.378.197 1.898.12.578-.087 1.78-.727 2.03-1.43.25-.703.25-1.305.176-1.43-.075-.126-.276-.201-.577-.351zM12.042 21.998c-1.802 0-3.57-.486-5.12-1.408l-.367-.218-3.805.998 1.016-3.71-.24-.382c-1.013-1.613-1.548-3.483-1.548-5.399 0-5.464 4.446-9.91 9.913-9.91 2.646 0 5.134 1.03 7.006 2.902 1.872 1.872 2.902 4.36 2.902 7.008 0 5.466-4.446 9.919-9.757 9.919zm8.413-18.332C18.204 1.417 15.244.25 12.042.25 5.558.25.28 5.528.28 12.012c0 2.072.541 4.096 1.568 5.875L0 23.75l6.023-1.58c1.718.937 3.65 1.43 5.617 1.43h.005c6.484 0 11.762-5.279 11.762-11.763 0-3.142-1.224-6.096-3.452-8.324z"/>
        </svg>
    </a>

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

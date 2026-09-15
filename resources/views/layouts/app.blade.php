<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth bg-[#101010] text-[#f5f5f5] antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & SEO Meta -->
    <title>{{ $settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web' }}</title>
    <meta name="description" content="{{ $settings['seo_description'] ?? 'Estúdio de design e engenharia digital focado em websites modernos, interfaces imersivas e experiências de alto padrão.' }}">
    <meta name="keywords" content="{{ $settings['seo_keywords'] ?? 'web design, desenvolvimento web, sites modernos, landing page, branding, 3D motion' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="{{ asset('storage/' . ($settings['brand_favicon'] ?? 'settings/favicons/1779475070756-vkuzh.webp')) }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'Estúdio Norra' }}">
    <meta property="og:title" content="{{ $settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web' }}">
    <meta property="og:description" content="{{ $settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.' }}">
    <meta property="og:image" content="{{ asset('assets/logos/logo.svg') }}">
    <meta property="og:locale" content="pt_BR">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['seo_title'] ?? 'Estúdio Norra | Design e Desenvolvimento Web' }}">
    <meta name="twitter:description" content="{{ $settings['seo_description'] ?? 'Criamos experiências digitais exclusivas para marcas consolidadas e fundadores exigentes.' }}">
    <meta name="twitter:image" content="{{ asset('assets/logos/logo.svg') }}">

    <!-- Fonts -->
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
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#101010] text-[#f5f5f5] font-sans selection:bg-[#b70606] selection:text-white flex flex-col relative overflow-x-hidden">

    <!-- Canvas Flow Field Preloader -->
    @include('components.preloader')

    <!-- Navigation Header -->
    @include('components.navbar')

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Project Preview Modal -->
    @include('components.project-modal')

    <!-- Footer -->
    @include('components.footer')

    <!-- Floating WhatsApp Action Button -->
    <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}?text={{ urlencode('Olá! Gostaria de conversar sobre um projeto com o Estúdio Norra.') }}"
       target="_blank"
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-40 flex items-center justify-center w-14 h-14 rounded-full bg-[#25d366] text-white shadow-2xl shadow-[#25d366]/40 hover:scale-110 active:scale-95 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-[#25d366]/30"
       aria-label="Fale Conosco pelo WhatsApp">
        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.815 2.8.815 3.181 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.765-5.772-5.765zm3.376 8.204c-.14.393-.812.753-1.127.798-.316.046-.72.072-2.074-.486-1.637-.674-2.695-2.339-2.776-2.449-.081-.11-.663-.881-.663-1.68 0-.799.418-1.192.567-1.354.148-.162.325-.203.433-.203.109 0 .217.001.312.006.1.005.234-.038.366.279.136.326.464 1.134.505 1.216.041.082.069.177.014.286-.055.109-.082.177-.163.272-.081.095-.171.212-.244.285-.082.082-.167.171-.072.334.095.163.424.7 1.026 1.236.774.69 1.427.904 1.63.999.203.095.323.082.444-.055.121-.136.518-.602.656-.807.138-.205.276-.171.464-.101.188.07 1.195.563 1.401.666.206.103.344.153.395.24.051.087.051.506-.089.899z"/>
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

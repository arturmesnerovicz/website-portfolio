<section id="faq" class="py-24 md:py-36 bg-[#101010] text-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            <!-- Left Column: Title & Callout Card -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                        <span>Perguntas Frequentes</span>
                    </div>

                    <h2 class="font-display font-extrabold text-[clamp(1.85rem,3.5vw,3rem)] leading-tight tracking-tight text-white">
                        Tudo o que você precisa saber para iniciarmos um projeto.
                    </h2>

                    <p class="text-sm sm:text-base text-[#888888] leading-relaxed font-normal">
                        Transparência do primeiro contato até o deploy. Se não encontrar o que procura, nosso time está à disposição para conversar diretamente.
                    </p>
                </div>

                <!-- Callout Box -->
                <div class="p-6 sm:p-8 rounded-3xl bg-[#151515] border border-white/10 space-y-4">
                    <div class="w-10 h-10 rounded-full bg-[#b70606]/20 border border-[#b70606]/40 flex items-center justify-center text-[#ff4d4d]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-white text-lg">Ficou com alguma dúvida específica?</h3>
                        <p class="text-xs sm:text-sm text-[#888888] mt-1">Converse diretamente conosco agora mesmo pelo WhatsApp.</p>
                    </div>
                    <div>
                        <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#ddddd5] text-[#101010] font-bold text-xs uppercase tracking-wider hover:bg-white transition-colors shadow-lg">
                            <span>Chamar no WhatsApp</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Accordion Items -->
            <div class="lg:col-span-7 divide-y divide-white/10 border-t border-b border-white/10">
                @foreach($faqs as $index => $faq)
                    <div class="faq-item group py-6 cursor-pointer" onclick="toggleFaqAccordion(this)">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="font-display font-semibold text-base sm:text-lg text-white group-hover:text-[#ddddd5] transition-colors pr-4">
                                {{ $faq->question }}
                            </h3>
                            <div class="faq-chevron w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-white/60 group-hover:text-white group-hover:border-white/30 flex-shrink-0 transition-transform duration-300">
                                <svg class="w-3.5 h-3.5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>

                        <div class="faq-body overflow-hidden transition-all duration-300 ease-in-out {{ $index === 0 ? 'max-h-60 opacity-100 mt-4' : 'max-h-0 opacity-0' }}">
                            <p class="text-xs sm:text-sm text-[#aaaaaa] leading-relaxed pr-6">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaqAccordion(element) {
    const body = element.querySelector('.faq-body');
    const chevron = element.querySelector('.faq-chevron svg');
    const isOpen = body.classList.contains('opacity-100');

    // Close all siblings
    document.querySelectorAll('.faq-item').forEach(item => {
        const b = item.querySelector('.faq-body');
        const c = item.querySelector('.faq-chevron svg');
        b.classList.remove('opacity-100');
        b.classList.add('max-h-0', 'opacity-0');
        b.classList.remove('max-h-60', 'mt-4');
        c.style.transform = 'rotate(0deg)';
    });

    if (!isOpen) {
        body.classList.remove('max-h-0', 'opacity-0');
        body.classList.add('max-h-60', 'opacity-100', 'mt-4');
        chevron.style.transform = 'rotate(45deg)';
    }
}
</script>

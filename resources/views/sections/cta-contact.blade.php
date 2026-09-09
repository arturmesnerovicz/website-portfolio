<section id="contato" class="relative w-full min-h-[650px] lg:min-h-[850px] flex items-center justify-center overflow-hidden border-t border-white/10">
    <!-- Full-width Photographic Studio Background from Penpot -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/cta-bg.png') }}"
             alt="Estúdio Norra Studio Atmosphere"
             class="w-full h-full object-cover object-center filter brightness-60 contrast-110">
        <div class="absolute inset-0 bg-[#101010]/50 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#101010] via-transparent to-[#101010]/80"></div>
    </div>

    <!-- Centered Content Matching Penpot 'Seção CTA Final' -->
    <div class="relative z-10 max-w-[1100px] mx-auto px-6 sm:px-8 py-24 text-center space-y-10 lg:space-y-14">
        <h2 class="font-display font-bold text-[clamp(2.5rem,6.5vw,6.25rem)] leading-[1.05] uppercase tracking-tight text-[#ddddd5] drop-shadow-lg">
            {{ $settings['cta_title'] ?? "VAMOS CRIAR\nUMA EXPERIÊNCIA QUE MOVE\nSUA MARCA" }}
        </h2>

        <div class="pt-4 flex justify-center">
            <button type="button"
                    onclick="openContactModal()"
                    class="group inline-flex items-center gap-4 px-8 sm:px-10 py-4 sm:py-5 rounded-full bg-[#ddddd5] text-[#101010] hover:bg-[#b70606] hover:text-white transition-all duration-300 shadow-2xl hover:scale-105 active:scale-95 focus:outline-none">
                <span class="font-sans font-bold text-base sm:text-xl tracking-tight">
                    {{ $settings['cta_button_text'] ?? 'Nos conte a sua história' }}
                </span>
                <span class="w-7 h-7 rounded-full bg-[#101010] text-[#ddddd5] group-hover:bg-white group-hover:text-[#101010] flex items-center justify-center transition-colors">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" class="stroke-current stroke-2">
                        <path d="M2 10L10 2M10 2H4M10 2V8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</section>

<!-- Sleek Contact Modal for Inquiries -->
<div id="contact-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-black/85 backdrop-blur-md transition-all duration-300 opacity-0" role="dialog" aria-modal="true" aria-labelledby="contact-modal-title">
    <div id="contact-modal-card" class="relative w-full max-w-3xl max-h-[92vh] bg-[#151515] border border-white/15 rounded-3xl overflow-hidden shadow-2xl flex flex-col transform scale-95 transition-transform duration-300">
        
        <!-- Header & Close Button -->
        <div class="p-6 sm:p-8 border-b border-white/10 flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-mono uppercase tracking-widest text-[#b70606] font-bold">Estúdio Norra • Contato</span>
                <h3 id="contact-modal-title" class="font-display font-bold text-2xl sm:text-3xl text-white">Nos conte sobre seu projeto</h3>
            </div>
            <button onclick="closeContactModal()" class="w-10 h-10 rounded-full bg-white/5 text-[#ddddd5] hover:text-white hover:bg-[#b70606] border border-white/10 flex items-center justify-center transition-colors focus:outline-none" aria-label="Fechar Modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body (Scrollable Form) -->
        <div class="overflow-y-auto p-6 sm:p-8 space-y-6">
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-[#25d366]/15 border border-[#25d366]/30 text-white flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#25d366] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="p-4 rounded-2xl bg-[#b70606]/15 border border-[#b70606]/30 text-white">
                    <ul class="text-xs space-y-1 text-[#ff9999]">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Anti-spam Honeypot -->
                <div class="hidden" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Nome Completo *</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                               placeholder="Seu nome"
                               class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">E-mail Corporativo *</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                               placeholder="seuemail@empresa.com"
                               class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="phone" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">WhatsApp / Telefone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                               placeholder="(00) 00000-0000"
                               class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label for="company" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Empresa / Marca</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}"
                               placeholder="Nome da sua marca"
                               class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="service" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Serviço de Interesse</label>
                        <select id="service" name="service"
                                class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            <option value="Web Design" {{ old('service') === 'Web Design' ? 'selected' : '' }}>Web Design</option>
                            <option value="Web Desenvolvimento" {{ old('service') === 'Web Desenvolvimento' ? 'selected' : '' }}>Web Desenvolvimento</option>
                            <option value="3D e Motion" {{ old('service') === '3D e Motion' ? 'selected' : '' }}>3D e Motion</option>
                            <option value="Identidade Visual" {{ old('service') === 'Identidade Visual' ? 'selected' : '' }}>Identidade Visual</option>
                            <option value="Projeto Completo" {{ old('service') === 'Projeto Completo' ? 'selected' : '' }}>Projeto Completo (Design + Dev)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="budget" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Expectativa de Investimento</label>
                        <select id="budget" name="budget"
                                class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            <option value="A definir" {{ old('budget') === 'A definir' ? 'selected' : '' }}>A definir em conversa</option>
                            <option value="R$ 5k - 10k" {{ old('budget') === 'R$ 5k - 10k' ? 'selected' : '' }}>R$ 5.000 a R$ 10.000</option>
                            <option value="R$ 10k - 25k" {{ old('budget') === 'R$ 10k - 25k' ? 'selected' : '' }}>R$ 10.000 a R$ 25.000</option>
                            <option value="R$ 25k+" {{ old('budget') === 'R$ 25k+' ? 'selected' : '' }}>Acima de R$ 25.000</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="message" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Conte-nos sobre sua ideia ou necessidade *</label>
                    <textarea id="message" name="message" rows="4" required
                              placeholder="Descreva seu projeto, objetivos, prazos ou expectativas..."
                              class="w-full px-4 py-3 rounded-xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">{{ old('message') }}</textarea>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <button type="submit" id="submit-btn"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-[#ddddd5] text-[#101010] font-bold text-xs uppercase tracking-wider hover:bg-[#b70606] hover:text-white active:scale-95 transition-all duration-200 shadow-xl cursor-pointer">
                        <span>Enviar Mensagem</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                    </button>

                    <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="text-xs text-[#888888] hover:text-[#ddddd5] transition-colors inline-flex items-center gap-1.5">
                        <span>Prefere WhatsApp? Chamar agora</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openContactModal() {
    const modal = document.getElementById('contact-modal');
    const card = document.getElementById('contact-modal-card');
    if (!modal || !card) return;
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
        card.classList.remove('scale-95');
        card.classList.add('scale-100');
    });
    document.body.style.overflow = 'hidden';
}

function closeContactModal() {
    const modal = document.getElementById('contact-modal');
    const card = document.getElementById('contact-modal-card');
    if (!modal || !card) return;
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    card.classList.remove('scale-100');
    card.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});

// Auto-open modal if validation errors or session success exists
@if((isset($errors) && $errors->any()) || session('success'))
    document.addEventListener('DOMContentLoaded', () => {
        openContactModal();
    });
@endif
</script>


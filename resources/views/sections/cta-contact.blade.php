<section id="contato" class="py-24 md:py-36 bg-[#101010] text-white relative overflow-hidden">
    <!-- Atmospheric Ambient Glow -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-[#b70606]/10 rounded-full blur-[150px] pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-[#151515] border border-white/10 p-8 sm:p-12 lg:p-16 relative overflow-hidden shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left: Big Pitch & Contact Details -->
                <div class="lg:col-span-5 space-y-8">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                            <span>Iniciar Parceria</span>
                        </div>

                        <h2 class="font-display font-extrabold text-[clamp(2rem,3.8vw,3.25rem)] leading-[1.05] tracking-tight text-white uppercase">
                            {{ $settings['cta_title'] ?? 'Vamos criar uma experiência que move sua marca' }}
                        </h2>

                        <p class="text-sm sm:text-base text-[#888888] leading-relaxed font-normal">
                            {{ $settings['cta_subtitle'] ?? 'Conte-nos sobre a sua visão. Vamos estruturar a melhor solução de design e engenharia para o seu negócio.' }}
                        </p>
                    </div>

                    <!-- Direct Contact Channels -->
                    <div class="space-y-4 pt-6 border-t border-white/10 text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#101010] border border-white/10 flex items-center justify-center text-[#ddddd5]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#888888]">E-mail Direto</p>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'contato@estudionorra.com' }}" class="font-medium text-white hover:text-[#b70606] transition-colors">
                                    {{ $settings['contact_email'] ?? 'contato@estudionorra.com' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#101010] border border-white/10 flex items-center justify-center text-[#ddddd5]">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.815 2.8.815 3.181 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.765-5.772-5.765zm3.376 8.204c-.14.393-.812.753-1.127.798-.316.046-.72.072-2.074-.486-1.637-.674-2.695-2.339-2.776-2.449-.081-.11-.663-.881-.663-1.68 0-.799.418-1.192.567-1.354.148-.162.325-.203.433-.203.109 0 .217.001.312.006.1.005.234-.038.366.279.136.326.464 1.134.505 1.216.041.082.069.177.014.286-.055.109-.082.177-.163.272-.081.095-.171.212-.244.285-.082.082-.167.171-.072.334.095.163.424.7 1.026 1.236.774.69 1.427.904 1.63.999.203.095.323.082.444-.055.121-.136.518-.602.656-.807.138-.205.276-.171.464-.101.188.07 1.195.563 1.401.666.206.103.344.153.395.24.051.087.051.506-.089.899z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#888888]">WhatsApp</p>
                                <a href="https://wa.me/{{ $settings['contact_whatsapp'] ?? '5567981530042' }}" target="_blank" rel="noopener noreferrer" class="font-medium text-white hover:text-[#b70606] transition-colors">
                                    +55 (67) 98153-0042
                                </a>
                            </div>
                        </div>

                        <div class="pt-2 text-xs text-[#888888] flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#25d366]"></span>
                            <span>Tempo de resposta estimado: menos de 24 horas</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="lg:col-span-7">
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-2xl bg-[#25d366]/10 border border-[#25d366]/30 text-white flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#25d366]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-[#b70606]/10 border border-[#b70606]/30 text-white">
                            <ul class="text-xs space-y-1 text-[#ff8080]">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Anti-spam Honeypot (hidden from real users) -->
                        <div class="hidden" aria-hidden="true">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="space-y-1.5">
                                <label for="name" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Nome Completo *</label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                       placeholder="Seu nome ou da sua marca"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">E-mail Corporativo *</label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                       placeholder="seuemail@empresa.com"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Phone -->
                            <div class="space-y-1.5">
                                <label for="phone" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">WhatsApp / Telefone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                       placeholder="(00) 00000-0000"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            </div>

                            <!-- Company -->
                            <div class="space-y-1.5">
                                <label for="company" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Empresa / Projeto</label>
                                <input type="text" id="company" name="company" value="{{ old('company') }}"
                                       placeholder="Nome da sua empresa"
                                       class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Service Select -->
                            <div class="space-y-1.5">
                                <label for="service" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Serviço de Interesse</label>
                                <select id="service" name="service"
                                        class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                                    <option value="Web Design" {{ old('service') === 'Web Design' ? 'selected' : '' }}>Web Design</option>
                                    <option value="Web Desenvolvimento" {{ old('service') === 'Web Desenvolvimento' ? 'selected' : '' }}>Web Desenvolvimento</option>
                                    <option value="3D e Motion" {{ old('service') === '3D e Motion' ? 'selected' : '' }}>3D e Motion</option>
                                    <option value="Identidade Visual" {{ old('service') === 'Identidade Visual' ? 'selected' : '' }}>Identidade Visual</option>
                                    <option value="Projeto Completo" {{ old('service') === 'Projeto Completo' ? 'selected' : '' }}>Projeto Completo (Design + Dev)</option>
                                </select>
                            </div>

                            <!-- Budget Select -->
                            <div class="space-y-1.5">
                                <label for="budget" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Expectativa de Investimento</label>
                                <select id="budget" name="budget"
                                        class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">
                                    <option value="A definir" {{ old('budget') === 'A definir' ? 'selected' : '' }}>A definir em conversa</option>
                                    <option value="R$ 5k - 10k" {{ old('budget') === 'R$ 5k - 10k' ? 'selected' : '' }}>R$ 5.000 a R$ 10.000</option>
                                    <option value="R$ 10k - 25k" {{ old('budget') === 'R$ 10k - 25k' ? 'selected' : '' }}>R$ 10.000 a R$ 25.000</option>
                                    <option value="R$ 25k+" {{ old('budget') === 'R$ 25k+' ? 'selected' : '' }}>Acima de R$ 25.000</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="space-y-1.5">
                            <label for="message" class="block text-xs uppercase tracking-wider font-semibold text-[#888888]">Conte-nos sobre sua ideia ou necessidade *</label>
                            <textarea id="message" name="message" rows="4" required
                                      placeholder="Descreva seu projeto, objetivos, prazos ou expectativas..."
                                      class="w-full px-4 py-3 rounded-2xl bg-[#101010] border border-white/10 text-white placeholder-white/20 text-sm focus:outline-none focus:border-[#b70606] focus:ring-1 focus:ring-[#b70606] transition-all">{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" id="submit-btn"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-[#ddddd5] text-[#101010] font-bold text-xs uppercase tracking-wider hover:bg-white active:scale-95 transition-all duration-200 shadow-xl cursor-pointer">
                                <span>{{ $settings['cta_button_text'] ?? 'Enviar Mensagem' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

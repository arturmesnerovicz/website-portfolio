<div id="project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-black/80 backdrop-blur-md transition-all duration-300 opacity-0" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div id="project-modal-card" class="relative w-full max-w-4xl max-h-[90vh] bg-[#151515] border border-white/10 rounded-3xl overflow-hidden shadow-2xl flex flex-col transform scale-95 transition-transform duration-300">
        <!-- Close Button -->
        <button onclick="closeProjectModal()" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-[#101010]/80 text-[#ddddd5] hover:text-white border border-white/10 flex items-center justify-center hover:bg-[#b70606] transition-colors focus:outline-none" aria-label="Fechar Modal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Scrollable Modal Content -->
        <div class="overflow-y-auto p-6 sm:p-10 space-y-8">
            <!-- Modal Media Header -->
            <div class="rounded-2xl overflow-hidden bg-[#101010] border border-white/5 aspect-video relative flex items-center justify-center">
                <img id="modal-image" src="" alt="" class="w-full h-full object-cover">
            </div>

            <!-- Project Details -->
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-3">
                    <span id="modal-category" class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-[#b70606]/20 text-[#ff4d4d] border border-[#b70606]/30"></span>
                    <span id="modal-client" class="text-xs text-[#888888] font-medium"></span>
                    <span class="text-white/20">•</span>
                    <span id="modal-year" class="text-xs text-[#888888] font-medium"></span>
                </div>

                <h2 id="modal-title" class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold text-white tracking-tight"></h2>

                <p id="modal-description" class="text-sm sm:text-base text-[#aaaaaa] leading-relaxed"></p>

                <!-- Tags -->
                <div id="modal-tags" class="flex flex-wrap gap-2 pt-2"></div>

                <!-- CTA inside modal -->
                <div class="pt-6 border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs text-[#888888]">Gostou desse projeto? Vamos criar o seu.</span>
                    <a href="#contato" onclick="closeProjectModal()" class="px-6 py-3 rounded-full bg-[#ddddd5] text-[#101010] font-bold text-xs uppercase tracking-wider hover:bg-white transition-colors">
                        Iniciar um Projeto Semelhante
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

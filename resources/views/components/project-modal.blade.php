<div id="project-modal"
     class="fixed inset-0 z-[90] hidden overflow-y-auto bg-black/85 backdrop-blur-md transition-all duration-300 opacity-0 select-none sm:select-auto"
     role="dialog"
     aria-modal="true"
     aria-labelledby="modal-title"
     onclick="closeProjectModal()">

    <!-- Fixed Floating Close Button (matching norra-spa) -->
    <button type="button"
            onclick="event.stopPropagation(); closeProjectModal()"
            class="fixed right-4 top-4 sm:right-6 sm:top-6 z-[80] flex h-11 w-11 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-white text-black shadow-2xl hover:bg-white/90 active:scale-95 transition-all cursor-pointer focus:outline-none"
            aria-label="Fechar modal de projeto">
        <svg class="h-5 w-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Modal Content Grid Container (matching norra-spa 2-column layout) -->
    <div class="min-h-full w-full p-4 sm:p-6 lg:p-8 flex items-start justify-center">
        <div id="project-modal-card"
             class="relative mx-auto grid w-full max-w-[96rem] grid-cols-1 gap-6 pb-12 pt-14 sm:pt-16 lg:grid-cols-[minmax(0,1fr)_22rem] lg:items-start lg:gap-8 lg:py-10 transform scale-95 transition-transform duration-300"
             onclick="event.stopPropagation()">

            <!-- Left: Full Website Image (Natural vertical height, uncropped, scrollable) -->
            <div class="order-2 lg:order-1 flex h-auto justify-center w-full min-h-[50vh]">
                <div class="relative w-full max-w-5xl overflow-hidden rounded-xl bg-white/[0.03] border border-white/10 shadow-[0_30px_90px_-50px_rgba(0,0,0,0.9)]">
                    <img id="modal-image"
                         src=""
                         alt="Imagem completa do projeto"
                         loading="eager"
                         decoding="async"
                         class="relative block h-auto w-full object-contain shadow-2xl transition-opacity duration-300" />
                </div>
            </div>

            <!-- Right: Sticky Aside Info Card (matching norra-spa) -->
            <aside class="order-1 lg:order-2 flex flex-col justify-between gap-6 rounded-2xl border border-white/10 bg-[#0e0e0e] p-6 sm:p-7 text-[#ddddd5] shadow-2xl lg:sticky lg:top-8 lg:max-h-[calc(100vh-4rem)] overflow-y-auto">
                <div class="flex flex-col gap-4">
                    <!-- Project Category / Type -->
                    <div class="flex flex-col gap-1.5">
                        <span id="modal-category"
                              class="font-sans text-[11px] font-bold uppercase tracking-[0.18em] text-[#ddddd5]/55">
                            Web Site
                        </span>
                        <!-- Project Title -->
                        <h3 id="modal-title"
                            class="font-sans font-bold text-2xl sm:text-3xl text-white leading-tight tracking-tight">
                        </h3>
                    </div>

                    <!-- Meta Data: Client & Year (matching norra-spa) -->
                    <div id="modal-meta-container" class="grid grid-cols-2 gap-3 border-y border-white/15 py-3">
                        <div class="flex flex-col gap-0.5">
                            <span class="font-sans text-[10px] font-bold uppercase tracking-[0.16em] text-[#ddddd5]/45">
                                Cliente
                            </span>
                            <span id="modal-client" class="font-sans font-medium text-sm sm:text-base text-white"></span>
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="font-sans text-[10px] font-bold uppercase tracking-[0.16em] text-[#ddddd5]/45">
                                Ano
                            </span>
                            <span id="modal-year" class="font-sans font-medium text-sm sm:text-base text-white"></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p id="modal-description"
                       class="max-h-48 overflow-y-auto font-sans text-sm leading-relaxed text-[#ddddd5]/80 lg:max-h-[30vh]">
                    </p>

                    <!-- Tags -->
                    <div id="modal-tags" class="flex flex-wrap gap-2 pt-1"></div>
                </div>

                <!-- Call to Action Button -->
                <div class="pt-4 border-t border-white/10 flex flex-col gap-2.5">
                    <span class="text-xs text-[#ddddd5]/50">Gostou da proposta visual?</span>
                    <a id="modal-cta-btn"
                       href="#contato"
                       target="_blank"
                       class="block w-full py-3.5 px-6 rounded-xl bg-[#ddddd5] text-[#101010] font-sans font-bold text-xs uppercase tracking-wider text-center shadow-lg hover:bg-white transition-colors cursor-pointer">
                        Fale Conosco
                    </a>
                </div>
            </aside>

        </div>
    </div>
</div>

<div id="project-modal"
     class="fixed inset-0 z-[90] hidden overflow-y-auto bg-black/85 backdrop-blur-md transition-all duration-300 opacity-0 select-none sm:select-auto"
     role="dialog"
     aria-modal="true"
     aria-label="{{ __('Visualização do projeto') }}">

    <!-- Fixed Floating Close Button (matching norra-spa) -->
    <button type="button"
            onclick="event.stopPropagation(); closeProjectModal()"
            class="fixed right-4 top-4 sm:right-6 sm:top-6 z-[100] flex h-11 w-11 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-white text-black shadow-2xl hover:bg-white/90 active:scale-95 transition-all cursor-pointer focus:outline-none"
            aria-label="{{ __('Fechar modal de projeto') }}">
        <svg class="h-5 w-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Modal Content Container (Centered Project) -->
    <div class="min-h-full w-full py-12 sm:py-16 lg:py-14 px-4 sm:px-6 lg:px-8 flex items-start justify-center">
        <div id="project-modal-card"
             class="relative mx-auto my-auto w-full max-w-5xl transform scale-95 transition-transform duration-300 cursor-default"
             onclick="event.stopPropagation()">

            <!-- Media Preview Container (Supports Full Image or Full Motion Video) -->
            <div class="relative w-full overflow-hidden rounded-xl bg-white/[0.03] border border-white/10 shadow-[0_30px_90px_-50px_rgba(0,0,0,0.9)]">
                <!-- Video Player for Motions / Demos -->
                <div id="modal-video-container" class="hidden relative w-full aspect-video bg-[#0a0a0a] flex items-center justify-center">
                    <video id="modal-video"
                           class="w-full h-full max-h-[85vh] object-contain rounded-xl"
                           controls
                           playsinline
                           preload="metadata">
                    </video>
                </div>

                <!-- Static Mockup / Full-length Image -->
                <img id="modal-image"
                     src=""
                     alt="{{ __('Imagem completa do projeto') }}"
                     loading="eager"
                     decoding="async"
                     class="relative block h-auto w-full object-contain shadow-2xl transition-opacity duration-300" />
            </div>

        </div>
    </div>
</div>

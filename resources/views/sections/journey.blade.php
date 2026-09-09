<section id="jornada" class="py-24 md:py-36 bg-[#151515] text-white relative overflow-hidden border-t border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-[#b70606] font-bold">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#b70606]"></span>
                    <span>Como Trabalhamos</span>
                </div>
                <h2 class="font-display font-extrabold text-[clamp(2rem,4.5vw,3.75rem)] leading-none tracking-tight text-white uppercase">
                    Jornada do Projeto
                </h2>
                <p class="text-sm sm:text-base text-[#888888] leading-relaxed font-normal">
                    Nosso método estruturado elimina ruídos e garante entregas pontuais, transparentes e com acabamento de excelência.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs font-mono uppercase tracking-widest text-[#888888] bg-[#101010] border border-white/10 px-4 py-2 rounded-full">
                <span class="w-2 h-2 rounded-full bg-[#b70606] animate-pulse"></span>
                <span>Fluxo Linear de 4 Etapas</span>
            </div>
        </div>

        <!-- Stages Grid / Timeline -->
        <div class="space-y-12 lg:space-y-16">
            @foreach($journeySteps as $step)
                <div class="rounded-3xl bg-[#101010] border border-white/10 p-6 sm:p-10 lg:p-12 hover:border-white/20 transition-all duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        <!-- Left Info -->
                        <div class="lg:col-span-6 space-y-6">
                            <div class="flex items-center gap-3">
                                <span class="font-display font-black text-2xl sm:text-3xl text-[#b70606]">
                                    {{ $step->step_num }}
                                </span>
                                <span class="text-xs uppercase tracking-widest text-[#888888] font-bold">
                                    Etapa do Projeto
                                </span>
                            </div>

                            <div class="space-y-2">
                                <h3 class="font-display font-bold text-2xl sm:text-3xl text-white">
                                    {{ $step->title }}
                                </h3>
                                @if($step->subtitle)
                                    <p class="text-sm font-medium text-[#ddddd5]/80">
                                        {{ $step->subtitle }}
                                    </p>
                                @endif
                            </div>

                            <p class="text-sm sm:text-base text-[#999999] leading-relaxed font-normal">
                                {{ $step->description }}
                            </p>

                            <!-- Deliverables List -->
                            @if(is_array($step->deliverables))
                                <div class="space-y-2.5 pt-2">
                                    <p class="text-xs uppercase tracking-wider text-[#888888] font-semibold">O que entregamos nesta fase:</p>
                                    <ul class="space-y-1.5 text-xs sm:text-sm text-[#cccccc]">
                                        @foreach($step->deliverables as $item)
                                            <li class="flex items-center gap-2.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#b70606] flex-shrink-0"></span>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Right Visual Preview Card -->
                        <div class="lg:col-span-6">
                            <div class="rounded-2xl overflow-hidden bg-[#151515] border border-white/10 aspect-[16/10] relative group shadow-2xl">
                                @if($step->image_path)
                                    <img src="{{ asset('storage/' . $step->image_path) }}"
                                         alt="{{ $step->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center p-8 text-center bg-gradient-to-br from-[#181818] to-[#101010]">
                                        <span class="font-display font-extrabold text-5xl text-[#b70606]/40 mb-2">{{ $step->step_num }}</span>
                                        <span class="text-xs uppercase tracking-widest text-[#888888] font-semibold">{{ $step->title }}</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80 pointer-events-none"></div>
                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-white/80">
                                    <span class="font-mono">Fase {{ $step->step_num }} de 04</span>
                                    <span class="px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-[10px] font-semibold uppercase tracking-wider border border-white/10">Metodologia Norra</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

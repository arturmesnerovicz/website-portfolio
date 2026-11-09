<section id="hero" class="relative bg-[#f6f6f6] flex flex-col justify-center items-center w-full select-none pt-20 sm:pt-28 pb-24 sm:pb-32 site-container">
    <div class="w-full flex flex-col items-center justify-center text-center">
        <!-- Main Headline (4 lines, Alte Haas Grotesk Bold 80px) -->
        <div class="max-w-[47.5rem] mx-auto mb-8">
            <h1 class="font-display font-bold text-4xl sm:text-6xl lg:text-[5rem] leading-[1.05] tracking-[-0.03em] text-[#101010]">
                @if(app()->getLocale() === 'en')
                    Building website<br />and visual identidy<br />that lives up to<br />your reputation
                @else
                    Construindo websites<br />e identidade visual<br />que fazem jus à<br />sua reputação
                @endif
            </h1>
        </div>

        <!-- Subtitle (2 lines, TeX Gyre Heros Bold 24px) -->
        <div class="max-w-[23.75rem] mx-auto">
            <p class="font-sans font-bold text-lg sm:text-xl lg:text-[1.5rem] leading-[1.25] tracking-[-0.02em] text-[#101010]">
                @if(app()->getLocale() === 'en')
                    Established brands deserves a<br />website that really reflect them
                @else
                    Marcas consolidadas merecem um<br />website que realmente as reflita
                @endif
            </p>
        </div>
    </div>
</section>

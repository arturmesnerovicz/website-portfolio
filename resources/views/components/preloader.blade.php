<div id="norra-preloader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#b70606] transition-opacity duration-700 ease-out">
    <!-- Fluid flow field canvas -->
    <canvas id="norra-preloader-canvas" class="absolute inset-0 w-full h-full"></canvas>

    <!-- Brand Centerpiece -->
    <div class="relative z-10 flex flex-col items-center text-center px-4 select-none pointer-events-none">
        <div class="w-12 h-12 mb-4 rounded-full border border-white/40 flex items-center justify-center bg-white/10 backdrop-blur-sm shadow-xl">
            <span class="text-white font-display font-bold text-lg">N</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-display font-extrabold tracking-widest text-white uppercase">
            Estúdio Norra
        </h1>
        <p class="text-xs tracking-widest uppercase text-white/80 mt-2 font-medium">
            Design & Tecnologia
        </p>

        <!-- Loading line -->
        <div class="w-36 h-[2px] bg-white/20 rounded-full mt-6 overflow-hidden">
            <div id="preloader-progress-bar" class="h-full bg-white transition-all duration-300 ease-out w-0"></div>
        </div>
    </div>
</div>

<script>
(function() {
    const preloader = document.getElementById('norra-preloader');
    const canvas = document.getElementById('norra-preloader-canvas');
    const progressBar = document.getElementById('preloader-progress-bar');
    if (!preloader || !canvas) return;

    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    // Particle flow field
    const particles = [];
    const count = Math.min(80, Math.floor(width / 15));
    for (let i = 0; i < count; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 2.5 + 1,
            vx: (Math.random() - 0.5) * 1.5,
            vy: (Math.random() - 0.5) * 1.5,
            alpha: Math.random() * 0.5 + 0.2
        });
    }

    let animId;
    function renderFlowField() {
        ctx.fillStyle = 'rgba(183, 6, 6, 0.2)';
        ctx.fillRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0) p.x = width;
            if (p.x > width) p.x = 0;
            if (p.y < 0) p.y = height;
            if (p.y > height) p.y = 0;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(255, 255, 255, ${p.alpha})`;
            ctx.fill();

            // Connect nearby particles
            for (let j = i + 1; j < particles.length; j++) {
                const p2 = particles[j];
                const dx = p.x - p2.x;
                const dy = p.y - p2.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 90) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.strokeStyle = `rgba(255, 255, 255, ${0.15 * (1 - dist / 90)})`;
                    ctx.lineWidth = 0.8;
                    ctx.stroke();
                }
            }
        }
        animId = requestAnimationFrame(renderFlowField);
    }
    renderFlowField();

    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 25 + 15;
        if (progress > 100) progress = 100;
        if (progressBar) progressBar.style.width = progress + '%';

        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(() => {
                preloader.style.opacity = '0';
                preloader.style.pointerEvents = 'none';
                window.dispatchEvent(new CustomEvent('norra-preloader-done'));
                setTimeout(() => {
                    cancelAnimationFrame(animId);
                    preloader.remove();
                }, 750);
            }, 300);
        }
    }, 120);
})();
</script>

<div id="norra-preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-[#b70606] transition-opacity duration-500 ease-out">
    <!-- Fluid flow field canvas -->
    <canvas id="norra-preloader-canvas" class="absolute -inset-6 w-[calc(100%+48px)] h-[calc(100%+48px)] pointer-events-none"></canvas>

    <!-- Typography Centerpiece matching Preloader.tsx -->
    <div class="relative z-10 flex flex-col items-center gap-4 text-center select-none pointer-events-none w-[min(82vw,520px)] -translate-y-2">
        <p id="norra-preloader-tag" class="text-[clamp(9px,2.4vw,11px)] tracking-[clamp(0.28em,1.4vw,0.55em)] uppercase font-light text-white/0 m-0 leading-relaxed font-sans">
            Sua agência criativa
        </p>
        <h1 id="norra-preloader-brand" class="font-sans text-[clamp(42px,15vw,72px)] font-bold tracking-[clamp(0.12em,4vw,0.32em)] uppercase text-white/0 m-0 leading-none [text-indent:clamp(0.12em,4vw,0.32em)]">
            Norra
        </h1>
    </div>
</div>

<script>
(function() {
    const preloader = document.getElementById('norra-preloader');
    const cv = document.getElementById('norra-preloader-canvas');
    const tagEl = document.getElementById('norra-preloader-tag');
    const brandEl = document.getElementById('norra-preloader-brand');
    if (!preloader || !cv) return;

    const ct = cv.getContext('2d');
    if (!ct) return;

    let W = 680;
    let H = 580;
    let t0 = null;
    let animationFrameId;
    let fadeFrameId;

    function resize() {
        if (!cv || !cv.parentElement) return;
        const p = cv.parentElement.getBoundingClientRect();
        W = cv.width = p.width || window.innerWidth || 680;
        H = cv.height = p.height || window.innerHeight || 580;
    }

    resize();
    window.addEventListener('resize', resize);

    function flowField(u, v, t) {
        return (
            Math.sin(u * 3.141 + v * 2.718 + t * 0.31) * 1.618 +
            Math.sin(u * 1.618 - v * 3.732 + t * 0.19) * 1.0 +
            Math.sin(u * 5.236 + v * 1.414 + t * 0.43) * 0.618 +
            Math.cos(u * 2.236 - v * 4.669 + t * 0.27) * 0.8 +
            Math.cos(u * 7.389 + v * 2.449 + t * 0.15) * 0.4
        );
    }

    function buildFlowShape(t, uStart, vStart, uSize, vSize, gridW, gridH) {
        const pts = [];
        for (let j = 0; j <= gridH; j++) {
            const row = [];
            for (let i = 0; i <= gridW; i++) {
                const u = uStart + (i / gridW) * uSize;
                const v = vStart + (j / gridH) * vSize;
                const angle = flowField(u, v, t);
                const strength = 0.18 + 0.06 * Math.sin(t * 0.33 + u * 2.0 + v * 1.5);
                const px = (u + Math.cos(angle) * strength) * W;
                const py = (v + Math.sin(angle) * strength) * H;
                row.push({ x: px, y: py });
            }
            pts.push(row);
        }
        return pts;
    }

    function drawFlowMass(t, cfg) {
        if (!ct) return;
        const { uS, vS, uSz, vSz, gW, gH, colors, blurA, blurB, opacity, composite } = cfg;
        const blurScale = Math.max(0.42, Math.min(1, Math.min(W, H) / 680));
        const grid = buildFlowShape(t, uS, vS, uSz, vSz, gW, gH);

        const contour = [];
        for (let i = 0; i <= gW; i++) contour.push(grid[0][i]);
        for (let j = 1; j <= gH; j++) contour.push(grid[j][gW]);
        for (let i = gW - 1; i >= 0; i--) contour.push(grid[gH][i]);
        for (let j = gH - 1; j >= 1; j--) contour.push(grid[j][0]);

        function drawSpline(pts, close) {
            ct.beginPath();
            ct.moveTo(pts[0].x, pts[0].y);
            for (let i = 1; i < pts.length; i++) {
                const a = pts[i - 1], b = pts[i];
                ct.quadraticCurveTo(a.x, a.y, (a.x + b.x) / 2, (a.y + b.y) / 2);
            }
            if (close) ct.closePath();
        }

        // Layer 1: Wide Blur
        ct.save();
        ct.filter = `blur(${Math.round(blurA * blurScale)}px)`;
        ct.globalCompositeOperation = composite;
        ct.globalAlpha = opacity;
        drawSpline(contour, true);

        const cx = grid[Math.floor(gH / 2)][Math.floor(gW / 2)].x;
        const cy = grid[Math.floor(gH / 2)][Math.floor(gW / 2)].y;
        const gr = ct.createRadialGradient(
            cx, cy, 0,
            cx, cy, Math.max(uSz, vSz) * Math.max(W, H) * 0.85
        );
        gr.addColorStop(0.0, colors[0]);
        gr.addColorStop(0.35, colors[1]);
        gr.addColorStop(0.65, colors[2]);
        gr.addColorStop(1.0, colors[3] || "rgba(0,0,0,0)");
        ct.fillStyle = gr;
        ct.fill();
        ct.restore();

        // Layer 2: Core Glow Blur
        ct.save();
        ct.filter = `blur(${Math.round(blurB * blurScale)}px)`;
        ct.globalCompositeOperation = composite;
        ct.globalAlpha = opacity * 0.6;
        drawSpline(contour, true);

        const g2 = ct.createRadialGradient(
            cx, cy, 0,
            cx, cy, Math.max(uSz, vSz) * Math.max(W, H) * 0.5
        );
        g2.addColorStop(0.0, colors[0]);
        g2.addColorStop(0.5, colors[1]);
        g2.addColorStop(1.0, "rgba(0,0,0,0)");
        ct.fillStyle = g2;
        ct.fill();
        ct.restore();
    }

    const fluid1 = "#7a0000";
    const fluid2 = "#e33702";
    const fluid3 = "#7a0000";
    const baseMass = "#000000";

    const baseMasses = [
        {
            uS: -0.15, vS: -0.05, uSz: 0.85, vSz: 0.8, gW: 5, gH: 5,
            colors: ["rgba(122,0,0,1.0)", "rgba(227,55,2,1.0)", "rgba(122,0,0,0.85)", "rgba(80,0,0,0)"],
            blurA: 55, blurB: 18, opacity: 0.92, composite: "screen",
        },
        {
            uS: 0.1, vS: 0.15, uSz: 0.9, vSz: 0.75, gW: 5, gH: 5,
            colors: ["rgba(122,0,0,1.0)", "rgba(227,55,2,0.9)", "rgba(122,0,0,0.7)", "rgba(30,0,0,0)"],
            blurA: 48, blurB: 14, opacity: 0.85, composite: "screen",
        },
        {
            uS: 0.05, vS: 0.2, uSz: 0.55, vSz: 0.55, gW: 4, gH: 4,
            colors: ["rgba(255,255,180,0.9)", "rgba(122,0,0,1.0)", "rgba(227,55,2,0.5)", "rgba(0,0,0,0)"],
            blurA: 38, blurB: 10, opacity: 0.75, composite: "screen",
        },
        {
            uS: 0.3, vS: 0.4, uSz: 0.55, vSz: 0.5, gW: 4, gH: 4,
            colors: ["rgba(0,0,0,1.0)", "rgba(0,0,0,0.95)", "rgba(0,0,0,0.6)", "rgba(0,0,0,0)"],
            blurA: 42, blurB: 16, opacity: 1.0, composite: "source-over",
        },
    ];

    const mobileMasses = baseMasses.map((mass, index) => ({
        ...mass,
        uS: [0.0, -0.08, 0.08, 0.22][index] ?? mass.uS,
        vS: [-0.02, 0.16, 0.2, 0.38][index] ?? mass.vS,
        uSz: mass.uSz * 1.08,
        vSz: mass.vSz * 0.86,
        opacity: mass.opacity * 0.95,
    }));

    function frame(ts) {
        if (!ct) return;
        if (!t0) t0 = ts;
        const t = (ts - t0) / 1000;

        ct.clearRect(0, 0, W, H);
        ct.fillStyle = "#b70606";
        ct.fillRect(0, 0, W, H);

        const masses = W < 640 ? mobileMasses : baseMasses;
        for (const m of masses) drawFlowMass(t, m);

        ct.globalCompositeOperation = "source-over";
        ct.globalAlpha = 1;
        const vig = ct.createRadialGradient(
            W * 0.42, H * 0.44, H * 0.02,
            W * 0.42, H * 0.44, H * 1.1
        );
        vig.addColorStop(0, "rgba(0,0,0,0)");
        vig.addColorStop(0.5, "rgba(0,0,0,0.05)");
        vig.addColorStop(1, "rgba(0,0,0,0.92)");
        ct.fillStyle = vig;
        ct.fillRect(0, 0, W, H);

        animationFrameId = requestAnimationFrame(frame);
    }

    animationFrameId = requestAnimationFrame(frame);

    // Text Fade with quadratic easing
    let fs = null;
    const textFadeDuration = 520;
    function fade(ts) {
        if (!fs) fs = ts;
        const p = Math.min((ts - fs) / textFadeDuration, 1);
        const a = p < 0.5 ? 2 * p * p : 1 - Math.pow(-2 * p + 2, 2) / 2;

        if (tagEl) tagEl.style.color = `rgba(255,255,255,${(a * 0.65).toFixed(3)})`;
        if (brandEl) brandEl.style.color = `rgba(255,255,255,${(a * 0.96).toFixed(3)})`;

        if (p < 1) fadeFrameId = requestAnimationFrame(fade);
    }

    setTimeout(() => {
        fadeFrameId = requestAnimationFrame(fade);
    }, 100);

    // Dismiss preloader after smooth display
    setTimeout(() => {
        preloader.style.opacity = '0';
        preloader.style.pointerEvents = 'none';
        window.dispatchEvent(new CustomEvent('norra-preloader-done'));

        setTimeout(() => {
            window.removeEventListener('resize', resize);
            cancelAnimationFrame(animationFrameId);
            cancelAnimationFrame(fadeFrameId);
            preloader.remove();
        }, 600);
    }, 1400);
})();
</script>

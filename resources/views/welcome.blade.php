<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khntree Fest · RPL Showcase</title>

    <!-- Google Fonts: Unbounded & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Unbounded:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Welcome Page CSS (External) -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <!-- Tailwind CSS  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['"Poppins"', 'sans-serif'],
                        unbounded: ['"Unbounded"', 'sans-serif'],
                    },
                    colors: {
                        black: '#050505',
                        white: '#f9f9f9',
                        gray: {
                            500: '#737373',
                            600: '#525252',
                            800: '#262626',
                            900: '#171717',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body>

    <!-- Navigasi -->
    <a href="/" class="header-brand">Rekayasa Perangkat Lunak <span class="text-gray-600">.</span></a>
    <a href="{{ route('login') }}" class="admin-link"> by mutiadev.id</a>

    <!-- Latar Belakang Animasi (Elemen Abstrak Mengambang) -->
    <div class="bg-elements">
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-shape shape-3"></div>
        <div class="bg-shape shape-4"></div>
    </div>

    <!-- Grid Lines Background -->
    <div class="bg-grid"></div>

    <!-- Film Grain Canvas -->
    <canvas id="grainCanvas" class="grain-canvas"></canvas>

    <!-- Jam Digital Live (Tengah Atas) -->
    <div class="live-clock" id="liveClock">00:00:00</div>

    <!-- Ticker Berjalan Bawah -->
    <div class="ticker-wrapper">
        <div class="ticker-track">
            <!-- Set 1 -->
            <span class="ticker-item">KHNTREE FEST 2026</span><span class="ticker-sep">·</span>
            <span class="ticker-item">JOB EDU FAIR</span><span class="ticker-sep">·</span>
            <span class="ticker-item">SMKN 3 METRO</span><span class="ticker-sep">·</span>
            <span class="ticker-item">REKAYASA PERANGKAT LUNAK</span><span class="ticker-sep">·</span>
            <span class="ticker-item">RPL SHOWCASE</span><span class="ticker-sep">·</span>
            <span class="ticker-item">KARYA SISWA TERBAIK</span><span class="ticker-sep">·</span>
            <!-- Set 2 -->
            <span class="ticker-item">KHNTREE FEST 2026</span><span class="ticker-sep">·</span>
            <span class="ticker-item">JOB EDU FAIR</span><span class="ticker-sep">·</span>
            <span class="ticker-item">SMKN 3 METRO</span><span class="ticker-sep">·</span>
            <span class="ticker-item">REKAYASA PERANGKAT LUNAK</span><span class="ticker-sep">·</span>
            <span class="ticker-item">RPL SHOWCASE</span><span class="ticker-sep">·</span>
            <span class="ticker-item">KARYA SISWA TERBAIK</span><span class="ticker-sep">·</span>
            <!-- Set 3 -->
            <span class="ticker-item">KHNTREE FEST 2026</span><span class="ticker-sep">·</span>
            <span class="ticker-item">JOB EDU FAIR</span><span class="ticker-sep">·</span>
            <span class="ticker-item">SMKN 3 METRO</span><span class="ticker-sep">·</span>
            <span class="ticker-item">REKAYASA PERANGKAT LUNAK</span><span class="ticker-sep">·</span>
            <span class="ticker-item">RPL SHOWCASE</span><span class="ticker-sep">·</span>
            <span class="ticker-item">KARYA SISWA TERBAIK</span><span class="ticker-sep">·</span>
            <!-- Set 4 -->
            <span class="ticker-item">KHNTREE FEST 2026</span><span class="ticker-sep">·</span>
            <span class="ticker-item">JOB EDU FAIR</span><span class="ticker-sep">·</span>
            <span class="ticker-item">SMKN 3 METRO</span><span class="ticker-sep">·</span>
            <span class="ticker-item">REKAYASA PERANGKAT LUNAK</span><span class="ticker-sep">·</span>
            <span class="ticker-item">RPL SHOWCASE</span><span class="ticker-sep">·</span>
            <span class="ticker-item">KARYA SISWA TERBAIK</span><span class="ticker-sep">·</span>
        </div>
    </div>

    <!-- Layered Sweep Transition Overlay -->
    <div class="transition-overlay" id="sweepOverlay">
        <div class="sweep sweep-1"></div>
        <div class="sweep sweep-2"></div>
    </div>

    @if($projects->isEmpty())
        <div class="h-screen flex flex-col items-center justify-center text-center px-4">
            <h1 class="font-unbounded font-bold text-4xl mb-4">Tidak Ada Project</h1>
            <p class="text-gray-500 mb-8 max-w-md">Login Untuk Menambahkan Project</p>
            <a href="{{ route('login') }}" class="btn-minimalist">Login</a>
        </div>
    @else
        <!-- Swiper Container -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @foreach($projects as $project)
                <div class="swiper-slide">
                    <div class="slide-layout">
                        <!-- Progress Bar Autoplay (Full Width, Monitor Mode) -->
                        <div class="progress-bar-container">
                            <div class="progress-bar"></div>
                        </div>

                        <!-- Kiri: Info Proyek -->
                        <div class="slide-content">
                            <!-- Author -->
                            <div class="project-author">
                                <span>{{ $project->pembuat }}</span>
                                @if($project->kelas)
                                    <span style="opacity: 0.5; margin: 0 8px;">•</span>
                                    <span>{{ $project->kelas }}</span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h1 class="project-title">
                                {{ $project->judul }}
                            </h1>

                            <!-- Description -->
                            <p class="project-desc">
                                {{ $project->deskripsi }}
                            </p>

                            <!-- Actions -->
                            <div class="action-area">
                                @if($project->qr_path)
                                <div class="qr-wrapper">
                                    <div class="qr-box">
                                        <img src="{{ asset('storage/' . $project->qr_path) }}"
                                             alt="QR Code - {{ $project->judul }}"
                                             loading="lazy">
                                    </div>
                                    <div class="qr-text">
                                        Scan for<br>Mobile<br>View
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Kanan: Gambar Project -->
                        <div class="slide-image">
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->judul }}"
                                     loading="lazy">
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            <div class="swiper-pagination"></div>
        </div>
    @endif

    <!-- GSAP (untuk slat transition) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        let isSliding = false;   

        function slideTransition(callback) {
            if (isSliding) return;
            isSliding = true;

            const tl = gsap.timeline({
                defaults: { ease: 'power3.inOut' },
                onComplete: () => { isSliding = false; }
            });

            tl
                // Tirai putih naik mendadak menutupi layar
                .to('.sweep-1', {
                    y: '0%',
                    duration: 0.7
                })
                // SAAT layar putih, ubah slide diam-diam di baliknya
                .add(() => { if (typeof callback === 'function') callback(); })
                .add(() => { animateActiveImage(); })
                // Lanjut sapu ke atas tanpa henti
                .to('.sweep-1', {
                    y: '-100%',
                    duration: 0.7
                })
                // Reset tirai ke bawah (sembunyi)
                .set('.sweep-1', { y: '100%' });
        }

        // ============================================================
        //  SWIPER  –  speed:0 karena pergantian di-handle GSAP
        // ============================================================
        var swiper = new Swiper('.mySwiper', {
            direction: 'vertical',
            loop: true,
            speed: 0,             // instant snap; visual handled by GSAP
            allowTouchMove: false, // gesture dihandle manual di bawah
            pagination: {
                el: '.swiper-pagination',
                clickable: false,  // klik pagination via custom handler
            },
            keyboard: { enabled: false },  // custom keyboard handler
            mousewheel: { enabled: false }, // custom wheel handler
        });

        // ---- Helper next / prev dengan wipe ----
        function goNext() {
            slideTransition(() => swiper.slideNext(0));
        }
        function goPrev() {
            slideTransition(() => swiper.slidePrev(0));
        }

        // ---- Mouse Wheel ----
        let wheelTimeout;
        window.addEventListener('wheel', (e) => {
            clearTimeout(wheelTimeout);
            wheelTimeout = setTimeout(() => {
                if (e.deltaY > 0) goNext();
                else goPrev();
            }, 30); // debounce ringan
        }, { passive: true });

        // ---- Keyboard Arrow / PageUp / PageDown ----
        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' || e.key === 'PageDown') goNext();
            if (e.key === 'ArrowUp'   || e.key === 'PageUp')   goPrev();
        });

        // ---- Touch Swipe (Mobile) ----
        let touchStartY = 0;
        window.addEventListener('touchstart', (e) => {
            touchStartY = e.touches[0].clientY;
        }, { passive: true });
        window.addEventListener('touchend', (e) => {
            const diff = touchStartY - e.changedTouches[0].clientY;
            if (Math.abs(diff) > 50) {
                diff > 0 ? goNext() : goPrev();
            }
        }, { passive: true });

        // ---- Pagination bullets (custom click) ----
        document.querySelector('.swiper-pagination')?.addEventListener('click', (e) => {
            const bullet = e.target.closest('.swiper-pagination-bullet');
            if (!bullet) return;
            const bullets = [...document.querySelectorAll('.swiper-pagination-bullet')];
            const idx = bullets.indexOf(bullet);
            if (idx < 0) return;
            slideTransition(() => swiper.slideToLoop(idx, 0));
        });

        // ---- Autoplay manual (setiap 12 detik) ----
        let autoplayTimer = setInterval(goNext, 12000);

        // Reset timer saat user interaksi manual
        function resetAutoplay() {
            clearInterval(autoplayTimer);
            autoplayTimer = setInterval(goNext, 12000);
        }
        window.addEventListener('wheel', resetAutoplay, { passive: true });
        window.addEventListener('keydown', resetAutoplay);
        window.addEventListener('touchend', resetAutoplay, { passive: true });

        // ---- Animasi gambar untuk slide PERTAMA saat halaman dimuat ----
        window.addEventListener('DOMContentLoaded', () => {
            // Delay kecil agar Swiper selesai init
            setTimeout(animateActiveImage, 300);
        });

        // ---- Film Grain Canvas (Optimized: Low Res + Throttled ~20fps) ----
        const grainCanvas = document.getElementById('grainCanvas');
        const grainCtx    = grainCanvas.getContext('2d');
        const GRAIN_SCALE = 0.3; // Render di 30% resolusi, stretch via CSS

        function resizeGrain() {
            grainCanvas.width  = Math.floor(window.innerWidth  * GRAIN_SCALE);
            grainCanvas.height = Math.floor(window.innerHeight * GRAIN_SCALE);
        }

        let lastGrainFrame = 0;
        function renderGrain(timestamp) {
            // Throttle: hanya update setiap ~50ms (20fps)
            if (timestamp - lastGrainFrame > 50) {
                lastGrainFrame = timestamp;
                const w = grainCanvas.width, h = grainCanvas.height;
                const imageData = grainCtx.createImageData(w, h);
                for (let i = 0; i < imageData.data.length; i += 4) {
                    const v = Math.random() * 255;
                    imageData.data[i]     = v;
                    imageData.data[i + 1] = v;
                    imageData.data[i + 2] = v;
                    imageData.data[i + 3] = 10;
                }
                grainCtx.putImageData(imageData, 0, 0);
            }
            requestAnimationFrame(renderGrain);
        }

        resizeGrain();
        window.addEventListener('resize', resizeGrain);
        requestAnimationFrame(renderGrain);

        // ---- Jam Digital Live ----
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('liveClock').textContent = `${h}:${m}:${s}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

    </script>
</body>
</html>
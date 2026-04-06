<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project · KNTHREE FEST RPL 2026</title>
    <meta name="description" content="Upload project kamu ke RPL Showcase KNTHREE FEST 2026 — SMKN 3 Metro">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Unbounded:wght@700;800;900&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --black: #050505;
            --white: #f9f9f9;
            --gray-1: #171717;
            --gray-2: #262626;
            --gray-3: #525252;
            --gray-4: #737373;
            --gray-5: #a3a3a3;
            --accent: #ffffff;
        }

        html,
        body {
            min-height: 100vh;
            background: var(--black);
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* ---- Background ---- */
        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ---- Glow blobs ---- */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.07;
            pointer-events: none;
            z-index: 0;
        }

        .blob-1 {
            width: 600px;
            height: 600px;
            background: #fff;
            top: -200px;
            right: -200px;
            animation: float1 18s ease-in-out infinite;
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            background: #fff;
            bottom: -100px;
            left: -100px;
            animation: float2 22s ease-in-out infinite;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(-60px, 80px) scale(1.1);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(50px, -60px) scale(1.08);
            }
        }

        /* ---- Header ---- */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(5, 5, 5, 0.7);
        }

        .site-header .brand {
            font-family: 'Unbounded', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
            letter-spacing: 0.04em;
        }

        .site-header .back-link {
            font-size: 12px;
            color: var(--gray-5);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }

        .site-header .back-link:hover {
            color: var(--white);
        }

        /* ---- Main Content ---- */
        .page-wrap {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 60px;
        }

        .card {
            width: 100%;
            max-width: 680px;
            background: rgba(23, 23, 23, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 48px;
            backdrop-filter: blur(20px);
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.5);
        }

        .card-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gray-4);
            margin-bottom: 12px;
        }

        .card-title {
            font-family: 'Unbounded', sans-serif;
            font-size: clamp(22px, 4vw, 32px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 8px;
            color: var(--white);
        }

        .card-subtitle {
            font-size: 14px;
            color: var(--gray-5);
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* ---- Error box ---- */
        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 28px;
        }

        .error-box ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .error-box li {
            font-size: 13px;
            color: #fca5a5;
        }

        .error-box li::before {
            content: '• ';
        }

        /* ---- Form ---- */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--gray-5);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background: rgba(38, 38, 38, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            padding: 13px 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-control::placeholder {
            color: var(--gray-3);
        }

        .form-control:focus {
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.05);
        }

        .form-control option {
            background: #262626;
            color: var(--white);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* File input custom */
        .file-area {
            border: 2px dashed rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }

        .file-area:hover {
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.02);
        }

        .file-area input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .file-label {
            font-size: 14px;
            color: var(--gray-4);
        }

        .file-label strong {
            color: var(--white);
        }

        .file-hint {
            font-size: 11px;
            color: var(--gray-3);
            margin-top: 6px;
        }

        .file-preview {
            margin-top: 14px;
            display: none;
        }

        .file-preview img {
            max-height: 160px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .file-preview .file-name {
            font-size: 12px;
            color: var(--gray-4);
            margin-top: 6px;
        }

        /* Form row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media(max-width: 520px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Divider */
        .form-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            margin: 32px 0;
        }

        /* Notice */
        .notice {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 28px;
        }

        .notice-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .notice-text {
            font-size: 13px;
            color: var(--gray-5);
            line-height: 1.6;
        }

        .notice-text strong {
            color: var(--gray-5);
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            background: var(--white);
            color: var(--black);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 15px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, background 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background: #e5e5e5;
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(255, 255, 255, 0.15);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* Loading state */
        .btn-submit .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(0, 0, 0, 0.2);
            border-top-color: var(--black);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ---- Card entry animation ---- */
        .card {
            animation: cardIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="bg-grid"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- Header -->
    <header class="site-header">
        <a href="/" class="brand">RPL · KNTHREE FEST 2026</a>
        <a href="/" class="back-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7" />
            </svg>
            Lihat Showcase
        </a>
    </header>

    <!-- Main -->
    <main class="page-wrap">
        <div class="card">
            <p class="card-eyebrow">SMKN 3 Metro · RPL Showcase</p>
            <h1 class="card-title">Upload Project<br>Kamu</h1>
            <p class="card-subtitle">Isi form di bawah ini untuk mendaftarkan project kamu ke KNTHREE FEST 2026. Project
                akan ditampilkan setelah disetujui oleh admin.</p>

            <!-- Notice -->
            <div class="notice">
                <span class="notice-icon">⏳</span>
                <p class="notice-text">
                    <strong>Catatan:</strong> Setelah submit, project kamu akan masuk antrian <em>review admin</em>
                    terlebih dahulu. Tidak perlu membuat akun — cukup isi form ini!
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('submit.store') }}" method="POST" enctype="multipart/form-data" id="submitForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="judul">Judul Project</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            placeholder="Nama project kamu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pembuat">Nama Pembuat</label>
                        <input type="text" name="pembuat" id="pembuat" value="{{ old('pembuat') }}"
                            placeholder="Nama lengkap / kelompok" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="kelas">Kelas</label>
                    <select name="kelas" id="kelas" class="form-control" required>
                        <option value="" disabled {{ old('kelas') ? '' : 'selected' }}>— Pilih Kelas —</option>
                        @foreach (['X RPL A', 'X RPL B', 'XI RPL A', 'XI RPL B', 'XII RPL A', 'XII RPL B'] as $k)
                            <option value="{{ $k }}" {{ old('kelas') == $k ? 'selected' : '' }}>
                                {{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi Singkat</label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Ceritakan project kamu secara singkat..." class="form-control"
                        required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="link">Link Website / Demo</label>
                    <input type="url" name="link" id="link" value="{{ old('link') }}"
                        placeholder="https://projectku.vercel.app" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Thumbnail / Screenshot Project</label>
                    <div class="file-area" id="fileArea">
                        <input type="file" name="image" id="imageInput" accept="image/*" required>
                        <div class="file-icon">🖼️</div>
                        <p class="file-label"><strong>Klik untuk pilih gambar</strong> atau drag &amp; drop</p>
                        <p class="file-hint">PNG, JPG, WEBP — Maks 3MB</p>
                        <div class="file-preview" id="filePreview">
                            <img id="previewImg" src="" alt="preview">
                            <p class="file-name" id="fileName"></p>
                        </div>
                    </div>
                </div>

                <hr class="form-divider">

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="spinner" id="spinner"></span>
                    <span id="btnText">🚀 Kirim Project</span>
                </button>
            </form>
        </div>
    </main>

    <script>
        // Preview gambar sebelum upload
        const imageInput = document.getElementById('imageInput');
        const filePreview = document.getElementById('filePreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');
        const fileArea = document.getElementById('fileArea');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                fileName.textContent = file.name;
                filePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        // Loading state saat submit
        document.getElementById('submitForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');
            btn.disabled = true;
            spinner.style.display = 'block';
            btnText.textContent = 'Mengirim...';
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Terkirim! · KNTHREE FEST RPL 2026</title>
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

        html,
        body {
            min-height: 100vh;
            background: #050505;
            color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

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

        .card {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 480px;
            width: 90%;
            background: rgba(23, 23, 23, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 56px 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.5);
            animation: cardIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .check-icon {
            width: 72px;
            height: 72px;
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 24px;
            animation: pop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s both;
        }

        @keyframes pop {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        h1 {
            font-family: 'Unbounded', sans-serif;
            font-size: 26px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        p {
            font-size: 14px;
            line-height: 1.7;
            color: #737373;
            margin-bottom: 10px;
        }

        p strong {
            color: #a3a3a3;
        }

        .divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            margin: 32px 0;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            display: block;
            padding: 14px 24px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: #f9f9f9;
            color: #050505;
        }

        .btn-primary:hover {
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.12);
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #737373;
        }

        .btn-ghost:hover {
            border-color: rgba(255, 255, 255, 0.25);
            color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="bg-grid"></div>
    <div class="card">
        <div class="check-icon">✅</div>
        <h1>Project Terkirim!</h1>
        <p>Project kamu sudah masuk dan sedang menunggu <strong>review dari admin</strong>. Setelah disetujui, project
            akan tampil di RPL Showcase.</p>
        <p>Terima kasih sudah berpartisipasi di <strong>KNTHREE FEST 2026</strong>! 🎉</p>

        <hr class="divider">

        <div class="btn-group">
            <a href="{{ route('home') }}" class="btn btn-primary">🏠 Lihat RPL Showcase</a>
            <a href="{{ route('submit.form') }}" class="btn btn-ghost">📤 Upload Project Lain</a>
        </div>
    </div>
</body>

</html>

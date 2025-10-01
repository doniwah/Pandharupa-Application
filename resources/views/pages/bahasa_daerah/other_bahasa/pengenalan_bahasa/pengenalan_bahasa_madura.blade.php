<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengenalan Huruf Madura</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #ff9933, #ff7711);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(255, 119, 17, 0.3);
            transition: transform 0.2s;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 119, 17, 0.4);
        }

        .back-button::before {
            content: "←";
            margin-right: 8px;
            font-size: 18px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .intro-text {
            color: #666;
            line-height: 1.6;
            margin-bottom: 40px;
            font-size: 15px;
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .section-text {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: grid;
            grid-template-columns: 1fr 4px 1fr;
            gap: 20px;
            align-items: center;
        }

        .info-label {
            color: #2c3e50;
            font-weight: 600;
            font-size: 16px;
            text-align: left;
        }

        .vertical-divider {
            width: 4px;
            height: 100%;
            background: #28a745;
            border-radius: 2px;
        }

        .info-value {
            color: #666;
            font-size: 15px;
            text-align: left;
        }

        .return-button {
            display: inline-block;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 14px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 40px;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
            transition: transform 0.2s;
        }

        .return-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="#" class="back-button">Kembali</a>

        <div class="content-card">
            <h1>Pengenalan Huruf Madura</h1>

            <p class="intro-text">
                Bahasa Madura (Bhâsa Madhurâ) adalah bahasa Austronesia yang dituturkan oleh sekitar 14 juta orang di
                Pulau Madura dan Jawa Timur.
            </p>

            <div class="divider"></div>

            <h2>Sistem Penulisan</h2>

            <p class="section-text">
                Bahasa Madura menggunakan tiga sistem penulisan: huruf Latin (modern), aksara Jawa, dan aksara
                Arab-Pegon (tradisional). Saat ini, huruf Latin paling umum digunakan dalam pendidikan dan media.
            </p>

            <h2>Alfabet Dasar</h2>

            <p class="section-text">
                Bahasa Madura menggunakan 26 huruf alfabet Latin standar dengan beberapa tambahan untuk bunyi khas
                Madura:
            </p>

            <div class="info-box">
                <div class="info-label">Bhâsa</div>
                <div class="vertical-divider"></div>
                <div class="info-value">Bahasa (dengan bunyi bh)</div>
            </div>

            <div class="info-box">
                <div class="info-label">Madhurâ</div>
                <div class="vertical-divider"></div>
                <div class="info-value">Madura (dengan bunyi dh)</div>
            </div>

            <div class="info-box">
                <div class="info-label">Ḍâ</div>
                <div class="vertical-divider"></div>
                <div class="info-value">Bunyi d retroflex khas Madura</div>
            </div>

            <h2>Tingkat Tutur</h2>

            <p class="section-text">
                Bahasa Madura memiliki tingkatan bahasa yang penting dipahami:
            </p>

            <div class="info-box">
                <div class="info-label">Ènjâ'-iyâ</div>
                <div class="vertical-divider"></div>
                <div class="info-value">Tingkat kasar/biasa (untuk teman sebaya)</div>
            </div>

            <div class="info-box">
                <div class="info-label">Èngghi-bhunten</div>
                <div class="vertical-divider"></div>
                <div class="info-value">Tingkat halus (untuk orang tua/dihormati)</div>
            </div>

            <a href="#" class="return-button">Kembali ke Daftar Pelajaran</a>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Pendaloka</title>
    <link rel="stylesheet" href="{{ asset('css/auth') }}/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Masuk</h1>
        <p class="subtitle">Masuk ke akun Pendaloka Anda</p>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@example.com">
            </div>

            <div class="form-group">
                <div class="form-header">
                    <label for="password">Password</label>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>
                <input type="password" name="password" id="password" placeholder="••••••••">
            </div>

            <button type="submit" class="login-button">Masuk</button>
        </form>

        <div class="divider">ATAU MASUK DENGAN</div>

        <div class="social-buttons">
            <button class="social-button">
                <span class="social-icon">G</span>
                <span>Google</span>
            </button>
            <button class="social-button">
                <span class="social-icon">f</span>
                <span>Facebook</span>
            </button>
        </div>

        <p class="register-link">Belum punya akun? <a href="{{ route('register.index') }}">Daftar sekarang</a></p>
    </div>
</body>

</html>

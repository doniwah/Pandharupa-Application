<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Pendaloka</title>
    <link rel="stylesheet" href="{{ asset('css/auth') }}/register.css">
</head>

<body>
    <div class="register-container">
        <h1>Daftar</h1>
        <p class="subtitle">Buat akun Pendaloka Anda</p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" placeholder="Nama Lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    required>
            </div>

            <button type="submit" class="register-button">Daftar</button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
</body>

</html>

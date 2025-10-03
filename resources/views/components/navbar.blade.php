<nav class="navbar-custom">
    <div class="nav-left">
        <div class="logo">
            Pandharupa
        </div>
    </div>
    <div class="nav-center">
        <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.index') ? 'active' : '' }}">Kelas
            Nusantara</a>
        <a href="{{ route('library.index') }}"
            class="{{ request()->routeIs('elibrary.index') ? 'active' : '' }}">E-Library</a>
        <a href="#">Bahasa
            Daerah</a>
        <a href="#">Quiz & Games</a>
        <a href="{{ route('forum.index') }}">Forum</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="#">Kolaborasi</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('login.index') }}" class="login">Masuk</a>
        <a href="" class="register">Daftar Sekarang</a>
    </div>
    <button class="mobile-menu-toggle">☰</button>
</nav>

<script>
    // Mobile menu toggle functionality
    document.querySelector('.mobile-menu-toggle')?.addEventListener('click', function() {
        const navCenter = document.querySelector('.nav-center');
        navCenter.classList.toggle('show');
        this.textContent = this.textContent === '☰' ? '✕' : '☰';
    });
</script>

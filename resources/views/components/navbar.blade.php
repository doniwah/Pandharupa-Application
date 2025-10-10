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
            class="{{ request()->routeIs('library.index') ? 'active' : '' }}">E-Library</a>
        <a href="{{ route('bahasa.index') }}" class="{{ request()->routeIs('bahasa.index') ? 'active' : '' }}">Bahasa
            Daerah</a>
        <a href="{{ route('quiz.index') }}" class="{{ request()->routeIs('quiz.index') ? 'active' : '' }}">Quiz &
            Games</a>
        <a href="{{ route('forum.index') }}" class="{{ request()->routeIs('forum.index') ? 'active' : '' }}">Forum</a>
        <a href="{{ route('events.index') }}"
            class="{{ request()->routeIs('events.index') ? 'active' : '' }}">Events</a>
        <a href="{{ route('kolaborasi.index') }}"
            class="{{ request()->routeIs('kolaborasi.index') ? 'active' : '' }}">Kolaborasi</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('login.index') }}" class="login">Masuk</a>
        <a href="{{ route('register.index') }}" class="register">Daftar Sekarang</a>
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

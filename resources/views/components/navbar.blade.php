<nav class="navbar-custom">
    <div class="nav-left">
        <div class="logo">
            Pandharupa
        </div>
    </div>
    <div class="nav-center">
        <a href="#">Kelas Nusantara</a>
        <a href="#">E-Library</a>
        <a href="#">Bahasa Daerah</a>
        <a href="#">Quiz & Games</a>
        <a href="#">Forum</a>
        <a href="#">Events</a>
        <a href="#">Kolaborasi</a>
    </div>
    <div class="nav-right">
        <a href="" class="login">Masuk</a>
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

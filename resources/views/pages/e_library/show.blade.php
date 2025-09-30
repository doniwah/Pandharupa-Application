<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $koleksi->judul }} - E-Library Pendalungan</title>
    <link rel="stylesheet" href="{{ asset('css/pages/elibrary.css') }}">
</head>

<body>
    <section class="hero-koleksi">
        <div class="container-koleksi">
            <h1>{{ $koleksi->judul }}</h1>
            <p>Detail koleksi E-Library Pendalungan</p>
        </div>
    </section>

    <section class="content-section-koleksi">
        <div class="container-koleksi">
            <div class="content-card-koleksi">

                {{-- Icon berdasarkan kategori --}}
                <div class="content-icon-koleksi">
                    @if ($koleksi->kategori == 'Naskah')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                            viewBox="0 0 24 24">
                            <path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20v-2H6.5a.5.5 0 0 1-.5-.5V4H4z" />
                            <path d="M18 2H8v13h12V4a2 2 0 0 0-2-2z" />
                        </svg>
                    @elseif ($koleksi->kategori == 'Lagu')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                            viewBox="0 0 24 24">
                            <path d="M12 3v10.55A4 4 0 1 0 14 17V7h4V3h-6z" />
                        </svg>
                    @elseif ($koleksi->kategori == 'Dokumentasi')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF7A00"
                            viewBox="0 0 24 24">
                            <path d="M17 10.5V6c0-1.1-.9-2-2-2H5C3.9 4 3 4.9 3 6v12c0
                        1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-4.5l4 4v-11l-4 4z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#999"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                    @endif
                </div>

                <span class="content-type-koleksi">{{ $koleksi->kategori }}</span>
                <h2 class="content-title-koleksi">{{ $koleksi->judul }}</h2>
                <p class="content-description-koleksi">{{ $koleksi->deskripsi }}</p>

                <div class="content-meta-koleksi">
                    <div>📖 Penulis: {{ $koleksi->penulis }}</div>
                    <div>📅 Tahun: {{ $koleksi->tahun }}</div>
                    @if ($koleksi->halaman)
                        <div>📑 Halaman: {{ $koleksi->halaman }}</div>
                    @endif
                    @if ($koleksi->durasi)
                        <div>⏱️ Durasi: {{ $koleksi->durasi }}</div>
                    @endif
                </div>

                <div class="content-stats-koleksi">
                    <span>👁️ {{ $koleksi->jumlah_suka }}</span>
                    <span>💾 {{ $koleksi->jumlah_unduh }}</span>
                </div>

                <div class="content-actions-koleksi">
                    <a href="{{ asset('storage/' . $koleksi->file_path) }}" target="_blank"
                        class="btn btn-primary-koleksi">👁️ Baca / Lihat</a>
                    <form action="{{ route('elibrary.unduh', $koleksi->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-secondary-koleksi">💾 Unduh</button>
                    </form>
                </div>

                <div style="margin-top:20px;">
                    <a href="{{ route('elibrary.index') }}" class="btn btn-light-koleksi">⬅️ Kembali ke Koleksi</a>
                </div>
            </div>
        </div>
    </section>

</body>

</html>

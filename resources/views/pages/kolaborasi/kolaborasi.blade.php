<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaloka - Kolaborasi Digital Pendalungan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .hero-title {
            font-size: 2.5rem;
            color: #8B4513;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .hero-description {
            color: #666;
            font-size: 1rem;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 50px;
        }

        .stat-item {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #e67e22;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Filter and Upload Section */
        .filter-upload-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .filter-tabs {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 8px 16px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            color: #666;
            transition: all 0.3s ease;
        }

        .filter-tab.active {
            background: #e67e22;
            color: white;
            border-color: #e67e22;
        }

        .upload-btn {
            background: #e67e22;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Section Titles */
        .section-title {
            font-size: 1.5rem;
            color: #8B4513;
            margin-bottom: 30px;
            font-weight: 500;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-3px);
        }

        .card-content {
            padding: 25px;
            position: relative;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: #e67e22;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 20px;
            color: white;
        }

        .card-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            color: white;
        }

        .badge-video { background: #8B5CF6; }
        .badge-outstanding { background: #EF4444; }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .card-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .card-collaborators {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            color: #888;
        }

        .card-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 20px;
        }

        .stat-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #e67e22;
            color: white;
            flex: 1;
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* All Works Grid - 3 columns */
        .all-works-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;
        }

        .small-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .small-card:hover {
            transform: translateY(-3px);
        }

        .small-card-content {
            padding: 20px;
            position: relative;
        }

        .small-card-icon {
            width: 40px;
            height: 40px;
            background: #e67e22;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 16px;
            color: white;
        }

        .small-card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 500;
            color: white;
        }

        .badge-puisi { background: #10B981; }
        .badge-musik { background: #3B82F6; }
        .badge-foto { background: #F59E0B; }
        .badge-kerajinan { background: #EC4899; }

        .small-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .small-card-description {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        .small-card-meta {
            color: #888;
            font-size: 0.8rem;
            margin-bottom: 12px;
        }

        .small-card-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 15px;
        }

        .small-card-actions {
            display: flex;
            gap: 8px;
        }

        .small-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            transition: all 0.3s ease;
        }

        .small-btn-primary {
            background: #e67e22;
            color: white;
            flex: 1;
        }

        .small-btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
        }

        /* Collaboration Call-to-Action */
        .collaboration-cta {
            background: linear-gradient(135deg, #e67e22, #d35400);
            padding: 50px 40px;
            border-radius: 15px;
            text-align: center;
            color: white;
            margin-top: 40px;
        }

        .cta-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }

        .cta-title {
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 400;
        }

        .cta-description {
            font-size: 1rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cta-btn-primary {
            background: white;
            color: #e67e22;
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn:hover {
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .all-works-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .content-grid, .all-works-grid {
                grid-template-columns: 1fr;
            }

            .filter-upload-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .collaboration-cta {
                padding: 30px 20px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">Kolaborasi Digital Pendalungan</h1>
            <p class="hero-description">Platform untuk komunitas upload, berbagi, dan berkolaborasi dalam karya seni digital. Tari, musik, puisi, dokumenter - semua bentuk ekspresi budaya Pendalungan.</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">🎨</div>
                <div class="stat-number">456</div>
                <div class="stat-label">Total Karya</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">👥</div>
                <div class="stat-number">89</div>
                <div class="stat-label">Kolaborator Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⬇️</div>
                <div class="stat-number">2,340</div>
                <div class="stat-label">Download Bulan Ini</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">❤️</div>
                <div class="stat-number">1,234</div>
                <div class="stat-label">Karya Difavoritkan</div>
            </div>
        </div>

        <!-- Filter and Upload Section -->
        <div class="filter-upload-section">
            <div class="filter-tabs">
                <div class="filter-tab active">Semua</div>
                <div class="filter-tab">Tari</div>
                <div class="filter-tab">Musik</div>
                <div class="filter-tab">Puisi</div>
                <div class="filter-tab">Dokumenter</div>
                <div class="filter-tab">Fotografi</div>
                <div class="filter-tab">Kerajinan</div>
            </div>
            <button class="upload-btn">Upload Karya</button>
        </div>

        <!-- Featured Works -->
        <div class="featured-section">
            <h2 class="section-title">Karya Unggulan</h2>
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-content">
                        <div class="card-icon">🎭</div>
                        <div class="card-badge badge-video">Video</div>
                        <h3 class="card-title">Kolaborasi Tari Jejer Modern</h3>
                        <p class="card-description">Interpretasi modern dari tarian tradisional Jejer dengan sentuhan kontemporer.</p>
                        <div class="card-collaborators">
                            <span>👤 Sari D. 👤 Budi K. 👤 Rina M.</span>
                        </div>
                        <div class="card-stats">
                            <div class="stat-icons">
                                <span>👁️ 1250</span>
                                <span>👍 89</span>
                                <span>💬 45</span>
                            </div>
                            <span>3 hari lalu</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn btn-primary">👁️ Lihat</button>
                            <button class="btn btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-content">
                        <div class="card-icon">📄</div>
                        <div class="card-badge badge-outstanding">Outstanding</div>
                        <h3 class="card-title">Dokumenter: Perajin Batik Pendalungan</h3>
                        <p class="card-description">Film dokumenter tentang kehidupan dan karya para perajin batik tradisional.</p>
                        <div class="card-collaborators">
                            <span>👤 Ahmad S. 👤 Lisa P. 👤 Doni W.</span>
                        </div>
                        <div class="card-stats">
                            <div class="stat-icons">
                                <span>👁️ 2100</span>
                                <span>👍 156</span>
                                <span>💬 78</span>
                            </div>
                            <span>1 minggu lalu</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn btn-primary">👁️ Lihat</button>
                            <button class="btn btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Works -->
        <div class="all-works-section">
            <h2 class="section-title">Semua Karya</h2>
            <div class="all-works-grid">
                <div class="small-card">
                    <div class="small-card-content">
                        <div class="small-card-icon">📝</div>
                        <div class="small-card-badge badge-puisi">Puisi</div>
                        <h3 class="small-card-title">Kumpulan Puisi: Rindu Kampung</h3>
                        <p class="small-card-description">Kumpulan puisi yang menggambarkan kerinduan terhadap kampung halaman dan budaya lokal.</p>
                        <div class="small-card-meta">oleh Maya Ek - 1</div>
                        <div class="small-card-stats">
                            <div class="stat-icons">
                                <span>👁️ 67</span>
                                <span>👍 12</span>
                                <span>💬 4</span>
                            </div>
                            <span>2 minggu lalu</span>
                        </div>
                        <div class="small-card-actions">
                            <button class="small-btn small-btn-primary">Lihat</button>
                            <button class="small-btn small-btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>

                <div class="small-card">
                    <div class="small-card-content">
                        <div class="small-card-icon">🎵</div>
                        <div class="small-card-badge badge-musik">Musik</div>
                        <h3 class="small-card-title">Musik Fusion: Gamelan Digital</h3>
                        <p class="small-card-description">Perpaduan gamelan tradisional dengan sentuhan musik digital modern.</p>
                        <div class="small-card-meta">oleh Iri Np</div>
                        <div class="small-card-stats">
                            <div class="stat-icons">
                                <span>👁️ 1400</span>
                                <span>👍 98</span>
                                <span>💬 23</span>
                            </div>
                            <span>3 minggu lalu</span>
                        </div>
                        <div class="small-card-actions">
                            <button class="small-btn small-btn-primary">Lihat</button>
                            <button class="small-btn small-btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>

                <div class="small-card">
                    <div class="small-card-content">
                        <div class="small-card-icon">📷</div>
                        <div class="small-card-badge badge-foto">Foto</div>
                        <h3 class="small-card-title">Fotografi: Potret Kehidupan Nelayan</h3>
                        <p class="small-card-description">Dokumentasi visual kehidupan sehari-hari para nelayan yang melestarikan nelayan Pendalungan.</p>
                        <div class="small-card-meta">oleh Ri Si</div>
                        <div class="small-card-stats">
                            <div class="stat-icons">
                                <span>👁️ 780</span>
                                <span>👍 54</span>
                                <span>💬 12</span>
                            </div>
                            <span>1 bulan lalu</span>
                        </div>
                        <div class="small-card-actions">
                            <button class="small-btn small-btn-primary">Lihat</button>
                            <button class="small-btn small-btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>

                <div class="small-card">
                    <div class="small-card-content">
                        <div class="small-card-icon">🧶</div>
                        <div class="small-card-badge badge-kerajinan">Kerajinan</div>
                        <h3 class="small-card-title">Kerajinan: Vas Bambu Kontemporer</h3>
                        <p class="small-card-description">Desain vas dari bambu dengan sentuhan modern untuk dekorasi rumah.</p>
                        <div class="small-card-meta">oleh Ana - 1</div>
                        <div class="small-card-stats">
                            <div class="stat-icons">
                                <span>👁️ 420</span>
                                <span>👍 34</span>
                            </div>
                            <span>1 bulan lalu</span>
                        </div>
                        <div class="small-card-actions">
                            <button class="small-btn small-btn-primary">Lihat</button>
                            <button class="small-btn small-btn-secondary">⬇️ Unduh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collaboration CTA -->
        <div class="collaboration-cta">
            <div class="cta-icon">🔗</div>
            <h2 class="cta-title">Siap Berkolaborasi?</h2>
            <p class="cta-description">Bergabunglah dengan komunitas kreatif dan ciptakan karya seni digital yang menginspirasi!</p>
            <div class="cta-buttons">
                <a href="#" class="cta-btn cta-btn-primary">📤 Upload Karya</a>
                <a href="#" class="cta-btn cta-btn-secondary">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        const filterTabs = document.querySelectorAll('.filter-tab');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                tab.classList.add('active');
            });
        });

        // Button click effects
        const buttons = document.querySelectorAll('.btn, .small-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>
</html>

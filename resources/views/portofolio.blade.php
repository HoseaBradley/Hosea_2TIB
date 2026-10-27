<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portofolio - {{ $profile->nama ?? 'Nama Anda' }}</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <!-- Header Sidebar -->
  <header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      @if($profile && $profile->foto_profil)
          <img src="{{ asset('storage/' . $profile->foto_profil) }}" alt="" class="img-fluid rounded-circle">
      @else
          <img src="{{ asset('assets/img/my-profile-img.jpg') }}" alt="" class="img-fluid rounded-circle">
      @endif
    </div>

    <a href="#" class="logo d-flex items-center justify-content-center text-center">
      <h1 class="sitename">{{ $profile->nama ?? 'Nama Lengkap' }}</h1>
    </a>

    <div class="social-links text-center">
      <a href="{{ $profile->website ?? '#' }}" target="_blank"><i class="bi bi-globe"></i></a>
      <a href="{{ route('profile.edit') }}" title="Ke Halaman Admin"><i class="bi bi-gear"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i> Profil</a></li>
        <li><a href="#skills"><i class="bi bi-hstack navicon"></i> Skills</a></li>
        <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Pengalaman</a></li>
        <li><a href="{{ route('profile.edit') }}" class="text-warning"><i class="bi bi-lock navicon"></i> Dashboard Admin</a></li>
      </ul>
    </nav>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container">
        <h2>{{ $profile->nama ?? 'Nama Anda' }}</h2>
        <p>Saya seorang {{ $profile->profesi ?? 'Developer' }}</p>
      </div>
    </section>

    <!-- Profil Section -->
    <section id="about" class="about section">
      <div class="container section-title">
        <h2>Profil Saya</h2>
        <p>{{ $profile->bio ?? 'Silakan isi deskripsi profil Anda melalui dashboard admin.' }}</p>
      </div>

      <div class="container">
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            @if($profile && $profile->foto_profil)
                <img src="{{ asset('storage/' . $profile->foto_profil) }}" class="img-fluid rounded" alt="">
            @else
                <img src="{{ asset('assets/img/my-profile-img.jpg') }}" class="img-fluid rounded" alt="">
            @endif
          </div>
          <div class="col-lg-8 content">
            <h2>{{ $profile->profesi ?? 'Profesi Utama' }}</h2>
            <div class="row mt-3">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Nama:</strong> <span>{{ $profile->nama ?? '-' }}</span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>{{ $profile->website ?? '-' }}</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills section light-background">
      <div class="container section-title">
        <h2>Skills & Keahlian</h2>
        <p>Daftar keahlian teknis yang saya miliki:</p>
      </div>

      <div class="container">
        <div class="row skills-content">
          @forelse($skills as $skill)
            <div class="col-lg-6 mb-3">
              <div class="progress">
                <span class="skill"><span>{{ $skill->nama_skill }}</span> <i class="val">{{ $skill->tingkat_keahlian }}%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" style="width: {{ $skill->tingkat_keahlian }}%;"></div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <p class="text-muted fst-italic">Belum ada data skill yang ditambahkan dari admin.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Pengalaman Section -->
    <section id="resume" class="resume section">
      <div class="container section-title">
        <h2>Pengalaman Kerja & Project</h2>
        <p>Berikut riwayat pengalaman dan proyek yang telah diselesaikan:</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="resume-title">Riwayat Pengalaman</h3>

            @forelse($experiences as $exp)
              <div class="resume-item pb-3 mb-3 border-bottom">
                <h4>{{ $exp->judul }}</h4>
                <h5>{{ $exp->tahun }}</h5>
                <p><em>{{ $exp->deskripsi }}</em></p>
                @if($exp->foto_project)
                  <div class="mt-2">
                    <img src="{{ asset('storage/' . $exp->foto_project) }}" class="img-thumbnail" style="max-height: 150px;" alt="Foto Project">
                  </div>
                @endif
              </div>
            @empty
              <p class="text-muted fst-italic">Belum ada pengalaman yang ditambahkan dari admin.</p>
            @endforelse

          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>

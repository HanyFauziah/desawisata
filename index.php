<?php 
include 'includes/header.php';
include 'includes/db.php';
include 'includes/config.php';
?>

<style>
     /* Custom CSS to reduce carousel size */
     .carousel-inner img {
            height: 50%; /* Adjust height to reduce size */
            width: 50%; /* Adjust width to reduce size */
            margin: 0 auto; /* Center the images */
        }

        /* Adjust arrow positions to the edges of the image */
        .carousel-control-prev, .carousel-control-next {
            width: 50%; /* Match the image width */
            top: 0;
            bottom: 0;
        }

        .carousel-control-prev {
            left: 0; /* Align to the left edge of the image */
        }

        .carousel-control-next {
            right: 0; /* Align to the right edge of the image */
        }
        /* Custom CSS to reduce carousel size */
        .carousel-inner img {
            height: 50%; /* Adjust height to reduce size */
            width: 50%; /* Adjust width to reduce size */
            margin: 0 auto; /* Center the images */
        }

        /* Adjust arrow positions to the edges of the image */
        .carousel-control-prev, .carousel-control-next {
            width: 50%; /* Match the image width */
            top: 0;
            bottom: 0;
        }

        .carousel-control-prev {
            left: 0; /* Align to the left edge of the image */
        }

        .carousel-control-next {
            right: 0; /* Align to the right edge of the image */
        }

        .carousel-inner img {
            height: 50%; /* Adjust height to reduce size */
            width: 50%; /* Adjust width to reduce size */
            margin: 0 auto; /* Center the images */
        }

        /* Adjust arrow positions to the edges of the image */
        .carousel-control-prev, .carousel-control-next {
            width: 50%; /* Match the image width */
            top: 0;
            bottom: 0;
        }

        .carousel-control-prev {
            left: 0; /* Align to the left edge of the image */
        }

        .carousel-control-next {
            right: 0; /* Align to the right edge of the image */
        }
    </style>



  <main>



  <div
  class="text-center bg-image"
  style="
    background-image: url('https://i.imgur.com/iqYcAv9.jpeg');
    height: 500px;
    background-size: cover; /* Ensures the image covers the whole area */
    background-position: center center; /* Centers the background image */
  "
>
  <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); height: 100%;">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="p-5 text-white text-start">
        <h1 class="mb-4">Selamat Datang Di Desa Wisata SindangKasih</h1>
        <h4 class="mb-4 fs-5">Yuk, Nikmati Liburan Seru dan Berkesan di Sindangkasih!!</h4>
        <a data-mdb-ripple-init class="btn btn-outline-light btn-lg me-3" href="<?php echo BASE_URL; ?>/tiket.php" role="button">Tiket</a>
        <a data-mdb-ripple-init class="btn btn-outline-light btn-lg " href="#!" role="button">Lihat Video</a>
      </div>
    </div>
  </div>
</div>


<div class="container d-flex  justify-content-center align-items-center mt-4 flex-column mx-auto">
    
    <div style="max-width: 800px;" class="">
        <p class="fs-5 mt-3 mx-auto">
            Desa Wisata Sindangkasih merupakan kampung wisata di Garut yang menawarkan keseruan berpetualang menyusuri sungai, yang diapit oleh pemandangan perbukitan, dan sawah. Aktivitas tersebut lebih dikenal dengan river tubing. Para pengunjung tidak perlu khawatir, meskipun kehati-hatian harus selalu diutamakan.
        </p>

        <div class="p-3 d-flex mt-5  justify-content-center align-items-center bg-success text-white" style="background-color: blue; min-width: fit-content;">
        <h3 class="text-center">Lokasi Dan Alamat Desa Wisata Sindangkasih</h3>
        </div>

        <p class="fs-5 mt-3">
            Desa Wisata Sindangkasih terletak di Jl. Garut – Tasikmalaya No. Km 16, Desa Sukamaju, Kecamatan Cilawu, Kabupaten Garut, Jawa Barat 44181.
        </p>

        <a target="_blank" href="https://www.google.co.id/maps/place/Desa+Wisata+Sindangkasih/@-7.3263861,107.9405524,18z/data=!4m6!3m5!1s0x2e68afc557bfb6ad:0x7f30f92d07c240bd!8m2!3d-7.3261233!4d107.9419343!16s%2Fg%2F11kmtgcbdp?entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D">
        <img src="https://desaawisatasindangkasih.wordpress.com/wp-content/uploads/2024/08/peta-sukamaju.png" class="w-100" alt="">
        </a>
    </div>

        <h2 class="text-center" >Jam Operasional</h2>
        <p class="fs-5 mt-1">
           Buka setiap Pukul 08.00 - 17.00
        </p>




        <section class="aktivitas">
                <p class="fs-3 mt-4">
                    Aktifitas Seru
                </p>
                <div style="max-width: 800px;" class=">   
                <p class="fs-5 mt-0">
                    Desa Wisata Sindangkasih menawarkan beragam pilihan Aktivitas yang seru dan tentunya terjangkau. Beberapa diantaranya seperti River Tubing, Ngagogo, Fun Game, dan Beberapa Edukasi ( Menanam Padi, Membuat Gula, Membuat Sapu Ijuk, dll).
                </p>
                </div>
                

                <div class="crsel d-flex flex-column flex-sm-row d-flex w-100 justify-content-between">
    <!-- Card 1 -->
    <div class="d-flex flex-column responsive-card shadow p-3" style="width: 30">
        <div id="carousel1" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://i.imgur.com/fm0SYDK.jpeg" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="https://i.imgur.com/bAhHtyn.jpeg" class="d-block w-100" alt="Second slide">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h2 class="fs-5 mt-2">River Tubing</h2>
        <p class="fs-5">
            Aktivitas wisata yang dilakukan di medan sungai, aliran irigasi, dan sungai yang mengalir di dalam gua.
        </p>
    </div>

    <!-- Card 2 -->
    <div class="d-flex flex-column responsive-card shadow p-3">
        <div id="carousel2" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://i.imgur.com/NoxSs70.jpeg" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="https://i.imgur.com/p3Xicxs.jpeg" class="d-block w-100" alt="Second slide">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h2 class="fs-5 mt-2">Ngagogo</h2>
        <p class="fs-5">
            Ngagogo adalah bahasa Sunda yang artinya berjalan atau berkeliling.
        </p>
    </div>

    <!-- Card 3 -->
    <div class="d-flex flex-column responsive-card shadow p-3">
        <div id="carousel3" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://i.imgur.com/G0PvcT7.jpeg" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="https://i.imgur.com/MNggIh7.jpeg" class="d-block w-100" alt="Second slide">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h2 class="fs-5 mt-2">Edukasi Menanam Padi</h2>
        <p class="fs-5">
            Di desa wisata sindang kasih ada beberapa edukasi yang bisa dinikmati pengunjung.
        </p>
    </div>
</div>

<!-- Add CSS to ensure uniform image sizes -->



            <!-- Background image -->

            <!-- Background image -->


                <!-- Carousel Section -->

            <h2 class="text-center" >Testimoni</h2>
            <h2 class="text-center" >Tinggalkan Komentar</h2>
            </div>
        </section>

  </main>

  <style>
    .carousel-inner img {
        height: 400px; /* Adjust as needed */
        object-fit: cover; /* Ensures images are cropped uniformly */
    }

    .responsive-card {
        width: 100%; /* Default for mobile */
    }

    @media (min-width: 576px) { /* Small screens and above */
        .responsive-card {
            width: 30%;
        }
    }
</style>

  <!-- footer -->
  <!-- Background image -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'includes/footer.php'; ?>
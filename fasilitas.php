<?php 
include 'includes/header.php';
include 'includes/db.php';
?>


  <!-- Content -->
  <div class="container mt-5 text-center">
    <hr class="spaced-hr">
    <h1>Fasilitas</h1>
    <hr class="spaced-hr">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<div class="container">
    <p class="fs-4 mt-4 text-justify" style="text-align: justify;">
    Desa Wisata Sindangkasih Menawarkan berbagai fasilitas untuk memastikan kenyamanan dan pengalaman yang tak terlupakan bagi para pengunjung. Berikut adalah Fasilitas yang tersedia di desa wisata kami.
    </p>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel with Adjusted Arrows</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <!-- Carousel Section -->
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://i.imgur.com/P3SKWBw.jpeg" class="d-block" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="https://i.imgur.com/XRJHuIo.jpeg" class="d-block" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="https://i.imgur.com/d1AqDkC.jpeg" class="d-block" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img src="https://i.imgur.com/yL1Gva0.jpeg" class="d-block" alt="Fourth slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
  <h3 class="text-center">Saung</h3>

</div>


<?php 
include 'includes/footer.php';
?>
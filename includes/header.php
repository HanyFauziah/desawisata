<?php 
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Website</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Custom CSS -->
   <link rel="stylesheet" href="style.css">
    <!-- Midtrans -->
  <script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-NuefehYwTODRuB8s"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="" style="background-color: #F9FAFF;">
<header>
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Brand Logo and Name -->
    <a class="navbar-brand text-success fs-3 fw-bold" href="<?php echo BASE_URL; ?>index.php">
      Desa Wisata Sindangkasih
      <!-- Leaf Icon (using Font Awesome) -->
      <i class="fas fa-leaf ms-2"></i>
    </a>

    <!-- Mobile Menu Toggle -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navigation Links -->
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto text-uppercase">
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="<?php echo BASE_URL; ?>index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="<?php echo BASE_URL; ?>tentang.php">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="<?php echo BASE_URL; ?>tiket.php">Tiket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="<?php echo BASE_URL; ?>fasilitas.php">Fasilitas</a>
        </li>
      </ul>
    </div>

    <!-- Social Media Icons (Visible only on large screens and above) -->
    <div class="d-none d-lg-flex gap-3 align-items-center">
      <a href="https://www.youtube.com/" target="_blank" class="text-danger">
        <i class="fab fa-youtube fs-4"></i>
      </a>
      <a href="https://www.instagram.com/" target="_blank" class="text-dark">
        <i class="fab fa-instagram fs-4"></i>
      </a>
    </div>
  </div>
</nav>

</header>


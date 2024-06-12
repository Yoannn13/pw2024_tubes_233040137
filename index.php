<?php  
session_start();
require "inc/koneksi.php";

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

// ambil username dari sesi
$username = $_SESSION['username'];

// Mengambil data artikel dari database
$queryArtikel = mysqli_query($conn, "SELECT id, nama, gambar FROM team");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportPedia</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                SportPedia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#konten">Team</a>
                    </li>
                </ul>
                <form class="d-flex align-items-center">
                <?php   
                if (isset($_SESSION['username']))
                ?>
                </form>
                <form class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAfdJREFUSEu11UuoSFEUBuDvkphgIKG8ihCFgVAyQiEjjzEppZCipDBBjL1CKY+ZIlEiSYkMiJIByiMGSJJMGHidpXNq2519T13dPdtn/Xv9a+317//06OfV08/5dREMwkosw2xMrAt6jUe4jkv4USq0N4LFOIFJHV0+w0bcbsOVCHZhH50dNjl/YjsO5SRtBHuwt4+z2YKj6dmcYAlu9DF5HPtVzWU+HjQ5UoIBeILpLQRfsBOX69hqHMDQFuxdLGwjCLVcLFS/Dmez2Kb8OpL4AtyLfdrBhaqDVQWCkfiUxcbgXQF/GFtzgrcYVzgwCh+z2Gi8L+AfYk5O8A1DCgfW43QWC+0fL+A/Y0RO8LUwtMDFkHfUQw4xxLwOYliBIHINzwmeY8p/SDQ9+rRRYzrkM1jbQhDafoz7lSV8qONx/3MrH5pVPcroKF+nsCHvYDmuZsjoagVeFDqbhmuJCTawRbiVE8Q+Kp1Zo35jMl51XNtUhOE1Kzqd12xyqwjmmwn4POKRfS+QhOrOYU0dj+uMV/z3kbV1EN/CSfcnCd9UkjtS+39YyUDMqHUe5jY2wW7GsbSYkl3vrh2164fU5Aq73oZ4wf+s3hIsxUmM75hBCCEUc6cN11Xh4NqfQmEx/AmI4b9E2EEo6Aqig9bVRdBRfHe43wn+AAntVBlfO442AAAAAElFTkSuQmCC"/>
                            <?= $username; ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Hero Section -->
    <div class="hero">
        <div class="jumbotron jumbotron-fluid" id="home">
            <div class="container">
                <h1 class="display-4">SELAMAT DATANG</h1>
                <p class="lead">Temukan Informasi Team Kesayangan Anda</p>
            </div>
        </div>    
    </div>
    <!-- End Hero Section -->

    <!-- About Section -->
    <div class="container">
        <div class="row text-center mb-3" id="about">
          <div class="col">
            <h2>About Us</h2>
          </div>
        </div>
        <div class="row text-center">
          <div class="col md" id="supa">
            <p>Selamat Datang Diwebsite SportPedia!!</p>
            <p>Di SportPedia, kami memberikan  informasi terkait team sepakbola dan basket terkini, informasi terpercaya, dan konten eksklusif kepada penggemar olahraga di seluruh dunia. Jika Anda fans sepakbola atau basket, website ini cocok untuk anda.</p>
            <p>Di SportPedia, kami percaya bahwa olahraga memiliki kekuatan magis untuk menyatukan orang dari segala penjuru. Kami berkomitmen untuk menjadi platform yang mempersatukan penggemar olahraga dari berbagai latar belakang, menciptakan ruang di mana semua orang dapat menikmati dan merayakan gairah olahraga bersama. Bergabunglah dengan kami untuk mengalami kebersamaan, semangat, dan kegembiraan dalam dunia olahraga yang tak terbatas!</p>
            <p>Terima kasih telah mengunjungi Website SportPedia. Semoga data yang kami sajikan dapat memberikan Informasi terupdate di dunia olahraga!!!</p>
          </div>
        </div>
      </div>

    <?php
// Mulai sesi PHP dan koneksi ke database
include 'inc/koneksi.php'; 

// Query untuk mengambil artikel dari database
$queryArtikel = mysqli_query($conn, "SELECT * FROM team");

if ($queryArtikel === false) {
    // Jika query gagal, tampilkan pesan kesalahan
    echo "Error: " . mysqli_error($koneksi);
    exit;
}
?>

<!-- Search and Artikel Section -->
<div class="container">
    <h2>Cari Team</h2>
        <div class="row mb-3" id="konten">
        <div class="row mb-3">
    <div class="col-md-10">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for teams...">
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-primary w-100" id="searchButton" type="button">Search</button>
    </div>
</div>

        </div>
        <div class="row" id="articlesList">
    <?php while ($data = mysqli_fetch_array($queryArtikel)) : ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="css/image/<?php echo htmlspecialchars($data['gambar']); ?>" class="card-img-top custom-image-size" alt="<?php echo htmlspecialchars($data['nama']); ?>">
                <div class="card-body custom-card-size">
                    <h5 class="card-title"><?php echo htmlspecialchars($data['nama']); ?></h5>
                    <p class="card-title">Kota Asal: <?php echo htmlspecialchars($data['kotaAsal']); ?></p>
                    <p class="card-title">Negara: <?php echo htmlspecialchars($data['negara']); ?></p>
                    <p class="card-title">Stadion: <?php echo htmlspecialchars($data['stadion']); ?></p>
                    <p class="card-title">Tahun Didirikan: <?php echo htmlspecialchars($data['tahunDidirikan']); ?></p>
                    <p class="card-title">Pelatih: <?php echo htmlspecialchars($data['pelatih']); ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

    </div>
    <!-- End Artikel Section -->



    <!-- Footer Section -->
    <div class="wrapper">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>About Us</h5>
                        <p>Di SportPedia, kami memberikan  informasi terkait team sepakbola dan basket terkini, informasi terpercaya, dan konten eksklusif kepada penggemar olahraga di seluruh dunia. Jika Anda fans sepakbola atau basket, website ini cocok untuk anda.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Quick Links</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#konten">Team</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Contact</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="mailto:yoanpelalana@gmail.com">Email</a></li>
                            <li class="nav-item"><a class="nav-link" href="wa.me/6282218222209">WhatsApp</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Bandung, Jawa Barat, Indonesia</a></li>
                        </ul>   
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="mb-0">&copy; 2024 SportPedia | MuhammadYoanPelalana</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Footer Section -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var search = $(this).val();
                if (search != "") {
                    $.ajax({
                        url: 'search.php',
                        method: 'POST',
                        data: {query: search},
                        success: function(response) {
                            $('#articlesList').html(response);
                        }
                    });
                } else {
                    // If search is empty, reload the original articles
                    $.ajax({
                        url: 'search.php',
                        method: 'POST',
                        data: {query: ''},
                        success: function(response) {
                            $('#articlesList').html(response);
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

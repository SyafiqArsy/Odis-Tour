<?php
include '../componen/auth_check.php';
isLoggedIn();
isAdmin();
requireAdmin();
?>

<!-- // Koneksi database -->
<?php include '../componen/koneksi.php'; ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../componen/stylehome.css">    
</head>
<body class="body">

    <!-- NAVBAR -->
    <?php include '../componen/navbar_admin.php'?>

    <!-- CAROUSEL -->
    <section id="home" class="karosel">
        <div id="carouselExampleDark" class="carousel carousel-dark slide ">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="../assets/carousel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="fs-1" style="color:rgb(255, 214, 52);">AHLAN WA SAHLAN</h5>
                        <p style="color: rgb(255, 214, 52);">Selamat Datang Di Website Penyedia Paket Umroh.</p>
                        <p style="color: rgb(255, 214, 52);">Selamat datang, Admin!</p>
                        <a href="#paket"><button type="button" class="btn btn-outline-warning">Cek Paket</button></a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../assets/carousel2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../assets/carousel1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    
    <!-- CAROUSEL END-->
    
    <!-- VIDIO TUTORIAL -->
    <section class="vidio">
        <h1 class="judulvidio" style="color: #B8860B;">VIDIO TUTORIAL</h1>
        <div class="vidio2">
            <?php
            $sql = "SELECT * FROM video WHERE id_video = 1";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<iframe width="560" height="315" 
                            src="https://www.youtube.com/embed/' . htmlspecialchars($row['link_video']) . '" 
                            frameborder="0" allowfullscreen></iframe>';
                }
            }
            ?>
            <div class="tulisanvidio">
                <h3 style="color: #B8860B;">Tutorial Penggunaan Website</h3>
                <p style="color: #B8860B;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum dignissimos quaerat, tempora culpa vel impedit provident temporibus velit! Voluptas, ducimus! Iusto sint facilis tempore necessitatibus.</p>
            </div>
        </div>
    </section>

    <!-- VIDIO TUTORIAL END-->

    <!-- PAKET -->

    <section class="container pb-5 mb-5">
        <h1 id="paket" class="judulpaket" style="color: #B8860B;">PAKET UMROH</h1>
        <section class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $query = "SELECT * FROM paket_umroh ORDER BY id_paket DESC LIMIT 3";
            $result = $koneksi->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Path ke gambar
                    $foto = $row['foto_paket'];
                    $path_foto = '../list/' . $foto; // sesuaikan folder jika dibutuhkan

                    echo '
            <div class="col">
                <div class="card h-100">
                    <img src="' . $path_foto . '" class="card-img-top" style="width: 100%; aspect-ratio: 3 / 4; object-fit: cover;" alt="Foto Paket">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h3 class="card-title">' . htmlspecialchars($row['nama_paket']) . '</h3>
                            <p class="card-subtitle mb-2">' . htmlspecialchars($row['tgl_keberangkatan']) . '</p>
                            <p class="card-text">Rp ' . number_format($row['harga_paket'], 0, ',', '.') . '</p>
                            <p class="fs-6 text-success-emphasis">Durasi ' . htmlspecialchars($row['durasi_Perjalanan']) . '</p>
                        </div>
                        <a href="../booking/booking.php?id=' . $row['id_paket'] . '" class="btn btn-success mt-3">Booking Sekarang</a>
                    </div>
                </div>
            </div>
            ';
                }
            } else {
                echo '<p class="text-center">Belum ada paket tersedia.</p>';
            }
            ?>
        </section>
    </section>

    <!-- PAKET END -->

    <!-- FOOTER -->
    <?php include '../componen/footer.php'?>

    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <a href="https://wa.me/6285643449811">
            <img src="assets/WA.png" alt="" style="width: 100px;">
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>
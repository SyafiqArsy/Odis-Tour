<!--
    Anggota Kelompok 4 :
    1. Syafiq Muhammad Musyafa Arsy At-taufiq (V3424036)
    2. Zaskiya Salsabila Quratu'ain Dyahari (V3424037)
    3. Bilal (V3424044)
    4. Devina Audrey Farrel Dian Krisna (V3424045)
    5. Julianto Duta Pangestu (V3424060)
    6. Metodius Taraagastya (V3434061)
-->

<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'website_umroh';
    
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error)
    {
    die("Connection failed: " . $conn->connect_error);
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Odi's Tour - Guest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="componen/stylehome.css">    
 </head>
  <body class="body">

    <!-- NAVBAR GUEST -->
    <nav class="navbar navbar-expand-lg bg-dark shadow-lg fixed-top">
        <div class="container-fluid ">
          <a class="navbar-brand" style="color: #B8860B" href="#">Odi'S Tour</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Menu</button>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" style="color: #B8860B" aria-current="page" href="index.php">Home</a>
              <a class="nav-link" style="color: #B8860B" href="simulasi/simulasi_guest.php">Simulasi Tabungan</a>
              <a class="icon-link icon-link-hover link-warning link-underline-warning link-underline-opacity-25" style="--bs-link-hover-color-rgb: 184, 134, 11;" href="loginregister/loginform.php">Login<svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg></a>
            </div>
          </div>
        </div>
    </nav>

    <!-- SIDE BAR GUEST -->
    <div class="offcanvas offcanvas-start bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link active" style="color: #B8860B" aria-current="page" href="index.php">Home</a></li>
                <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="simulasi/simulasi_guest.php">Simulasi Tabungan</a></li>
                <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="loginregister/loginform.php">Login</a></li>
                <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link disabled opacity-75" style="color: #B8860B" aria-disabled="true">Enjoy Your Flight</a></li>
            </ul>
        </div>
    </div>

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
                    <img src="assets/carousel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="fs-1" style="color:rgb(255, 214, 52);">AHLAN WA SAHLAN</h5>
                        <p style="color: rgb(255, 214, 52);">Selamat Datang Di Website Penyedia Paket Umroh.</p>
                        <a href="#paket"><button type="button" class="btn btn-outline-warning">Cek Paket</button></a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets/carousel2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5></h5>
                        <p></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/carousel1.jpg" class="d-block w-100" alt="...">
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
    
    <!-- VIDIO TUTORIAL -->
    <section class="vidio">
        <h1 class="judulvidio" style="color: #B8860B;">VIDIO TUTORIAL</h1>
        <div class="vidio2">
    <?php
    $sql = "SELECT * FROM video WHERE id_video = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
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

    <!-- PAKET -->

    <section class="container pb-5 mb-5">
        <h1 id="paket" class="judulpaket" style="color: #B8860B;">PAKET UMROH</h1>
        <section class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $query = "SELECT * FROM paket_umroh ORDER BY id_paket DESC LIMIT 3";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Path ke gambar
                    $foto = $row['foto_paket'];
                    $path_foto = 'list/' . $foto; // sesuaikan folder jika dibutuhkan

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
                        <a href="booking/booking.php?id=' . $row['id_paket'] . '" class="btn btn-success mt-3">Booking Sekarang</a>
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

    <section class="footer" style="background-color: #212529; width: 100%;">
        <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
                <div class="col mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                        <img src="assets/logohorizontal.png" alt="" class="bi me-2" height="100">
                    </a>
                </div>
                
                <div class="col mb-3">
                    
                    </div>
                    
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">About</a></li>
                        </ul>
                    </div>
                    
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">About</a></li>
                        </ul>
                    </div>
                    
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0" style="color: bisque;">About</a></li>
                        </ul>
                    </div>
                </footer>
            </div>

            <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-decoration-none lh-1">
                        <img src="assets/logohorizontal.png" alt="" class="bi me-2" height="32">
                    </a>
                    <span class="mb-3 mb-md-0">© 2024 Company Odi's Tour. All Rights Reserved.</span>
                </div>
                
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="" href="#"><img src="assets/facebook.png" alt="" class="bi" width="24" height="24"></a></li>
                    <li class="ms-3"><a class="" href="#"><img src="assets/twitter.png" alt="" class="bi" width="24" height="24"></a></li>
                    <li class="ms-3"><a class="" href="#"><img src="assets/instagram.png" alt="" class="bi" width="24" height="24"></a></li>
                    
                </ul>
            </footer>
        </div>

    </section>
            
    <!-- FOOTER END -->

    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <a href="https://wa.me/6285643449811">
            <img src="assets/WA.png" alt="" style="width: 100px;">
        </a>
    </div>

    <script>
        function alertLogin() {
            alert('Silakan login terlebih dahulu untuk melakukan booking!');
            window.location.href = 'loginregister/loginform.php';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>
<!-- NAVBAR CUSTOMER -->

<!-- Koneksi database -->
<?php require('../componen/koneksi.php'); ?>

<nav class="navbar navbar-expand-lg bg-dark shadow-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: #B8860B" href="#">Odi'S Tour</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Menu</button>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" style="color: #B8860B" aria-current="page" href="../customer/home_customer.php">Home</a>
                <a class="nav-link" style="color: #B8860B" href="../customer/inputan.php">List Paket</a>
                <a class="nav-link" style="color: #B8860B" href="../booking/booking.php">Booking</a>
                <a class="nav-link" style="color: #B8860B" href="../booking/riwayat_transaksi.php">Riwayat Transaksi</a>
                <a class="nav-link" style="color: #B8860B" href="../simulasi/simulasi_customer.php">Simulasi Tabungan</a>
                <span class="nav-link" style="color: #B8860B">Welcome, <?php echo $_SESSION['nama']; ?></span>
                <a class="icon-link icon-link-hover link-warning link-underline-warning link-underline-opacity-25" style="--bs-link-hover-color-rgb: 184, 134, 11;" href="../loginregister/logout.php">Logout<svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg></a>
            </div>
        </div>
    </div>
</nav>

<!-- SIDE BAR CUSTOMER -->
<div class="offcanvas offcanvas-start bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link active" style="color: #B8860B" aria-current="page" href="../customer/home_customer.php">Home</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../customer/inputan.php">List Paket</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../booking/booking.php">Booking</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../booking/riwayat_transaksi.php">Riwayat Transaksi</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../simulasi/simulasi_customer.php">Simulasi Tabungan</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../loginregister/logout.php">Logout</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link disabled opacity-75" style="color: #B8860B" aria-disabled="true">Enjoy Your Flight</a></li>
        </ul>
    </div>
</div>
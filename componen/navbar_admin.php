<!-- NAVBAR ADMIN -->
<nav class="navbar navbar-expand-lg bg-dark shadow-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: #B8860B" href="#">Odi'S Tour - Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Menu</button>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" style="color: #B8860B" aria-current="page" href="../admin/home_admin.php">Home</a>
                <a class="nav-link" style="color: #B8860B" href="../list/inputan.php">List Paket</a>
                <a class="nav-link" style="color: #B8860B" href="../list/form.php">Input Paket</a>
                <a class="nav-link" style="color: #B8860B" href="../booking/admin_riwayat_transaksi.php">Riwayat Transaksi</a>
                <a class="nav-link" style="color: #B8860B" href="../simulasi/simulasi_admin.php">Simulasi Tabungan</a>
                <span class="nav-link" style="color: #B8860B">Admin Panel</span>
                <a class="icon-link icon-link-hover link-warning link-underline-warning link-underline-opacity-25" style="--bs-link-hover-color-rgb: 184, 134, 11;" href="../loginregister/logout.php">Logout<svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg></a>
            </div>
        </div>
    </div>
</nav>

<!-- SIDE BAR ADMIN -->
<div class="offcanvas offcanvas-start bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Admin Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link active" style="color: #B8860B" aria-current="page" href="../admin/home_admin.php">Home</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../list/inputan.php">List Paket</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../list/form.php">Input Paket</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../booking/admin_riwayat_transaksi.php">Riwayat Transaksi</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../simulasi/simulasi_admin.php">Simulasi Tabungan</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link" style="color: #B8860B" href="../loginregister/logout.php">Logout</a></li>
            <li class="list-group-item bg-dark" style="color: #B8860B"><a class="nav-link disabled opacity-75" style="color: #B8860B" aria-disabled="true">Admin Panel</a></li>
        </ul>
    </div>
</div>
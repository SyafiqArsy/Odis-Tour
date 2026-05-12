<?php 
require('../componen/koneksi.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: inputPaket.php?msg=ID tidak valid");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM paket_umroh WHERE id_paket = $id");

if (!$query || mysqli_num_rows($query) == 0) {
    header("Location: inputPaket.php?msg=Data tidak ditemukan");
    exit;
}

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Umroh - <?= htmlspecialchars($data['nama_paket']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../componen/styleshasilform.css">
</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-info-circle"></i> Detail Paket Umroh</h2>
                <a href="inputPaket.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5><i class="fas fa-image"></i> Foto Paket</h5>
                        </div>
                        <div class="card-body text-center">
                            <?php if (file_exists($data['foto_paket'])): ?>
                                <img src="<?= $data['foto_paket'] ?>" class="img-fluid rounded" style="max-height: 300px;">
                            <?php else: ?>
                                <div class="text-muted">
                                    <i class="fas fa-image fa-5x"></i>
                                    <p>Foto tidak tersedia</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5><i class="fas fa-info"></i> Informasi Paket</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong><i class="fas fa-tag"></i> ID Paket:</strong></td>
                                    <td><?= $data['id_paket'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-box"></i> Nama Paket:</strong></td>
                                    <td><?= htmlspecialchars($data['nama_paket']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-money-bill-wave"></i> Harga:</strong></td>
                                    <td><span class="text-success fw-bold">Rp <?= number_format($data['harga_paket'], 0, ',', '.') ?></span></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-calendar"></i> Tanggal Keberangkatan:</strong></td>
                                    <td><?= date('d F Y', strtotime($data['tgl_keberangkatan'])) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-clock"></i> Durasi:</strong></td>
                                    <td><?= htmlspecialchars($data['durasi_Perjalanan']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-check-circle"></i> Status:</strong></td>
                                    <td>
                                        <?php if ($data['konfirmasi'] == 1): ?>
                                            <span class="badge bg-success"><i class="fas fa-check"></i> Terkonfirmasi</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning"><i class="fas fa-exclamation"></i> Belum Terkonfirmasi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5><i class="fas fa-list"></i> Detail Fasilitas</h5>
                        </div>
                        <div class="card-body">
                            <p><?= nl2br(htmlspecialchars($data['detail_fasilitas'])) ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5><i class="fas fa-plus-circle"></i> Fasilitas Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <?php 
                            $fasilitas = explode(', ', $data['fasilitas_tambahan']);
                            if (!empty($fasilitas[0])): 
                            ?>
                                <ul class="list-unstyled">
                                    <?php foreach ($fasilitas as $item): ?>
                                        <li><i class="fas fa-check text-success"></i> <?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">Tidak ada fasilitas tambahan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="edit.php?id=<?= $data['id_paket'] ?>" class="btn btn-warning me-md-2">
                    <i class="fas fa-edit"></i> Edit Paket
                </a>
                <a href="delete.php?id=<?= $data['id_paket'] ?>" class="btn btn-danger" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                    <i class="fas fa-trash"></i> Hapus Paket
                </a>
                <a href="inputPaket.php" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Lihat Semua Paket
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
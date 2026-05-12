<?php
include '../componen/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPaket = isset($_POST["namaPaket"]) ? htmlspecialchars($_POST["namaPaket"]) : '';
    $hargaPaket = isset($_POST["hargaPaket"]) ? intval($_POST["hargaPaket"]) : 0;
    $detailFasilitas = isset($_POST["detailFasilitas"]) ? htmlspecialchars($_POST["detailFasilitas"]) : '';
    $tanggalKeberangkatan = isset($_POST["tanggalKeberangkatan"]) ? $_POST["tanggalKeberangkatan"] : date("Y-m-d");
    $durasi = isset($_POST["durasi"]) ? $_POST["durasi"] : '';
    $konfirmasi = isset($_POST["konfirmasi"]) && $_POST["konfirmasi"] === "Setuju" ? 1 : 0;
    $fasilitas = isset($_POST["fasilitas"]) ? implode(", ", $_POST["fasilitas"]) : "Tidak ada fasilitas tambahan";

    // Upload foto
    if (isset($_FILES['fotoPaket']) && $_FILES['fotoPaket']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES["fotoPaket"]["name"]);
        $uploadFile = $uploadDir . $fileName;
        move_uploaded_file($_FILES["fotoPaket"]["tmp_name"], $uploadFile);
        $fotoPaket = $uploadFile;
    } else {
        $fotoPaket = "uploads/default.png"; // fallback
    }

    $query = "INSERT INTO paket_umroh 
        (nama_Paket, harga_Paket, detail_Fasilitas, foto_Paket, tgl_Keberangkatan, fasilitas_Tambahan, durasi_Perjalanan, konfirmasi) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sisssssi", $namaPaket, $hargaPaket, $detailFasilitas, $fotoPaket, $tanggalKeberangkatan, $fasilitas, $durasi, $konfirmasi);

    if (mysqli_stmt_execute($stmt)) {
        $sukses = true;
    } else {
        $sukses = false;
        $error = mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
}
?>

<!-- HTML hasil -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Proses Paket Umroh</title>
    <link rel="stylesheet" href="../componen/styleshasilform.css">
</head>
<body>
<div class="form-container">
    <h2>Hasil Proses Paket Umroh</h2>

    <?php if (isset($sukses) && $sukses): ?>
        <p><strong>Nama Paket:</strong> <?= $namaPaket ?></p>
        <p><strong>Harga Paket:</strong> Rp <?= number_format($hargaPaket, 0, ',', '.') ?></p>
        <p><strong>Detail Fasilitas:</strong> <?= $detailFasilitas ?></p>
        <p><strong>Tanggal Keberangkatan:</strong> <?= $tanggalKeberangkatan ?></p>
        <p><strong>Durasi Perjalanan:</strong> <?= $durasi ?></p>
        <p><strong>Fasilitas Tambahan:</strong> <?= $fasilitas ?></p>
        <p><strong>Foto Paket:</strong><br><img src="<?= $fotoPaket ?>" width="200"></p>
        <p><strong>Konfirmasi:</strong> <?= $konfirmasi ? 'Sudah dikonfirmasi' : 'Belum dikonfirmasi' ?></p>
        <a href="../admin/home_admin.php" class="btn btn-success">Kembali</a>
    <?php else: ?>
        <p style="color:red;">Gagal menyimpan data! <?= isset($error) ? $error : '' ?></p>
    <?php endif; ?>
</div>
</body>
</html>

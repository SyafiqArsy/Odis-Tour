<?php
// Mulai session untuk mengambil data login
session_start();

// Cek apakah user sudah login dan role-nya customer
if (!isset($_SESSION['namauser']) || $_SESSION['role'] !== 'customer') {
    echo "<script>alert('Anda harus login sebagai customer terlebih dahulu!'); window.location.href='../loginregister/loginform.php';</script>";
    exit();
}

include '../componen/koneksi.php';

// Inisialisasi variabel untuk menghindari undefined variable
$namaPembeli = '';
$nomorHP = '';
$paketUmroh = '';
$hargaPaket = 0;
$detailFasilitas = '';
$fasilitasTambahan = '';
$durasiPerjalanan = '';
$jumlahPaket = 0;
$totalHarga = 0;
$tglKeberangkatan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPaket = htmlspecialchars($_POST["paketUmroh"]);
    $namaPembeli = htmlspecialchars($_POST["namaPembeli"]);
    $nomorHP = htmlspecialchars($_POST["nomorHP"]);
    $jumlahPaket = htmlspecialchars($_POST["jumlahPaket"]);
    
    // Ambil id_customer dari session berdasarkan email yang login
    $emailLogin = $_SESSION['namauser'];
    $queryCustomer = $koneksi->query("SELECT id_Cust FROM customer WHERE email = '$emailLogin'");
    
    if ($queryCustomer && $queryCustomer->num_rows === 1) {
        $customerData = $queryCustomer->fetch_assoc();
        $idCustomer = $customerData['id_Cust'];
    } else {
        echo "<script>alert('Data customer tidak ditemukan!'); window.location.href='../loginregister/loginform.php';</script>";
        exit();
    }

    // Ambil data paket
    $paketYangDipilih = $koneksi->query("SELECT * FROM paket_umroh WHERE id_paket = $idPaket");
    if ($paketYangDipilih->num_rows > 0) {
        $row = $paketYangDipilih->fetch_assoc();
        
        $paketUmroh = $row['nama_paket'];
        $hargaPaket = $row['harga_paket'];
        $detailFasilitas = $row['detail_fasilitas'];
        $fasilitasTambahan = $row['fasilitas_tambahan'];
        $durasiPerjalanan = $row['durasi_Perjalanan'];
        $tglKeberangkatanRaw = $row['tgl_keberangkatan'];
        $tglKeberangkatan = date("Y-m-d", strtotime($tglKeberangkatanRaw));

        // Hitung total harga
        $totalHarga = $hargaPaket * $jumlahPaket;

        // Mulai transaksi
        $koneksi->begin_transaction();

        try {
            // Query insert ke tabel booking
            $insertBooking = $koneksi->prepare("
                INSERT INTO booking 
                (id_paket, id_customer, nama_pembeli, paket_umroh, jml_paket, tgl_keberangkatan) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $insertBooking->bind_param(
                "iissis",
                $idPaket,
                $idCustomer,
                $namaPembeli,
                $paketUmroh,
                $jumlahPaket,
                $tglKeberangkatan
            );

            $insertBooking->execute();

            // Insert ke tabel riwayat_transaksi
            $insertRiwayat = $koneksi->prepare("
                INSERT INTO riwayat_transaksi 
                (id_paket, id_customer, total_harga, status_pembayaran, status, detail) 
                VALUES (?, ?, ?, 'pending', 'menunggu konfirmasi', 'Pesanan baru dibuat')
            ");
            
            $insertRiwayat->bind_param("iid", $idPaket, $idCustomer, $totalHarga);
            $insertRiwayat->execute();

            // Commit transaksi jika semua query berhasil
            $koneksi->commit();

            echo "<script>alert('Pemesanan berhasil disimpan!');</script>";
        } catch (Exception $e) {
            // Rollback jika terjadi error
            $koneksi->rollback();
            echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
        } finally {
            $insertBooking->close();
            if (isset($insertRiwayat)) {
                $insertRiwayat->close();
            }
        }
    } else {
        echo "<script>alert('Paket tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Proses Pemesanan Paket Umroh</title>
    <link rel="stylesheet" href="../componen/styleshasilform.css">
</head>

<body>
    <div class="form-container">
        <h2>Hasil Proses Paket Umroh</h2>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($namaPembeli)): ?>
            <div class="user-info">
                <p><strong>Customer Login:</strong> <?php echo $_SESSION['nama']; ?> (<?php echo $_SESSION['namauser']; ?>)</p>
                <hr>
            </div>
    
            <p><strong>Nama Pembeli:</strong> <?php echo $namaPembeli; ?></p>
            <p><strong>Nomor HP:</strong> <?php echo $nomorHP; ?></p>
            <p><strong>Nama Paket:</strong> <?php echo $paketUmroh; ?></p>
            <p><strong>Detail Fasilitas:</strong> <?php echo $detailFasilitas; ?></p>
            <p><strong>Fasilitas Tambahan:</strong> <?php echo $fasilitasTambahan; ?></p>
            <p><strong>Durasi Perjalanan:</strong> <?php echo $durasiPerjalanan; ?></p>
            <p><strong>Jumlah Paket:</strong> <?php echo $jumlahPaket; ?></p>
            <p><strong>Total Harga:</strong> Rp <?php echo number_format($totalHarga, 0, ",", "."); ?></p>
            <p><strong>Tanggal Keberangkatan:</strong> <?php echo date("d-m-Y", strtotime($tglKeberangkatan)); ?></p>
            <p><strong>Status Pesanan:</strong> <span class="badge bg-warning">Pending</span></p>
        <?php else: ?>
            <p>Tidak ada data pemesanan yang diproses.</p>
        <?php endif; ?>
        
        <a href="../customer/home_customer.php" class="btn btn-success">Kembali</a>
        <a href="../booking/riwayat_transaksi.php" class="btn btn-primary">Lihat Riwayat Transaksi</a>
    </div>
</body>

</html>
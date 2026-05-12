<?php
include '../componen/auth_check.php';
isLoggedIn();
isCustomer();
requireLogin();

// Koneksi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'website_umroh';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $hargaPaket = $_POST['hargaPaket'];
    // variabel hargaPaket bernilai hargaPaket di method post, fungsi method postnya itu nyari di simulasiPHP
    $tahunKeberangkatan = $_POST['tahunKeberangkatan'];
    $bulanKeberangkatan = $_POST['bulanKeberangkatan'];
    $dpPersen = str_replace('%', '', $_POST['DP']) / 100;
            // mthd untk mengganti string jd yg kita minta

    // Konversi harga paket menjadi angka
    // $hargaPaket = str_replace(['Rp', ',', ' '], '', $hargaPaket);
    // $hargaPaket = (int) $hargaPaket;
        //agar hasilnya berbentuk bil.bulat

    // Hitung DP dan sisa pembayaran
    $dpBayar = $hargaPaket * $dpPersen;
    $sisaBayar = $hargaPaket - $dpBayar;

    // Hitung jumlah bulan menabung dari bulan sekarang sampai 1 bulan sebelum keberangkatan
    $bulanSekarang = date('n'); // Bulan saat ini (1-12)
    $tahunSekarang = date('Y');

    // Konversi bulan keberangkatan ke angka
    $bulanArray = ["Januari" => 1, "Juni" => 6,"November" => 11];
    $bulanKeberangkatanNum = $bulanArray[$bulanKeberangkatan];

    // Kurangi 1 bulan karena tabungan harus selesai 1 bulan sebelumnya
    $bulanKeberangkatanNum--;

    // Jika bulan keberangkatan menjadi 0 (karena Januari dikurangi 1), ubah ke Desember tahun sebelumnya
    if ($bulanKeberangkatanNum == 0) {
        $bulanKeberangkatanNum = 12;
        $tahunKeberangkatan--;
    }

    // Hitung durasi menabung dalam bulan
    $durasiBulan = (($tahunKeberangkatan - $tahunSekarang) * 12) + ($bulanKeberangkatanNum - $bulanSekarang);
    if ($durasiBulan <= 0) {
        $durasiBulan = 1; // Minimal 1 bulan agar tidak error
    }

    // Hitung cicilan per bulan
    $tabunganSebulan = $sisaBayar / $durasiBulan;
    
    // Nilai angsuran untuk semua bulan (untuk tabel kedua)
    $tabunganBulanan = round($tabunganSebulan);
    
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Simulasi Tabungan Umroh</title>
    <link rel="stylesheet" href="../componen/styleshasilsimulasi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- NAVBAR -->
    <?php include '../componen/navbar_customer.php'?>

    <section class="mt-5">
        <div class="container">
            <div class="form-container">
                <h2 class="text-center">Hasil Simulasi Tabungan Umroh</h2>
                
                <!-- Tabel Pertama: Hasil Simulasi -->
                <div class="table-container">
                    <table class="table table-bordered">
                        <tr>
                            <th>Paket Yang Dipilih</th>
                            <td>Rp <?= number_format($hargaPaket, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Keberangkatan</th>
                            <td><?= $tahunKeberangkatan ?></td>
                        </tr>
                        <tr>
                            <th>Bulan Keberangkatan</th>
                            <td><?= $bulanKeberangkatan ?></td>
                        </tr>
                        <tr>
                            <th>Tabungan Selesai di</th>
                            <td><?= $tahunKeberangkatan ?></td>
                        </tr>
                        <tr>
                            <th>Uang Muka (<?= $_POST['DP'] ?>)</th>
                            <td>Rp <?= number_format($dpBayar, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Sisa Pembayaran</th>
                            <td>Rp <?= number_format($sisaBayar, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Durasi Menabung</th>
                            <td><?= $durasiBulan ?> Bulan</td>
                        </tr>
                        <tr>
                            <th>Tabungan Per Bulan</th>
                            <td>Rp <?= number_format($tabunganSebulan, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
                
                <!-- Tabel Kedua: Angsuran per Bulan -->
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2">Tabungan per Bulan:</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php for ($i = 1; $i <= $durasiBulan; $i++) : ?>
                            <tr>
                                <td>Bulan <?= $i ?></td>
                                <td>Rp <?= number_format($tabunganBulanan, 0, ',', '.') ?></td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    
                </div>
                
                <div class="text-center">
                    <a href="simulasi_customer.php" class="btn btn-success">Kembali</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include '../componen/footer.php'?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
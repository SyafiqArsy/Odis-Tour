<?php
include '../componen/auth_check.php';
isLoggedIn();
requireCustomer();

include '../componen/koneksi.php';


$dataPaket = $koneksi->query("SELECT * FROM paket_umroh WHERE status = 'aktif'");
$paket_id = isset($_GET['paket_id']) ? $_GET['paket_id'] : '';

$nama_Cust = $_SESSION['nama'];
$userhp = $_SESSION['noHP'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesform.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- NAVBAR -->
    <?php include '../componen/navbar_customer.php' ?>

    <!-- MAIN FLEXIBLE CONTENT -->
    <main style="flex: 1;">
        <section class="mt-5 mb-5" style="color: #B8860B;">
            <div class="container">
                <div class="form-container"
                    style="max-width: 800px; margin: 0 auto; padding: 2rem; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                    <h2 class="text-center mb-4" style="font-weight: 600;">Formulir Pemesanan Paket Umroh</h2>
                    <form action="prosesbooking.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="namaPembeli" class="form-label">Nama Pembeli:</label>
                                <input type="text" id="namaPembeli" name="namaPembeli" class="form-control" value="<?= htmlspecialchars($nama_Cust) ?>"
                                    style="padding: 0.5rem;" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nomorHP" class="form-label">Nomor HP:</label>
                                <input type="text" id="nomorHP" name="nomorHP" class="form-control" value="<?= htmlspecialchars($userhp) ?>"
                                    style="padding: 0.5rem;" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="paketUmroh" class="form-label">Paket Umroh:</label>
                            <select id="paketUmroh" name="paketUmroh" class="form-select" style="padding: 0.5rem;">
                                <option selected>Pilih Paket</option>
                                <?php foreach ($dataPaket as $paket): ?>
                                    <option value="<?= $paket['id_paket'] ?>"
                                        data-detail="<?= htmlspecialchars($paket['detail_fasilitas']) ?>"
                                        data-tambahan="<?= htmlspecialchars($paket['fasilitas_tambahan']) ?>"
                                        data-durasi="<?= htmlspecialchars($paket['durasi_Perjalanan']) ?>"
                                        data-harga="<?= htmlspecialchars(number_format($paket['harga_paket'], 0, ",", ".")) ?>"
                                        data-tanggal-berangkat="<?= htmlspecialchars($paket['tgl_keberangkatan']) ?>">
                                        <?= $paket['nama_paket'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="keteranganPaket" class="mb-3 p-3"
                            style=" border-radius: 8px; display: none; border-left: 4px solid #B8860B;">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Detail Fasilitas:</strong>
                                    <p id="detailFasilitas" class="mb-2"></p>
                                    <strong>Fasilitas Tambahan:</strong>
                                    <p id="fasilitasTambahan" class="mb-2"></p>
                                    <strong>Harga Paket:</strong>
                                    <p id="hargaPaket" class="mb-2"></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tanggal Keberangkatan:</strong>
                                    <p id="tglKeberangkatan" class="mb-2"></p>
                                    <strong>Durasi Perjalanan:</strong>
                                    <p id="durasiPerjalanan" class="mb-2"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="jumlahPaket" class="form-label">Jumlah Paket:</label>
                            <input type="number" id="jumlahPaket" name="jumlahPaket" class="form-control"
                                style="padding: 0.5rem;" required>
                        </div>
                        <div id="totalHargaContainer" class="mb-4 p-3" style="background-color: #e8f5e8; border-radius: 8px; display: none;">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h5 class="mb-0">Total Harga:</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h4 id="totalHarga" class="mb-0 text-success fw-bold">Rp 0</h4>
                                </div>
                            </div>
                            <small class="text-muted">
                                <span id="rincianHitung"></span>
                            </small>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2"
                            style="font-weight: 600; font-size: 1.1rem;">Simpan Pesanan</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- END MAIN -->

    <!-- FOOTER -->
    <?php include '../componen/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>

function formatRibuan(angka) {
    // Pastikan angka adalah number
    const num = typeof angka === 'string' ? parseInt(angka.replace(/\./g, '')) : parseInt(angka);
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Fungsi untuk parse angka dari format ribuan (menghilangkan titik)
function parseRibuan(angkaString) {
    if (typeof angkaString === 'number') return angkaString;
    return parseInt(angkaString.toString().replace(/\./g, '')) || 0;
}

        // Event listener untuk paket umroh
        document.getElementById('paketUmroh').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const detail = selectedOption.getAttribute('data-detail');
            const tambahan = selectedOption.getAttribute('data-tambahan');
            const berangkat = selectedOption.getAttribute('data-tanggal-berangkat');
            const harga = selectedOption.getAttribute('data-harga');
            const durasi = selectedOption.getAttribute('data-durasi');

            if (detail || tambahan) {
                document.getElementById('detailFasilitas').textContent = detail;
                document.getElementById('fasilitasTambahan').textContent = tambahan;
                document.getElementById('tglKeberangkatan').textContent = berangkat;
                document.getElementById('hargaPaket').textContent = "Rp " + harga;
                document.getElementById('durasiPerjalanan').textContent = durasi;
                document.getElementById('keteranganPaket').style.display = 'block';
            } else {
                document.getElementById('keteranganPaket').style.display = 'none';
            }

            // Hitung total langsung
            hitungTotalOtomatis();
});

// Event listener untuk jumlah paket
document.getElementById('jumlahPaket').addEventListener('input', hitungTotalOtomatis);

// Fungsi untuk menghitung total otomatis langsung
function hitungTotalOtomatis() {
    const paketSelect = document.getElementById('paketUmroh');
    const jumlahPaket = document.getElementById('jumlahPaket').value;
    
    if (paketSelect.value && jumlahPaket && jumlahPaket > 0) {
        const selectedOption = paketSelect.options[paketSelect.selectedIndex];
        const hargaPaket = selectedOption.getAttribute('data-harga');
        
        if (hargaPaket) {
            // Langsung hitung tanpa delay
            hitungDenganAJAX(paketSelect.value, jumlahPaket, hargaPaket);
        }
    } else {
        // Sembunyikan area total jika input tidak lengkap
        document.getElementById('totalHargaContainer').style.display = 'none';
    }
}

// Fungsi AJAX untuk menghitung total (langsung tanpa loading)
function hitungDenganAJAX(paketId, jumlah, hargaPaket) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'hitung_total.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        tampilkanHasil(response.total, response.rincian);
                    } else {
                        console.error('Error:', response.message);
                        // Fallback ke perhitungan manual jika server error
                        hitungManual(hargaPaket, jumlah);
                    }
                } catch (e) {
                    console.error('Parse error:', e);
                    // Fallback ke perhitungan manual
                    hitungManual(hargaPaket, jumlah);
                }
            } else {
                console.error('HTTP Error:', xhr.status);
                // Fallback ke perhitungan manual
                hitungManual(hargaPaket, jumlah);
            }
        }
    };
    
    // Kirim data dengan harga yang sudah di-parse (tanpa titik)
    const hargaBersih = parseRibuan(hargaPaket);
    xhr.send(`paket_id=${paketId}&jumlah=${jumlah}&harga_paket=${hargaBersih}`);
}

// Fallback perhitungan manual jika AJAX gagal
function hitungManual(hargaPaket, jumlah) {
    // Parse harga paket untuk menghilangkan titik
    const hargaBersih = parseRibuan(hargaPaket);
    const total = hargaBersih * parseInt(jumlah);
    const rincian = `Rp ${formatRibuan(hargaBersih)} × ${jumlah} paket`;
    tampilkanHasil(total, rincian);
}

// Fungsi untuk menampilkan hasil perhitungan
function tampilkanHasil(total, rincian) {
    // Format total dengan titik ribuan
    document.getElementById('totalHarga').textContent = 'Rp ' + formatRibuan(total);
    document.getElementById('rincianHitung').textContent = rincian;
    document.getElementById('totalHargaContainer').style.display = 'block';
}

        // Auto-select paket dari URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const selectedId = urlParams.get('id');

        if (selectedId) {
            const select = document.getElementById('paketUmroh');
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value === selectedId) {
                    select.selectedIndex = i;
                    select.dispatchEvent(new Event('change'));
                    break;
                }
            }
        }

        // Trigger change on load untuk paket yang sudah terpilih
        window.addEventListener('DOMContentLoaded', () => {
            const paketSelect = document.getElementById('paketUmroh');
            if (paketSelect.value) {
                paketSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Umroh</title>
    <link rel="stylesheet" href="../componen/stylesform.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include '../componen/navbar_admin.php'?>

<main style="flex: 1;">
    <section class="mt-5" style="color: #B8860B;">
        <div class="container">
            <div class="form-container">
                <h2 class="text-center">Tambah Paket Umroh</h2>
                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="namaPaket" class="form-label">Nama Paket:</label>
                        <input type="text" id="namaPaket" name="namaPaket" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="hargaPaket" class="form-label">Harga Paket (Rp):</label>
                        <input type="number" id="hargaPaket" name="hargaPaket" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label for="detailFasilitas" class="form-label">Detail Fasilitas:</label>
                        <textarea id="detailFasilitas" name="detailFasilitas" class="form-control" rows="2" required></textarea>
                    </div>

                    <div class="mb-2">
                        <label for="fotoPaket" class="form-label">Foto Paket:</label>
                        <input type="file" id="fotoPaket" name="fotoPaket" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-2">
                        <label for="tanggalKeberangkatan" class="form-label">Tanggal Keberangkatan:</label>
                        <input type="date" id="tanggalKeberangkatan" name="tanggalKeberangkatan" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Fasilitas Tambahan:</label>
                        <div class="d-flex flex-wrap">
                            <div class="form-check me-2">
                                <input type="checkbox" id="asuransi" name="fasilitas[]" value="Asuransi" class="form-check-input">
                                <label for="asuransi" class="form-check-label">Asuransi</label>
                            </div>
                            <div class="form-check me-2">
                                <input type="checkbox" id="manasik" name="fasilitas[]" value="Manasik" class="form-check-input">
                                <label for="manasik" class="form-check-label">Manasik</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="airZamzam" name="fasilitas[]" value="Air Zamzam" class="form-check-input">
                                <label for="airZamzam" class="form-check-label">Air Zamzam</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="durasi" class="form-label">Durasi Perjalanan:</label>
                        <select id="durasi" name="durasi" class="form-select">
                            <option value="10 Hari">10 Hari</option>
                            <option value="12 Hari">12 Hari</option>
                            <option value="15 Hari">15 Hari</option>
                            <option value="20 Hari">20 Hari</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Konfirmasi:</label>
                        <div class="form-check">
                            <input type="radio" id="konfirmasi" name="konfirmasi" value="Setuju" class="form-check-input" required>
                            <label for="konfirmasi" class="form-check-label">Saya telah mengonfirmasi semua data dalam paket ini.</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include '../componen/footer.php'?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

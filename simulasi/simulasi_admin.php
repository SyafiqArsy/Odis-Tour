<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Tabungan Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesform.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <!-- NAVBAR -->
    <?php include '../componen/navbar_admin.php'?>

    <!-- MAIN CONTENT -->
    <main style="flex: 1;">
        <section class="my-5" style="color: #B8860B; padding-bottom: 100px;">
           <!-- my-5(margin atas n bawah) ini buat manggil class  -->
        <div class="container">
                <div class="form-container">
                    <h2 class="text-center">Simulasi Tabungan Umroh</h2>
                    <form action="prosessimulasi_admin.php" method="POST">
                            <!--action: nentuin tmpt tujuan stlh submit form, dgn method post:metode ngirim data ke prosessimulasi.php
                            <!-- PILIH HARGA PAKET -->
                        <div class="mb-2">
                            <label for="hargaPaket" class="form-label">Paket Yang Dipilih:</label>
                            <select id="hargaPaket" name="hargaPaket" class="form-select">
                                <option value="" disabled selected style="color: #555;">Pilih Paket</option>
                                <option value="28000000">Paket Reguler - Rp 28,000,000</option>
                                <option value="33000000">Paket Diamond - Rp 33,000,000</option>
                                <option value="38000000">Paket Prestige - Rp 38,000,000</option>
                            </select>
                        </div>

                        <!-- TAHUN KEBERANGKATAN -->
                        <div class="mb-2">
                            <label for="tahunKeberangkatan" class="form-label">Tahun Keberangkatan:</label>
                            <input type="number" id="tahunKeberangkatan" name="tahunKeberangkatan" class="form-control"
                                min="<?= date('Y') ?>" max="2035" placeholder="Masukkan tahun" required>
                        </div>

                        <!-- BULAN KEBERANGKATAN -->
                        <div class="mb-2">
                            <label for="bulanKeberangkatan" class="form-label">Bulan Keberangkatan:</label>
                            <select id="bulanKeberangkatan" name="bulanKeberangkatan" class="form-select" required>
                                <option value="" disabled selected>Pilih Bulan</option>
                                <option value="Januari">Januari</option>
                                <option value="Juni">Juni</option>
                                <option value="November">November</option>
                            </select>
                        </div>

                        <!-- DP -->
                        <div class="mb-2">
                            <label for="DP" class="form-label">Uang Muka:</label>
                            <select id="DP" name="DP" class="form-select">
                                <option value="" disabled selected style="color: #555;">Pilih..</option>
                                <option value="10%">10%</option>
                                <option value="20%">20%</option>
                                <option value="30%">30%</option>
                                <option value="40%">40%</option>
                                <option value="50%">50%</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- MAIN END -->

    <!-- FOOTER -->
    <?php include '../componen/footer.php'?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
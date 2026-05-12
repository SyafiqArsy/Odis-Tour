<?php
include '../componen/auth_check.php';
isLoggedIn();
isCustomer();
requireCustomer();
?>

<!-- Koneksi database -->
<?php require('../componen/koneksi.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paket Umroh</title>
    <link rel="stylesheet" href="../componen/stylesinputpaket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Search Container Styling - sama dengan search.php */
        .search-container {
            background: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
            border: 2px solid #f4c430;
        }
        
        .search-form {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .search-input {
            flex: 1;
            max-width: 450px;
            min-width: 300px;
            padding: 15px 20px;
            border: 3px solid #f4c430;
            border-radius: 30px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .search-input:focus {
            outline: none;
            border-color: #b8860b;
            box-shadow: 0 0 0 0.3rem rgba(184, 134, 11, 0.25);
            background: white;
            transform: translateY(-2px);
        }
        
        .search-btn {
            padding: 15px 30px;
            background: linear-gradient(45deg, #b8860b, #daa520);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .search-btn:hover {
            background: linear-gradient(45deg, #daa520, #ffd700);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(184, 134, 11, 0.6);
        }
        
        .search-title {
            text-align: center;
            margin-bottom: 20px;
            color: #8b4513;
            font-weight: 700;
            font-size: 1.4em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        /* Page Header Styling */
        .page-header {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #ffd700 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.3);
            border: 2px solid #f4c430;
        }
        
        .page-header h2 {
            color: white;
            margin: 0;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            font-size: 1.8em;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        /* Container Styling */
        .form-container {
            color:white;
            background: linear-gradient(135deg, #fffacd 0%, #fff8dc 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Table Styling - sama dengan search.php */
        .table-responsive {
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.2);
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid #f4c430;
            margin-bottom: 25px;
        }
        
        .table th {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #ffd700 100%);
            color: white;
            font-weight: 700;
            border: none;
            padding: 18px 15px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            font-size: 14px;
        }
        
        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-color: #f4c430;
            background: rgba(255, 248, 220, 0.3);
        }
        
        .table tbody tr:hover {
            background: linear-gradient(135deg, #fff8dc 0%, #ffeaa7 100%);
            transition: all 0.3s ease;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.2);
        }
        
        .table tbody tr:nth-child(even) {
            background: rgba(255, 215, 0, 0.1);
        }
        
        .table tbody tr:nth-child(even):hover {
            background: linear-gradient(135deg, #fff8dc 0%, #ffeaa7 100%);
        }
        
        /* Button Styling - sama dengan search.php */
        .btn-warning {
            color: white;
            background: linear-gradient(45deg,rgb(215, 215, 215),rgb(255, 224, 145));
            border: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(184, 134, 11, 0.3);
        }
        
        .btn-warning:hover {
            background: linear-gradient(45deg, #daa520, #ffd700);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.5);
            color: white;
        }

        .btn-success {
            background: linear-gradient(45deg, #b8860b, #daa520);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-success:hover {
            background: linear-gradient(45deg, #daa520, #ffd700);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(184, 134, 11, 0.6);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #8b4513, #a0522d);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(139, 69, 19, 0.3);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(45deg, #a0522d, #cd853f);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 69, 19, 0.5);
            color: white;
        }
        
        /* Modal Styling - sama dengan search.php */
        .modal-header {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #ffd700 100%) !important;
            color: white !important;
            border-bottom: 3px solid #f4c430;
        }
        
        .modal-header h5 {
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .modal-body {
            background: linear-gradient(135deg, #fff8dc 0%, #ffeaa7 100%);
            padding: 30px;
        }
        
        .modal-footer {
            background: rgba(255, 248, 220, 0.5);
            border-top: 2px solid #f4c430;
        }
        
        .detail-item p {
            margin-bottom: 15px;
            padding: 12px;
            border-left: 4px solid #daa520;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(184, 134, 11, 0.1);
        }
        
        .detail-item strong {
            color: #8b4513;
            display: inline-block;
            min-width: 180px;
            font-weight: 700;
        }

        /* Form Control Styling */
        .form-control {
            border: 2px solid #f4c430;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-control:focus {
            outline: none;
            border-color: #b8860b;
            box-shadow: 0 0 0 0.3rem rgba(184, 134, 11, 0.25);
            background: white;
        }

        .modal-body label {
            color: #8b4513;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        
        /* Image Styling - sama dengan search.php */
        .img-thumbnail {
            border: 3px solid #f4c430;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.3);
        }
        
        /* Price Styling */
        .table td:nth-child(7) {
            font-weight: 700;
            color: #b8860b;
            font-size: 16px;
        }

        /* Back Button Container */
        .back-container {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
        }

        .back-container h3 {
            margin: 0;
        }

        .back-container .btn {
            font-size: 18px;
            padding: 15px 35px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                gap: 10px;
            }
            
            .search-input {
                min-width: 250px;
                max-width: 100%;
            }
            
            .search-btn {
                width: 100%;
                max-width: 250px;
            }
            
            .page-header {
                padding: 20px 15px;
            }
            
            .page-header h2 {
                font-size: 1.4em;
                letter-spacing: 1px;
            }
            
            .table-responsive {
                font-size: 12px;
            }
            
            .table th, .table td {
                padding: 8px 6px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <?php include '../componen/navbar_customer.php'?>

    <div class="form-container">
        <!-- Search Bar - sama dengan search.php -->
        <div class="search-container">
            <h4 class="search-title">🔍 Cari Paket Umroh</h4>
            <form action="search.php" method="GET" class="search-form">
                <input type="text" name="keyword" class="search-input" 
                       placeholder="Masukkan nama paket atau fasilitas yang dicari..." required>
                <button type="submit" class="search-btn">Cari Paket</button>
            </form>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h2>📋 LIST KETERSEDIAAN PAKET</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Detail Fasilitas</th>
                        <th>Foto</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Fasilitas Tambahan</th>
                        <th>Harga Paket</th>
                        <th>Durasi Perjalanan</th>
                        <th>Konfirmasi</th>
                        <th>Edit</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idPaket = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM paket_umroh");

                    if (!$data) {
                        echo "Query error: " . mysqli_error($koneksi);
                        exit;
                    }

                    if (mysqli_num_rows($data) == 0) {
                        echo "Tidak ada data paket umroh.";
                        exit;
                    }

                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?php echo $idPaket++; ?></td>
                            <td><?php echo $d['nama_paket']; ?></td>
                            <td><?php echo $d['detail_fasilitas']; ?></td>
                            <td>
                                <?php
                                $foto_db = $d['foto_paket']; // misal 'uploads/1748437393_Minato_Walk_4.png'
                                // Cek apakah $foto_db sudah ada 'uploads/' diawal
                                if (strpos($foto_db, 'uploads/') === 0) {
                                    $foto_path = __DIR__ . '/' . $foto_db;  // path server untuk file_exists
                                    $url_file = $foto_db;                   // path URL untuk img src
                                } else {
                                    $foto_path = __DIR__ . '/uploads/' . $foto_db;
                                    $url_file = 'uploads/' . $foto_db;
                                }
                                if (!empty($foto_db) && file_exists($foto_path)) {
                                    echo "<img src='$url_file' alt='Foto Paket' class='img-thumbnail' style='width:120px; height:auto;'>";
                                } else {
                                    echo "<span class='text-muted'>Foto tidak tersedia</span>";
                                }
                                ?>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($d['tgl_keberangkatan'])); ?></td>
                            <td><?php echo $d['fasilitas_tambahan']; ?></td>
                            <td><strong>Rp <?php echo number_format($d['harga_paket'], 0, ',', '.'); ?></strong></td>
                            <td><?php echo $d['durasi_Perjalanan']; ?></td>
                            <td><?php echo $d['konfirmasi']; ?></td>
                            <td>
                                <a href="#" class="btn-edit btn btn-warning"
                                    data-id="<?= $d['id_paket']; ?>"
                                    data-nama="<?= htmlspecialchars($d['nama_paket']); ?>"
                                    data-detail="<?= htmlspecialchars($d['detail_fasilitas']); ?>"
                                    data-tanggal="<?= $d['tgl_keberangkatan']; ?>"
                                    data-fasilitas="<?= htmlspecialchars($d['fasilitas_tambahan']); ?>"
                                    data-harga="<?= $d['harga_paket']; ?>"
                                    data-durasi="<?= htmlspecialchars($d['durasi_Perjalanan']); ?>"
                                    data-konfirmasi="<?= $d['konfirmasi']; ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="updateStatus.php" style="display:inline;">
                                    <input type="hidden" name="id_paket" value="<?= $d['id_paket']; ?>">
                                    <input type="hidden" name="status" value="<?= $d['status'] == 'aktif' ? 'nonaktif' : 'aktif'; ?>">
                                    <button type="submit" class="btn btn-sm <?= $d['status'] == 'aktif' ? 'btn-secondary' : 'btn-success'; ?>">
                                        <?= $d['status'] == 'aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>
                                    </button>
                                </form>
                            </td>

                            <td>
                                <a href="#" class="btn-detail btn btn-warning"
                                    data-id="<?= $d['id_paket']; ?>"
                                    data-nama="<?= htmlspecialchars($d['nama_paket']); ?>"
                                    data-detail="<?= htmlspecialchars($d['detail_fasilitas']); ?>"
                                    data-tanggal="<?= $d['tgl_keberangkatan']; ?>"
                                    data-fasilitas="<?= htmlspecialchars($d['fasilitas_tambahan']); ?>"
                                    data-harga="<?= $d['harga_paket']; ?>"
                                    data-durasi="<?= htmlspecialchars($d['durasi_Perjalanan']); ?>"
                                    data-konfirmasi="<?= $d['konfirmasi']; ?>"
                                    data-status="<?= $d['status']; ?>"
                                    data-foto="<?= $url_file ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal">
                                    Detail
                                </a>
                            </td>

                        </tr>
                    <?php } ?>
                    <?php
                    if (isset($_POST['submitEdit'])) {
                        $id_paket = $_POST['id_paket'];
                        $nama = $_POST['nama_paket'];
                        $detail = $_POST['detail_fasilitas'];
                        $tgl = $_POST['tgl_keberangkatan'];
                        $fasilitas = $_POST['fasilitas_tambahan'];
                        $harga = $_POST['harga_paket'];
                        $durasi = $_POST['durasi_Perjalanan'];
                        $konfirmasi = $_POST['konfirmasi'];

                        // Cek apakah file foto di-upload
                        if ($_FILES['foto_paket']['name'] != "") {
                            $foto_name = $_FILES['foto_paket']['name'];
                            $foto_tmp = $_FILES['foto_paket']['tmp_name'];
                            $upload_dir = "uploads/";

                            // Simpan foto baru
                            move_uploaded_file($foto_tmp, $upload_dir . $foto_name);
                            // Update dengan foto
                            $queryUpdate = mysqli_query($koneksi, "UPDATE paket_umroh SET 
                            nama_paket='$nama',
                            detail_fasilitas='$detail',
                            tgl_keberangkatan='$tgl',
                            fasilitas_tambahan='$fasilitas',
                            harga_paket='$harga',
                            durasi_Perjalanan='$durasi',
                            konfirmasi='$konfirmasi',
                            foto_paket='$foto_name'
                            WHERE id_paket=$id_paket");
                        } else {
                            // Update tanpa ganti foto
                            $queryUpdate = mysqli_query($koneksi, "UPDATE paket_umroh SET 
                            nama_paket='$nama',
                            detail_fasilitas='$detail',
                            tgl_keberangkatan='$tgl',
                            fasilitas_tambahan='$fasilitas',
                            harga_paket='$harga',
                            durasi_Perjalanan='$durasi',
                            konfirmasi='$konfirmasi'
                            WHERE id_paket=$id_paket");
                        }
                        if ($queryUpdate) {
                            echo "<script>alert('Data berhasil diupdate'); window.location.href='inputan.php';</script>";
                        } else {
                            echo "Gagal update: " . mysqli_error($koneksi);
                        }
                    }
                    ?>
                    <!-- Modal Bootstrap -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">✏️ Edit Paket Umroh</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_paket" id="edit-id">
                                        <div class="mb-3">
                                            <label>📦 Nama Paket</label>
                                            <input type="text" name="nama_paket" id="edit-nama" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>📋 Detail Fasilitas</label>
                                            <textarea name="detail_fasilitas" id="edit-detail" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>📅 Tanggal Keberangkatan</label>
                                            <input type="date" name="tgl_keberangkatan" id="edit-tanggal" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>⭐ Fasilitas Tambahan</label>
                                            <input type="text" name="fasilitas_tambahan" id="edit-fasilitas" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>💰 Harga Paket</label>
                                            <input type="number" name="harga_paket" id="edit-harga" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>⏰ Durasi Perjalanan</label>
                                            <input type="text" name="durasi_Perjalanan" id="edit-durasi" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>✅ Konfirmasi</label>
                                            <input type="number" name="konfirmasi" id="edit-konfirmasi" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>📸 Ganti Foto (jika ada)</label>
                                            <input type="file" name="foto_paket" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submitEdit" class="btn btn-success">💾 Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Detail - sama dengan search.php -->
                    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">📋 Detail Paket Umroh</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="detail-item">
                                                <p><strong>📦 Nama Paket:</strong> <span id="detail-nama"></span></p>
                                                <p><strong>📋 Detail Fasilitas:</strong> <span id="detail-fasilitas"></span></p>
                                                <p><strong>📅 Tanggal Keberangkatan:</strong> <span id="detail-tanggal"></span></p>
                                                <p><strong>⭐ Fasilitas Tambahan:</strong> <span id="detail-tambahan"></span></p>
                                                <p><strong>💰 Harga Paket:</strong> Rp <span id="detail-harga"></span></p>
                                                <p><strong>⏰ Durasi Perjalanan:</strong> <span id="detail-durasi"></span></p>
                                                <p><strong>✅ Konfirmasi:</strong> <span id="detail-konfirmasi"></span></p>
                                                <p><strong>🔄 Status:</strong> <span id="detail-status"></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img id="detail-foto" src="" alt="Foto Paket" class="img-fluid rounded shadow" style="max-height: 300px; border: 3px solid #f4c430;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </table>
            
            <!-- Back Button dengan styling yang sama -->
            <div class="back-container">
                <h3><a href='../customer/home_customer.php' class="btn btn-success">🏠 Kembali ke Dashboard</a></h3>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.btn-edit').on('click', function() {
            $('#edit-id').val($(this).data('id'));
            $('#edit-nama').val($(this).data('nama'));
            $('#edit-detail').val($(this).data('detail'));
            $('#edit-tanggal').val($(this).data('tanggal'));
            $('#edit-fasilitas').val($(this).data('fasilitas'));
            $('#edit-harga').val($(this).data('harga'));
            $('#edit-durasi').val($(this).data('durasi'));
            $('#edit-konfirmasi').val($(this).data('konfirmasi'));
        });
    </script>
    </script>
    <script>
        $('.btn-detail').on('click', function() {
            $('#detail-nama').text($(this).data('nama'));
            $('#detail-fasilitas').text($(this).data('detail'));
            $('#detail-tanggal').text($(this).data('tanggal'));
            $('#detail-tambahan').text($(this).data('fasilitas'));
            $('#detail-harga').text($(this).data('harga'));
            $('#detail-durasi').text($(this).data('durasi'));
            $('#detail-konfirmasi').text($(this).data('konfirmasi'));
            $('#detail-status').text($(this).data('status'));
            $('#detail-foto').attr('src', $(this).data('foto'));
        });
    </script>

    <!-- FOOTER -->
    <?php include '../componen/footer.php'?>

    </body>
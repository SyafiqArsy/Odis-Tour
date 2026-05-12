<?php
include '../componen/auth_check.php';
isLoggedIn();
isCustomer();
requireCustomer();
?>

<!-- Koneksi database -->
<?php require('../componen/koneksi.php');

$keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);

// Query pencarian (gunakan kolom sesuai struktur tabel kamu)
$query = "SELECT * FROM paket_umroh
          WHERE nama_paket LIKE '%$keyword%' 
          OR detail_fasilitas LIKE '%$keyword%'";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Paket Umroh</title>
    <link rel="stylesheet" href="../componen/stylesinputpaket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        /* Search Container Styling */
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
        
        /* Result Header Styling */
        .result-header {
            background: linear-gradient(135deg, #b8860b 0%, #daa520 50%, #ffd700 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.3);
            border: 2px solid #f4c430;
        }
        
        .result-header h2 {
            color : white;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .result-count {
            font-size: 1.2em;
            margin-top: 15px;
            opacity: 0.95;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
        }
        
        /* No Results Styling */
        .no-results {
            text-align: center;
            padding: 80px 30px;
            background: linear-gradient(135deg, #fff8dc 0%, #ffeaa7 100%);
            border-radius: 15px;
            color: #8b4513;
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.2);
            border: 2px solid #f4c430;
        }
        
        .no-results i {
            font-size: 5em;
            margin-bottom: 25px;
            color: #daa520;
        }
        
        .no-results h4 {
            color: #b8860b;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        /* Back Button Styling */
        .back-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 15px 30px;
            background: linear-gradient(45deg, #b8860b, #daa520);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .back-btn:hover {
            background: linear-gradient(45deg, #daa520, #ffd700);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(184, 134, 11, 0.6);
            color: white;
            text-decoration: none;
        }
        
        /* Table Styling */
        .table-responsive {
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.2);
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid #f4c430;
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
        
        /* Highlight Styling */
        .highlight {
            background: linear-gradient(45deg, #ffd700, #ffb347);
            padding: 3px 6px;
            border-radius: 5px;
            font-weight: 700;
            color: #8b4513;
            border: 1px solid #daa520;
        }
        
        /* Button Styling */
        .btn-info {
            background: linear-gradient(45deg, #b8860b, #daa520);
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(184, 134, 11, 0.3);
        }
        
        .btn-info:hover {
            background: linear-gradient(45deg, #daa520, #ffd700);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(184, 134, 11, 0.5);
            color: white;
        }
        
        /* Badge Styling */
        .badge.bg-success {
            background: linear-gradient(45deg, #b8860b, #daa520) !important;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
        }
        
        .badge.bg-secondary {
            background: linear-gradient(45deg, #8b4513, #a0522d) !important;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
        }
        
        /* Modal Styling */
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
        
        /* Image Styling */
        .img-thumbnail {
            border: 3px solid #f4c430;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.3);
        }
        
        /* Container Styling */
        .form-container {
            background: linear-gradient(135deg, #fffacd 0%, #fff8dc 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Price Styling */
        .table td:nth-child(7) {
            font-weight: 700;
            color: #b8860b;
            font-size: 16px;
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
            
            .result-header {
                padding: 20px 15px;
            }
            
            .result-count {
                font-size: 1em;
                padding: 8px 15px;
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
    <!-- Search Bar -->
    <div class="search-container">
        <h4 class="search-title">🔍 Cari Paket Umroh</h4>
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="keyword" class="search-input" 
                   placeholder="Masukkan nama paket atau fasilitas yang dicari..." 
                   value="<?php echo htmlspecialchars($keyword); ?>" required>
            <button type="submit" class="search-btn">Cari Paket</button>
        </form>
    </div>

    <!-- Result Header -->
    <div class="result-header">
        <h2>📋 Hasil Pencarian</h2>
        <div class="result-count">
            Keyword: "<strong><?php echo htmlspecialchars($keyword); ?></strong>"
            <br>
            Ditemukan <?php echo mysqli_num_rows($result); ?> paket umroh
        </div>
    </div>

    <?php if (mysqli_num_rows($result) > 0): ?>
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
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): 
                        // Highlight keyword dalam hasil
                        $nama_paket = str_ireplace($keyword, '<span class="highlight">'.$keyword.'</span>', $row['nama_paket']);
                        $detail_fasilitas = str_ireplace($keyword, '<span class="highlight">'.$keyword.'</span>', $row['detail_fasilitas']);
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $nama_paket; ?></td>
                        <td><?php echo $detail_fasilitas; ?></td>
                        <td>
                            <?php
                            $foto_db = $row['foto_paket'];
                            if (strpos($foto_db, 'uploads/') === 0) {
                                $foto_path = __DIR__ . '/' . $foto_db;
                                $url_file = $foto_db;
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
                        <td><?php echo date('d/m/Y', strtotime($row['tgl_keberangkatan'])); ?></td>
                        <td><?php echo $row['fasilitas_tambahan']; ?></td>
                        <td><strong>Rp <?php echo number_format($row['harga_paket'], 0, ',', '.'); ?></strong></td>
                        <td><?php echo $row['durasi_Perjalanan']; ?></td>
                        <td>
                            <?php if($row['status'] == 'aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Non-aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-detail"
                                data-id="<?= $row['id_paket']; ?>"
                                data-nama="<?= htmlspecialchars($row['nama_paket']); ?>"
                                data-detail="<?= htmlspecialchars($row['detail_fasilitas']); ?>"
                                data-tanggal="<?= $row['tgl_keberangkatan']; ?>"
                                data-fasilitas="<?= htmlspecialchars($row['fasilitas_tambahan']); ?>"
                                data-harga="<?= $row['harga_paket']; ?>"
                                data-durasi="<?= htmlspecialchars($row['durasi_Perjalanan']); ?>"
                                data-konfirmasi="<?= $row['konfirmasi']; ?>"
                                data-status="<?= $row['status']; ?>"
                                data-foto="<?= $url_file ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="no-results">
            <div style="font-size: 4em; margin-bottom: 20px; color: #daa520;">🔍</div>
            <h4>Tidak ada hasil ditemukan</h4>
            <p>Maaf, tidak ada paket umroh yang sesuai dengan pencarian "<strong><?php echo htmlspecialchars($keyword); ?></strong>"</p>
            <p>Coba gunakan kata kunci yang berbeda atau lebih umum.</p>
        </div>
    <?php endif; ?>

    <!-- Modal Detail -->
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: linear-gradient(45deg, #8b4513, #a0522d); border: none;">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="inputan.php" class="back-btn">← Kembali ke Daftar Paket</a>
    </div>
</div>

<script>
    // Script untuk modal detail
    $('.btn-detail').on('click', function() {
        $('#detail-nama').text($(this).data('nama'));
        $('#detail-fasilitas').text($(this).data('detail'));
        
        // Format tanggal
        var tanggal = new Date($(this).data('tanggal'));
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        $('#detail-tanggal').text(tanggal.toLocaleDateString('id-ID', options));
        
        $('#detail-tambahan').text($(this).data('fasilitas'));
        
        // Format harga
        var harga = parseInt($(this).data('harga'));
        $('#detail-harga').text(harga.toLocaleString('id-ID'));
        
        $('#detail-durasi').text($(this).data('durasi'));
        $('#detail-konfirmasi').text($(this).data('konfirmasi'));
        
        // Status dengan badge
        var status = $(this).data('status');
        if(status == 'aktif') {
            $('#detail-status').html('<span class="badge bg-success">Aktif</span>');
        } else {
            $('#detail-status').html('<span class="badge bg-secondary">Non-aktif</span>');
        }
        
        $('#detail-foto').attr('src', $(this).data('foto'));
    });
    
    // Auto focus on search input
    $(document).ready(function() {
        $('.search-input').focus();
        
        // Add smooth scrolling
        $('html').css('scroll-behavior', 'smooth');
    });
</script>

    <!-- FOOTER -->
    <?php include '../componen/footer.php'?>

</body>
</html>
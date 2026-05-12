<?php
include '../componen/auth_check.php';
requireAdmin();

include '../componen/koneksi.php';

// Ambil semua data riwayat transaksi
$riwayat = $koneksi->query("
    SELECT rt.*, pu.nama_paket, c.nama_Cust 
    FROM riwayat_transaksi rt
    JOIN paket_umroh pu ON rt.id_paket = pu.id_paket
    JOIN customer c ON rt.id_customer = c.id_Cust
    ORDER BY rt.tanggal_pembayaran DESC
");

// Proses aksi konfirmasi/batalkan
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitasi input
    $action = $_GET['action'];
    
    // Ambil detail dari POST atau GET
    $detail = '';
    if (isset($_POST['detail'])) {
        $detail = $koneksi->real_escape_string($_POST['detail']);
    } elseif (isset($_GET['detail'])) {
        $detail = $koneksi->real_escape_string($_GET['detail']);
    }

    if ($action == 'confirm') {
        // Gabungkan detail lama dengan status konfirmasi
        $detail_baru = !empty($detail) ? $detail . " - Telah dikonfirmasi admin pada " . date('d-m-Y H:i:s') : "Telah dikonfirmasi admin pada " . date('d-m-Y H:i:s');
        
        $stmt = $koneksi->prepare("UPDATE riwayat_transaksi SET 
            status_pembayaran = 'pesanan diterima', 
            status = 'selesai',
            detail = ?
            WHERE id_riwayat_transaksi = ?");
        $stmt->bind_param("si", $detail_baru, $id);
        $stmt->execute();
    } elseif ($action == 'cancel') {
        // Gabungkan detail lama dengan status pembatalan
        $detail_baru = !empty($detail) ? $detail . " - Dibatalkan admin pada " . date('d-m-Y H:i:s') : "Dibatalkan admin pada " . date('d-m-Y H:i:s');
        
        $stmt = $koneksi->prepare("UPDATE riwayat_transaksi SET 
            status_pembayaran = 'pesanan dibatalkan', 
            status = 'selesai',
            detail = ?
            WHERE id_riwayat_transaksi = ?");
        $stmt->bind_param("si", $detail_baru, $id);
        $stmt->execute();
    }

    header("Location: admin_riwayat_transaksi.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== ADMIN RIWAYAT TRANSAKSI STYLES ===== */

        /* Custom Variables */
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --success-color: #27AE60;
            --warning-color: #F39C12;
            --danger-color: #E74C3C;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-color: #E9ECEF;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        /* Body & Layout */
        body {
            background: url('https://images.unsplash.com/photo-1564769625905-50e93615e769?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat fixed;
            background-color: #1a365d;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            position: relative;
        }

        /* Background Overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));
            z-index: -1;
            pointer-events: none;
        }

        /* Main Container */
        main {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        /* Form Container Enhancement */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            padding: 2.5rem;
            margin: 0 auto;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        /* Header Styling */
        .form-container h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }

        .form-container h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--success-color));
            border-radius: 2px;
        }

        /* Table Enhancements */
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .table {
            margin-bottom: 0;
            background: var(--white);
        }

        .table thead th {
            background: linear-gradient(135deg, #FFD700, #C2B280);
            color: var(--white);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem 0.75rem;
            vertical-align: middle;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border: none;
            font-size: 0.9rem;
        }

        /* Enhanced Badges */
        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #F39C12, #E67E22) !important;
            color: var(--white);
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #27AE60, #2ECC71) !important;
            color: var(--white);
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #E74C3C, #C0392B) !important;
            color: var(--white);
        }

        /* Button Enhancements */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.5rem 1rem;
            transition: var(--transition);
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #2ECC71);
            color: var(--white);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #2ECC71, var(--success-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #C0392B);
            color: var(--white);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #C0392B, var(--danger-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95A5A6, #7F8C8D);
            color: var(--white);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #7F8C8D, #95A5A6);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(149, 165, 166, 0.3);
        }

        /* Button Sizes */
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            margin: 0.2rem;
        }

        /* Modal Enhancements */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-header .modal-title {
            font-weight: 700;
            font-size: 1.2rem;
        }

        .modal-header .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .modal-body {
            padding: 2rem;
            background: var(--white);
        }

        .modal-footer {
            background: var(--light-bg);
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        /* Form Controls in Modal */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid var(--border-color);
            padding: 0.75rem;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            transform: translateY(-1px);
        }

        /* Empty State */
        .text-center td {
            padding: 3rem !important;
            color: var(--text-muted);
            font-style: italic;
            font-size: 1.1rem;
        }

        /* Responsive Enhancements */
        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .table {
                font-size: 0.8rem;
            }

            .table thead th {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
            }

            .table tbody td {
                padding: 0.75rem 0.5rem;
            }

            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.7rem;
                margin: 0.1rem;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.4rem 0.8rem;
            }
        }

        /* Action Column Styling */
        .table tbody td:last-child {
            text-align: center;
            white-space: nowrap;
        }

        /* Text Muted Enhancement */
        .text-muted {
            color: var(--text-muted) !important;
            font-style: italic;
        }

        /* Number Formatting */
        .table tbody td:nth-child(5) {
            font-weight: 600;
            color: var(--success-color);
        }

        /* Date Column */
        .table tbody td:nth-child(2) {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
        }

        /* Modal z-index fix */
        .modal {
            z-index: 1055 !important;
        }
        
        .modal-backdrop {
            z-index: 1050 !important;
        }

        /* Pastikan modal tidak tertutup oleh elemen lain */
        .modal-dialog {
            position: relative;
            z-index: 1060;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <?php include '../componen/navbar_admin.php' ?>

    <main style="flex: 1;">
        <section class="mt-5 mb-5">
            <div class="container">
                <div class="form-container" style="max-width: 1200px;">
                    <h2 class="text-center mb-4">Riwayat Transaksi Pelanggan</h2>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Paket Umroh</th>
                                    <th>Total Harga</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Pesanan</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($riwayat->num_rows > 0): ?>
                                    <?php $no = 1; ?>
                                    <?php while ($row = $riwayat->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_pembayaran'])) ?></td>
                                            <td><?= htmlspecialchars($row['nama_Cust']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_paket']) ?></td>
                                            <td>Rp <?= number_format($row['total_harga'], 0, ",", ".") ?></td>
                                            <td>
                                                <?php
                                                $badgeClass = '';
                                                if ($row['status_pembayaran'] == 'pending') $badgeClass = 'bg-warning';
                                                elseif ($row['status_pembayaran'] == 'pesanan diterima') $badgeClass = 'bg-success';
                                                else $badgeClass = 'bg-danger';
                                                ?>
                                                <span class="badge <?= $badgeClass ?>">
                                                    <?= ucfirst($row['status_pembayaran']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $badgeClass = '';
                                                if ($row['status'] == 'menunggu konfirmasi') $badgeClass = 'bg-warning';
                                                else $badgeClass = 'bg-success';
                                                ?>
                                                <span class="badge <?= $badgeClass ?>">
                                                    <?= ucfirst($row['status']) ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($row['detail']) ?></td>
                                            <td>
                                                <?php if ($row['status'] == 'menunggu konfirmasi'): ?>
                                                    <!-- Modal Konfirmasi -->
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $row['id_riwayat_transaksi'] ?>">
                                                        Konfirmasi
                                                    </button>

                                                    <!-- Modal Batalkan -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?= $row['id_riwayat_transaksi'] ?>">
                                                        Batalkan
                                                    </button>

                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada aksi</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada riwayat transaksi</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-4">
                        <a href="../admin/home_admin.php" class="btn btn-success">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modals - Dipindahkan ke luar container utama -->
    <?php
    $riwayat->data_seek(0); // reset pointer
    while ($row = $riwayat->fetch_assoc()):
    ?>
        <!-- Modal Structure for Confirm -->
        <div class="modal fade" id="confirmModal<?= $row['id_riwayat_transaksi'] ?>" tabindex="-1" aria-labelledby="confirmModalLabel<?= $row['id_riwayat_transaksi'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="?action=confirm&id=<?= $row['id_riwayat_transaksi'] ?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel<?= $row['id_riwayat_transaksi'] ?>">Konfirmasi Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Customer:</strong> <?= htmlspecialchars($row['nama_Cust']) ?></p>
                            <p><strong>Paket:</strong> <?= htmlspecialchars($row['nama_paket']) ?></p>
                            <p><strong>Total:</strong> Rp <?= number_format($row['total_harga'], 0, ",", ".") ?></p>
                            <hr>
                            <p>Apakah Anda yakin ingin mengkonfirmasi pesanan ini?</p>
                            <div class="mb-3">
                                <label for="detailConfirm<?= $row['id_riwayat_transaksi'] ?>" class="form-label">Detail/Keterangan:</label>
                                <textarea class="form-control" id="detailConfirm<?= $row['id_riwayat_transaksi'] ?>" name="detail" rows="3" placeholder="Masukkan detail konfirmasi..."><?= htmlspecialchars($row['detail']) ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Konfirmasi Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Structure for Cancel -->
        <div class="modal fade" id="cancelModal<?= $row['id_riwayat_transaksi'] ?>" tabindex="-1" aria-labelledby="cancelModalLabel<?= $row['id_riwayat_transaksi'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="?action=cancel&id=<?= $row['id_riwayat_transaksi'] ?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel<?= $row['id_riwayat_transaksi'] ?>">Batalkan Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Customer:</strong> <?= htmlspecialchars($row['nama_Cust']) ?></p>
                            <p><strong>Paket:</strong> <?= htmlspecialchars($row['nama_paket']) ?></p>
                            <p><strong>Total:</strong> Rp <?= number_format($row['total_harga'], 0, ",", ".") ?></p>
                            <hr>
                            <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                            <div class="mb-3">
                                <label for="detailCancel<?= $row['id_riwayat_transaksi'] ?>" class="form-label">Alasan Pembatalan:</label>
                                <textarea class="form-control" id="detailCancel<?= $row['id_riwayat_transaksi'] ?>" name="detail" rows="3" placeholder="Masukkan alasan pembatalan..." required><?= htmlspecialchars($row['detail']) ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- FOOTER -->
    <?php include '../componen/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Pastikan semua modal terinisialisasi dengan benar
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize semua modal
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                new bootstrap.Modal(modal);
            });

            // Debugging: log ketika modal dibuka
            modals.forEach(function(modal) {
                modal.addEventListener('show.bs.modal', function() {
                    console.log('Modal opened:', this.id);
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    console.log('Modal closed:', this.id);
                });
            });
        });
    </script>
</body>

</html>
<?php
// Fungsi untuk format ribuan dengan titik
function formatRibuan($angka) {
    return number_format($angka, 0, ',', '.');
}

// Cek apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari POST
    $paket_id = isset($_POST['paket_id']) ? (int)$_POST['paket_id'] : 0;
    $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
    $harga_paket = isset($_POST['harga_paket']) ? (int)$_POST['harga_paket'] : 0;
    
    // Validasi input
    if ($paket_id <= 0 || $jumlah <= 0 || $harga_paket <= 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak valid'
        ]);
        exit;
    }
    
    try {
        // Hitung total (nilai integer untuk perhitungan)
        $total = $harga_paket * $jumlah;
        
        // Format untuk tampilan
        $harga_formatted = formatRibuan($harga_paket);
        $total_formatted = formatRibuan($total);
        
        // Buat rincian
        $rincian = "Rp {$harga_formatted} × {$jumlah} paket";
        
        // Return response JSON
        echo json_encode([
            'success' => true,
            'total' => $total, // Nilai integer untuk JavaScript
            'total_formatted' => $total_formatted, // Nilai terformat untuk tampilan
            'rincian' => $rincian,
            'harga_satuan' => $harga_paket,
            'harga_satuan_formatted' => $harga_formatted
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Terjadi kesalahan dalam perhitungan'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Method tidak diizinkan'
    ]);
}
?>
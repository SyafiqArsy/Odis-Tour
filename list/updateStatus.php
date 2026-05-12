<?php
require('../componen/koneksi.php');

if (isset($_POST['id_paket']) && isset($_POST['status'])) {
    $id_paket = $_POST['id_paket'];
    $status = $_POST['status'];

    // Update status ke database
    $query = mysqli_query($koneksi, "UPDATE paket_umroh SET status='$status' WHERE id_paket='$id_paket'");

    if ($query) {
        header("Location: inputan.php");
        exit();
    } else {
        echo "Gagal mengubah status: " . mysqli_error($koneksi);
    }
} else {
    echo "Data tidak lengkap.";
}
?>

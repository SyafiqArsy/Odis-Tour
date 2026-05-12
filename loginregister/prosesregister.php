<?php
//mengaktifkan sesi
session_start();

$success = true;
$message = '';

// Mengecek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // PROSES PENDAFTARAN
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $domisili = $_POST['domisili'] ?? '';
    $email = $_POST['email'] ?? '';
    $pw = $_POST['first-password'];
    $confirmPassword = $_POST['confirm-password'] ?? '';

    // Pastikan password dan konfirmasi password cocok
    if ($pw === $confirmPassword) {
        // Koneksi ke database
        require('../componen/koneksi.php');
        
        // Cek apakah email sudah ada
        $checkEmail = mysqli_query($koneksi, "SELECT * FROM customer WHERE email = '$email'");
        
        if (mysqli_num_rows($checkEmail) > 0) {
            $message = "Email sudah terdaftar! Silakan gunakan email lain.";
            $success = false;
        } else {
            // Insert data user baru ke database (email sebagai username)
            $insertQuery = "INSERT INTO `customer` (`id_Cust`, `nama_Cust`, `email`, `pass_Cust`, `no_HP`, `domisili`, `konfirmasi_Pass`) VALUES (NULL, '$name', '$email', '$pw', '$phone', '$domisili', '$confirmPassword');";
            
            if (mysqli_query($koneksi, $insertQuery)) {
                $message = "Pendaftaran Berhasil! Silakan login dengan email dan password Anda.";
                $success = true;
            } else {
                $message = "Gagal mendaftar! Silakan coba lagi.";
                $success = false;
            }
        }
        
        mysqli_close($koneksi);
    } else {
        $message = "Password dan Konfirmasi Password tidak cocok!";
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesloginform.css">
</head>
<body>
<div class="form-container text-center">
    <h2><?php echo $success ? 'Pendaftaran Berhasil' : 'Pendaftaran Gagal'; ?></h2>

    <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?> text-dark">
        <?php echo nl2br(htmlspecialchars($message)); ?>
    </div>

    <?php if ($success): ?>
        <div class="text-start mt-3">
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($_POST['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_POST['email']); ?></p>
            <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($_POST['phone']); ?></p>
            <p><strong>Domisili:</strong> <?php echo htmlspecialchars($_POST['domisili']); ?></p>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mt-4 gap-2">
        <?php if ($success): ?>
            <a href="loginform.php" class="btn btn-success w-50">Login Sekarang</a>
            <a href="../loginregister/loginform.php" class="btn btn-success w-50">Kembali ke Home</a>
        <?php else: ?>
            <a href="registerform.php" class="btn btn-success w-50">Coba Daftar Lagi</a>
            <a href="../index.php" class="btn btn-success w-50">Kembali ke Home</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
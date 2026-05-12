<?php
include '../componen/koneksi.php';
session_start();

$success = false;
$message = '';
$redirectUrl = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $pw = $_POST['password'] ?? '';

    // Cek ke tabel customer
    $data = $koneksi->query("SELECT * FROM customer WHERE email = '$email' AND pass_Cust = '$pw'");
    
    if ($data && $data->num_rows === 1) {
        // Login customer berhasil
        $userData = mysqli_fetch_assoc($data);
        $_SESSION['namauser'] = $email;
        $_SESSION['nama'] = $userData['nama_Cust'];
        $_SESSION['role'] = 'customer';
        $_SESSION['id_Cust'] = $userData['Id_Cust'];
        $_SESSION['noHP'] = $userData['no_HP'];

        $message = "Login Berhasil! Selamat datang, " . $_SESSION['nama'];
        $success = true;
        $redirectUrl = "../customer/home_customer.php";
        
        setcookie("KunjunganTerakhir", date("G:i:s - m/d/Y"), time() + 10);

    } else {
        // Cek ke tabel admin
        $dataAdmin = $koneksi->query("SELECT * FROM admin WHERE usn_admin = '$email' AND pass_admin = '$pw'");
        
        if ($dataAdmin && $dataAdmin->num_rows === 1) {
            $adminData = mysqli_fetch_assoc($dataAdmin);
            $_SESSION['namauser'] = $email;
            $_SESSION['nama'] = $adminData['usn_admin'];
            $_SESSION['role'] = 'admin';
            $_SESSION['id_admin'] = $adminData['id_admin'] ?? null;

            $message = "Login Berhasil Sebagai Admin! Selamat Datang";
            $success = true;
            $redirectUrl = "../admin/home_admin.php";
        } else {
            $message = "Login gagal! Username atau password salah.";
        }
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Proses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesloginform.css">
    <?php if ($success): ?>
    <script>
        setTimeout(function() {
            window.location.href = '<?php echo $redirectUrl; ?>';
        }, 3000);
    </script>
    <?php endif; ?>
</head>
<body>
<div class="form-container text-center">
    <h2><?php echo $success ? 'Sukses' : 'Gagal'; ?></h2>

    <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?> text-dark">
        <?php echo nl2br(htmlspecialchars($message)); ?>
        <?php if ($success): ?>
            <br><small>Anda akan diarahkan otomatis dalam 3 detik...</small>
        <?php endif; ?>
    </div>

    <?php if ($success): ?>
        <div class="text-start mt-3">
            <p><strong>Nama Pengguna:</strong> <?php echo htmlspecialchars($_SESSION['nama']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['namauser']); ?></p>
            <p><strong>Role:</strong> <?php echo ucfirst(htmlspecialchars($_SESSION['role'])); ?></p>

            <?php if ($_SESSION['role'] === 'customer' && isset($_SESSION['id_Cust'])): ?>
                <p><strong>ID Customer:</strong> <?php echo htmlspecialchars($_SESSION['id_Cust']); ?></p>
            <?php elseif ($_SESSION['role'] === 'admin' && isset($_SESSION['id_admin'])): ?>
                <p><strong>ID Admin:</strong> <?php echo htmlspecialchars($_SESSION['id_admin']); ?></p>
            <?php endif; ?>

            <?php if (isset($_COOKIE['KunjunganTerakhir'])): ?>
                <p><strong>Kunjungan Terakhir:</strong> <?php echo htmlspecialchars($_COOKIE['KunjunganTerakhir']); ?></p>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-between mt-4 gap-2">
            <a href="<?php echo $redirectUrl; ?>" class="btn btn-success w-50">Masuk Sekarang</a>
            <a href="logout.php" class="btn btn-warning w-50">Logout</a>
        </div>
    <?php else: ?>
        <div class="d-flex justify-content-between mt-4 gap-2">
            <a href="../index.php" class="btn btn-success w-50">Kembali ke Home</a>
            <a href="loginform.php" class="btn btn-success w-50">Kembali ke Login</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

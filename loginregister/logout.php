<?php 
session_start(); 
unset($_SESSION['namauser']); 
unset($_SESSION['namalengkap']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesloginform.css">
</head>
<body>
<div class="form-container text-center">
    <h2>Logout Berhasil</h2>

    <div class="alert alert-success text-dark">
        Anda telah berhasil logout dari sistem.
    </div>

    <div class="d-flex justify-content-between mt-4 gap-2">
        <a href="../index.php" class="btn btn-success w-50">Kembali ke Home</a>
        <a href="loginform.php" class="btn btn-success w-50">Login Lagi</a>
    </div>
</div>
</body>
</html>
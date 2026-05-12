<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesloginform.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <section class="d-flex justify-content-center align-items-center" style="color: #B8860B; width: 500px; margin-top: 30px;">

    <div class="form-container">
        <h2 class="text-center">Daftar Akun</h2>
        <!-- Form action mengarah ke prosesregister.php untuk memproses data -->
        <form action="prosesregister.php" method="POST">
            
            <!-- Input untuk nama lengkap -->
            <div class="mb-2">
                <label for="name" class="form-label">Nama Lengkap:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Input untuk nomor HP -->
            <div class="mb-2">
                <label for="phone" class="form-label">Nomor HP:</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>

            <!-- Input untuk domisili -->
            <div class="mb-2">
                <label for="domisili" class="form-label">Domisili:</label>
                <input type="text" id="domisili" name="domisili" class="form-control" required>
            </div>

            <!-- Input untuk email -->
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Input untuk password -->
            <div class="mb-2">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="first-password" class="form-control" required>
            </div>

            <!-- Input untuk konfirmasi password -->
            <div class="mb-2">
                <label for="confirm-password" class="form-label">Konfirmasi Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
            </div>

            <!-- Tombol submit form -->
            <button type="submit" class="btn btn-success w-100">Daftar</button>

            <!-- Tautan untuk beralih ke halaman login -->
            <p class="text-center mt-3">
                <a class="text-light text-decoration-none" href="loginform.php">Sudah punya akun? Login</a>
            </p>

            <!-- Tautan untuk kembali ke halaman sebelumnya -->
            <p class="text-center">
                <a class="text-light text-decoration-none" href="../index.php">Kembali</a>
            </p>
        </form>
    </div>

    </section>

</body>
</html>
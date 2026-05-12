<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../componen/stylesloginform.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <section class="d-flex justify-content-center align-items-center" style="color: #B8860B; width: 500px; margin-top: 30px;">

    <div class="form-container">
        <h2 class="text-center">Login</h2>
        <!-- Form action mengarah ke proseslogin.php untuk memproses data -->
        <form action="proseslogin.php" method="POST">
            
            <!-- Input untuk email -->
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Input untuk password -->
            <div class="mb-2">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <!-- Tombol submit form -->
            <button type="submit" class="btn btn-success w-100">Login</button>

            <!-- Tautan untuk beralih ke halaman register -->
            <p class="text-center mt-3">
                <a class="text-light text-decoration-none" href="registerform.php">Belum punya akun? Daftar</a>
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
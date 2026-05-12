<?php
session_start();

// Fungsi untuk cek apakah user sudah login
function isLoggedIn() {
    return isset($_SESSION['namauser']);
}

// Fungsi untuk cek apakah user adalah admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Fungsi untuk cek apakah user adalah customer
function isCustomer() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'customer';
}

// Fungsi untuk redirect ke login jika tidak login
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../loginregister/loginform.php");
        exit();
    }
}

// Fungsi untuk redirect ke login jika tidak admin
function requireAdmin() {
    if (!isLoggedIn() || !isAdmin()) {
        header("Location: ../loginregister/loginform.php");
        exit();
    }
}

// Fungsi untuk redirect ke login jika tidak admin
function requireCustomer() {
    if (!isLoggedIn() || !isCustomer()) {
        header("Location: ../loginregister/loginform.php");
        exit();
    }
}

?>
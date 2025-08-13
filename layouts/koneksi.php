<?php
// Data koneksi
$host     = "localhost";
$user     = "root";
$password = "";
$database = "lily_bakery";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Alias variabel $koneksi sebagai $conn agar kompatibel di semua file
$conn = $koneksi;
?>

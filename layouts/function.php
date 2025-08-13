<?php

$koneksi = mysqli_connect("localhost","root","","lily_bakery");

// Fungsi untuk registrasi
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows [] = $row;
    }
    return $rows;
} 

function registrasi($data): int {
    global $koneksi;

    // Escape input dari form untuk mencegah SQL Injection
    $nama_lengkap = $data['nama_lengkap'];
    $email = strtolower(stripcslashes($data['email']));
    $username = $data['username'];
    $password = mysqli_real_escape_string($koneksi, $data['passw']); // Ubah 'password' menjadi 'passw'

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Jalankan query
    mysqli_query($koneksi, "INSERT INTO register (nama_lengkap, email, username, password) VALUES ('$nama_lengkap', '$email', '$username', '$password')"); // Perbaikan sintaks

    return mysqli_affected_rows($koneksi); // Ubah 'mysqli_affected_row' menjadi 'mysqli_affected_rows'
}

// Fungsi login
function login($data) {
    global $koneksi;

    $username = $data['username'];
    $password = $data['password'];

    // Cek apakah username ada di database
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // Ambil data user
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Password benar, login berhasil
            $_SESSION['login'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            // Password salah
            return "Password salah!";
        }
    } else {
        // Username tidak ditemukan
        return "Username tidak ditemukan!";
    }
}

// Fungsi untuk menambah produk
function produk($data) {
    global $koneksi;
    // $id_kategori = htmlspecialchars($data['id_kategori']);
    $gambar = htmlspecialchars($data['gambar']);
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);
    $rating = htmlspecialchars($data['rating']);
   


    $query = "INSERT INTO barang (gambar, nama, harga,rating, ) VALUES ('$gambar','$nama', '$harga','$rating' )";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk mengambil data produk berdasarkan ID
function getProdukById($id) {
    global $koneksi;
    return query("SELECT * FROM barang WHERE id = $id")[0]; // Ambil satu produk berdasarkan ID
}

// Fungsi untuk mengedit produk
function editProduk($data) {
    global $koneksi;

    $id = $data['id'];
    // $id_kategori = htmlspecialchars($data['id_kategori']);
    $gambar = htmlspecialchars($data['gambar']);
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);
    $rating = htmlspecialchars($data['rating']);


    $query = "UPDATE barang SET  gambar ='$gambar', nama = '$nama', harga = '$harga', rating = '$rating' WHERE id = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus produk
function hapusProduk($id) {
    global $koneksi;

    $query = "DELETE FROM barang WHERE id = $id";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

?>
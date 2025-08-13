<?php
include "koneksi.php";
session_start();

// Ambil data dari AJAX
$id         = $_POST['id'] ?? '';
$nama       = $_POST['nama_produk'] ?? '';
$kategori   = $_POST['kategori'] ?? '';
$deskripsi  = $_POST['deskripsi'] ?? '';
$harga      = $_POST['harga'] ?? '';
$gambar     = $_POST['gambar'] ?? '';

if ($id && $nama) {
    // Cek apakah sudah ada di keranjang
    $cek = $koneksi->query("SELECT * FROM keranjang WHERE id_produk='$id' LIMIT 1");
    if ($cek->num_rows > 0) {
        // Sudah ada → bisa update qty kalau mau
        echo "Produk sudah ada di keranjang.";
    } else {
        $koneksi->query("INSERT INTO keranjang (id_produk,nama_produk,kategori,deskripsi,harga,gambar) 
        VALUES ('$id','$nama','$kategori','$deskripsi','$harga','$gambar')");
        echo "Produk berhasil dimasukkan ke keranjang!";
    }
} else {
    echo "Data produk tidak lengkap!";
}

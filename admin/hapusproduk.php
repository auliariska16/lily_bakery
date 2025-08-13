<?php
include "../layouts/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data produk dari database
    $query = "DELETE FROM produk WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Tampilkan notifikasi dan redirect
        echo "<script>
                alert('Produk Berhasil Dihapus!');
                window.location.href = '../admin/admin.php';
              </script>";
        exit();
    } else {
        echo "Gagal Menghapus Produk: " . mysqli_error($conn);
    }
} else {
    echo "ID Produk Tidak Ditemukan.";
}
?>

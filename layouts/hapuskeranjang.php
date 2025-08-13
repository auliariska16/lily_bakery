<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id='$id'");
}

header('Location: keranjang.php');
exit;
?>

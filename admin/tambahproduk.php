<?php
include "../layouts/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_produk'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga'];
  $url_gambar = $_POST['url_gambar'];
  $kategori = $_POST['kategori'];

  $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, deskripsi, harga, url_gambar, kategori) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssiss", $nama, $deskripsi, $harga, $url_gambar, $kategori);

  if ($stmt->execute()) {
    echo "<script>alert('Produk berhasil ditambahkan'); window.location.href='admin.php';</script>";
  } else {
    echo "Gagal: " . $koneksi->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../admin/tambahproduk.css" />
</head>
<body>
  <div class="form-container">
    <h2>Tambah Produk</h2>
    <form method="POST">
      <label>Nama Produk:</label>
      <input type="text" name="nama_produk" required>

      <label>Deskripsi:</label>
      <textarea name="deskripsi" required oninput="autoResize(this)"></textarea>

      <label>Harga:</label>
      <input type="number" name="harga" required>

      <label>URL Gambar:</label>
      <input type="file" name="url_gambar" required>

      <label>Kategori:</label>
      <select name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Mini Cake">Mini Cake</option>
        <option value="Slice Cake">Slice Cake</option>
        <option value="Tart">Tart</option>
        <option value="Toast">Toast</option>
        <option value="Danish">Danish</option>
        <option value="Pudding">Pudding</option>
      </select>

      <button type="submit">Tambah Produk</button>
    </form>
  </div>

  <script>
    function autoResize(textarea) {
      textarea.style.height = 'auto';
      textarea.style.height = (textarea.scrollHeight) + 'px';
    }
  </script>
</body>
</html>

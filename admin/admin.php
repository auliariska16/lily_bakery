<?php 
  include "../layouts/koneksi.php";

  // Ambil nama file saat ini untuk menandai menu aktif
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Toko Roti</title>
  <link rel="stylesheet" href="../admin/admin.css" />
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Lily Bakery</h2>
    <a href="dashboard.php" class="<?= $current_page == 'profile.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="profile.php" class="<?= $current_page == 'profile.php' ? 'active' : '' ?>">Profile Admin</a>
    <a href="pesanan.php" class="<?= $current_page == 'pesanan.php' ? 'active' : '' ?>">Pesanan</a>
    <a href="admin.php" class="<?= $current_page == 'admin.php' ? 'active' : '' ?>">Daftar Produk</a>
    <a href="logout.php" class="<?= $current_page == 'logout.php' ? 'active' : '' ?>">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Daftar Produk</h1>

    <table>
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = "SELECT * FROM produk ORDER BY id DESC";
          $result = mysqli_query($koneksi, $query);

          if (!$result) {
            echo "<tr><td colspan='6'>Gagal mengambil data: " . mysqli_error($koneksi) . "</td></tr>";
          } else {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
                <td><img src='" . htmlspecialchars($row['url_gambar']) . "' alt='" . htmlspecialchars($row['nama_produk']) . "' class='product-img'></td>
                <td>" . htmlspecialchars($row['nama_produk']) . "</td>
                <td>" . htmlspecialchars($row['deskripsi']) . "</td>
                <td>" . htmlspecialchars($row['kategori']) . "</td>
                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>
                  <a href='edit.php?id=" . urlencode($row['id']) . "'><button class='edit'>Edit</button></a>
                  <a href='hapusproduk.php?id=" . urlencode($row['id']) . "' onclick='return confirm(\"Yakin Ingin Menghapus Produk?\");'><button class='delete'>Delete</button></a>
                </td>
              </tr>";
            }
          }
        ?>
      </tbody>
    </table>

    <div>
      <a href="tambahproduk.php"><button class="add-btn">Add Product</button></a>
    </div>
  </div>

</body>
</html>

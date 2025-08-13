<?php 
  include "../layouts/koneksi.php";
  $current_page = basename($_SERVER['PHP_SELF']);

  // Ambil jumlah produk, pesanan, dan admin
  $jumlah_produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM produk"))['total'];
  $jumlah_pesanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pesanan"))['total'];
  $jumlah_admin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM regist WHERE role = 'admin'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | Lily Bakery</title>
  <link rel="stylesheet" href="../admin/dashboard.css" />
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Lily Bakery</h2>
    <a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="dataadmin.php" class="<?= $current_page == 'profile.php' ? 'active' : '' ?>">Data Admin</a>
    <a href="pesanan.php" class="<?= $current_page == 'pesanan.php' ? 'active' : '' ?>">Pesanan</a>
    <a href="admin.php" class="<?= $current_page == 'admin.php' ? 'active' : '' ?>">Daftar Produk</a>
    <a href="logout.php" class="<?= $current_page == 'logout.php' ? 'active' : '' ?>">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Dashboard</h1>

    <div class="dashboard-cards">
      <div class="card produk-card">
        <h3><?= $jumlah_produk ?></h3>
        <p>Jumlah Produk</p>
      </div>
      <div class="card pesanan-card">
        <h3><?= $jumlah_pesanan ?></h3>
        <p>Total Pesanan</p>
      </div>
      <div class="card admin-card">
        <h3><?= $jumlah_admin ?></h3>
        <p>Admin Terdaftar</p>
      </div>
    </div>
  </div>

</body>
</html>

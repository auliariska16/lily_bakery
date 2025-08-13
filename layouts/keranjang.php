<?php
include 'koneksi.php';

// Ambil semua item dari tabel keranjang
$sql = "SELECT * FROM keranjang";
$result = mysqli_query($koneksi, $sql);

// Hitung total
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lily Bakery and Cake</title>
  <link rel="stylesheet" href="../style/keranjang.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br />
      BAKERY AND CAKE
    </div>
    <nav>
      <a href="index.php">HOME</a>
      <a href="produk.php">PRODUK</a>
      <a href="#">
        <img src="../image/dashboard 1/profile.png" alt="User" class="user-icon" />
      </a>
    </nav>
  </header>

  <main class="cart-container">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php $total += $row['harga'] * $row['quantity']; ?>
      <div class="cart-item">
        <img src="<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>" />
        <div class="item-details">
          <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
          <p><?= htmlspecialchars($row['kategori']); ?></p>
          <p><?= htmlspecialchars($row['deskripsi']); ?></p>
          <p class="price">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></p>
        </div>
        <div class="remove">
          <a href="hapus-keranjang.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus item ini?');">🗑️ Hapus</a>
        </div>
        <div class="order-total">
          <span>Order totals</span>
          <span>Rp. <?= number_format($row['harga'] * $row['quantity'], 0, ',', '.'); ?></span>
        </div>
        <div class="quantity-badge">x<?= $row['quantity']; ?></div>
      </div>
    <?php endwhile; ?>
  </main>

  <footer>
    <div class="payment-info">
      <span>Total Payment</span>
      <strong>Rp. <?= number_format($total, 0, ',', '.'); ?></strong>
    </div>
    <button>Check Out</button>
  </footer>
</body>
</html>

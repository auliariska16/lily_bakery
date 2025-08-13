<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=profile.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = mysqli_query($koneksi, "SELECT * FROM regist WHERE id='$user_id'");
$user = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Profile - Lily Bakery</title>
  <link rel="stylesheet" href="../style/profile.css">
</head>
<body>
  <header>
    <div class="logo">LILY <span>BAKERY AND CAKE</span></div>
    <nav>
      <a href="dashboard1.php">HOME</a>
      <a href="minicake.php">PRODUK</a>
      <a href="profile.php">PROFILE</a>
    </nav>
  </header>

  <main>
    <section class="profile-card">
      <h2>Welcome, <?= htmlspecialchars($user['nama'] ?? $_SESSION['email']) ?>!</h2>
      <p class="subtitle">Review and update your profile information below</p>

      <form>
        <div class="input-group">
          <label>Nama</label>
          <input type="text" value="<?= htmlspecialchars($user['nama'] ?? '') ?>" readonly>
        </div>
        <div class="input-group">
          <label>Email</label>
          <input type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
        </div>
        <div class="input-group">
          <label>Phone Number</label>
          <input type="tel" value="<?= htmlspecialchars($user['no_hp'] ?? '') ?>" readonly>
        </div>

        <div class="actions">
          <a href="logout.php" class="btn danger">Log Out</a>
        </div>
      </form>
    </section>
  </main>
</body>
</html>

<?php 
session_start(); // WAJIB kalau ingin pakai $_SESSION
include "koneksi.php";
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'profile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lily Bakery and Cake</title>
  <link rel="stylesheet" href="../style/dashboard1.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br/>
      BAKERY AND CAKE
    </div>
    <nav>
      <a href="dashboard1.php">HOME</a>
      <a href="minicake.php">PRODUK</a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php">PROFILE</a>
      <?php else: ?>
        <a href="login.php?redirect=dashboard1.php">PROFILE</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-image">
      <img src="../image/dashboard 1/1.png" alt="landing page" />
    </div>
    <div class="hero-text">
      <h1>
        <div class="heading-line">TODAY SPECIAL</div>
        <div class="heading-line">BAKED FOR YOU</div>
      </h1>
      <p>
        Dibuat dengan bahan pilihan dan resep turun temurun,<br>
        roti kami hadir setiap hari untuk menemani momen<br>
        spesial Anda.
      </p>
    </div>
  </section>

  <!-- Products -->
  <section class="products">
    <h2>----- Our Products</h2>
    <p>Indulge yourself with our premium bread and dessert</p>

    <div class="product-grid">
      <a href="minicake.php" class="product-item">
        <img src="../image/minicake/1.jpg" alt="Mini Cake" />
        <span>MINI CAKE</span>
      </a>
      <a href="slicecake.php" class="product-item">
        <img src="../image/slicecake/1.png" alt="Slice Cake" />
        <span>SLICE CAKE</span>
      </a>
      <a href="tart.php" class="product-item">
        <img src="../image/tart/1.jpg" alt="Tart" />
        <span>TART</span>
      </a>
      <a href="toast.php" class="product-item">
        <img src="../image/toast/1.jpg" alt="Toast" />
        <span>TOAST</span>
      </a>
      <a href="danish.php" class="product-item">
        <img src="../image/danish/1.jpg" alt="Danish" />
        <span>DANISH</span>
      </a>
      <a href="pudding.php" class="product-item">
        <img src="../image/pudding/1.jpg" alt="Pudding" />
        <span>PUDING</span>
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-column">
      <h3><strong>LILY</strong><br />BAKERY AND CAKE</h3>
      <p>
        LILY is a new Japanese-inspired bakery and pastry<br />
        shop serving amazing handmade breads, cakes and<br />
        puddings.
      </p>
      <div class="social-icons">
        <a href="#"><img src="../image/dashboard 1/wa.jpg" alt="WhatsApp" /></a>
        <a href="#"><img src="../image/dashboard 1/instagram.jpg" alt="Instagram" /></a>
        <a href="#"><img src="../image/dashboard 1/twitter.jpg" alt="Twitter" /></a>
        <a href="#"><img src="../image/dashboard 1/facebook.jpg" alt="Facebook" /></a>
      </div>
    </div>

    <div class="footer-column">
      <h4>Other</h4>
      <ul>
        <li><a href="#">Terms and Conditions</a></li>
        <li><a href="#">Policy and Privacy</a></li>
        <li><a href="#">Help</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>About</h4>
      <ul>
        <li><a href="#">Lily Bakery</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Our Shop</a></li>
        <li><a href="#">Cooperation</a></li>
      </ul>
    </div>
  </footer>

</body>
</html>

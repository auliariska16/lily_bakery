<?php 
  include "koneksi.php";
  session_start();

  // Ambil semua produk dengan kategori 'slice cake'
  $query = "SELECT * FROM produk WHERE kategori = 'slice cake'";
  $result = mysqli_query($koneksi, $query);

  $produk = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $produk[] = $row;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lily | Slice Cake</title>
  <link rel="stylesheet" href="../style/productpage.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br />BAKERY AND CAKE
    </div>
    <nav>
      <a href="dashboard1.php">HOME</a>
      <a href="minicake.php">PRODUK</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="layouts/profile.php">PROFILE</a>
      <?php else: ?>
        <a href="login.php?redirect=layouts/profile.php">PROFILE</a>
      <?php endif; ?>
    </nav>
  </header>

  <!-- Product Section -->
  <div class="container">
    <h2>------ Our Products</h2>

    <!-- kategori -->
    <div class="tabs">
      <a href="minicake.php" class="tab">MINI CAKE</a>
      <a href="slicecake.php" class="tab active-tab">SLICE CAKE</a>
      <a href="tart.php" class="tab">TART</a>
      <a href="toast.php" class="tab">TOAST</a>
      <a href="danish.php" class="tab">DANISH</a>
      <a href="pudding.php" class="tab">PUDDING</a>
    </div>

    <div class="products">
      <?php foreach ($produk as $item): ?>
        <div class="product-card" 
             data-title="<?= htmlspecialchars($item['nama_produk']) ?>" 
             data-desc="<?= htmlspecialchars($item['deskripsi']) ?>" 
             data-price="<?= number_format($item['harga'], 0, ',', '.') ?>" 
             data-img="<?= $item['url_gambar'] ?>">
          <img src="../image/slicecake/<?= $item['url_gambar'] ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>">
          <div class="product-name"><?= htmlspecialchars($item['nama_produk']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- pop up -->
  <div id="productModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="modal-body-v2">
        <div class="modal-left">
          <img id="modal-img" src="" alt="Product Image" />
        </div>
        <div class="modal-right">
          <p class="modal-category">Slice Cake</p>
          <h2 id="modal-title">Judul Produk</h2>
          <p id="modal-description">Deskripsi produk...</p>
          <p class="modal-price">
            <span class="currency">Rp </span>
            <span class="amount" id="modal-price">0</span>
          </p>
          <div class="price-buttons">
            <button class="modal-btn">Cart</button>
            <button class="modal-btn">Buy</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- js -->
  <script>
    const modal = document.getElementById("productModal");
    const modalImg = document.getElementById("modal-img");
    const modalTitle = document.getElementById("modal-title");
    const modalDesc = document.getElementById("modal-description");
    const modalPrice = document.getElementById("modal-price");
    const closeModal = document.querySelector(".close");

    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach(card => {
      card.addEventListener("click", () => {
        modalTitle.textContent = card.getAttribute("data-title");
        modalDesc.textContent = card.getAttribute("data-desc");
        modalPrice.textContent = card.getAttribute("data-price");
    
        // FIX path gambar
        modalImg.src = "../image/slicecake/" + card.getAttribute("data-img");

        modal.style.display = "block";
      });
    });


    closeModal.onclick = () => modal.style.display = "none";
    window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; };
  </script>

  <!--footer-->
  <footer class="footer">
    <div class="footer-column">
      <h3><strong>LILY</strong><br />BAKERY AND CAKE</h3>
      <p>LILY is a new Japanese-inspired bakery and pastry<br />
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

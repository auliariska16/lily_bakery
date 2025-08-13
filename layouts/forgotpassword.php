<?php
  session_start();
  include "koneksi.php";

  $info = "";
  $error = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = mysqli_real_escape_string($koneksi, $_POST['email']);

      $query = "SELECT * FROM login WHERE email = '$email'";
      $result = mysqli_query($koneksi, $query);

      if (mysqli_num_rows($result) > 0) {
          $info = "Link untuk reset password telah dikirim ke email kamu. (simulasi)";
      } else {
          $error = "Email tidak ditemukan dalam sistem kami.";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password - Lily Bakery</title>
  <link rel="stylesheet" href="../style/forgotpassword.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br />
      BAKERY AND CAKE
    </div>
  </header>

  <main class="forgot-container">
    <div class="forgot-box">
      <div class="form-section">
        <h1>Forgot Your Password?</h1>
        <p class="subtitle">Enter your email below and we’ll send you a link to reset it.</p>

        <?php if ($error): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if ($info): ?>
          <p class="info"><?= htmlspecialchars($info) ?></p>
        <?php endif; ?>

        <form method="POST">
          <input type="email" name="email" id="emailInput" placeholder="Your Email" required>
          <p class="back-login">Remembered it? <a href="login.php">Back to Login</a></p>
          <button type="submit" id="resetBtn" disabled>Send Reset Link</button>
        </form>
      </div>

      <div class="image-section">
        <img src="../image/login page/cake.png" alt="Cake Image" />
      </div>
    </div>
  </main>

  <script>
    const emailInput = document.getElementById('emailInput');
    const resetBtn = document.getElementById('resetBtn');

    emailInput.addEventListener('input', () => {
      if (emailInput.value.trim() !== "") {
        resetBtn.disabled = false;
        resetBtn.classList.add('active');
      } else {
        resetBtn.disabled = true;
        resetBtn.classList.remove('active');
      } 
    });
  </script>
</body>
</html>

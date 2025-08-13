<?php
session_start();
include "koneksi.php";

$error = "";
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard1.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM regist WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: ../admin/admin.php");
            } else {
                header("Location: $redirect");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lily | Login</title>
  <link rel="stylesheet" href="../style/login.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br />
      BAKERY AND CAKE
    </div>
    <nav>
      <a href="dashboard1.php">HOME</a>
      <a href="minicake.php">PRODUK</a>
    </nav>
  </header>

  <main class="login-section">
    <div class="login-card">
      <div class="left-side">
        <h1>Welcome Back!</h1>
        <p class="subtitle">Please log in to continue</p>

        <?php if ($error): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php?redirect=<?= urlencode($redirect) ?>">
          <input type="email" name="email" id="email" placeholder="Email" required>
          <input type="password" name="password" id="password" placeholder="Password" required>
  
          <p class="forgot">
            Forgot Password?
            <a href="forgotpassword.php">Click here</a>
          </p>

          <div class="button-wrapper">
            <button type="submit" id="loginBtn" class="login-button" disabled>Login</button>
          </div>
        </form>

        <p class="signup">Don’t have an account? <a href="regis.php">Create an account</a></p>
      </div>

      <div class="right-side">
        <img src="../image/loginpage/cake.png" alt="Cake Image">
      </div>
    </div>
  </main>
  <script>
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginBtn = document.getElementById('loginBtn');

    function checkInputs() {
      const emailFilled = emailInput.value.trim() !== "";
      const passwordFilled = passwordInput.value.trim() !== "";
      if (emailFilled && passwordFilled) {
        loginBtn.disabled = false;
        loginBtn.classList.add('active');
      } else {
        loginBtn.disabled = true;
        loginBtn.classList.remove('active');
      }
    }

    emailInput.addEventListener('input', checkInputs);
    passwordInput.addEventListener('input', checkInputs);
  </script>
</body>
</html>

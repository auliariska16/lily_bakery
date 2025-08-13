<?php
include "koneksi.php";

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama       = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email      = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp      = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat     = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $password   = $_POST['password'];
    $konfirmasi = $_POST['confirm_password'];

    if ($password !== $konfirmasi) {
        $pesan = "Password dan konfirmasi tidak sama.";
    } else {
        // Cek apakah email sudah ada
        $cek = mysqli_query($koneksi, "SELECT * FROM regist WHERE email = '$email'");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = "Email sudah terdaftar. Silakan gunakan email lain atau login.";
        } else {
            // Enkripsi password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data user baru sebagai customer (tanpa input role dari user)
            $query = "INSERT INTO regist (nama, email, no_hp, alamat, password, role)
                      VALUES ('$nama', '$email', '$no_hp', '$alamat', '$hashed', 'customer')";

            if (mysqli_query($koneksi, $query)) {
                header("Location: login.php");
                exit;
            } else {
                $pesan = "Registrasi gagal: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lily | Register</title>
  <link rel="stylesheet" href="../style/regist.css" />
</head>
<body>
  <header class="top-bar">
    <div class="logo">
      <strong>LILY</strong><br />
      BAKERY AND CAKE
    </div>
  </header>

  <main class="register-container">
    <div class="register-box">
      <h1>Complete Your Data</h1>

      <?php if ($pesan): ?>
        <p style="color:red;"><?= htmlspecialchars($pesan) ?></p>
      <?php endif; ?>

      <form class="form-vertical" method="POST">
        <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="nama" id="nama" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="no_hp">Phone Number</label>
            <input type="tel" name="no_hp" id="no_hp" required>
        </div>

        <div class="form-group">
            <label for="alamat">Address</label>
            <input type="text" name="alamat" id="alamat" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        
        <p class="login-link">Already have an account? <a href="login.php">Log in</a></p>
    
        <div class="button-box">
            <button type="submit" id="registBtn" disabled>Register</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    const inputs = document.querySelectorAll('form input[required]');
    const registBtn = document.getElementById('registBtn');

    function checkAllFilled() {
      let allFilled = true;

      inputs.forEach(input => {
        if (input.value.trim() === "") {
          allFilled = false;
        }
      });

      registBtn.disabled = !allFilled;
      registBtn.classList.toggle('active', allFilled);
    }

    inputs.forEach(input => {
      input.addEventListener('input', checkAllFilled);
    });

    document.querySelector('form').addEventListener('submit', function(e) {
      const pass = document.getElementById('password').value;
      const confirm = document.getElementById('confirm_password').value;

      if (pass !== confirm) {
        e.preventDefault();
        alert('Password dan Konfirmasi harus sama!');
      }
    });
  </script>
</body>
</html>

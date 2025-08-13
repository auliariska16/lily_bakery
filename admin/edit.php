<?php
include '../layouts/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if (!$produk) {
    echo "Produk tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];

    // Cek apakah user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $gambarBaru = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // Tentukan folder tujuan berdasarkan kategori
        $folderTujuan = "../image/" . $kategori;

        // Buat folder jika belum ada
        if (!is_dir($folderTujuan)) {
            mkdir($folderTujuan, 0777, true);
        }

        // Simpan file ke folder tujuan
        $pathGambar = "image/" . $kategori . "/" . $gambarBaru;
        move_uploaded_file($tmp, "../" . $pathGambar);
    } else {
        // Pakai gambar lama
        $pathGambar = $produk['url_gambar'];
    }

    // Update database
    $update = "UPDATE produk SET nama_produk=?, harga=?, deskripsi=?, kategori=?, url_gambar=? WHERE id=?";
    $stmt = $koneksi->prepare($update);
    $stmt->bind_param("sisssi", $nama, $harga, $deskripsi, $kategori, $pathGambar, $id);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../admin/edit.css">
</head>
<body>
    <div class="card-container">
        <h2>Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data">
            <p>
                <input type="text" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>
            </p>
            <p>
                <input type="number" name="harga" value="<?= htmlspecialchars($produk['harga']); ?>" required>
            </p>
            <p>
                <textarea name="deskripsi" required><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
            </p>
            <p>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Mini Cake" <?= $produk['kategori'] == 'Mini Cake' ? 'selected' : '' ?>>Mini Cake</option>
                    <option value="Slice Cake" <?= $produk['kategori'] == 'Slice Cake' ? 'selected' : '' ?>>Slice Cake</option>
                    <option value="Tart" <?= $produk['kategori'] == 'Tart' ? 'selected' : '' ?>>Tart</option>
                    <option value="Toast" <?= $produk['kategori'] == 'Toast' ? 'selected' : '' ?>>Toast</option>
                    <option value="Danish" <?= $produk['kategori'] == 'Danish' ? 'selected' : '' ?>>Danish</option>
                    <option value="Pudding" <?= $produk['kategori'] == 'Pudding' ? 'selected' : '' ?>>Pudding</option>
                </select>
            </p>
            <p>
                Gambar saat ini:<br>
                <img src="../<?= htmlspecialchars($produk['url_gambar']); ?>" width="100"><br><br>
                Upload gambar baru (opsional):<br>
                <input type="file" name="gambar">
            </p>
            <p>
                <button class="add-btn" type="submit">Simpan Perubahan</button>
            </p>
        </form>
    </div>
</body>
</html>

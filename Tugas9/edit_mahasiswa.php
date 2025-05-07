<?php
include 'connection.php';

$old_npm = $_GET['npm'];
$result = $conn->query("SELECT * FROM mahasiswa WHERE npm='$old_npm'");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("UPDATE mahasiswa SET npm=?, nama=?, jurusan=?, alamat=? WHERE npm=?");
    $stmt->bind_param("sssss", $new_npm, $nama, $jurusan, $alamat, $old_npm);
    $stmt->execute();

    header("Location: mahasiswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container main-page">
    <div class="card">
        <h2>Edit Data Mahasiswa</h2>
        <form method="POST">
            <div class="form-group">
                <label for="npm">NPM</label>
                <input type="text" id="npm" name="npm" value="<?= $data['npm'] ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select id="jurusan" name="jurusan" required>
                    <option value="Teknik Informatika" <?= $data['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= $data['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" required><?= $data['alamat'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="mahasiswa.php" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>

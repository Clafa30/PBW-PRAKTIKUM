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

    header("Location: index.php");
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
<div class="container">
    <h2>Edit Mahasiswa</h2>
    <form method="POST">
        <input type="hidden" name="old_npm" value="<?= $data['npm'] ?>">

        <label>NPM</label>
        <input type="text" name="npm" value="<?= $data['npm'] ?>" required>

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Jurusan</label>
        <select name="jurusan" required>
            <option value="Teknik Informatika" <?= $data['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
            <option value="Sistem Informasi" <?= $data['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" required><?= $data['alamat'] ?></textarea>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>

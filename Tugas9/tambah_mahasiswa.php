<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("INSERT INTO mahasiswa (npm, nama, jurusan, alamat) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $npm, $nama, $jurusan, $alamat);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Mahasiswa</h2>
    <form method="POST">
        <label>NPM</label>
        <input type="text" name="npm" required>

        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Jurusan</label>
        <select name="jurusan" required>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <button type="submit" class="btn">Simpan</button>
    </form>
</div>
</body>
</html>

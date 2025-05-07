<?php
include 'connection.php';
$kodemk = $_GET['kodemk'];
$data = $conn->query("SELECT * FROM matakuliah WHERE kodemk = '$kodemk'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodemk_new = $_POST['kodemk'];
    $nama = $_POST['nama'];
    $jumlah_sks = $_POST['jumlah_sks'];

    if ($jumlah_sks < 1 || $jumlah_sks > 6) {
        echo "<script>alert('Jumlah SKS harus antara 1 sampai 6'); window.history.back();</script>";
        exit;
    }

    $conn->query("UPDATE matakuliah SET kodemk='$kodemk_new', nama='$nama', jumlah_sks='$jumlah_sks' WHERE kodemk='$kodemk'");
    header("Location: matakuliah.php");
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
        <h2>Edit Mata Kuliah</h2>
        <form method="POST">
            <div class="form-group">
                <label for="kodemk">Kode MK</label>
                <input type="text" id="kodemk" name="kodemk" value="<?= $data['kodemk'] ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Mata Kuliah</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
            </div>

            <div class="form-group">
                <label for="sks">Jumlah SKS</label>
                <input type="number" name="jumlah_sks" value="<?= $data['jumlah_sks'] ?>" required>
                <p style="color: red; font-style: italic; font-size: 13px;">Minimal 1 - 6 SKS</p>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="matakuliah.php" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
<?php
include "connection.php";

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM krs WHERE id = '$id'")->fetch_assoc();
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
$matakuliah = $conn->query("SELECT * FROM matakuliah");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $npm = $_POST['mahasiswa_npm'];
    $kodemk = $_POST['matakuliah_kodemk'];

    $conn->query("UPDATE krs SET mahasiswa_npm='$npm', matakuliah_kodemk='$kodemk' WHERE id='$id'");
    header("Location: krs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit KRS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container main-page">
    <div class="card">
        <h2>Edit KRS</h2>
        <form method="POST">
            <div class="form-group">
                <label for="mahasiswa_npm">Mahasiswa</label>
                <select name="mahasiswa_npm" id="mahasiswa_npm" required>
                    <?php while($m = $mahasiswa->fetch_assoc()): ?>
                        <option value="<?= $m['npm'] ?>" <?= ($m['npm'] == $data['mahasiswa_npm']) ? 'selected' : '' ?>>
                            <?= $m['nama'] ?> (<?= $m['npm'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="matakuliah_kodemk">Mata Kuliah</label>
                <select name="matakuliah_kodemk" id="matakuliah_kodemk" required>
                    <?php while($mk = $matakuliah->fetch_assoc()): ?>
                        <option value="<?= $mk['kodemk'] ?>" <?= ($mk['kodemk'] == $data['matakuliah_kodemk']) ? 'selected' : '' ?>>
                            <?= $mk['nama'] ?> (<?= $mk['kodemk'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="krs.php" class="btn btn-secondary" style="margin-left: 10px;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>

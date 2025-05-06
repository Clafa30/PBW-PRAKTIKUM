<?php
include "connection.php";

// Ambil data
$matakuliah = $conn->query("SELECT * FROM matakuliah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mata Kuliah</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>
<body>
    <div class="container">
        <header class="matkul">
            <h1>Manajemen Mata Kuliah</h1>
            <div class="navigation">
                <a href="mahasiswa.php" class="btn btn-primary">Manajemen Mahasiswa</a>
                <a href="matakuliah.php" class="btn btn-primary">Manajemen Mata Kuliah</a>
                <a href="krs.php" class="btn btn-primary">Manajemen KRS</a>
            </div>               
        </header>

        <div class="card">
            <h2>Tambah Mata Kuliah</h2>
            <form method="POST" action="tambah_matakuliah.php">
                <div class="form-group">
                    <label for="kodemk">Kode MK</label>
                    <input type="text" id="kodemk" name="kodemk" placeholder="Masukkan Kode MK" required>
                </div>
                <div class="form-group">
                    <label for="nama_mk">Nama Mata Kuliah</label>
                    <input type="text" id="nama_mk" name="nama" placeholder="Masukkan Nama Mata Kuliah" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_sks">Jumlah SKS</label>
                    <input type="number" id="jumlah_sks" name="jumlah_sks" placeholder="Masukkan Jumlah SKS" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah MK</button>
            </form>
        </div>

        <div class="card">
            <h2>Data Mata Kuliah</h2>
            <table>
                <thead>
                    <tr><th>Kode</th><th>Nama</th><th>SKS</th></tr>
                </thead>
                <tbody>
                    <?php while($mk = $matakuliah->fetch_assoc()): ?>
                        <tr>
                            <td><?= $mk['kodemk'] ?></td>
                            <td><?= $mk['nama'] ?></td>
                            <td><?= $mk['jumlah_sks'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
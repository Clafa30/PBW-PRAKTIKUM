<?php
include "connection.php";

// Ambil data
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>
<body>
    <div class="container">
        <header class="mhs">
            <h1>Manajemen Mahasiswa</h1>
            <div class="navigation">
                <a href="mahasiswa.php" class="btn btn-primary">Manajemen Mahasiswa</a>
                <a href="matakuliah.php" class="btn btn-primary">Manajemen Mata Kuliah</a>
                <a href="krs.php" class="btn btn-primary">Manajemen KRS</a>
            </div>    
        </header>

        <div class="card">
            <h2>Tambah Mahasiswa</h2>
            <form method="POST" action="tambah_mahasiswa.php">
                <div class="form-group">
                    <label for="npm">NPM</label>
                    <input type="text" id="npm" name="npm" placeholder="Masukkan NPM" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select id="jurusan" name="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Masukkan Alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <div class="card">
            <h2>Data Mahasiswa</h2>
            <table>
                <thead>
                    <tr><th>NPM</th><th>Nama</th><th>Jurusan</th><th>Alamat</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php while($m = $mahasiswa->fetch_assoc()): ?>
                        <tr>
                            <td><?= $m['npm'] ?></td>
                            <td><?= $m['nama'] ?></td>
                            <td><?= $m['jurusan'] ?></td>
                            <td><?= $m['alamat'] ?></td>
                            <td class="actions">
                                <a href="edit_mahasiswa.php?npm=<?= $m['npm'] ?>" class="btn btn-success">Edit</a>
                                <a href="hapus_mahasiswa.php?npm=<?= $m['npm'] ?>" class="btn btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
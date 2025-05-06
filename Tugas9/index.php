<?php
include "connection.php";
$result = $conn->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Data Mahasiswa</h1>
            <div class="form-section">
                <form method="POST" action="tambah_mahasiswa.php">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" name="npm" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select name="jurusan" required>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding-bottom: 10px;">
                        <label>Alamat</label>
                        <textarea name="alamat" required></textarea>
                    </div>
                    <button type="submit" style="background-color : green; color: white;">Simpan</button>
                </form>
            </div>

        <table>
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM mahasiswa");
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['npm']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['jurusan']}</td>
                        <td>{$row['alamat']}</td>
                        <td class='actions'>
                            <a class='btn btn-success' href='edit_mahasiswa.php?npm={$row['npm']}'>
                                <i class='fas fa-edit'></i> Edit
                            </a>
                            <a class='btn btn-danger' href='hapus_mahasiswa.php?npm={$row['npm']}' onclick='return confirm(\"Yakin?\")'>
                                <i class='fas fa-trash-alt'></i> Hapus
                            </a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

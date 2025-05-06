<?php
include "connection.php";

// Ambil data
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
$matakuliah = $conn->query("SELECT * FROM matakuliah");
$krs = $conn->query("SELECT krs.id, mhs.nama AS nama_mhs, mk.nama AS nama_mk, mk.jumlah_sks
                     FROM krs 
                     JOIN mahasiswa mhs ON krs.mahasiswa_npm = mhs.npm 
                     JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen KRS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>
<body>
    <div class="container">
        <header class="krs">
            <h1>Manajemen KRS</h1>
            <div class="navigation">
                <a href="mahasiswa.php" class="btn btn-primary">Manajemen Mahasiswa</a>
                <a href="matakuliah.php" class="btn btn-primary">Manajemen Mata Kuliah</a>
                <a href="krs.php" class="btn btn-primary">Manajemen KRS</a>
            </div>    
        </header>

        <div class="card">
            <h2>Tambah KRS</h2>
            <form method="POST" action="tambah_krs.php">
                <div class="form-group">
                    <label for="mahasiswa_npm">Mahasiswa</label>
                    <select id="mahasiswa_npm" name="mahasiswa_npm" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php
                        $mahasiswa->data_seek(0);
                        while($m = $mahasiswa->fetch_assoc()):
                        ?>
                            <option value="<?= $m['npm'] ?>"><?= $m['nama'] ?> (<?= $m['npm'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="matakuliah_kodemk">Mata Kuliah</label>
                    <select id="matakuliah_kodemk" name="matakuliah_kodemk" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php
                        $matakuliah->data_seek(0);
                        while($mk = $matakuliah->fetch_assoc()):
                        ?>
                            <option value="<?= $mk['kodemk'] ?>"><?= $mk['nama'] ?> (<?= $mk['kodemk'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah KRS</button>
            </form>
        </div>

        <div class="card">
            <h2>Data KRS</h2>
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari berdasarkan nama mahasiswa...">
            </div>
            <table id="krsTable">
                <thead>
                    <tr><th>ID</th><th>Mahasiswa</th><th>Mata Kuliah</th><th>Jumlah SKS</th></tr>
                </thead>
                <tbody>
                    <?php 
                    $krs->data_seek(0); // Reset pointer for table
                    while($k = $krs->fetch_assoc()): 
                    ?>
                        <tr>
                            <td><?= $k['id'] ?></td>
                            <td><?= $k['nama_mhs'] ?></td>
                            <td><?= $k['nama_mk'] ?></td>
                            <td><?= $k['jumlah_sks'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>Keterangan KRS</h2>
            <ul class="krs-description">
                <?php 
                $krs->data_seek(0); // Reset pointer for description
                while($k = $krs->fetch_assoc()): 
                ?>
                    <li><?= $k['nama_mhs'] ?> mengambil matakuliah <?= $k['nama_mk'] ?> (<?= $k['jumlah_sks'] ?> SKS)</li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <script>
        // Filter table based on search input
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#krsTable tbody tr');

            rows.forEach(row => {
                const namaMhs = row.cells[1].textContent.toLowerCase();
                row.style.display = namaMhs.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
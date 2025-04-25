<?php
$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

ksort($bandara_asal);
ksort($bandara_tujuan);

$hasil = [];
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maskapai = trim(filter_input(INPUT_POST, 'maskapai', FILTER_SANITIZE_STRING));
    $asal = $_POST['asal'] ?? '';
    $tujuan = $_POST['tujuan'] ?? '';
    $harga_tiket = (int) ($_POST['harga'] ?? 0);

    if (!preg_match("/^[a-zA-Z\s]+$/", $maskapai)) {
        $error = "Nama maskapai hanya boleh huruf dan spasi.";
    } elseif ($harga_tiket <= 0) {
        $error = "Harga tiket harus lebih dari 0.";
    } elseif ($asal === $tujuan) {
        $error = "Bandara asal dan tujuan tidak boleh sama.";
    } else {
        $pajak_asal = $bandara_asal[$asal] ?? 0;
        $pajak_tujuan = $bandara_tujuan[$tujuan] ?? 0;

        $total_pajak = $pajak_asal + $pajak_tujuan;
        $total_harga = $harga_tiket + $total_pajak;

        $hasil = [
            'nomor' => rand(1000,9999),
            'tanggal' => date("Y-m-d H:i:s"),
            'maskapai' => $maskapai,
            'asal' => $asal,
            'tujuan' => $tujuan,
            'harga_tiket' => $harga_tiket,
            'pajak_asal' => $pajak_asal,
            'pajak_tujuan' => $pajak_tujuan,
            'total_pajak' => $total_pajak,
            'total_harga' => $total_harga
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Penerbangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }
        .form-card {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px 40px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .form-card h3, .form-card h4 {
            font-weight: 600;
            color: #333;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
            background-color: #4a90e2;
            border: none;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 5px;
            color: #4a4a4a;
        }
        .highlight {
            color: #4a90e2;
            font-weight: 600;
        }
        .result-box {
            background: #fafafa;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }
        .alert {
            border-radius: 10px;
        }
        .icon{
            height: 45px;
            width: 45px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-card">
        <h3 class="text-center mb-4">✈️ Daftar Rute Penerbangan</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Maskapai</label>
                <input type="text" name="maskapai" class="form-control" required pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi">
            </div>

            <div class="mb-3">
                <label class="form-label">Bandara Asal</label>
                <select name="asal" class="form-select" required>
                    <?php foreach ($bandara_asal as $nama => $pajak): ?>
                        <option value="<?= $nama ?>"><?= $nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bandara Tujuan</label>
                <select name="tujuan" class="form-select" required>
                    <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
                        <option value="<?= $nama ?>"><?= $nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Harga Tiket (Rp)</label>
                <input type="text" name="harga" class="form-control" required pattern="[0-9]+" title="Masukkan angka saja">
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Rute</button>
        </form>
    </div>

    <?php if (!empty($hasil)): ?>
    <div class="form-card mt-4">
        <h4 class="text-center mb-4">
            <img class="icon" src="https://img.icons8.com/?size=100&id=103095&format=png&color=000000">
            Detail Rute Penerbangan
        </h4>
        <div class="result-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title">🛫 Info Penerbangan</div>
                    <p><strong>Nomor:</strong> <?= $hasil['nomor'] ?></p>
                    <p><strong>Tanggal:</strong> <?= $hasil['tanggal'] ?></p>
                    <p><strong>Maskapai:</strong> <?= htmlspecialchars($hasil['maskapai']) ?></p>
                    <p><strong>Asal:</strong> <?= $hasil['asal'] ?></p>
                    <p><strong>Tujuan:</strong> <?= $hasil['tujuan'] ?></p>
                </div>
                <div class="col-md-6">
                    <div class="section-title">💰 Rincian Harga</div>
                    <p><strong>Tiket:</strong> Rp<?= number_format($hasil['harga_tiket'], 0, ',', '.') ?></p>
                    <p><strong>Pajak Asal:</strong> Rp<?= number_format($hasil['pajak_asal'], 0, ',', '.') ?></p>
                    <p><strong>Pajak Tujuan:</strong> Rp<?= number_format($hasil['pajak_tujuan'], 0, ',', '.') ?></p>
                    <p><strong>Total Pajak:</strong> Rp<?= number_format($hasil['total_pajak'], 0, ',', '.') ?></p>
                    <p class="highlight"><strong>Total Bayar:</strong> Rp<?= number_format($hasil['total_harga'], 0, ',', '.') ?></p>
                </div>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-outline-secondary" onclick="window.location.href=window.location.href">🔄 Bersihkan & Kembali</button>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

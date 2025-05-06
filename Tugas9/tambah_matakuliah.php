<?php
include "connection.php";

$kodemk = $_POST['kodemk'];
$nama = $_POST['nama'];
$jumlah_sks = $_POST['jumlah_sks'];

$sql = "INSERT INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk', '$nama', $jumlah_sks)";
if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>

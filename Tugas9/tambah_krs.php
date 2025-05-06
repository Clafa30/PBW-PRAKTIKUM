<?php
include "connection.php";

$npm = $_POST['mahasiswa_npm'];
$kodemk = $_POST['matakuliah_kodemk'];

$sql = "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')";
if ($conn->query($sql)) {
    header("Location: krs.php");
} else {
    echo "Error: " . $conn->error;
}
?>

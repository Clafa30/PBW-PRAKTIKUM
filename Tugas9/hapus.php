<?php
include 'connection.php';
$npm = $_GET['npm'];
$conn->query("DELETE FROM mahasiswa WHERE npm='$npm'");
header("Location: mahasiswa.php");
exit;

// logic hapus krs
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM krs WHERE id = '$id'");
}

header("Location: krs.php");
exit;
?>

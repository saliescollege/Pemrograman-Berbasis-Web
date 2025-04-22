<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}

$id = $_GET['id'];

$update = mysqli_query($conn, "UPDATE krs SET keterangan = 'Data dihapus' WHERE id = '$id'");

$delete = mysqli_query($conn, "DELETE FROM krs WHERE id = '$id'");

if ($delete) {
    echo "<script>alert('Data KRS berhasil dihapus.'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "'); window.location='index.php';</script>";
}
?>
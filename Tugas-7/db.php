<?php
$conn = mysqli_connect("localhost", "root", "", "kuliah");

if (!$conn) {
    die("Koneksi gagal: ". mysqli_connect_error());
}
?>
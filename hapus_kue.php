<?php
require 'cek_session.php';
include 'koneksi.php';

$id = $_GET['id'];

// Ambil nama foto untuk dihapus dari folder
$result = mysqli_query($conn, "SELECT foto FROM kue WHERE id = $id");
$row = mysqli_fetch_assoc($result);
unlink("uploads/" . $row['foto']);

// Hapus data dari database
mysqli_query($conn, "DELETE FROM kue WHERE id = $id");

echo "<script>alert('Data Terhapus!'); window.location='dashboard.php';</script>";
?>
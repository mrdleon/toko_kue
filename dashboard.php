<?php
require 'cek_session.php';
include 'koneksi.php';

$kues = mysqli_query($conn, "SELECT * FROM kue ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Toko Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Katalog Kue</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($kues)) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="uploads/<?= $row['foto']; ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Foto Kue">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nama']; ?></h5>
                        <p class="card-text mb-1">Harga: Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text mb-3">Stok: <?= $row['stok']; ?></p>
                        <a href="edit_kue.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_kue.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <a href="tambah_kue.php" class="btn btn-primary mt-3">Tambah Kue</a>
    </div>
</body>
</html>
<?php
require 'cek_session.php';
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // Upload Foto
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoExt = pathinfo($fotoName, PATHINFO_EXTENSION);
    $fotoNew = uniqid() . "." . $fotoExt; // Generate nama unik
    
    move_uploaded_file($fotoTmp, 'uploads/' . $fotoNew);

    $query = "INSERT INTO kue (nama, harga, stok, foto) VALUES ('$nama', '$harga', '$stok', '$fotoNew')";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data Berhasil Ditambahkan!'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow p-4" style="width: 500px;">
            <h4>Tambah Kue</h4>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Kue</label>
                    <input type="text" name="nama" class="form-control" required placeholder="Contoh: Kue Lumpur">
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required placeholder="12000">
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required placeholder="25">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
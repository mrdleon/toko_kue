<?php
require 'cek_session.php';
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kue WHERE id = $id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $fotoLama = $_POST['fotoLama'];

    // Cek apakah user upload foto baru
    if ($_FILES['foto']['error'] === 4) {
        $fotoNew = $fotoLama;
    } else {
        $fotoName = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoExt = pathinfo($fotoName, PATHINFO_EXTENSION);
        $fotoNew = uniqid() . "." . $fotoExt;
        
        // Hapus foto lama
        unlink('uploads/' . $fotoLama);
        move_uploaded_file($fotoTmp, 'uploads/' . $fotoNew);
    }

    $query = "UPDATE kue SET nama='$nama', harga='$harga', stok='$stok', foto='$fotoNew' WHERE id=$id";
    mysqli_query($conn, $query);
    
    echo "<script>alert('Data Berhasil Diubah!'); window.location='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow p-4" style="width: 500px;">
            <h4>Edit Kue</h4>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fotoLama" value="<?= $row['foto']; ?>">
                
                <div class="mb-3 text-center">
                    <label class="d-block">Foto Lama:</label>
                    <img src="uploads/<?= $row['foto']; ?>" width="100" class="rounded">
                </div>

                <div class="mb-3">
                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nama Kue</label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-warning">Simpan Perubahan</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
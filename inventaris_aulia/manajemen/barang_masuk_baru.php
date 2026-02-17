<?php
ob_start();
include "../koneksi.php";
include "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = $_POST['barang_id'];

    $result = mysqli_query($koneksi, "SELECT barang_nama, barang_jumlah FROM barang WHERE barang_id = '$barang_id'");
    $row = mysqli_fetch_assoc($result);
    $barang_nama = $row['barang_nama'];
    $stok = $row['barang_jumlah'];

    $tanggal_masuk = $_POST['bm_tgl_masuk'];
    $jumlah = $_POST['bm_jumlah'];
    $suplier_id = $_POST['suplier_id'];

    $suplier_result = mysqli_query($koneksi, "SELECT suplier_nama FROM suplier WHERE suplier_id = '$suplier_id'");
    $suplier_row = mysqli_fetch_assoc($suplier_result);
    $suplier_nama = $suplier_row['suplier_nama'];

    $query = "INSERT INTO barang_masuk 
        (bm_id_barang, bm_nama_barang, bm_tgl_masuk, bm_jumlah, bm_id_suplier, bm_nama_suplier) 
        VALUES 
        ('$barang_id', '$barang_nama', '$tanggal_masuk', '$jumlah', '$suplier_id', '$suplier_nama')";

        if (mysqli_query($koneksi, $query)) {
            $updateStok = "UPDATE barang SET barang_jumlah = barang_jumlah + $jumlah WHERE barang_id = '$barang_id'";
            mysqli_query($koneksi, $updateStok);

            header("Location: barang_masuk.php");
            exit;
        } else {
            echo "Gagal menambahkan data barang masuk: " . mysqli_error($koneksi);
        }

}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 10px;
        }
        .card-header-custom {
            background-color: var(--primary-color) !important;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .btn-primary {
            background-color: var(--secondary-color) !important;
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--primary-color) !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="content-wrapper p-4">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header card-header-custom">
                        <h4><i class="fas fa-plus-circle"></i> Tambah Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php
                                    $data = mysqli_query($koneksi, "select * from barang");
                                    while ($row = mysqli_fetch_array($data)) {
                                    ?>
                                        <option value="<?php echo $row['barang_id']; ?>"><?php echo $row['barang_nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" name="bm_tgl_masuk" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="bm_jumlah" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Supplier</label>
                                <select name="suplier_id" class="form-control" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    <?php
                                    $suplier_data = mysqli_query($koneksi, "SELECT * FROM suplier");
                                    while ($suplier = mysqli_fetch_array($suplier_data)) {
                                    ?>
                                        <option value="<?php echo $suplier['suplier_id']; ?>"><?php echo $suplier['suplier_nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a href="barang_masuk.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

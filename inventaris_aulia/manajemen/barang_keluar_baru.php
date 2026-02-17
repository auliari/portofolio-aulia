<?php
ob_start();
include "../koneksi.php";
include "header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = $_POST['barang_id'];

    // Ambil nama barang dari tabel barang berdasarkan ID
    $result = mysqli_query($koneksi, "SELECT barang_nama, barang_jumlah FROM barang WHERE barang_id = '$barang_id'");
    $row = mysqli_fetch_assoc($result);
    $barang_nama = $row['barang_nama'];
    $stok = $row['barang_jumlah'];

    $tanggal_keluar = $_POST['bk_tgl_keluar'];
    $jumlah = $_POST['bk_jumlah_keluar'];
    $lokasi = $_POST['bk_lokasi'];
    $penerima = $_POST['bk_penerima'];
    $keterangan = $_POST['bk_keterangan'];

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    if ($stok < $jumlah) {
        echo "<script>alert('Stok tidak cukup!');</script>";
    } else {
        // Insert ke tabel barang_keluar
        $query = "INSERT INTO barang_keluar 
        (bk_id_barang, bk_nama_barang, bk_tgl_keluar, bk_jumlah_keluar, bk_lokasi, bk_penerima, bk_keterangan) 
        VALUES 
        ('$barang_id', '$barang_nama', '$tanggal_keluar', '$jumlah', '$lokasi', '$penerima', '$keterangan')";

        if (mysqli_query($koneksi, $query)) {
            // Kurangi stok barang
            $updateStok = "UPDATE barang SET barang_jumlah = barang_jumlah - $jumlah WHERE barang_id = '$barang_id'";
            mysqli_query($koneksi, $updateStok);

            header("Location: barang_keluar.php");
            exit;
        } else {
            echo "Gagal menambahkan data barang keluar: " . mysqli_error($koneksi);
        }
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang Keluar</title>
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
            background-color:var(--primary-color) !important;
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
                        <h4><i class="fas fa-plus-circle"></i> Tambah Barang keluar</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php
                            $data = mysqli_query($koneksi,"select * from barang");
                            while($row=mysqli_fetch_array($data)){
                                ?>
                                <option value="<?php echo $row['barang_id']; ?>"
                                ><?php echo $row['barang_nama']; ?></option>

                                <?php
                            }
                            ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Keluar</label>
                                <input type="date" name="bk_tgl_keluar" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="bk_jumlah_keluar" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="bk_lokasi" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penerima</label>
                                <input type="text" name="bk_penerima" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" name="bk_keterangan" class="form-control" required>
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

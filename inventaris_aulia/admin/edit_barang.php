<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

$id = isset($_GET['barang_id']) ? $_GET['barang_id'] : "";

if (!empty($id)) {
    $query = "SELECT * FROM barang WHERE barang_id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['barang_nama'];
    $spesifikasi = $_POST['barang_spesifikasi'];
    $lokasi = $_POST['barang_lokasi'];
    $kondisi = $_POST['barang_kondisi'];
    $jumlah = $_POST['barang_jumlah'];
    $sumber_dana = $_POST['barang_sumber_dana'];
    $jenis = $_POST['barang_jenis'];
    $keterangan = $_POST['barang_keterangan'];

    $query_update = "UPDATE barang SET 
                     barang_nama='$nama', 
                     barang_spesifikasi='$spesifikasi', 
                     barang_lokasi='$lokasi', 
                     barang_kondisi='$kondisi', 
                     barang_jumlah='$jumlah', 
                     barang_sumber_dana='$sumber_dana', 
                     barang_jenis='$jenis', 
                     barang_keterangan='$keterangan'
                     WHERE barang_id='$id'";

    if (mysqli_query($koneksi, $query_update)) {
        header("Location: data_barang.php"); 
        exit;
    } else {
        echo "Gagal memperbarui data";
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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
        .form-label {
            font-weight: bold;
        }
        .card-header-custom {
            background-color: var(--primary-color) !important;
            color: white; 
            font-weight: bold;
            text-align: center;
        }
        .btn-primary {
            background-color: var(--secondary-color) !important;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            width: 100%; 
        }

        .btn-primary:hover {
            background-color:var(--primary-color) !important;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="content-wrapper p-4">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-header card-header-custom text-white text-center">
                            <h4><i class="fas fa-edit"></i> Edit Barang</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="barang_nama" class="form-control" value="<?php echo htmlspecialchars($data['barang_nama']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Spesifikasi</label>
                                    <input type="text" name="barang_spesifikasi" class="form-control" value="<?php echo htmlspecialchars($data['barang_spesifikasi']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" name="barang_lokasi" class="form-control" value="<?php echo htmlspecialchars($data['barang_lokasi']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kondisi</label>
                                    <input type="text" name="barang_kondisi" class="form-control" value="<?php echo htmlspecialchars($data['barang_kondisi']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="barang_jumlah" class="form-control" value="<?php echo htmlspecialchars($data['barang_jumlah']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sumber Dana</label>
                                    <input type="text" name="barang_sumber_dana" class="form-control" value="<?php echo htmlspecialchars($data['barang_sumber_dana']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis</label>
                                    <input type="text" name="barang_jenis" class="form-control" value="<?php echo htmlspecialchars($data['barang_jenis']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="barang_keterangan" class="form-control" rows="3"><?php echo htmlspecialchars($data['barang_keterangan']); ?></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                    <a href="data_barang.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
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

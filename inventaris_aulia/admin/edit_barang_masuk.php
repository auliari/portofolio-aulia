<?php 
include "../koneksi.php";  

if (!isset($_GET['bm_id'])) {     
    echo "ID barang masuk tidak ditemukan!";
    exit; 
}

$bm_id = $_GET['bm_id'];
$query = "SELECT * FROM barang_masuk WHERE bm_id = '$bm_id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Simpan nilai lama untuk referensi perubahan stok
$old_barang_id = $data['bm_id_barang'];
$old_jumlah   = $data['bm_jumlah'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
    $barang_id      = $_POST['barang_id'];     
    $tanggal_masuk  = $_POST['bm_tgl_masuk'];     
    $jumlah         = $_POST['bm_jumlah'];     
    $suplier_id     = $_POST['suplier_id'];
    
    // Ambil nama barang dan suplier sesuai ID yang dipilih  
    $barang_result = mysqli_query($koneksi, "SELECT barang_nama FROM barang WHERE barang_id = '$barang_id'");
    $barang_row    = mysqli_fetch_assoc($barang_result);
    $barang_nama   = $barang_row['barang_nama'];
    
    $suplier_result = mysqli_query($koneksi, "SELECT suplier_nama FROM suplier WHERE suplier_id = '$suplier_id'");
    $suplier_row    = mysqli_fetch_assoc($suplier_result);
    $suplier_nama   = $suplier_row['suplier_nama'];
    
    // Mulai transaksi
    mysqli_begin_transaction($koneksi);
    
    // Update tabel barang_masuk
    $update = "UPDATE barang_masuk SET 
                    bm_id_barang   = '$barang_id',
                    bm_nama_barang = '$barang_nama',
                    bm_tgl_masuk   = '$tanggal_masuk',
                    bm_jumlah      = '$jumlah',
                    bm_id_suplier  = '$suplier_id',
                    bm_nama_suplier= '$suplier_nama'
               WHERE bm_id = '$bm_id'";
    
    $query1 = mysqli_query($koneksi, $update);
    
    if ($query1) {
        // Jika barang yang dipilih sama dengan data sebelumnya
        if ($old_barang_id == $barang_id) {
            // Hitung selisih jumlah (delta) 
            $delta = $jumlah - $old_jumlah;
            $updateBarang = "UPDATE barang SET barang_jumlah = barang_jumlah + ($delta) WHERE barang_id = '$barang_id'";
            $query2 = mysqli_query($koneksi, $updateBarang);
            if (!$query2) {
                mysqli_rollback($koneksi);
                echo "Gagal update stok barang: " . mysqli_error($koneksi);
                exit;
            }
        } else {
            // Jika barang yang dipilih berbeda,
            // kembalikan stok barang lama dengan mengurangkan jumlah lama,
            // kemudian tambahkan stok pada barang baru dengan jumlah baru.
            $updateOldBarang = "UPDATE barang SET barang_jumlah = barang_jumlah - ($old_jumlah) WHERE barang_id = '$old_barang_id'";
            $queryOld = mysqli_query($koneksi, $updateOldBarang);
            if (!$queryOld) {
                mysqli_rollback($koneksi);
                echo "Gagal mengupdate stok barang lama: " . mysqli_error($koneksi);
                exit;
            }
            
            $updateNewBarang = "UPDATE barang SET barang_jumlah = barang_jumlah + ($jumlah) WHERE barang_id = '$barang_id'";
            $queryNew = mysqli_query($koneksi, $updateNewBarang);
            if (!$queryNew) {
                mysqli_rollback($koneksi);
                echo "Gagal mengupdate stok barang baru: " . mysqli_error($koneksi);
                exit;
            }
        }
        
        // Commit jika semua query berhasil
        mysqli_commit($koneksi);
        header("Location: barang_masuk.php");
        exit;
    } else {
        mysqli_rollback($koneksi);
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
}

include "header.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .card-header-custom {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-primary {
            background-color: var(--secondary-color) !important;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: var(--primary-color) !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="content-wrapper p-4">
        <div class="container mt-4">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-header card-header-custom text-white text-center">
                        <h4><i class="fas fa-edit"></i> Edit Barang</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <select name="barang_id" class="form-control" required>
                                    <?php
                                    $barang_data = mysqli_query($koneksi, "SELECT * FROM barang");
                                    while ($barang = mysqli_fetch_assoc($barang_data)) {
                                        $selected = ($barang['barang_id'] == $data['bm_id_barang']) ? 'selected' : '';
                                        echo "<option value='{$barang['barang_id']}' $selected>{$barang['barang_nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" name="bm_tgl_masuk" class="form-control" value="<?= $data['bm_tgl_masuk'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="bm_jumlah" class="form-control" value="<?= $data['bm_jumlah'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Suplier</label>
                                <select name="suplier_id" class="form-control" required>
                                    <?php
                                    $suplier_data = mysqli_query($koneksi, "SELECT * FROM suplier");
                                    while ($suplier = mysqli_fetch_assoc($suplier_data)) {
                                        $selected = ($suplier['suplier_id'] == $data['bm_id_suplier']) ? 'selected' : '';
                                        echo "<option value='{$suplier['suplier_id']}' $selected>{$suplier['suplier_nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn-primary">Update</button>
                                <a href="barang_masuk.php" class="btn btn-secondary mt-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

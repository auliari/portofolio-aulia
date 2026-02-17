<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

$id = isset($_GET['pinjam_id']) ? $_GET['pinjam_id'] : "";

if (!empty($id)) {
    $query = "SELECT * FROM pinjam WHERE pinjam_id='$id'";
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
    $peminjam = $_POST['pinjam_peminjam'];
    $barang_id_baru = $_POST['pinjam_barang'];
    $jumlah_baru = $_POST['pinjam_jumlah'];
    $kondisi = $_POST['pinjam_kondisi'];
    $tgl_pinjam = $_POST['pinjam_tgl_pinjam'];
    $tgl_kembali = $_POST['pinjam_tgl_kembali'];
    $status = $_POST['pinjam_status'];

    $barang_id_lama = $data['pinjam_barang'];
    $jumlah_lama = $data['pinjam_jumlah'];

    // Jika barang tidak berubah
    if ($barang_id_lama == $barang_id_baru) {
        $selisih = $jumlah_baru - $jumlah_lama;
        if ($selisih > 0) {
            // Tambah jumlah pinjam, kurangi stok
            $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah - $selisih WHERE barang_id = '$barang_id_baru'");
        } elseif ($selisih < 0) {
            // Kurangi jumlah pinjam, tambah stok
            $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah + " . abs($selisih) . " WHERE barang_id = '$barang_id_baru'");
        }
    } else {
        // Barang diganti
        // Kembalikan stok barang lama
        $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah + $jumlah_lama WHERE barang_id = '$barang_id_lama'");
        // Kurangi stok barang baru
        $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah - $jumlah_baru WHERE barang_id = '$barang_id_baru'");
    }

    // Jika status sebelumnya "Dipinjam" dan sekarang "Kembali", kembalikan stok
    if ($data['pinjam_status'] == 'Dipinjam' && $status == 'Kembali') {
        $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah + $jumlah_baru WHERE barang_id = '$barang_id_baru'");
    }

    // Update data peminjaman
    $query_update = "UPDATE pinjam SET 
        pinjam_peminjam='$peminjam', 
        pinjam_barang='$barang_id_baru', 
        pinjam_jumlah='$jumlah_baru', 
        pinjam_kondisi='$kondisi',
        pinjam_tgl_pinjam='$tgl_pinjam', 
        pinjam_tgl_kembali='$tgl_kembali', 
        pinjam_status='$status'
        WHERE pinjam_id='$id'";

    if (mysqli_query($koneksi, $query_update)) {
        header("Location: peminjaman.php"); 
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
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
                            <h4><i class="fas fa-edit"></i> Edit Peminjam</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="pinjam_peminjam" class="form-control" value="<?php echo htmlspecialchars($data['pinjam_peminjam']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Barang</label>
                                    <select name="pinjam_barang" class="form-control" required>
                                        <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $barang = $koneksi->query("SELECT * FROM barang");
                                        while ($b = $barang->fetch_assoc()) {
                                            $selected = ($b['barang_id'] == $data['pinjam_barang']) ? 'selected' : '';
                                            echo "<option value='{$b['barang_id']}' $selected>{$b['barang_nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" name="pinjam_jumlah" class="form-control" value="<?php echo htmlspecialchars($data['pinjam_jumlah']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kondisi</label>
                                    <input type="text" name="pinjam_kondisi" class="form-control" value="<?php echo htmlspecialchars($data['pinjam_kondisi']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pinjam</label>
                                    <input type="date" name="pinjam_tgl_pinjam" class="form-control" value="<?php echo htmlspecialchars($data['pinjam_tgl_pinjam']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="pinjam_tgl_kembali" class="form-control" value="<?php echo htmlspecialchars($data['pinjam_tgl_kembali']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="pinjam_status" class="form-control">
                                        <option value="Dipinjam" <?php if($data['pinjam_status'] == 'Dipinjam') echo 'selected'; ?>>Dipinjam</option>
                                        <option value="Kembali" <?php if($data['pinjam_status'] == 'Kembali') echo 'selected'; ?>>Kembali</option>
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                    <a href="peminjaman.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
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

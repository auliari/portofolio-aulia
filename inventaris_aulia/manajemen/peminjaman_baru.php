<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peminjam = isset($_POST['pinjam_peminjam']) ? $_POST['pinjam_peminjam'] : "";
    $barang = isset($_POST['pinjam_barang']) ? $_POST['pinjam_barang'] : "";
    $jumlah = isset($_POST['pinjam_jumlah']) ? $_POST['pinjam_jumlah'] : 0;
    $kondisi = isset($_POST['pinjam_kondisi']) ? $_POST['pinjam_kondisi'] : "";
    $tgl_pinjam = isset($_POST['pinjam_tgl_pinjam']) ? $_POST['pinjam_tgl_pinjam'] : "";
    $tgl_kembali = isset($_POST['pinjam_tgl_kembali']) ? $_POST['pinjam_tgl_kembali'] : "";
    $status = isset($_POST['pinjam_status']) ? $_POST['pinjam_status'] : "";

    $cek_stok = $koneksi->query("SELECT barang_jumlah FROM barang WHERE barang_id = '$barang'");
    $stok = $cek_stok->fetch_assoc()['barang_jumlah'];

    if ($jumlah > $stok) {
        echo "Jumlah melebihi stok yang tersedia!";
        exit;
    }

    if (!empty($peminjam) && !empty($barang) && !empty($jumlah)) {
        $query = "INSERT INTO pinjam (
            pinjam_peminjam, pinjam_barang, pinjam_jumlah, pinjam_kondisi, 
            pinjam_tgl_pinjam, pinjam_tgl_kembali, pinjam_status
        ) VALUES (
            '$peminjam', '$barang', '$jumlah', '$kondisi', 
            '$tgl_pinjam', '$tgl_kembali', '$status'
        )";

        if (mysqli_query($koneksi, $query)) {
            // Kurangi stok barang
            $koneksi->query("UPDATE barang SET barang_jumlah = barang_jumlah - $jumlah WHERE barang_id = '$barang'");

            header("Location: peminjaman.php");
            exit;
        } else {
            echo "Gagal menambah data";
        }

        if (mysqli_query($koneksi, $query)) {
            header("Location: peminjaman.php");
            exit;
        } else {
            echo "Gagal menambah data";
        }
    } else {
        echo "Semua field harus diisi!";
    }
}
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
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
                            <h4><i class="fas fa-plus-circle"></i> Tambah Peminjam</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="pinjam_peminjam" class="form-control" placeholder="Masukkan nama peminjam" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Barang</label>
                                    <select name="pinjam_barang" class="form-control" required>
                                        <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $barang = $koneksi->query("SELECT * FROM barang");
                                        while ($b = $barang->fetch_assoc()) {
                                            echo "<option value='{$b['barang_id']}'>{$b['barang_nama']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" name="pinjam_jumlah" class="form-control" placeholder="Masukkan jumlah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kondisi</label>
                                    <input type="text" name="pinjam_kondisi" class="form-control" placeholder="Masukkan kondisi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pinjam</label>
                                    <input type="date" name="pinjam_tgl_pinjam" class="form-control" placeholder="Masukkan tanggal pinjam">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" name="pinjam_tgl_kembali" class="form-control" placeholder="Masukkan tanggal kembali">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="pinjam_status" class="form-control">
                                        <option value="Dipinjam">Dipinjam</option>
                                        <option value="Kembali">Kembali</option>
                                    </select>                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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

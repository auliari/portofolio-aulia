<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = isset($_POST['barang_nama']) ? $_POST['barang_nama'] : "";
    $spesifikasi = isset($_POST['barang_spesifikasi']) ? $_POST['barang_spesifikasi'] : "";
    $lokasi = isset($_POST['barang_lokasi']) ? $_POST['barang_lokasi'] : "";
    $kondisi = isset($_POST['barang_kondisi']) ? $_POST['barang_kondisi'] : "";
    $jumlah = isset($_POST['barang_jumlah']) ? $_POST['barang_jumlah'] : 0;
    $sumber_dana = isset($_POST['barang_sumber_dana']) ? $_POST['barang_sumber_dana'] : "";
    $jenis = isset($_POST['barang_jenis']) ? $_POST['barang_jenis'] : "";
    $keterangan = isset($_POST['barang_keterangan']) ? $_POST['barang_keterangan'] : "";

    if (!empty($nama) && !empty($spesifikasi) && !empty($lokasi)) {
        $query = "INSERT INTO barang (barang_nama, barang_spesifikasi, barang_lokasi, barang_kondisi, barang_jumlah, barang_sumber_dana, barang_jenis, barang_keterangan) 
                  VALUES ('$nama', '$spesifikasi', '$lokasi', '$kondisi', '$jumlah', '$sumber_dana', '$jenis', '$keterangan')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: data_barang.php");
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
    <title>Tambah Barang</title>
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
                            <h4><i class="fas fa-plus-circle"></i> Tambah Barang</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="barang_nama" class="form-control" placeholder="Masukkan nama barang" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Spesifikasi</label>
                                    <input type="text" name="barang_spesifikasi" class="form-control" placeholder="Masukkan spesifikasi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" name="barang_lokasi" class="form-control" placeholder="Masukkan lokasi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kondisi</label>
                                    <input type="text" name="barang_kondisi" class="form-control" placeholder="Masukkan kondisi">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="barang_jumlah" class="form-control" placeholder="Masukkan jumlah">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sumber Dana</label>
                                    <input type="text" name="barang_sumber_dana" class="form-control" placeholder="Masukkan sumber dana">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis</label>
                                    <input type="text" name="barang_jenis" class="form-control" placeholder="Masukkan jenis barang">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea name="barang_keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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

<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = isset($_POST['suplier_nama']) ? $_POST['suplier_nama'] : "";
    $alamat = isset($_POST['suplier_alamat']) ? $_POST['suplier_alamat'] : "";
    $telepon = isset($_POST['suplier_telepon']) ? $_POST['suplier_telepon'] : "";

    if (!empty($nama) && !empty($alamat) && !empty($telepon)) {
        $query = "INSERT INTO suplier (suplier_nama, suplier_alamat, suplier_telepon) 
                  VALUES ('$nama', '$alamat', '$telepon')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: data_suplier.php");
            exit;
        } else {
            echo "Gagal menambah data: " . mysqli_error($koneksi);
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
    <title>Tambah Suplier</title>
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
                            <h4><i class="fas fa-plus-circle"></i> Tambah Suplier</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="suplier_nama" class="form-control" placeholder="Masukkan nama suplier" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="suplier_alamat" class="form-control" placeholder="Masukkan alamat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="suplier_telepon" class="form-control" placeholder="Masukkan telepon">
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="data_suplier.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
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

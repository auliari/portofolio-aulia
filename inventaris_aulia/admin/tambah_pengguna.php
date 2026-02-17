<?php
ob_start();
include "../koneksi.php";  
include "header.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['user_nama'];
    $username = $_POST['user_username'];
    $password = md5($_POST['user_password']); 
    $level = $_POST['user_level'];
    
    $foto = $_FILES['user_foto']['name'];
    $tmp = $_FILES['user_foto']['tmp_name'];

    $level_mapping = [
        1 => 'Administrator',
        2 => 'Manajemen'
    ];

    if (!empty($foto)) {
        move_uploaded_file($tmp, "uploads/$foto");
    } else {
        $foto = "default.png"; 
    }

    if (!empty($nama) && !empty($username) && !empty($password) && !empty($level)) {
        $query = "INSERT INTO user (user_nama, user_username, user_password, user_level, user_foto) 
                  VALUES ('$nama', '$username', '$password', '$level', '$foto')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: daftar_pengguna.php");
            exit;
        } else {
            echo "Gagal menambah pengguna.";
        }
    } else {
        echo "Semua field wajib diisi!";
    }
}
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
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
                        <h4><i class="fas fa-user-plus"></i> Tambah Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="text" name="fake_username" style="display: none;">
                            <input type="password" name="fake_password" style="display: none;">
                            
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="user_nama" class="form-control" placeholder="Masukkan nama" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="user_username" class="form-control" placeholder="Masukkan username" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="user_password" class="form-control" placeholder="Masukkan password" autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select name="user_level" class="form-select" autocomplete="off">
                                    <option value="">-- Pilih Level --</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Manajemen</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" name="user_foto" class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                <a href="tambah_pengguna.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
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

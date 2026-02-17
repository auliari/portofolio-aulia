<?php 
include "../koneksi.php";
include "header.php";

$id = isset($_GET['user_id']) ? $_GET['user_id'] : (isset($_GET['id']) ? $_GET['id'] : "");

if ($id == "") {
    echo "<script>alert('User ID tidak ditemukan'); window.location='daftar_pengguna.php';</script>";
    exit;
}

$query = $koneksi->query("SELECT * FROM user WHERE user_id='$id'");
$data = $query->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data pengguna tidak ditemukan'); window.location='daftar_pengguna.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['user_nama'];
    $username = $_POST['user_username'];
    $level = $_POST['user_level'];

    if (!empty($_FILES['user_foto']['name'])) {
        $foto = $_FILES['user_foto']['name'];
        $tmp = $_FILES['user_foto']['tmp_name'];
        move_uploaded_file($tmp, "uploads/$foto");
        $queryUpdate = "UPDATE user SET user_nama='$nama', user_username='$username', user_level='$level', user_foto='$foto' WHERE user_id='$id'";
    } else {
        $queryUpdate = "UPDATE user SET user_nama='$nama', user_username='$username', user_level='$level' WHERE user_id='$id'";
    }

    if ($koneksi->query($queryUpdate)) {
        echo "<script>alert('Data berhasil diupdate'); window.location='daftar_pengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
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
                    <div class="card-header card-header-custom text-white text-center">
                        <h4><i class="fas fa-edit"></i> Edit Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="user_nama" class="form-control" value="<?= $data['user_nama'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="user_username" class="form-control" value="<?= $data['user_username'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select name="user_level" class="form-select" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="1" <?= $data['user_level'] == 1 ? 'selected' : '' ?>>Administrator</option>
                                    <option value="2" <?= $data['user_level'] == 2 ? 'selected' : '' ?>>Manajemen</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto (opsional)</label><br>
                                <?php if (!empty($data['user_foto'])): ?>
                                    <img src="uploads/<?= $data['user_foto'] ?>" width="80" class="mb-2 rounded">
                                <?php endif; ?>
                                <input type="file" name="user_foto" class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                <a href="daftar_pengguna.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Kembali</a>
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

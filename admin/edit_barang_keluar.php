<?php
include "../koneksi.php";

if (!isset($_GET['bk_id'])) {
    echo "ID barang keluar tidak ditemukan!";
    exit;
}

$bk_id = $_GET['bk_id'];

// Ambil data lama barang keluar
$sql = "SELECT * FROM barang_keluar WHERE bk_id = $bk_id";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = mysqli_fetch_assoc($result);
$jumlah_lama = $data['bk_jumlah_keluar'];
$barang_id_lama = $data['bk_id_barang'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id_baru = $_POST['barang_id'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $jumlah_baru = $_POST['jumlah_keluar'];
    $lokasi = $_POST['lokasi'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    $sukses = true;

    // Kembalikan stok lama
    $sukses &= mysqli_query($koneksi, "UPDATE barang SET barang_jumlah = barang_jumlah + $jumlah_lama WHERE barang_id = '$barang_id_lama'");

    // Kurangi stok baru
    $sukses &= mysqli_query($koneksi, "UPDATE barang SET barang_jumlah = barang_jumlah - $jumlah_baru WHERE barang_id = '$barang_id_baru'");

    // Update data barang_keluar
    $update = "UPDATE barang_keluar SET 
                bk_id_barang = '$barang_id_baru',
                bk_tgl_keluar = '$tgl_keluar',
                bk_jumlah_keluar = '$jumlah_baru',
                bk_lokasi = '$lokasi',
                bk_penerima = '$penerima',
                bk_keterangan = '$keterangan'
               WHERE bk_id = $bk_id";
    $sukses &= mysqli_query($koneksi, $update);

    if ($sukses) {
        mysqli_commit($koneksi);
        header("Location: barang_keluar.php");
        exit;
    } else {
        mysqli_rollback($koneksi);
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
}


$barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang Keluar</title>
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
            background-color:var(--primary-color) !important;
        }
        </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="content-wrapper p-4">
    <div class="container mt-4">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header card-header-custom text-white text-center">
                    <h4><i class="fas fa-edit"></i> Edit Barang Keluar</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Nama Barang</label>
                            <select name="barang_id" id="barang_id" class="form-control" required>
                                <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                                    <option value="<?= $b['barang_id']; ?>" <?= $b['barang_id'] == $data['bk_id_barang'] ? 'selected' : '' ?>>
                                        <?= $b['barang_nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                            <input type="date" name="tgl_keluar" class="form-control" value="<?= $data['bk_tgl_keluar']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_keluar" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah_keluar" class="form-control" value="<?= $data['bk_jumlah_keluar']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" value="<?= $data['bk_lokasi']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" name="penerima" class="form-control" value="<?= $data['bk_penerima']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $data['bk_keterangan']; ?></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn-primary">Update</button>
                            <a href="barang_keluar.php" class="btn btn-secondary mt-2">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
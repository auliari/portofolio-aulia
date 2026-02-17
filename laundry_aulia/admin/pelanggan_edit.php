<?php
    include '../koneksi.php';
    include "header.php";

    $id = $_GET['id'] ?? die("ID tidak disediakan."); 

    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelanggan_id = '$id'");
    $pelanggan = mysqli_fetch_assoc($result) ?? die("Data tidak ditemukan!");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $hp = $_POST['hp'];
        $alamat = $_POST['alamat'];
        $query = "UPDATE pelanggan SET pelanggan_nama = '$nama', pelanggan_hp = '$hp', pelanggan_alamat = '$alamat' WHERE pelanggan_id = '$id'";

        if (mysqli_query($koneksi, $query)) {
            header("Location: pelanggan.php?message=Data berhasil diupdate");
            exit;
        } else {
            die("Error: " . mysqli_error($koneksi));
        }
    }
?>


<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4 style="color:#921A40;">Edit Data Pelanggan</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="pelanggan_update.php">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="id" value="<?php echo ($pelanggan['pelanggan_id']); ?>">
                        <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($pelanggan['pelanggan_nama']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="number" name="hp" class="form-control" value="<?php echo htmlspecialchars($pelanggan['pelanggan_hp']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($pelanggan['pelanggan_alamat']); ?>" required>
                    </div>
                    <br>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
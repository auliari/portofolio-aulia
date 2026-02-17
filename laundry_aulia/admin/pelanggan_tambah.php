<?php
    include "header.php";
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h4 style="color:#921A40;">Tambah Pelanggan Baru</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="pelanggan_aksi.php">
                    <div class="form-group">
                        <label style="color:#921A40;">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan Nama">
                    </div>

                    <div class="form-group">
                        <label style="color:#921A40;">HP</label>
                        <input type="number" name="hp" class="form-control" placeholder="Masukkan Nomor HP">
                    </div>

                    <div class="form-group">
                        <label style="color:#921A40;">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat">
                    </div>

                    <br>
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

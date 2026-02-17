<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Laundry</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
</head>
<body style="background:rgb(244, 208, 211);">
    <br><br><br>
    <center>
        <h2 style="color:#921A40;">SISTEM INFORMASI LAUNDRY</h2>
    </center>
    <br><br><br>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <?php
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == 'gagal'){
                        echo "<div class= 'alert alert-danger'>Login gagal: Username dan Password Salah!</div>";
                    } else if($_GET['pesan'] == 'logout'){
                        echo "<div class= 'alert alert-info'>Anda berhasil logout</div>";
                    } else if($_GET['pesan'] == 'belum_login'){
                        echo "<div class= 'alert alert-danger'>Anda harus login untuk mengakses halaman admin!</div>";
                    }
                }
               
            ?>
            <form method="POST" action="login.php">
                <div class="panel">
                    <br>
                    <div class="panel-body">
                        <div class="form-group">
                            <label style="color:#921A40;">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label style="color:#921A40;">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <br>
                            <input type="submit" value="Log In" class="btn btn-primary">
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>

</body>
</html>



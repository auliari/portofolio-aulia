<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Essence</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <style>
        .gradient-text {
    background: linear-gradient(45deg, #969BE7, #EEC1DD);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
    display: inline-block;
    }

        .btn {
            background-color: #cc8eb1;
            color: white;
        }
</style>
</head>
<body style="background: linear-gradient(to right, #969BE7, #EEC1DD, #D1D0EF, #FCF8FB); font-family: 'Poppins', sans-serif;">
    <br><br><br>
    
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
            <br>
            <form method="POST" action="login.php">
                <div class="panel">
                    
                <center>
                    <h2 class="gradient-text" style="font-family: 'Playfair Display', serif;"><b>
                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #969BE7;" width="30" height="23" fill="currentColor" class="bi bi-flower2" viewBox="0 0 16 16">
                        <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4m3-12q0 .11-.03.247c-.544.241-1.091.638-1.598 1.084A3 3 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1 1 0 0 1 5 4a3 3 0 0 1 6 0m-.812 6.052A3 3 0 0 0 11 8a3 3 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a7 7 0 0 1-.647-.487m-3.56.617a3 3 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084q.03.137.03.247a3 3 0 1 1-6 0q0-.11.03-.247c.544-.242 1.091-.638 1.598-1.084m-.816-4.721A3 3 0 0 0 5 8c0 .794.308 1.516.812 2.052a7 7 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487M8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                    </svg> Glamour Essence 
                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #EEC1DD;" width="30" height="23" fill="currentColor" class="bi bi-flower2" viewBox="0 0 16 16">
                        <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4m3-12q0 .11-.03.247c-.544.241-1.091.638-1.598 1.084A3 3 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1 1 0 0 1 5 4a3 3 0 0 1 6 0m-.812 6.052A3 3 0 0 0 11 8a3 3 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a7 7 0 0 1-.647-.487m-3.56.617a3 3 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084q.03.137.03.247a3 3 0 1 1-6 0q0-.11.03-.247c.544-.242 1.091-.638 1.598-1.084m-.816-4.721A3 3 0 0 0 5 8c0 .794.308 1.516.812 2.052a7 7 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487M8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                    </svg></b></h2>
                </center>
                    <br>
                    <div class="panel-body">
                        <div class="form-group">
                            <label style="color:#cc8eb1;">Username</label>
                            <input type="text" name="user_nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label style="color:#cc8eb1;">Password</label>
                            <input type="password" name="user_password" class="form-control">
                        </div>
                        <br>
                            <center><input type="submit" value="Log In" class="btn"></center>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>

</body>
</html>



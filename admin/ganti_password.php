<?php 
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>

    <style>
        .card-header-custom {
            background-color: var(--primary-color) !important;
            color: white;
            width: 100%; 
        }

        .form-control {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
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

        .alert-success {
            width: 60%;
            margin: 20px auto;
            font-size: 20px;
            background-color: white;
            color: var(--primary-color) !important;
            border: 6px solid var(--primary-color);
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="content-wrapper p-4">
        <div class="container mt-4">
            <?php 
            if (isset($_GET['pesan']) && $_GET['pesan'] == "oke") {
                echo "<div class='alert alert-success text-center'>Password telah diganti!</div>";
            }
            ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header card-header-custom text-center">
                            <h4><i class="fas fa-key"></i> Ganti Password</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="ganti_password2.php">
                                <div class="form-group">
                                    <label for="password_baru">Masukkan Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru Anda..." required>
                                </div>
                                
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Ganti Password">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include "footer.php"; ?>
    </div>
</body>
</html>

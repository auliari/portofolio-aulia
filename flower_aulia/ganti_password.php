<?php 
include 'header.php'; 
?>

<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">

    <?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "oke"){
            echo "<div class='alert alert-success'>Password telah diganti!</div>";
        }
    }
    ?>

    <div class="panel">
        <div class="panel-heading">
            <h4><b>Ganti Password</b></h4>
</div>
       <div class="panel-body">

       <form method="post" action="ganti_password2.php">
        <div class="form-group">
            <label>Masukkan Password Baru</label>
            <input type="password" class="form-control" name="password_baru" placeholder="Masukkan Password Baru Anda..">

</div>
<div>

    <input type="submit" class="button" value="Ganti Password">
</form>

</div>
</div>
</div>
</div>
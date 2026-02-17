<?php
include "../koneksi.php"; 
include "header.php";


$username = $_SESSION['user_nama'];
$query = "SELECT user_nama, user_username, user_foto, user_level FROM user WHERE user_nama = '$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);


// Ambil data dari database untuk kotak-kotak dashboard
$query_barang = "SELECT COUNT(*) as total_barang FROM barang";
$result_barang = mysqli_query($koneksi, $query_barang);
$data_barang = mysqli_fetch_assoc($result_barang);

$query_pengguna = "SELECT COUNT(*) as total_pengguna FROM user";
$result_pengguna = mysqli_query($koneksi, $query_pengguna);
$data_pengguna = mysqli_fetch_assoc($result_pengguna);

$query_supplier = "SELECT COUNT(*) as total_supplier FROM suplier";
$result_supplier = mysqli_query($koneksi, $query_supplier);
$data_supplier = mysqli_fetch_assoc($result_supplier);

$query_barang_masuk = "SELECT SUM(bm_jumlah) as total_masuk FROM barang_masuk";
$result_barang_masuk = mysqli_query($koneksi, $query_barang_masuk);
$data_barang_masuk = mysqli_fetch_assoc($result_barang_masuk);

$query_barang_keluar = "SELECT SUM(bk_jumlah_keluar) as total_keluar FROM barang_keluar";
$result_barang_keluar = mysqli_query($koneksi, $query_barang_keluar);
$data_barang_keluar = mysqli_fetch_assoc($result_barang_keluar);

$query_transaksi_masuk = "SELECT COUNT(bm_id) as transaksi_masuk FROM barang_masuk";
$result_transaksi_masuk = mysqli_query($koneksi, $query_transaksi_masuk);
$data_transaksi_masuk = mysqli_fetch_assoc($result_transaksi_masuk);

$query_transaksi_keluar = "SELECT COUNT(bk_id) as transaksi_keluar FROM barang_keluar";
$result_transaksi_keluar = mysqli_query($koneksi, $query_transaksi_keluar);
$data_transaksi_keluar = mysqli_fetch_assoc($result_transaksi_keluar);

$query_peminjaman = "SELECT COUNT(*) as total_peminjaman FROM pinjam";
$result_peminjaman = mysqli_query($koneksi, $query_peminjaman);
$data_peminjaman = mysqli_fetch_assoc($result_peminjaman);

$query_peminjaman_kembali = "SELECT COUNT(*) as Kembali FROM pinjam WHERE pinjam_status = 'Kembali'";
$result_peminjaman_kembali = mysqli_query($koneksi, $query_peminjaman_kembali);
$data_peminjaman_kembali = mysqli_fetch_assoc($result_peminjaman_kembali);

$query_peminjaman_belum = "SELECT COUNT(*) as Dipinjam FROM pinjam WHERE pinjam_status = 'Dipinjam'";
$result_peminjaman_belum = mysqli_query($koneksi, $query_peminjaman_belum);
$data_peminjaman_belum = mysqli_fetch_assoc($result_peminjaman_belum);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Essence</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>
<style>
.dashboard-card {
    background: linear-gradient(  #EEC1DD, #D1D0EF);
    border-radius: 16px;
    padding: 20px;
    min-height: 130px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.dashboard-card h3 {
    font-size: 30px;
    top: 15px;
    font-weight: bold;
    margin: 0;
    color: #333;
}

.dashboard-card p {
    font-size: 16px;
    margin-top: 15px;
    color: #555;
}

.dashboard-card i {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 50px;
    opacity: 0.2;
    color: #6c5ce7;
}

.table th, .table td {
    vertical-align: middle;
    padding: 8px 20px; 
}

.table th {
    width: 200px;
    text-align: left; 
}

.table td {
    tex
    t-align: left; 
}
.breadcrumb a {
    color: #5a67d8;
    text-decoration: none;
    font-weight: 500; 
}

.breadcrumb a:hover {
    color: #4338ca; 
    text-decoration: underline;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h2 style="color:#969BE7;"> Dashboard <span class="text-muted" style="font-size: 18px;">Control panel </span></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
        <div class="container-fluid-full">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2">
                <?php
                $cards = [
                    ['icon' => 'fa-box', 'title' => 'Model Barang', 'value' => $data_barang['total_barang'], 'link' => 'data_barang.php'],
                    ['icon' => 'fa-user', 'title' => 'Pengguna', 'value' => $data_pengguna['total_pengguna'], 'link' => 'daftar_pengguna.php'],
                    ['icon' => 'fa-truck', 'title' => 'Supplier', 'value' => $data_supplier['total_supplier'], 'link' => 'data_suplier.php'],
                    ['icon' => 'fa-exchange-alt', 'title' => 'Transaksi Peminjaman', 'value' => $data_peminjaman['total_peminjaman'], 'link' => 'peminjaman.php'],
                    ['icon' => 'fa-sign-in-alt', 'title' => 'Total Barang Masuk', 'value' => $data_barang_masuk['total_masuk'], 'link' => 'barang_masuk.php'],
                    ['icon' => 'fa-sign-out-alt', 'title' => 'Total Barang Keluar', 'value' => $data_barang_keluar['total_keluar'], 'link' => 'barang_keluar.php'],
                    ['icon' => 'fa-sign-in-alt', 'title' => 'Total Transaksi Barang Masuk', 'value' => $data_transaksi_masuk['transaksi_masuk'], 'link' => 'barang_masuk.php'],
                    ['icon' => 'fa-sign-out-alt', 'title' => 'Total Transaksi Barang Keluar', 'value' => $data_transaksi_keluar['transaksi_keluar'], 'link' => 'barang_keluar.php'],
                    ['icon' => 'fa-check-circle', 'title' => 'Peminjaman Dikembalikan', 'value' => $data_peminjaman_kembali['Kembali'], 'link' => 'peminjaman.php'],
                    ['icon' => 'fa-clock', 'title' => 'Peminjaman Belum Dikembalikan', 'value' => $data_peminjaman_belum['Dipinjam'], 'link' => 'peminjaman.php'],
                ];

                foreach ($cards as $card) {
                    echo "<div class='col mb-4'>
                            <div class='dashboard-card'>
                                <i class='fas {$card['icon']}'></i>
                                <h3>{$card['value']}</h3>
                                <p>{$card['title']}</p>
                                <a href='{$card['link']}' class='btn btn-light btn-sm' 
                                style='color: #969BE7; font-weight: 600; padding: 4px 12px; border-radius: 12px;'>
                                Lihat Detail</a>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
        <div class="card">
    <div class="card-header" style="
        background-color: var(--primary-color) !important; 
        color: white; 
        font-weight: bold;
        text-align: center;
        border-radius: 6px 6px 0 0; /* Hanya atasnya bundar */
        height: 50px;
        display: flex;
        align-items: center;
    ">
        <h4 class="mb-0"> <i class="fas fa-info-circle"></i> Detail Login</h4>
    </div>
    <table class="table">
        <tr>
            <th>Nama</th>
            <td><?php echo $user['user_nama']; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?php echo $user['user_username']; ?></td>
        </tr>
        <tr>
            <th>Level Hak Akses</th>
            <td>
                <?php if ($user['user_level'] == 1) { ?>
                    <span class="badge badge-success">ADMINISTRATOR</span>
                <?php } else { ?>
                    <span class="badge badge-primary">USER</span>
                <?php } ?>
            </td>
        </tr>
    </table>
</div>

        <?php include 'footer.php';  ?>
    </div>
</div>
</body>
</html>
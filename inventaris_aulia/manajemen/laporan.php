<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    
    <link rel="stylesheet" href="style.css">
    <style>
        @media print {
            .main-sidebar, .navbar, .sidebar, .breadcrumb, .btn, .content-wrapper > form, footer {
                display: none !important;
            }
            .content-wrapper {
                margin: 0;
                padding: 0;
                width: 100%;
            }
            .table, .panel, .panel-body, .panel-heading {
                width: 100% !important;
            }
            body {
                background: white;
            }
        }

        .table thead th {
            background-color: #f2eff8;
            color: var(--secondary-color) !important;
            vertical-align: middle;
        }
        .btn-primary {
            background-color: var(--primary-color) !important;
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: var(--secondary-color) !important;
        }
        .table th {
            color: white;
            font-size: 16px;
            padding: 5px;
        }
        .breadcrumb a {
            color: var(--secondary-color) !important;
            text-decoration: none;
            font-weight: 500;
        }
        .breadcrumb a:hover {
            color: #4338ca;
            text-decoration: underline;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h2 style="color: #969BE7;">Laporan <span class="text-muted" style="font-size: 18px;">Laporan Inventaris & Peminjaman</span></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <form action="laporan.php" method="get">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th width="1%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="jenis" class="form-control" required>
                            <option value="">- Pilih Jenis -</option>
                            <option value="masuk" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'masuk' ? 'selected' : '' ?>>Barang Masuk</option>
                            <option value="keluar" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'keluar' ? 'selected' : '' ?>>Barang Keluar</option>
                            <option value="pinjam" <?= isset($_GET['jenis']) && $_GET['jenis'] == 'pinjam' ? 'selected' : '' ?>>Peminjaman</option>
                        </select>
                    </td>
                    <td><input type="date" name="tgl_dari" class="form-control" required value="<?= $_GET['tgl_dari'] ?? '' ?>"></td>
                    <td><input type="date" name="tgl_sampai" class="form-control" required value="<?= $_GET['tgl_sampai'] ?? '' ?>"></td>
                    <td><input type="submit" value="Filter" class="btn btn-primary"></td>
                </tr>
            </tbody>
        </table>
    </form>

    <br>

    <?php 
    if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai']) && isset($_GET['jenis'])) {
        include '../koneksi.php';

        $dari = $_GET['tgl_dari'];
        $sampai = $_GET['tgl_sampai'];
        $jenis = $_GET['jenis'];

        if ($jenis == "masuk") {
            $data = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE date(bm_tgl_masuk) >= '$dari' AND date(bm_tgl_masuk) <= '$sampai' ORDER BY bm_id DESC");
        } elseif ($jenis == "keluar") {
            $data = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$dari' AND date(bk_tgl_keluar) <= '$sampai' ORDER BY bk_id DESC");
        } elseif ($jenis == "pinjam") {
            $data = mysqli_query($koneksi, "SELECT pinjam.*, barang.barang_nama FROM pinjam JOIN barang ON pinjam.pinjam_barang = barang.barang_id WHERE date(pinjam_tgl_pinjam) >= '$dari' AND date(pinjam_tgl_pinjam) <= '$sampai' ORDER BY pinjam_id DESC");
        }
    ?>
    <div class="panel">
        <div class="panel-heading">
            <h5>Laporan <b><?= strtoupper($jenis) ?></b> dari <b><?= $dari ?></b> sampai <b><?= $sampai ?></b></h5>
        </div>
        <div class="panel-body">
            <div>
                <button class="btn btn-sm btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> CETAK
                </button>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                <?php if ($jenis == "masuk"): ?>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Nama Suplier</th>
                    </tr>
                <?php elseif ($jenis == "keluar"): ?>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Lokasi</th>
                        <th>Penerima</th>
                        <th>Keterangan</th>
                    </tr>
                <?php elseif ($jenis == "pinjam"): ?>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                <?php endif; ?>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                while ($d = mysqli_fetch_array($data)) {
                    if ($jenis == "masuk") {
                        echo "<tr>
                                <td>$no</td>
                                <td>{$d['bm_tgl_masuk']}</td>
                                <td>{$d['bm_nama_barang']}</td>
                                <td>{$d['bm_jumlah']}</td>
                                <td>{$d['bm_nama_suplier']}</td>
                              </tr>";
                    } elseif ($jenis == "keluar") {
                        echo "<tr>
                                <td>$no</td>
                                <td>{$d['bk_tgl_keluar']}</td>
                                <td>{$d['bk_nama_barang']}</td>
                                <td>{$d['bk_jumlah_keluar']}</td>
                                <td>{$d['bk_lokasi']}</td>
                                <td>{$d['bk_penerima']}</td>
                                <td>{$d['bk_keterangan']}</td>
                              </tr>";
                    } elseif ($jenis == "pinjam") {
                        $status = $d['pinjam_status'] == 'Dipinjam' 
                                ? "<span class='badge bg-info text-white' style='font-size:12px'>Dipinjam</span>" 
                                : "<span class='badge bg-success text-white' style='font-size:12px'>Kembali</span>";
                        echo "<tr>
                                <td>$no</td>
                                <td>{$d['pinjam_peminjam']}</td>
                                <td>{$d['barang_nama']}</td>
                                <td>{$d['pinjam_jumlah']}</td>
                                <td>{$d['pinjam_kondisi']}</td>
                                <td>{$d['pinjam_tgl_pinjam']}</td>
                                <td>{$d['pinjam_tgl_kembali']}</td>
                                <td>$status</td>
                              </tr>";
                    }
                    $no++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
    <?php include "footer.php"; ?>
</div>
</body>
</html>

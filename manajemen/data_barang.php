<?php 
include "../koneksi.php";   
include "header.php";    

$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$sql = "SELECT * FROM barang WHERE barang_nama LIKE '%$search%'";
$result = $koneksi->query($sql); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>

    <!-- CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        .table th {
        background-color: var(--primary-color);
        color: white;
        font-size: 16px;
        padding: 5px;
        }
        .btn-primary {
            background-color: var(--secondary-color) !important;
            border: none;
            padding: 10px 10px;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color:var(--primary-color) !important;
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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h2 style="color: #969BE7;">Barang <span class="text-muted" style="font-size: 18px;">Data Barang</span></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid-full">
        <div class="d-flex justify-content-between mb-2">
            <h5>Barang</h5>
            <a href="tambah_barang.php" class="btn btn-primary">+ Tambah Barang</a>
        </div>

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <div>
                    <label for="searchBox" class="me-2 mb-0">Search:</label>
                    <input type="text" id="searchBox" class="form-control d-inline-block" style="width: 160px;">
                </div>
            </div>
        </div>
        <div>
            <table class="table table-bordered" id="barangTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>SPESIFIKASI</th>
                        <th>LOKASI</th>
                        <th>KONDISI</th>
                        <th>JUMLAH</th>
                        <th>SUMBER DANA</th>
                        <th>JENIS</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['barang_nama'] . "</td>
                                <td>" . $row['barang_spesifikasi'] . "</td>
                                <td>" . $row['barang_lokasi'] . "</td>
                                <td>" . $row['barang_kondisi'] . "</td>
                                <td>" . $row['barang_jumlah'] . "</td>
                                <td>" . $row['barang_sumber_dana'] . "</td>
                                <td>" . $row['barang_jenis'] . "</td>
                                <td>" . $row['barang_keterangan'] . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php include "footer.php"; ?>
</div>

<script>
    $(document).ready(function () {
        const table = $('#barangTable').DataTable({
            "dom": 'rt<"bottom d-flex justify-content-between align-items-center mt-3"ip>',
            "language": {
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                },
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari total _MAX_ data)"
            }
        });

        $('#searchBox').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>

</body>
</html>

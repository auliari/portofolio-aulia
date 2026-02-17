<?php 
include "../koneksi.php";   
include "header.php";    

$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$sql = "SELECT * FROM user WHERE user_nama LIKE '%$search%'";
$result = $koneksi->query($sql); 

$level_mapping = [
    1 => 'Administrator',
    2 => 'Manajemen'
];
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>

    <!-- Bootstrap, FontAwesome, DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

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
        .user-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .breadcrumb a {
    color: #5a67d8; /* Ungu biru (bisa diganti sesuai selera) */
    text-decoration: none; /* Hilangkan garis bawah */
    font-weight: 500; /* Biar lebih jelas */
}

.breadcrumb a:hover {
    color: #4338ca; /* Warna saat hover */
    text-decoration: underline; /* Tambah garis bawah saat hover (opsional) */
}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="content-wrapper p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <h2 style="color: #969BE7;">Daftar Pengguna <span class="text-muted" style="font-size: 18px;">Data Pengguna</span></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h5>Pengguna</h5>
        </div>

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <div>
                    <label for="searchBox" class="me-2 mb-0">Search:</label>
                    <input type="text" id="searchBox" class="form-control d-inline-block" style="width: 160px;">
                </div>
            </div>
        </div>


        <table class="table table-bordered" id="barangTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>LEVEL</th>
                    <th>FOTO</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['user_nama'] ?></td>
                        <td><?= $row['user_username'] ?></td>
                        <td style="font-size: 17px;">
                            <?php
                            $level = isset($level_mapping[$row['user_level']]) ? $level_mapping[$row['user_level']] : 'Tidak diketahui';
                            $badge_class = '';

                            if ($row['user_level'] == 1) {
                                $badge_class = 'badge bg-success';
                            } elseif ($row['user_level'] == 2) {
                                $badge_class = 'badge bg-primary';
                            } else {
                                $badge_class = 'badge bg-secondary';
                            }
                            ?>
                            <span class="<?= $badge_class ?>"><?= $level ?></span>
                        </td>
                        <td><img src='uploads/<?= $row['user_foto'] ?>' class='user-img'></td>
                        
                    </tr>
                    <?php
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
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

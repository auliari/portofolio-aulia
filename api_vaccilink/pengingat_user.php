<?php
include 'koneksi.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['aksi'])) {
        $aksi = $_POST['aksi'];
        
        if ($aksi == 'get_jadwal_by_orangtua') {
            if (isset($_POST['id_orangtua'])) {
                $id_orangtua = $_POST['id_orangtua'];
                
                // Query untuk mengambil jadwal anak berdasarkan id_orangtua
                $query = "SELECT ja.*, a.nama_anak, mi.nama_imunisasi, mi.deskripsi as jenis_imunisasi
                          FROM jadwal_anak ja 
                          JOIN anak a ON ja.id_anak = a.id_anak 
                          JOIN master_imunisasi mi ON ja.id_imunisasi = mi.id_imunisasi
                          WHERE a.id_orangtua = ? 
                          ORDER BY ja.tanggal_dijadwalkan ASC";
                
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id_orangtua);
                $stmt->execute();
                $result = $stmt->get_result();
                
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                
                echo json_encode([
                    'success' => true,
                    'data' => $data
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Parameter id_orangtua diperlukan'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Aksi tidak dikenali'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Parameter aksi diperlukan'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Metode request harus POST'
    ]);
}

$conn->close();
?>
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Koneksi ke database gagal"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    // 🔹 Ambil semua jadwal master
    if ($aksi === 'get_all_jadwal') {
        $query = "SELECT * FROM master_jadwal ORDER BY tanggal_dijadwalkan ASC";
        $result = $conn->query($query);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode(["success" => true, "data" => $data]);
    }

    // 🔹 Ambil jadwal anak tertentu
    elseif ($aksi === 'get_jadwal_anak') {
        $id_anak = $_POST['id_anak'] ?? '';
        if (empty($id_anak)) {
            echo json_encode(["success" => false, "message" => "id_anak kosong"]);
            exit;
        }

        $stmt = $conn->prepare("SELECT ja.*, mj.nama_imunisasi, mj.lokasi 
                                FROM jadwal_anak ja 
                                JOIN master_jadwal mj ON ja.id_master = mj.id_master 
                                WHERE ja.id_anak = ?
                                ORDER BY ja.tanggal_imunisasi DESC");
        $stmt->bind_param("i", $id_anak);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode(["success" => true, "data" => $data]);
        $stmt->close();
    }

    // 🔹 Ambil antrian (insert ke jadwal_anak)
    elseif ($aksi === 'ambil_antrian') {
        $id_anak = $_POST['id_anak'] ?? '';
        $id_master = $_POST['id_master'] ?? '';
        $tanggal_imunisasi = $_POST['tanggal_imunisasi'] ?? '';

        if (empty($id_anak) || empty($id_master) || empty($tanggal_imunisasi)) {
            echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
            exit;
        }

        // hitung antrian
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM jadwal_anak 
                                WHERE id_master = ? AND tanggal_imunisasi = ?");
        $stmt->bind_param("is", $id_master, $tanggal_imunisasi);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $nomor_antrian = $result['total'] + 1;
        $stmt->close();

        // insert antrian
        $stmt = $conn->prepare("INSERT INTO jadwal_anak (id_anak, id_master, tanggal_imunisasi, status, nomor_antrian) 
                                VALUES (?, ?, ?, 'belum', ?)");
        $stmt->bind_param("iisi", $id_anak, $id_master, $tanggal_imunisasi, $nomor_antrian);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Antrian berhasil diambil", "nomor_antrian" => $nomor_antrian]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal mengambil antrian"]);
        }
        $stmt->close();
    }

    else {
        echo json_encode(["success" => false, "message" => "Aksi tidak dikenali"]);
    }
}
?>

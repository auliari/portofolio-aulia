<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
$conn = new mysqli("localhost", "root", "", "db_imunisasi");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_params);
    $id_anak = $delete_params['id'] ?? '';
    
    // Atau jika menggunakan query parameter
    if (empty($id_anak)) {
        $id_anak = $_GET['id'] ?? '';
    }

    if (!empty($id_anak)) {
        // First, get the child name for response message
        $stmt_select = $conn->prepare("SELECT nama_anak FROM anak WHERE id_anak = ?");
        $stmt_select->bind_param("i", $id_anak);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $child = $result->fetch_assoc();
        $stmt_select->close();

        // Then delete the child
        $stmt = $conn->prepare("DELETE FROM anak WHERE id_anak = ?");
        $stmt->bind_param("i", $id_anak);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Data anak berhasil dihapus";
            $response['nama_anak'] = $child['nama_anak'] ?? '';
        } else {
            $response['success'] = false;
            $response['message'] = "Gagal menghapus data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = "ID anak tidak valid";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Metode request tidak valid";
}

echo json_encode($response);
$conn->close();
?>
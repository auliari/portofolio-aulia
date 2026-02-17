<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli("localhost", "root", "", "db_imunisasi");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Koneksi gagal"]);
    exit();
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == "insert") {
    $judul = $_POST['judul'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $url = $_POST['url'] ?? '';
    $tipe = $_POST['tipe'] ?? '';

    $stmt = $conn->prepare("INSERT INTO konten (judul, deskripsi, url, tipe) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $judul, $deskripsi, $url, $tipe);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Konten berhasil ditambahkan"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menambahkan konten"]);
    }
    $stmt->close();

} elseif ($action == "update") {
    $id = $_POST['id'] ?? '';
    $judul = $_POST['judul'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $url = $_POST['url'] ?? '';
    $tipe = $_POST['tipe'] ?? '';

    $stmt = $conn->prepare("UPDATE konten SET judul=?, deskripsi=?, url=?, tipe=? WHERE id=?");
    $stmt->bind_param("ssssi", $judul, $deskripsi, $url, $tipe, $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Konten berhasil diupdate"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal update konten"]);
    }
    $stmt->close();

} elseif ($action == "get") {
    $sql = "SELECT * FROM konten ORDER BY id DESC";
    $result = $conn->query($sql);
    $konten = [];
    while ($row = $result->fetch_assoc()) {
        $konten[] = $row;
    }
    echo json_encode($konten);

} elseif ($action == "delete") {
    $id = $_POST['id'] ?? '';
    if ($id == '') {
        echo json_encode(["success" => false, "message" => "ID tidak diberikan"]);
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM konten WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Konten berhasil dihapus"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menghapus konten"]);
    }
    $stmt->close();

} else {
    echo json_encode(["success" => false, "message" => "Action tidak valid"]);
}

$conn->close();
?>

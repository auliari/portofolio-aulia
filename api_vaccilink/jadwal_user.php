<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // penting agar Flutter bisa akses

$conn = new mysqli("localhost", "root", "", "db_imunisasi");

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi ke database gagal."]);
    exit();
}

$aksi = $_POST['aksi'];
$id_anak = $_POST['id_anak'];

if($aksi == "get_jadwal_anak"){
    $sql = "SELECT ja.nomor_antrian, ja.status, ja.tanggal_imunisasi,
                   mj.nama_imunisasi, mj.lokasi
            FROM jadwal_anak ja
            JOIN master_jadwal mj ON ja.id_master = mj.id_master
            WHERE ja.id_anak = '$id_anak'
            ORDER BY ja.id_jadwal_anak DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    if($data){
        echo json_encode(["success"=>true, "data"=>$data]);
    } else {
        echo json_encode(["success"=>false, "message"=>"Tidak ada jadwal"]);
    }
}
?>

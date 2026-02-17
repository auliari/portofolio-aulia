<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$koneksi = new mysqli("localhost", "root", "", "db_imunisasi");

// ambil jadwal dari database
$result = $koneksi->query("SELECT id_jadwal, nama_imunisasi, tanggal_dijadwalkan as tanggal 
                           FROM jadwal_imunisasi 
                           ORDER BY tanggal_dijadwalkan ASC");

$jadwal = [];
while ($row = $result->fetch_assoc()) {
    $jadwal[] = $row;
}

echo json_encode($jadwal);

$koneksi->close();
?>

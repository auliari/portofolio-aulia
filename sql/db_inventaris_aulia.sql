-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 09:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris_aulia`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_spesifikasi` varchar(255) NOT NULL,
  `barang_lokasi` varchar(255) NOT NULL,
  `barang_kondisi` varchar(255) NOT NULL,
  `barang_jumlah` int(11) NOT NULL,
  `barang_sumber_dana` varchar(255) NOT NULL,
  `barang_keterangan` text NOT NULL,
  `barang_jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_nama`, `barang_spesifikasi`, `barang_lokasi`, `barang_kondisi`, `barang_jumlah`, `barang_sumber_dana`, `barang_keterangan`, `barang_jenis`) VALUES
(1, 'Gaun Pesta Biru', 'Ukuran M, Satin & payet', 'Lemari A1', 'Baik', 2, 'The Bride Dept', 'Cocok dengan acara formal ', 'Gaun'),
(2, 'Kebaya Kutu Baru Merah', 'Ukuran L, Brokat & batik', 'Lemari B2', 'Baik', 0, 'PT. Trisula Textile Industries Tbk', 'Lengkap dengan selendang', 'Kebaya'),
(3, 'Gaun Pesta Pink', 'Ukuran S, Satin & tile', 'Lemari A2', 'Baik', 3, 'Mels Gown', 'Cocok untuk prom night', 'Gaun'),
(4, 'Kebaya Encim Putih', 'Ukuran M, Katun bordir', 'Lemari B2', 'Baik', 5, 'Puspa Kebaya Tailor', 'Bisa disewa dengan kain batik tambahan', 'Kebaya'),
(5, 'Gaun Mermaid Silver', 'Ukaran L, Full payet', 'Lemari A1', 'Baik', 2, 'Kravela House', 'Model mermaid, body fit, elegan', 'Gaun '),
(9, 'Kebaya Batik Parang', 'Kombinasi kain batik parang & Bordir emas', 'Lemari B2', 'Baik', 0, 'Puspa Kebaya Tailor', 'Elegan untuk acara budaya & formal', 'Kebaya'),
(10, 'Luna Pearl Dress', 'Brokat mewah, ekor panjang, Warna champagne', 'Lemari A1', 'Baik', 2, 'Mels Gown', 'Cocok untuk pesta', 'Gaun'),
(12, 'Kebaya Bali Kuning', 'Ukuran XL, Katun sutra', 'Lemari B2', 'Baik', 0, 'Butik Batik Kebaya Indonesia', 'Sangat nyaman, cocok untuk acara non-resmi', 'Kebaya');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `bk_id` int(11) NOT NULL,
  `bk_id_barang` int(11) NOT NULL,
  `bk_nama_barang` varchar(255) NOT NULL,
  `bk_tgl_keluar` date NOT NULL,
  `bk_jumlah_keluar` int(11) NOT NULL,
  `bk_lokasi` varchar(255) NOT NULL,
  `bk_penerima` varchar(255) NOT NULL,
  `bk_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`bk_id`, `bk_id_barang`, `bk_nama_barang`, `bk_tgl_keluar`, `bk_jumlah_keluar`, `bk_lokasi`, `bk_penerima`, `bk_keterangan`) VALUES
(1, 1, 'Gaun Pesta Biru', '2025-01-17', 1, 'Jl Semeru No. 22 Kota Bekasi', 'Jihan', 'Untuk pre-wedding'),
(2, 2, 'Kebaya Kutu Baru Merah', '2025-02-04', 1, 'Jl Tlaga Arwana No. 25 Kabupaten Malang', 'Ian', 'Untuk menghadiri undangan pernikahan'),
(3, 3, 'Gaun Pesta Pink', '2024-12-31', 1, 'Jl Merpati No. 14 Kabupaten Magelang', 'Lisa', 'Untuk prom night'),
(4, 4, 'Kebaya Encim Putih', '2025-01-08', 2, 'Jl Duren No. 10 Kota Semarang', 'Lia', 'Untuk pemotretan'),
(5, 5, 'Gaun Mermaid Silver', '2025-02-03', 2, 'Jl Sawit No. 77 Kota Karawang', 'Joy', 'Untuk acara ulang tahun'),
(6, 1, 'Gaun Pesta Biru', '2025-01-17', 1, 'Jl Cibodas 2 Kota Bandung', 'Soya', 'Untuk perayaan setelah wisuda'),
(7, 2, 'Kebaya Kutu Baru Merah', '2025-02-13', 1, 'Jl Merah Putih No. 17 Kota Jakarta', 'Jennie', 'Untuk wisuda'),
(8, 3, 'Gaun Pesta Pink', '2025-01-18', 1, 'Jl Merpati Putih No. 99 Kota Karawaci', 'Mark', 'Untuk pesta perusahaan'),
(9, 4, 'Kebaya Encim Putih', '2025-02-14', 2, 'Jl Rambutan No. 20 Kota Solo', 'Mai', 'Untuk photoshoot'),
(10, 5, 'Gaun Mermaid Silver', '2025-02-08', 1, 'Jl Anggrek No. 28 Kabupaten Semarang', 'Aisha', 'Untuk pesta perayaan besar keluarga'),
(16, 2, 'Kebaya Kutu Baru Merah', '2025-04-01', 1, 'Jl Kartini No. 22 Kota Surabaya', 'Justin', 'Untuk event fashion'),
(17, 5, 'Gaun Mermaid Silver', '2025-04-05', 1, 'Jl. Dewi Sartika No. 16 Kota Bandung', 'Sara', 'Untuk engagement party'),
(18, 1, 'Gaun Pesta Biru', '2025-04-02', 1, 'Lemari A1', 'Steve', 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `bm_id` int(11) NOT NULL,
  `bm_id_barang` int(11) NOT NULL,
  `bm_nama_barang` varchar(255) NOT NULL,
  `bm_tgl_masuk` date NOT NULL,
  `bm_jumlah` int(11) NOT NULL,
  `bm_id_suplier` int(11) NOT NULL,
  `bm_nama_suplier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`bm_id`, `bm_id_barang`, `bm_nama_barang`, `bm_tgl_masuk`, `bm_jumlah`, `bm_id_suplier`, `bm_nama_suplier`) VALUES
(1, 1, 'Gaun Pesta Biru', '2024-11-02', 1, 5, 'The Bride Dept'),
(2, 2, 'Kebaya Kutu Baru Merah', '2024-11-03', 2, 3, 'PT. Trisula Textile Industries Tbk'),
(3, 3, 'Gaun Pesta Pink', '2024-11-04', 1, 1, 'Mels Gown'),
(4, 4, 'Kebaya Encim Putih', '2024-11-05', 2, 4, 'Puspa Kebaya Tailor'),
(5, 5, 'Gaun Mermaid Silver', '2025-02-06', 2, 2, 'Kravela House '),
(6, 1, 'Gaun Pesta Biru', '2025-02-07', 1, 5, 'The Bride Dept'),
(7, 2, 'Kebaya Kutu Baru Merah', '2025-02-08', 1, 3, 'PT. Trisula Textile Industries Tbk'),
(8, 3, 'Gaun Pesta Pink', '2025-02-09', 2, 1, 'Mels Gown'),
(9, 4, 'Kebaya Encim Putih', '2025-02-10', 3, 4, 'Puspa Kebaya Tailor'),
(10, 5, 'Gaun Mermaid Silver', '2025-02-11', 2, 2, 'Kravela House '),
(11, 9, 'Kebaya Batik Parang', '2025-04-16', 2, 4, 'Puspa Kebaya Tailor'),
(12, 10, 'Luna Pearl Dress', '2025-04-16', 3, 1, 'Mels Gown'),
(13, 12, 'Kebaya Bali Kuning', '2025-04-16', 3, 8, 'Batik Kebaya Indonesia'),
(18, 2, 'Kebaya Kutu Baru Merah', '2025-04-10', 1, 3, 'PT. Trisula Textile Industries Tbk'),
(19, 5, 'Gaun Mermaid Silver', '2025-04-04', 1, 1, 'Mels Gown'),
(20, 5, 'Gaun Mermaid Silver', '2025-04-16', 1, 2, 'Kravela House ');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `pinjam_id` int(11) NOT NULL,
  `pinjam_peminjam` varchar(255) NOT NULL,
  `pinjam_barang` int(11) NOT NULL,
  `pinjam_jumlah` int(11) NOT NULL,
  `pinjam_tgl_pinjam` date NOT NULL,
  `pinjam_tgl_kembali` date NOT NULL,
  `pinjam_kondisi` varchar(255) NOT NULL,
  `pinjam_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`pinjam_id`, `pinjam_peminjam`, `pinjam_barang`, `pinjam_jumlah`, `pinjam_tgl_pinjam`, `pinjam_tgl_kembali`, `pinjam_kondisi`, `pinjam_status`) VALUES
(1, 'Sana', 1, 1, '2025-01-17', '2025-01-24', 'Baik', 'Kembali'),
(2, 'Mina', 2, 1, '2025-02-04', '2025-02-11', 'Baik', 'Dipinjam'),
(3, 'Anna', 3, 1, '2024-12-24', '2024-12-31', 'Baik', 'Kembali'),
(4, 'Ella', 4, 2, '2025-02-01', '2025-02-08', 'Baik', 'Dipinjam'),
(5, 'Stella', 5, 2, '2024-12-30', '2025-02-03', 'Baik', 'Kembali'),
(6, 'Liz', 10, 1, '2025-04-15', '2025-04-22', 'Baik', 'Dipinjam'),
(7, 'Adeline', 2, 1, '2025-04-23', '2025-04-29', 'Baik', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(255) NOT NULL,
  `suplier_alamat` varchar(255) NOT NULL,
  `suplier_telepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_telepon`) VALUES
(1, 'Mels Gown', 'Jl Mangga Besar No 17 Kabupaten Malang', '089123456789'),
(2, 'Kravela House ', 'Jl Vena Jati 20 Kota Malang', '081234567891'),
(3, 'PT. Trisula Textile Industries Tbk', 'Jl. Mahar Martanegara No. 170, Cimahi, Jawa Barat', '(022) 661 3333'),
(4, 'Puspa Kebaya Tailor', 'Jl. Imam Bonjol No. 261, Pemecutan Klod, Denpasar Barat, Bali 80113', '089876543212'),
(5, 'The Bride Dept', 'Jl Damai No. 111 Kabupaten Purbalingga', '081098765432'),
(8, 'Butik Batik Kebaya Indonesia', 'Jl. Diponegoro No. 12, Kabupaten Tuban, Jawa Timur 62351', '082338880506');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) NOT NULL,
  `user_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`, `user_level`) VALUES
(1, 'Giselle', 'aerigiselle', 'b4b147bc522828731f1a016bfa72c073', 'giselle.jpg', '2'),
(2, 'Jay', 'jaypark', 'b4b147bc522828731f1a016bfa72c073', 'jay.jpg', '2'),
(3, 'Irene', 'baeirene', 'b4b147bc522828731f1a016bfa72c073', 'irene.jpg', '1'),
(5, 'Yuna', 'shimyuna', 'b4b147bc522828731f1a016bfa72c073', 'yuna.jpg', '2'),
(7, 'Wendy', 'wendyson', 'b4b147bc522828731f1a016bfa72c073', 'wendy.jpg', '1'),
(8, 'Karina', 'karinayo', 'b4b147bc522828731f1a016bfa72c073', 'karina.jpg', '2'),
(9, 'Joshua', 'joshuahong', 'b4b147bc522828731f1a016bfa72c073', 'joshua.jpg', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`bk_id`),
  ADD KEY `fk_barang_keluar_barang` (`bk_id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`bm_id`),
  ADD KEY `fk_barang` (`bm_id_barang`),
  ADD KEY `fk_suplier` (`bm_id_suplier`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`pinjam_id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `bm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `pinjam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `fk_barang_keluar_barang` FOREIGN KEY (`bk_id_barang`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `fk_barang` FOREIGN KEY (`bm_id_barang`) REFERENCES `barang` (`barang_id`),
  ADD CONSTRAINT `fk_suplier` FOREIGN KEY (`bm_id_suplier`) REFERENCES `suplier` (`suplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

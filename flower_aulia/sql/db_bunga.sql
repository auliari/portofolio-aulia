-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 03:43 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bunga`
--

-- --------------------------------------------------------

--
-- Table structure for table `bunga`
--

CREATE TABLE `bunga` (
  `id` int(100) NOT NULL,
  `transaksi_id` int(100) NOT NULL,
  `bunga` varchar(100) NOT NULL,
  `bunga_jumlah` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bunga`
--

INSERT INTO `bunga` (`id`, `transaksi_id`, `bunga`, `bunga_jumlah`) VALUES
(1, 1, 'Daisy', 15),
(4, 10, 'Daisy', 3),
(6, 12, 'Anyelir', 12),
(9, 15, 'Daisy', 10);

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `harga_per_ikat` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`harga_per_ikat`) VALUES
(51000),
(51000);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `user_id`, `nama`, `email`, `no_hp`, `pesan`, `rating`, `foto`) VALUES
(1, 3, 'jeno', 'jeno05@gmail.com', '08912345678', 'Terima kasih admin atas pelayanannya yang luar biasa! Bunganya benar-benar cantik, segar, dan sesuai dengan yang saya inginkan 🌺. Adminnya ramah dan responsif.Pasti bakal jadi langganan di sini! 💐', 4, 'jeno.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(100) NOT NULL,
  `bunga` varchar(100) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `bunga`, `detail`, `gambar`) VALUES
(1, 'Daisy', 'Bunga daisy dengan bentuk klasik dan warna cantik cocok untuk hadiah istimewa atau dekorasi yang indah.', 'daisy.jpg'),
(6, 'Iris', 'Iris adalah bunga elegan dengan kelopak unik dan warna memikat, ideal untuk menciptakan suasana yang anggun.', 'iris.jpg'),
(7, 'Hyacinth', 'Hyacinth, bunga dengan bentuk ramping dan kelopak yang tersusun rapi, menjadikannya sempurna untuk hadiah spesial.', 'hyacinth.jpg'),
(8, 'Anggrek', 'Dengan kelopak yang anggun dan beragam warna, anggrek menjadi pilihan sempurna untuk hadiah istimewa atau dekorasi elegan.', 'anggrek-removebg-preview.png'),
(9, 'Hydrangea', 'Hydrangea adalah bunga indah dengan kelopak berwarna cerah, pilihan sempurna untuk hadiah atau hiasan ruangan agar lebih indah.', 'hydrangea.jpg'),
(11, 'Mawar', 'Bunga yang melambangkan cinta, sangat populer untuk berbagai kesempatan seperti hadiah, dekorasi, hingga acara spesial.', 'roses-removebg-preview.png'),
(14, 'Tulip', 'Tulip adalah bunga elegan dengan kelopak indah.Cocok untuk hadiah atau dekorasi, melambangkan kasih sayang dan harapan.', 'tulip.jpg'),
(16, 'Anyelir', 'Bunga anggun dengan kelopak berlapis, melambangkan cinta dan kekaguman. Tersedia berbagai warna. Cocok untuk hadiah atau dekorasi elegan.', 'anyelir.jpg'),
(17, 'Bunga Matahari', 'Dengan kelopak kuning cerah, bunga ini cocok untuk menyampaikan kebahagiaan dan semangat kepada orang tersayang. ', 'sunflower.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(100) NOT NULL,
  `transaksi_tgl` date NOT NULL,
  `user_id` int(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `transaksi_harga` int(100) NOT NULL,
  `transaksi_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tgl`, `user_id`, `jumlah`, `transaksi_harga`, `transaksi_status`) VALUES
(1, '2024-12-01', 3, 2, 100000, 0),
(10, '2024-12-01', 7, 2, 100000, 1),
(11, '2024-12-01', 5, 2, 100000, 3),
(12, '2024-12-03', 4, 3, 150000, 1),
(15, '2024-12-07', 3, 2, 102000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `no_hp`, `email`, `password`, `user_type`, `alamat`) VALUES
(1, 'Kai', 856789012, 'kaii1@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'admin', 'jalan melati indah no 02 bekasi'),
(2, 'Irene', 823456789, 'rene90@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'admin', 'jalan merdeka raya no 11 bekasi'),
(3, 'Jeno', 12345679, 'jeno05@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'user', 'jalan cendrawasih no 25 surabaya'),
(4, 'Yeri', 123456790, 'yerim1@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'user', 'jalan merpati putih no 14 jakarta selatan'),
(5, 'Aeri', 890123458, 'aeri12@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'user', ' jalan soekarno hatta no 08 bandung'),
(7, 'Mark', 812398766, 'mark13@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'user', 'jalan nusa indah no 13 bali'),
(8, 'Karina', 812345673, 'karinaa2@gmail.com', 'b4b147bc522828731f1a016bfa72c073', 'admin', ' jalan permata indah no 17 tangerang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bunga`
--
ALTER TABLE `bunga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bunga`
--
ALTER TABLE `bunga`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

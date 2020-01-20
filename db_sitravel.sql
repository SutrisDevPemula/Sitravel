-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 04:36 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sitravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_agentravel`
--

CREATE TABLE `tb_agentravel` (
  `Id_agen` char(50) NOT NULL,
  `Nama_prusahaan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `No_telp` char(30) NOT NULL,
  `E-mail` varchar(50) NOT NULL,
  `Foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_agentravel`
--

INSERT INTO `tb_agentravel` (`Id_agen`, `Nama_prusahaan`, `Alamat`, `No_telp`, `E-mail`, `Foto`) VALUES
('123412', 'Mataram Travel', 'Jl.Ismail Marzukih', '0987698768', 'TravelMataram@gmail.com', 'No Foto'),
('12345', 'Dunia Trvel', 'Jl.penjanggik', '087654323456', 'Travel_Dunia@gmail.com', 'no Foto'),
('728749', 'Salma Travel', 'Mataram, Jl. Ismail Marzukih', '081909090100', 'Salma.Travel@gmail.com', ''),
('90738', 'Sinta Travel', 'Mataram, Jl. Penjanggik Selaparang', '098777113400', 'SintaTravel@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_costumer`
--

CREATE TABLE `tb_costumer` (
  `Ktp` char(30) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `No_telp` char(12) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `Foto` text NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_costumer`
--

INSERT INTO `tb_costumer` (`Ktp`, `Nama`, `Alamat`, `No_telp`, `e_mail`, `Foto`, `Password`) VALUES
('098349384', 'Sutrisno', 'Mataram, Jl. Ade Irma Suryani', '85338994864', 'sutris032@gmail.com', 'asset/Upload/Costumer/5e1eb5a63e77b.jpeg', '$2y$10$PsoxIlnA6HDhoDvecG//fOvl1/1erW9w9XqCc/ReBr.MgliiUmw5S'),
('364982392392', 'Yudi Setiawan Anjasmara', 'Mataram', '85338994890', 'yudi@gmail.com', 'asset/Upload/Costumer/5e1eb5a63e77b.jpeg', '$2y$10$JVMueiQjIPY8nj8ztWyULOAyHBgM.ISyE9VhmyGhdHP66XzP/ZRfC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hotel`
--

CREATE TABLE `tb_hotel` (
  `Id_hotel` char(50) NOT NULL,
  `Nama_hotel` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `bintang` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `harga` double NOT NULL,
  `fasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hotel`
--

INSERT INTO `tb_hotel` (`Id_hotel`, `Nama_hotel`, `Alamat`, `bintang`, `gambar`, `harga`, `fasilitas`) VALUES
('123', 'Tentrem', 'Lengkong, Yogyakarta', 5, 'tentrem.jpg', 500000, 'Wifi'),
('6473', 'Pesona', 'Merdeka, Bandung', 5, 'pesona.jpg', 1500000, 'Wifi, Makan'),
('84457', 'PAPA BETO', 'Dago Atas, Bandung', 4, 'papbeto.jpg', 800000, 'Wifi'),
('8943', 'Royal Tulip', 'Dewi Sartika, Jakarta', 3, 'tulip.png', 500000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `Id_lokasi` char(50) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Tarif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`Id_lokasi`, `Deskripsi`, `Tarif`) VALUES
('52.01.01', 'Kecamatan Gerung, Kabupaten Lombok Barat, Nusa Tenggara Barat', 60000),
('52.01.02', 'Kecamatan Kediri, Kabupaten Lombok Barat, Nusa Tenggara Barat', 55000),
('52.01.03', 'Kecamatan Narmada, Kabupaten Lombok Barat, Nusa Tenggara Barat', 58000),
('52.01.07', 'Kecamatan Sekotong, Kabupaten Lombok Barat, Nusa Tenggara Barat', 45000),
('52.01.08', 'Kecamatan Labu Api, Kabupaten Lombok Barat, Nusa Tenggara Barat', 67000),
('52.01.09', 'Kecamatan Gunung Sari, Kabupaten Lombok Barat, Nusa Tenggara Barat', 60000),
('52.01.12', 'Kecamatan Lingsar, Kabupaten Lombok Barat, Nusa Tenggara Barat', 70000),
('52.01.13', 'Kecamatan Lembar, Kabupaten Lombok Barat, Nusa Tenggara Barat', 88000),
('52.01.14', 'Kecamatan Batu Layar, Kabupaten Lombok Barat, Nusa Tenggara Barat', 57000),
('52.01.15', 'Kecamatan Kuripan, Kabupaten Lombok Barat, Nusa Tenggara Barat', 66000),
('52.02.01', 'Kecamatan Praya, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 90000),
('52.02.02', 'Kecamatan Jonggat, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 34000),
('52.02.03', 'Kecamatan Batukliang, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 55000),
('52.02.04', 'Kecamatan Pujut, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 67000),
('52.02.05', 'Kecamatan Praya Barat, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 56000),
('52.02.06', 'Kecamatan Praya Timur, Kabupaten Lombok Tengah, Nusa Tenggara Barat', 87000),
('52.03.01', 'Kecamatan Keruak, Kabupaten Lombok Timur, Nusa Tenggara Barat', 150000),
('52.03.02', 'Kecamatan Sakra, Kabupaten Lombok Timur, Nusa Tenggara Barat', 70000),
('52.03.03', 'Kecamatan Terara, Kabupaten Lombok Timur, Nusa Tenggara Barat', 80000),
('52.03.04', 'Kecamatan Sikur, Kabupaten Lombok Timur, Nusa Tenggara Barat', 70000),
('52.03.05', 'Kecamatan Masbagik, Kabupaten Lombok Timur, Nusa Tenggara Barat', 55000),
('52.03.06', 'Kecamatan Sukamulia, Kabupaten Lombok Timur, Nusa Tenggara Barat', 57000),
('52.03.07', 'Kecamatan Selong, Kabupaten Lombok Timur, Nusa Tenggara Barat', 55000),
('52.03.08', 'Kecamatan Pringgabaya, Kabupaten Lombok Timur, Nusa Tenggara Barat', 170000),
('52.03.09', 'Kecamatan Aikmel, Kabupaten Lombok Timur, Nusa Tenggara Barat', 60000),
('52.03.10', 'Kecamatan Sambelia, Kabupaten Lombok Timur, Nusa Tenggara Barat', 60000),
('52.03.11', 'Kecamatan Montong Gading, Kabupaten Lombok Timur, Nusa Tenggara Barat', 67000),
('52.08.01', 'Kecamatan Tanjung, Kabupaten Lombok Utara, Nusa Tenggara Barat', 55000),
('52.08.02', 'Kecamatan Gangga, Kabupaten Lombok Utara, Nusa Tenggara Barat', 70000),
('52.08.03', 'Kecamatan Kayangan, Kabupaten Lombok Utara, Nusa Tenggara Barat', 60000),
('52.08.04', 'Kecamatan Bayan, Kabupaten Lombok Utara, Nusa Tenggara Barat', 77000),
('52.08.05', 'Kecamatan Pemenang, Kabupaten Lombok Utara, Nusa Tenggara Barat', 65000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_paketwisata`
--

CREATE TABLE `tb_paketwisata` (
  `Id_paket` char(50) NOT NULL,
  `Gambar` text NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Id_hotel` char(50) NOT NULL,
  `Alamat` text NOT NULL,
  `Biaya` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_paketwisata`
--

INSERT INTO `tb_paketwisata` (`Id_paket`, `Gambar`, `Nama`, `Deskripsi`, `Id_hotel`, `Alamat`, `Biaya`) VALUES
('1234', 'meno.jpg', 'Paket wisata ke Gili meno', 'Gili meno adalah sebuah tempat wisata populer yang ada di pulau lombok', '123', 'Lombok Utara', 400000),
('8934', 'no Image', 'Paket wisata gili trawangan', 'destinasi alam di kabupaten lomok utara', '6473', 'Mataram', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `Id_tagihan` char(100) NOT NULL,
  `Id_transaksi` char(50) NOT NULL,
  `biaya_hotel` double NOT NULL,
  `Harga_jemput` double NOT NULL,
  `Total_bayar` double NOT NULL,
  `Status_bayar` char(50) NOT NULL,
  `Bukti_pembayaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`Id_tagihan`, `Id_transaksi`, `biaya_hotel`, `Harga_jemput`, `Total_bayar`, `Status_bayar`, `Bukti_pembayaran`) VALUES
('5E24B1FEC12B5', '5E24B1FD83C8A', 1000000, 180000, 1180000, 'Payred', '../asset/Upload/BuktiBayar/5e250cb721bee.jpeg'),
('5E24B22DAB64E', '5E24B22C0F518', 1000000, 174000, 1174000, 'Unpayred', ''),
('5E250BD19211A', '5E250BC96506A', 1000000, 68000, 1068000, 'Payred', '../asset/Upload/BuktiBayar/5e250ccde9cf1.jpeg'),
('5E250DE411065', '5E250DDF704F9', 1000000, 120000, 1120000, 'Payred', '../asset/Upload/BuktiBayar/5e250ec3ed6a3.jpeg'),
('5E251E0E71CE8', '5E251E08F4179', 4500000, 116000, 4616000, 'Payred', '../asset/Upload/BuktiBayar/5e251f757cd54.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `Id_transaksi` char(50) NOT NULL,
  `Ktp` char(30) NOT NULL,
  `Id_paket` char(50) NOT NULL,
  `Tgl_pesan` char(50) NOT NULL,
  `Tgl_berakhir` char(50) NOT NULL,
  `Id_lokasi` char(50) NOT NULL,
  `Durasi` int(11) NOT NULL,
  `Total_pengunjung` int(11) NOT NULL,
  `status_Pemesanan` varchar(100) NOT NULL,
  `Id_agen` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`Id_transaksi`, `Ktp`, `Id_paket`, `Tgl_pesan`, `Tgl_berakhir`, `Id_lokasi`, `Durasi`, `Total_pengunjung`, `status_Pemesanan`, `Id_agen`) VALUES
('5E24B1FD83C8A', '364982392392', '1234', '2020-01-20', '2020-01-22', '52.02.01', 2, 1, 'menunggu', '123412'),
('5E24B22C0F518', '098349384', '1234', '2020-01-20', '2020-01-22', '52.02.06', 2, 2, 'menunggu', '123412'),
('5E250BC96506A', '364982392392', '1234', '2020-01-20', '2020-01-22', '52.02.02', 2, 2, 'menunggu', '12345'),
('5E250DDF704F9', '364982392392', '1234', '2020-01-20', '2020-01-22', '52.01.01', 2, 2, 'menunggu', '728749'),
('5E2510CB74251', '364982392392', '1234', '2020-01-20', '2020-01-22', '52.01.01', 2, 5, 'menunggu', '123412'),
('5E251E08F4179', '364982392392', '8934', '2020-01-20', '2020-01-23', '52.01.03', 3, 3, 'menunggu', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agentravel`
--
ALTER TABLE `tb_agentravel`
  ADD PRIMARY KEY (`Id_agen`);

--
-- Indexes for table `tb_costumer`
--
ALTER TABLE `tb_costumer`
  ADD PRIMARY KEY (`Ktp`);

--
-- Indexes for table `tb_hotel`
--
ALTER TABLE `tb_hotel`
  ADD PRIMARY KEY (`Id_hotel`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`Id_lokasi`);

--
-- Indexes for table `tb_paketwisata`
--
ALTER TABLE `tb_paketwisata`
  ADD PRIMARY KEY (`Id_paket`),
  ADD KEY `Id_hotel` (`Id_hotel`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`Id_tagihan`),
  ADD KEY `Id_transaksi` (`Id_transaksi`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`Id_transaksi`),
  ADD KEY `Id_agen` (`Id_agen`),
  ADD KEY `Ktp` (`Ktp`),
  ADD KEY `Id_paket` (`Id_paket`),
  ADD KEY `Id_lokasi` (`Id_lokasi`),
  ADD KEY `Id_lokasi_2` (`Id_lokasi`),
  ADD KEY `Id_lokasi_3` (`Id_lokasi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_paketwisata`
--
ALTER TABLE `tb_paketwisata`
  ADD CONSTRAINT `tb_paketwisata_ibfk_1` FOREIGN KEY (`Id_hotel`) REFERENCES `tb_hotel` (`Id_hotel`);

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`Id_transaksi`) REFERENCES `tb_pemesanan` (`Id_transaksi`);

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `tb_pemesanan_ibfk_1` FOREIGN KEY (`Id_agen`) REFERENCES `tb_agentravel` (`Id_agen`),
  ADD CONSTRAINT `tb_pemesanan_ibfk_2` FOREIGN KEY (`Id_paket`) REFERENCES `tb_paketwisata` (`Id_paket`),
  ADD CONSTRAINT `tb_pemesanan_ibfk_3` FOREIGN KEY (`Ktp`) REFERENCES `tb_costumer` (`Ktp`),
  ADD CONSTRAINT `tb_pemesanan_ibfk_4` FOREIGN KEY (`Id_lokasi`) REFERENCES `tb_lokasi` (`Id_lokasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2020 at 10:22 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm-new`
--

-- --------------------------------------------------------

--
-- Table structure for table `binaan`
--

CREATE TABLE `binaan` (
  `id_binaan` int(11) NOT NULL,
  `nama_binaan` varchar(32) NOT NULL,
  `lokasi_binaan` text NOT NULL,
  `keterangan_binaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binaan`
--

INSERT INTO `binaan` (`id_binaan`, `nama_binaan`, `lokasi_binaan`, `keterangan_binaan`) VALUES
(1, 'DS Point', 'Putat Jaya', ''),
(2, 'Umum', '-', ''),
(3, 'Puja', 'Putat jaya', ''),
(4, 'SOP Bulak', 'Bulak', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(32) NOT NULL,
  `keterangan_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`) VALUES
(1, 'Makanan', ''),
(2, 'Minuman', ''),
(3, 'Acc dan Kerajinan', ''),
(4, 'Pakaian', ''),
(5, 'Batik', ''),
(6, 'Sepatu', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(45) DEFAULT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `produksi_produk` int(11) DEFAULT NULL,
  `satuan_produk` varchar(45) DEFAULT NULL,
  `kategori_produk` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `status_produk` int(11) NOT NULL DEFAULT '0',
  `stok_produk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `foto_produk`, `harga_produk`, `produksi_produk`, `satuan_produk`, `kategori_produk`, `id_umkm`, `status_produk`, `stok_produk`) VALUES
(5, 'orumi', '2_orumi_foto_produk.jpeg', 10000, 12312, 'botol', 1, 2, 1, 0),
(6, 'bakwan telo', '2_bakwan_telo_foto_produk.jpeg', 15000, 0, '150', 1, 2, 0, 0),
(7, 'bakwan telo ver2 ', '2_bakwan_telo_ver2__foto_produk.jpeg', 15000, 125, 'botol', 1, 2, 1, 0),
(8, 'jepit rambut', '4_jepit_rambut_foto_produk.jpeg', 15000, 1500, 'mangkok', 1, 4, 1, 0),
(9, 'Kain Jurik', '5_Kain_Jurik_foto_produk.jpeg', 150000, 10, 'lembar', 4, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id_purchase` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang_purchase` int(11) NOT NULL,
  `harga_satuan_barang_purchase` int(11) NOT NULL,
  `harga_total_purchase` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis_purchase` varchar(2) NOT NULL,
  `tanggal_purchase` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id_purchase`, `id_barang`, `jumlah_barang_purchase`, `harga_satuan_barang_purchase`, `harga_total_purchase`, `id_transaksi`, `jenis_purchase`, `tanggal_purchase`) VALUES
(1, 7, 2, 15000, 30000, 1, '-', '2020-09-02 14:15:25'),
(2, 8, 2, 15000, 30000, 1, '-', '2020-09-02 14:15:25'),
(3, 5, 2, 10000, 20000, 1, '-', '2020-09-02 14:15:25'),
(4, 8, 3, 15000, 45000, 2, '-', '2020-09-02 14:19:34'),
(5, 8, 2, 15000, 30000, 4, '-', '2020-09-02 14:25:23'),
(6, 7, 1, 15000, 15000, 4, '-', '2020-09-02 14:25:23'),
(7, 8, 1, 15000, 15000, 4, '-', '2020-09-02 14:25:23'),
(8, 8, 1, 15000, 15000, 4, '-', '2020-09-02 14:25:23'),
(9, 5, 1, 10000, 10000, 5, '-', '2020-09-02 14:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `jenis_transaksi` varchar(8) DEFAULT NULL,
  `harga_total_transaksi` int(11) DEFAULT NULL,
  `keterangan_transaksi` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `jenis_transaksi`, `harga_total_transaksi`, `keterangan_transaksi`, `id_user`) VALUES
(1, '2020-09-02 14:15:25', '-', 80000, 'pembelian', 0),
(2, '2020-09-02 14:19:34', '-', 45000, 'pembelian', 0),
(3, '2020-09-02 14:24:10', '-', 0, 'pembelian', 0),
(4, '2020-09-02 14:25:23', '-', 75000, 'pembelian', 0),
(5, '2020-09-02 14:26:30', '-', 10000, 'pembelian', 0);

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL,
  `nama_umkm` varchar(45) DEFAULT NULL,
  `nama_pemilik_umkm` varchar(45) DEFAULT NULL,
  `nik_umkm` varchar(45) DEFAULT NULL,
  `no_hp_umkm` varchar(16) DEFAULT NULL,
  `kategori_umkm` varchar(32) DEFAULT NULL,
  `alamat_ktp_umkm` text,
  `gang_blok_umkm` varchar(32) NOT NULL,
  `rt_umkm` int(11) NOT NULL,
  `rw_umkm` int(11) NOT NULL,
  `kelurahan_umkm` varchar(32) NOT NULL,
  `kecamatan_umkm` varchar(32) NOT NULL,
  `no_rumah_umkm` varchar(8) NOT NULL,
  `jenis_izin_usaha_umkm` varchar(16) DEFAULT NULL,
  `omset_perbulan_umkm` int(11) DEFAULT NULL,
  `tahun_berdiri_umkm` int(11) DEFAULT NULL,
  `binaan_umkm` int(11) NOT NULL,
  `foto_pemilik_umkm` varchar(255) DEFAULT NULL,
  `foto_ktp_pemilik_umkm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id_umkm`, `nama_umkm`, `nama_pemilik_umkm`, `nik_umkm`, `no_hp_umkm`, `kategori_umkm`, `alamat_ktp_umkm`, `gang_blok_umkm`, `rt_umkm`, `rw_umkm`, `kelurahan_umkm`, `kecamatan_umkm`, `no_rumah_umkm`, `jenis_izin_usaha_umkm`, `omset_perbulan_umkm`, `tahun_berdiri_umkm`, `binaan_umkm`, `foto_pemilik_umkm`, `foto_ktp_pemilik_umkm`) VALUES
(1, 'ukm maju', 'juned', '352153153413', '085858585858585', '1', '7', 'lumayan', 6, 0, 'jeruk', 'apel', '5', 'siup', 500000, 1993, 2, '352153153413_ukm_maju_foto_pemilik_umkm.jpeg', '352153153413_ukm_maju_foto_ktp_pemilik_umkm.jpeg'),
(2, 'ukm mundur', 'parno', '3252351251242641', '08548452862155', '1', 'jauh bgt', 'kutilang', 2, 2, 'jeruk', 'apel', '02', 'siup', 5000000, 1996, 2, '3252351251242641_ukm_mundur_foto_pemilik_umkm.jpeg', '3252351251242641_ukm_mundur_foto_ktp_pemilik_umkm.jpeg'),
(4, 'umkm coba coba tok ', 'yudi', '35751248496700025', '0858585858', '1', 'pagesangan ', '2', 4, 3, 'pagesangan', 'jambangan', '02', 'siup', 1400000, 2015, 1, '35751248496700025_umkm_coba_coba__foto_pemilik_umkm.jpeg', '35751248496700025_umkm_coba_coba__foto_ktp_pemilik_umkm.jpeg'),
(5, 'umkm sejahtera bos', 'sanjo', '35782152523205220', '0858585858585', '4', 'putat jaya gede', '05', 6, 3, 'Putat jaya', 'Sawahan', '05', '-', 4000000, 2015, 1, '35782152523205220_umkm_sejahtera_foto_pemilik_umkm.jpeg', '35782152523205220_umkm_sejahtera_foto_ktp_pemilik_umkm.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `password_user` text NOT NULL,
  `role_user` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password_user`, `role_user`) VALUES
(1, 'test', '01cfcd4f6b8770febfb40cb906715822', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binaan`
--
ALTER TABLE `binaan`
  ADD PRIMARY KEY (`id_binaan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binaan`
--
ALTER TABLE `binaan`
  MODIFY `id_binaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

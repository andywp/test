-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Mei 2019 pada 03.34
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duiro-indogo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` varchar(10) NOT NULL,
  `barang` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_kode`, `barang`, `stok`, `satuan`) VALUES
(1, 'BRG-001', 'SOLAR', 220, 'Liter'),
(5, 'BRG-002', 'PREMIUM', 50, 'Liter'),
(6, 'BRG-003', 'Minyak Tan', 210, 'Liter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cek`
--

CREATE TABLE `cek` (
  `cek_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `jenis` enum('Terima','Tolak') NOT NULL,
  `jumlah_terima` varchar(12) NOT NULL DEFAULT '0',
  `jumlah_sisa` varchar(12) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `tanggal_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cek`
--

INSERT INTO `cek` (`cek_id`, `pembelian_id`, `jenis`, `jumlah_terima`, `jumlah_sisa`, `keterangan`, `tanggal_terima`) VALUES
(4, 2, 'Terima', '50', '50', '', '2019-05-12'),
(5, 4, 'Terima', '20', '180', '', '2019-05-13'),
(6, 4, 'Tolak', '', '180', 'tidak sesuai', '2019-05-13'),
(7, 4, 'Terima', '180', '0', '', '2019-05-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `po` varchar(20) NOT NULL,
  `permintaan_no` varchar(20) NOT NULL,
  `tanggal_po` date NOT NULL,
  `barang_kode` varchar(100) NOT NULL,
  `tanggal_permintaan` date NOT NULL,
  `barang` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `harga_satuan` varchar(12) NOT NULL,
  `total_haraga` varchar(12) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`pembelian_id`, `po`, `permintaan_no`, `tanggal_po`, `barang_kode`, `tanggal_permintaan`, `barang`, `supplier`, `jumlah`, `harga_satuan`, `total_haraga`, `status`) VALUES
(2, 'PO/19/05/12/001', 'PER/19/05/12/001', '2019-05-12', 'BRG-001', '2019-05-12', 'SOLAR', 'Pertamina', '100 Liter', '8000', '800000', 0),
(3, 'PO/19/05/13/001', 'PER/19/05/12/001', '2019-05-13', 'BRG-001', '2019-05-12', 'SOLAR', 'Pertamina', '100 Liter', '8000', '800000', 0),
(4, 'PO/19/05/13/001', 'PER/19/05/13/001', '2019-05-13', 'BRG-003', '2019-05-13', 'Minyak Tan', 'Agen', '200 Liter', '10000', '2000000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `pengeluaran_id` int(11) NOT NULL,
  `no_pengeluaran` varchar(18) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `permintaan_dari` varchar(100) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`pengeluaran_id`, `no_pengeluaran`, `tanggal_pengajuan`, `barang_id`, `jumlah_permintaan`, `permintaan_dari`, `tanggal_pengeluaran`, `status`) VALUES
(1, 'PGL/19/05/12/001', '2019-05-12', 1, 10, 'andy', '0000-00-00', ''),
(2, 'PGL/19/05/12/002', '2019-05-12', 1, 10, 'andy', '0000-00-00', ''),
(3, 'PGL/19/05/13/001', '2019-05-13', 1, 10, 'andy', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `permintaan_id` int(11) NOT NULL,
  `permintaan_no` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `barang_id` int(11) NOT NULL,
  `permintaan_jumlah` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`permintaan_id`, `permintaan_no`, `tanggal`, `barang_id`, `permintaan_jumlah`, `status`, `approve`) VALUES
(1, 'PER/19/05/12/001', '2019-05-12', 1, '100', 0, 0),
(2, 'PER/19/05/13/001', '2019-05-13', 6, '200', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier`, `barang_id`, `harga`) VALUES
(1, 'Pertamina', 5, '8000'),
(2, 'Pertamina', 1, '8000'),
(3, 'Agen', 6, '10000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `cek`
--
ALTER TABLE `cek`
  ADD PRIMARY KEY (`cek_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`pengeluaran_id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`permintaan_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cek`
--
ALTER TABLE `cek`
  MODIFY `cek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `pengeluaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `permintaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

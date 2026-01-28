-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 07:24 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat_perizinan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `id_penduduk`, `password`, `username`) VALUES
(1, 1, 1, 'ahmadf', 'ahmadf'),
(2, 2, 2, 'budis', 'budis'),
(3, 3, 3, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik`, `nama_lengkap`, `alamat`, `no_telp`, `email`) VALUES
(1, '1234567890123456', 'Ahmad Fauzi', 'Jl. Merdeka No. 1', '081234567890', 'ahmad@example.com'),
(2, '2345678901234567', 'Budi Santoso', 'Jl. Sudirman No. 2', '081234567891', 'budi@example.com'),
(3, '3456789012345678', 'Dewi Lestari', 'Jl. Gatot Subroto No. 3', '081234567892', 'dewi@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengesahan_sk`
--

CREATE TABLE `pengesahan_sk` (
  `id_pengesahan` int(11) NOT NULL,
  `id_sk` int(11) DEFAULT NULL,
  `tanggal_pengesahan` date NOT NULL,
  `created_at_pengesahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengesahan_sk`
--

INSERT INTO `pengesahan_sk` (`id_pengesahan`, `id_sk`, `tanggal_pengesahan`, `created_at_pengesahan`) VALUES
(1, 1, '2024-05-20', '2024-05-20'),
(2, 2, '2024-05-21', '2024-05-21'),
(6, 1, '2024-06-07', '2024-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_sk`
--

CREATE TABLE `permohonan_sk` (
  `id_surat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `jenis_permohonan` enum('Kepemilikan Tanah','Perizinan Usaha') NOT NULL,
  `keterangan` text,
  `tanggal_permohonan` date NOT NULL,
  `status` enum('Diajukan','Disetujui','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permohonan_sk`
--

INSERT INTO `permohonan_sk` (`id_surat`, `id_user`, `id_penduduk`, `jenis_permohonan`, `keterangan`, `tanggal_permohonan`, `status`) VALUES
(1, 1, 1, 'Kepemilikan Tanah', 'Permohonan surat kepemilikan tanah untuk lahan A', '2024-05-01', 'Diajukan'),
(2, 2, 2, 'Perizinan Usaha', 'Permohonan surat izin usaha untuk Toko B', '2024-05-02', 'Disetujui'),
(3, 1, 1, 'Perizinan Usaha', 'Permohonan surat izin usaha untuk Warung C', '2024-05-03', 'Diajukan');

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan_permohonan`
--

CREATE TABLE `persetujuan_permohonan` (
  `id_persetujuan` int(11) NOT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_approval` date NOT NULL,
  `status_persetujuan` enum('disetujui','ditolak') NOT NULL,
  `catatan` text,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persetujuan_permohonan`
--

INSERT INTO `persetujuan_permohonan` (`id_persetujuan`, `id_surat`, `id_user`, `tanggal_approval`, `status_persetujuan`, `catatan`, `created_at`) VALUES
(6, 2, 2, '2024-06-07', 'disetujui', 'Permohonan disetujui', '2024-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `sk_disahkan`
--

CREATE TABLE `sk_disahkan` (
  `id_sk_disahkan` int(11) NOT NULL,
  `id_pengesahan` int(11) NOT NULL,
  `tanggal_disahkan` date NOT NULL,
  `upload_sk_disahkan` varchar(255) DEFAULT NULL,
  `created_at_disahkan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sk_disahkan`
--

INSERT INTO `sk_disahkan` (`id_sk_disahkan`, `id_pengesahan`, `tanggal_disahkan`, `upload_sk_disahkan`, `created_at_disahkan`) VALUES
(1, 1, '2024-06-04', 'Doc11.pdf', '2024-06-04'),
(14, 2, '2024-06-07', '5503-SOAL UAS PA INDO.pdf', '2024-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `sk_disetujui`
--

CREATE TABLE `sk_disetujui` (
  `id_sk` int(11) NOT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `nomor_sk` varchar(255) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `created_at_disetujui` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sk_disetujui`
--

INSERT INTO `sk_disetujui` (`id_sk`, `id_surat`, `nomor_sk`, `tanggal_sk`, `created_at_disetujui`) VALUES
(1, 1, 'SK-001', '2024-05-15', '2024-05-15'),
(2, 3, 'SK-002', '2024-05-16', '2024-05-15'),
(3, 2, 'SK-003', '2024-06-07', '2024-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tanah`
--

CREATE TABLE `surat_tanah` (
  `id_surat_tanah` int(11) NOT NULL,
  `id_penduduk` varchar(100) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `model_tanah` varchar(100) DEFAULT NULL,
  `nomor_buku` varchar(50) DEFAULT NULL,
  `nomor_letter_c` varchar(50) DEFAULT NULL,
  `nomor_model_d` varchar(50) DEFAULT NULL,
  `nomor_model_e` varchar(50) DEFAULT NULL,
  `nomor_situasi` varchar(50) DEFAULT NULL,
  `nomor_hak_milik` varchar(50) DEFAULT NULL,
  `nomor_ukur` varchar(50) DEFAULT NULL,
  `nomor_persil` varchar(50) DEFAULT NULL,
  `luas_tanah` varchar(50) DEFAULT NULL,
  `batas_utara` varchar(255) DEFAULT NULL,
  `batas_timur` varchar(255) DEFAULT NULL,
  `batas_selatan` varchar(255) DEFAULT NULL,
  `batas_barat` varchar(255) DEFAULT NULL,
  `penggunaan_tanah` varchar(255) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_tanah`
--

INSERT INTO `surat_tanah` (`id_surat_tanah`, `id_penduduk`, `umur`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `model_tanah`, `nomor_buku`, `nomor_letter_c`, `nomor_model_d`, `nomor_model_e`, `nomor_situasi`, `nomor_hak_milik`, `nomor_ukur`, `nomor_persil`, `luas_tanah`, `batas_utara`, `batas_timur`, `batas_selatan`, `batas_barat`, `penggunaan_tanah`, `tanggal_surat`, `created_at`) VALUES
(2, '2', 26, 'Anjir Serapat', '2024-06-23', 'Jl. Banjarmasin', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '2024-06-01', '2024-06-23'),
(3, '2', 26, 'Banjarmasin', '2024-06-24', 'Jl. Sudirman No. 2', '100', '12.010/DP-KM/IX/2019', '110', '120', '130', '140', '150', '200', '210', '220', '230', '240', '250', '260', 'Jasa Sewa', '2024-06-24', '2024-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `surat_usaha`
--

CREATE TABLE `surat_usaha` (
  `id_surat_usaha` int(11) NOT NULL,
  `nomor_surat` varchar(50) DEFAULT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `tempat_tanggal_lahir` varchar(100) DEFAULT NULL,
  `alamat_tempat_tinggal` varchar(255) DEFAULT NULL,
  `jenis_usaha` varchar(100) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_usaha`
--

INSERT INTO `surat_usaha` (`id_surat_usaha`, `nomor_surat`, `id_penduduk`, `tempat_tanggal_lahir`, `alamat_tempat_tinggal`, `jenis_usaha`, `created_at`) VALUES
(1, 'SN/KB/100/001/2024', 2, 'Banjar, 13 Okt 2024', 'Jl. Banjarmasin Utara', 'Pertokoan Beras', '2024-06-23'),
(2, 'SN/KB/100/002/2024', 3, 'Banjarmasin, 11 Oktober 1997', 'Jl. Tatah Amuntai Banjarmasin', 'Jual beli bibit ikan', '2024-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('penduduk','pejabat') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `role`, `username`, `password`) VALUES
(1, 'Ahmad Fauzi', 'ahmad@example.com', 'penduduk', 'fauzi', 'fauzi'),
(2, 'Budi Santoso', 'budi@example.com', 'penduduk', 'budi', 'budi'),
(3, 'Admin', 'admin@example.com', 'pejabat', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pengesahan_sk`
--
ALTER TABLE `pengesahan_sk`
  ADD PRIMARY KEY (`id_pengesahan`),
  ADD KEY `id_sk` (`id_sk`);

--
-- Indexes for table `permohonan_sk`
--
ALTER TABLE `permohonan_sk`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `persetujuan_permohonan`
--
ALTER TABLE `persetujuan_permohonan`
  ADD PRIMARY KEY (`id_persetujuan`),
  ADD KEY `id_surat` (`id_surat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sk_disahkan`
--
ALTER TABLE `sk_disahkan`
  ADD PRIMARY KEY (`id_sk_disahkan`),
  ADD KEY `id_sk` (`id_pengesahan`);

--
-- Indexes for table `sk_disetujui`
--
ALTER TABLE `sk_disetujui`
  ADD PRIMARY KEY (`id_sk`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `surat_tanah`
--
ALTER TABLE `surat_tanah`
  ADD PRIMARY KEY (`id_surat_tanah`);

--
-- Indexes for table `surat_usaha`
--
ALTER TABLE `surat_usaha`
  ADD PRIMARY KEY (`id_surat_usaha`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pengesahan_sk`
--
ALTER TABLE `pengesahan_sk`
  MODIFY `id_pengesahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `permohonan_sk`
--
ALTER TABLE `permohonan_sk`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `persetujuan_permohonan`
--
ALTER TABLE `persetujuan_permohonan`
  MODIFY `id_persetujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sk_disahkan`
--
ALTER TABLE `sk_disahkan`
  MODIFY `id_sk_disahkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sk_disetujui`
--
ALTER TABLE `sk_disetujui`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surat_tanah`
--
ALTER TABLE `surat_tanah`
  MODIFY `id_surat_tanah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surat_usaha`
--
ALTER TABLE `surat_usaha`
  MODIFY `id_surat_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`);

--
-- Constraints for table `pengesahan_sk`
--
ALTER TABLE `pengesahan_sk`
  ADD CONSTRAINT `pengesahan_sk_ibfk_1` FOREIGN KEY (`id_sk`) REFERENCES `sk_disetujui` (`id_sk`);

--
-- Constraints for table `permohonan_sk`
--
ALTER TABLE `permohonan_sk`
  ADD CONSTRAINT `permohonan_sk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `permohonan_sk_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`);

--
-- Constraints for table `persetujuan_permohonan`
--
ALTER TABLE `persetujuan_permohonan`
  ADD CONSTRAINT `persetujuan_permohonan_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `permohonan_sk` (`id_surat`),
  ADD CONSTRAINT `persetujuan_permohonan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `sk_disahkan`
--
ALTER TABLE `sk_disahkan`
  ADD CONSTRAINT `sk_disahkan_ibfk_1` FOREIGN KEY (`id_pengesahan`) REFERENCES `sk_disetujui` (`id_sk`);

--
-- Constraints for table `sk_disetujui`
--
ALTER TABLE `sk_disetujui`
  ADD CONSTRAINT `sk_disetujui_ibfk_1` FOREIGN KEY (`id_surat`) REFERENCES `permohonan_sk` (`id_surat`);

--
-- Constraints for table `surat_usaha`
--
ALTER TABLE `surat_usaha`
  ADD CONSTRAINT `surat_usaha_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

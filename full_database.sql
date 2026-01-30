-- Database: surat_perizinan
-- Full Schema & Seed Data

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'penduduk'),
(3, 'jagabaya'),
(4, 'ulu-ulu'),
(5, 'lurah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','penduduk','jagabaya','ulu-ulu','lurah') NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user` (Default Admin)
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `role`, `id_role`) VALUES
(1, 'Administrator', 'admin@desa.id', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE IF NOT EXISTS `penduduk` (
  `id_penduduk` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_user` (`id_user`),
  KEY `id_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login` (Default Admin: admin / 123)
--

INSERT INTO `login` (`id_login`, `username`, `password`, `id_user`, `id_penduduk`) VALUES
(1, 'admin', '$2y$10$GNv9US/r.n07Rv7xZLcfieGoLVzggsCp2ChaCN0I2/w/wzF.w9K', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_sk`
--

CREATE TABLE IF NOT EXISTS `permohonan_sk` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_penduduk` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `status` enum('menunggu_staff','disetujui_staff','ditolak_staff','disahkan_lurah','ditolak_lurah') NOT NULL DEFAULT 'menunggu_staff',
  `catatan_staff` text DEFAULT NULL,
  `catatan_lurah` text DEFAULT NULL,
  PRIMARY KEY (`id_surat`),
  KEY `id_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;

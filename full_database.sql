-- Database: surat_perizinan
-- Full Schema & Seed Data (8 Tables per ERD Revision)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- 1. Table: roles (Helper for User roles, kept for logic but not counted as main entity if client excludes attempts, but needed for App)
-- Client ERD doesn't show 'roles' table explicitly but 'user' has 'role'. 
-- However, 'user' table usually needs a role Enum or FK. I will keep 'roles' as a utility table OR just use ENUM in user table to strictly stick to 8 visual tables? 
-- The user said "Kok tabelnya cuma ada 5? ... ada 8 tabel".
-- The image shows 8 tables. 'roles' IS NOT in the image.
-- 'user' table in image has field 'role'.
-- So I will DROP `roles` table and use ENUM in `user` table to be EXACT.
-- BUT, `login` table needs `id_user` or `id_penduduk`.

-- Wait, the image shows `user` table. 
-- Let's stick to the 8 tables in the image.
-- 1. user
-- 2. login
-- 3. penduduk
-- 4. permohonan_sk
-- 5. persetujuan_permohonan
-- 6. sk_disetujui
-- 7. pengesahan_sk
-- 8. sk_disahkan

-- --------------------------------------------------------

--
-- 1. Table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','jagabaya','ulu-ulu','lurah') NOT NULL, 
  -- Removed 'penduduk' role from here, as residents are in 'penduduk' table?
  -- Legacy logic had 'penduduk' in user roles. 
  -- Diagram separate user and penduduk. 
  -- Let's keep 'admin', 'jagabaya', 'ulu-ulu', 'lurah' here.
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `role`) VALUES
(1, 'Administrator', 'admin@desa.id', 'admin');

-- --------------------------------------------------------

--
-- 2. Table `penduduk`
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
-- 3. Table `login`
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

INSERT INTO `login` (`id_login`, `username`, `password`, `id_user`, `id_penduduk`) VALUES
(1, 'admin', '$2y$10$GNv9US/r.n07Rv7xZLcfieGoLVzggsCp2ChaCN0I2/w/wzF.w9K', 1, NULL);

-- --------------------------------------------------------

--
-- 4. Table `permohonan_sk`
--

CREATE TABLE IF NOT EXISTS `permohonan_sk` (
  `id_surat` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL, -- Nullable as per discussion
  `id_penduduk` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'menunggu_staff',
  PRIMARY KEY (`id_surat`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 5. Table `persetujuan_permohonan`
--

CREATE TABLE IF NOT EXISTS `persetujuan_permohonan` (
  `id_persetujuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL, -- Staff who approved
  `tanggal_approval` date NOT NULL,
  `status` varchar(50) NOT NULL, -- disetujui_staff / ditolak_staff
  `catatan` text DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_persetujuan`),
  KEY `id_surat` (`id_surat`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 6. Table `sk_disetujui`
--

CREATE TABLE IF NOT EXISTS `sk_disetujui` (
  `id_sk` int(11) NOT NULL AUTO_INCREMENT,
  `id_surat` int(11) NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `created_at_disetujui` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_sk`),
  KEY `id_surat` (`id_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 7. Table `pengesahan_sk`
--

CREATE TABLE IF NOT EXISTS `pengesahan_sk` (
  `id_pengesahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_sk` int(11) NOT NULL,
  `tanggal_pengesahan` date NOT NULL,
  `created_at_pengesahan` timestamp NOT NULL DEFAULT current_timestamp(),
  `upload_sk` varchar(255) DEFAULT NULL, -- Draft or Initial file?
  PRIMARY KEY (`id_pengesahan`),
  KEY `id_sk` (`id_sk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 8. Table `sk_disahkan`
--

CREATE TABLE IF NOT EXISTS `sk_disahkan` (
  `id_sk_disahkan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengesahan` int(11) NOT NULL,
  `tanggal_disahkan` date NOT NULL,
  `upload_sk_disahkan` varchar(255) NOT NULL, -- Final file
  `created_at_disahkan` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_sk_disahkan`),
  KEY `id_pengesahan` (`id_pengesahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;

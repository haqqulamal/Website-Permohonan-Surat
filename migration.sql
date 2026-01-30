-- 1. Buat Tabel Login (Pemisahan Auth)
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_user` (`id_user`),
  KEY `id_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Migrasi Data User ke Tabel Login
-- Mengambil username & password dari tabel user dan memindahkannya ke tabel login
INSERT INTO `login` (`username`, `password`, `id_user`)
SELECT `username`, `password`, `id_user` FROM `user` WHERE `username` IS NOT NULL;

-- 3. Hapus Kolom Auth dari Tabel User (Setelah migrasi sukses)
ALTER TABLE `user`
  DROP COLUMN `username`,
  DROP COLUMN `password`,
  DROP COLUMN `id_penduduk`; -- Jika id_penduduk dipindah ke login, hapus dari user. Cek dulu datanya!

-- 4. Update Tabel Permohonan (Mapping Jenis Permohonan)
-- Menambahkan kolom keterangan jika belum ada (biasanya sudah ada, tapi memastikan)
-- ALTER TABLE `permohonan_sk` ADD COLUMN `keterangan` TEXT NULL;

-- Memindahkan data jenis_permohonan ke keterangan (Jika data lama ingin disimpan di keterangan)
-- UPDATE `permohonan_sk` SET `keterangan` = CONCAT(`jenis_permohonan`, ' - ', COALESCE(`keterangan`, ''));

-- Hapus kolom jenis_permohonan
ALTER TABLE `permohonan_sk` DROP COLUMN `jenis_permohonan`;

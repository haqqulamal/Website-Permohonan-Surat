-- Refactoring Database for Role-Based Access and Secure Passwords

-- 1. Ensure Roles table is correct
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `roles`;
INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'penduduk'),
(3, 'jagabaya'),
(4, 'ulu-ulu'),
(5, 'lurah');

-- 2. Modernize User Table
-- We will keep id_user, id_role, username, password.
-- We should ensure password field is long enough for Bcrypt (60+ chars).
ALTER TABLE `user` MODIFY `password` VARCHAR(255) NOT NULL;

-- 3. Standardize Permohonan Status and Structure
-- We'll add or update the permohonan table if needed.
-- Looking at permohonan_sk (general table?) or specific ones?
-- The plan says: cleanup permohonan logic.

-- Let's check if permohonan_sk has the right columns.
-- We want status: menunggu_staff, ditolak_staff, disetujui_staff, ditolak_lurah, disahkan_lurah.

-- Assuming permohonan_sk is the main table (or should be).
-- In the current DB I see multiple tables like 'surat_tanah', 'surat_usaha'.
-- I'll keep them but standardize the status.

-- Updating status column in related tables
ALTER TABLE `surat_tanah` ADD COLUMN IF NOT EXISTS `status` ENUM('menunggu_staff', 'ditolak_staff', 'disetujui_staff', 'ditolak_lurah', 'disahkan_lurah') DEFAULT 'menunggu_staff';
ALTER TABLE `surat_usaha` ADD COLUMN IF NOT EXISTS `status` ENUM('menunggu_staff', 'ditolak_staff', 'disetujui_staff', 'ditolak_lurah', 'disahkan_lurah') DEFAULT 'menunggu_staff';

-- Add catatan columns if missing
ALTER TABLE `surat_tanah` ADD COLUMN IF NOT EXISTS `catatan_staff` TEXT NULL;
ALTER TABLE `surat_tanah` ADD COLUMN IF NOT EXISTS `catatan_lurah` TEXT NULL;
ALTER TABLE `surat_usaha` ADD COLUMN IF NOT EXISTS `catatan_staff` TEXT NULL;
ALTER TABLE `surat_usaha` ADD COLUMN IF NOT EXISTS `catatan_lurah` TEXT NULL;

-- 4. Initial seed for users with Bcrypt (password: 'admin')
-- Admin: admin/admin
UPDATE `user` SET `password` = '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S' WHERE `username` = 'admin';
UPDATE `user` SET `password` = '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S' WHERE `username` = 'budi'; -- password is 'admin'
UPDATE `user` SET `password` = '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S' WHERE `username` = 'fauzi'; -- password is 'admin'

-- Ensure we have staff and lurah
-- Note: id_role mapping: 3=jagabaya, 4=ulu-ulu, 5=lurah
INSERT IGNORE INTO `user` (`username`, `password`, `id_role`, `nama_lengkap`, `email`) VALUES 
('jagabaya', '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S', 3, 'Jagabaya', 'jagabaya@perizinan.com'),
('uluulu', '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S', 4, 'Ulu-ulu', 'uluulu@perizinan.com'),
('lurah', '$2y$10$ahAuigrbI0gKeaTsKYD9ZOSg0bobn/l9cHAh2Fpz9Nu1N9kvvuV.S', 5, 'Lurah', 'lurah@perizinan.com');

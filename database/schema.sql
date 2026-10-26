-- Database: `project_perpus`
-- Perpustakaan-in-OOP Database Schema & Seed Data

CREATE DATABASE IF NOT EXISTS `project_perpus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `project_perpus`;

-- --------------------------------------------------------
-- Table structure for table `login_user`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `login_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL COMMENT 'Base64 encoded password',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `penerbit`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `penerbit` (
  `penerbitID` VARCHAR(20) NOT NULL,
  `penerbit` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`penerbitID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `buku`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `buku` (
  `bukuID` VARCHAR(20) NOT NULL,
  `judul` VARCHAR(150) NOT NULL,
  `penerbitID` VARCHAR(20) NOT NULL,
  `pengarang` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`bukuID`),
  KEY `fk_buku_penerbit` (`penerbitID`),
  CONSTRAINT `fk_buku_penerbit` FOREIGN KEY (`penerbitID`) REFERENCES `penerbit` (`penerbitID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- View structure for view `view_buku`
-- --------------------------------------------------------
CREATE OR REPLACE VIEW `view_buku` AS 
SELECT 
  `b`.`bukuID` AS `bukuID`,
  `b`.`judul` AS `judul`,
  `p`.`penerbit` AS `penerbit`,
  `b`.`pengarang` AS `pengarang`
FROM `buku` `b`
LEFT JOIN `penerbit` `p` ON `b`.`penerbitID` = `p`.`penerbitID`;

-- --------------------------------------------------------
-- Seed Data for table `login_user`
-- Default credential: admin / admin (Base64: YWRtaW4=)
-- --------------------------------------------------------
INSERT INTO `login_user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'YWRtaW4=')
ON DUPLICATE KEY UPDATE `username`=`username`;

-- --------------------------------------------------------
-- Seed Data for table `penerbit`
-- --------------------------------------------------------
INSERT INTO `penerbit` (`penerbitID`, `penerbit`) VALUES
('P001', 'Informatika Bandung'),
('P002', 'Elex Media Komputindo'),
('P003', 'Gramedia Pustaka Utama')
ON DUPLICATE KEY UPDATE `penerbit`=`penerbit`;

-- --------------------------------------------------------
-- Seed Data for table `buku`
-- --------------------------------------------------------
INSERT INTO `buku` (`bukuID`, `judul`, `penerbitID`, `pengarang`) VALUES
('B001', 'Pemrograman Web dengan PHP & MySQL', 'P001', 'Budi Raharjo'),
('B002', 'Mastering Object Oriented PHP', 'P002', 'Fauzan L'),
('B003', 'Struktur Data dan Algoritma', 'P003', 'Rinaldi Munir')
ON DUPLICATE KEY UPDATE `judul`=`judul`;

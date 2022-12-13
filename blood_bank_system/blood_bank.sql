-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for blood_bank
CREATE DATABASE IF NOT EXISTS `blood_bank` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `blood_bank`;

-- Dumping structure for table blood_bank.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `b_group` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nic` (`nic`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table blood_bank.patient: ~10 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT IGNORE INTO `patient` (`id`, `name`, `address`, `city`, `nic`, `contact`, `b_group`) VALUES
	(1, 'Amal', '134,galle rd,madiha', 'matara', '865741345V', '0718543245', 'A+'),
	(2, 'Kamal', 'asda, dasdao, qq', 'qera', '432741345V', '0718543345', 'O-'),
	(3, 'Isuru', 'ewfwf', 'sad', '34534643', '241341', 'O-'),
	(4, 'Saman', '544,delkanda', 'colombo', '8732002V', '9324234', 'B-'),
	(9, 'Lakal', 'ujasdsa', 'jowd', '82u43', '23423', 'B+'),
	(16, 'Lakal', 'asd', 'dsad', '', '9324234', 'AB+'),
	(23, 'Sunil', 'ndfjsnf', 'galle', '90312312', '9012123', 'A-'),
	(27, 'Kasun', '34,dsfsd,ryhr', 'ampara', '32490123', '123452', 'AB-'),
	(32, 'rajiv', '23,kada,dqwe', 'galle', '91212312', '123101', 'O-'),
	(39, 'Siyum', 'oijdsfj', 'okaosd', '32432', '3012', 'A+'),
	(53, 'asdas', 'dasdas', 'sadas', '1232135', '23423', 'O+');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table blood_bank.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table blood_bank.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
	(1, 'g', 'g', '$2y$10$Knq.hsQZ6T4Nh.4akDp5OeC5LlXmr4BH7j9vpcl7b5T8812CdoFEO'),
	(30, 'helili', 'h', '$2y$10$TKNY4m5rfcREDhU6VNBQLephFDXac.0lRVMFHfecVINk4HPLxP4Ny');

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

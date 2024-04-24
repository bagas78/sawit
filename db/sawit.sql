-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 11:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sawit`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `absen_id` int(11) NOT NULL,
  `absen_karyawan` int(11) DEFAULT NULL,
  `absen_upah` text DEFAULT NULL,
  `absen_jam` time DEFAULT NULL,
  `absen_tanggal` date DEFAULT NULL,
  `absen_status` enum('masuk','tidak') DEFAULT NULL,
  `absen_bayar` enum('sudah','belum') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`absen_id`, `absen_karyawan`, `absen_upah`, `absen_jam`, `absen_tanggal`, `absen_status`, `absen_bayar`) VALUES
(34, 2, '55000', '11:46:42', '2024-03-12', 'masuk', 'belum'),
(35, 2, '55000', '11:46:42', '2024-04-12', 'masuk', 'belum'),
(36, 2, '55000', '11:46:42', '2024-05-12', 'masuk', 'belum'),
(37, 3, '70000', '11:53:57', '2024-03-12', 'masuk', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

CREATE TABLE `t_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_kode` text NOT NULL,
  `bank_nama` text NOT NULL,
  `bank_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bank`
--

INSERT INTO `t_bank` (`bank_id`, `bank_kode`, `bank_nama`, `bank_tanggal`) VALUES
(1, '002', 'BANK BRI', '2022-11-30'),
(2, '003', 'BANK EKSPOR INDONESIA', '2022-11-30'),
(3, '008', 'BANK MANDIRI', '2022-11-30'),
(4, '009', 'BANK BNI', '2022-11-30'),
(5, '427', 'BANK BNI SYARIAH', '2022-11-30'),
(6, '011', 'BANK DANAMON', '2022-11-30'),
(7, '013', 'PERMATA BANK', '2022-11-30'),
(8, '014', 'BANK BCA', '2022-11-30'),
(9, '016', 'BANK BII', '2022-11-30'),
(10, '019', 'BANK PANIN', '2022-11-30'),
(11, '020', 'BANK ARTA NIAGA KENCANA', '2022-11-30'),
(12, '022', 'BANK NIAGA', '2022-11-30'),
(13, '023', 'BANK BUANA IND', '2022-11-30'),
(14, '026', 'BANK LIPPO', '2022-11-30'),
(15, '028', 'BANK NISP', '2022-11-30'),
(16, '030', 'AMERICAN EXPRESS BANK LTD', '2022-11-30'),
(17, '031', 'CITIBANK N.A.', '2022-11-30'),
(18, '032', 'JP. MORGAN CHASE BANK, N.A.', '2022-11-30'),
(19, '033', 'BANK OF AMERICA, N.A', '2022-11-30'),
(20, '034', 'ING INDONESIA BANK', '2022-11-30'),
(21, '036', 'BANK MULTICOR TBK.', '2022-11-30'),
(22, '037', 'BANK ARTHA GRAHA', '2022-11-30'),
(23, '039', 'BANK CREDIT AGRICOLE INDOSUEZ', '2022-11-30'),
(24, '040', 'THE BANGKOK BANK COMP. LTD', '2022-11-30'),
(25, '041', 'THE HONGKONG & SHANGHAI B.C.', '2022-11-30'),
(26, '042', 'THE BANK OF TOKYO MITSUBISHI UFJ LTD', '2022-11-30'),
(27, '045', 'BANK SUMITOMO MITSUI INDONESIA', '2022-11-30'),
(28, '046', 'BANK DBS INDONESIA', '2022-11-30'),
(29, '047', 'BANK RESONA PERDANIA', '2022-11-30'),
(30, '048', 'BANK MIZUHO INDONESIA', '2022-11-30'),
(31, '050', 'STANDARD CHARTERED BANK', '2022-11-30'),
(32, '052', 'BANK ABN AMRO', '2022-11-30'),
(33, '053', 'BANK KEPPEL TATLEE BUANA', '2022-11-30'),
(34, '054', 'BANK CAPITAL INDONESIA, TBK.', '2022-11-30'),
(35, '057', 'BANK BNP PARIBAS INDONESIA', '2022-11-30'),
(36, '058', 'BANK UOB INDONESIA', '2022-11-30'),
(37, '059', 'KOREA EXCHANGE BANK DANAMON', '2022-11-30'),
(38, '060', 'RABOBANK INTERNASIONAL INDONESIA', '2022-11-30'),
(39, '061', 'ANZ PANIN BANK', '2022-11-30'),
(40, '067', 'DEUTSCHE BANK AG.', '2022-11-30'),
(41, '068', 'BANK WOORI INDONESIA', '2022-11-30'),
(42, '069', 'BANK OF CHINA LIMITED', '2022-11-30'),
(43, '076', 'BANK BUMI ARTA', '2022-11-30'),
(44, '087', 'BANK EKONOMI', '2022-11-30'),
(45, '088', 'BANK ANTARDAERAH', '2022-11-30'),
(46, '089', 'BANK HAGA', '2022-11-30'),
(47, '093', 'BANK IFI', '2022-11-30'),
(48, '095', 'BANK CENTURY, TBK.', '2022-11-30'),
(49, '097', 'BANK MAYAPADA', '2022-11-30'),
(50, '110', 'BANK JABAR', '2022-11-30'),
(51, '111', 'BANK DKI', '2022-11-30'),
(52, '112', 'BPD DIY', '2022-11-30'),
(53, '113', 'BANK JATENG', '2022-11-30'),
(54, '114', 'BANK JATIM', '2022-11-30'),
(55, '115', 'BPD JAMBI', '2022-11-30'),
(56, '116', 'BPD ACEH', '2022-11-30'),
(57, '117', 'BANK SUMUT', '2022-11-30'),
(58, '118', 'BANK NAGARI', '2022-11-30'),
(59, '119', 'BANK RIAU', '2022-11-30'),
(60, '120', 'BANK SUMSEL', '2022-11-30'),
(61, '121', 'BANK LAMPUNG', '2022-11-30'),
(62, '122', 'BPD KALSEL', '2022-11-30'),
(63, '123', 'BPD KALIMANTAN BARAT', '2022-11-30'),
(64, '124', 'BPD KALTIM', '2022-11-30'),
(65, '125', 'BPD KALTENG', '2022-11-30'),
(66, '126', 'BPD SULSEL', '2022-11-30'),
(67, '127', 'BANK SULUT', '2022-11-30'),
(68, '128', 'BPD NTB', '2022-11-30'),
(69, '129', 'BPD BALI', '2022-11-30'),
(70, '130', 'BANK NTT', '2022-11-30'),
(71, '131', 'BANK MALUKU', '2022-11-30'),
(72, '132', 'BPD PAPUA', '2022-11-30'),
(73, '133', 'BANK BENGKULU', '2022-11-30'),
(74, '134', 'BPD SULAWESI TENGAH', '2022-11-30'),
(75, '135', 'BANK SULTRA', '2022-11-30'),
(76, '145', 'BANK NUSANTARA PARAHYANGAN', '2022-11-30'),
(77, '146', 'BANK SWADESI', '2022-11-30'),
(78, '147', 'BANK MUAMALAT', '2022-11-30'),
(79, '151', 'BANK MESTIKA', '2022-11-30'),
(80, '152', 'BANK METRO EXPRESS', '2022-11-30'),
(81, '153', 'BANK SHINTA INDONESIA', '2022-11-30'),
(82, '157', 'BANK MASPION', '2022-11-30'),
(83, '159', 'BANK HAGAKITA', '2022-11-30'),
(84, '161', 'BANK GANESHA', '2022-11-30'),
(85, '162', 'BANK WINDU KENTJANA', '2022-11-30'),
(86, '164', 'HALIM INDONESIA BANK', '2022-11-30'),
(87, '166', 'BANK HARMONI INTERNATIONAL', '2022-11-30'),
(88, '167', 'BANK KESAWAN', '2022-11-30'),
(89, '200', 'BANK TABUNGAN NEGARA (PERSERO)', '2022-11-30'),
(90, '212', 'BANK HIMPUNAN SAUDARA 1906, TBK .', '2022-11-30'),
(91, '213', 'BANK TABUNGAN PENSIUNAN NASIONAL', '2022-11-30'),
(92, '405', 'BANK SWAGUNA', '2022-11-30'),
(93, '422', 'BANK JASA ARTA', '2022-11-30'),
(94, '426', 'BANK MEGA', '2022-11-30'),
(95, '427', 'BANK JASA JAKARTA', '2022-11-30'),
(96, '441', 'BANK BUKOPIN', '2022-11-30'),
(97, '451', 'BANK SYARIAH MANDIRI', '2022-11-30'),
(98, '459', 'BANK BISNIS INTERNASIONAL', '2022-11-30'),
(99, '466', 'BANK SRI PARTHA', '2022-11-30'),
(100, '472', 'BANK JASA JAKARTA', '2022-11-30'),
(101, '484', 'BANK BINTANG MANUNGGAL', '2022-11-30'),
(102, '485', 'BANK BUMIPUTERA', '2022-11-30'),
(103, '490', 'BANK YUDHA BHAKTI', '2022-11-30'),
(104, '491', 'BANK MITRANIAGA', '2022-11-30'),
(105, '494', 'BANK AGRO NIAGA', '2022-11-30'),
(106, '498', 'BANK INDOMONEX', '2022-11-30'),
(107, '501', 'BANK ROYAL INDONESIA', '2022-11-30'),
(108, '503', 'BANK ALFINDO', '2022-11-30'),
(109, '506', 'BANK SYARIAH MEGA', '2022-11-30'),
(110, '513', 'BANK INA PERDANA', '2022-11-30'),
(111, '517', 'BANK HARFA', '2022-11-30'),
(112, '520', 'PRIMA MASTER BANK', '2022-11-30'),
(113, '521', 'BANK PERSYARIKATAN INDONESIA', '2022-11-30'),
(114, '525', 'BANK AKITA', '2022-11-30'),
(115, '526', 'LIMAN INTERNATIONAL BANK', '2022-11-30'),
(116, '531', 'ANGLOMAS INTERNASIONAL BANK', '2022-11-30'),
(117, '523', 'BANK DIPO INTERNATIONAL', '2022-11-30'),
(118, '535', 'BANK KESEJAHTERAAN EKONOMI', '2022-11-30'),
(119, '536', 'BANK UIB', '2022-11-30'),
(120, '542', 'BANK ARTOS IND', '2022-11-30'),
(121, '547', 'BANK PURBA DANARTA', '2022-11-30'),
(122, '548', 'BANK MULTI ARTA SENTOSA', '2022-11-30'),
(123, '553', 'BANK MAYORA', '2022-11-30'),
(124, '555', 'BANK INDEX SELINDO', '2022-11-30'),
(125, '566', 'BANK VICTORIA INTERNATIONAL', '2022-11-30'),
(126, '558', 'BANK EKSEKUTIF', '2022-11-30'),
(127, '559', 'CENTRATAMA NASIONAL BANK', '2022-11-30'),
(128, '562', 'BANK FAMA INTERNASIONAL', '2022-11-30'),
(129, '564', 'BANK SINAR HARAPAN BALI', '2022-11-30'),
(130, '567', 'BANK HARDA', '2022-11-30'),
(131, '945', 'BANK FINCONESIA', '2022-11-30'),
(132, '946', 'BANK MERINCORP', '2022-11-30'),
(133, '947', 'BANK MAYBANK INDOCORP', '2022-11-30'),
(134, '948', 'BANK OCBC – INDONESIA', '2022-11-30'),
(135, '949', 'BANK CHINA TRUST INDONESIA', '2022-11-30'),
(136, '950', 'BANK COMMONWEALTH', '2022-11-30'),
(137, '425', 'BANK BJB SYARIAH', '2022-11-30'),
(138, '688', 'BPR KS (KARYAJATNIKA SEDAYA)', '2022-11-30'),
(139, '789', 'INDOSAT DOMPETKU', '2022-11-30'),
(140, '911', 'TELKOMSEL TCASH', '2022-11-30'),
(141, '911', 'LINKAJA', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `t_barang`
--

CREATE TABLE `t_barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` text NOT NULL,
  `barang_kategori` text NOT NULL,
  `barang_stok` text NOT NULL DEFAULT '0',
  `barang_nama` text NOT NULL,
  `barang_satuan` text NOT NULL,
  `barang_tanggal` date NOT NULL DEFAULT curdate(),
  `barang_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_barang`
--

INSERT INTO `t_barang` (`barang_id`, `barang_kode`, `barang_kategori`, `barang_stok`, `barang_nama`, `barang_satuan`, `barang_tanggal`, `barang_hapus`) VALUES
(1, 'KB001', '1', '150', 'Pisifera', '1', '2024-04-18', 0),
(2, 'KB002', '1', '85', 'Dura', '1', '2024-04-18', 0),
(3, 'KB003', '1', '0', 'Tenera', '1', '2024-04-18', 0),
(4, 'KB004', '2', '50', 'NPK PALMO', '1', '2024-04-18', 0),
(5, 'KB005', '2', '25', 'NPK PUKALET', '1', '2024-04-18', 0),
(6, 'KB006', '2', '70', 'NPK KOKA', '1', '2024-04-18', 0),
(7, 'KB007', '2', '0', 'NPK HALEI', '1', '2024-04-18', 0),
(8, 'KB008', '2', '0', 'NPK CORNALET', '1', '2024-04-18', 0),
(9, 'KB009', '2', '0', 'NPK Saraswanti', '1', '2024-04-18', 0),
(10, 'KB0010', '3', '40', 'Gramoxone', '6', '2024-04-18', 0),
(11, 'KB0011', '3', '35', 'Roundup', '6', '2024-04-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_barang_kategori`
--

CREATE TABLE `t_barang_kategori` (
  `barang_kategori_id` int(11) NOT NULL,
  `barang_kategori_menu` text NOT NULL,
  `barang_kategori_nama` text NOT NULL,
  `barang_kategori_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_barang_kategori`
--

INSERT INTO `t_barang_kategori` (`barang_kategori_id`, `barang_kategori_menu`, `barang_kategori_nama`, `barang_kategori_tanggal`) VALUES
(1, 'Sawit', 'sawit', '2023-02-27'),
(2, 'Pupuk', 'pupuk', '2023-02-27'),
(3, 'Pestisida', 'pestisida', '2023-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_user`
--

CREATE TABLE `t_detail_user` (
  `detail_id` int(11) NOT NULL,
  `detail_id_user` int(11) DEFAULT NULL,
  `detail_jabatan` varchar(50) DEFAULT NULL,
  `detail_pendidikan` text DEFAULT NULL,
  `detail_alamat` text DEFAULT NULL,
  `detail_biodata` text DEFAULT NULL,
  `detail_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_detail_user`
--

INSERT INTO `t_detail_user` (`detail_id`, `detail_id_user`, `detail_jabatan`, `detail_pendidikan`, `detail_alamat`, `detail_biodata`, `detail_hapus`) VALUES
(1, 2, 'BOS', '-', 'Pandanarum ', '-', 0),
(12, 3, NULL, NULL, NULL, NULL, 0),
(13, 4, NULL, NULL, NULL, NULL, 1),
(14, 3, NULL, NULL, NULL, NULL, 0),
(15, 4, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_gaji`
--

CREATE TABLE `t_gaji` (
  `gaji_id` int(11) NOT NULL,
  `gaji_karyawan` text NOT NULL,
  `gaji_nominal` text DEFAULT NULL,
  `gaji_keterangan` text DEFAULT NULL,
  `gaji_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_gaji`
--

INSERT INTO `t_gaji` (`gaji_id`, `gaji_karyawan`, `gaji_nominal`, `gaji_keterangan`, `gaji_tanggal`) VALUES
(9, '3', '70000', 'Lunas', '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `t_hutang`
--

CREATE TABLE `t_hutang` (
  `hutang_id` int(11) NOT NULL,
  `hutang_nomor` text DEFAULT NULL,
  `hutang_keterangan` text DEFAULT NULL,
  `hutang_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_hutang`
--

INSERT INTO `t_hutang` (`hutang_id`, `hutang_nomor`, `hutang_keterangan`, `hutang_tanggal`) VALUES
(8, 'PB-130523-1', NULL, NULL),
(9, 'PB-130523-2', NULL, NULL),
(10, 'PB-130523-3', 'DI bayar cash', '2023-05-13'),
(11, 'PB-280723-4', NULL, NULL),
(12, 'PB-280723-5', NULL, NULL),
(13, 'PB-300723-6', NULL, NULL),
(14, 'PB-300723-7', NULL, NULL),
(15, 'PB-300723-8', NULL, NULL),
(16, 'PB-300723-9', NULL, NULL),
(17, 'PB-300723-10', NULL, NULL),
(18, 'PB-300723-11', NULL, NULL),
(19, 'PB-300723-12', NULL, NULL),
(20, 'PB-300723-15', NULL, NULL),
(21, 'PB-300723-17', NULL, NULL),
(22, 'PB-300723-18', NULL, NULL),
(23, 'PB-300723-19', NULL, NULL),
(24, 'PB-300723-20', 'lunas transferr', '2023-08-11'),
(25, 'PB-300723-21', NULL, NULL),
(26, 'PB-300723-22', NULL, NULL),
(27, 'PB-300723-23', NULL, NULL),
(28, 'PB-300723-24', NULL, NULL),
(29, 'PB-300723-25', NULL, NULL),
(30, 'PB-300723-26', 'lunas transfer', '2023-11-08'),
(31, 'PB-300723-27', 'lunas trnsfer', '2023-11-08'),
(32, 'PB-300723-28', 'SUDH DITANDAI LUNAS ', '2023-07-30'),
(33, 'PB-300723-29', 'LUNASTRNSFER', '2023-08-31'),
(34, 'PB-300723-30', NULL, NULL),
(35, 'PB-300723-31', 'tf bca', '2023-09-27'),
(36, 'PB-300723-32', 'SUDAH LUNAS DI TRANSFER ', '2023-09-26'),
(37, 'PB-010823-33', 'LUNAS TF', '2023-11-23'),
(38, 'PB-020823-34', NULL, NULL),
(39, 'PB-040823-36', 'LUNAS TF', '2023-10-26'),
(40, 'PB-060823-39', 'SUDAH LUNAS JAGUNG', '2023-08-29'),
(41, 'PB-100823-44', 'LUNAS TF', '2023-10-26'),
(42, 'PB-120823-45', NULL, NULL),
(43, 'PB-150823-46', NULL, NULL),
(44, 'PB-150823-47', 'tf bca', '2023-10-14'),
(45, 'PB-180823-48', NULL, NULL),
(46, 'PB-180823-49', 'tf bca', '2023-10-14'),
(47, 'PB-250823-50', 'LUNAS TF', '2023-11-11'),
(48, 'PB-250823-51', NULL, NULL),
(49, 'PB-250823-52', 'lunas transfer', '2023-11-08'),
(50, 'PB-250823-53', 'lunas tf bca', '2023-11-02'),
(51, 'PB-260823-54', 'LUNAS TF', '2023-11-10'),
(52, 'PB-260823-55', 'LUNAS TF', '2023-10-26'),
(53, 'PB-290823-56', 'tf bca', '2023-10-14'),
(54, 'PB-030923-57', 'tf bca', '2023-10-14'),
(55, 'PB-030923-58', NULL, NULL),
(56, 'PB-030923-59', 'LUNAS TRANSFER ', '2023-08-24'),
(57, 'PB-050923-60', 'SUDAH LUNAS', '2023-11-05'),
(58, 'PB-050923-61', 'LUNAS TF', '2023-10-26'),
(59, 'PB-070923-62', 'tf bca', '2023-10-14'),
(60, 'PB-070923-63', 'TRANSFER', '2023-11-08'),
(61, 'PB-070923-64', 'TRANSFER BCA', '2023-11-08'),
(62, 'PB-070923-65', 'TRANSFER BCA', '2023-08-11'),
(63, 'PB-070923-66', 'TRANSFER', '2023-08-11'),
(64, 'PB-120923-67', 'LUNAS TF', '2023-10-11'),
(65, 'PB-190923-69', 'TRANSFER BCA', '2023-11-07'),
(66, 'PB-190923-70', 'TF BCA', '2023-11-07'),
(67, 'PB-190923-71', NULL, NULL),
(68, 'PB-190923-72', 'lunas tf ', '2023-10-25'),
(69, 'PB-190923-73', 'LUNAS TF', '2023-11-24'),
(70, 'PB-190923-74', 'LUNAS TF', '2023-11-24'),
(71, 'PB-230923-75', 'TF BCA', '2023-11-07'),
(72, 'PB-230923-76', 'TF BCA', '2023-11-07'),
(73, 'PB-230923-77', 'tf bc ', '2023-09-27'),
(74, 'PB-230923-78', 'TF BCA', '2023-11-07'),
(75, 'PB-230923-79', 'TF BCA', '2023-11-07'),
(76, 'PB-230923-80', 'TRANSFER BCA', '2023-11-10'),
(77, 'PB-250923-81', 'LUNAS TF', '2023-10-23'),
(78, 'PB-250923-82', 'LUNAS TF BCA', '2023-11-23'),
(79, 'PB-250923-83', 'LUNAS TF', '2023-11-23'),
(80, 'PB-300923-84', NULL, NULL),
(81, 'PB-041023-85', 'LUNS TF BCA\r\n', '2023-11-02'),
(82, 'PB-101023-86', NULL, NULL),
(83, 'PB-101023-87', 'LUNAS TF', '2023-10-09'),
(84, 'PB-111023-88', 'total Rp. 6.300.000 sudah  termasuk pajak', '2023-10-07'),
(85, 'PB-121023-89', NULL, NULL),
(86, 'PB-121023-90', NULL, NULL),
(87, 'PB-121023-91', NULL, NULL),
(88, 'PB-191023-95', NULL, NULL),
(89, 'PB-241023-99', NULL, NULL),
(90, 'PB-241023-100', NULL, NULL),
(91, 'PB-311023-102', 'LUNAS TF', '2023-11-13'),
(92, 'PB-311023-103', 'LUNAS TF', '2023-10-15'),
(93, 'PB-311023-104', NULL, NULL),
(94, 'PB-311023-105', NULL, NULL),
(95, 'PB-031123-110', 'LUNAS TF', '2023-10-28'),
(96, 'PB-031123-111', 'lunas transfer', '2023-11-02'),
(97, 'PB-031123-112', NULL, NULL),
(98, 'PB-031123-116', NULL, NULL),
(99, 'PB-051123-124', NULL, NULL),
(100, 'PB-051123-125', NULL, NULL),
(101, 'PB-051123-126', NULL, NULL),
(102, 'PB-051123-127', NULL, NULL),
(103, 'PB-071123-129', NULL, NULL),
(104, 'PB-071123-130', NULL, NULL),
(105, 'PB-071123-131', NULL, NULL),
(106, 'PB-071123-133', NULL, NULL),
(107, 'PB-071123-134', NULL, NULL),
(108, 'PB-091123-135', NULL, NULL),
(109, 'PB-091123-136', NULL, NULL),
(110, 'PB-091123-137', NULL, NULL),
(111, 'PB-151123-146', NULL, NULL),
(112, 'PB-201123-147', NULL, NULL),
(113, 'PB-201123-148', NULL, NULL),
(114, 'PB-201123-149', NULL, NULL),
(115, 'PB-201123-150', NULL, NULL),
(116, 'PB-201123-151', NULL, NULL),
(117, 'PB-231123-156', NULL, NULL),
(118, 'PB-231123-157', NULL, NULL),
(119, 'PB-231123-158', NULL, NULL),
(120, 'PB-261123-159', NULL, NULL),
(121, 'PB-261123-161', NULL, NULL),
(122, 'PB-261123-164', NULL, NULL),
(123, 'PB-261123-165', NULL, NULL),
(124, 'PB-261123-166', NULL, NULL),
(125, 'PB-271123-167', NULL, NULL),
(126, 'PB-271123-168', NULL, NULL),
(127, 'PB-271123-169', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_kode` text NOT NULL,
  `karyawan_pekerjaan` text NOT NULL,
  `karyawan_nama` text NOT NULL,
  `karyawan_alamat` text NOT NULL,
  `karyawan_telp` text NOT NULL,
  `karyawan_kebun` text NOT NULL,
  `karyawan_jenis` enum('b','h') NOT NULL COMMENT 'b = borongan h = harian',
  `karyawan_upah` text NOT NULL,
  `karyawan_tanggal` date NOT NULL DEFAULT curdate(),
  `karyawan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`karyawan_id`, `karyawan_kode`, `karyawan_pekerjaan`, `karyawan_nama`, `karyawan_alamat`, `karyawan_telp`, `karyawan_kebun`, `karyawan_jenis`, `karyawan_upah`, `karyawan_tanggal`, `karyawan_hapus`) VALUES
(2, 'KR001', '3', 'David latumahina', '-', '085855011542', '4', 'h', '55000', '2023-02-25', 0),
(3, 'KR002', '2', 'Mario dandi satrio', '-', '085234567890', '4', 'b', '70000', '2023-02-25', 0),
(4, 'KR003', '1', 'Agnes gracia haryanto', '-', '085676443232', '4', 'b', '70000', '2023-02-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_kebun`
--

CREATE TABLE `t_kebun` (
  `kebun_id` int(11) NOT NULL,
  `kebun_kode` text NOT NULL,
  `kebun_nama` text NOT NULL,
  `kebun_alamat` text NOT NULL,
  `kebun_luas` text NOT NULL,
  `kebun_tanaman` text NOT NULL,
  `kebun_keterangan` text NOT NULL,
  `kebun_tanggal` date NOT NULL DEFAULT curdate(),
  `kebun_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kebun`
--

INSERT INTO `t_kebun` (`kebun_id`, `kebun_kode`, `kebun_nama`, `kebun_alamat`, `kebun_luas`, `kebun_tanaman`, `kebun_keterangan`, `kebun_tanggal`, `kebun_hapus`) VALUES
(4, 'KB001', 'Kebun timur', 'Plumpung rejo', '1000', '2', '-', '2023-05-13', 0),
(5, 'KB002', 'Kebun barat', 'Plumpung rejo', '1500', '1', '-', '2023-05-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_kontak`
--

CREATE TABLE `t_kontak` (
  `kontak_id` int(11) NOT NULL,
  `kontak_jenis` set('s','p') NOT NULL DEFAULT '',
  `kontak_kode` text NOT NULL,
  `kontak_nama` text NOT NULL,
  `kontak_alamat` text NOT NULL,
  `kontak_tlp` text NOT NULL,
  `kontak_bank` text NOT NULL,
  `kontak_rek` text NOT NULL,
  `kontak_tanggal` date NOT NULL DEFAULT curdate(),
  `kontak_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kontak`
--

INSERT INTO `t_kontak` (`kontak_id`, `kontak_jenis`, `kontak_kode`, `kontak_nama`, `kontak_alamat`, `kontak_tlp`, `kontak_bank`, `kontak_rek`, `kontak_tanggal`, `kontak_hapus`) VALUES
(4, 'p', 'PL001', 'Bagas Pramono (pelanggan)', '-', '085855011542', '1', '016601020870538', '2023-02-22', 0),
(57, 's', 'SP0044', 'Bagas Pramono (suplier)', '-', '085855011542', '1', '63767218', '2024-03-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_level`
--

CREATE TABLE `t_level` (
  `level_id` int(11) NOT NULL,
  `level_nama` text DEFAULT NULL,
  `level_notif` text DEFAULT NULL,
  `level_kontak` text DEFAULT NULL,
  `level_gudang` text DEFAULT NULL,
  `level_reminder` text DEFAULT NULL,
  `level_kebun` text DEFAULT NULL,
  `level_pembelian` text DEFAULT NULL,
  `level_pengeluaran` text DEFAULT NULL,
  `level_recording` text DEFAULT NULL,
  `level_monitoring` text DEFAULT NULL,
  `level_penjualan` text DEFAULT NULL,
  `level_laporan` text DEFAULT NULL,
  `level_absensi` text DEFAULT NULL,
  `level_user` text DEFAULT '0',
  `level_tampilan` set('desktop','tablet') DEFAULT NULL,
  `level_hapus` int(11) DEFAULT 0,
  `level_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_level`
--

INSERT INTO `t_level` (`level_id`, `level_nama`, `level_notif`, `level_kontak`, `level_gudang`, `level_reminder`, `level_kebun`, `level_pembelian`, `level_pengeluaran`, `level_recording`, `level_monitoring`, `level_penjualan`, `level_laporan`, `level_absensi`, `level_user`, `level_tampilan`, `level_hapus`, `level_tanggal`) VALUES
(1, 'Admin', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'desktop', 0, '2023-05-13'),
(8, 'Gudang', '1', '1', '1', '1', '1', '0', '0', '1', '1', '0', '1', '1', '0', 'tablet', 0, '2024-04-23'),
(10, 'Kasir', '1', '1', '1', '1', '0', '1', '1', '1', '0', '1', '1', '0', '0', 'tablet', 0, '2024-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `t_notif`
--

CREATE TABLE `t_notif` (
  `notif_id` int(11) NOT NULL,
  `notif_api` text DEFAULT NULL,
  `notif_tujuan` text DEFAULT NULL,
  `notif_pembelian` text DEFAULT NULL,
  `notif_penjualan` text DEFAULT NULL,
  `notif_pengeluaran` text DEFAULT NULL,
  `notif_reminder` text DEFAULT NULL,
  `notif_recording` text DEFAULT NULL,
  `notif_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_notif`
--

INSERT INTO `t_notif` (`notif_id`, `notif_api`, `notif_tujuan`, `notif_pembelian`, `notif_penjualan`, `notif_pengeluaran`, `notif_reminder`, `notif_recording`, `notif_tanggal`) VALUES
(2, '85083166-578b-43b8-b7f3-3cb15437bbf7', '085855011542', 'on', 'on', 'on', 'on', 'on', '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `t_pakan`
--

CREATE TABLE `t_pakan` (
  `pakan_id` int(11) NOT NULL,
  `pakan_kode` text NOT NULL,
  `pakan_nama` text DEFAULT NULL,
  `pakan_satuan` text DEFAULT NULL,
  `pakan_stok` text DEFAULT NULL,
  `pakan_keterangan` text DEFAULT NULL,
  `pakan_tanggal` date DEFAULT curdate(),
  `pakan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pakan`
--

INSERT INTO `t_pakan` (`pakan_id`, `pakan_kode`, `pakan_nama`, `pakan_satuan`, `pakan_stok`, `pakan_keterangan`, `pakan_tanggal`, `pakan_hapus`) VALUES
(24, 'PC001', 'Pakan campur 100% HALAL', '1', '95', '-', '2024-03-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pakan_barang`
--

CREATE TABLE `t_pakan_barang` (
  `pakan_barang_id` int(11) NOT NULL,
  `pakan_barang_kode` text NOT NULL,
  `pakan_barang_barang` text NOT NULL,
  `pakan_barang_qty` text NOT NULL,
  `pakan_barang_stok` text NOT NULL,
  `pakan_barang_harga` text NOT NULL DEFAULT '0',
  `pakan_barang_subtotal` text NOT NULL DEFAULT '0',
  `pakan_barang_tanggal` date NOT NULL DEFAULT curdate(),
  `pakan_barang_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pakan_barang`
--

INSERT INTO `t_pakan_barang` (`pakan_barang_id`, `pakan_barang_kode`, `pakan_barang_barang`, `pakan_barang_qty`, `pakan_barang_stok`, `pakan_barang_harga`, `pakan_barang_subtotal`, `pakan_barang_tanggal`, `pakan_barang_hapus`) VALUES
(52, 'PC001', '146', '5', '10', '12000', '60000', '2024-03-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pakan_campur`
--

CREATE TABLE `t_pakan_campur` (
  `pakan_campur_id` int(11) NOT NULL,
  `pakan_campur_kode` text NOT NULL,
  `pakan_campur_barang` text DEFAULT NULL,
  `pakan_campur_qty` text DEFAULT NULL,
  `pakan_campur_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pakan_campur`
--

INSERT INTO `t_pakan_campur` (`pakan_campur_id`, `pakan_campur_kode`, `pakan_campur_barang`, `pakan_campur_qty`, `pakan_campur_tanggal`) VALUES
(31, 'PC001', '146', '5', '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `t_pakan_qty`
--

CREATE TABLE `t_pakan_qty` (
  `pakan_qty_id` int(11) NOT NULL,
  `pakan_qty_kode` text DEFAULT NULL,
  `pakan_qty_qty` text DEFAULT NULL,
  `pakan_qty_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pakan_qty`
--

INSERT INTO `t_pakan_qty` (`pakan_qty_id`, `pakan_qty_kode`, `pakan_qty_qty`, `pakan_qty_tanggal`) VALUES
(25, 'PC001', '100', '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `t_pekerjaan`
--

CREATE TABLE `t_pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL,
  `pekerjaan_kode` text DEFAULT NULL,
  `pekerjaan_nama` text DEFAULT NULL,
  `pekerjaan_tanggal` date DEFAULT curdate(),
  `pekerjaan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pekerjaan`
--

INSERT INTO `t_pekerjaan` (`pekerjaan_id`, `pekerjaan_kode`, `pekerjaan_nama`, `pekerjaan_tanggal`, `pekerjaan_hapus`) VALUES
(1, 'PK001', 'Panen', '2023-12-29', 0),
(2, 'PK002', 'Semprot', '2023-12-29', 0),
(3, 'PK003', 'Pruning', '2023-12-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_user` int(11) DEFAULT NULL,
  `pembelian_kebun` text DEFAULT NULL,
  `pembelian_nomor` text DEFAULT NULL,
  `pembelian_faktur` text DEFAULT NULL,
  `pembelian_kontak` int(11) DEFAULT NULL,
  `pembelian_sales` text DEFAULT NULL,
  `pembelian_status` enum('lunas','belum') DEFAULT NULL,
  `pembelian_jatuh_tempo` date DEFAULT NULL,
  `pembelian_keterangan` text DEFAULT NULL,
  `pembelian_qty` text DEFAULT NULL,
  `pembelian_ppn` text DEFAULT NULL,
  `pembelian_total` text DEFAULT NULL,
  `pembelian_tanggal` date DEFAULT curdate(),
  `pembelian_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_user`, `pembelian_kebun`, `pembelian_nomor`, `pembelian_faktur`, `pembelian_kontak`, `pembelian_sales`, `pembelian_status`, `pembelian_jatuh_tempo`, `pembelian_keterangan`, `pembelian_qty`, `pembelian_ppn`, `pembelian_total`, `pembelian_tanggal`, `pembelian_hapus`) VALUES
(241, 4, '4', 'PB-230424-1', 'PT0012630', 57, 'Mas Bro', 'lunas', '2024-04-23', '-', '150', '0', '3750000', '2024-04-23', 0),
(242, 4, '4', 'PB-230424-2', 'PT0012637', 57, 'Mas Bro', 'lunas', '2024-04-23', '-', '100', '0', '1750000', '2024-04-23', 0),
(243, 4, '4', 'PB-240424-3', 'PT001112', 57, 'Mas Bro', 'lunas', '2024-04-24', '-', '15', '0', '175000', '2024-04-24', 0),
(244, 4, '4', 'PB-240424-4', 'PT001111', 57, 'Dhian HJ', 'lunas', '2024-04-24', 'Pembelian Pupuk', '35', '0', '945000', '2024-04-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_nomor` text DEFAULT NULL,
  `pembelian_barang_kategori` text DEFAULT NULL,
  `pembelian_barang_barang` text DEFAULT NULL,
  `pembelian_barang_harga` text DEFAULT NULL,
  `pembelian_barang_diskon` text DEFAULT NULL,
  `pembelian_barang_qty` text DEFAULT NULL,
  `pembelian_barang_subtotal` text DEFAULT NULL,
  `pembelian_barang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_nomor`, `pembelian_barang_kategori`, `pembelian_barang_barang`, `pembelian_barang_harga`, `pembelian_barang_diskon`, `pembelian_barang_qty`, `pembelian_barang_subtotal`, `pembelian_barang_tanggal`) VALUES
(305, 'PB-230424-1', '2', '6', '25000', '0', '50', '1250000', '2024-04-23'),
(306, 'PB-230424-1', '2', '5', '20000', '0', '50', '1000000', '2024-04-23'),
(307, 'PB-230424-1', '2', '4', '30000', '0', '50', '1500000', '2024-04-23'),
(308, 'PB-230424-2', '3', '11', '20000', '0', '50', '1000000', '2024-04-23'),
(309, 'PB-230424-2', '3', '10', '15000', '0', '50', '750000', '2024-04-23'),
(310, 'PB-240424-3', '3', '10', '11000', '0', '5', '55000', '2024-04-24'),
(311, 'PB-240424-3', '2', '4', '12000', '0', '10', '120000', '2024-04-24'),
(312, 'PB-240424-4', '2', '6', '30000', '0', '20', '600000', '2024-04-24'),
(313, 'PB-240424-4', '2', '4', '23000', '0', '15', '345000', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran`
--

CREATE TABLE `t_pengeluaran` (
  `pengeluaran_id` int(11) NOT NULL,
  `pengeluaran_user` text DEFAULT NULL,
  `pengeluaran_kebun` text DEFAULT NULL,
  `pengeluaran_nomor` text DEFAULT NULL,
  `pengeluaran_keterangan` text DEFAULT NULL,
  `pengeluaran_lampiran` text DEFAULT NULL,
  `pengeluaran_total` text DEFAULT NULL,
  `pengeluaran_tanggal` date DEFAULT curdate(),
  `pengeluaran_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengeluaran`
--

INSERT INTO `t_pengeluaran` (`pengeluaran_id`, `pengeluaran_user`, `pengeluaran_kebun`, `pengeluaran_nomor`, `pengeluaran_keterangan`, `pengeluaran_lampiran`, `pengeluaran_total`, `pengeluaran_tanggal`, `pengeluaran_hapus`) VALUES
(21, '4', '4', 'PG-230424-1', 'Makan siang', '', '320000', '2024-04-23', 0),
(22, '4', '4', 'PG-240424-2', 'Beli makan pagi karyawan', '', '680000', '2024-04-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran_barang`
--

CREATE TABLE `t_pengeluaran_barang` (
  `pengeluaran_barang_id` int(11) NOT NULL,
  `pengeluaran_barang_nomor` text DEFAULT NULL,
  `pengeluaran_barang_kategori` text DEFAULT NULL,
  `pengeluaran_barang_barang` text DEFAULT NULL,
  `pengeluaran_barang_jumlah` text DEFAULT NULL,
  `pengeluaran_barang_harga` text DEFAULT NULL,
  `pengeluaran_barang_subtotal` text DEFAULT NULL,
  `pengeluaran_barang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengeluaran_barang`
--

INSERT INTO `t_pengeluaran_barang` (`pengeluaran_barang_id`, `pengeluaran_barang_nomor`, `pengeluaran_barang_kategori`, `pengeluaran_barang_barang`, `pengeluaran_barang_jumlah`, `pengeluaran_barang_harga`, `pengeluaran_barang_subtotal`, `pengeluaran_barang_tanggal`) VALUES
(30, 'PG-230424-1', '3', 'Teh poci', '10', '4000', NULL, '2024-04-23'),
(31, 'PG-230424-1', '2', 'Nasi Goreng', '10', '12000', NULL, '2024-04-23'),
(32, 'PG-240424-2', '3', 'Jus Buah', '20', '7000', NULL, '2024-04-24'),
(33, 'PG-240424-2', '2', 'Nasi Pecel', '20', '10000', NULL, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran_kategori`
--

CREATE TABLE `t_pengeluaran_kategori` (
  `pengeluaran_kategori_id` int(11) NOT NULL,
  `pengeluaran_kategori_nama` text DEFAULT NULL,
  `pengeluaran_kategori_keterangan` text DEFAULT NULL,
  `pengeluaran_kategori_tanggal` date DEFAULT curdate(),
  `pengeluaran_kategori_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pengeluaran_kategori`
--

INSERT INTO `t_pengeluaran_kategori` (`pengeluaran_kategori_id`, `pengeluaran_kategori_nama`, `pengeluaran_kategori_keterangan`, `pengeluaran_kategori_tanggal`, `pengeluaran_kategori_hapus`) VALUES
(2, 'Makanan', 'jenis makanan enak', '2024-03-16', 0),
(3, 'Minuman', 'Jenis minuman', '2024-03-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_kebun` int(11) NOT NULL DEFAULT 0,
  `penjualan_user` int(11) DEFAULT NULL,
  `penjualan_kontak` text DEFAULT NULL,
  `penjualan_nomor` text DEFAULT NULL,
  `penjualan_status` enum('lunas','belum') DEFAULT NULL,
  `penjualan_jatuh_tempo` text DEFAULT NULL,
  `penjualan_keterangan` text DEFAULT NULL,
  `penjualan_qty` text DEFAULT NULL,
  `penjualan_ppn` int(11) DEFAULT NULL,
  `penjualan_total` text DEFAULT NULL,
  `penjualan_tanggal` date DEFAULT curdate(),
  `penjualan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_kebun`, `penjualan_user`, `penjualan_kontak`, `penjualan_nomor`, `penjualan_status`, `penjualan_jatuh_tempo`, `penjualan_keterangan`, `penjualan_qty`, `penjualan_ppn`, `penjualan_total`, `penjualan_tanggal`, `penjualan_hapus`) VALUES
(46, 4, 4, '4', 'PJ-230424-1', 'lunas', '2024-04-23', '-', '10', 0, '500000', '2024-04-23', 0),
(47, 4, 4, '4', 'PJ-240424-2', 'lunas', '2024-04-24', '-', '5', 0, '100000', '2024-04-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_barang`
--

CREATE TABLE `t_penjualan_barang` (
  `penjualan_barang_id` int(11) NOT NULL,
  `penjualan_barang_nomor` text NOT NULL,
  `penjualan_barang_kategori` text NOT NULL,
  `penjualan_barang_barang` text NOT NULL,
  `penjualan_barang_harga` text NOT NULL,
  `penjualan_barang_diskon` text NOT NULL,
  `penjualan_barang_stok` text NOT NULL,
  `penjualan_barang_qty` text NOT NULL,
  `penjualan_barang_subtotal` text NOT NULL,
  `penjualan_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan_barang`
--

INSERT INTO `t_penjualan_barang` (`penjualan_barang_id`, `penjualan_barang_nomor`, `penjualan_barang_kategori`, `penjualan_barang_barang`, `penjualan_barang_harga`, `penjualan_barang_diskon`, `penjualan_barang_stok`, `penjualan_barang_qty`, `penjualan_barang_subtotal`, `penjualan_barang_tanggal`) VALUES
(52, 'PJ-230424-1', '', '2', '50000', '0', '  100', '10', '500000', '2024-04-23'),
(53, 'PJ-240424-2', '', '2', '20000', '0', '  90', '5', '100000', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_piutang`
--

CREATE TABLE `t_piutang` (
  `piutang_id` int(11) NOT NULL,
  `piutang_nomor` text DEFAULT NULL,
  `piutang_keterangan` text DEFAULT NULL,
  `piutang_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_piutang`
--

INSERT INTO `t_piutang` (`piutang_id`, `piutang_nomor`, `piutang_keterangan`, `piutang_tanggal`) VALUES
(3, 'PJ-130523-1', NULL, NULL),
(4, 'PJ-130523-2', 'Di bayar cash', '2023-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `t_recording`
--

CREATE TABLE `t_recording` (
  `recording_id` int(11) NOT NULL,
  `recording_nomor` text NOT NULL,
  `recording_user` text NOT NULL,
  `recording_tanggal` date DEFAULT NULL,
  `recording_kebun` text NOT NULL,
  `recording_tanaman` text NOT NULL,
  `recording_suhu` text NOT NULL,
  `recording_kondisi` text NOT NULL,
  `recording_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_recording`
--

INSERT INTO `t_recording` (`recording_id`, `recording_nomor`, `recording_user`, `recording_tanggal`, `recording_kebun`, `recording_tanaman`, `recording_suhu`, `recording_kondisi`, `recording_hapus`) VALUES
(303, 'RC-230424-1', '4', '2024-04-23', '4', '2', '30', 'Bersih Sekali', 0),
(304, 'RC-240424-2', '4', '2024-04-24', '5', '1', '30', 'bagus sekali', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_recording_barang`
--

CREATE TABLE `t_recording_barang` (
  `recording_barang_id` int(11) NOT NULL,
  `recording_barang_nomor` text DEFAULT NULL,
  `recording_barang_barang` text DEFAULT '0',
  `recording_barang_stok` text DEFAULT '0',
  `recording_barang_jumlah` text DEFAULT '0',
  `recording_barang_kategori` text DEFAULT NULL,
  `recording_barang_tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_recording_barang`
--

INSERT INTO `t_recording_barang` (`recording_barang_id`, `recording_barang_nomor`, `recording_barang_barang`, `recording_barang_stok`, `recording_barang_jumlah`, `recording_barang_kategori`, `recording_barang_tanggal`) VALUES
(658, 'RC-230424-1', '2', '0', '100', 'panen', '2024-04-23'),
(659, 'RC-230424-1', '0', '0', '1500000', 'pruning', '2024-04-23'),
(660, 'RC-230424-1', '11', '50', '10', 'semprot', '2024-04-23'),
(661, 'RC-230424-1', '10', '50', '10', 'semprot', '2024-04-23'),
(662, 'RC-230424-1', '5', '50', '20', 'pupuk', '2024-04-23'),
(663, 'RC-230424-1', '4', '50', '20', 'pupuk', '2024-04-23'),
(688, 'RC-240424-2', '0', '0', '150', 'panen', '2024-04-24'),
(689, 'RC-240424-2', '0', '0', '2000000', 'pruning', '2024-04-24'),
(690, 'RC-240424-2', '11', '35', '5', 'semprot', '2024-04-24'),
(691, 'RC-240424-2', '10', '40', '5', 'semprot', '2024-04-24'),
(692, 'RC-240424-2', '5', '25', '5', 'pupuk', '2024-04-24'),
(693, 'RC-240424-2', '4', '50', '5', 'pupuk', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `t_reminder`
--

CREATE TABLE `t_reminder` (
  `reminder_id` int(11) NOT NULL,
  `reminder_jadwal` text DEFAULT NULL,
  `reminder_kebun` text NOT NULL,
  `reminder_kategori` text NOT NULL,
  `reminder_status` int(11) DEFAULT 0,
  `reminder_tanggal` date DEFAULT curdate(),
  `reminder_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_reminder`
--

INSERT INTO `t_reminder` (`reminder_id`, `reminder_jadwal`, `reminder_kebun`, `reminder_kategori`, `reminder_status`, `reminder_tanggal`, `reminder_hapus`) VALUES
(36, '6', '4', '1', 0, '2024-04-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_reminder_jadwal`
--

CREATE TABLE `t_reminder_jadwal` (
  `reminder_jadwal_id` int(11) NOT NULL,
  `reminder_jadwal_kode` text DEFAULT NULL,
  `reminder_jadwal_kebun` text DEFAULT NULL,
  `reminder_jadwal_kategori` text DEFAULT NULL,
  `reminder_jadwal_hari` text DEFAULT NULL,
  `reminder_jadwal_keterangan` text DEFAULT NULL,
  `reminder_jadwal_tanggal` date DEFAULT curdate(),
  `reminder_jadwal_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_reminder_jadwal`
--

INSERT INTO `t_reminder_jadwal` (`reminder_jadwal_id`, `reminder_jadwal_kode`, `reminder_jadwal_kebun`, `reminder_jadwal_kategori`, `reminder_jadwal_hari`, `reminder_jadwal_keterangan`, `reminder_jadwal_tanggal`, `reminder_jadwal_hapus`) VALUES
(6, 'VK001', '4', '1', '5', 'pruning dengan rajin', '2024-04-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_reminder_kategori`
--

CREATE TABLE `t_reminder_kategori` (
  `reminder_kategori_id` int(11) NOT NULL,
  `reminder_kategori_nama` text DEFAULT NULL,
  `reminder_kategori_keterangan` text DEFAULT NULL,
  `reminder_kategori_tanggal` date DEFAULT curdate(),
  `reminder_kategori_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_reminder_kategori`
--

INSERT INTO `t_reminder_kategori` (`reminder_kategori_id`, `reminder_kategori_nama`, `reminder_kategori_keterangan`, `reminder_kategori_tanggal`, `reminder_kategori_hapus`) VALUES
(1, 'Pruning', 'Pruning adalah kegiatan pemangkasan cabang-cabang pohon yang masih muda', '2024-04-18', 0),
(2, 'Semprot', 'Semprotan tanaman (sprayer) adalah alat pertanian yang berfungsi untuk menyemprotkan pupuk cair atau pestisida alami', '2024-04-18', 0),
(3, 'Pupuk', 'Pupuk adalah material yang ditambahkan pada media tanam atau tanaman untuk mencukupi kebutuhan hara yang diperlukan tanaman sehingga mampu berproduksi dengan baik', '2024-04-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_report`
--

CREATE TABLE `t_report` (
  `report_id` int(11) NOT NULL,
  `report_user` text DEFAULT NULL,
  `report_kandang` text DEFAULT NULL,
  `report_kondisi_kandang` text DEFAULT NULL,
  `report_kondisi_suhu` text DEFAULT NULL,
  `report_catatan` text DEFAULT NULL,
  `report_tanggal` date DEFAULT curdate(),
  `report_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_report`
--

INSERT INTO `t_report` (`report_id`, `report_user`, `report_kandang`, `report_kondisi_kandang`, `report_kondisi_suhu`, `report_catatan`, `report_tanggal`, `report_hapus`) VALUES
(2, '2', '4', 'Kotor', '80 %', 'Tidak ada catatan', '2024-02-05', 0),
(3, '2', '22', 'Lumayan Bersih', '60%', 'catatan', '2024-02-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_satuan`
--

CREATE TABLE `t_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` text DEFAULT NULL,
  `satuan_singkatan` text DEFAULT NULL,
  `satuan_jumlah` text DEFAULT NULL,
  `satuan_keterangan` text DEFAULT NULL,
  `satuan_tanggal` date DEFAULT curdate(),
  `satuan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_satuan`
--

INSERT INTO `t_satuan` (`satuan_id`, `satuan_nama`, `satuan_singkatan`, `satuan_jumlah`, `satuan_keterangan`, `satuan_tanggal`, `satuan_hapus`) VALUES
(1, 'Kilo Gram', 'Kg', '1', 'kiloan untuk sawit', '2024-03-03', 0),
(6, 'Picis', 'Pcs', '1', 'untuk 1 botol obat', '2024-04-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` text DEFAULT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_level` int(11) DEFAULT 1,
  `user_kebun` text DEFAULT NULL,
  `user_foto` text DEFAULT NULL,
  `user_hapus` int(11) DEFAULT 0,
  `user_tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_nama`, `user_email`, `user_password`, `user_level`, `user_kebun`, `user_foto`, `user_hapus`, `user_tanggal`) VALUES
(1, 'Adiministrator', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, 'Admin-Profile-PNG-Clipart.png', 0, '2020-05-10'),
(3, 'Bambang GD', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 8, '4', NULL, 0, '2024-02-05'),
(4, 'Shinta KSR', 'kasir@gmail.com', 'c7911af3adbd12a035b289556d96470a', 10, '4', NULL, 0, '2024-04-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `t_bank`
--
ALTER TABLE `t_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `t_barang_kategori`
--
ALTER TABLE `t_barang_kategori`
  ADD PRIMARY KEY (`barang_kategori_id`);

--
-- Indexes for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `t_gaji`
--
ALTER TABLE `t_gaji`
  ADD PRIMARY KEY (`gaji_id`);

--
-- Indexes for table `t_hutang`
--
ALTER TABLE `t_hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indexes for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `t_kebun`
--
ALTER TABLE `t_kebun`
  ADD PRIMARY KEY (`kebun_id`) USING BTREE;

--
-- Indexes for table `t_kontak`
--
ALTER TABLE `t_kontak`
  ADD PRIMARY KEY (`kontak_id`);

--
-- Indexes for table `t_level`
--
ALTER TABLE `t_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `t_notif`
--
ALTER TABLE `t_notif`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `t_pakan`
--
ALTER TABLE `t_pakan`
  ADD PRIMARY KEY (`pakan_id`) USING BTREE;

--
-- Indexes for table `t_pakan_barang`
--
ALTER TABLE `t_pakan_barang`
  ADD PRIMARY KEY (`pakan_barang_id`);

--
-- Indexes for table `t_pakan_campur`
--
ALTER TABLE `t_pakan_campur`
  ADD PRIMARY KEY (`pakan_campur_id`);

--
-- Indexes for table `t_pakan_qty`
--
ALTER TABLE `t_pakan_qty`
  ADD PRIMARY KEY (`pakan_qty_id`);

--
-- Indexes for table `t_pekerjaan`
--
ALTER TABLE `t_pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  ADD PRIMARY KEY (`pembelian_barang_id`);

--
-- Indexes for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  ADD PRIMARY KEY (`pengeluaran_id`);

--
-- Indexes for table `t_pengeluaran_barang`
--
ALTER TABLE `t_pengeluaran_barang`
  ADD PRIMARY KEY (`pengeluaran_barang_id`);

--
-- Indexes for table `t_pengeluaran_kategori`
--
ALTER TABLE `t_pengeluaran_kategori`
  ADD PRIMARY KEY (`pengeluaran_kategori_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  ADD PRIMARY KEY (`penjualan_barang_id`);

--
-- Indexes for table `t_piutang`
--
ALTER TABLE `t_piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indexes for table `t_recording`
--
ALTER TABLE `t_recording`
  ADD PRIMARY KEY (`recording_id`);

--
-- Indexes for table `t_recording_barang`
--
ALTER TABLE `t_recording_barang`
  ADD PRIMARY KEY (`recording_barang_id`) USING BTREE;

--
-- Indexes for table `t_reminder`
--
ALTER TABLE `t_reminder`
  ADD PRIMARY KEY (`reminder_id`) USING BTREE;

--
-- Indexes for table `t_reminder_jadwal`
--
ALTER TABLE `t_reminder_jadwal`
  ADD PRIMARY KEY (`reminder_jadwal_id`) USING BTREE;

--
-- Indexes for table `t_reminder_kategori`
--
ALTER TABLE `t_reminder_kategori`
  ADD PRIMARY KEY (`reminder_kategori_id`);

--
-- Indexes for table `t_report`
--
ALTER TABLE `t_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `t_bank`
--
ALTER TABLE `t_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `t_barang`
--
ALTER TABLE `t_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_barang_kategori`
--
ALTER TABLE `t_barang_kategori`
  MODIFY `barang_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_detail_user`
--
ALTER TABLE `t_detail_user`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_gaji`
--
ALTER TABLE `t_gaji`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_hutang`
--
ALTER TABLE `t_hutang`
  MODIFY `hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_kebun`
--
ALTER TABLE `t_kebun`
  MODIFY `kebun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_notif`
--
ALTER TABLE `t_notif`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_pakan`
--
ALTER TABLE `t_pakan`
  MODIFY `pakan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_pakan_barang`
--
ALTER TABLE `t_pakan_barang`
  MODIFY `pakan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `t_pakan_campur`
--
ALTER TABLE `t_pakan_campur`
  MODIFY `pakan_campur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_pakan_qty`
--
ALTER TABLE `t_pakan_qty`
  MODIFY `pakan_qty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_pekerjaan`
--
ALTER TABLE `t_pekerjaan`
  MODIFY `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  MODIFY `pengeluaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t_pengeluaran_barang`
--
ALTER TABLE `t_pengeluaran_barang`
  MODIFY `pengeluaran_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_pengeluaran_kategori`
--
ALTER TABLE `t_pengeluaran_kategori`
  MODIFY `pengeluaran_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `t_piutang`
--
ALTER TABLE `t_piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_recording`
--
ALTER TABLE `t_recording`
  MODIFY `recording_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `t_recording_barang`
--
ALTER TABLE `t_recording_barang`
  MODIFY `recording_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=694;

--
-- AUTO_INCREMENT for table `t_reminder`
--
ALTER TABLE `t_reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `t_reminder_jadwal`
--
ALTER TABLE `t_reminder_jadwal`
  MODIFY `reminder_jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_reminder_kategori`
--
ALTER TABLE `t_reminder_kategori`
  MODIFY `reminder_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_report`
--
ALTER TABLE `t_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

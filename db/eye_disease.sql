-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 02:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eye_disease`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `kode_aturan` varchar(10) DEFAULT NULL,
  `kode_gejala` text DEFAULT NULL,
  `kode_penyakit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `kode_aturan`, `kode_gejala`, `kode_penyakit`) VALUES
(27, 'A01', 'G01,G02,G03,G17', 'P01'),
(28, 'A02', 'G05,G06,G15,G16,G18', 'P02'),
(29, 'A03', 'G04,G07,G11,G17', 'P03'),
(30, 'A04', 'G01,G08,G14,G15,G16', 'P04'),
(31, 'A05', 'G08,G09,G10,G12,G15,G16', 'P05'),
(32, 'A06', 'G01,G05,G06,G07', 'P06'),
(33, 'A07', 'G01,G11,G12,G13', 'P07'),
(34, 'A08', 'G01,G02,G17', 'P08'),
(35, 'A09', 'G02,G05,G06', 'P09'),
(36, 'A10', 'G03', 'P10'),
(37, 'A11', 'G18,G19', 'P11'),
(38, 'A12', 'G07,G21', 'P12');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` varchar(10) NOT NULL,
  `keterangan_gejala` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `keterangan_gejala`) VALUES
('G01', 'Penglihatan kabur/berawan'),
('G02', 'Sensitivitas terhadap cahaya'),
('G03', 'Penglihatan buruk di malam hari'),
('G04', 'Penglihatan Ganda'),
('G05', 'Nyeri Mata'),
('G06', 'Mata Merah'),
('G07', 'Kehilangan Penglihatan'),
('G08', 'Mata kering'),
('G09', 'Mata terasa lelah'),
('G10', 'Mata terasa berat'),
('G11', 'Penglihatan Buram'),
('G12', 'Sakit Kepala'),
('G13', 'Iritasi pada mata'),
('G14', 'Rasa tidak nyaman seperti ada benda asing di mata'),
('G15', 'Mata terasa gatal'),
('G16', 'Mata terasa terbakar'),
('G17', 'Terlihat kilatan cahaya'),
('G18', 'Mata berair'),
('G19', 'Kesulitan membuka mata di pagi hari'),
('G20', 'Sensasi seperti pasir'),
('G21', 'Sakit dengan gerakan mata');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` varchar(10) NOT NULL,
  `nama_penyakit` varchar(255) DEFAULT NULL,
  `detail_penyakit` varchar(250) DEFAULT NULL,
  `saran_penyakit` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `detail_penyakit`, `saran_penyakit`) VALUES
('P01', 'Katarak', 'Katarak adalah kondisi di mana lensa mata menjadi keruh, yang dapat menyebabkan penglihatan kabur. Ini umumnya terkait dengan penuaan, tetapi juga bisa disebabkan oleh faktor genetik, trauma, atau paparan sinar UV.', 'Disarankan untuk melakukan pemeriksaan mata secara rutin dan, jika diperlukan, pertimbangkan operasi katarak untuk mengembalikan penglihatan.\r\n\r\n'),
('P02', 'Konjungtivitis', 'Konjungtivitis, atau mata merah, adalah peradangan pada selaput yang melapisi kelopak mata dan bagian putih mata. Ini dapat disebabkan oleh infeksi virus, bakteri, atau alergi.', ' Hindari menyentuh mata, cuci tangan secara teratur, dan gunakan obat tetes mata sesuai petunjuk dokter untuk mengurangi gejala.\r\n'),
('P03', 'Retinopati Diabetik', 'Retinopati diabetik adalah kerusakan pada pembuluh darah retina akibat diabetes, yang dapat menyebabkan kebutaan. Gejala awal mungkin tidak terlihat, tetapi dapat menyebabkan kehilangan penglihatan jika tidak ditangani.', 'Kontrol gula darah secara ketat dan lakukan pemeriksaan mata secara rutin untuk mendeteksi masalah sejak dini.'),
('P04', 'Sindrom Mata Kering', 'Sindrom mata kering terjadi ketika mata tidak memproduksi cukup air mata atau air mata evaporasi terlalu cepat. Gejalanya meliputi rasa gatal, terbakar, dan penglihatan kabur.', 'Gunakan tetes mata yang direkomendasikan untuk melembapkan mata, dan pertimbangkan untuk menggunakan humidifier di ruangan.'),
('P05', 'Kelelahan Mata', 'Kelelahan mata disebabkan oleh penggunaan mata yang berlebihan, seperti bekerja di depan komputer terlalu lama. Gejalanya termasuk ketegangan, penglihatan kabur, dan sakit kepala.', 'Terapkan aturan 20-20-20: setiap 20 menit, lihat objek yang berjarak 20 kaki selama 20 detik. Juga, pastikan pencahayaan yang baik saat bekerja.'),
('P06', 'Glaukoma', 'Glaukoma adalah kondisi yang merusak saraf optik, biasanya terkait dengan tekanan mata tinggi. Ini bisa menyebabkan kehilangan penglihatan permanen jika tidak diobati.', 'Lakukan pemeriksaan mata secara rutin dan ikuti pengobatan yang direkomendasikan oleh dokter untuk mengontrol tekanan mata.'),
('P07', 'Kelainan Refraksi', 'Kelainan refraksi termasuk miopia, hipermetropia, dan astigmatisme. Ini terjadi ketika cahaya tidak fokus dengan benar di retina, menyebabkan penglihatan kabur.', 'Dapatkan resep kacamata atau lensa kontak yang tepat, dan lakukan pemeriksaan mata secara berkala.'),
('P08', 'Ablasio Retina', 'Ablasio retina adalah kondisi serius di mana retina terlepas dari lapisan mendukungnya, yang dapat menyebabkan kehilangan penglihatan permanen jika tidak diobati segera.', 'Segera cari perawatan medis jika mengalami gejala seperti flash, bintik-bintik gelap, atau penglihatan kabur.'),
('P09', 'Iritis', 'Iritis adalah peradangan pada iris, bagian berwarna mata. Ini dapat menyebabkan rasa sakit, kemerahan, dan penglihatan kabur.', 'Temui dokter untuk mendapatkan diagnosis dan pengobatan yang tepat, termasuk obat tetes mata untuk mengurangi peradangan.'),
('P10', 'Rabun Senja', 'Rabun senja adalah kesulitan melihat dalam kondisi cahaya rendah atau saat senja. Ini dapat disebabkan oleh kekurangan vitamin A atau masalah kesehatan mata lainnya.', 'Perbanyak konsumsi makanan yang kaya vitamin A, seperti wortel dan sayuran hijau. Jika gejala berlanjut, periksakan ke dokter mata.'),
('P11', 'Dacryoadenitis', 'Dacryoadenitis adalah peradangan pada kelenjar air mata (kelenjar lakrimal) yang dapat disebabkan oleh infeksi, autoimun, atau trauma. Gejala umumnya meliputi bengkak di area kelenjar air mata, kemerahan, nyeri, dan mungkin pengeluaran air mata yang ', 'Segera temui dokter untuk diagnosis dan pengobatan yang tepat. Pengobatan dapat meliputi antibiotik untuk infeksi, kompres hangat untuk mengurangi bengkak, atau obat anti-inflamasi sesuai petunjuk dokter.'),
('P12', 'Optic Neuritis', 'Optic neuritis adalah peradangan pada saraf optik yang dapat menyebabkan kehilangan penglihatan sementara, nyeri pada mata, dan perubahan penglihatan warna. Kondisi ini sering kali terkait dengan penyakit autoimun seperti multiple sclerosis.', 'Segera konsultasikan dengan dokter mata atau neurologis jika mengalami gejala. Pengobatan mungkin melibatkan steroid untuk mengurangi peradangan dan pemantauan lebih lanjut untuk kondisi yang mendasarinya.');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(200) NOT NULL,
  `nama_pasien` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `umur` varchar(250) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `input_gejala` varchar(500) NOT NULL,
  `hasil_diagnosa` varchar(200) NOT NULL,
  `saran` varchar(500) NOT NULL,
  `detail_penyakit` varchar(500) NOT NULL,
  `diagnosa_lainnya` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `nama_pasien`, `alamat`, `umur`, `jenis_kelamin`, `status`, `input_gejala`, `hasil_diagnosa`, `saran`, `detail_penyakit`, `diagnosa_lainnya`) VALUES
();

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', 'admin', 'admin'),
(2, 'edward', 'edward', '123', 'user'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_penyakit` (`kode_penyakit`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`kode_penyakit`) REFERENCES `penyakit` (`kode_penyakit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

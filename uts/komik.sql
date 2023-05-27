-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 09:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komik`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertkeranjang` (IN `in_gambar` VARCHAR(50), IN `in_judul` VARCHAR(50), IN `in_harga` INT, IN `in_quantity` INT)  BEGIN
		INSERT INTO keranjang (gambar, judul, harga, quantity)
		VALUES (in_gambar, in_judul, in_harga, in_quantity);
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertmember` (IN `in_username` VARCHAR(50), IN `in_password` VARCHAR(50), IN `in_email` VARCHAR(50), IN `in_nama` VARCHAR(50), IN `in_nohp` VARCHAR(50), IN `in_alamat` VARCHAR(50), IN `in_kodepos` VARCHAR(50), IN `in_negara` VARCHAR(50), IN `in_gender` VARCHAR(50), IN `in_ttl` DATE)  BEGIN
		INSERT INTO pembeli (username, password, email, nama, nohp, alamat, kodepos, negara, gender, ttl)
		VALUES (in_username, in_password, in_email, in_nama, in_nohp, in_alamat, in_kodepos, in_negara, in_gender, in_ttl);
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertproduk` (IN `in_judul` VARCHAR(50), IN `in_harga` INT, IN `in_gambar` VARCHAR(50), IN `in_stok` INT, IN `in_ringkas` VARCHAR(100))  BEGIN
		INSERT INTO produk (judul,harga, gambar, stok, ringkas)
		VALUES (in_judul, in_harga, in_gambar, in_stok, in_ringkas);
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inserttotal` ()  BEGIN
	SELECT SUM(subharga)
	FROM keranjang;

	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `idkeranjang` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `idpembeli` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`idkeranjang`, `gambar`, `judul`, `harga`, `quantity`, `idpembeli`, `subharga`) VALUES
(45, 'bsd1.webp', 'Bungou Stray Dogs Vol 1', 24000, 2, 20, 48000),
(66, 'Owari-no-Seraph-Manga-Vol-1-Cover.jpg', 'Owari No Seraph Vol 1', 26000, 3, 21, 78000),
(67, 'jk1.webp', 'Jujutsu Kaisen Vol 1', 28000, 1, 21, 28000);

--
-- Triggers `keranjang`
--
DELIMITER $$
CREATE TRIGGER `editstok` AFTER INSERT ON `keranjang` FOR EACH ROW BEGIN
	UPDATE produk SET stok = stok-NEW.quantity
	WHERE judul = NEW.judul;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orderuser`
--

CREATE TABLE `orderuser` (
  `idorder` int(11) NOT NULL,
  `idpembeli` int(11) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `tglorder` date NOT NULL,
  `totalproduk` varchar(1000) NOT NULL,
  `totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderuser`
--

INSERT INTO `orderuser` (`idorder`, `idpembeli`, `pembayaran`, `tglorder`, `totalproduk`, `totalharga`) VALUES
(15, 21, 'Cash On Delivery', '2022-05-05', 'Bungou Stray Dogs Vol 1 (1) , Jujutsu Kaisen Vol 2 (10) ', 304000),
(16, 21, 'Cash On Delivery', '2022-05-05', 'Bungou Stray Dogs Vol 1 (1) , Jujutsu Kaisen Vol 2 (1) , Gintama vol 1 (2) ', 102000),
(17, 22, 'Cash On Delivery', '2022-05-05', 'Gintama vol 1 (1) , Bungou Stray Dogs Vol 1 (2) , Jujutsu Kaisen Vol 2 (5) ', 213000),
(19, 22, 'Cash On Delivery', '2022-05-05', 'Gintama vol 1 (1) , Bungou Stray Dogs Vol 1 (2) , Jujutsu Kaisen Vol 2 (5) , Jujutsu Kaisen Vol 1 (1) ', 241000),
(20, 22, 'Cash On Delivery', '2022-05-05', 'Gintama vol 1 (10) ', 250000),
(21, 21, 'Cash On Delivery', '2022-05-05', 'Bungou Stray Dogs Vol 1 (1) , Jujutsu Kaisen Vol 2 (1) , Gintama vol 1 (2) , Jujutsu Kaisen Vol 1 (1) ', 130000),
(22, 21, 'Cash On Delivery', '2022-05-05', 'Bungou Stray Dogs Vol 1 (1) ', 24000),
(23, 21, 'Cash On Delivery', '2022-05-06', 'Owari No Seraph Vol 1 (2) ', 52000),
(24, 21, 'Cash On Delivery', '2022-05-06', 'Gintama vol 1 (1) ', 25000),
(25, 21, 'Cash On Delivery', '2022-05-07', 'Bungou Stray Dogs Vol 1 (2) ', 48000),
(26, 21, 'Cash On Delivery', '2022-05-07', 'Bungou Stray Dogs Vol 1 (1) , Jujutsu Kaisen Vol 2 (2) ', 80000);

--
-- Triggers `orderuser`
--
DELIMITER $$
CREATE TRIGGER `hapuscart` AFTER INSERT ON `orderuser` FOR EACH ROW BEGIN
    DELETE FROM keranjang WHERE idpembeli = new.idpembeli;

    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `idpembeli` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kodepos` varchar(50) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `ttl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`idpembeli`, `username`, `password`, `email`, `nama`, `nohp`, `alamat`, `kodepos`, `negara`, `gender`, `ttl`) VALUES
(21, 'randa', 'randa', 'randa@gmail.com', 'Randa', '089897', 'jl.abcd', '1234', 'Indonesia', 'Perempuan', '1999-12-14'),
(22, 'zeina14', 'zeina14', '', 'Lino', '08999', 'jl.asd', '321', 'Indonesia', 'Laki-Laki', '1999-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `ringkas` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `judul`, `harga`, `gambar`, `stok`, `ringkas`) VALUES
(1, 'Gintama vol 1', 25000, 'gintama1.jpg', 0, 'Gintama bercerita tentang kehidupan sehari-hari tokoh utamanya, yaitu Sakata Gintoki, yang mendirikan usaha bernama “Yorozuya” bersama dua temannya dan satu anjing. Mereka bersedia mengerjakan tugas apa saja asalkan dibayar agar dapat membiayai kehidupan sehari-hari.'),
(2, 'Jujutsu Kaisen Vol 1', 28000, 'jk1.webp', 93, 'Jujutsu Kaisen mengisahkan Yuuji Itadori, seorang siswa SMA berbakat, memiliki fisik yang kuat dan cocok untuk ikut klub olahraga di sekolahnya. Namun, alih-alih bergabung ke klub olahraga, ia justru bergabung ke klub penelitian gaib. Alasannya, Yuuji hanya ingin bersenang-senang dan mengisi waktu senggang. Selain itu, ia memiliki alasan khusus agar bisa pulang cepat untuk merawat neneknya yang sudah tua dan sakit-sakitan.'),
(3, 'Bungou Stray Dogs Vol 1', 24000, 'bsd1.webp', 46, 'Menceritakan tentang seorang remaja bernama Atsushi Nakajima berusia 18 tahun yang dulu tinggal di panti asuhan kini diusir oleh pengasuhnya karena memiliki kemampuan supernatural yang mampu mengubahnya menjadi harimau putih dan membuat kekacauan tanpa menyadarinya, saat ini sendirian tidak memiliki tempat tinggal dan kelaparan tidak sengaja melihat seorang yang tenggelam dibawa arus sungai kemudian menyelamatkannya. Orang tersebut adalah Osamu Dazai yaitu orang aneh yang gemar bunuh diri dan merupakan anggota dari \"Badan Detektif Bersenjata\" kemudian mengajaknya bergabung di sana dia bertemu dengan banyak pengguna kemampuan supranatural lainnya dan memiliki tugas untuk menangani berbagai kasus dan peristiwa yang terjadi di kota Yokohama, tempat yang penuh dengan individu dengan Kemampuan Supernatural.'),
(9, 'Jujutsu Kaisen Vol 2', 28000, 'jk2.webp', 98, 'Jujutsu Kaisen mengisahkan Yuuji Itadori, seorang siswa SMA berbakat, memiliki fisik yang kuat dan cocok untuk ikut klub olahraga di sekolahnya. Namun, alih-alih bergabung ke klub olahraga, ia justru bergabung ke klub penelitian gaib. Alasannya, Yuuji hanya ingin bersenang-senang dan mengisi waktu senggang. Selain itu, ia memiliki alasan khusus agar bisa pulang cepat untuk merawat neneknya yang sudah tua dan sakit-sakitan.'),
(29, 'Shingeki No Kyojin Vol 1', 30000, 'Volume_1_Cover.webp', 100, 'Mengambil latar belakang cerita dunia pasca-apokaliptik di mana sisa-sisa umat manusia hidup di balik dinding melindungi mereka terhadap Titans humanoid raksasa, plot mengikuti kehidupan Eren Jaeger yang bergabung dengan Korps Survei elit, untuk membalas dendam atas kematian ibunya.'),
(31, 'Owari No Seraph Vol 1', 26000, 'Owari-no-Seraph-Manga-Vol-1-Cover.jpg', 45, 'Menceritakan tentang bumi yang diserang oleh virus aneh hingga menyebabkan para manusianya mati tanpa sebab yang jelas. Disusul dengan keadaan kota yang semakin tidak karuan karena virus itu menyebar cepat menyerang para warganya.');

-- --------------------------------------------------------

--
-- Table structure for table `useradmin`
--

CREATE TABLE `useradmin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useradmin`
--

INSERT INTO `useradmin` (`idadmin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`idkeranjang`);

--
-- Indexes for table `orderuser`
--
ALTER TABLE `orderuser`
  ADD PRIMARY KEY (`idorder`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`idpembeli`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `useradmin`
--
ALTER TABLE `useradmin`
  ADD PRIMARY KEY (`idadmin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `idkeranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `orderuser`
--
ALTER TABLE `orderuser`
  MODIFY `idorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `idpembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `useradmin`
--
ALTER TABLE `useradmin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

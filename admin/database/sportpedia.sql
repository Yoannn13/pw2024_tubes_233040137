-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2024 at 12:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportpedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Sepak Bola'),
(2, 'Basket'),
(3, 'voly');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `kotaAsal` varchar(100) DEFAULT NULL,
  `negara` varchar(100) DEFAULT NULL,
  `stadion` varchar(100) DEFAULT NULL,
  `tahunDidirikan` int DEFAULT NULL,
  `pelatih` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `kategori_id`, `nama`, `kotaAsal`, `negara`, `stadion`, `tahunDidirikan`, `pelatih`, `gambar`) VALUES
(2, 1, 'Barcelona', 'Bacrelona', 'Spanyol', 'Campnou', 1990, 'Hansi Flick', 'e2oGQ2zTUf.png'),
(7, 1, 'Manchester United', 'Manchester', 'Inggris', 'Old Trafford', 1878, 'Erik Ten Hag', '88u5IOmrZj.png'),
(8, 1, 'Real Madrid', 'Madrid', 'Spanyol', 'Santiago Bernabeu', 1902, 'Carlo Ancelotti', 'YnIHwVbdTMPj7VU.jpg'),
(9, 1, 'Manchester City', 'Manchester', 'Inggirs', 'Etihad Stadion', 1988, 'Pep Guardiola', 'E5IZXthNrWvrASc.png'),
(10, 1, 'Arsenal', 'London', 'Inggirs', 'Emirates', 1886, 'Mikel Arteta', 'cys4CtZHcPX6zA2.png'),
(11, 1, 'Chelsea', 'London', 'Inggris', 'Stamford Bridge', 1905, 'Enzo Maresca', 'pX2Tm76LZyWhVcP.png'),
(12, 1, 'Bayern Munchen', 'Munich', 'German', 'Allianz Arena', 1900, 'Vincent Kompany', 'iJjSLYzrNFtTf1T.png'),
(13, 1, 'Borussia Dortmund', 'Dortmund', 'German', 'Signal Iduna Park', 1909, 'Edin Terzic', 'x2BVK1KlYobGbD8.png'),
(14, 1, 'Bayer 04 Leverkusen', 'Leverkusen', 'German', 'Bay Arena', 1904, 'Xabi Alonso', 'jPDQmSEFawva5UR.png'),
(15, 1, 'Tottenham Hotspur', 'London', 'Inggris', 'Tottenham Hotspur Stadion', 1882, 'Ange Postecoglou', 'TBtL1hIFbGFPBVZ.png'),
(16, 1, 'Aston Villa', 'Birmingham', 'Inggris', 'Villa Park', 1874, 'Unai Emery', 'ffgqNa9mECLIQqX.png'),
(17, 1, 'Newcastle United', 'Newcastle upon tyne', 'Inggris', 'St James Park', 1892, 'Eddie Howe', '6h9uLTajL2yU437.png'),
(18, 1, 'AC Milan', 'Milan', 'Italia', 'San Siro Stadion', 1899, 'Stefano Pioli', 'O65EeT7LBpLHMvh.png'),
(19, 1, 'Internazionale Milan', 'Milan', 'Italia', 'San Siro Stadion', 1908, 'Simeone Inzaghi', '316cggPKltDErmK.png'),
(20, 1, 'Juventus', 'Turin', 'Italia', 'Juventus Stadion', 1897, 'Paolo Montero', 'qmggAbsFeN0EDba.png'),
(21, 1, 'Olympique Lyonnais', 'Chauses', 'Prancis', 'Groupama Stadion', 1950, 'Pierre Sage', 'RW6T0pFX5Qy2jpJ.png'),
(22, 1, 'Paris Saint Germain', 'Paris', 'Prancis', 'Parc des Princes', 1970, 'Luis Enrique', 'KsPmXzfMJuK6c1x.png'),
(23, 1, 'Olympique de Marseille', 'Marseille', 'Prancis', 'Vélodrome Stadion', 1899, 'Jean-Louis Gasset', 't1jUvwXywgUQYkt.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$yxeRdxAWozJ4wdkyxFLTiOeaLfgHUWzpJLQF5snTtnnOzdy/RdFwa', 'admin'),
(2, 'yoman', '$2y$10$hWvZl0XoVHgUm0FE5OYrlOY9f0ORIVHz3579Kk.DJkyiBeIq5sEO.', 'user'),
(3, 'jambang', '$2y$10$ZrkvLefaODcvF6Fbxhy4g.lcI0nIS9tev022mdVsZz7q71bt68KUS', 'user'),
(4, 'yo', '$2y$10$FWxHZcKVHDdrHc69spqQG.owYGW3h8loyx2xbQSB7zZCCCL6mifIO', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_team` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `kategori_team` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

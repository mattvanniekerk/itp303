-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2019 at 06:53 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vannieke_final_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'matt', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b'),
(2, 'john', 'f6f2ea8f45d8a057c9566a33f99474da2e5c6a6604d736121650e2730c6fb0a3'),
(3, 'tom', '7020e57625b6a6695ffd51ed494fbfc56c699eaceca4e77bf7ea590c7ebf3879'),
(4, 'alice', 'd743cb4b22397cf64e0117fd83d29ca1e059c698b8155a3771417e24458e2bb5'),
(5, 'bob', 'bd33a355148056c92431fd29fab91d61cc97e522f022d730998d87138343f3a9'),
(6, 'kate', '052253777975be3a4068b842d9ba4fed3d9fe509331355f6dec6b9eb4ece74d1'),
(7, 'rean', '3fa1c346e22c76179c293b1a81d2c1a67fe7167a6ac23db892816fe9cc8d88cd'),
(8, 'Alice van Niekerk', '98d72788b554c1557616b254fb9e2e1afd8971b98a8cf0ea98520d55e1742dcb'),
(9, 'tommy', '7aca6784a90c48650922820554679059fcc26abf90a34a3b0b4497ec6f9815d7'),
(10, 'tommytrojan', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'),
(11, 'lin', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
(12, 'ttrojan', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'),
(13, 'nayeon', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `users_has_words`
--

CREATE TABLE `users_has_words` (
  `user_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_has_words`
--

INSERT INTO `users_has_words` (`user_id`, `word_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 7),
(1, 9),
(1, 20),
(1, 21),
(1, 25),
(2, 1),
(2, 2),
(2, 7),
(2, 8),
(2, 9),
(3, 1),
(3, 2),
(3, 6),
(3, 7),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 15),
(6, 17),
(6, 19),
(9, 9),
(9, 23),
(13, 26),
(13, 27),
(13, 29);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `word_id` int(11) NOT NULL,
  `word` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`word_id`, `word`) VALUES
(15, 'alpha'),
(29, 'Alwyn'),
(3, 'apple'),
(20, 'beyond'),
(10, 'book'),
(2, 'computer'),
(1, 'deflagrate'),
(23, 'dictionary'),
(21, 'emotion'),
(25, 'eutectic'),
(18, 'fruitarian'),
(27, 'hither'),
(8, 'journey'),
(14, 'lexicon'),
(13, 'melam'),
(28, 'pauperisation'),
(9, 'pentalpha'),
(6, 'pioneer'),
(17, 'pizza'),
(5, 'professional'),
(12, 'reedbuck'),
(22, 'rhesis'),
(24, 'school'),
(26, 'senectitude'),
(16, 'slang'),
(19, 'superimposed'),
(11, 'television'),
(7, 'theory'),
(4, 'zebra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `users_has_words`
--
ALTER TABLE `users_has_words`
  ADD PRIMARY KEY (`user_id`,`word_id`),
  ADD KEY `fk_users_has_words_words1_idx` (`word_id`),
  ADD KEY `fk_users_has_words_users_idx` (`user_id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`word_id`),
  ADD UNIQUE KEY `word_id_UNIQUE` (`word_id`),
  ADD UNIQUE KEY `word_UNIQUE` (`word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `word_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_has_words`
--
ALTER TABLE `users_has_words`
  ADD CONSTRAINT `fk_users_has_words_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_words_words1` FOREIGN KEY (`word_id`) REFERENCES `words` (`word_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

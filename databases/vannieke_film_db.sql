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
-- Database: `vannieke_film_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`email`, `name`, `dob`, `id`) VALUES
('james@gmail.com', 'James Cameron', '0000-00-00', 1),
('abrams@aol.com', 'J.J. Abrams', '0000-00-00', 2),
('colin@yahoo.com', 'Colin Trevorrow', '0000-00-00', 3),
('joss@usc.edu', 'Joss Whedon', '0000-00-00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `movie_id` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `worldwide_gross` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `directors_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`movie_id`, `title`, `worldwide_gross`, `year`, `id`, `directors_id`) VALUES
('IDM-501', 'Avatar', 2147483647, 2009, 1, 1),
('IDM-502', 'Titanic', 2147483647, 1997, 2, 1),
('IDM-503', 'Star Wars: The Force Awakens', 2068223624, 2015, 3, 2),
('IDM-504', 'Jurassic World', 1671713208, 2015, 4, 3),
('IDM-501', 'Avatar', 2147483647, 2009, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`id`, `name`, `email`) VALUES
(1, 'James Cameron', 'james@gmail.com'),
(2, 'Jon Landau', 'jon@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `producers_has_films`
--

CREATE TABLE `producers_has_films` (
  `producers_id` int(11) NOT NULL,
  `films_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producers_has_films`
--

INSERT INTO `producers_has_films` (`producers_id`, `films_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_films_directors_idx` (`directors_id`);

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `producers_has_films`
--
ALTER TABLE `producers_has_films`
  ADD PRIMARY KEY (`producers_id`,`films_id`),
  ADD KEY `fk_producers_has_films_films1_idx` (`films_id`),
  ADD KEY `fk_producers_has_films_producers1_idx` (`producers_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `fk_films_directors` FOREIGN KEY (`directors_id`) REFERENCES `directors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `producers_has_films`
--
ALTER TABLE `producers_has_films`
  ADD CONSTRAINT `fk_producers_has_films_films1` FOREIGN KEY (`films_id`) REFERENCES `films` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producers_has_films_producers1` FOREIGN KEY (`producers_id`) REFERENCES `producers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

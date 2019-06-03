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
-- Database: `vannieke_football_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `football_schedule`
-- (See below for the actual view)
--
CREATE TABLE `football_schedule` (
`day` varchar(3)
,`date` date
,`home` varchar(45)
,`away` varchar(45)
,`venue` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `date`, `home_team_id`, `away_team_id`, `venue_id`) VALUES
(1, '2017-09-09', 1, 2, 1),
(2, '2017-09-23', 3, 1, 2),
(3, '2017-09-23', 2, 4, 3),
(4, '2017-09-29', 1, 5, 4),
(5, '2017-09-30', 2, 6, 3),
(6, '2017-09-30', 4, 7, 5),
(7, '2017-09-30', 8, 3, 6),
(8, '2017-10-07', 1, 9, 1),
(9, '2017-10-07', 10, 2, 7),
(10, '2017-10-13', 3, 5, 2),
(11, '2017-10-14', 1, 10, 1),
(12, '2017-10-14', 2, 8, 3),
(13, '2017-10-21', 4, 8, 5),
(14, '2017-10-26', 9, 2, 8),
(15, '2017-10-28', 6, 1, 9),
(16, '2017-10-28', 3, 7, 2),
(17, '2017-11-04', 10, 4, 7),
(18, '2017-11-04', 3, 9, 2),
(19, '2017-11-18', 1, 4, 1),
(20, '2017-11-11', 7, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `school` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `school`) VALUES
(1, 'USC Trojans', 'University of Southern California'),
(2, 'Stanford Cardinals', 'Stanford University'),
(3, 'California Golden Bears', 'University of California, Berkeley'),
(4, 'UCLA Bruins', 'University of California, Los Angeles'),
(5, 'Washington State Cougars', 'Washington State University'),
(6, 'Arizona State Sun Devils', 'Arizona State University'),
(7, 'Colorado Buffaloes', 'University of Colorado'),
(8, 'Oregon Ducks', 'University of Oregon'),
(9, 'Oregon State Beavers', 'Oregon State University'),
(10, 'Utah Utes', 'University of Utah');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `name`, `city`) VALUES
(1, 'LA Memorial Coliseum', 'Los Angeles'),
(2, 'California Memorial Stadium', 'Berkeley'),
(3, 'Stanford Stadium', 'Stanford'),
(4, 'Martin Stadium', 'Pullman'),
(5, 'Rose Bowl', 'Pasadena'),
(6, 'Autzen Stadium', 'Eugene'),
(7, 'Rice-Eccles Stadium', 'Salt Lake City'),
(8, 'Reser Stadium', 'Corvallis'),
(9, 'Sun Devil Stadium', 'Tempe'),
(10, 'Folsom Field', 'Boulder');

-- --------------------------------------------------------

--
-- Structure for view `football_schedule`
--
DROP TABLE IF EXISTS `football_schedule`;

CREATE ALGORITHM=UNDEFINED DEFINER=`vannieke`@`%.%.%.%` SQL SECURITY DEFINER VIEW `football_schedule`  AS  select substr(dayname(`games`.`date`),1,3) AS `day`,`games`.`date` AS `date`,`teams`.`name` AS `home`,`a`.`name` AS `away`,`venues`.`name` AS `venue` from (((`games` join `teams` on((`games`.`home_team_id` = `teams`.`id`))) join `teams` `a` on((`games`.`away_team_id` = `a`.`id`))) join `venues` on((`games`.`venue_id` = `venues`.`id`))) order by `games`.`date` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_games_venues_idx` (`venue_id`),
  ADD KEY `fk_games_teams_idx` (`home_team_id`),
  ADD KEY `fk_games_away_team_idx` (`away_team_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `school_UNIQUE` (`school`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_away_team` FOREIGN KEY (`away_team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_games_home_team` FOREIGN KEY (`home_team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_games_venues` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

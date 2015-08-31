-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2015 at 09:44 PM
-- Server version: 5.6.24-0ubuntu2.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `px_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `px_disciplinas`
--

CREATE TABLE IF NOT EXISTS `px_disciplinas` (
`ID` int(4) NOT NULL,
  `nome_disciplina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `px_schedules`
--

CREATE TABLE IF NOT EXISTS `px_schedules` (
`ID` int(4) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `horarios` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `px_schedules`
--

INSERT INTO `px_schedules` (`ID`, `id_adm`, `horarios`) VALUES
(1, 1, '-1,1,2,3,3,-2,1,1,1,1,2,3,3|1,1,2,3,3,-2,1,1,1,1,2,3,3|1,1,2,3,3,-2,1,1,1,1,2,3,3|1,1,2,3,3,-2,1,1,1,1,2,3,3|-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1|1,1,1,1,1,-1,-1,-1,-1,-1,-1,-1,-1');

-- --------------------------------------------------------

--
-- Table structure for table `px_user`
--

CREATE TABLE IF NOT EXISTS `px_user` (
`ID` int(4) NOT NULL,
  `email` text NOT NULL,
  `nome` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `px_user`
--

INSERT INTO `px_user` (`ID`, `email`, `nome`, `password`) VALUES
(1, 'contato.pauloxavier@gmail.com', 'Paulo Xavier', 'qrtr123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `px_disciplinas`
--
ALTER TABLE `px_disciplinas`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `px_schedules`
--
ALTER TABLE `px_schedules`
 ADD PRIMARY KEY (`ID`), ADD KEY `id_adm` (`id_adm`);

--
-- Indexes for table `px_user`
--
ALTER TABLE `px_user`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `px_disciplinas`
--
ALTER TABLE `px_disciplinas`
MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `px_schedules`
--
ALTER TABLE `px_schedules`
MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `px_user`
--
ALTER TABLE `px_user`
MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `px_schedules`
--
ALTER TABLE `px_schedules`
ADD CONSTRAINT `px_schedules_ibfk_1` FOREIGN KEY (`id_adm`) REFERENCES `px_user` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

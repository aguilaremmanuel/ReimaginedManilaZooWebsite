-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2024 at 02:33 PM
-- Server version: 10.11.6-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u573194023_db_archive`
--

-- --------------------------------------------------------

--
-- Table structure for table `guest_archive`
--

CREATE TABLE `guest_archive` (
  `Guest_No` int(11) NOT NULL,
  `Guest_FirstName` varchar(255) NOT NULL,
  `Guest_LastName` varchar(255) NOT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Residency` varchar(50) DEFAULT NULL,
  `Guest_Status` varchar(20) DEFAULT NULL,
  `Ticket_ID` varchar(11) DEFAULT NULL,
  `Contact_No` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest_archive`
--

INSERT INTO `guest_archive` (`Guest_No`, `Guest_FirstName`, `Guest_LastName`, `Gender`, `Age`, `Residency`, `Guest_Status`, `Ticket_ID`, `Contact_No`, `Email`, `Price`) VALUES
(57, 'Khyle Andrei', 'Colarina', 'male', 21, 'MNL', 'STUD', 'TV4-979D-93', '09451434859', 'khylecolarina@gmail.com', '100.00'),
(58, 'Emman', 'Aguilar', 'male', 21, 'NON-MNL', 'STUD', 'TY7-104A-36', '09214547294', 'emsaguilar@gmail.com', '200.00'),
(59, 'Kenneth', 'Alcira', 'male', 22, 'NON-MNL', 'REG', 'TY7-104A-36', '09214353214', 'kenneth@gmail.com', '300.00'),
(60, 'Yuwon Angelo', 'Aguilar', 'male', 20, 'NON-MNL', 'STUD', 'TY7-104A-36', '09610167121', 'yuwonangelo@gmail.com', '200.00'),
(61, 'Jennifer', 'Balot', 'female', 34, 'NON-MNL', 'REG', 'TR8-339A-37', '09561728231', 'jenBalot@gmail.com', '300.00'),
(62, 'Trina', 'Gamido', 'female', 19, 'NON-MNL', 'STUD', 'TU7-353A-91', '09245471821', 'tontongamido@gmail.com', '100.00'),
(63, 'Kyla Mae', 'Gamido', 'female', 21, 'MNL', 'SC-PWD', 'TU7-353A-91', '09428421218', 'kygamido@gmail.com', '100.00'),
(64, 'Bella', 'Sanchez', 'female', 2, 'MNL', 'MNL-EMP', 'TU7-353A-91', '09428421218', 'kygamido@gmail.com', '0.00'),
(65, 'Khyle', 'Colarina', 'male', 21, 'MNL', 'STUD', 'TN9-156D-45', '09614014131', 'aguilaremman2021@gmail.com', '100.00'),
(66, 'Jessica', 'Verdidz', 'female', 21, 'NON-MNL', 'STUD', 'TY6-346C-18', '09451434859', 'khyleandreicolarina@gmail.com', '200.00'),
(67, 'Emman', 'Colarina', 'male', 21, 'MNL', 'STUD', 'TP5-663D-71', '09614014131', 'aguilaremman2021@gmail.com', '100.00'),
(68, 'Franzel', 'Malabanan', 'male', 21, 'MNL', 'STUD', 'TR8-209D-33', '09957784869', 'franzelm113@gmail.com', '100.00'),
(69, 'Alma', 'Colarina', 'female', 43, 'MNL', 'OTHER-CITIZEN', 'TV2-615A-25', '09451434859', 'khylebcolarina@gmail.com', '0.00'),
(70, 'Yakyak', 'Balot', 'male', 21, 'NON-MNL', 'OTHER-CITIZEN', 'TN8-500C-07', '09451434859', 'khylebcolarina@gmail.com', '0.00'),
(71, 'Yakyak', 'Balot', 'male', 21, 'NON-MNL', 'OTHER-CITIZEN', 'TX9-076A-04', '09451434859', 'khylebcolarina@gmail.com', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details_archive`
--

CREATE TABLE `ticket_details_archive` (
  `Ticket_ID` varchar(11) NOT NULL,
  `Schedule_Date` date DEFAULT NULL,
  `Ticket_Price` int(11) DEFAULT NULL,
  `Guest_Count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_details_archive`
--

INSERT INTO `ticket_details_archive` (`Ticket_ID`, `Schedule_Date`, `Ticket_Price`, `Guest_Count`) VALUES
('TN8-500C-07', '0000-00-00', 0, 1),
('TN9-156D-45', '2024-02-16', 100, 1),
('TP5-663D-71', '2024-02-16', 100, 1),
('TR8-209D-33', '2024-02-16', 100, 1),
('TR8-339A-37', '2024-02-19', 300, 1),
('TU7-353A-91', '2024-02-19', 200, 3),
('TV2-615A-25', '0000-00-00', 0, 1),
('TV4-979D-93', '2024-02-01', 100, 1),
('TX9-076A-04', '0000-00-00', 0, 1),
('TY6-346C-18', '2024-02-16', 200, 1),
('TY7-104A-36', '2024-02-01', 700, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(45) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest_archive`
--
ALTER TABLE `guest_archive`
  ADD PRIMARY KEY (`Guest_No`),
  ADD KEY `Ticket_ID` (`Ticket_ID`);

--
-- Indexes for table `ticket_details_archive`
--
ALTER TABLE `ticket_details_archive`
  ADD PRIMARY KEY (`Ticket_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest_archive`
--
ALTER TABLE `guest_archive`
  MODIFY `Guest_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guest_archive`
--
ALTER TABLE `guest_archive`
  ADD CONSTRAINT `guest_archive_ibfk_1` FOREIGN KEY (`Ticket_ID`) REFERENCES `ticket_details_archive` (`Ticket_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

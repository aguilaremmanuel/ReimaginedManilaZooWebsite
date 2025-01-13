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
-- Database: `u573194023_zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE `event_details` (
  `event_id` int(11) NOT NULL,
  `name_of_event` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `organization_or_entities` varchar(50) DEFAULT NULL,
  `image` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`event_id`, `name_of_event`, `description`, `date`, `organization_or_entities`, `image`) VALUES
(4, 'Conservation Awareness Day', 'Conservation Awareness Day: Help support wildlife conservation efforts by attending our Conservation Awareness Day event! Discover the importance of protecting endangered species and their habitats through interactive exhibits, educational presentations, and hands-on activities for all ages. Learn how you can make a difference in preserving biodiversity and join us in safeguarding the future of our planet.', '2024-03-01', 'GROUP 1', '65d405c2aae150.84296231_Untitled design (4).png'),
(5, 'Wildlife Photography Workshop', 'Wildlife Photography Workshop: Calling all photography enthusiasts! Join us for a Wildlife Photography Workshop and sharpen your skills capturing stunning images of our animal residents. Learn from professional photographers as they share tips and techniques for capturing the perfect shot in a zoo setting. Whether you\'re a beginner or an experienced photographer, this workshop promises to inspire and educate.', '2024-07-22', 'Manila Zoo Administration', '65d4057f251ed4.66679604_Untitled design (3).png'),
(6, 'Twilight Safari Night', 'Twilight Safari Night: Embark on a thrilling adventure under the stars with our Twilight Safari Night event! Explore the zoo after hours and witness the nocturnal behaviors of our animals as they come alive at night. Guided by expert zookeepers, you\'ll discover a different side of Manila Zoo and experience the magic of the animal kingdom after dark.', '2024-04-01', 'Animal Kingdom Foundation', '65d40544f09545.35633945_Untitled design (2).png'),
(7, 'Zookeeper for a Day', 'Zookeeper for a Day: Ever wondered what it\'s like to be a zookeeper? Now\'s your chance to find out! Sign up for our Zookeeper for a Day program and experience a day in the life of caring for our amazing animals. From preparing meals to assisting with enrichment activities, you\'ll get hands-on experience and create memories that will last a lifetime.', '2024-02-29', 'Manila Zoo Administration', '65d404e3b4ec89.05127151_Untitled design (1).png'),
(9, 'Animal Encounter Day', 'Animal Encounter Day: Join us for an unforgettable Animal Encounter Day at Manila Zoo! Get up close and personal with some of our most fascinating animal residents, including lions, tigers, and elephants. Learn about their habitats, behaviors, and conservation efforts while enjoying a fun-filled day with the whole family.', '2024-03-01', 'Philippine Animal Welfare Society', '65d404ba81d823.10040998_Untitled design.png'),
(10, 'asdasdas', 'Conservation Awareness Day: Help support wildlife conservation efforts by attending our Conservation Awareness Day event! Discover the importance of protecting endangered species and their habitats through interactive exhibits, educational presentations, and hands-on activities for all ages. Learn how you can make a difference in preserving biodiversity and join us in safeguarding the future of our planet.', '2024-02-29', 'BSIT 3-2', '65d409b6192067.23454494_ems.png');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
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
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`Guest_No`, `Guest_FirstName`, `Guest_LastName`, `Gender`, `Age`, `Residency`, `Guest_Status`, `Ticket_ID`, `Contact_No`, `Email`, `Price`) VALUES
(149, 'Ghiane ', 'Colarina', 'male', 15, 'MNL', 'STUD', 'TR5-266C-88', '09451434242', 'ghianecolarina@gmail.com', '100.00'),
(151, 'Lorena', 'Tolentino', 'female', 21, 'NON-MNL', 'STUD', 'TT5-650C-85', '09561728456', 'lorenatolentino@gmail.com', '200.00'),
(152, 'Erlinda', 'Colarina', 'female', 68, 'MNL', 'SC-PWD', 'TZ8-054A-32', '09214563212', 'lorenatolentino@gmail.com', '120.00'),
(159, 'Nami', 'San', 'female', 24, 'NON-MNL', 'SC-PWD', 'TY9-006B-97', '09614014131', 'aguilaremman2021@gmail.com', '240.00'),
(160, 'Khyle', 'Sasas', 'male', 21, 'NON-MNL', 'SC-PWD', 'TZ7-571B-44', '09519010912', 'aguilaremman2021@gmail.com', '240.00'),
(161, 'Emman', 'Dela Fuente', 'male', 24, 'MNL', 'SC-PWD', 'TP7-796A-41', '09614014131', 'aguilaremman2021@gmail.com', '120.00'),
(162, 'Oliver', 'Dela Pena', 'male', 25, 'MNL', 'SC-PWD', 'TR7-529B-34', '09614014131', 'aguilaremman2021@gmail.com', '120.00'),
(163, 'Hero', 'Cruz', 'male', 23, 'MNL', 'SC-PWD', 'TR7-529B-34', '09614014131', 'aguilaremman2021@gmail.com', '120.00'),
(164, 'Ricel ', 'Celzo', 'female', 23, 'NON-MNL', 'STUD', 'TN6-451B-32', '09614014131', 'aguilaremman2021@gmail.com', '200.00'),
(165, 'Franzel', 'Malabanan', 'male', 23, 'NON-MNL', 'SC-PWD', 'TS9-834A-67', '09614014131', 'aguilaremman2021@gmail.com', '240.00'),
(168, 'Kint', 'Haha', 'male', 78, 'NON-MNL', 'SC-PWD', 'TX7-621D-12', '09535667643', 'kk@gmail.com', '240.00'),
(170, 'Franzel', 'Malabanan', 'male', 18, 'MNL', 'STUD', 'TS6-108A-23', '09957784869', 'franzelm113@gmail.com', '100.00'),
(171, 'Francesca', 'Malabanan', 'male', 21, 'MNL', 'STUD', 'TR6-651B-87', '09957784869', 'frncscmalabanan@gmail.com', '100.00'),
(173, 'Emman', 'Aguilar', 'male', 21, 'MNL', 'STUD', 'TZ5-650A-08', '09614014131', 'aguilaremman2021@gmail.com', '100.00'),
(174, 'Kenneth', 'Alcira', 'male', 24, 'NON-MNL', 'STUD', 'TZ7-456B-65', '09129160784', 'kenneth@gmail.com', '200.00'),
(175, 'Juan', 'Dela Cruz', 'male', 20, 'MNL', 'STUD', 'TT4-708C-92', '09423445234', 'juandelacruz@gmail.com', '100.00'),
(178, 'Emman', 'Aguilar', 'male', 23, 'MNL', 'STUD', 'TY7-296C-39', '09614014131', 'aguilaremman2021@gmail.com', '100.00'),
(181, 'Caleb', 'Curry', 'male', 23, 'NON-MNL', 'SC-PWD', 'TT9-683D-55', '09614014131', 'aguilaremman2021@gmail.com', '240.00'),
(182, 'Miguel', 'Hernandez', 'male', 21, 'MNL', 'OTHER-CITIZEN', 'TW3-895C-96', '09451434859', 'khylebcolarina@gmail.com', '0.00'),
(183, 'Jessica', 'Verdidz', 'female', 21, 'MNL', 'STUD', 'TX5-783A-06', '09451434859', 'khyleandreicolarina@gmail.com', '100.00'),
(184, 'Khyle Andrei', 'Colarina', 'female', 21, 'MNL', 'SC-PWD', 'TX2-648C-13', '09451434859', 'khylebcolarina@gmail.com', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `operational_status`
--

CREATE TABLE `operational_status` (
  `operation_no` int(11) NOT NULL,
  `operation_date` date NOT NULL,
  `creation_date` date NOT NULL,
  `operation_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operational_status`
--

INSERT INTO `operational_status` (`operation_no`, `operation_date`, `creation_date`, `operation_type`) VALUES
(1, '2024-02-25', '2024-02-19', 'maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `Date` int(11) NOT NULL,
  `Slots` int(11) DEFAULT 5000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`Date`, `Slots`) VALUES
(1, 4996),
(2, 5000),
(3, 5000),
(4, 5000),
(5, 5000),
(6, 5000),
(7, 5000),
(8, 5000),
(9, 5000),
(10, 5000),
(11, 5000),
(12, 5000),
(13, 5000),
(14, 5000),
(15, 5000),
(16, 4994),
(17, 5000),
(18, 5000),
(19, 4996),
(20, 4996),
(21, 4999),
(22, 4997),
(23, 4995),
(24, 4998),
(25, 4999),
(26, 4997),
(27, 5000),
(28, 4993),
(29, 4998),
(30, 30),
(31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_animal`
--

CREATE TABLE `tb_animal` (
  `animal_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(75) NOT NULL,
  `description` text DEFAULT NULL,
  `scientific_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `sound` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_animal`
--

INSERT INTO `tb_animal` (`animal_no`, `name`, `image`, `description`, `scientific_name`, `category`, `sound`) VALUES
(21, 'Peacock', '65d32e89cf5db8.18772685_[avian] pikak.jpg', 'shiny blue bird', 'Pavo Cristatus', 'avian', '65d32e89cfaa38.11940347_[avian] pikak.mp3'),
(22, 'Bleeding Heart Pigeon', '65d32ec6100693.24289947_[avian] heart pigeon.jpg', 'dark red patch on its breast that looks like a bleeding wound', 'Gallicumba Luzonica', 'avian', '65d32ec6106904.83612926_[avian] pijon.mp3'),
(23, 'Philippine Eagle', '65d32efda6f285.14619903_[avian] igol.jpg', 'monkey-eating eagle', 'Pithecophaga jefferyi', 'avian', '65d32efda72141.39415792_[avian] igol.mp3'),
(24, 'Reticulated Python', '65d334b2733817.40910086_[reptiles] piton.jpeg', 'Python species native to West and Central Africa', 'Python Regius', 'reptiles', '65d334b273ff02.97636115_[reptile] snake.mp3'),
(25, 'Goldfish', '65d334f5c61401.50972935_[aquatic] gokldfish.jpg', 'freshwater cyprinid fish', 'Carassius auratus', 'aquatic', '65d334f5c63091.49357628_[aquatic] gokldfish.mp3'),
(26, 'Alligator Gar', '65d33556147419.73522317_[aquatic] gar.jpg', 'Largest species in the gar family, and is among the largest freshwater fish in North America', 'Atractosteus spatula', 'aquatic', '65d335561491b3.43691859_[aquatic] gar.mp3'),
(27, 'Oscar', '65d336a14c8b20.63445992_[aquatic] oscar-fish.jpeg', 'Species of fish from the cichlid family', 'Astronotus ocellatus', 'aquatic', '65d336a14cae60.57247213_[aquatic] oscar.mp3'),
(28, 'African Lion', '65d337629353e9.82671616_[mammals] lion.jpg', 'Strong, compact bodies and powerful forelegs, teeth and jaws for pulling down and killing prey', 'Panthera Leo', 'mammals', '65d33762937765.69157557_[mammals] lion.mp3'),
(29, 'Siberian Tiger', '65d337ad112d07.00209447_[mammals] tiger.jpg', 'Larger than the Bengal tiger; its pelage is thicker and brighter.', 'Panthera Tigris Altaica', 'mammals', '65d337ad115125.14202385_[mammals] tiger.mp3'),
(30, 'Ape', '65d3380621c6d9.37424188_[mammals] ape.jpg', 'A large primate that lacks a tail', 'Macaca Nigra', 'mammals', '65d3380621f0c0.35153132_[mammals] ape.mp3'),
(31, 'Sailfin Lizard', '65d338a165e605.19752117_[reptiles] lizard.jpeg', 'Large semiaquatic agamid lizard endemic to all of the major island groups of the Philippines', 'Hydrosaurus Pustulatus', 'reptiles', '65d338a1660c62.26021300_[reptile] lizard.mp3'),
(32, 'Box Turtle', '65d339136a99a1.12525439_[reptiles] turtol.jpeg', 'Common name for several species of turtle', 'Cuora Amboinensis', 'reptiles', '65d339136b8880.08722611_[reptile] turtol.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_plants`
--

CREATE TABLE `tb_plants` (
  `plant_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(75) NOT NULL,
  `description` text DEFAULT NULL,
  `scientific_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_plants`
--

INSERT INTO `tb_plants` (`plant_no`, `name`, `image`, `description`, `scientific_name`, `category`) VALUES
(3, 'Boungainvillea', '65cec6c3e5b773.09300171_bougain.jpg', 'Small and cream coloured, tube in shape, flowers continuously through the entire branch, covered by distinctive triangle-shaped, pointed red bracts.', NULL, NULL),
(4, 'Copper Leaf', '65cec74a8eca68.17313395_cooper leaf.jpg', 'An ornamental evergreen bushy shrub to 2m tall cultivated for its showy colourful foliage.', NULL, NULL),
(5, 'Dracaena trifasciata Plant', '65cec8c1a9bbb5.15828402_lhf-55606-dracaena-trifasciata-t1-min-1024x538.jpg', 'species of flowering plant in the family Asparagaceae', NULL, NULL),
(6, 'Monstera', '65cec99f8fc628.28683059_monstera.jpeg', 'genus of 59 species of flowering plants in the arum family, Araceae, native to tropical regions of the Americas. ', NULL, NULL),
(7, 'Aglaonema', '65ced66eaba802.65789891_aglao.jpg', 'Genus of flowering plants in the arum family, Araceae.', NULL, NULL),
(8, 'Spider Lily', '65ced69e05e3e7.73089906_lily.jpg', 'Plant in the amaryllis family, Amaryllidaceae, subfamily Amaryllidoideae', NULL, NULL),
(9, 'Mayana', '65ced7206f40e3.29070906_mayana.jpg', 'Used for pain, sore, swelling and cuts and in other instances as adjunct medication for delayed menstruation and diarrhea.', NULL, NULL),
(10, 'Fortune Plant', '65ced7612add41.52099512_fortune.png', 'Most commonly known in the Philippines as Fortune Plant is one of the best air-purifying plants.', NULL, NULL),
(11, 'Iresine', '65ced886ab3aa5.55721802_iresene.jpg', 'Iresine is a genus of flowering plants in the family Amaranthaceae', NULL, NULL),
(12, 'White Moa', '65ced8f4e7a2c9.78346419_white moa.jpg', 'Houseplant Bonsai-Like Nice for indoor and outdoor', NULL, NULL),
(13, 'Japanese Bamboo', '65ced9222e6e29.53398463_bambu.jpg', 'Species of herbaceous perennial plant in the knotweed and buckwheat family Polygonaceae', NULL, NULL),
(14, 'Blue Plumbago', '65ced94b813028.42800905_plumbago.jpg', 'Species of flowering plant in the family Plumbaginaceae, native to South Africa and Mozambique.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `Ticket_ID` varchar(11) NOT NULL,
  `Schedule_Date` date DEFAULT NULL,
  `Ticket_Price` int(11) DEFAULT NULL,
  `Guest_Count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`Ticket_ID`, `Schedule_Date`, `Ticket_Price`, `Guest_Count`) VALUES
('TN6-451B-32', '2024-02-28', 200, 1),
('TP7-796A-41', '2024-02-26', 120, 1),
('TR5-266C-88', '2024-02-24', 100, 1),
('TR6-651B-87', '2024-02-23', 100, 1),
('TR7-529B-34', '2024-02-28', 240, 2),
('TS6-108A-23', '2024-02-23', 100, 1),
('TS9-834A-67', '2024-02-25', 240, 1),
('TT4-708C-92', '2024-02-26', 100, 1),
('TT5-650C-85', '2024-02-23', 200, 1),
('TT9-683D-55', '2024-02-22', 240, 1),
('TW3-895C-96', '2024-02-29', 0, 1),
('TX2-648C-13', '2024-02-21', 120, 1),
('TX5-783A-06', '2024-02-20', 100, 1),
('TX7-621D-12', '2024-02-22', 240, 1),
('TY7-296C-39', '2024-02-29', 100, 1),
('TY9-006B-97', '2024-02-22', 240, 1),
('TZ5-650A-08', '2024-02-24', 100, 1),
('TZ7-456B-65', '2024-02-23', 200, 1),
('TZ7-571B-44', '2024-02-26', 240, 1),
('TZ8-054A-32', '2024-02-28', 120, 1);

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
-- Indexes for table `event_details`
--
ALTER TABLE `event_details`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`Guest_No`),
  ADD KEY `guest_ibfk_1` (`Ticket_ID`);

--
-- Indexes for table `operational_status`
--
ALTER TABLE `operational_status`
  ADD PRIMARY KEY (`operation_no`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`Date`);

--
-- Indexes for table `tb_animal`
--
ALTER TABLE `tb_animal`
  ADD PRIMARY KEY (`animal_no`);

--
-- Indexes for table `tb_plants`
--
ALTER TABLE `tb_plants`
  ADD PRIMARY KEY (`plant_no`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
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
-- AUTO_INCREMENT for table `event_details`
--
ALTER TABLE `event_details`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `Guest_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `operational_status`
--
ALTER TABLE `operational_status`
  MODIFY `operation_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_animal`
--
ALTER TABLE `tb_animal`
  MODIFY `animal_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_plants`
--
ALTER TABLE `tb_plants`
  MODIFY `plant_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`Ticket_ID`) REFERENCES `ticket_details` (`Ticket_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

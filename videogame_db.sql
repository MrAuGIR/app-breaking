-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2023 at 07:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videogame_db`
--
CREATE DATABASE IF NOT EXISTS `videogame_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `videogame_db`;

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE `developers` (
  `developer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developers`
--

INSERT INTO `developers` (`developer`) VALUES
('343 Industries'),
('CD Projekt Red'),
('EA Tiburon'),
('Nintendo EPD'),
('Rockstar Studios');

-- --------------------------------------------------------

--
-- Table structure for table `esrbs`
--

CREATE TABLE `esrbs` (
  `esrb` varchar(50) NOT NULL,
  `acronym` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `esrbs`
--

INSERT INTO `esrbs` (`esrb`, `acronym`, `description`) VALUES
('Everyone', 'E', 'Games with this rating contain content that is suitable for all ages, including minimal cartoon, fantasy or mild violence, and/or the infrequent use of mild language.'),
('Everyone 10+', 'E10+', 'Games with this rating contain content that suitable for ages 10 and over, including cartoon, fantasy, or mild violence, mild language, and/or minimal suggestive themes'),
('Mature 17+', 'M', 'Games with this rating contain content that is suitable for ages 17 and over, including intense violence, blood and gore, sexual content, strong language, drug use, nudity, and/or crude humor.'),
('Rating Pending', 'RP', 'This symbol is used in promotional materials for games which have not yet been assigned a final rating by the ESRB.'),
('Teen', 'T', 'Games with this rating contain content that is suitable for ages 13 and over, including violence, suggestive themes, crude humor, minimal blood, and/or infrequent use of strong language.');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `developer` varchar(50) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `esrb` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `price` float NOT NULL,
  `description` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `developer`, `publisher`, `rating`, `esrb`, `image`, `release_date`, `price`, `description`) VALUES
(1, 'Animal Crossing: New Horizons', 'Life Simulation', 'Nintendo EPD', 'Nintendo', 9.5, 'Everyone', 'www/img/animalcrossingnewhorizons.jpg', '2020-03-20', 47.75, 'Animal Crossing: New Horizons is a popular life simulation video game developed by Nintendo. Released in 2020, it takes players to a deserted island where they can create their own paradise. With charming graphics and relaxing gameplay, it offers a refreshing escape from reality. Players can build and customize their homes, develop the island, fish, catch bugs, and interact with anthropomorphic animal villagers. The game follows real-time, allowing players to experience different seasons, events, and activities throughout the year. '),
(2, 'The Witcher 3: Wild Hunt', 'Action-Role Playing', 'CD Projekt Red', 'CD Projekt', 9.3, 'Mature 17+', 'www/img/thewitcher3.webp', '2015-05-19', 27.99, 'The Witcher 3: Wild Hunt is an action role-playing game that takes place in a vast open world filled with intriguing quests and dangerous creatures. As the protagonist, Geralt of Rivia, a skilled monster hunter known as a Witcher, players embark on a thrilling journey to find Geralt\'s adopted daughter and confront the mysterious Wild Hunt. With its stunning graphics, immersive storytelling, and complex character development, The Witcher 3 offers an unparalleled gaming experience. It has garnered critical acclaim and is considered one of the greatest role-playing games ever made.'),
(3, 'Red Dead Redemption 2', 'Action-Adventure', 'Rockstar Studios', 'Rockstar Games', 8.6, 'Mature 17+', 'www/img/rdr2.jfif', '2018-10-26', 20.99, 'Red Dead Redemption 2 is an action-adventure game developed by Rockstar Games. Set in the late 1800s, players assume the role of Arthur Morgan, an outlaw and member of the Van der Linde gang. The game takes place in a vast open world, allowing players to explore and engage in various missions and activities. With a compelling storyline, rich character development, and stunning graphics, Red Dead Redemption 2 has received critical acclaim for its immersive gameplay and attention to detail. The game explores themes of morality, redemption, and the fading American frontier.\r\n'),
(4, 'Madden 23', 'Sports', 'EA Tiburon', 'EA Sports', 4.2, 'Everyone', 'www/img/madden23.jfif', '2022-08-19', 59.99, 'Madden NFL 23 is a 2022 American football video game developed by EA Tiburon (EA Sports) and published by Electronic Arts. Based on the National Football League (NFL), it is an installment in the Madden NFL series and follows the release of Madden NFL 22. Franchise mode features new additions, including free agency tools and additional trade factors. New defensive animations, including mid-air collisions and tackle assists, are available on Next-Gen consoles.'),
(5, 'Halo Infinite', 'First-Person Shooter', '343 Industries', 'Xbox Game Studios', 7.3, 'Teen', 'www/img/haloinfinite.jpg', '2021-12-08', 39.99, 'Halo Infinite is a 2021 first-person shooter game developed by 343 Industries and published by Xbox Game Studios. It is the sixth mainline entry in the Halo series, following Halo 5: Guardians (2015). The campaign follows the human supersoldier Master Chief and his fight against the enemy Banished on the Forerunner ringworld Zeta Halo, also known as Installation 07. Unlike previous installments in the series, the multiplayer portion of the game is free-to-play.');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre`) VALUES
('Action-Adventure'),
('Action-Role Playing'),
('First-Person Shooter'),
('Life Simulation'),
('Sports');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher`) VALUES
('CD Projekt'),
('EA Sports'),
('Nintendo'),
('Rockstar Games'),
('Xbox Game Studios');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `role`) VALUES
(9, 'Jalen', 'Vaughn', 'javaugh@iu.edu', 'javaugh', '$2y$10$c/pNg9C3nbP0gs7HH1ohuuIM2u5SpU9tltCGwi4c7m8aWSAnkcWEK', 1),
(10, 'Ayah', 'Hineiti', 'ahine@iu.edu', 'ahine', '$2y$10$9D5jB4Uv9RXkwFDp5s9VM.yeUX3AvTQsMAWec5Jr4fEKjA8v9WZJO', 1),
(11, 'Phillip', 'Eilers', 'phillipe@iu.edu', 'phillipe', '$2y$10$PnktHyrs45ndJfiuZrpXQeQUsi09aVb5i.MM2R2e248iuZSS7Xqk6', 1),
(12, 'Tom', 'Matrick', 'tmatrick@gmail.com', 'tmatrick', '$2y$10$6NbyBBo33FglHUEIcbSf6Oge/gWt4KQhxJ5u5FxDyRIR6Fd8cmEoC', 2),
(17, 'Tim', 'Mason', 'tmason@gmail.com', 'TIMMAY', '$2y$10$JPGA0/.0yzdYTgn79CmKKOGhMj2a/MsKFKgLhqJWoIikZfiaZy9Fm', 2),
(18, 'Rachel', 'Calidver', 'rachandroll@gmail.com', 'woahwoahgirliegirl2939402', '$2y$10$vgqVLb/VG4hmkFdRbOerS.sBgcpo75Wng3shdKz0rL5pEAGoiCNB.', 2),
(19, 'Barack', 'Obama', 'bigballerindahouse@gmail.com', 'bigballa', '$2y$10$XgQfVE/CCsjPSI5PYo5jFuaTrt3qIAgPlGyREdOSz2PkheHYOeg1u', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`developer`);

--
-- Indexes for table `esrbs`
--
ALTER TABLE `esrbs`
  ADD PRIMARY KEY (`esrb`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`),
  ADD KEY `developer` (`developer`),
  ADD KEY `publisher` (`publisher`),
  ADD KEY `esrb` (`esrb`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

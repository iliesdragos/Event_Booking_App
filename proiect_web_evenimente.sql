-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2023 at 02:32 PM
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
-- Database: `proiect_web_evenimente`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `data_ora` datetime NOT NULL,
  `id_speaker` int(11) NOT NULL,
  `id_eveniment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bilete`
--

CREATE TABLE `bilete` (
  `id` int(11) NOT NULL,
  `cantitate` int(10) NOT NULL,
  `id_eveniment` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bilete`
--

INSERT INTO `bilete` (`id`, `cantitate`, `id_eveniment`, `id_users`) VALUES
(29, 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE `cos` (
  `id` int(11) NOT NULL,
  `cantitate` int(40) NOT NULL,
  `id_eveniment` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evenimente`
--

CREATE TABLE `evenimente` (
  `id` int(11) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `descriere` varchar(800) NOT NULL,
  `imagine` varchar(200) NOT NULL,
  `data_eveniment` datetime NOT NULL,
  `oras` varchar(50) NOT NULL,
  `judet` varchar(50) NOT NULL,
  `adresa` varchar(200) NOT NULL,
  `pret_bilet` decimal(10,2) NOT NULL,
  `code` varchar(255) NOT NULL,
  `id_sponsor` int(11) NOT NULL,
  `id_partener` int(11) NOT NULL,
  `id_speaker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evenimente`
--

INSERT INTO `evenimente` (`id`, `titlu`, `descriere`, `imagine`, `data_eveniment`, `oras`, `judet`, `adresa`, `pret_bilet`, `code`, `id_sponsor`, `id_partener`, `id_speaker`) VALUES
(10, 'Meci caritabil', 'Meci caritabil in vederea strangerii de fonduri pentru a ajuta copiii cu dizabilitati.', 'meci.jpg', '2023-11-22 16:00:00', 'Cluj-Napoca', 'Cluj', 'Cluj Arena', 20.00, 'dfiafrbv', 5, 5, 5),
(11, 'Teatru', 'Piesa de teatru: Harap-Alb', 'teatru.jpg', '2023-11-24 21:00:00', 'Cluj-Napoca', 'Cluj', 'Teatru National Cluj-Napoca', 17.00, 'cvmvoeqq', 4, 6, 6),
(12, 'Esports', 'Major League of Legends', 'esports.jpg', '2023-11-28 11:00:00', 'Bucuresti', 'Bucuresti', 'Romexpo', 100.00, 'ypwelfxs', 6, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `parteneri`
--

CREATE TABLE `parteneri` (
  `id` int(11) NOT NULL,
  `companie` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nr_telefon` varchar(25) NOT NULL,
  `CUI` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parteneri`
--

INSERT INTO `parteneri` (`id`, `companie`, `email`, `nr_telefon`, `CUI`) VALUES
(4, 'RedBull', 'redbull@yahoo.com', '0742218543', 'RO579439291'),
(5, 'Adidas', 'adidas@yahoo.com', '0788399185', 'RO94358239'),
(6, 'Penny Market', 'penny.market@yahoo.com', '0745776321', 'RO42359032');

-- --------------------------------------------------------

--
-- Table structure for table `speakeri`
--

CREATE TABLE `speakeri` (
  `id` int(11) NOT NULL,
  `nume_prenume` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nr_telefon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `speakeri`
--

INSERT INTO `speakeri` (`id`, `nume_prenume`, `email`, `nr_telefon`) VALUES
(4, 'Mircea Bravo', 'mircea.bravo@yahoo.com', '0746348999'),
(5, 'Banel Nicolita', 'banel.nicolita@yahoo.com', '0743559983'),
(6, 'Andreea Esca', 'andreea.esca@yahoo.com', '0743555201');

-- --------------------------------------------------------

--
-- Table structure for table `sponsori`
--

CREATE TABLE `sponsori` (
  `id` int(11) NOT NULL,
  `companie` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nr_telefon` varchar(25) NOT NULL,
  `CUI` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sponsori`
--

INSERT INTO `sponsori` (`id`, `companie`, `email`, `nr_telefon`, `CUI`) VALUES
(4, 'Fortech', 'fortech@yahoo.com', '0745765878', 'RO4101991203'),
(5, 'SuperBet', 'superbet@yahoo.com', '0765567432', 'RO345273214'),
(6, 'Nivea', 'nivea@yahoo.com', '0755377888', 'RO341235313');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nume` varchar(25) NOT NULL,
  `prenume` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(35) NOT NULL,
  `nr_telefon` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nume`, `prenume`, `username`, `password`, `email`, `nr_telefon`, `status`) VALUES
(13, 'admin', 'admin', 'admin', '$2y$10$MuOxyWqB6VP7Te2T5jJf4eaKpfyx3BIBNNk6h5V8L26GrzpGWbJLu', 'admin@yahoo.com', '0725657999', 101),
(14, 'user', 'user', 'user', '$2y$10$2XS3vzrvENzSJhQOBp2DJef3XJgcn6Pbw/n0xoUvBeCqPj1KfvIS6', 'user@yahoo.com', '0724786123', 202),
(18, 'Stezar', 'Alex', 'alexstezar', '$2y$10$RKGCazrTfWS00GIxSMtmfuLpM9j8oXunplZOe6llQYLCzqb7qVzc.', 'alex.stezar07@gmail.com', '0758067864', 202);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eveniment` (`id_eveniment`) USING BTREE,
  ADD KEY `speaker` (`id_speaker`) USING BTREE;

--
-- Indexes for table `bilete`
--
ALTER TABLE `bilete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eveniment` (`id_eveniment`) USING BTREE,
  ADD KEY `users` (`id_users`);

--
-- Indexes for table `cos`
--
ALTER TABLE `cos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eveniment` (`id_eveniment`),
  ADD KEY `user` (`id_users`) USING BTREE;

--
-- Indexes for table `evenimente`
--
ALTER TABLE `evenimente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parteneri` (`id_partener`),
  ADD KEY `speaker` (`id_speaker`) USING BTREE,
  ADD KEY `sponsor` (`id_sponsor`) USING BTREE;

--
-- Indexes for table `parteneri`
--
ALTER TABLE `parteneri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakeri`
--
ALTER TABLE `speakeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsori`
--
ALTER TABLE `sponsori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bilete`
--
ALTER TABLE `bilete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cos`
--
ALTER TABLE `cos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evenimente`
--
ALTER TABLE `evenimente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parteneri`
--
ALTER TABLE `parteneri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `speakeri`
--
ALTER TABLE `speakeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sponsori`
--
ALTER TABLE `sponsori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

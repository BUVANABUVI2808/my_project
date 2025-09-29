-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 05:04 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$u1h3s8c5o5K1tqz0qY4j6eH9zFq0cK3sV0aZQXkP8x2vQ9E1Yb1eG', 'Super Admin', '2025-09-25 04:24:04'),
(3, 'admin1', '$2y$10$CW/1E7tLx06vYjVui2y8Rewu42HF08QXDFxw/Zxwe97Jf5kTpdNxK', 'Site Admin', '2025-09-25 13:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `theatre_id` int(11) DEFAULT NULL,
  `seats_booked` text,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `booked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `movie_id`, `theatre_id`, `seats_booked`, `total_amount`, `booked_at`) VALUES
(1, NULL, 12, 2, 'A2, A3, A4, A5, A6, A7, A8, B1, B2, B3, B4, B5, C1, C2', '2761.20', '2025-09-27 11:04:00'),
(2, NULL, 12, 2, 'A1, B6, B7, B8, C3, C4, C5, C6, C7, C8', '2053.20', '2025-09-27 14:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `theater_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `show_time` datetime DEFAULT NULL,
  `seats_available` int(11) DEFAULT '50',
  `ticket_price` decimal(10,2) NOT NULL DEFAULT '150.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `theater_id`, `title`, `description`, `show_time`, `seats_available`, `ticket_price`) VALUES
(1, NULL, 'Leo', 'An action thriller starring Vijay', '2025-09-25 18:30:00', 97, '150.00'),
(7, NULL, 'Sarkar', 'The movie is about right to vote for an individual.', '2025-09-28 08:00:00', 100, '150.00'),
(8, NULL, 'Coolie', 'Directed by Lokesh. Naga Arjuna, Rajini Kanth were acted in the film.', '2025-09-28 10:00:00', 100, '150.00'),
(9, NULL, 'Sivakasi', 'Family drama acted by actor Thalapathy Vijay and Actress Asin as main characters.', '2026-08-28 05:08:00', 100, '150.00'),
(10, NULL, 'Mersal', 'Thalapathy is the hero and he was double acted in this movie. Actress are Kaajal and Samantha.', '2025-09-27 11:11:00', 100, '150.00'),
(11, NULL, 'Ghilli', 'Actor Thalapathy vijay and actress Thrisha', '2026-08-26 10:00:00', 100, '150.00'),
(12, NULL, 'Azhagiya Tamizh Magan', 'Thalapathy vijay family drama.', '2025-08-25 10:00:00', 100, '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `offer_title` varchar(150) NOT NULL,
  `offer_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `theatre_id`, `offer_title`, `offer_desc`, `created_at`) VALUES
(1, 1, 'Diwali offer.', 'Discount offer for six persons only rs.500.', '2025-09-26 05:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `movie_id`, `theatre_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 2, 5, 'good', '2025-09-26 13:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `location`) VALUES
(1, 'Anand Cinemas', 'Marthandam'),
(2, 'Laxmi theatres', 'Kuzhithurai'),
(3, 'PVP', 'Nagercoil'),
(4, 'Rajesh Theatre', 'Nagercoil'),
(5, 'Theatre', 'Lakshmipuram');

-- --------------------------------------------------------

--
-- Table structure for table `theatre_movies`
--

CREATE TABLE `theatre_movies` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theatre_movies`
--

INSERT INTO `theatre_movies` (`id`, `movie_id`, `theatre_id`) VALUES
(1, 1, 1),
(2, 8, 3),
(3, 9, 2),
(4, 9, 4),
(5, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(11, 'Ammuz', 'ammu@gmail.com', '$2y$10$4pTTKJNijOIf0gq8XhSHD.anQsnNwPbyrtUnOtf1qpqdAMOJk.w6a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movies_theater` (`theater_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theatre_movies`
--
ALTER TABLE `theatre_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theatre_movies`
--
ALTER TABLE `theatre_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_movies_theater` FOREIGN KEY (`theater_id`) REFERENCES `theaters` (`id`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`theatre_id`) REFERENCES `theaters` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`theatre_id`) REFERENCES `theaters` (`id`);

--
-- Constraints for table `theatre_movies`
--
ALTER TABLE `theatre_movies`
  ADD CONSTRAINT `theatre_movies_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `theatre_movies_ibfk_2` FOREIGN KEY (`theatre_id`) REFERENCES `theaters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

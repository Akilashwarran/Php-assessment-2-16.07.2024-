-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2024 at 05:55 PM
-- Server version: 10.6.18-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-july16`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Aki', 'aki@gmail.com', '$2y$10$2xCqg0hUN32GS7gAQd4NDexZuAXQaH1HoJHFWKxPHuhtPCxSgRJoa', 'dp.jpeg', '2024-07-16 06:21:50', '2024-07-16 08:16:03'),
(2, 'Admin', 'akilashwarran.p@gmail.com', '$2y$10$kYpqacF4P.f9eWfuj0QzSejyUj7KqHEL8wv9rAOGElx3zHyZg5zMO', 'house12.jpg', '2024-07-16 07:02:38', '2024-07-16 07:02:38'),
(4, 'Vignesh', 'Vicky@gmail.com', '$2y$10$mSz9hBtzSk0vsY/m44qJGeREakdEJkRO96CawAG0moGeCFB1Z38Tq', 'vicky.jpeg\r\n', '2024-07-16 07:07:27', '2024-07-16 12:12:01'),
(5, 'Vanthana', 'Vanthana@gmail.com', '$2y$10$lo8RYD.VSwL7GRlsZSdnwuJTR3bs/8ARGSxOw1uCj42r90hM2mjni', 'vanthana.jpeg', '2024-07-16 07:15:51', '2024-07-16 12:11:47'),
(6, 'Veena', 'Veena@gmail.com', '$2y$10$b8s3StRVV6daUwh8UXvvC.73XDtGDDtiAs.QqZQ0KUN6WijTjeGwK', 'house12.jpg', '2024-07-16 07:18:46', '2024-07-16 12:08:40'),
(7, 'Paco', 'Paco@gmail.com', '$2y$10$rdCEnqKvq.WCAS4yw2qnXOQUkzkrD9KOgPScfuTcO6jfEqw8LtiIu', 'house12.jpg', '2024-07-16 08:18:25', '2024-07-16 12:09:07'),
(8, 'Hirotaka', 'hirotaka@gmail.com', '$2y$10$mMQvJvCmDFYosVioFAOlMuiO5VI5wBcNoyqO8TIZWCdmPMDvm8eza', 'dp.jpeg', '2024-07-16 11:34:25', '2024-07-16 11:34:25'),
(9, 'Asha', 'asha@gmail.com', '$2y$10$AF2iLa/bEYz64zpFFab/B.IcWj8lZjuQWXgSOQd0vv4PpsZSfo9qG', 'house12.jpg', '2024-07-16 12:21:41', '2024-07-16 12:21:41'),
(10, 'Pattabi', 'pattabi@gmail.com', '$2y$10$OarOv7s2TemG7dYyzQLSwuUlD3RpKwNLOKSyG2a4DtzGm9KubF072', 'house12.jpg', '2024-07-16 12:22:56', '2024-07-16 12:22:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

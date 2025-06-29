-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2025 pada 17.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `health_services`
--

CREATE TABLE `health_services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `health_services`
--

INSERT INTO `health_services` (`id`, `name`, `address`, `latitude`, `longitude`) VALUES
(1, 'Puskesmas I Cilongok', 'Jl. Raya Cilongok - Ajibarang, Cikidang, Cilongok', -7.39317, 109.1234),
(2, 'Puskesmas Banyumas', 'Jl. Gatot Subroto No.181, Banyumas', -7.50793, 109.2955),
(3, 'Puskesmas Purwokerto Selatan', 'Jl. Prof. Mr. Much. Yamin XII, Karangklesem', -7.43777, 109.2379),
(4, 'Puskesmas Purwokerto Utara I', 'Jl. Beringin No.1, Glempang, Bancarkembar, Kec. Purwokerto Utara', -7.41582, 109.2438),
(5, 'Puskesmas Purwojati', 'JL Inpres No.1, Purwojati', -7.49288, 109.1215);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `health_services`
--
ALTER TABLE `health_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `health_services`
--
ALTER TABLE `health_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

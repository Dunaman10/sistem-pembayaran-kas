-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2023 pada 02.55
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `tanggal1` varchar(50) NOT NULL,
  `tanggal2` varchar(50) NOT NULL,
  `tanggal3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `tanggal1`, `tanggal2`, `tanggal3`) VALUES
(10, 'ABDUL FATTAH KHOLID', '221011401476', '', '', ''),
(11, 'AHMAD FAUZI', '221011402242', '', '', ''),
(12, 'AJI MUHAMAD GALIH', '221011401748', '', '', ''),
(13, 'ALIEF AZIANA RIFKY', '221011400666', '', '', ''),
(14, 'ARRIA GEMILANG', '221011400667', 'Lunas', 'Lunas', 'Lunas'),
(15, 'ARYA NUGRAHA', '221011401779', '', '', ''),
(16, 'CHINTYA AYU BRILLIANTI', '221011402647', '', '', ''),
(17, 'DIMAS PRASETYO', '221011400670', '', '', ''),
(18, 'DWIKI ALDIANSYAH', '221011402786', '', '', ''),
(19, 'FACHRI ANGGORO', '221011400669', '', '', ''),
(20, 'FAISHAL AMMAR DZIKRA', '221011401578', '', '', ''),
(21, 'FARIZ TAUFIQ DERMAWAN', '221011401639', '', '', ''),
(22, 'GALAXY ANDI PUTRA PRATAMA', '221011402913', '', '', ''),
(23, 'JULIANSYAH SAPUTRA', '221011400651', '', '', ''),
(24, 'MUHAMAD NANDI IRAWAN', '221011402002', '', '', ''),
(25, 'MUHAMAD ZIAD ABDUL AZIS', '221011400637', '', '', ''),
(26, 'MUHAMMAD AL RIFZKI', '221011401704', '', '', ''),
(27, 'MUHAMMAD ALIYUDDIN AL GHIFARI', '221011400665', '', '', ''),
(28, 'MUHAMMAD ARIEF TRI FATURACHMAN', '221011400650', '', '', ''),
(29, 'MUHAMMAD GILANG ARJUNA', '221011402448', '', '', ''),
(30, 'MUHAMMAD REZA ZULFIKAR', '221011400643', '', '', ''),
(31, 'NIZAR SAYYED LUTFIANTO', '221011400644', '', '', ''),
(32, 'RENDI OKTAVIAN', '221011403264', '', '', ''),
(33, 'RESTU MUHAMAD PUTRA BINTANG', '221011400668', '', '', ''),
(34, 'SHAKA ANARGYA GITA', '221011400677', '', '', ''),
(35, 'SYARIF HIDAYATULLAH', '221011400634', '', '', ''),
(36, 'VICTOR JUAN MUSA ROBO', '221011402224', '', '', ''),
(59, 'YAYANG SULISTYAWATI', '221011401743', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `password` varchar(200) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `nim`, `password`, `role`) VALUES
(14, 'Syarif Hidayatullah', '221011400634', '$2y$10$s47DLNVxYZSEzwWAerRrxudGdDPgV01QoOOjXQCuMvU6nh7pL7RNW', 'Bendahara'),
(33, 'Restu Muhammad', '221011400630', '$2y$10$h4Uxel9oh9YfIJDGAXcM3OR2B.KdWes435sWZXS6OSI5/gAzJS29m', 'Non Bendahara'),
(34, 'Syarif Hidayatullah', '221011400635', '$2y$10$/DDZELGdU9r/f2wp.FEObOf7UkDehWAnYWg7Vte5jGfXWY1CtMNQu', 'Non Bendahara');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

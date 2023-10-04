-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Okt 2023 pada 04.19
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `kd_akun` char(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_akun`
--

INSERT INTO `tbl_akun` (`kd_akun`, `nama_lengkap`, `username`, `password`, `level`) VALUES
('A01', 'Administrator', 'admin', 'admin', 'Admin'),
('A02', 'Petugas Lapangan', 'petlap1', 'petlap', 'petlap'),
('A03', 'Petugas Lapangan', 'petlap2', 'petlap', 'petlap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `idpel` char(20) NOT NULL,
  `nama_pel` varchar(50) NOT NULL,
  `daya` varchar(30) NOT NULL,
  `tipe` char(11) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `pmet` varchar(255) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`idpel`, `nama_pel`, `daya`, `tipe`, `latitude`, `longitude`, `pmet`, `ket`) VALUES
(' 0001', 'Ari', '450VA', ' Pascabayar', '-3.3214959', '114.5919074', 'WhatsApp Image 2023-09-29 at 10.00.57_75b08622.jpg', 'Baik'),
(' 0002', 'Adi', '900VA', ' Prabayar', '-3.3214959', '114.5919074', '', 'Baik'),
(' 0003', 'Ilmi', '900VA', ' Prabayar', '-3.3214959', '114.5919074', '', 'Baik'),
(' 0004', 'Kevin', '450VA', ' Pascabayar', '-2.1757952', '113.9441664', '', 'Baik'),
(' 0005', 'Madun', '450VA', ' Pascabayar', '-2.1757952', '113.9441664', '', 'Rusak');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`kd_akun`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`idpel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

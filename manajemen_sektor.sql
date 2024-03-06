-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Mar 2024 pada 10.55
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
-- Database: `manajemen_sektor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` int(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('PROSPEK','FOLLOWUP','OFFERING','INVOICE','DEALING','DONE') DEFAULT NULL,
  `deleted` int(5) DEFAULT 0,
  `created_by` int(10) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `edited_by` int(10) DEFAULT NULL,
  `edited_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id`, `nama`, `email`, `no_hp`, `alamat`, `status`, `deleted`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(1, 'Asep 1', 'asep@gmail.com', 897778758, 'Indramayu', NULL, 0, 8, '2024-02-27', 8, '2024-02-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_project`
--

CREATE TABLE `jenis_project` (
  `id` bigint(11) NOT NULL,
  `jenis_project` varchar(255) NOT NULL,
  `deleted` int(5) NOT NULL DEFAULT 0,
  `created_date` date DEFAULT NULL,
  `created_by` bigint(11) DEFAULT NULL,
  `edited_date` date DEFAULT NULL,
  `edited_by` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_project`
--

INSERT INTO `jenis_project` (`id`, `jenis_project`, `deleted`, `created_date`, `created_by`, `edited_date`, `edited_by`) VALUES
(1, 'Sektor Kreatif', 0, '2024-02-27', 8, NULL, NULL),
(2, 'Sektor Digital', 0, '2024-02-27', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` varchar(4) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `group` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama`, `alias`, `group`, `description`, `status`) VALUES
('0001', 'User Management', 'USER_MANAGEMENT', 'SETTING', 'USER_MANAGEMENT', 'ACTIVE'),
('1001', 'Dashboard', 'DASHBOARD', 'DASHBOARD', 'DASHBOARD', 'ACTIVE'),
('2001', 'Perusahaan', 'PERUSAHAAN', 'MASTER_DATA', 'PERUSAHAAN', 'ACTIVE'),
('2002', 'Client', 'CLIENT', 'MASTER_DATA', 'CLIENT', 'ACTIVE'),
('2003', 'Jenis Project', 'JENIS_PROJECT', 'MASTER_DATA', 'JENIS_PROJECT', 'ACTIVE'),
('2004', 'Project', 'PROJECT', 'MASTER_DATA', 'PROJECT', 'ACTIVE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` int(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deleted` int(5) DEFAULT 0,
  `created_by` int(10) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `edited_by` int(10) DEFAULT NULL,
  `edited_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `email`, `no_hp`, `alamat`, `deleted`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(1, 'PT Jaya Abadi', 'jaya.abadi@gmail.com', 894445678, 'Jakarta', 0, 8, '2024-02-27', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` bigint(25) NOT NULL,
  `id_jenis_project` int(20) DEFAULT NULL,
  `id_perusahaan` int(20) DEFAULT NULL,
  `id_client` int(20) DEFAULT NULL,
  `nama_project` varchar(255) DEFAULT NULL,
  `durasi_project` varchar(255) DEFAULT NULL,
  `harga` int(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `status` enum('OFFERING','INVOICE','DEALING','DONE') DEFAULT NULL,
  `deleted` int(5) DEFAULT 0,
  `created_date` date DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `edited_by` int(20) DEFAULT NULL,
  `edited_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `id_jenis_project`, `id_perusahaan`, `id_client`, `nama_project`, `durasi_project`, `harga`, `tgl_mulai`, `tgl_akhir`, `status`, `deleted`, `created_date`, `created_by`, `edited_by`, `edited_date`) VALUES
(1, 1, 1, 1, 'Company Profile Video', '1 Bulan', NULL, NULL, NULL, 'DEALING', 0, '2024-03-03', 8, 8, '2024-03-03'),
(2, 2, 1, 1, 'Company Profile Website', '1 Bulan', 2000000, NULL, NULL, 'DONE', 0, '2024-03-03', 8, 8, '2024-03-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `roles` enum('SUPER_ADMIN','ADMIN') DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `deleted` int(5) DEFAULT 0,
  `locked` int(11) NOT NULL DEFAULT 0,
  `lastLogin` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roles`, `foto`, `deleted`, `locked`, `lastLogin`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(8, 'admin', 'admin', 'admin@admin.com', NULL, '$2y$10$j3zJZ8SLfs07ZLeHhnGAWuZ0s1.bi9a0rdpC.HQGnVzNZiTsE3PQa', NULL, 'SUPER_ADMIN', NULL, 0, 0, '2024-03-03 09:57:40', NULL, NULL, '8', '2024-03-03'),
(9, 'asd', 'arip', 'arip@gmail.com', NULL, '$2y$10$j3zJZ8SLfs07ZLeHhnGAWuZ0s1.bi9a0rdpC.HQGnVzNZiTsE3PQa', NULL, 'ADMIN', NULL, 0, 0, '2024-01-21 15:13:51', '8', '2023-12-01', '8', '2024-01-21'),
(10, 'rama', 'rama', 'ramaalfareza999@gmail.com', NULL, '$2y$10$v1oEKBKTFxTQ8xL6Zv6FjOEohAhEzkMImEuoZLTk15qNsMkNKu3z6', NULL, 'ADMIN', NULL, 0, 0, '2024-01-21 15:02:01', '8', '2024-01-21', '8', '2024-01-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_modul`
--

CREATE TABLE `user_modul` (
  `id_modul` varchar(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_modul`
--

INSERT INTO `user_modul` (`id_modul`, `id_user`, `created_at`, `updated_at`) VALUES
('0001', 8, '2024-03-03 09:57:35', NULL),
('1001', 8, '2024-03-03 09:57:35', NULL),
('2001', 8, '2024-03-03 09:57:35', NULL),
('2002', 8, '2024-03-03 09:57:35', NULL),
('2003', 8, '2024-03-03 09:57:35', NULL),
('2004', 8, '2024-03-03 09:57:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_project`
--
ALTER TABLE `jenis_project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_modul`
--
ALTER TABLE `user_modul`
  ADD PRIMARY KEY (`id_modul`,`id_user`),
  ADD UNIQUE KEY `id_modul` (`id_modul`,`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jenis_project`
--
ALTER TABLE `jenis_project`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

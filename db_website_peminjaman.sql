-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Jun 2025 pada 08.58
-- Versi server: 8.0.30
-- Versi PHP: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_website_peminjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `photo`, `nama_barang`, `kondisi`, `lokasi`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'foto-barang/S8ezVuxKPQr0shlTUYecGgPQprIs4LE8sysb0But.jpg', 'Infokus', 'Baik', 'Gedung A', 5, '2025-06-05 01:06:27', '2025-06-05 01:47:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kendaraan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_polisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `photo`, `nama_kendaraan`, `jenis`, `nomor_polisi`, `kondisi`, `created_at`, `updated_at`) VALUES
(1, 'foto-kendaraan/I03JMK0iUBihGE6ZqLMU8BI6wq0qfjEc7guKS9xO.jpg', 'Mobil Avanza', 'Daihatsu', 'B 1234 AA', 'Baik', '2025-06-05 01:07:28', '2025-06-05 01:07:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2025_05_08_074531_create_barang_table', 1),
(6, '2025_05_08_074703_create_tempat_table', 1),
(7, '2025_05_08_074814_create_peminjaman_table', 1),
(8, '2025_05_08_075611_create_pengembalian_table', 1),
(18, '0001_01_01_000001_create_cache_table', 2),
(19, '0001_01_01_000002_create_jobs_table', 2),
(20, '2025_05_08_074236_create_roles_table', 2),
(21, '2025_05_08_074237_create_users_table', 2),
(22, '2025_05_26_091911_create_barang_table', 2),
(23, '2025_05_26_092025_create_ruangan_table', 2),
(24, '2025_05_26_092117_create_kendaraan_table', 2),
(25, '2025_05_26_092311_create_peminjaman_barang_table', 2),
(26, '2025_05_26_092432_create_pengembalian_barang_table', 2),
(27, '2025_05_26_092546_create_peminjaman_ruangan_table', 2),
(28, '2025_05_26_092638_create_pengembalian_ruangan_table', 2),
(29, '2025_05_26_092726_create_peminjaman_kendaraan_table', 2),
(30, '2025_05_26_092920_create_pengembalian_kendaraan_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `surat_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_cetak_surat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_barang`
--

INSERT INTO `peminjaman_barang` (`id`, `user_id`, `barang_id`, `jumlah`, `kegiatan`, `tgl_pinjam`, `tgl_kembali`, `status`, `surat_peminjaman`, `tgl_cetak_surat`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 'Seminar', '2025-06-05', '2025-06-06', 'diterima', 'surat_peminjaman_barang/surat_peminjaman_barang_1.pdf', '2025-06-05', '2025-06-05 01:45:38', '2025-06-05 01:46:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_kendaraan`
--

CREATE TABLE `peminjaman_kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kendaraan_id` bigint UNSIGNED NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `surat_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_cetak_surat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_kendaraan`
--

INSERT INTO `peminjaman_kendaraan` (`id`, `user_id`, `kendaraan_id`, `keperluan`, `tgl_mulai`, `tgl_selesai`, `status`, `surat_peminjaman`, `tgl_cetak_surat`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Nganter Keluarga', '2025-06-05', '2025-06-06', 'diterima', 'surat_peminjaman_kendaraan/surat_peminjaman_kendaraan_1.pdf', '2025-06-05', '2025-06-05 01:45:17', '2025-06-05 01:46:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ruangan_id` bigint UNSIGNED NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `surat_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_cetak_surat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`id`, `user_id`, `ruangan_id`, `kegiatan`, `tgl_mulai`, `tgl_selesai`, `status`, `surat_peminjaman`, `tgl_cetak_surat`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Seminar', '2025-06-05', '2025-06-06', 'diterima', 'surat_peminjaman_ruangan/surat_peminjaman_ruangan_1.pdf', '2025-06-05', '2025-06-05 01:28:30', '2025-06-05 01:34:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_barang`
--

CREATE TABLE `pengembalian_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_barang_id` bigint UNSIGNED NOT NULL,
  `jumlah_dikembalikan` int NOT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `status` enum('belum','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembalian_barang`
--

INSERT INTO `pengembalian_barang` (`id`, `peminjaman_barang_id`, `jumlah_dikembalikan`, `tgl_dikembalikan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2025-06-07', 'dikembalikan', '2025-06-05 01:47:08', '2025-06-05 01:47:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_kendaraan`
--

CREATE TABLE `pengembalian_kendaraan` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_kendaraan_id` bigint UNSIGNED NOT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `status` enum('belum','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembalian_kendaraan`
--

INSERT INTO `pengembalian_kendaraan` (`id`, `peminjaman_kendaraan_id`, `tgl_dikembalikan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-07', 'dikembalikan', '2025-06-05 01:47:50', '2025-06-05 01:47:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_ruangan`
--

CREATE TABLE `pengembalian_ruangan` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_ruangan_id` bigint UNSIGNED NOT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `status` enum('belum','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembalian_ruangan`
--

INSERT INTO `pengembalian_ruangan` (`id`, `peminjaman_ruangan_id`, `tgl_dikembalikan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-07', 'dikembalikan', '2025-06-05 01:47:30', '2025-06-05 01:47:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_role` enum('admin','peminjam','pimpinan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peminjam',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-06-05 08:00:30', '2025-06-05 08:00:30'),
(2, 'peminjam', '2025-06-05 08:00:51', '2025-06-05 08:00:51'),
(3, 'pimpinan', '2025-06-05 08:01:00', '2025-06-05 08:01:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ruangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `photo`, `nama_ruangan`, `kondisi`, `kapasitas`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'foto-ruangan/mpBN6Tb06dGQ7GzzTR1QUo0G68lw9PXbi85GL3uJ.jpg', 'Aula', 'Baik', 100, 'Gedung B', '2025-06-05 01:06:54', '2025-06-05 01:06:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ef3ZurLVtD0xnP5sNbudUyhe5LQelntmv5UICO4S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVpHSlJjUURXRXpoSHlNR0E5NWc3c2EzMDJJYXM4cHA0d0x3dXY0UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly93ZWJzaXRlLXBlbWluamFtYW4udGVzdC9sb2dpbiI7fX0=', 1749113529),
('sNHhSBGu95qjQ6O7YUpxtUMWbGfRQ8J4lAiJxBg8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS2ttSEN6WFJEeUlVYnNzYXpZTTNkT2V5TWxlQWpkQUpXTWFZQ2FjZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly93ZWJzaXRlLXBlbWluamFtYW4udGVzdC9kYXNoYm9hcmQvYWRtaW4va2Vsb2xhLWJhcmFuZyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1749113851);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `photo`, `username`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'foto-users/YUHIIsZpaX3urwlDNX9gtmS5rxnZa6FzSQTYaFkz.png', 'Fauzan Hidayat', 'fauzan@gmail.com', '$2y$12$7mDPt4OAJyMLN7aQLhO2IeID3.FUN5raRRy/0K7jvNbfzcE0jNkwq', 1, NULL, '2025-06-05 01:01:56', '2025-06-05 01:56:35'),
(2, 'foto-users/Tjkn0lvgINliv1KKpQZeMwr88v9uOoc9wJDK2q5i.png', 'Izha Muntaha', 'izha@gmail.com', '$2y$12$9FFxVp6dmX5aBLZgXJGbse4W.HwCQO5hgXsgmUK9MM49PupwEl0Za', 2, NULL, '2025-06-05 01:03:11', '2025-06-05 01:56:07'),
(3, 'foto-users/jLpzlNeV1AmtJeCXXofrPR8Jd5eBLbkjk6Sw6PtL.png', 'Khosy Taufiq', 'khosy@gmail.com', '$2y$12$GmWOcefvejJrSAuvPPXdbO0vg2qTXIgH02sn9Bx5pdgSFIkdPd7Aa', 3, NULL, '2025-06-05 01:03:59', '2025-06-05 01:55:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kendaraan_nomor_polisi_unique` (`nomor_polisi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_barang_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_barang_barang_id_foreign` (`barang_id`);

--
-- Indeks untuk tabel `peminjaman_kendaraan`
--
ALTER TABLE `peminjaman_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_kendaraan_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_kendaraan_kendaraan_id_foreign` (`kendaraan_id`);

--
-- Indeks untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_ruangan_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_ruangan_ruangan_id_foreign` (`ruangan_id`);

--
-- Indeks untuk tabel `pengembalian_barang`
--
ALTER TABLE `pengembalian_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_barang_peminjaman_barang_id_foreign` (`peminjaman_barang_id`);

--
-- Indeks untuk tabel `pengembalian_kendaraan`
--
ALTER TABLE `pengembalian_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_kendaraan_peminjaman_kendaraan_id_foreign` (`peminjaman_kendaraan_id`);

--
-- Indeks untuk tabel `pengembalian_ruangan`
--
ALTER TABLE `pengembalian_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_ruangan_peminjaman_ruangan_id_foreign` (`peminjaman_ruangan_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_kendaraan`
--
ALTER TABLE `peminjaman_kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_barang`
--
ALTER TABLE `pengembalian_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_kendaraan`
--
ALTER TABLE `pengembalian_kendaraan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_ruangan`
--
ALTER TABLE `pengembalian_ruangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD CONSTRAINT `peminjaman_barang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `peminjaman_barang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_kendaraan`
--
ALTER TABLE `peminjaman_kendaraan`
  ADD CONSTRAINT `peminjaman_kendaraan_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`),
  ADD CONSTRAINT `peminjaman_kendaraan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `peminjaman_ruangan_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`),
  ADD CONSTRAINT `peminjaman_ruangan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_barang`
--
ALTER TABLE `pengembalian_barang`
  ADD CONSTRAINT `pengembalian_barang_peminjaman_barang_id_foreign` FOREIGN KEY (`peminjaman_barang_id`) REFERENCES `peminjaman_barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_kendaraan`
--
ALTER TABLE `pengembalian_kendaraan`
  ADD CONSTRAINT `pengembalian_kendaraan_peminjaman_kendaraan_id_foreign` FOREIGN KEY (`peminjaman_kendaraan_id`) REFERENCES `peminjaman_kendaraan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengembalian_ruangan`
--
ALTER TABLE `pengembalian_ruangan`
  ADD CONSTRAINT `pengembalian_ruangan_peminjaman_ruangan_id_foreign` FOREIGN KEY (`peminjaman_ruangan_id`) REFERENCES `peminjaman_ruangan` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

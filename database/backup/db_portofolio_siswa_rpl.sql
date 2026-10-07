-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2026 at 03:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portofolio_siswa_rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role` enum('admin','superadmin') DEFAULT 'admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `email`, `foto`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$admin123admin123admin123admin123', 'Admin Portofolio', 'admin@portofolio.sch.id', NULL, 'superadmin', '2026-09-30 09:20:04', '2026-09-30 09:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `deskripsi`, `icon`, `created_by`, `created_at`) VALUES
(1, 'Web App', 'Aplikasi berbasis website untuk kebutuhan sekolah, bisnis, dan umum.', 'web', 1, '2026-09-30 09:53:31'),
(2, 'Mobile App', 'Aplikasi yang dikembangkan untuk perangkat mobile.', 'mobile', 1, '2026-09-30 09:53:31'),
(3, 'Game', 'Proyek game yang dibuat menggunakan teknologi pemrograman.', 'game', 1, '2026-09-30 09:53:31'),
(4, 'Desktop App', 'Aplikasi yang dijalankan pada komputer atau laptop.', 'desktop', 1, '2026-09-30 09:53:31'),
(5, 'Database', 'Proyek yang berfokus pada pengelolaan dan pengembangan database.', 'database', 1, '2026-09-30 09:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama_pengunjung` varchar(100) DEFAULT NULL,
  `email_pengunjung` varchar(100) DEFAULT NULL,
  `isi_komentar` text NOT NULL,
  `status` enum('tampil','disembunyikan') DEFAULT 'tampil',
  `tanggal_komentar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `id_proyek`, `id_siswa`, `nama_pengunjung`, `email_pengunjung`, `isi_komentar`, `status`, `tanggal_komentar`) VALUES
(1, 1, NULL, 'Andi Pratama', 'andi@gmail.com', 'Aplikasi kasirnya mudah digunakan dan tampilannya menarik.', 'tampil', '2026-09-30 11:03:34'),
(2, 1, 2, NULL, NULL, 'Fitur transaksi pada aplikasi ini cukup lengkap.', 'tampil', '2026-09-30 11:03:34'),
(3, 2, NULL, 'Siti Rahma', 'siti@gmail.com', 'Game edukasinya menarik dan cocok untuk pembelajaran anak.', 'tampil', '2026-09-30 11:03:34'),
(4, 3, NULL, 'Budi Santoso', 'budi@gmail.com', 'Sistem inventory ini membantu pengelolaan stok menjadi lebih mudah.', 'tampil', '2026-09-30 11:03:34'),
(5, 5, 3, NULL, NULL, 'Website portofolionya sudah bagus dan informatif.', 'tampil', '2026-09-30 11:03:34'),
(6, 6, NULL, 'Rina Amelia', 'rina@gmail.com', 'Dashboard memiliki tampilan data yang cukup jelas.', 'tampil', '2026-09-30 11:03:34'),
(7, 7, NULL, 'Doni Saputra', 'doni@gmail.com', 'Sistem perpustakaannya terlihat praktis untuk digunakan.', 'disembunyikan', '2026-09-30 11:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proyek`
--

CREATE TABLE `tb_proyek` (
  `id_proyek` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_admin_verifikator` int(11) DEFAULT NULL,
  `judul_proyek` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `link_demo` varchar(255) DEFAULT NULL,
  `link_source_code` varchar(255) DEFAULT NULL,
  `status_proyek` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `catatan_verifikasi` varchar(255) DEFAULT NULL,
  `jumlah_view` int(11) DEFAULT 0,
  `tanggal_upload` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_proyek`
--

INSERT INTO `tb_proyek` (`id_proyek`, `id_siswa`, `id_kategori`, `id_admin_verifikator`, `judul_proyek`, `deskripsi`, `thumbnail`, `link_demo`, `link_source_code`, `status_proyek`, `catatan_verifikasi`, `jumlah_view`, `tanggal_upload`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Aplikasi Kasir Toko', 'Aplikasi kasir berbasis web untuk membantu proses transaksi dan pengelolaan data produk.', 'kasir-toko.jpg', 'https://demo.example.com/kasir', 'https://github.com/aurahafsha/aplikasi-kasir', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 125, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(2, 1, 3, 1, 'Game Edukasi Anak', 'Game edukasi sederhana untuk membantu anak belajar melalui permainan interaktif.', 'game-edukasi.jpg', 'https://demo.example.com/game-edukasi', 'https://github.com/aurahafsha/game-edukasi', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 98, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(3, 2, 1, 1, 'Sistem Inventory Lab', 'Sistem berbasis web untuk mengelola data barang dan stok inventaris laboratorium.', 'inventory-lab.jpg', 'https://demo.example.com/inventory', 'https://github.com/suryabayu/inventory-lab', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 156, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(4, 2, 2, NULL, 'Chat App Mobile', 'Aplikasi komunikasi mobile yang memungkinkan pengguna melakukan percakapan secara realtime.', 'chat-mobile.jpg', NULL, 'https://github.com/suryabayu/chat-app', 'pending', NULL, 42, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(5, 3, 1, 1, 'Website Portofolio', 'Website untuk menampilkan karya dan profil siswa RPL secara terstruktur.', 'website-portfolio.jpg', 'https://demo.example.com/portfolio', 'https://github.com/syafiraeka/website-portfolio', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 203, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(6, 4, 1, 1, 'Dashboard Analytics', 'Dashboard untuk menampilkan data dan statistik dalam bentuk visual yang mudah dipahami.', 'dashboard-analytics.jpg', 'https://demo.example.com/dashboard', 'https://github.com/vincentgabriel/dashboard', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 187, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(7, 5, 1, 1, 'Library Management', 'Sistem pengelolaan perpustakaan untuk mencatat buku, anggota, dan transaksi peminjaman.', 'library-management.jpg', 'https://demo.example.com/library', 'https://github.com/dindaamelia/library-management', 'disetujui', 'Proyek telah diverifikasi oleh admin.', 134, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38'),
(8, 1, 4, NULL, 'Desktop Task Manager', 'Aplikasi desktop untuk membantu pengguna mengatur dan memantau daftar tugas.', 'desktop-task-manager.jpg', NULL, 'https://github.com/aurahafsha/desktop-task-manager', 'pending', NULL, 31, '2026-09-30 10:37:38', '2026-09-30 10:37:38', '2026-09-30 10:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proyek_teknologi`
--

CREATE TABLE `tb_proyek_teknologi` (
  `id` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_teknologi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_proyek_teknologi`
--

INSERT INTO `tb_proyek_teknologi` (`id`, `id_proyek`, `id_teknologi`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5),
(4, 2, 10),
(5, 2, 11),
(6, 3, 1),
(7, 3, 2),
(8, 3, 5),
(9, 4, 3),
(10, 4, 14),
(11, 4, 16),
(12, 5, 1),
(13, 5, 6),
(14, 5, 7),
(15, 6, 4),
(17, 6, 5),
(16, 6, 6),
(18, 7, 1),
(19, 7, 2),
(20, 7, 5),
(21, 8, 1),
(22, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL DEFAULT 'RPL',
  `angkatan` year(4) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `role` enum('siswa') DEFAULT 'siswa',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_lengkap`, `email`, `password`, `kelas`, `jurusan`, `angkatan`, `no_hp`, `foto_profil`, `bio`, `status_akun`, `role`, `created_at`, `updated_at`) VALUES
(1, '2024001', 'Aura Hafsha Trisna Anggira', 'aura@sekolah.sch.id', 'siswa123', 'XII RPL 1', 'RPL', '2024', '081234567801', NULL, 'Siswa RPL yang memiliki minat dalam pengembangan website.', 'aktif', 'siswa', '2026-09-30 09:22:20', '2026-09-30 09:22:20'),
(2, '2024002', 'Muhammad Surya Bayu Saputra', 'surya@sekolah.sch.id', 'siswa123', 'XII RPL 1', 'RPL', '2024', '081234567802', NULL, 'Siswa RPL yang tertarik pada pengembangan aplikasi dan sistem.', 'aktif', 'siswa', '2026-09-30 09:22:20', '2026-09-30 09:22:20'),
(3, '2024003', 'Syafira Eka Wijayanti', 'syafira@sekolah.sch.id', 'siswa123', 'XII RPL 1', 'RPL', '2024', '081234567803', NULL, 'Siswa RPL yang tertarik pada desain dan pengembangan website.', 'aktif', 'siswa', '2026-09-30 09:22:20', '2026-09-30 09:22:20'),
(4, '2024004', 'Vincent Gabriel', 'vincent@sekolah.sch.id', 'siswa123', 'XII RPL 1', 'RPL', '2024', '081234567804', NULL, 'Siswa RPL yang tertarik pada teknologi dan pengembangan aplikasi.', 'aktif', 'siswa', '2026-09-30 09:22:20', '2026-09-30 09:22:20'),
(5, '2024005', 'Dinda Amelia', 'dinda@sekolah.sch.id', 'siswa123', 'XII RPL 2', 'RPL', '2024', '081234567805', NULL, 'Siswa RPL yang memiliki minat dalam pengelolaan sistem informasi.', 'aktif', 'siswa', '2026-09-30 09:22:20', '2026-09-30 09:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_statistik_view`
--

CREATE TABLE `tb_statistik_view` (
  `id_log` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `tanggal_akses` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_statistik_view`
--

INSERT INTO `tb_statistik_view` (`id_log`, `id_proyek`, `ip_address`, `user_agent`, `tanggal_akses`) VALUES
(1, 1, '192.168.1.10', 'Mozilla/5.0 Chrome', '2026-09-30 11:04:51'),
(2, 1, '192.168.1.11', 'Mozilla/5.0 Chrome', '2026-09-30 11:04:51'),
(3, 2, '192.168.1.12', 'Mozilla/5.0 Firefox', '2026-09-30 11:04:51'),
(4, 3, '192.168.1.13', 'Mozilla/5.0 Chrome', '2026-09-30 11:04:51'),
(5, 5, '192.168.1.14', 'Mozilla/5.0 Edge', '2026-09-30 11:04:51'),
(6, 5, '192.168.1.15', 'Mozilla/5.0 Chrome', '2026-09-30 11:04:51'),
(7, 6, '192.168.1.16', 'Mozilla/5.0 Firefox', '2026-09-30 11:04:51'),
(8, 7, '192.168.1.17', 'Mozilla/5.0 Chrome', '2026-09-30 11:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_teknologi`
--

CREATE TABLE `tb_teknologi` (
  `id_teknologi` int(11) NOT NULL,
  `nama_teknologi` varchar(50) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_teknologi`
--

INSERT INTO `tb_teknologi` (`id_teknologi`, `nama_teknologi`, `icon`, `created_at`) VALUES
(1, 'PHP', 'php', '2026-09-30 09:54:09'),
(2, 'Laravel', 'laravel', '2026-09-30 09:54:09'),
(3, 'React', 'react', '2026-09-30 09:54:09'),
(4, 'Vue.js', 'vue', '2026-09-30 09:54:09'),
(5, 'MySQL', 'mysql', '2026-09-30 09:54:09'),
(6, 'JavaScript', 'javascript', '2026-09-30 09:54:09'),
(7, 'HTML/CSS', 'html-css', '2026-09-30 09:54:09'),
(8, 'Python', 'python', '2026-09-30 09:54:09'),
(9, 'Flask', 'flask', '2026-09-30 09:54:09'),
(10, 'Unity', 'unity', '2026-09-30 09:54:09'),
(11, 'C#', 'csharp', '2026-09-30 09:54:09'),
(12, 'Android Studio', 'android-studio', '2026-09-30 09:54:09'),
(13, 'Kotlin', 'kotlin', '2026-09-30 09:54:09'),
(14, 'Node.js', 'nodejs', '2026-09-30 09:54:09'),
(15, 'Express.js', 'express', '2026-09-30 09:54:09'),
(16, 'MongoDB', 'mongodb', '2026-09-30 09:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_testimoni`
--

CREATE TABLE `tb_testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `isi_testimoni` text NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `status` enum('tampil','disembunyikan') DEFAULT 'tampil',
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_testimoni`
--

INSERT INTO `tb_testimoni` (`id_testimoni`, `id_siswa`, `nama`, `isi_testimoni`, `rating`, `status`, `tanggal`) VALUES
(1, 1, 'Aura Hafsha Trisna Anggira', 'Platform ini membantu saya menampilkan hasil karya dengan lebih terstruktur.', 5, 'tampil', '2026-09-30 11:04:02'),
(2, 2, 'Muhammad Surya Bayu Saputra', 'Website portofolio membuat karya siswa lebih mudah untuk diperkenalkan.', 5, 'tampil', '2026-09-30 11:04:02'),
(3, 3, 'Syafira Eka Wijayanti', 'Tampilan dan konsep portofolio sangat membantu dalam mendokumentasikan project.', 4, 'tampil', '2026-09-30 11:04:02'),
(4, NULL, 'Pengunjung Portofolio', 'Karya siswa RPL dapat dilihat dengan mudah dalam satu platform.', 5, 'tampil', '2026-09-30 11:04:02'),
(5, NULL, 'Alumni RPL', 'Website ini dapat menjadi tempat yang baik untuk menampilkan hasil belajar siswa.', 4, 'tampil', '2026-09-30 11:04:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_proyek` (`id_proyek`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_proyek` (`id_proyek`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `tb_proyek`
--
ALTER TABLE `tb_proyek`
  ADD PRIMARY KEY (`id_proyek`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_admin_verifikator` (`id_admin_verifikator`);

--
-- Indexes for table `tb_proyek_teknologi`
--
ALTER TABLE `tb_proyek_teknologi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_pt` (`id_proyek`,`id_teknologi`),
  ADD KEY `id_teknologi` (`id_teknologi`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_statistik_view`
--
ALTER TABLE `tb_statistik_view`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_proyek` (`id_proyek`);

--
-- Indexes for table `tb_teknologi`
--
ALTER TABLE `tb_teknologi`
  ADD PRIMARY KEY (`id_teknologi`),
  ADD UNIQUE KEY `nama_teknologi` (`nama_teknologi`);

--
-- Indexes for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  ADD PRIMARY KEY (`id_testimoni`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_proyek`
--
ALTER TABLE `tb_proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_proyek_teknologi`
--
ALTER TABLE `tb_proyek_teknologi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_statistik_view`
--
ALTER TABLE `tb_statistik_view`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_teknologi`
--
ALTER TABLE `tb_teknologi`
  MODIFY `id_teknologi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD CONSTRAINT `tb_galeri_ibfk_1` FOREIGN KEY (`id_proyek`) REFERENCES `tb_proyek` (`id_proyek`) ON DELETE CASCADE;

--
-- Constraints for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD CONSTRAINT `tb_kategori_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tb_admin` (`id_admin`) ON DELETE SET NULL;

--
-- Constraints for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `tb_komentar_ibfk_1` FOREIGN KEY (`id_proyek`) REFERENCES `tb_proyek` (`id_proyek`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_komentar_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE SET NULL;

--
-- Constraints for table `tb_proyek`
--
ALTER TABLE `tb_proyek`
  ADD CONSTRAINT `tb_proyek_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_proyek_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_proyek_ibfk_3` FOREIGN KEY (`id_admin_verifikator`) REFERENCES `tb_admin` (`id_admin`) ON DELETE SET NULL;

--
-- Constraints for table `tb_proyek_teknologi`
--
ALTER TABLE `tb_proyek_teknologi`
  ADD CONSTRAINT `tb_proyek_teknologi_ibfk_1` FOREIGN KEY (`id_proyek`) REFERENCES `tb_proyek` (`id_proyek`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_proyek_teknologi_ibfk_2` FOREIGN KEY (`id_teknologi`) REFERENCES `tb_teknologi` (`id_teknologi`) ON DELETE CASCADE;

--
-- Constraints for table `tb_statistik_view`
--
ALTER TABLE `tb_statistik_view`
  ADD CONSTRAINT `tb_statistik_view_ibfk_1` FOREIGN KEY (`id_proyek`) REFERENCES `tb_proyek` (`id_proyek`) ON DELETE CASCADE;

--
-- Constraints for table `tb_testimoni`
--
ALTER TABLE `tb_testimoni`
  ADD CONSTRAINT `tb_testimoni_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2023 pada 14.33
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi-user`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Adam Nurfauzan Subiyanto', 'Bogor', '-', 'Retensi Rekam Medis', 'Sistem Informasi Retensi Rekam Medis', 'AdminLTELogo1.png', 'Copy Right &copy;', '1.0.0.0', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) UNSIGNED NOT NULL,
  `kdbarang` varchar(15) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(11) UNSIGNED NOT NULL,
  `nama_kat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `nik` bigint(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `JK` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`nik`, `nama`, `JK`, `tgl_lahir`, `alamat`, `pekerjaan`) VALUES
(2019008023812380, 'Adam Fauzan', 'L', '2023-05-30', 'Desa Yang Paling jauh', 'Kuli Bangunan'),
(2019807277288738, 'Rizal Adrian', 'L', '2001-01-01', 'Desa Nanggeleng', 'Cyber Security');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_remed` int(30) NOT NULL,
  `no_remed` int(30) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `diagnosa` varchar(50) NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `umur_berkas` int(3) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses_menu`
--

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akses_menu`
--

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES
(1, 1, 1, 'Y'),
(2, 1, 2, 'Y'),
(43, 4, 1, 'Y'),
(44, 4, 2, 'N'),
(62, 5, 1, 'N'),
(63, 5, 2, 'N'),
(64, 1, 52, 'Y'),
(65, 4, 52, 'Y'),
(66, 5, 52, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses_submenu`
--

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akses_submenu`
--

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(7, 1, 8, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(13, 1, 14, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(26, 1, 15, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(30, 1, 17, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(32, 1, 18, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(34, 1, 19, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(36, 1, 20, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(59, 4, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(60, 4, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(61, 4, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(62, 4, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(63, 4, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(64, 4, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(65, 4, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(66, 4, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(67, 4, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(68, 4, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(72, 5, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(73, 5, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(74, 5, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(75, 5, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(76, 5, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(77, 5, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(78, 5, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(79, 5, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(80, 5, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(81, 5, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(82, 1, 23, 'Y', 'N', 'N', 'N', 'N', 'N'),
(83, 4, 23, 'Y', 'N', 'N', 'N', 'N', 'N'),
(84, 5, 23, 'Y', 'N', 'N', 'N', 'N', 'N'),
(88, 1, 25, 'Y', 'N', 'N', 'N', 'N', 'N'),
(89, 4, 25, 'Y', 'N', 'N', 'N', 'N', 'N'),
(90, 5, 25, 'Y', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, 'Y', 'Y'),
(2, 'System', '#', 'fas fa-cogs', 2, 'Y', 'Y'),
(52, 'Menu Akses', 'aksesmenu', 'fas fa-hospital-user', 1, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) UNSIGNED NOT NULL,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES
(1, 'Menu', 'menu', 'far fa-circle', 2, 'Y'),
(2, 'SubMenu', 'submenu', 'far fa-circle', 2, 'Y'),
(7, 'Aplikasi', 'aplikasi', 'far fa-circle', 2, 'Y'),
(8, 'User', 'user', 'far fa-circle', 2, 'Y'),
(10, 'User Level', 'userlevel', 'far fa-circle', 2, 'Y'),
(15, 'Barang', 'barang', 'far fa-circle', 32, 'Y'),
(17, 'Kategori', 'kategori', 'far fa-circle', 32, 'Y'),
(18, 'Satuan', 'satuan', 'far fa-circle', 32, 'Y'),
(19, 'Pembelian', 'pembelian', 'far fa-circle', 41, 'Y'),
(20, 'Penjualan', 'penjualan', 'far fa-circle', 41, 'Y'),
(23, 'Pasien', 'pasien', 'fas fa-user-injured', 52, 'Y'),
(25, 'Rekam Medis', 'rekammedis', 'fas fa-notes-medical', 52, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `is_active`) VALUES
(6, 'user', 'Admin', '$2y$05$3bEkbUWiTCavpM5FUUKbu.wdclj8vvsTgy58WSiS7Jje6i3XgZCC6', 1, 'user.jpg', 'Y'),
(12, 'sadamm', 'adamfauzan', '$2y$05$XM2n.wTAtrvAVyKKwJzHeOl8S0O1nnOetyFmLUQwSjXNhdwcVOyK2', 5, NULL, 'Y'),
(13, 'sadam', 'adam fauzan', '$2y$05$HBhUClHFt8Ylrg49dXFGQeAeNAEC24pRgSECFgyW.m3ulfNzI.meu', 4, NULL, 'Y'),
(14, 'petugas', 'adam nurfauzan', '$2y$05$8.2zkf9eIDZw03zEJN6sJOPmeuBt1Z/JPVNz93nAWxCaILirQ4X/2', 1, NULL, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(4, 'Petugas'),
(5, 'Kepala');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`no_remed`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `no_remed` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pasien` (`nik`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

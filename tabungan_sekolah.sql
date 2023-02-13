-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Okt 2022 pada 02.05
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabungan_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'VII'),
(2, 'VIII A'),
(3, 'IX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_petugas` varchar(200) DEFAULT NULL,
  `jk_petugas` varchar(15) DEFAULT NULL,
  `alamat_petugas` text,
  `kontak` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `foto_petugas` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `role` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nip`, `nama_petugas`, `jk_petugas`, `alamat_petugas`, `kontak`, `username`, `password`, `foto_petugas`, `status`, `role`) VALUES
(1, '123', 'Januar', 'PEREMPUAN', 'sijacs', '08123', 'janu', '$2y$10$8JQZKLVZ31m5YfUGQpl15eN5fIsMTRBkrSoCAWOICrm68kbYxLS0S', 'Foto - Januar07Oct2022034333.jpeg', 1, 2),
(2, '997888', 'Hendra Setiawan 1', 'LAKI-LAKI', 'cejlwlc ', '085796552156sss', 'admin', '$2y$10$U0Y5kx6yYSpediJVFYZi3.GswGmwDQVR/FrpGfoOC9pcBDG49ALiC', 'Foto - 16Oct2022035025.jpg', 1, 1),
(3, '987', 'Retno', 'PEREMPUAN', 'Jl. Pangeran Antasari', '12315', 'retno', '$2y$10$ua1PSXlthyQ9cl3fg9TkS.BnA/WKofFOEy3.vscM0Hgd6I1ElMtiO', 'Foto - Retno11Oct2022073123.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(200) DEFAULT NULL,
  `tahun_pelajaran` varchar(20) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `logo_sekolah` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `nis` varbinary(50) DEFAULT NULL,
  `nama_siswa` varchar(200) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `alamat_siswa` text,
  `nama_ortu` varchar(200) DEFAULT NULL,
  `kontak` varchar(25) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `foto_siswa` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `role` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `kelas_id`, `nis`, `nama_siswa`, `jenis_kelamin`, `alamat_siswa`, `nama_ortu`, `kontak`, `username`, `password`, `foto_siswa`, `status`, `role`) VALUES
(7, 1, 0x3137333131333239, 'Lutfi', 'LAKI-LAKI', 'erger', 'Suwartini', '085796552156', 'lutfi', '$2y$10$feeND9twM5kJ9bWEi1M42uRCgpEjORhEyEeazgRemFRLn3OuQrKjm', 'Foto - Lutfi09Oct2022113201.jpg', 1, 3),
(8, 3, 0x39393838373738, 'Endi Febriyanto', 'LAKI-LAKI', '', 'Abe', '08656324234', 'endi', '$2y$10$wbkrStQX7MIcj11WXecpneajz8QEX34VBWboskJveUtDPd8D1dv1u', 'Foto - 16Oct2022093120.jpeg', 1, 3),
(9, 1, 0x313733313133323932, 'Rafael', 'LAKI-LAKI', '', 'Suwartini', '085796552156', 'rafa', '$2y$10$y4MAygA0AEi2W4.CBmK6sur9JTeVYlfYVHfoceFzaipww2PxCBFDS', 'Foto - Rafael13Oct2022124402.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `jumlah_transaksi` int(11) DEFAULT NULL,
  `jenis_transaksi` enum('setor','tarik') DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `tanggal_transaksi`, `siswa_id`, `petugas_id`, `jumlah_transaksi`, `jenis_transaksi`, `keterangan`) VALUES
(1, '2022-10-10', 7, 1, 15000, 'setor', 'Sah'),
(4, '2022-10-11', 7, 1, 7000, 'tarik', NULL),
(5, '2022-10-11', 8, 1, 100000, 'setor', NULL),
(7, '2022-10-13', 8, 1, 200000, 'setor', 'banyak'),
(8, '2022-10-12', 8, 1, 70000, 'tarik', 'beli cupang'),
(9, '2022-10-12', 8, 2, 80000, 'setor', 'okuuu'),
(10, '2022-10-11', 8, 1, 1000000, 'setor', 'belum bisa edit ini');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_user`, `username`, `password`, `role`) VALUES
(2, 'Administrator', 'admin', '$2y$10$INeHu6x4w2Zq1le6F7Y1muYAbwhHi4EKk5aEApWHCY6uFfQGTVDey', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `tb_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

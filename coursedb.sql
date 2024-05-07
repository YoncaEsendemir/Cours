-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 May 2024, 20:03:25
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `coursedb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kategori_ad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_ad`) VALUES
(1, 'Programlama'),
(2, 'Web Geliştirme'),
(3, 'Veri Analizie'),
(4, 'Ofice Uygulamalari'),
(5, 'veri tabani');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `sehir` varchar(50) DEFAULT NULL,
  `hobiler` varchar(50) DEFAULT NULL,
  `data_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `username`, `email`, `password`, `sehir`, `hobiler`, `data_added`) VALUES
(1, 'yuoncafg', 'esendemiryonca@gmail.com', '$2y$10$LvyQabUIVq7yfzAt1OkJGuG9.c4yKnyZ72xuPjDLQ9hM5Ugz2moWa', '06', 'Array', '2024-03-09 20:51:41'),
(2, 'yu4yuo', 'emiryonca@gmail.com', '$2y$10$.tzQRtsBS.QXUP8eUzGtuuCzQ9X15Q684MK7jjEj7d97laCfHibAe', '01', 'Array', '2024-03-10 22:08:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurslar`
--

CREATE TABLE `kurslar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(50) NOT NULL,
  `altBaslik` varchar(200) DEFAULT NULL,
  `aciklama` text DEFAULT NULL,
  `resim` varchar(50) DEFAULT NULL,
  `yorumSayisi` int(11) NOT NULL,
  `begeniSayi` int(11) NOT NULL,
  `onay` tinyint(4) NOT NULL,
  `yayintarih` datetime NOT NULL DEFAULT current_timestamp(),
  `anasayfa` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurslar`
--

INSERT INTO `kurslar` (`id`, `baslik`, `altBaslik`, `aciklama`, `resim`, `yorumSayisi`, `begeniSayi`, `onay`, `yayintarih`, `anasayfa`) VALUES
(1, 'Php Dersler', 'ileri seviye Php Dersleri', 'merhaba merhaba nasilsin php g&uuml;zel bir ders web i&ccedil;in iler seviyeye laravel gerek', 'img1.png', 12, 13, 1, '2023-12-19 09:37:00', 1),
(2, 'C#', 'Sifirdan ileri seviye C# web gelistirme', '', 'img4.png', 12, 13, 1, '2023-12-19 09:37:00', 1),
(3, 'Node.js Kurs', 'Sifirdan ileri seviye Node.js web gelistirme', NULL, 'img3.png', 12, 13, 1, '2023-12-19 09:37:00', 0),
(4, 'Java Script Kurs', 'Sifirdan ileri seviye Java Script web Programlama', NULL, 'img2.png', 12, 13, 1, '2023-12-19 09:37:00', 0),
(17, 'React', 'ileri seviye React kursu', 'ileri seviye React kursu ileri seviye React kursuileri seviye React kursuileri seviye React kursu', 'img2.png', 0, 0, 1, '2023-12-19 10:18:18', 1),
(34, 'Angular', 'başlangiş seviye', '', '', 2, 0, 0, '2023-12-21 22:17:19', 0),
(37, 'React', 'recat kursu', 'iyi bir kurs sifirdan ileri seviye baştan sona kadar ,  iyi bir kurs sifirdan ileri seviye baştan sona kadar \r\n  iyi bir kurs sifirdan ileri seviye baştan sona kadar ,  iyi bir kurs sifirdan ileri seviye baştan sona kadar', 'img4.png', 0, 0, 0, '2024-02-24 17:39:48', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurs_kategori`
--

CREATE TABLE `kurs_kategori` (
  `kurs_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kurs_kategori`
--

INSERT INTO `kurs_kategori` (`kurs_id`, `kategori_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(17, 1),
(17, 2),
(17, 5),
(34, 1),
(34, 2),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(37, 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `kurslar`
--
ALTER TABLE `kurslar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kurs_kategori`
--
ALTER TABLE `kurs_kategori`
  ADD PRIMARY KEY (`kurs_id`,`kategori_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `kurslar`
--
ALTER TABLE `kurslar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `kurs_kategori`
--
ALTER TABLE `kurs_kategori`
  ADD CONSTRAINT `kurs_kategori_ibfk_1` FOREIGN KEY (`kurs_id`) REFERENCES `kurslar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kurs_kategori_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategoriler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

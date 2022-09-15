-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 10. jan 2021 ob 16.57
-- Različica strežnika: 10.4.14-MariaDB
-- Različica PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabele `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `naslov` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `zanr` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `reziser` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `opis` varchar(500) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `imdb_ocena` int(11) NOT NULL,
  `rotten_ocena` int(11) NOT NULL,
  `izid_datum` date NOT NULL,
  `dolzina_cas` int(11) NOT NULL,
  `image_name` varchar(60) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `film`
--

INSERT INTO `film` (`id`, `naslov`, `zanr`, `reziser`, `opis`, `imdb_ocena`, `rotten_ocena`, `izid_datum`, `dolzina_cas`, `image_name`) VALUES
(1, 'Free Guy', 'Akcija, Komedija', 'Shawn Levy', 'A bank teller discovers that he\'s actually an NPC inside a brutal, open world video game. ', 0, 0, '2020-12-10', 120, 'freeguy.jpg'),
(2, 'The Croods: A New Age', 'Animiran', 'Joel Crawford', 'The prehistoric family the Croods are challenged by a rival family the Bettermans, who claim to be better and more evolved. ', 7, 8, '2020-12-10', 95, 'croods.jpg'),
(3, 'Death on the Nile', 'Misteriozni film, Kriminalni film, Drama', 'Kenneth Branagh', 'While on vacation on the Nile, Hercule Poirot must investigate the murder of a young heiress. ', 0, 0, '2020-12-17', 120, 'nile.jpg'),
(4, 'Wonder Woman 1984', 'Akcijski, Sci-fi', 'Patty Jenkins', 'Fast forward to the 1980s as Wonder Woman\'s next big screen adventure finds her facing two all-new foes: Max Lord and The Cheetah. ', 0, 0, '2020-12-24', 120, 'ww84.jpg'),
(5, 'Soul', 'Animiran', 'Pete Docter, Kemp Powers', 'A musician who has lost his passion for music is transported out of his body and must find his way back with the help of an infant soul learning about herself. ', 8, 0, '2020-12-24', 95, 'soul.jpg'),
(6, 'test', 'testZanr', 'TestReziser', 'TestTestTestTestTestTestTestTestTestTest', 8, 8, '0000-00-00', 50, 'flat,750x,075,f-pad,750x1000,f8f8f8.u1 (2).jpg'),
(7, 'test2', 'test2', 'test2', 'test2test2test2test2', 5, 8, '0000-00-00', 50, 'index.jpg'),
(8, 'test3', 'test3', 'test3', 'test3test3test3test3', 8, 65, '2020-12-15', 50, '1e63be39d8e984e41629d0577ec3d709.jpg'),
(10, 'Morbius', 'akcija, drama', 'Daniel Espinosa', 'Biochemist Michael Morbius tries to cure himself of a rare blood disease, but he inadvertently infects himself with a form of vampirism instead.', 7, 7, '2021-03-19', 103, 'morbius.jpg'),
(11, 'No Time To Die', 'akcija, triler', 'Cary Joy Fukunaga', 'James Bond has left active service. His peace is short-lived when Felix Leiter, an old friend from the CIA, turns up asking for help, leading Bond onto the trail of a mysterious villain armed with dangerous new technology', 7, 7, '2021-04-02', 163, 'bond.jpg'),
(12, 'A quiet place 2', 'drama, horor, sci-fi', 'John Krasinski', 'Following the events at home, the Abbott family now face the terrors of the outside world. Forced to venture into the unknown, they realize the creatures that hunt by sound are not the only threats lurking beyond the sand path.', 8, 8, '2021-04-23', 97, 'quiet.jpg'),
(13, 'Black Widow', 'Akcija, Sci-fi', 'Cate Shortland', 'A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 7, 7, '2021-05-07', 108, 'black2.jpg'),
(14, 'testIzgled', 'poskusizgled', 'poskusizgled', 'poskus izgled', 5, 55, '2020-12-18', 12, 'summer skeleton.jpg'),
(15, 'poskus', 'poskus', 'poskjus', 'dfdsfsdf', 5, 55, '2020-12-01', 55, 'bond.jpg'),
(16, 'aslkdjas', 'sadasdas', 'sadas', 'asdasd', 8, 55, '2020-12-08', 55, 'quiet.jpg');

-- --------------------------------------------------------

--
-- Struktura tabele `film_komentar`
--

CREATE TABLE `film_komentar` (
  `id` int(11) NOT NULL,
  `TK_film` int(11) NOT NULL,
  `TK_uporabnik` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `komentar` varchar(500) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `film_komentar`
--

INSERT INTO `film_komentar` (`id`, `TK_film`, `TK_uporabnik`, `ocena`, `komentar`) VALUES
(2, 5, 2, 8, 'kul');

-- --------------------------------------------------------

--
-- Struktura tabele `karta`
--

CREATE TABLE `karta` (
  `id` int(11) NOT NULL,
  `TK_projekcija` int(11) NOT NULL,
  `sedez` varchar(11) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `karta`
--

INSERT INTO `karta` (`id`, `TK_projekcija`, `sedez`, `cena`) VALUES
(1, 36, '7_2', 4),
(2, 36, '6_3', 4),
(3, 37, '1_3', 4),
(4, 38, '2_4', 4);

-- --------------------------------------------------------

--
-- Struktura tabele `kino_komentar`
--

CREATE TABLE `kino_komentar` (
  `id` int(11) NOT NULL,
  `vzdevek` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `opis` varchar(500) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `postavka`
--

CREATE TABLE `postavka` (
  `id` int(11) NOT NULL,
  `TK_racun` int(11) NOT NULL,
  `TK_karta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `projekcija`
--

CREATE TABLE `projekcija` (
  `id` int(11) NOT NULL,
  `TK_film` int(11) NOT NULL,
  `datum` date NOT NULL,
  `ura` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `projekcija`
--

INSERT INTO `projekcija` (`id`, `TK_film`, `datum`, `ura`) VALUES
(1, 1, '2020-12-10', '18:30:00'),
(2, 1, '2020-12-10', '20:45:00'),
(3, 1, '2020-12-11', '18:30:00'),
(4, 1, '2020-12-11', '20:45:00'),
(5, 1, '2020-12-12', '18:30:00'),
(6, 1, '2020-12-12', '20:45:00'),
(7, 1, '2020-12-13', '18:30:00'),
(8, 1, '2020-12-13', '20:45:00'),
(9, 1, '2020-12-14', '18:30:00'),
(10, 1, '2020-12-14', '20:45:00'),
(11, 1, '2020-12-15', '18:30:00'),
(12, 1, '2020-12-15', '20:45:00'),
(13, 1, '2020-12-16', '18:30:00'),
(14, 1, '2020-12-16', '20:45:00'),
(15, 1, '2020-12-17', '18:30:00'),
(16, 1, '2020-12-18', '18:30:00'),
(17, 1, '2020-12-19', '18:30:00'),
(18, 1, '2020-12-20', '18:30:00'),
(19, 1, '2020-12-21', '18:30:00'),
(20, 1, '2020-12-22', '18:30:00'),
(21, 1, '2020-12-23', '18:30:00'),
(22, 2, '2020-12-10', '15:00:00'),
(23, 2, '2020-12-10', '16:45:00'),
(24, 2, '2020-12-11', '15:00:00'),
(25, 2, '2020-12-11', '16:45:00'),
(26, 2, '2020-12-12', '15:00:00'),
(27, 2, '2020-12-12', '16:45:00'),
(28, 2, '2020-12-13', '15:00:00'),
(29, 2, '2020-12-13', '16:45:00'),
(30, 2, '2020-12-14', '15:00:00'),
(31, 2, '2020-12-14', '16:45:00'),
(32, 2, '2020-12-15', '15:00:00'),
(33, 2, '2020-12-15', '16:45:00'),
(34, 2, '2020-12-16', '15:00:00'),
(35, 2, '2020-12-16', '16:45:00'),
(36, 2, '2020-12-17', '15:00:00'),
(37, 2, '2020-12-17', '16:45:00'),
(38, 2, '2020-12-18', '15:00:00'),
(39, 2, '2020-12-18', '16:45:00'),
(40, 2, '2020-12-19', '15:00:00'),
(41, 2, '2020-12-19', '16:45:00'),
(42, 2, '2020-12-20', '15:00:00'),
(43, 2, '2020-12-20', '16:45:00'),
(44, 2, '2020-12-21', '15:00:00'),
(45, 2, '2020-12-21', '16:45:00'),
(46, 2, '2020-12-22', '15:00:00'),
(47, 2, '2020-12-22', '16:45:00'),
(48, 2, '2020-12-23', '15:00:00'),
(49, 2, '2020-12-23', '16:45:00'),
(50, 3, '2020-12-17', '20:45:00'),
(51, 3, '2020-12-18', '20:45:00'),
(52, 3, '2020-12-19', '20:45:00'),
(53, 3, '2020-12-20', '20:45:00'),
(54, 3, '2020-12-21', '20:45:00'),
(55, 3, '2020-12-22', '20:45:00'),
(56, 3, '2020-12-23', '20:45:00'),
(57, 3, '2020-12-24', '18:30:00'),
(58, 3, '2020-12-27', '18:30:00'),
(59, 3, '2020-12-28', '18:30:00'),
(60, 3, '2020-12-29', '18:30:00'),
(61, 3, '2020-12-30', '18:30:00'),
(62, 3, '2020-12-03', '18:30:00'),
(63, 3, '2020-12-04', '18:30:00'),
(64, 4, '2021-01-08', '18:30:00'),
(65, 4, '2021-01-08', '20:45:00'),
(66, 4, '2021-01-09', '18:30:00'),
(67, 4, '2021-01-09', '20:45:00'),
(68, 4, '2021-01-10', '18:30:00'),
(69, 4, '2021-01-10', '20:45:00'),
(70, 4, '2021-01-11', '18:30:00'),
(71, 4, '2021-01-11', '20:45:00'),
(72, 4, '2021-01-12', '18:30:00'),
(73, 4, '2021-01-12', '20:45:00'),
(74, 5, '2021-01-08', '15:00:00'),
(75, 5, '2021-01-08', '16:45:00'),
(76, 5, '2021-01-09', '15:00:00'),
(77, 5, '2021-01-09', '16:45:00'),
(78, 5, '2021-01-10', '15:00:00'),
(79, 5, '2021-01-10', '16:45:00'),
(80, 5, '2021-01-11', '15:00:00'),
(81, 5, '2021-01-11', '16:45:00'),
(82, 5, '2021-01-12', '15:00:00'),
(83, 5, '2021-01-12', '16:45:00'),
(84, 8, '0000-00-00', '00:00:15'),
(85, 8, '2021-01-09', '15:10:00');

-- --------------------------------------------------------

--
-- Struktura tabele `racun`
--

CREATE TABLE `racun` (
  `id` int(11) NOT NULL,
  `TK_uporabnik` int(11) NOT NULL,
  `znesek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `priimek` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `geslo` varchar(45) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `admin_nivo` varchar(5) COLLATE utf8mb4_slovenian_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`id`, `ime`, `priimek`, `email`, `geslo`, `admin_nivo`) VALUES
(2, 'Imesedem', 'Priimeksedem', 'email7@poskus.si', 'b5785f4f093ba76f269551ff40f7077f81de3511', 'false'),
(3, 'admin', 'admin', 'admin@admin.si', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'true');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `film_komentar`
--
ALTER TABLE `film_komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TK_film` (`TK_film`),
  ADD KEY `TK_uporabnik` (`TK_uporabnik`);

--
-- Indeksi tabele `karta`
--
ALTER TABLE `karta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TK_projekcija` (`TK_projekcija`);

--
-- Indeksi tabele `kino_komentar`
--
ALTER TABLE `kino_komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `postavka`
--
ALTER TABLE `postavka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TK_racun` (`TK_racun`),
  ADD KEY `TK_karta` (`TK_karta`);

--
-- Indeksi tabele `projekcija`
--
ALTER TABLE `projekcija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TK_film` (`TK_film`);

--
-- Indeksi tabele `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TK_uporabnik` (`TK_uporabnik`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT tabele `film_komentar`
--
ALTER TABLE `film_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT tabele `karta`
--
ALTER TABLE `karta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `postavka`
--
ALTER TABLE `postavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `projekcija`
--
ALTER TABLE `projekcija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT tabele `racun`
--
ALTER TABLE `racun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `film_komentar`
--
ALTER TABLE `film_komentar`
  ADD CONSTRAINT `film_komentar_ibfk_1` FOREIGN KEY (`TK_film`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `film_komentar_ibfk_2` FOREIGN KEY (`TK_uporabnik`) REFERENCES `uporabnik` (`id`);

--
-- Omejitve za tabelo `karta`
--
ALTER TABLE `karta`
  ADD CONSTRAINT `karta_ibfk_1` FOREIGN KEY (`TK_projekcija`) REFERENCES `projekcija` (`id`);

--
-- Omejitve za tabelo `postavka`
--
ALTER TABLE `postavka`
  ADD CONSTRAINT `postavka_ibfk_1` FOREIGN KEY (`TK_karta`) REFERENCES `karta` (`id`),
  ADD CONSTRAINT `postavka_ibfk_2` FOREIGN KEY (`TK_racun`) REFERENCES `racun` (`id`);

--
-- Omejitve za tabelo `projekcija`
--
ALTER TABLE `projekcija`
  ADD CONSTRAINT `projekcija_ibfk_1` FOREIGN KEY (`TK_film`) REFERENCES `film` (`id`);

--
-- Omejitve za tabelo `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`TK_uporabnik`) REFERENCES `uporabnik` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

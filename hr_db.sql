-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 06:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banka`
--

CREATE TABLE `banka` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `banka`
--

INSERT INTO `banka` (`id`, `naziv`) VALUES
(1, 'NLB banka'),
(2, 'CKB banka'),
(3, 'Erste banka'),
(4, 'Lovcen banka');

-- --------------------------------------------------------

--
-- Table structure for table `dokument`
--

CREATE TABLE `dokument` (
  `id` int(11) NOT NULL,
  `tip_dokumenta_id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL,
  `napomena` text COLLATE utf8_bin DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `radnik_id` int(11) NOT NULL,
  `putanja` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dokument`
--

INSERT INTO `dokument` (`id`, `tip_dokumenta_id`, `naziv`, `napomena`, `datum`, `radnik_id`, `putanja`) VALUES
(3, 1, 'In quo atque in minu', 'Asperiores repellend', '2012-05-10 22:00:00', 12, '../uploads/60393071749fc/6039307174b78.docx'),
(4, 2, 'TEST', 'TEST ...', '2021-02-25 23:00:00', 12, '../uploads/6039323d89b2e/6039323d89d2c.docx');

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id`, `naziv`) VALUES
(1, 'Podgorica'),
(2, 'Budva'),
(3, 'Bar'),
(4, 'Berane');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(255) COLLATE utf8_bin NOT NULL,
  `korisnicko_ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_bin NOT NULL,
  `uloga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `uloga_id`) VALUES
(1, 'Marko', 'Markovic', 'marko', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Filip', 'Filipovic', 'filip', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Table structure for table `radnik`
--

CREATE TABLE `radnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(255) COLLATE utf8_bin NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `jmbg` varchar(13) COLLATE utf8_bin NOT NULL,
  `pol` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `napomena` text COLLATE utf8_bin DEFAULT NULL,
  `grad_id` int(11) DEFAULT NULL,
  `adresa` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `broj` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fotografija` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `telefon1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `telefon2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `kancelarija` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `obrisan` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `radnik`
--

INSERT INTO `radnik` (`id`, `ime`, `prezime`, `datum_rodjenja`, `jmbg`, `pol`, `napomena`, `grad_id`, `adresa`, `broj`, `fotografija`, `telefon1`, `telefon2`, `email`, `kancelarija`, `obrisan`) VALUES
(1, 'Marko', 'Markovic', '1985-01-20', '2001995020016', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'Janko', 'Jankovic', '1980-03-05', '2503994020016', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Nikola', 'Nikolic', '1980-11-10', '2503994020016', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'Nikola', 'Markovic', '1990-11-26', '2503999020016', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'Radnik', 'Neradnik', '2021-01-01', '1003994020016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'Radnik2', 'Test', '2021-01-06', '1111111111111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 'Marko', 'Markovic', '1977-05-14', '', NULL, NULL, 2, 'Placeat eos nihil ', NULL, NULL, '+38267885522', '', 'toqybyty@mailinator.com', 'Sit iste esse dolo', 1),
(8, 'Et commodo enim eius', 'Minim debitis veniam', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 'Dignissimos officiis', 'Nisi autem velit of', '2021-04-14', '', 'Muški', NULL, 4, 'Ex est quia mollitia', NULL, NULL, 'Ipsam ex impedit co', 'Adipisci reiciendis ', 'baxezisu@mailinator.com', 'Dolor eos ex pariatu', 0),
(10, 'Qui voluptatem esse ', 'Aliquam qui molestia', '1972-09-11', '', NULL, NULL, 1, 'Suscipit eaque quo m', NULL, NULL, 'In incididunt vel ip', 'Ullam asperiores vol', 'sisylybo@mailinator.com', 'Id et laudantium se', 1),
(11, 'Cupiditate aut beata', 'Dolor Nam est repell', '2018-03-04', '', 'Ženski', NULL, 2, 'Error quibusdam est ', NULL, NULL, 'Ut enim at eum aliqu', 'Nostrud porro sint v', 'mizo@mailinator.com', 'Cupiditate culpa te', 0),
(12, 'Elit alias officia ', 'Aliquam modi laborum', '2002-12-06', '2503994020016', 'Ženski', NULL, 3, 'Odit et voluptate er', NULL, NULL, 'Tempore do quidem a', 'Voluptatibus omnis d', 'kogugasik@mailinator.com', 'Qui at et debitis te', 0),
(13, 'Officia delectus ab', 'Sunt omnis earum quo', '2015-03-18', '2503994020016', NULL, NULL, 3, 'Cupidatat velit con', NULL, NULL, 'Repellendus Provide', 'Et tempore deserunt', 'padutedy@mailinator.com', 'A non expedita et la', 1),
(14, 'Marija', 'Markovic', '1975-09-03', '', 'Ženski', NULL, 3, 'Est tempore esse n', NULL, NULL, 'Ipsum reprehenderit', 'Quo reprehenderit eu', 'kegerovobi@mailinator.com', 'Ullam molestiae est', 0),
(15, 'Mirko', 'Mirkovic', '2004-01-26', '', 'Ženski', NULL, 4, 'Nisi hic et pariatur', NULL, NULL, 'Qui voluptas eiusmod', 'Enim aliqua Culpa ', 'mytisoz@mailinator.com', 'Iste ut iure sunt di', 0);

-- --------------------------------------------------------

--
-- Table structure for table `radnik_pozicija`
--

CREATE TABLE `radnik_pozicija` (
  `id` int(11) NOT NULL,
  `sektor_id` int(11) NOT NULL,
  `naziv_pozicije` varchar(255) COLLATE utf8_bin NOT NULL,
  `opis_posla` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `napomena` text COLLATE utf8_bin DEFAULT NULL,
  `radnik_id` int(11) NOT NULL,
  `plata` decimal(10,0) NOT NULL,
  `vjestine` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `radnik_pozicija`
--

INSERT INTO `radnik_pozicija` (`id`, `sektor_id`, `naziv_pozicije`, `opis_posla`, `napomena`, `radnik_id`, `plata`, `vjestine`) VALUES
(1, 4, 'Full Stack developer', 'Da radi...', 'test', 1, '1500', NULL),
(2, 4, 'iOS developer', 'Da radi iOS...', 'test 2', 2, '900', NULL),
(3, 4, 'Android developer', 'Da radi app...', 'test 3', 3, '900', NULL),
(4, 1, 'Veniam officia assu', 'Tenetur dolore ex la', 'Qui est voluptatem ', 12, '1900', 'Eius officia aliquip'),
(5, 3, 'Laboris eius nihil a', 'Cillum non eos cillu', 'Voluptatum libero pr', 13, '17', 'Deleniti enim omnis '),
(6, 4, 'Est deleniti quia a', 'Illo veniam ducimus', 'Esse perspiciatis ', 14, '63', 'Laborum aliquip offi'),
(7, 4, 'Sunt in expedita do', 'Obcaecati qui ab aut', 'Ex doloribus sit ne', 15, '44', 'Culpa cillum rem ut ');

-- --------------------------------------------------------

--
-- Table structure for table `radnik_zaposlenje`
--

CREATE TABLE `radnik_zaposlenje` (
  `id` int(11) NOT NULL,
  `datum_pocetka` date NOT NULL DEFAULT current_timestamp(),
  `datum_isteka_ugovora` timestamp NULL DEFAULT NULL,
  `vrsta_zaposlenja_id` int(11) NOT NULL,
  `banka_id` int(11) NOT NULL,
  `broj_zr` varchar(255) COLLATE utf8_bin NOT NULL,
  `napomena` text COLLATE utf8_bin DEFAULT NULL,
  `radnik_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `radnik_zaposlenje`
--

INSERT INTO `radnik_zaposlenje` (`id`, `datum_pocetka`, `datum_isteka_ugovora`, `vrsta_zaposlenja_id`, `banka_id`, `broj_zr`, `napomena`, `radnik_id`, `status`) VALUES
(2, '2010-01-25', NULL, 5, 1, '550-885596-13', NULL, 1, 1),
(3, '2010-01-25', NULL, 5, 1, '550-885596-20', NULL, 2, 1),
(4, '2015-05-01', NULL, 5, 1, '120-885596-55', NULL, 3, 1),
(5, '1989-08-16', NULL, 5, 1, 'Odio dolores est in ', 'Omnis commodi nulla ', 10, 1),
(6, '2007-02-12', NULL, 6, 1, 'Voluptatem irure off', 'Omnis quos aute ea i', 11, 0),
(7, '1982-01-11', NULL, 4, 1, 'Magni voluptas in ve', 'Qui est voluptatem ', 12, 1),
(8, '2014-06-02', NULL, 5, 1, 'Et est omnis consect', 'Voluptatum libero pr', 13, 1),
(9, '1980-08-18', NULL, 5, 2, 'Sed Nam in consequat', 'Esse perspiciatis ', 14, 1),
(10, '1974-01-23', '2021-03-14 23:00:00', 5, 3, 'Nisi quis aliquid ac', 'Ex doloribus sit ne', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE `sektor` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sektor`
--

INSERT INTO `sektor` (`id`, `naziv`) VALUES
(1, 'Uprava'),
(2, 'Marketing'),
(3, 'Kadrovsko'),
(4, 'Development');

-- --------------------------------------------------------

--
-- Table structure for table `tip_dokumenta`
--

CREATE TABLE `tip_dokumenta` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_dokumenta`
--

INSERT INTO `tip_dokumenta` (`id`, `naziv`) VALUES
(1, 'Ugovor'),
(2, 'Prigovor');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_zaposlenja`
--

CREATE TABLE `vrsta_zaposlenja` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vrsta_zaposlenja`
--

INSERT INTO `vrsta_zaposlenja` (`id`, `naziv`) VALUES
(4, 'Na odredjeno'),
(5, 'Na neodredjeno'),
(6, 'Pripravnicki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokument`
--
ALTER TABLE `dokument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dokument_tip` (`tip_dokumenta_id`),
  ADD KEY `fk_dokument_radnik` (`radnik_id`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_korisnik_uloga` (`uloga_id`);

--
-- Indexes for table `radnik`
--
ALTER TABLE `radnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_radnik_grad` (`grad_id`);

--
-- Indexes for table `radnik_pozicija`
--
ALTER TABLE `radnik_pozicija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radnik_zaposlenje`
--
ALTER TABLE `radnik_zaposlenje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_radnik_zaposlenje_radnik` (`radnik_id`),
  ADD KEY `fk_radnik_zaposlenje_banka` (`banka_id`),
  ADD KEY `fk_radnik_zaposlenje_vrsta_zaposlenja` (`vrsta_zaposlenja_id`);

--
-- Indexes for table `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_dokumenta`
--
ALTER TABLE `tip_dokumenta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vrsta_zaposlenja`
--
ALTER TABLE `vrsta_zaposlenja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banka`
--
ALTER TABLE `banka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokument`
--
ALTER TABLE `dokument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `radnik`
--
ALTER TABLE `radnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `radnik_pozicija`
--
ALTER TABLE `radnik_pozicija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `radnik_zaposlenje`
--
ALTER TABLE `radnik_zaposlenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tip_dokumenta`
--
ALTER TABLE `tip_dokumenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vrsta_zaposlenja`
--
ALTER TABLE `vrsta_zaposlenja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokument`
--
ALTER TABLE `dokument`
  ADD CONSTRAINT `fk_dokument_radnik` FOREIGN KEY (`radnik_id`) REFERENCES `radnik` (`id`),
  ADD CONSTRAINT `fk_dokument_tip` FOREIGN KEY (`tip_dokumenta_id`) REFERENCES `tip_dokumenta` (`id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`);

--
-- Constraints for table `radnik`
--
ALTER TABLE `radnik`
  ADD CONSTRAINT `fk_radnik_grad` FOREIGN KEY (`grad_id`) REFERENCES `grad` (`id`);

--
-- Constraints for table `radnik_zaposlenje`
--
ALTER TABLE `radnik_zaposlenje`
  ADD CONSTRAINT `fk_radnik_zaposlenje_vrsta_zaposlenja` FOREIGN KEY (`vrsta_zaposlenja_id`) REFERENCES `vrsta_zaposlenja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

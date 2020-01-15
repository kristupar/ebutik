-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 08:38 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebutik`
--

-- --------------------------------------------------------

--
-- Table structure for table `kolekcija`
--

CREATE TABLE `kolekcija` (
  `kolekcijaID` int(11) NOT NULL,
  `nazivKolekcije` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kolekcija`
--

INSERT INTO `kolekcija` (`kolekcijaID`, `nazivKolekcije`) VALUES
(1, 'Letnja kolekcija'),
(2, 'Zimska kolekcija');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(11) NOT NULL,
  `imeIPrezimeKorisnika` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `korisnickoIme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `korisnickaSifra` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ulogaUSistemu` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `imeIPrezimeKorisnika`, `korisnickoIme`, `korisnickaSifra`, `ulogaUSistemu`) VALUES
(1, 'Kristina Stupar', 'kris', 'kris', 'Administrator'),
(2, 'Milos Simic', 'losmi', 'losmi', 'Korisnik'),
(8, 'Nevena Curcic', 'nevena', 'nevena', 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina`
--

CREATE TABLE `narudzbina` (
  `narudzbinaID` int(11) NOT NULL,
  `korisnikID` int(11) NOT NULL,
  `ukupanIznos` double NOT NULL,
  `status` enum('U procesu obrade','Potvrdjeno','Odbijeno') COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narudzbina`
--

INSERT INTO `narudzbina` (`narudzbinaID`, `korisnikID`, `ukupanIznos`, `status`, `datum`) VALUES
(1, 1, 51600, 'Potvrdjeno', '2020-01-15'),
(2, 1, 41100, 'Odbijeno', '2020-01-15'),
(3, 8, 43200, 'Potvrdjeno', '2020-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `odeca`
--

CREATE TABLE `odeca` (
  `odecaID` int(11) NOT NULL,
  `nazivModela` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena` double NOT NULL,
  `kolekcijaID` int(11) NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odeca`
--

INSERT INTO `odeca` (`odecaID`, `nazivModela`, `cena`, `kolekcijaID`, `slika`) VALUES
(1, 'Black Lava', 6900, 1, 'blackLava.jpg'),
(2, 'Atina Powder', 4500, 1, 'atinapwder.jpg'),
(3, 'Flowrence Black', 11400, 2, 'flowrenceblack.jpg'),
(4, 'Dixie Green', 7800, 1, 'dixiegreen.jpg'),
(6, 'haljina', 666, 2, 'vegeta.png');

-- --------------------------------------------------------

--
-- Table structure for table `stavkanarudzbine`
--

CREATE TABLE `stavkanarudzbine` (
  `rb` int(11) NOT NULL,
  `narudzbinaID` int(11) NOT NULL,
  `odecaID` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stavkanarudzbine`
--

INSERT INTO `stavkanarudzbine` (`rb`, `narudzbinaID`, `odecaID`, `kolicina`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 3),
(3, 1, 4, 4),
(4, 2, 1, 1),
(5, 2, 3, 3),
(6, 3, 1, 1),
(7, 3, 2, 3),
(8, 3, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kolekcija`
--
ALTER TABLE `kolekcija`
  ADD PRIMARY KEY (`kolekcijaID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`);

--
-- Indexes for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD PRIMARY KEY (`narudzbinaID`);

--
-- Indexes for table `odeca`
--
ALTER TABLE `odeca`
  ADD PRIMARY KEY (`odecaID`);

--
-- Indexes for table `stavkanarudzbine`
--
ALTER TABLE `stavkanarudzbine`
  ADD PRIMARY KEY (`rb`),
  ADD KEY `stavkanarudzbine_ibfk_1` (`narudzbinaID`),
  ADD KEY `stavkanarudzbine_ibfk_2` (`odecaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kolekcija`
--
ALTER TABLE `kolekcija`
  MODIFY `kolekcijaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `narudzbina`
--
ALTER TABLE `narudzbina`
  MODIFY `narudzbinaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `odeca`
--
ALTER TABLE `odeca`
  MODIFY `odecaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stavkanarudzbine`
--
ALTER TABLE `stavkanarudzbine`
  MODIFY `rb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stavkanarudzbine`
--
ALTER TABLE `stavkanarudzbine`
  ADD CONSTRAINT `stavkanarudzbine_ibfk_1` FOREIGN KEY (`narudzbinaID`) REFERENCES `narudzbina` (`narudzbinaID`) ON DELETE CASCADE,
  ADD CONSTRAINT `stavkanarudzbine_ibfk_2` FOREIGN KEY (`odecaID`) REFERENCES `odeca` (`odecaID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Jun 2019 um 13:09
-- Server-Version: 10.1.39-MariaDB
-- PHP-Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `notensystem`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `faecher`
--

CREATE TABLE `faecher` (
  `idFaecher` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pruefung`
--

CREATE TABLE `pruefung` (
  `idPruefung` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `grade` double NOT NULL,
  `description` varchar(100) NOT NULL,
  `Users_idUsers` int(11) NOT NULL,
  `Faecher_idFaecher` int(11) NOT NULL,
  `Semester_idSemester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `semester`
--

CREATE TABLE `semester` (
  `idSemester` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`idUsers`, `firstname`, `lastname`, `username`, `password`, `email`) VALUES
(0, 'Fabian', 'Zeller', 'SwissPrekek', '$2y$10$wq7CeshoJbjL70k6WkAqlOkJUIlfWEO4irznlqOpUwyjInAq/gS92', 'fabian.z@eblcom.ch');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `faecher`
--
ALTER TABLE `faecher`
  ADD PRIMARY KEY (`idFaecher`);

--
-- Indizes für die Tabelle `pruefung`
--
ALTER TABLE `pruefung`
  ADD PRIMARY KEY (`idPruefung`),
  ADD KEY `fk_Pruefung_Users_idx` (`Users_idUsers`),
  ADD KEY `fk_Pruefung_Faecher1_idx` (`Faecher_idFaecher`),
  ADD KEY `fk_Pruefung_Semester1_idx` (`Semester_idSemester`);

--
-- Indizes für die Tabelle `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`idSemester`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pruefung`
--
ALTER TABLE `pruefung`
  ADD CONSTRAINT `fk_Pruefung_Faecher1` FOREIGN KEY (`Faecher_idFaecher`) REFERENCES `faecher` (`idFaecher`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pruefung_Semester1` FOREIGN KEY (`Semester_idSemester`) REFERENCES `semester` (`idSemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pruefung_Users` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

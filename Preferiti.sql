-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Lug 06, 2023 alle 23:16
-- Versione del server: 5.7.39
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Preferiti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Directory`
--

CREATE TABLE `Directory` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Link` text,
  `Tipo` varchar(10) DEFAULT NULL,
  `ID_genitore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Directory`
--

INSERT INTO `Directory` (`ID`, `Nome`, `Link`, `Tipo`, `ID_genitore`) VALUES
(1, '/', NULL, 'folder', NULL),
(2, 'home', NULL, 'folder', 1),
(3, 'user', NULL, 'folder', 2),
(4, 'Documents', NULL, 'folder', 3),
(5, 'Photos', NULL, 'folder', 3),
(6, 'Music', NULL, 'folder', 3),
(7, 'guest', NULL, 'folder', 2),
(8, 'Documents', NULL, 'folder', 7),
(9, 'Pictures', NULL, 'folder', 7),
(10, 'var', NULL, 'folder', 1),
(11, 'log', NULL, 'link', 10),
(12, 'www', NULL, 'folder', 10),
(13, 'html', NULL, 'folder', 12),
(14, 'cgi-bin', NULL, 'folder', 12),
(15, 'etc', NULL, 'folder', 1),
(16, 'network', NULL, 'folder', 15),
(17, 'apache2', NULL, 'folder', 15),
(18, 'ssh', NULL, 'folder', 15),
(19, 'Document 1', NULL, 'link', 4),
(20, 'Document 2', NULL, 'link', 4),
(21, 'Picture 1', NULL, 'link', 5),
(22, 'Picture 2', NULL, 'link', 5),
(23, 'Song 1', NULL, 'link', 6),
(109, 'test2', NULL, 'folder', 108),
(110, 'test3', NULL, 'link', 108),
(111, 'Song 2', NULL, 'link', 6),
(114, 'temp', 'templll', 'link', 5);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Directory`
--
ALTER TABLE `Directory`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Directory`
--
ALTER TABLE `Directory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Lug 06, 2023 alle 19:48
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
  `Tipo` varchar(10) DEFAULT NULL,
  `ID_genitore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Directory`
--

INSERT INTO `Directory` (`ID`, `Nome`, `Tipo`, `ID_genitore`) VALUES
(1, '/', 'folder', NULL),
(2, 'home', 'folder', 1),
(3, 'user', 'folder', 2),
(4, 'Documents', 'folder', 3),
(5, 'Pictures', 'folder', 3),
(6, 'Music', 'folder', 3),
(7, 'guest', 'folder', 2),
(8, 'Documents', 'folder', 7),
(9, 'Pictures', 'folder', 7),
(10, 'var', 'folder', 1),
(11, 'log', 'link', 10),
(12, 'www', 'folder', 10),
(13, 'html', 'folder', 12),
(14, 'cgi-bin', 'folder', 12),
(15, 'etc', 'folder', 1),
(16, 'network', 'folder', 15),
(17, 'apache2', 'folder', 15),
(18, 'ssh', 'folder', 15),
(19, 'Document 1', 'link', 4),
(20, 'Document 2', 'link', 4),
(21, 'Picture 1', 'link', 5),
(22, 'Picture 2', 'link', 5),
(23, 'Song 1', 'link', 6),
(109, 'test2', 'folder', 108),
(110, 'test3', 'link', 108),
(111, 'Song 2', 'link', 6);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

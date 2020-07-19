-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Lip 2020, 14:57
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `reports`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE if not exists `user` (
  `userid` int AUTO_INCREMENT PRIMARY KEY ,
  `login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `role` enum('employee','admin') COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`login`, `password`, `role`) VALUES
('test', 'dbc63eeded5452f7ed8d11d645de459d7027d8b19742521f4460119ba7b53e24', 'admin'),
('test1', 'dbc63eeded5452f7ed8d11d645de459d7027d8b19742521f4460119ba7b53e24', 'employee');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `user`

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE if not exists `report` (
  `reportid` int AUTO_INCREMENT PRIMARY KEY,
  `userid` int(11),
   FOREIGN KEY (userid)  REFERENCES user(userid),
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `report` (`userid`, `content`,`createdAt` ) VALUES
(3, 'Kiedys to bylo','2020-07-14 13:33:48');
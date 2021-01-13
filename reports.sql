-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 13 Sty 2021, 17:51
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktura tabeli dla tabeli `dailyTasks`
--

CREATE TABLE `dailyTasks` (
  `id` int(11) NOT NULL,
  `reportid` int(11) DEFAULT NULL,
  `timeForTask` text COLLATE utf8_polish_ci NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `divisionid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `departments`
--

INSERT INTO `departments` (`id`, `divisionid`, `name`) VALUES
(1, 1, 'Konstrukcyjny'),
(2, 1, 'Technologiczny'),
(6, 1, 'Bezpieczeństwa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `departments_tasks`
--

CREATE TABLE `departments_tasks` (
  `id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `departments_tasks`
--

INSERT INTO `departments_tasks` (`id`, `taskid`, `departmentid`) VALUES
(9, 16, 2),
(10, 16, 1),
(11, 16, 6),
(16, 18, 2),
(17, 19, 2),
(18, 20, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'Techniczno-produkcyjny'),
(2, 'Finansowo-księgowy'),
(3, 'Ekonomiczno-handlowy'),
(4, 'Zatrudnieniowo-płacowy'),
(5, 'Administarcja-ogólna'),
(6, 'Zarządzanie i Informatyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Kierownik'),
(2, 'Brygadzista'),
(3, 'Pracownik fizyczny'),
(5, 'Pracownik umysłowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `numberOfHours` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tasks`
--

INSERT INTO `tasks` (`id`, `name`) VALUES
(16, 'testowy5'),
(18, 'testowy2'),
(19, 'testowy3'),
(20, 'testowy4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `login` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `role` enum('employee','admin') COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `postalCode` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `hourlyRate` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `positionid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`userid`, `login`, `password`, `role`, `name`, `lastName`, `phoneNumber`, `postalCode`, `country`, `city`, `token`, `hourlyRate`, `departmentid`, `positionid`) VALUES
(1, 'admin', '', 'admin', '', '', '', '', '', '', '', '', NULL, NULL),
(4, 'testowa@gmail.com', '$2y$10$C/WS9tC4xW44ib4E3Vki.eSZamHHRa3nn4v7p3.cXUQm3K3NRM2HC', 'employee', 'test', 'test', '213213', '33-333', 'Zimbabwe', 'Rzeszow', '5ffcb80631b455ffcb80631b47', '20', 2, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dailyTasks`
--
ALTER TABLE `dailyTasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reportid` (`reportid`);

--
-- Indeksy dla tabeli `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divisionid` (`divisionid`);

--
-- Indeksy dla tabeli `departments_tasks`
--
ALTER TABLE `departments_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indeksy dla tabeli `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`),
  ADD KEY `userid` (`userid`);

--
-- Indeksy dla tabeli `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `departmentid` (`departmentid`),
  ADD KEY `positionid` (`positionid`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dailyTasks`
--
ALTER TABLE `dailyTasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `departments_tasks`
--
ALTER TABLE `departments_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dailyTasks`
--
ALTER TABLE `dailyTasks`
  ADD CONSTRAINT `dailyTasks_ibfk_1` FOREIGN KEY (`reportid`) REFERENCES `report` (`reportid`);

--
-- Ograniczenia dla tabeli `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`divisionid`) REFERENCES `divisions` (`id`);

--
-- Ograniczenia dla tabeli `departments_tasks`
--
ALTER TABLE `departments_tasks`
  ADD CONSTRAINT `departments_tasks_ibfk_1` FOREIGN KEY (`taskid`) REFERENCES `tasks` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `departments_tasks_ibfk_2` FOREIGN KEY (`departmentid`) REFERENCES `departments` (`id`);

--
-- Ograniczenia dla tabeli `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`positionid`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

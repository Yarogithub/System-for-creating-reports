-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 03 Lut 2021, 22:03
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

--
-- Zrzut danych tabeli `dailyTasks`
--

INSERT INTO `dailyTasks` (`id`, `reportid`, `timeForTask`, `name`) VALUES
(1, 1, '8', 'księgowanie dokumentów'),
(2, 2, '8', 'księgowanie dokumentów'),
(3, 3, '8', 'księgowanie dokumentów'),
(4, 4, '8', 'księgowanie dokumentów'),
(5, 5, '8', 'księgowanie dokumentów'),
(6, 6, '8', 'księgowanie dokumentów'),
(7, 7, '8', 'księgowanie dokumentów'),
(8, 8, '8', 'księgowanie dokumentów'),
(9, 9, '8', 'księgowanie dokumentów'),
(10, 10, '4', 'księgowanie dokumentów'),
(11, 10, '4', 'księgowanie wyciągów bankowych'),
(12, 11, '4', 'księgowanie dokumentów'),
(13, 11, '4', 'księgowanie wyciągów bankowych'),
(14, 12, '4', 'księgowanie dokumentów'),
(15, 12, '4', 'księgowanie wyciągów bankowych'),
(16, 13, '4', 'księgowanie dokumentów'),
(17, 13, '4', 'księgowanie wyciągów bankowych'),
(18, 14, '4', 'księgowanie dokumentów'),
(19, 14, '4', 'księgowanie wyciągów bankowych'),
(20, 15, '4', 'księgowanie dokumentów'),
(21, 15, '4', 'księgowanie wyciągów bankowych'),
(22, 16, '8', 'weryfikacja i księgowanie faktur'),
(23, 17, '8', 'Szkolenie'),
(24, 18, '8', 'Szkolenie'),
(25, 19, '8', 'Audyt miesięczny'),
(26, 20, '8', 'Audyt miesięczny'),
(27, 21, '8', 'Analiza warunków kredytów'),
(28, 22, '8', 'Analiza warunków kredytów'),
(29, 23, '8', 'Analiza warunków kredytów'),
(30, 24, '8', 'Analiza warunków kredytów'),
(31, 25, '8', 'Analiza warunków kredytów'),
(32, 26, '8', 'Analiza warunków polis ubezpieczeniowych'),
(33, 27, '8', 'Analiza warunków polis ubezpieczeniowych'),
(34, 28, '8', 'Analiza warunków polis ubezpieczeniowych'),
(35, 29, '8', 'Delegacja'),
(36, 30, '8', 'Delegacja'),
(37, 31, '8', 'Delegacja'),
(38, 32, '8', 'Delegacja'),
(39, 33, '8', 'Delegacja'),
(40, 34, '4', 'Analiza warunków kredytów'),
(41, 34, '4', 'Analiza warunków polis ubezpieczeniowych'),
(42, 35, '4', 'Analiza warunków kredytów'),
(43, 35, '4', 'Analiza warunków polis ubezpieczeniowych'),
(44, 36, '4', 'Analiza warunków kredytów'),
(45, 36, '4', 'Analiza warunków polis ubezpieczeniowych'),
(46, 37, '4', 'Analiza warunków kredytów'),
(47, 37, '4', 'Analiza warunków polis ubezpieczeniowych'),
(48, 38, '4', 'Analiza warunków kredytów'),
(49, 38, '4', 'Analiza warunków polis ubezpieczeniowych'),
(50, 39, '4', 'Analiza warunków kredytów'),
(51, 39, '4', 'Analiza warunków polis ubezpieczeniowych'),
(52, 40, '4', 'Analiza warunków kredytów'),
(53, 40, '4', 'Analiza warunków polis ubezpieczeniowych');

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
(3, 1, 'Postepu-technologicznego'),
(4, 1, 'Bezpieczeństwa'),
(5, 1, 'Higieny Pracy'),
(6, 1, 'Planowania Produkcji'),
(7, 2, 'Księgowy'),
(8, 2, 'Finansowy'),
(9, 3, 'Planowania'),
(10, 3, 'Analiz Ekonomicznych'),
(11, 3, 'Statystyki'),
(12, 3, 'Gospodarki Materiałowej'),
(13, 3, 'Zaopatrzenia'),
(14, 3, 'Zbytu'),
(15, 4, 'Osobowy'),
(16, 4, 'Socjalny'),
(17, 4, 'Szkoleniowy'),
(18, 4, 'Zatrudnieniowy'),
(19, 5, 'Kancelaria główna'),
(20, 5, 'Administracyjno-gospodarczy'),
(21, 5, 'Transportu');

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
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 2, 1),
(23, 2, 2),
(24, 2, 3),
(25, 2, 4),
(26, 2, 5),
(27, 2, 6),
(28, 2, 7),
(29, 2, 8),
(30, 2, 9),
(31, 2, 10),
(32, 2, 11),
(33, 2, 12),
(34, 2, 13),
(35, 2, 14),
(36, 2, 15),
(37, 2, 16),
(38, 2, 17),
(39, 2, 18),
(40, 2, 19),
(41, 2, 20),
(42, 2, 21),
(43, 3, 1),
(44, 3, 2),
(45, 3, 3),
(46, 3, 4),
(47, 3, 5),
(48, 3, 6),
(49, 3, 7),
(50, 3, 8),
(51, 3, 9),
(52, 3, 10),
(53, 3, 11),
(54, 3, 12),
(55, 3, 13),
(56, 3, 14),
(57, 3, 15),
(58, 3, 16),
(59, 3, 17),
(60, 3, 18),
(61, 3, 19),
(62, 3, 20),
(63, 3, 21),
(64, 4, 1),
(65, 4, 2),
(66, 4, 3),
(67, 4, 4),
(68, 4, 5),
(69, 4, 6),
(70, 4, 7),
(71, 4, 8),
(72, 4, 9),
(73, 4, 10),
(74, 4, 11),
(75, 4, 12),
(76, 4, 13),
(77, 4, 14),
(78, 4, 15),
(79, 4, 16),
(80, 4, 17),
(81, 4, 18),
(82, 4, 19),
(83, 4, 20),
(84, 4, 21),
(85, 5, 7),
(86, 6, 7),
(87, 7, 7),
(88, 8, 8),
(89, 9, 8),
(90, 10, 8),
(91, 11, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'Techniczno-produkcyjny'),
(2, 'Finansowo-księgowy'),
(3, 'Ekonomiczno-handlowy'),
(4, 'Zatrudnieniowo-płacowy'),
(5, 'Administarcja Ogólna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Dyrektor generalny'),
(2, 'Dyrektor IT'),
(3, 'Dyrektor finansowy'),
(4, 'Kierownik ds. kluczowych klientów'),
(5, 'Kierownik projektowy'),
(6, 'Dyrektor marketingu'),
(7, 'Doradca Finansowy'),
(8, 'Pracownik magazynowy'),
(9, 'Informatyk'),
(10, 'Księgowa'),
(11, 'Sekretarka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `numberOfHours` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `reportDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `report`
--

INSERT INTO `report` (`reportid`, `userid`, `numberOfHours`, `createdAt`, `updatedAt`, `reportDate`) VALUES
(1, 2, 8, '2021-02-03 21:14:11', '2021-02-03 21:14:11', '2021-02-01'),
(2, 2, 8, '2021-02-03 21:14:33', '2021-02-03 21:14:33', '2021-02-02'),
(3, 2, 8, '2021-02-03 21:14:36', '2021-02-03 21:14:36', '2021-02-03'),
(4, 2, 8, '2021-02-03 21:14:38', '2021-02-03 21:14:38', '2021-02-04'),
(5, 2, 8, '2021-02-03 21:14:40', '2021-02-03 21:14:40', '2021-02-05'),
(6, 2, 8, '2021-02-03 21:14:57', '2021-02-03 21:14:57', '2021-02-08'),
(7, 2, 8, '2021-02-03 21:14:59', '2021-02-03 21:14:59', '2021-02-09'),
(8, 2, 8, '2021-02-03 21:15:01', '2021-02-03 21:15:01', '2021-02-10'),
(9, 2, 8, '2021-02-03 21:15:03', '2021-02-03 21:15:03', '2021-02-11'),
(10, 2, 8, '2021-02-03 21:15:17', '2021-02-03 21:15:17', '2021-02-12'),
(11, 2, 8, '2021-02-03 21:15:21', '2021-02-03 21:15:21', '2021-02-15'),
(12, 2, 8, '2021-02-03 21:15:25', '2021-02-03 21:15:25', '2021-02-16'),
(13, 2, 8, '2021-02-03 21:15:27', '2021-02-03 21:15:27', '2021-02-17'),
(14, 2, 8, '2021-02-03 21:15:29', '2021-02-03 21:15:29', '2021-02-18'),
(15, 2, 8, '2021-02-03 21:15:32', '2021-02-03 21:15:32', '2021-02-19'),
(16, 2, 8, '2021-02-03 21:26:00', '2021-02-03 21:26:00', '2021-02-22'),
(17, 2, 8, '2021-02-03 21:26:27', '2021-02-03 21:26:27', '2021-02-23'),
(18, 2, 8, '2021-02-03 21:26:42', '2021-02-03 21:26:42', '2021-02-24'),
(19, 2, 8, '2021-02-03 21:27:09', '2021-02-03 21:27:09', '2021-02-25'),
(20, 2, 8, '2021-02-03 21:27:21', '2021-02-03 21:27:21', '2021-02-26'),
(21, 3, 8, '2021-02-03 21:46:15', '2021-02-03 21:46:15', '2021-02-01'),
(22, 3, 8, '2021-02-03 21:46:22', '2021-02-03 21:46:22', '2021-02-02'),
(23, 3, 8, '2021-02-03 21:46:35', '2021-02-03 21:46:35', '2021-02-03'),
(24, 3, 8, '2021-02-03 21:46:46', '2021-02-03 21:46:46', '2021-02-04'),
(25, 3, 8, '2021-02-03 21:46:53', '2021-02-03 21:46:53', '2021-02-05'),
(26, 3, 8, '2021-02-03 21:47:06', '2021-02-03 21:47:06', '2021-02-08'),
(27, 3, 8, '2021-02-03 21:51:52', '2021-02-03 21:51:52', '2021-02-09'),
(28, 3, 8, '2021-02-03 21:52:22', '2021-02-03 21:52:22', '2021-02-10'),
(29, 3, 8, '2021-02-03 21:52:46', '2021-02-03 21:52:46', '2021-02-11'),
(30, 3, 8, '2021-02-03 21:53:21', '2021-02-03 21:53:21', '2021-02-12'),
(31, 3, 8, '2021-02-03 21:53:36', '2021-02-03 21:53:36', '2021-02-15'),
(32, 3, 8, '2021-02-03 21:53:54', '2021-02-03 21:53:54', '2021-02-16'),
(33, 3, 8, '2021-02-03 21:54:04', '2021-02-03 21:54:04', '2021-02-17'),
(34, 3, 8, '2021-02-03 21:54:30', '2021-02-03 21:54:30', '2021-02-18'),
(35, 3, 8, '2021-02-03 21:54:44', '2021-02-03 21:54:44', '2021-02-19'),
(36, 3, 8, '2021-02-03 21:54:52', '2021-02-03 21:54:52', '2021-02-22'),
(37, 3, 8, '2021-02-03 21:55:07', '2021-02-03 21:55:07', '2021-02-23'),
(38, 3, 8, '2021-02-03 21:55:19', '2021-02-03 21:55:19', '2021-02-24'),
(39, 3, 8, '2021-02-03 21:55:25', '2021-02-03 21:55:25', '2021-02-25'),
(40, 3, 8, '2021-02-03 21:55:35', '2021-02-03 21:55:35', '2021-02-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `tasks`
--

INSERT INTO `tasks` (`id`, `name`) VALUES
(1, 'Szkolenie'),
(2, 'Delegacja'),
(3, 'Audyt miesięczny'),
(4, 'Miesięczna ewidencja'),
(5, 'weryfikacja i księgowanie faktur'),
(6, 'księgowanie wyciągów bankowych'),
(7, 'księgowanie dokumentów'),
(8, 'Spotkanie z klientem'),
(9, 'Układanie planów finansowych dla klienta'),
(10, 'Analiza warunków kredytów'),
(11, 'Analiza warunków polis ubezpieczeniowych');

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
(1, 'admin@gmail.com', '$2y$10$yUg7DXF.2NTeP8nfsVgqouSqBRnuUeBJglAW5b9D9rOleOVBbrTCK', 'admin', 'admin', 'admin', '263213212121', '33-333', 'Polska', 'Rzeszow', '601af5927234e601af59272351', '20', NULL, NULL),
(2, 'marianowak@gmail.com', '$2y$10$QrHoLb7N53tm23U6PXhTCeDeQBjzGiT0va4JH22yFpyI9roNjdMIy', 'employee', 'Maria', 'Nowak', '555666777', '32-230', 'Polska', 'Rzeszów', '601b03b4a0bab601b03b4a0bad', '25', 7, 10),
(3, 'adamkowalski@gmail.com', '$2y$10$NqV.lN225j4Ravj4XU6RIOTpT4f.8/bPXFkxdbj8LzwSXT.Cz1HJa', 'employee', 'Adam', 'Kowalski', '782772992', '35-033', 'Polska', 'Rzeszów', '601b087912764601b087912766', '22', 8, 7);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT dla tabeli `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `departments_tasks`
--
ALTER TABLE `departments_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT dla tabeli `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

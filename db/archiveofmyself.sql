-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Sep 2023 um 11:42
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `archiveofmyself`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `text` varchar(250) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `video_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`text`, `likes`, `dislikes`, `comments`, `id`, `video_fk`) VALUES
('Ich fand dieses Video weltverändernd', 67, 19, 3, 1, 1),
('Dies ist ein Platzhalter', 12, 84, 12, 5, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `passwd` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`username`, `description`, `image`, `id`, `passwd`) VALUES
('MonsterLuni', 'ADMIN', 'bild.png', 74, '$2y$10$aAgG7659WojvXP8M8tf2fuF5FKVCk0/xPoM5Bz1ln5D2w0oUeCEf2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_intermediary_comment`
--

CREATE TABLE `user_intermediary_comment` (
  `fk_user_id` int(11) NOT NULL,
  `fk_comment_id` int(11) NOT NULL,
  `bool_like` tinyint(1) NOT NULL,
  `bool_dislike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_intermediary_video`
--

CREATE TABLE `user_intermediary_video` (
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_video_id` int(11) NOT NULL,
  `bool_like` tinyint(1) NOT NULL,
  `bool_dislike` tinyint(1) NOT NULL,
  `saved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `user_intermediary_video`
--

INSERT INTO `user_intermediary_video` (`fk_user_id`, `fk_video_id`, `bool_like`, `bool_dislike`, `saved`) VALUES
(74, 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `videos`
--

CREATE TABLE `videos` (
  `url` varchar(50) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `text` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `id` int(11) NOT NULL,
  `fk_uploaded_from_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `videos`
--

INSERT INTO `videos` (`url`, `likes`, `dislikes`, `text`, `description`, `id`, `fk_uploaded_from_id`) VALUES
('Luz.mp4', 106, 37, 'Dies ist der Text', 'Dies ist die Beschreibung', 1, 74),
('Hunteer.mp4', 98, 65, 'text 2', 'Beschreibung 2', 2, 74),
('Jeesse.mp4', 80, 41, 'text 3', 'Beschreibung 3', 3, 74),
('rat.mp4', 0, 1, 'Hello', 'This is ze beschreibung', 4, 74);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_fk` (`video_fk`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_intermediary_comment`
--
ALTER TABLE `user_intermediary_comment`
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_comment_id` (`fk_comment_id`);

--
-- Indizes für die Tabelle `user_intermediary_video`
--
ALTER TABLE `user_intermediary_video`
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_video_id` (`fk_video_id`);

--
-- Indizes für die Tabelle `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_uploaded_from_id` (`fk_uploaded_from_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT für Tabelle `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`video_fk`) REFERENCES `videos` (`id`);

--
-- Constraints der Tabelle `user_intermediary_comment`
--
ALTER TABLE `user_intermediary_comment`
  ADD CONSTRAINT `user_intermediary_comment_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_intermediary_comment_ibfk_2` FOREIGN KEY (`fk_comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints der Tabelle `user_intermediary_video`
--
ALTER TABLE `user_intermediary_video`
  ADD CONSTRAINT `user_intermediary_video_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_intermediary_video_ibfk_2` FOREIGN KEY (`fk_video_id`) REFERENCES `videos` (`id`);

--
-- Constraints der Tabelle `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`fk_uploaded_from_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

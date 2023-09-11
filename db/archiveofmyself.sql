-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Sep 2023 um 15:50
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
('Ich fand dieses Video weltverändernd', 66, 18, 3, 1, 1),
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
('MonsterLuni', 'Ich bin eine Account Beschreibung', 'deinemama.png', 1, '$2y$10$tzNpZ7.6GKxjVHRh0wfHRu9SAWroHzolXj0tOKVpqdtce2LD5btZy'),
('Testigal', 'Beschreibung', 'bild.png', 2, ''),
('Testigal', 'Beschreibung', 'bild.png', 3, ''),
('Testigal', 'Beschreibung', 'bild.png', 4, ''),
('Testigal', 'Beschreibung', 'bild.png', 5, ''),
('Testigal', 'Beschreibung', 'bild.png', 6, '$2y$10$j9SyuIvYVPqg8USImZ/FheN9mXm5qoRMILoFyCzxIAXXUUroQ592y'),
('Testigal', 'Beschreibung', 'bild.png', 7, '$2y$10$FtyRItmX1B93x3lt0Xhnsuj/7hCAhk9ha7EXMJBLh689yk9..qYWW'),
('Testigal', 'Beschreibung', 'bild.png', 8, '$2y$10$5Gbi/waGTZTrivwV6kGk.uzzXnblg5gF9nax//4cC1TFYFF8GV1Cm'),
('Testigal', 'Beschreibung', 'bild.png', 9, '$2y$10$lm/DugGBiMvKq3br3onEPemBTK0Vjo6S4jmQ0nKKpDNZMylBNtwXG'),
('Testigal', 'Beschreibung', 'bild.png', 10, '$2y$10$5WHJ8NwQpu68m1VnHI5qN.XPA1N9t79Z6YO7O2Q/6ixuej0oKcv6y'),
('Testigal', 'Beschreibung', 'bild.png', 11, '$2y$10$5mmH2QpSn46uaF5v80g02.mYw1KzR/4f25U3u/aCap0I57h3qnLwq'),
('Testigal', 'Beschreibung', 'bild.png', 12, '$2y$10$bhBIfmD8YrRxb10JcO5gpuQ1GUpT/08zfiC0sO5k5mJmhyNAt3KnC'),
('Testigal', 'Beschreibung', 'bild.png', 13, '$2y$10$TpP5Zd9FbrSwGsHTTwDB8eXV3k9Kaxy6vnw.Hj6glD7/54GVM8J.S'),
('Testigal', 'Beschreibung', 'bild.png', 14, '$2y$10$oLTPRI6dpJHzyjaS/252EO02Idf7NPcmIIm4GWs/4jELg7FoOPR3e'),
('Testigal', 'Beschreibung', 'bild.png', 15, '$2y$10$RShexqZa5/udFNmre2TluO0yyHYrLBbIB7zl0dGNiJY5r78n/LSRS'),
('Testigal', 'Beschreibung', 'bild.png', 16, '$2y$10$xRflECTKKmegg/9wn6ysge2yTf1MaiJyn2.Twu40.vO4Z7PdtU4Ya'),
('Testigal', 'Beschreibung', 'bild.png', 17, '$2y$10$wcu9xV7Ed0Y/F6HU2ClQXuRlbS0WKV6pf1fKDvOWiV2cSTvCIHXbm'),
('Testigal', 'Beschreibung', 'bild.png', 18, '$2y$10$fX3UyFuX5wHF1EobWKJwIu3dfddWr/w2w0GhO3okZa/bKmUHUyHlK'),
('Testigal', 'Beschreibung', 'bild.png', 19, '$2y$10$sUrj5AugTq5lyhb9ErGewOOQrUzcbHnQp8klgBOVuIm4RL5w7yebS'),
('Testigal', 'Beschreibung', 'bild.png', 20, '$2y$10$XK.b32ePXCeK0i2cGNaDEeFoUoPpvTdhe9dJwYHS.Jc0P3Vq0KTnq'),
('Testigal', 'Beschreibung', 'bild.png', 21, '$2y$10$ToNAiYCvcjuTwb.Cw/ebkucEm4GZ/PsZnl6fyknP3UDE6HuCexhmW'),
('Testigal', 'Beschreibung', 'bild.png', 22, '$2y$10$A2elje1qJ0NLMhoVnXO2QOKKLpF04jyh96QRzTQBJIAFUxBlnywqm'),
('Testigal', 'Beschreibung', 'bild.png', 23, '$2y$10$mNsxGOuqlhtna4xab/Ue4uG8h5hJ//LSUcWYReNzIMkSf03P626o.'),
('Testigal', 'Beschreibung', 'bild.png', 24, '$2y$10$z3OfJtVWN6mbWYuweYa3sOtcm47JI/mTm30vTNiNBt14E7m8mVRli'),
('Testigal', 'Beschreibung', 'bild.png', 25, '$2y$10$jECEamYt3TTZCcIaHVejUOHdhifOv6EOTjyy4cKHmXNJQyWZZDXF6'),
('Testigal', 'Beschreibung', 'bild.png', 26, '$2y$10$IlJfUcxqOi.GpsgvIGIdy.l.uYFjaT0QH7OfpxJxxQwYJvN6Gusgy'),
('Testigal', 'Beschreibung', 'bild.png', 27, '$2y$10$nmPuVkPp8Eb3fhy0su2CFOrJ2tdXume6MCFQyU42jDVPXtOCAVSH2'),
('Testigal', 'Beschreibung', 'bild.png', 28, '$2y$10$D/tr42ZE6iNQAhZLOHY22.ZrqYNXgTbytabVYlQVv7.nuwfebwBmS'),
('Testigal', 'Beschreibung', 'bild.png', 29, '$2y$10$QfEQYGX6ntDlkMsIhmqWluttn7dGv6Jn5mvN1UoLZx31lTolqA2Ou'),
('Testigal', 'Beschreibung', 'bild.png', 30, '$2y$10$FKo7.gIWFWNA6pDkLzoPq.kfr.vW5HPD5Ns6TTysQn/zpdTBWfe4y'),
('Testigal', 'Beschreibung', 'bild.png', 31, '$2y$10$yYFU.yc4eSmnVFbEt7tbN.0712N0Ov14Fmt82LSOk7uOVWmVGDDZG'),
('Testigal', 'Beschreibung', 'bild.png', 32, '$2y$10$nDgZHCAph3JSQI5KpJweQu5/8lhcT2M2LGMV68NPpIIojai5HZEYC'),
('Testigal', 'Beschreibung', 'bild.png', 33, '$2y$10$ovOvuogKrsOJoVmsQ5he.O/rPNZXe5/3Gf5fc5JgRK.6Uc3I2P/8a'),
('Testigal', 'Beschreibung', 'bild.png', 34, '$2y$10$cjWRXybGYkdrNbhbPxvBK.wwvZAs.B2XpFYxwgEstnG71l.tdoZSu'),
('Testigal', 'Beschreibung', 'bild.png', 35, '$2y$10$3fcyPk5UzNkK1KhagqvCoOV0t.iJmNOTM25SCkUn.q/8TKt9JM/jm'),
('Testigal', 'Beschreibung', 'bild.png', 36, '$2y$10$c7dEzQC9aSYoVzZESMs6keL7HXEElLN3IbImgOpmI5slziRzDaIxS'),
('Testigal', 'Beschreibung', 'bild.png', 37, '$2y$10$k0.qYrwaXfvdcSBiHTk8AuL9Az3lUnTFk3P1SrJArjYxTBnsv/kqy'),
('Testigal', 'Beschreibung', 'bild.png', 38, '$2y$10$WB.dVbs.IS1.PFDRMy64.u///5/ikP6adZ5iCjbBpJpAcnVOJPRtG'),
('Testigal', 'Beschreibung', 'bild.png', 39, '$2y$10$VBfHliaKYCw1eHfNCjMs9eScGmnWlmC2qUYEvia6MZK/MAXUuX7J2'),
('Testigal', 'Beschreibung', 'bild.png', 40, '$2y$10$FnSiV1j.yyy2.ezv/FjBBuyI0L92eskHIEN4CZsOlOiis7cr0MIRm'),
('Testigal', 'Beschreibung', 'bild.png', 41, '$2y$10$xBKu/QS5pMEGKgwOeJIV1uiXaG0Vwwf9pU7zeruv0b1EDha8AL7kC'),
('Testigal', 'Beschreibung', 'bild.png', 42, '$2y$10$2JzvvJ00usjktUXuYjoAquiO3yleqlEIuJPjv0PLRPvKjenZB6Hku'),
('Testigal', 'Beschreibung', 'bild.png', 43, '$2y$10$rvhRbsK54W/VjvFOEjBejeXe.O2YzENTzyVoZ62PecrzSq57S5Gfu'),
('Testigal', 'Beschreibung', 'bild.png', 44, '$2y$10$EN/M/ATWb4FB5YjNUBXShOIQHuFbLGo0pAboSFrqJySTIg7uCDkXK'),
('Testigal', 'Beschreibung', 'bild.png', 45, '$2y$10$PJsiFyZtm7Xh/Qz4Jp4duej1xoMvY0TkdEp/mK2J0dsDDZX0pOYfa'),
('Testigal', 'Beschreibung', 'bild.png', 46, '$2y$10$oAFbrLrUBP.Z60hszwITQuPGXrkoc0J1FcyYeULAZgT0QbRiAqsFu'),
('Testigal', 'Beschreibung', 'bild.png', 47, '$2y$10$YsoY.JRuNONeN0pVnOivgufyo9wIkmlXJEmyCvcjxgnMrFF0nJod6'),
('Testigal', 'Beschreibung', 'bild.png', 48, '$2y$10$IsDITmCboYmShgUporiZ7.0/Hj7JcswmUiICkY93r7UV4AaXmoV/e'),
('Testigal', 'Beschreibung', 'bild.png', 49, '$2y$10$2zMqTrorJ7CFd3.BHItRduvjRap6PDuCeoG1AirVrzepxb23wDK2G'),
('Testigal', 'Beschreibung', 'bild.png', 50, '$2y$10$.c/KHcYU0OQnvE55uLcE0.3AzdXoyEtNvlWqXSnfFA3D6wE9cPIkm'),
('Testigal', 'Beschreibung', 'bild.png', 51, '$2y$10$ONjomNPCrPkGXN5A9IgI.OM6hAciRZyUW/u4luuehDVkOgkx4HFbq'),
('Testigal', 'Beschreibung', 'bild.png', 52, '$2y$10$1gEnUhROOPKvBSTGKd8u2ucsSsRfURbjaEuce6xoe/I7JNnaiy0Yq'),
('Testigal', 'Beschreibung', 'bild.png', 53, '$2y$10$L7mNFq38dMwadTCbWvvBYeW/Au4KfOzxWVJc.deZoZZhPsfQz.8Xi'),
('Testigal', 'Beschreibung', 'bild.png', 54, '$2y$10$bZC7kpdyNOj2qiFtydQW0eMgXQqMVgYrwl6DiU0kYfXa7.J.aH2XC'),
('Testigal', 'Beschreibung', 'bild.png', 55, '$2y$10$vlIAy5z4J4ZF6fqzBn6db.z3FMsXim1qTM.2U8YHkuINuvlpVz2Na'),
('Testigal', 'Beschreibung', 'bild.png', 56, '$2y$10$U72RgWbSxHdVqnBmfKpxfuMPboMltb5BnnDBIsMIfuz2QAL2UjMVG');

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
  `bool_dislike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `videos`
--

INSERT INTO `videos` (`url`, `likes`, `dislikes`, `text`, `description`, `id`) VALUES
('Luz.mp4', 109, 40, 'Dies ist der Text', 'Dies ist die Beschreibung', 1),
('Hunteer.mp4', 98, 64, 'text 2', 'Beschreibung 2', 2),
('Jeesse.mp4', 79, 41, 'text 3', 'Beschreibung 3', 3);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT für Tabelle `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

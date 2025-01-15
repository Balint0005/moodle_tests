-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 18. 14:35
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `moodle`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `Fid` int(11) NOT NULL,
  `fnev` varchar(50) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jogosultsag` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`Fid`, `fnev`, `nev`, `jelszo`, `email`, `jogosultsag`) VALUES
(1, 'Bela07', 'Kovács Béla', '$2y$10$VpXje9uZeGq7bgdcamG1tOyHBz2rufn5.Gr5IPYcvkNnGwNRcNsRa', 'bela@gmail.com', 2),
(2, 'Janos76', 'Tóth János', '$2y$10$.EF5/VXcRtTlR3HbtcTNc.KO4yHp8GjaSMn1cJbOyZ6yTqtn5VFAa', 'janos@gmail.com', 1),
(3, 'Endre88', 'Varga Endre', '$2y$10$at12MsFBQtaTmhREOf6IX.1b42lgy1zxQlZoi36m4g4bt7wpHs3de', 'endre@gmail.com', 1),
(4, 'Akos56', 'Szücs Ákos', '$2y$10$EY/dsitTufF597mIigwKF.flvuzArEoPmazwB9duUjv6a2fjGQV6q', 'akos@gmail.com', 2),
(5, 'Ilona05', 'Juhász Ilona', '$2y$10$4PoeermNJ7z5m0DSYo/kt.ZPW2Yz5K/uCJTUUP.z632F7hSu5iH0C', 'ilona@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdes`
--

CREATE TABLE `kerdes` (
  `Kid` int(11) NOT NULL,
  `kerdesszovege` varchar(120) NOT NULL,
  `jovalasz` varchar(100) NOT NULL,
  `rosszvalasz1` varchar(100) NOT NULL,
  `rosszvalasz2` varchar(100) NOT NULL,
  `rosszvalasz3` varchar(100) NOT NULL,
  `felhasznaloID` int(11) NOT NULL,
  `KletrehozIdopont` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kerdes`
--

INSERT INTO `kerdes` (`Kid`, `kerdesszovege`, `jovalasz`, `rosszvalasz1`, `rosszvalasz2`, `rosszvalasz3`, `felhasznaloID`, `KletrehozIdopont`) VALUES
(1, 'A felsorolt repülőgép típusok közül melyiket gyártották a Németek?', 'Me 109', 'P-51', 'P-47', 'M.C.202', 1, '2023-11-13 22:10:29'),
(2, 'A felsorolt repülőgép típusok közül melyik volt nehéz bombázó? ', 'B-17', 'P-47', 'Me 110 G-2', 'FW 190 A-3', 1, '2023-11-13 22:13:22'),
(3, 'A felsorolt motorok közül melyik volt megtalálható valamely Me 109 variánsba?', 'DB 605', 'Packard Merlin', 'Pratt & Whitney R–2800', 'BMW 801D-2', 1, '2023-11-13 22:17:31'),
(4, 'Az alábbi repülőgépek közül melyik rendelkezett kettő motorral?', 'P-38 Lightning', 'F6F Hellcat', 'F4U Corsair', 'P-51 Mustang', 1, '2023-11-13 22:22:05'),
(5, 'Az alábbi repülőgépek közül melyik rendelkezett sugárhajtású motorral?', 'Me-262 Schwalbe', 'P-38 Lightning', 'La-5 FN', 'I-16', 1, '2023-11-13 22:24:44'),
(6, 'A Lockheed SR–71 Blackbird egy.....', 'nagy hatótávolságú hadászati felderítő repülőgép', 'vadászgép', 'utasszállító repülőgép', 'helikopter', 1, '2023-11-13 22:42:09'),
(7, 'Melyik században kezdődött az ipari forradalom?', '18. század', '16. század', '17. század', '19. század', 1, '2023-11-14 19:38:54'),
(8, 'Mi volt a fő nyersanyag az ipari forradalom során?', 'Szén', 'Kőolaj', 'Földgáz', 'Plutónium', 1, '2023-11-14 19:39:43'),
(9, 'Mi volt a fő energiaforrás az ipari forradalom idején?', 'Gőz', 'Gáz', 'Levegő', 'Elektromos áram', 1, '2023-11-14 19:40:52'),
(10, 'Mi indítja el az ipari forradalmat?', 'A textiláruk iránti igény megnövekedése', 'A mezőgazdaság fejlődése', 'Nagy Britannia létrejötte', 'A népesség növekedése', 1, '2023-11-14 19:42:02'),
(11, 'Ki találja fel a gőzgépet?', 'James Watt', 'James Franco', 'James Jones', 'James Smith', 1, '2023-11-14 19:42:41'),
(12, 'Ki találja fel a gőzmozdonyt?', 'George Stephenson', 'James Watt', 'Albert Einstein', 'Jedlik Ányos', 1, '2023-11-14 19:43:34'),
(13, 'Ki alkotta meg a \"Fonó Jenny\"-t?', 'James Hargreaves', 'James Watt', 'George Stephenson', 'Robert Fulton', 1, '2023-11-14 19:44:22'),
(14, 'Ki találta fel a gőzhajót?', 'Robert Fulton', 'Robert Retford', 'James Watt', 'George Stephenson', 1, '2023-11-14 19:45:04'),
(15, 'Miért szerettek gyerekeket dolgoztatni a szénbányákban?', 'Alacsony termetük miatt a szűkebb járatokba is befértek.', 'Mert jobban látnak a sötétben.', 'Mert kisebb volt a tüdejük és kevesebb levegő is elég volt nekik.', 'Mert nem féltek a sötétben.', 1, '2023-11-14 19:48:43'),
(16, 'Hogy hívják az első ipari forradalom során létrejött új társadalmi réteget?', 'Munkásság', 'Városi polgárság', 'Arisztokrácia', 'Plebejusok', 1, '2023-11-14 19:49:28'),
(17, 'Mi nem tartozott az első világháború valódi okai közé?', 'Az egész világ háborúzni akart.', 'Harc a gyarmatokért, a világ újrafelosztásáért.', 'Szövetségi rendszerek kialakulása.', 'Fegyverkezési verseny, flottaprogram.', 1, '2023-11-14 19:59:09'),
(18, 'Melyik térséget nevezték úgy, hogy \"Európa lőporos hordója\"?', 'Balkán', 'Osztrák-Magyar Monarchia', 'Szerbia', 'Németország', 1, '2023-11-14 20:01:35'),
(19, 'Milyen front nem volt az első világháborúban?', 'északi', 'keleti', 'nyugati', 'déli', 1, '2023-11-14 20:02:40'),
(20, 'Mi volt az első világháború kirobbanásának közvetlen oka?', 'Ferenc Ferdinánd meggyilkolása', 'Ferenc József meggyilkolása', 'Ferenc Sándor meggyilkolása', 'Ferenc Lajos meggyilkolása', 1, '2023-11-14 20:05:10'),
(21, 'Mit jelent a Blitzkrieg?', 'villámháború', 'állóháború', 'furcsa háború', 'légi háború', 1, '2023-11-14 20:06:19'),
(22, 'Melyik eszköz nem jelent meg Európa harcterein az első világháború alatt?', 'repülőgép hordozó anyahajó', 'géppuska', 'tank', 'mustárgáz', 1, '2023-11-14 20:07:25'),
(23, 'Hogy hívták a Ferenc Ferdinándot meggyilkoló merénylőt?', 'Gavrilo Princip', 'Vladko Maček', 'Svetozar Pribićević', 'Josip Broz Tito', 1, '2023-11-14 20:08:16'),
(24, 'Melyik csata nem az első világháborúban volt?', 'kurszk-i', 'verdun-i', 'somme-i', 'doberdo-i', 1, '2023-11-14 20:10:31'),
(25, 'Ki dolgozta ki a németek haditervét?', 'Schlieffen', 'Schliemann', 'Schultz', 'Schaffen', 1, '2023-11-14 20:11:06'),
(26, 'Mi volt a neve az I. világháborúban leghíresebb német harci repülőjének?', 'Fokker Deidecker', 'Spitfire', 'Messerschmitt', 'Dresden', 1, '2023-11-14 20:13:16'),
(27, 'Ki volt a magyar miniszterelnök a háború kitörésekor?', 'Tisza István', 'Tisza Kálmán', 'Andrássy Gyula', 'Ferenc József', 1, '2023-11-16 00:54:10'),
(28, 'Kitől származik a vasfüggöny kifejezés?', 'Churchill', 'Truman', 'Sztálin', 'Mussolini', 1, '2023-11-16 00:58:41'),
(29, 'Kik írták alá a potsdami konferencia döntéseit?', 'Truman, Attlee, Sztálin', 'Roosevelt, Churchill, Sztálin', 'Roosevelt, Truman, Sztálin', 'Roosevelt, Truman, Mussolini', 1, '2023-11-16 00:59:42'),
(30, 'Hány megszállási övezetre osztották Berlint?', '4', '3', '5', '2', 1, '2023-11-16 01:00:24'),
(31, 'Mikor építették a berlini falat?', '1961', '1948', '1969', '1990', 1, '2023-11-16 01:01:24'),
(32, 'Melyik ország történetéhez köthető Mahatma Gandhi?', 'India', 'Vietnám', 'Kína', 'Egyiptom', 1, '2023-11-16 01:01:55'),
(33, 'Ki követte Sztálint a Szovjetunió élén?', 'Hruscsov', 'Lenin', 'Gagarin', 'Gorbacsov', 1, '2023-11-16 01:03:08'),
(34, 'Mikor jött létre a NATO?', '1949', '1948', '1947', '1946', 1, '2023-11-16 01:03:59'),
(35, 'Mi volt Kelet-Németország nevének rövidítése?', 'NDK', 'NSZK', 'KNO', 'KNI', 1, '2023-11-16 01:10:15'),
(36, 'vajon megmarad?', 'talan', 'igen', 'igen', 'igen', 4, '2023-11-16 18:53:57'),
(37, 'Hogy hívták a Nyugat-Berlinben élő gyerekek az amerikai repülőket?', 'mazsolabombázók', 'vadászok', 'megmentők', 'amcsik', 4, '2023-11-17 00:18:20'),
(38, 'Ki kezdeményezte a berlini blokádot (1948-1949)?', 'Sztálin', 'Lenin', 'Truman', 'Churchill', 4, '2023-11-17 00:19:53'),
(39, 'Mikor halt meg Sztálin?', '1953', '1952', '1951', '1950', 4, '2023-11-17 00:22:53'),
(40, 'Mit jelent az ENSZ?', 'Egyesült Nemzetek Szövetsége', 'Egyesül Nemzetek Szervezete', 'Európai Nemzetek Szövetsége', 'Európai Nemzetek Szervezete', 4, '2023-11-17 00:27:55'),
(41, 'Mi az uradalom?', 'Egy földesúr birtoka.', 'Egy jobbágytelek.', 'Egy király birtoka.', 'Egy jobbágy tulajdona.', 4, '2023-11-17 00:34:46'),
(42, 'Melyik terület marad a földesúré, amit jobbágyok művelnek meg?', 'a majorság', 'a legelők', 'a jobbágytelek', 'a malom', 4, '2023-11-17 00:35:27'),
(43, 'Mikor kezdődött a középkor?', '476', '395', '303', '413', 4, '2023-11-17 00:36:24'),
(44, 'Melyik NEM igaz a szerzetesek életére?', 'Dolgozniuk kellett a földesúr földjén.', 'A világtól elzártan, kolostorban éltek.', 'A rend szabályzatát kellett betartaniuk.', 'Szegénységet és mértéktartást fogadtak.', 4, '2023-11-17 00:42:34'),
(45, 'Milyen rendet alapított Assisi Szent Ferenc?', 'bencés rendet', 'lovagrendet', 'koldulórendet', 'oktatórendet', 4, '2023-11-17 00:43:58'),
(46, 'Földművelés - melyiket alkalmazták?', 'háromnyomásos földművelés', 'kétnyomásos földművelés', 'ötnyomásos földművelés', 'négynyomásos földművelés', 4, '2023-11-17 00:47:10'),
(47, 'Melyik évben repült elsőnek a(z) SR-71?', '1964', '1945', '1990', '2010', 4, '2023-11-18 14:18:10'),
(48, 'Hány SR-71-et épített az USA?', '32', '10', '57', '2', 4, '2023-11-18 14:21:08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kitoltotte`
--

CREATE TABLE `kitoltotte` (
  `kitoltID` int(11) NOT NULL,
  `kitoltesBefejezese` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `felhasznaloID` int(11) NOT NULL,
  `tesztID` int(11) NOT NULL,
  `elertPontSzam` int(11) NOT NULL,
  `sikeres` tinyint(1) NOT NULL,
  `kitoltesKezdete` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kitoltotte`
--

INSERT INTO `kitoltotte` (`kitoltID`, `kitoltesBefejezese`, `felhasznaloID`, `tesztID`, `elertPontSzam`, `sikeres`, `kitoltesKezdete`) VALUES
(1, '2023-11-13 22:26:26', 1, 1, 10, 1, '2023-11-13 22:25:08'),
(2, '2023-11-17 00:49:18', 4, 2, 2, 0, '2023-11-17 00:49:01'),
(3, '2023-11-17 00:50:00', 4, 1, 10, 1, '2023-11-17 00:49:18'),
(4, '2023-11-17 00:53:03', 2, 4, 20, 1, '2023-11-17 00:51:37'),
(5, '2023-11-17 00:54:31', 2, 5, 10, 1, '2023-11-17 00:53:03'),
(6, '2023-11-17 00:54:48', 2, 2, 0, 0, '2023-11-17 00:54:31'),
(7, '2023-11-17 00:58:11', 3, 6, 3, 1, '2023-11-17 00:56:23'),
(8, '2023-11-17 00:59:47', 3, 4, 18, 1, '2023-11-17 00:58:11'),
(9, '2023-11-17 01:01:15', 3, 2, 2, 0, '2023-11-17 01:01:08'),
(10, '2023-11-17 01:07:49', 3, 3, 10, 1, '2023-11-17 01:01:15'),
(11, '2023-11-17 20:54:29', 1, 1, 8, 1, '2023-11-17 20:53:19'),
(12, '2023-11-18 14:22:16', 5, 2, 6, 1, '2023-11-18 14:22:04'),
(13, '2023-11-18 14:23:00', 5, 1, 10, 1, '2023-11-18 14:22:37'),
(14, '2023-11-18 14:23:56', 5, 3, 9, 1, '2023-11-18 14:23:00'),
(15, '2023-11-18 14:24:52', 5, 4, 22, 1, '2023-11-18 14:23:56'),
(16, '2023-11-18 14:25:57', 5, 5, 11, 1, '2023-11-18 14:24:52'),
(17, '2023-11-18 14:26:45', 5, 6, 6, 1, '2023-11-18 14:26:15'),
(18, '2023-11-18 14:30:47', 2, 2, 6, 1, '2023-11-18 14:30:29'),
(19, '2023-11-18 14:31:13', 2, 1, 6, 1, '2023-11-18 14:30:47'),
(20, '2023-11-18 14:32:00', 2, 3, 4, 1, '2023-11-18 14:31:13'),
(21, '2023-11-18 14:34:40', 2, 6, 1, 0, '2023-11-18 14:34:01');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `teszt`
--

CREATE TABLE `teszt` (
  `Tid` int(11) NOT NULL,
  `tnev` varchar(50) NOT NULL,
  `kerdesenkent_pont` int(11) NOT NULL,
  `minpont` int(11) NOT NULL,
  `felhasznaloID` int(11) NOT NULL,
  `TletrehozIdopont` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `teszt`
--

INSERT INTO `teszt` (`Tid`, `tnev`, `kerdesenkent_pont`, `minpont`, `felhasznaloID`, `TletrehozIdopont`) VALUES
(1, 'Repülőgépek a II. Világháborúban', 2, 4, 1, '2023-11-13 22:06:48'),
(2, 'Repülőgépek a Hidegháborúban', 2, 4, 1, '2023-11-13 22:45:09'),
(3, 'Az első ipari forradalom', 1, 4, 1, '2023-11-14 19:38:07'),
(4, 'I. Világháború', 2, 4, 1, '2023-11-14 19:56:33'),
(5, 'Hidegháború', 1, 4, 1, '2023-11-16 00:57:22'),
(6, 'A középkor világa', 1, 2, 4, '2023-11-17 00:34:11');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `teszttartalmazza`
--

CREATE TABLE `teszttartalmazza` (
  `tartalmazzaID` int(11) NOT NULL,
  `tesztID` int(11) NOT NULL,
  `kerdesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `teszttartalmazza`
--

INSERT INTO `teszttartalmazza` (`tartalmazzaID`, `tesztID`, `kerdesID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(7, 2, 6),
(8, 3, 7),
(9, 3, 8),
(10, 3, 9),
(11, 3, 10),
(12, 3, 11),
(13, 3, 12),
(14, 3, 13),
(15, 3, 14),
(16, 3, 15),
(17, 3, 16),
(18, 4, 17),
(19, 4, 18),
(20, 4, 19),
(21, 4, 20),
(22, 4, 21),
(23, 4, 22),
(24, 4, 23),
(25, 4, 24),
(26, 4, 25),
(27, 4, 26),
(28, 4, 27),
(29, 5, 28),
(30, 5, 29),
(31, 5, 30),
(32, 5, 31),
(33, 5, 32),
(34, 5, 33),
(35, 5, 34),
(36, 5, 35),
(37, 5, 37),
(38, 5, 38),
(39, 5, 39),
(40, 5, 40),
(41, 6, 41),
(42, 6, 42),
(43, 6, 43),
(44, 6, 44),
(45, 6, 45),
(46, 6, 46),
(47, 2, 47),
(48, 2, 48);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`Fid`);

--
-- A tábla indexei `kerdes`
--
ALTER TABLE `kerdes`
  ADD PRIMARY KEY (`Kid`),
  ADD KEY `kerdes_ibfk_1` (`felhasznaloID`);

--
-- A tábla indexei `kitoltotte`
--
ALTER TABLE `kitoltotte`
  ADD PRIMARY KEY (`kitoltID`),
  ADD KEY `kitoltotte_ibfk_1` (`felhasznaloID`),
  ADD KEY `kitoltotte_ibfk_2` (`tesztID`);

--
-- A tábla indexei `teszt`
--
ALTER TABLE `teszt`
  ADD PRIMARY KEY (`Tid`),
  ADD KEY `teszt_ibfk_1` (`felhasznaloID`);

--
-- A tábla indexei `teszttartalmazza`
--
ALTER TABLE `teszttartalmazza`
  ADD PRIMARY KEY (`tartalmazzaID`),
  ADD KEY `teszttartalmazza_ibfk_1` (`tesztID`),
  ADD KEY `teszttartalmazza_ibfk_2` (`kerdesID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `Fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `kerdes`
--
ALTER TABLE `kerdes`
  MODIFY `Kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `kitoltotte`
--
ALTER TABLE `kitoltotte`
  MODIFY `kitoltID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `teszt`
--
ALTER TABLE `teszt`
  MODIFY `Tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `teszttartalmazza`
--
ALTER TABLE `teszttartalmazza`
  MODIFY `tartalmazzaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kerdes`
--
ALTER TABLE `kerdes`
  ADD CONSTRAINT `kerdes_ibfk_1` FOREIGN KEY (`felhasznaloID`) REFERENCES `felhasznalok` (`Fid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kitoltotte`
--
ALTER TABLE `kitoltotte`
  ADD CONSTRAINT `kitoltotte_ibfk_1` FOREIGN KEY (`felhasznaloID`) REFERENCES `felhasznalok` (`Fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kitoltotte_ibfk_2` FOREIGN KEY (`tesztID`) REFERENCES `teszt` (`Tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `teszt`
--
ALTER TABLE `teszt`
  ADD CONSTRAINT `teszt_ibfk_1` FOREIGN KEY (`felhasznaloID`) REFERENCES `felhasznalok` (`Fid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `teszttartalmazza`
--
ALTER TABLE `teszttartalmazza`
  ADD CONSTRAINT `teszttartalmazza_ibfk_1` FOREIGN KEY (`tesztID`) REFERENCES `teszt` (`Tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teszttartalmazza_ibfk_2` FOREIGN KEY (`kerdesID`) REFERENCES `kerdes` (`Kid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 21, 2021 at 10:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wingmantest`
--

-- --------------------------------------------------------

--
-- Structure for view `displaygames`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `displaygames`  AS  select `wingf`.`maxid` AS `maxid`,`wingf`.`map` AS `map`,`wingf`.`matchDate` AS `matchDate`,`wingf`.`waitTime` AS `waitTime`,`wingf`.`matchDuration` AS `matchDuration`,`wingf`.`matchScore` AS `matchScore`,'Victoire' AS `result` from (select max(`w`.`id`) AS `maxid`,`w`.`map` AS `map`,`w`.`date` AS `matchDate`,`w`.`waitTime` AS `waitTime`,`w`.`matchDuration` AS `matchDuration`,`w`.`matchScore` AS `matchScore` from `wingman` `w` group by `w`.`map`,`w`.`date`,`w`.`waitTime`,`w`.`matchDuration`,`w`.`matchScore`) `wingf` where ((((select `wingman`.`playerName` from `wingman` where (`wingman`.`id` = `wingf`.`maxid`)) in ('Loviflo','Ilesis')) and (`wingf`.`matchScore` like '9%')) or (((select `wingman`.`playerName` from `wingman` where (`wingman`.`id` = `wingf`.`maxid`)) not in ('Loviflo','Ilesis')) and (`wingf`.`matchScore` like '%9'))) union select `wingf`.`maxid` AS `maxid`,`wingf`.`map` AS `map`,`wingf`.`matchDate` AS `matchDate`,`wingf`.`waitTime` AS `waitTime`,`wingf`.`matchDuration` AS `matchDuration`,`wingf`.`matchScore` AS `matchScore`,'Défaite' AS `result` from (select max(`w`.`id`) AS `maxid`,`w`.`map` AS `map`,`w`.`date` AS `matchDate`,`w`.`waitTime` AS `waitTime`,`w`.`matchDuration` AS `matchDuration`,`w`.`matchScore` AS `matchScore` from `wingman` `w` group by `w`.`map`,`w`.`date`,`w`.`waitTime`,`w`.`matchDuration`,`w`.`matchScore`) `wingf` where ((((select `wingman`.`playerName` from `wingman` where (`wingman`.`id` = `wingf`.`maxid`)) in ('Loviflo','Ilesis')) and (`wingf`.`matchScore` like '%9')) or (((select `wingman`.`playerName` from `wingman` where (`wingman`.`id` = `wingf`.`maxid`)) not in ('Loviflo','Ilesis')) and (`wingf`.`matchScore` like '9%'))) union select `wingf`.`maxid` AS `maxid`,`wingf`.`map` AS `map`,`wingf`.`matchDate` AS `matchDate`,`wingf`.`waitTime` AS `waitTime`,`wingf`.`matchDuration` AS `matchDuration`,`wingf`.`matchScore` AS `matchScore`,'Egalité' AS `result` from (select max(`w`.`id`) AS `maxid`,`w`.`map` AS `map`,`w`.`date` AS `matchDate`,`w`.`waitTime` AS `waitTime`,`w`.`matchDuration` AS `matchDuration`,`w`.`matchScore` AS `matchScore` from `wingman` `w` group by `w`.`map`,`w`.`date`,`w`.`waitTime`,`w`.`matchDuration`,`w`.`matchScore`) `wingf` where (`wingf`.`matchScore` like '%8%') ;

--
-- VIEW  `displaygames`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

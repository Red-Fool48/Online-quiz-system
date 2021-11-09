-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 11:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temp2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `abv_or_blw_cur` ()  READS SQL DATA
begin
declare loopend int default 0;
declare marks int;
declare quiz_id varchar(100);
	declare curScore 
        CURSOR FOR
                select score,eid from rank where score>(select avg(rank.score) from rank where time in (select max(time) from rank)); 
DECLARE CONTINUE HANDLER FOR NOT FOUND SET loopend=1;
	OPEN curScore;
     SET loopend=0;
     getScore:LOOP
     		FETCH curScore into marks,quiz_id;
       		IF loopend=1
            THEN
                 LEAVE getScore;
          	END IF;
            select marks,quiz_id;
     END LOOP getScore;
     CLOSE curScore;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `after_rank_pro` (OUT `quiz_id` VARCHAR(100), OUT `marks` INT)  READS SQL DATA
begin 
select eid,score into quiz_id,marks from rank where time in(select max(time) from rank);
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `count_students_above` (`marks` INT, `quiz_id` VARCHAR(100)) RETURNS INT(4) READS SQL DATA
BEGIN
declare count1 int;
select count(score) into count1 from rank where score>marks and eid=quiz_id;
return count1; 
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `factorial` (`n` INT) RETURNS INT(11) BEGIN
DECLARE factorial INT;
SET factorial = n ;
IF n <= 0 THEN
RETURN 1;
END IF;
bucle: LOOP
SET n = n - 1 ;
IF n<1 THEN
LEAVE bucle;
END IF;
SET factorial = factorial * n ;
END LOOP bucle;
RETURN factorial;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `name`, `uname`, `password`) VALUES
('admin@admin.com', 'admin', 'admin01', '2d92f6c687c0e503a01adcde2b97de49'),
('chandi_god@ccg.vom', 'Shreyas', 'Shreyas', '6fddcb6f91c3a68155cf4e913540e345'),
('iamadmin@admin.com', 'Admin True', 'yoda', '72c144bf587a410ea64ebbfb8083d86a'),
('kumark@mail.com', 'Kumar K', 'kk01', '6726d476e7957b1027043d92653b5eb0'),
('light@kiramail.com', 'Light Y', 'light', '98d97d34aab490426f346009ad7c1836'),
('newadmin@mail.com', 'new admin', 'nadmin1', '54270e239674e38b38d50c23538ef023'),
('sheldonlc@mail.com', 'Sheldon Cooper', 'shelly', '7f08fcb5f3b5958be22d4b06c652c8a2'),
('suestorm@mail.com', 'Sue Some', 'sussie', '28b82464abc56a89d187b21b530badc6');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `after_insert_admin` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
insert into audit_admin 
set action_performed='Added admin',
name=new.name,
uname=new.uname,
email=new.email,
password1=new.password;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_mobile`
--

CREATE TABLE `admin_mobile` (
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_mobile`
--

INSERT INTO `admin_mobile` (`email`, `mobileno`) VALUES
('admin@admin.com', '8745113289'),
('chandi_god@ccg.vom', '9034920912'),
('iamadmin@admin.com', '9029887429'),
('kumark@mail.com', '9379210930'),
('light@kiramail.com', '9223049020'),
('sheldonlc@mail.com', '9389801200'),
('suestorm@mail.com', '9090428020');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` varchar(100) NOT NULL,
  `ansid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('5f94551d7e5ea', '5f94551d7f5e2'),
('5f94551d84d64', '5f94551d855af'),
('5f94551d88997', '5f94551d8970c'),
('5f9e5735cf702', '5f9e5735d0223'),
('5f9e5735d4c08', '5f9e5735d6a35'),
('611e5d187fba1', '611e5d18802d3'),
('611e5d188179b', '611e5d1881ad7'),
('612e34ceba9df', '612e34cebae30');

-- --------------------------------------------------------

--
-- Table structure for table `audit_admin`
--

CREATE TABLE `audit_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password1` varchar(100) NOT NULL,
  `action_performed` varchar(400) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_admin`
--

INSERT INTO `audit_admin` (`id`, `name`, `uname`, `email`, `password1`, `action_performed`, `date_added`) VALUES
(2, 'new admin', 'nadmin1', 'newadmin@mail.com', 'iamnadmin1', 'Added admin', '2020-11-01 18:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `audit_user`
--

CREATE TABLE `audit_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `action_performed` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `audit_user`
--

INSERT INTO `audit_user` (`id`, `name`, `gender`, `email`, `password`, `action_performed`) VALUES
(9, 'Robert Speedwagon', 'M', 'speedwagonfd@jmail.com', '78842815248300fa6ae79f7776a5080a', 'INSERTED BEFORE!!'),
(10, 'Abbas', 'M', 'abbashu@mail.com', '7a2ef39136567897eb07805e754a81d8', 'INSERTED BEFORE!!'),
(11, 'Student123', 'F', 'student@email.com', 'ad6a280417a0f533d8b670c61667e1a0', 'INSERTED BEFORE!!'),
(13, 'Student2', 'F', 'student22@email.com', 'iamstudent2', 'INSERTED BEFORE!!'),
(14, 'Anand', 'M', 'anand@mail.com', '8bda8e915e629a9fd1bbca44f8099c81', 'INSERTED BEFORE!!');

-- --------------------------------------------------------

--
-- Table structure for table `creates`
--

CREATE TABLE `creates` (
  `eid` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `creates`
--

INSERT INTO `creates` (`eid`, `uname`) VALUES
('611e5d010c24d', 'admin01'),
('612e34c0bbf15', 'nadmin1'),
('5f9e56bca6f21', 'yoda');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `subject`, `feedback`) VALUES
(30, 'randoms@mai1.com', 'DBMS', 'Very good'),
(31, 'anand@mail.com', 'as', '123'),
(32, 'speedwagonfd@jmail.com', 'DBMS', 'lorem');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `sahi`, `wrong`, `date`) VALUES
('redfool2@gmail.com', '611e5d010c24d', 1, 2, 1, 1, '2021-09-25 06:57:33'),
('alaba00@mail.com', '611e5d010c24d', 1, 2, 1, 1, '2021-10-15 19:23:22'),
('abbashu@mail.com', '611e5d010c24d', 1, 2, 1, 1, '2021-10-18 11:21:32'),
('alaba00@mail.com', '612e34c0bbf15', 0, 1, 0, 1, '2021-10-18 19:45:58'),
('abbashu@mail.com', '5f9e56bca6f21', -1, 1, 0, 1, '2021-11-04 17:46:49'),
('abbashu@mail.com', '612e34c0bbf15', 0, 1, 0, 1, '2021-11-04 17:49:00'),
('abbashu@mail.com', '5f9454c02f48d', 12, 3, 3, 0, '2021-11-04 17:55:24'),
('randoms@mai1.com', '611e5d010c24d', 1, 2, 1, 1, '2021-11-04 17:57:14'),
('redfool2@gmail.com', '5f9e56bca6f21', 4, 2, 2, 0, '2021-11-04 18:01:48'),
('light@kiramail.com', '611e5d010c24d', 6, 2, 2, 0, '2021-11-05 05:46:40'),
('light@kiramail.com', '5f9e56bca6f21', 4, 2, 2, 0, '2021-11-05 05:47:58'),
('speedwagonfd@jmail.com', '611e5d010c24d', 1, 2, 1, 1, '2021-11-05 15:47:42'),
('speedwagonfd@jmail.com', '5f9e56bca6f21', 1, 2, 1, 1, '2021-11-05 15:51:50'),
('speedwagonfd@jmail.com', '612e34c0bbf15', 1, 1, 1, 0, '2021-11-05 15:52:39'),
('student22@email.com', '611e5d010c24d', 1, 2, 1, 1, '2021-11-05 15:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `notice` varchar(500) CHARACTER SET utf8 NOT NULL,
  `uname` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice`, `uname`) VALUES
(1, 'Hello!!', 'Shreyas'),
(2, 'This is a notice....', 'yoda');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(150) NOT NULL,
  `optionid` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('5f94551d7e5ea', 'Einstein', '5f94551d7f5e2'),
('5f94551d7e5ea', 'Newton', '5f94551d7f5eb'),
('5f94551d7e5ea', 'Oldton', '5f94551d7f5ec'),
('5f94551d7e5ea', 'Teslol', '5f94551d7f5ee'),
('5f94551d84d64', 'Charles Babage', '5f94551d855af'),
('5f94551d84d64', 'Barles Cabbage', '5f94551d855b8'),
('5f94551d84d64', 'rwoi', '5f94551d855ba'),
('5f94551d84d64', 'rofl', '5f94551d855bc'),
('5f94551d88997', 'MB', '5f94551d89702'),
('5f94551d88997', 'KB', '5f94551d89708'),
('5f94551d88997', 'GB', '5f94551d8970a'),
('5f94551d88997', 'TB', '5f94551d8970c'),
('5f9e5735cf702', 'Sample', '5f9e5735d0223'),
('5f9e5735cf702', 'Important', '5f9e5735d0226'),
('5f9e5735cf702', 'Difficult', '5f9e5735d0227'),
('5f9e5735cf702', 'none of the above', '5f9e5735d0228'),
('5f9e5735d4c08', '2', '5f9e5735d6a32'),
('5f9e5735d4c08', '6', '5f9e5735d6a35'),
('5f9e5735d4c08', '1', '5f9e5735d6a36'),
('5f9e5735d4c08', '5', '5f9e5735d6a37'),
('611e5d187fba1', 'a', '611e5d18802d3'),
('611e5d187fba1', 'b', '611e5d18802d7'),
('611e5d187fba1', 'c', '611e5d18802d8'),
('611e5d187fba1', 'd', '611e5d18802d9'),
('611e5d188179b', 'a', '611e5d1881ad5'),
('611e5d188179b', 'b', '611e5d1881ad7'),
('611e5d188179b', 'c', '611e5d1881ad8'),
('611e5d188179b', 'd', '611e5d1881ad9'),
('612e34ceba9df', 'lmo', '612e34cebae2a'),
('612e34ceba9df', 'lamo', '612e34cebae2f'),
('612e34ceba9df', 'lmao', '612e34cebae30'),
('612e34ceba9df', 'lol', '612e34cebae31');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` varchar(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qns` varchar(1000) NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('5f9454c02f48d', '5f94551d7e5ea', 'Who made e=mc^2', 4, 1),
('5f9454c02f48d', '5f94551d84d64', 'Who is the father of the computer?', 4, 2),
('5f9454c02f48d', '5f94551d88997', 'Which among the following is the largest?', 4, 3),
('5f9e56bca6f21', '5f9e5735cf702', 'This is a _____ quiz', 4, 1),
('5f9e56bca6f21', '5f9e5735d4c08', '2+2-2+4=?', 4, 2),
('611e5d010c24d', '611e5d187fba1', 'A', 4, 1),
('611e5d010c24d', '611e5d188179b', 'b', 4, 2),
('612e34c0bbf15', '612e34ceba9df', 'lmao', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` int(10) NOT NULL,
  `intro` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `sahi`, `wrong`, `total`, `time`, `intro`, `tag`, `date`) VALUES
('5f9454c02f48d', 'Maths', 4, 1, 3, 11, '', 'jfsjao', '2020-10-24 16:22:24'),
('5f9e56bca6f21', 'Sample', 2, 1, 2, 10, '', '#sample', '2020-11-01 06:33:32'),
('611e5d010c24d', 'Abc', 3, 2, 2, 5, '', '#aa', '2021-08-19 13:30:41'),
('612e34c0bbf15', 'Lmao', 1, 0, 1, 5, '', '#lmao', '2021-08-31 13:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `eid` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`eid`, `email`, `score`, `time`) VALUES
('611e5d010c24d', 'redfool2@gmail.com', 1, '2021-09-25 06:57:33'),
('611e5d010c24d', 'alaba00@mail.com', 1, '2021-10-15 19:23:22'),
('611e5d010c24d', 'abbashu@mail.com', 1, '2021-10-18 11:21:32'),
('612e34c0bbf15', 'alaba00@mail.com', 0, '2021-10-18 19:45:58'),
('612e34c0bbf15', 'abbashu@mail.com', 0, '2021-11-04 17:49:00'),
('5f9454c02f48d', 'abbashu@mail.com', 12, '2021-11-04 17:55:24'),
('611e5d010c24d', 'randoms@mai1.com', 1, '2021-11-04 17:57:14'),
('5f9e56bca6f21', 'redfool2@gmail.com', 4, '2021-11-04 18:01:48'),
('611e5d010c24d', 'light@kiramail.com', 6, '2021-11-05 05:46:40'),
('5f9e56bca6f21', 'light@kiramail.com', 4, '2021-11-05 05:47:58'),
('611e5d010c24d', 'speedwagonfd@jmail.com', 1, '2021-11-05 15:47:42'),
('5f9e56bca6f21', 'speedwagonfd@jmail.com', 1, '2021-11-05 15:51:50'),
('612e34c0bbf15', 'speedwagonfd@jmail.com', 1, '2021-11-05 15:52:39'),
('611e5d010c24d', 'student22@email.com', 1, '2021-11-05 15:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `eid` varchar(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `response` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`eid`, `qid`, `response`, `email`) VALUES
('611e5d010c24d', '611e5d187fba1', '611e5d18802d9', 'redfool2@gmail.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad7', 'redfool2@gmail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d7', 'alaba00@mail.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad7', 'alaba00@mail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d3', 'abbashu@mail.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad8', 'abbashu@mail.com'),
('612e34c0bbf15', '612e34ceba9df', '612e34cebae2f', 'alaba00@mail.com'),
('5f9e56bca6f21', '5f9e5735cf702', '5f9e5735d0227', 'abbashu@mail.com'),
('612e34c0bbf15', '612e34ceba9df', '612e34cebae2f', 'abbashu@mail.com'),
('5f9454c02f48d', '5f94551d7e5ea', '5f94551d7f5e2', 'abbashu@mail.com'),
('5f9454c02f48d', '5f94551d84d64', '5f94551d855af', 'abbashu@mail.com'),
('5f9454c02f48d', '5f94551d88997', '5f94551d8970c', 'abbashu@mail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d7', 'randoms@mai1.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad7', 'randoms@mai1.com'),
('5f9e56bca6f21', '5f9e5735cf702', '5f9e5735d0223', 'redfool2@gmail.com'),
('5f9e56bca6f21', '5f9e5735d4c08', '5f9e5735d6a35', 'redfool2@gmail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d3', 'light@kiramail.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad7', 'light@kiramail.com'),
('5f9e56bca6f21', '5f9e5735cf702', '5f9e5735d0223', 'light@kiramail.com'),
('5f9e56bca6f21', '5f9e5735d4c08', '5f9e5735d6a35', 'light@kiramail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d3', 'speedwagonfd@jmail.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad8', 'speedwagonfd@jmail.com'),
('5f9e56bca6f21', '5f9e5735cf702', '5f9e5735d0227', 'speedwagonfd@jmail.com'),
('5f9e56bca6f21', '5f9e5735d4c08', '5f9e5735d6a35', 'speedwagonfd@jmail.com'),
('612e34c0bbf15', '612e34ceba9df', '612e34cebae30', 'speedwagonfd@jmail.com'),
('611e5d010c24d', '611e5d187fba1', '611e5d18802d3', 'student22@email.com'),
('611e5d010c24d', '611e5d188179b', '611e5d1881ad8', 'student22@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `gender`, `email`, `password`) VALUES
('Abbas', 'M', 'abbashu@mail.com', '7a2ef39136567897eb07805e754a81d8'),
('Alba', 'M', 'alaba00@mail.com', 'd740868709357449fbafcff55eae6eb6'),
('Anand', 'M', 'anand@mail.com', '8bda8e915e629a9fd1bbca44f8099c81'),
('New User', 'M', 'anirudhstock01@gmail.com', 'ac2b5f88fc33b7b9e0682be85784ec0d'),
('Joseph Joe', 'M', 'jojopt2@mai1.com', 'aa10208553fc389ebaabc04dea4b84c4'),
('Jolyne', 'F', 'jolynecujo@mail.com', 'ccee29fb820d4bd633d51a6d11b56707'),
('Light Yagami', 'F', 'light@kiramail.com', 'c5703bcd53d784ff8b52620caa8c56c5'),
('Randoms1', 'F', 'randoms@mai1.com', '332b3091416bc4687821c4653f1c6eb1'),
('Red F', 'M', 'redfool2@gmail.com', '5dcb162f0a4dcec9f62e9b67fcb809e6'),
('Robert Speedwagon', 'M', 'speedwagonfd@jmail.com', '78842815248300fa6ae79f7776a5080a'),
('Kumar Gv', 'M', 'stockjeeves@gmail.com', '7996d3226fea0205b6d2ed3a7d807b3c'),
('Student2', 'F', 'student22@email.com', 'iamstudent2'),
('Student123', 'F', 'student@email.com', 'ad6a280417a0f533d8b670c61667e1a0'),
('User-1', 'M', 'user@mail.com', 'ee96144a08bb4e9c2bb6108ea5a0310c');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `after_insert_user` AFTER INSERT ON `user` FOR EACH ROW BEGIN
insert into audit_user
set action_performed='INSERTED BEFORE!!',
name=new.name,
email=new.email,
gender=new.gender,
password=new.password;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_mobile`
--

CREATE TABLE `user_mobile` (
  `email` varchar(100) NOT NULL,
  `mobileno` varchar(10) CHARACTER SET ucs2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_mobile`
--

INSERT INTO `user_mobile` (`email`, `mobileno`) VALUES
('abbashu@mail.com', '9092019090'),
('alaba00@mail.com', '9309802001'),
('anand@mail.com', '1234569021'),
('anirudhstock01@gmail.com', '9090590901'),
('jojopt2@mai1.com', '9390226969'),
('jolynecujo@mail.com', '8687654656'),
('light@kiramail.com', '9930930903'),
('randoms@mai1.com', '2989564646'),
('redfool2@gmail.com', '8874966400'),
('speedwagonfd@jmail.com', '9542101486'),
('stockjeeves@gmail.com', '9509309031'),
('student@email.com', '8956466464'),
('user@mail.com', '7789445593');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `admin_mobile`
--
ALTER TABLE `admin_mobile`
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `audit_admin`
--
ALTER TABLE `audit_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_user`
--
ALTER TABLE `audit_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creates`
--
ALTER TABLE `creates`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD KEY `email` (`email`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`optionid`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_mobile`
--
ALTER TABLE `user_mobile`
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_admin`
--
ALTER TABLE `audit_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_user`
--
ALTER TABLE `audit_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_mobile`
--
ALTER TABLE `admin_mobile`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `admin` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `creates`
--
ALTER TABLE `creates`
  ADD CONSTRAINT `eid` FOREIGN KEY (`eid`) REFERENCES `quiz` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uname` FOREIGN KEY (`uname`) REFERENCES `admin` (`uname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `admin` (`uname`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `quiz` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_mobile`
--
ALTER TABLE `user_mobile`
  ADD CONSTRAINT `user_mobile_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

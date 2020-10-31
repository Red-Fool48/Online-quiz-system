-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 01:33 PM
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
-- Database: `temp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `abv_or_blw` ()  READS SQL DATA
begin
declare loopend int default 0;
declare marks int;
declare quiz_id varchar(100);
	declare curScore 
        CURSOR FOR
                select rank.score,rank.eid from rank where rank.score>(select avg(rank.score) from rank) order by eid desc; 
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
('admin@admin.com', 'admin', 'admin01', '400172c9b1be38efc3431f3c53b97986'),
('chandi_god@ccg.vom', 'Shreyas', 'Shreyas', '6fddcb6f91c3a68155cf4e913540e345'),
('iamadmin@admin.com', 'Admin True', 'yoda', '72c144bf587a410ea64ebbfb8083d86a'),
('kumark@mail.com', 'Kumar K', 'kk01', '6726d476e7957b1027043d92653b5eb0'),
('light@kiramail.com', 'Light Y', 'light', '98d97d34aab490426f346009ad7c1836'),
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
('chandi_god@ccg.vom', '90902909023'),
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
('5f94509899530', '5f94509899ebd'),
('5f9450989bca6', '5f9450989c0ec'),
('5f9450989df86', '5f9450989e45b'),
('5f94551d7e5ea', '5f94551d7f5e2'),
('5f94551d84d64', '5f94551d855af'),
('5f94551d88997', '5f94551d8970c');

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
(9, 'Robert Speedwagon', '', 'speedwagonfd@jmail.com', '78842815248300fa6ae79f7776a5080a', 'INSERTED BEFORE!!'),
(10, 'Abbas', '', 'abbashu@mail.com', '7a2ef39136567897eb07805e754a81d8', 'INSERTED BEFORE!!'),
(11, 'Student123', '', 'student@email.com', 'ad6a280417a0f533d8b670c61667e1a0', 'INSERTED BEFORE!!');

-- --------------------------------------------------------

--
-- Table structure for table `creates`
--

CREATE TABLE `creates` (
  `eid` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(27, 'redfool2@gmail.com', 'DBMS', 'Very good');

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
('redfool2@gmail.com', '5f9454c02f48d', 2, 3, 1, 2, '2020-10-27 03:04:34'),
('redfool2@gmail.com', '5f94507a38f8e', 6, 3, 2, 1, '2020-10-27 03:05:13'),
('jolynecujo@mail.com', '5f9454c02f48d', 7, 3, 2, 1, '2020-10-27 03:06:32'),
('student@email.com', '5f94507a38f8e', 2, 3, 1, 2, '2020-10-30 11:58:55');

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
(2, 'Hello 2.11!!', 'yoda'),
(5, 'Hello!!', 'Shreyas');

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
('5f94509899530', 'aa', '5f94509899eb0'),
('5f94509899530', 'aaa', '5f94509899eba'),
('5f94509899530', 'aaaa', '5f94509899ebc'),
('5f94509899530', 'all of the above', '5f94509899ebd'),
('5f9450989bca6', 'fe', '5f9450989c0e8'),
('5f9450989bca6', 'tew', '5f9450989c0eb'),
('5f9450989bca6', 'stew', '5f9450989c0ec'),
('5f9450989bca6', 'nb', '5f9450989c0ed'),
('5f9450989df86', 'pop', '5f9450989e457'),
('5f9450989df86', 'kkp', '5f9450989e459'),
('5f9450989df86', 'opopew', '5f9450989e45a'),
('5f9450989df86', 'all of the above', '5f9450989e45b'),
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
('5f94551d88997', 'TB', '5f94551d8970c');

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
('5f94507a38f8e', '5f94509899530', 'aaa', 4, 1),
('5f94507a38f8e', '5f9450989bca6', 'tews', 4, 2),
('5f94507a38f8e', '5f9450989df86', 'otpowep', 4, 3),
('5f9454c02f48d', '5f94551d7e5ea', 'Who made e=mc^2', 4, 1),
('5f9454c02f48d', '5f94551d84d64', 'Who is the father of the computer?', 4, 2),
('5f9454c02f48d', '5f94551d88997', 'Which among the following is the largest?', 4, 3);

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
('5f94507a38f8e', '1q', 4, 2, 3, 11, '', '53', '2020-10-24 16:04:10'),
('5f9454c02f48d', 'Maths', 4, 1, 3, 11, '', 'jfsjao', '2020-10-24 16:22:24');

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
('5f9454c02f48d', 'redfool2@gmail.com', 2, '2020-10-27 03:04:35'),
('5f94507a38f8e', 'redfool2@gmail.com', 6, '2020-10-27 03:05:13'),
('5f9454c02f48d', 'jolynecujo@mail.com', 7, '2020-10-27 03:06:32'),
('5f94507a38f8e', 'student@email.com', 2, '2020-10-30 11:58:55');

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
('New User', 'M', 'anirudhstock01@gmail.com', 'ac2b5f88fc33b7b9e0682be85784ec0d'),
('Joseph Joe', 'M', 'jojopt2@mai1.com', 'aa10208553fc389ebaabc04dea4b84c4'),
('Jolyne', 'F', 'jolynecujo@mail.com', 'ccee29fb820d4bd633d51a6d11b56707'),
('Light Yagami', 'F', 'light@kiramail.com', 'c5703bcd53d784ff8b52620caa8c56c5'),
('Red F', 'M', 'redfool2@gmail.com', '5dcb162f0a4dcec9f62e9b67fcb809e6'),
('Robert Speedwagon', 'M', 'speedwagonfd@jmail.com', '78842815248300fa6ae79f7776a5080a'),
('Kumar Gv', 'M', 'stockjeeves@gmail.com', '7996d3226fea0205b6d2ed3a7d807b3c'),
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
('anirudhstock01@gmail.com', '9090590901'),
('jojopt2@mai1.com', '9390226969'),
('jolynecujo@mail.com', '8687654656'),
('light@kiramail.com', '9930930903'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_user`
--
ALTER TABLE `audit_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

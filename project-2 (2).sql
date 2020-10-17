-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 09:27 PM
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
-- Database: `project-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `uname`, `email`, `password`, `mobile`) VALUES
('admin', 'admin01', 'admin@admin.com', '400172c9b1be38efc3431f3c53b97986', '8745113289'),
('Admin-1', 'admn', 'newadmin@email.com', '7cf2336ddf6bc41efb1ec267d48e537b', '9340920901'),
('Kumar K', 'kk01', 'somerandom@mail.com', '6726d476e7957b1027043d92653b5eb0', '9379210930'),
('Light Y', 'light', 'kira@gmail.com', '98d97d34aab490426f346009ad7c1836', '9223049020'),
('Sheldon Cooper', 'shelly', 'sheldonl@rmail.com', '7f08fcb5f3b5958be22d4b06c652c8a2', '9389801200'),
('Sue Some', 'sussie', 'suesome@gmail.com', '28b82464abc56a89d187b21b530badc6', '9090428020'),
('Admin True', 'yoda', 'iamadmin@admin.com', '72c144bf587a410ea64ebbfb8083d86a', '9029887429');

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
('5f8b425412a3b', '5f8b425413819'),
('5f8b425419895', '5f8b42541a68b');

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
('redfool2@gmail.com', '5f8b42154dcf8', 2, 2, 1, 1, '2020-10-17 19:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice` varchar(500) CHARACTER SET utf8 NOT NULL,
  `uname` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice`, `uname`) VALUES
('Hello!!', 'admin01'),
('Hello 2.11!!', 'yoda');

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
('5f8b425412a3b', 'ab', '5f8b425413810'),
('5f8b425412a3b', 'bc', '5f8b425413817'),
('5f8b425412a3b', 'cd', '5f8b425413818'),
('5f8b425412a3b', 'all of the above', '5f8b425413819'),
('5f8b425419895', 'helo', '5f8b42541a68b'),
('5f8b425419895', 'halo', '5f8b42541a692'),
('5f8b425419895', 'je', '5f8b42541a693'),
('5f8b425419895', 'noine', '5f8b42541a694');

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
('5f8b42154dcf8', '5f8b425412a3b', 'abcd', 4, 1),
('5f8b42154dcf8', '5f8b425419895', 'hello', 4, 2);

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
('5f8b42154dcf8', 'Quiz 2', 3, 1, 2, 11, '', 'new quiz', '2020-10-17 19:12:21');

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
('5f8b42154dcf8', 'redfool2@gmail.com', 2, '2020-10-17 19:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `gender`, `email`, `mobileno`, `password`) VALUES
('New User', 'M', 'anirudhstock01@gmail.com', 9090590901, 'ac2b5f88fc33b7b9e0682be85784ec0d'),
('Jolyne', 'F', 'jolynecujo@mail.com', 8687654656, 'ccee29fb820d4bd633d51a6d11b56707'),
('Light Yagami', 'F', 'light@kiramail.com', 9930930903, 'c5703bcd53d784ff8b52620caa8c56c5'),
('Red F', 'M', 'redfool2@gmail.com', 8874966400, '5dcb162f0a4dcec9f62e9b67fcb809e6'),
('Abcd', 'M', 'reset@mail.com', 9080802411, '7ddf32e17a6ac5ce04a8ecbf782ca509'),
('Kumar Gv', 'M', 'stockjeeves@gmail.com', 9509309031, '7996d3226fea0205b6d2ed3a7d807b3c'),
('User-1', 'M', 'user@mail.com', 7789445593, 'ee96144a08bb4e9c2bb6108ea5a0310c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `admin` (`uname`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

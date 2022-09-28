-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 11:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_spstp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblauthor`
--

CREATE TABLE `tblauthor` (
  `authorid` int(11) NOT NULL,
  `authorname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblauthor`
--

INSERT INTO `tblauthor` (`authorid`, `authorname`) VALUES
(1, 'មិនមាន'),
(3, 'Leappeng van');

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `bookid` int(11) NOT NULL,
  `booktitle` varchar(255) NOT NULL,
  `codecolorid` int(1) DEFAULT NULL,
  `codedeveid` int(1) DEFAULT NULL,
  `authorid` int(1) DEFAULT NULL,
  `publishinghouse` varchar(255) DEFAULT NULL,
  `yearpublication` varchar(11) DEFAULT NULL,
  `datein` date DEFAULT NULL,
  `quality` varchar(20) DEFAULT NULL,
  `cabinetid` int(1) DEFAULT NULL,
  `numcabinet` varchar(10) DEFAULT NULL,
  `numberingbook` varchar(10) DEFAULT NULL,
  `isIssued` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`bookid`, `booktitle`, `codecolorid`, `codedeveid`, `authorid`, `publishinghouse`, `yearpublication`, `datein`, `quality`, `cabinetid`, `numcabinet`, `numberingbook`, `isIssued`) VALUES
(49, 'a', 1, 2, 3, 'b', '2000', '2022-07-13', 'មធ្យម', 2, '12', '12-11111', 0),
(50, 'a', 1, 2, 3, 'ក្រសួរងអប់រំ', '2012', '2022-07-29', 'ថ្មី', 2, '13', '13-02', 1),
(51, 'រឿងនិទានខ្មែរ', 1, 3, 3, 'ក្រសួរងអប់រំ', '2012', '2022-07-30', 'មធ្យម', 2, '13', '13-023333', 1),
(52, 'រឿងនិទានខ្មែរ', 4, 1, 3, 'ក្រសួរងអប់រំ', '2012', '2022-07-04', 'មធ្យម', 2, '13', '13-02', 1),
(53, 'រឿងនិទានខ្មែរ', 2, 1, 3, 'b', '2000', '2022-07-20', 'មធ្យម', 2, '13', '13-023333', 1),
(55, 'khmer', 2, 1, 1, 'ក្រសួរងអប់រំ', '2000', '2022-07-15', 'ចាស់', 2, '13', '13-023333', 1),
(480000, 'រឿងនិទានខ្មែរ', 1, 2, 3, 'ក្រសួរងអប់រំ', '2012', '2022-07-13', 'ថ្មី', 2, '13', '13-02', 0),
(4800004, 'khmer123', 1, 1, 1, '', '2000', '2022-07-18', 'មធ្យម', 2, '13', '13-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooktype_color`
--

CREATE TABLE `tblbooktype_color` (
  `id` int(11) NOT NULL,
  `colorname` varchar(100) NOT NULL,
  `bookcolortype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbooktype_color`
--

INSERT INTO `tblbooktype_color` (`id`, `colorname`, `bookcolortype`) VALUES
(1, 'មិនមាន', 'មិនមាន'),
(2, 'ក្រហម', 'និទានរឿងអំពីគុណធម៌'),
(4, 'បៃតងស្រាល', 'និទានរឿងអំពីរុក្ខជាតិ-សត្វ');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooktype_deve`
--

CREATE TABLE `tblbooktype_deve` (
  `id` int(11) NOT NULL,
  `devenum` varchar(11) NOT NULL,
  `devebooktype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbooktype_deve`
--

INSERT INTO `tblbooktype_deve` (`id`, `devenum`, `devebooktype`) VALUES
(1, 'មិនមាន', 'មិនមាន'),
(2, '340', 'វិទ្យាសាស្រ្តសង្គម'),
(3, '370', 'វិទ្យាសាស្រ្តសង្គម'),
(5, '800', 'អក្សរសិល្ប៍');

-- --------------------------------------------------------

--
-- Table structure for table `tblborrow`
--

CREATE TABLE `tblborrow` (
  `id` int(11) NOT NULL,
  `studentid` varchar(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `borrowdate` date NOT NULL,
  `datereturn` date NOT NULL,
  `ReturnStatus` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblborrow`
--

INSERT INTO `tblborrow` (`id`, `studentid`, `bookid`, `borrowdate`, `datereturn`, `ReturnStatus`, `year`) VALUES
(24, 'SPSTP0009', 48, '2022-07-16', '2022-07-17', 1, 1),
(26, 'SPSTP0009', 51, '2022-07-16', '2022-07-18', 1, 1),
(28, 'SPSTP0009', 48, '2022-07-16', '2022-07-19', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `id` int(11) NOT NULL,
  `branchname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`id`, `branchname`) VALUES
(1, 'ទីតាំងទួលទំពូង');

-- --------------------------------------------------------

--
-- Table structure for table `tblcabinet`
--

CREATE TABLE `tblcabinet` (
  `cabinetid` int(11) NOT NULL,
  `cabinet_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcabinet`
--

INSERT INTO `tblcabinet` (`cabinetid`, `cabinet_type`) VALUES
(1, 'មិនមាន'),
(2, 'ទូរទ្រេត'),
(4, 'ទូរប្រអប់');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `classid` int(11) NOT NULL,
  `classname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`classid`, `classname`) VALUES
(1, 'ថ្នាក់ទី ១'),
(2, 'ថ្នាក់ទី ២'),
(3, 'ថ្នាក់ទី ៣'),
(4, 'ថ្នាក់ទី ៤'),
(6, 'ថ្នាក់ទី ៥'),
(7, 'ថ្នាក់ទី ៦');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `id` int(11) NOT NULL,
  `studentid` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `RegUpdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`id`, `studentid`, `username`, `gender`, `password`, `phone`, `teacherid`, `status`, `RegDate`, `RegUpdate`) VALUES
(6, 'SPSTP0001', 'a', 'ប្រុស', '202cb962ac59075b964b07152d234b70', '0969158581', 1, 0, '2022-07-09 19:02:29', '2022-07-10 13:06:02'),
(7, 'SPSTP0002', 'a', 'ស្រី', '202cb962ac59075b964b07152d234b70', '0969158581', 1, 0, '2022-07-09 19:04:07', '2022-07-10 13:06:08'),
(9, 'SPSTP0005', '123', 'ស្រី', 'd9b1d7db4cd6e70935368a1efb10e377', '01234563', 1, 1, '2022-07-10 09:29:42', '2022-07-17 11:47:21'),
(10, 'SPSTP0006', '12', 'ប្រុស', 'cf36cba3a1d28a4947b6b8706df9c91b', '', 1, 1, '2022-07-10 12:21:59', '2022-07-15 01:55:59'),
(11, 'SPSTP0007', '12', 'ប្រុស', 'c8b2f17833a4c73bb20f88876219ddcd', '0969158581', 1, 0, '2022-07-10 12:22:09', '2022-07-10 12:36:35'),
(12, 'SPSTP0009', '12345', 'ប្រុស', '1f32aa4c9a1d2ea010adcf2348166a04', 'sfa', 1, 1, '2022-07-10 12:46:08', '2022-07-14 06:27:25'),
(13, 'SPSTP0010', 'sdafdsa', 'ប្រុស', '202cb962ac59075b964b07152d234b70', '0969158581', 1, 0, '2022-07-10 12:47:22', NULL),
(14, 'SPSTP0012', 'safsadf', 'ប្រុស', '202cb962ac59075b964b07152d234b70', '1233', 1, 0, '2022-07-10 12:56:47', NULL),
(15, 'SPSTP0015', 't', 'male', '202cb962ac59075b964b07152d234b70', '0969158581', 1, 1, '2022-07-18 03:45:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstureaddaily`
--

CREATE TABLE `tblstureaddaily` (
  `id` int(11) NOT NULL,
  `studentid` varchar(100) NOT NULL,
  `bookid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `classid` int(11) NOT NULL,
  `yearid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblstureaddaily`
--

INSERT INTO `tblstureaddaily` (`id`, `studentid`, `bookid`, `date`, `classid`, `yearid`) VALUES
(1, 'SPSTP0009', 48, '2022-07-17 05:37:44', 2, 1),
(2, 'SPSTP0009', 48, '2022-07-17 08:56:57', 3, 1),
(3, 'SPSTP0006', 48, '2022-07-17 09:01:23', 2, 1),
(4, 'SPSTP0009', 48, '2022-07-17 10:33:44', 6, 3),
(5, 'SPSTP0005', 52, '2022-07-17 10:34:04', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `teacherid` int(11) NOT NULL,
  `teachername` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `classteacher` int(11) NOT NULL,
  `timeteach` varchar(50) DEFAULT NULL,
  `teachlanguage` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`teacherid`, `teachername`, `gender`, `classteacher`, `timeteach`, `teachlanguage`, `phone`) VALUES
(1, 'Van Leappeng', 'ប្រុស', 2, 'ពេញម៉ោង', 'ភាសាខ្មែរ', '0969158581');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `name`, `gender`, `address`, `username`, `password`, `photo`, `phone`, `user_type`) VALUES
(24, 'San Sreypin', 'ស្រី', 'Battambang', 'San.Sreypin', '7363a0d0604902af7b70b271a0b96480', '1449798684.png', '0969158581', 'admin'),
(25, 'Leappeng1', 'ប្រុស', 'bbb', 'Van leappeng', '202cb962ac59075b964b07152d234b70', '', '0969158581', 'user'),
(26, 'Van Leappeng', 'ស្រី', 'Battambang', 'Leappeng123', 'd9b1d7db4cd6e70935368a1efb10e377', '', '0969158581', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year`
--

CREATE TABLE `tbl_year` (
  `id` int(11) NOT NULL,
  `studyyear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_year`
--

INSERT INTO `tbl_year` (`id`, `studyyear`) VALUES
(1, '2022-2023'),
(3, '2023-2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblauthor`
--
ALTER TABLE `tblauthor`
  ADD PRIMARY KEY (`authorid`);

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `tblbooktype_color`
--
ALTER TABLE `tblbooktype_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooktype_deve`
--
ALTER TABLE `tblbooktype_deve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblborrow`
--
ALTER TABLE `tblborrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcabinet`
--
ALTER TABLE `tblcabinet`
  ADD PRIMARY KEY (`cabinetid`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstureaddaily`
--
ALTER TABLE `tblstureaddaily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`teacherid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbl_year`
--
ALTER TABLE `tbl_year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblauthor`
--
ALTER TABLE `tblauthor`
  MODIFY `authorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblbooktype_color`
--
ALTER TABLE `tblbooktype_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblbooktype_deve`
--
ALTER TABLE `tblbooktype_deve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblborrow`
--
ALTER TABLE `tblborrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcabinet`
--
ALTER TABLE `tblcabinet`
  MODIFY `cabinetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblstureaddaily`
--
ALTER TABLE `tblstureaddaily`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_year`
--
ALTER TABLE `tbl_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

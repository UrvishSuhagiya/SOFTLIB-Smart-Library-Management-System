-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylib`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'URVISH', 'admin@gmail.com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2025-03-24 03:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Anuj kumar', '2023-12-31 21:23:03', '2025-01-07 06:18:43'),
(2, 'Chetan Bhagatt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(3, 'Anita Desai', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(4, 'HC Verma', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(5, 'R.D. Sharma ', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(10, 'Dr. Anddy Williams', '2023-12-31 21:23:03', '2025-03-19 04:15:02'),
(11, 'Kyle Hill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(12, 'Robert T. Kiyosak', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(13, 'Kelly Barnhill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(14, 'Herbert Schildt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(16, ' Tiffany Timbers', '2025-01-07 06:55:54', NULL),
(18, 'John Shovic', '2025-01-17 14:23:10', NULL),
(22, 'Dr.Vishal Choudhary', '2025-04-10 06:12:06', NULL),
(23, 'Nayna Birla', '2025-04-11 03:28:13', NULL),
(24, 'Rupal Bansal', '2025-04-11 03:30:41', NULL),
(25, 'Anoop Singh Ponia', '2025-04-11 03:31:08', NULL),
(26, 'Archna Jain', '2025-04-11 03:31:27', NULL),
(27, 'Swati Srivastava', '2025-04-11 03:31:43', NULL),
(28, 'Er.Anuja Bhargava', '2025-04-11 03:32:01', NULL),
(29, 'Dr.Veena Yadav', '2025-04-11 03:32:21', NULL),
(30, 'Deepak Baberwal', '2025-04-11 03:32:39', NULL),
(31, 'Tarun Goyal', '2025-04-11 03:32:48', NULL),
(32, 'Er.Sohan Lal Gupta', '2025-04-11 03:33:10', NULL),
(33, 'Abhishek Dadhich', '2025-04-11 03:33:28', NULL),
(34, 'Mamta Sakpal', '2025-04-11 03:33:38', NULL),
(35, 'Ruchi Patira', '2025-04-11 03:33:56', NULL),
(36, 'Dr.Kusumlata Bhardwaj', '2025-04-11 03:34:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` varchar(25) DEFAULT NULL,
  `BookPrice` decimal(10,2) DEFAULT NULL,
  `bookImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `bookQty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`, `bookQty`) VALUES
(1, 'PHP And MySql programming', 5, 1, '222333', 20.00, 'f7ab993cf36afd6df181c1c6660949af.jpg', 0, '2024-01-02 01:23:03', '2025-03-22 08:24:57', 10),
(3, 'physics', 6, 4, '1111', 150.00, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', 0, '2024-01-02 01:23:03', '2025-04-07 04:27:28', 11),
(5, 'Murach\'s MySQL', 5, 1, '9350237695', 455.00, 'a39cdf7c98f25415cbb07c6294c629b8.jpg', NULL, '2024-01-02 01:23:03', '2025-04-07 05:20:27', 20),
(7, 'WordPress Mastery Guide..', 5, 11, 'B09NKWH7NP', 530.00, '90083a56014186e88ffca10286172e64.jpg', NULL, '2024-01-02 01:23:03', '2025-04-07 04:52:47', 14),
(8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'B07C7M8SX9', 120.00, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:41', 5),
(9, 'The Girl Who Drank the Moon', 8, 13, '1848126476', 200.00, 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:45', 1),
(10, 'C++: The Complete Reference, 4th Edition', 5, 14, '007053246X', 142.00, '36af5de9012bf8c804e499dc3c3b33a5.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 2),
(11, 'ASP.NET Core 5 for Beginners', 9, 11, 'GBSJ36344563', 422.00, 'b1b6788016bbfab12cfd2722604badc9.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 5),
(12, 'Python Packages', 9, 16, '0367687771', 3034.00, 'ba719639def504c64ebac89cdd0d0a85.jpg', NULL, '2025-01-07 06:56:50', NULL, 25),
(13, 'Python All-in-One for Dummies', 9, 18, '9388991214', 700.00, 'f4ba4705a075527dd6ff5bd83a7d7562.jpg', 0, '2025-01-17 14:23:48', '2025-01-17 14:25:52', 30),
(15, 'Internet Of Things', 5, 22, '2452562', 389.00, '3ce45fca9350d0a1ce3d10dd42f84bcc.jpg', NULL, '2025-04-10 06:13:34', '2025-04-11 03:25:45', 7),
(16, 'Mobile Computing', 9, 23, '242464', 140.00, '71a620255af1db98f09e23b1b9625027.jpg', NULL, '2025-04-11 03:29:40', NULL, 7),
(17, 'Information Theory & Coding', 9, 24, '242465', 220.00, 'd6b1d5c6814e4167166b9a9234c2163b.jpg', NULL, '2025-04-11 05:12:41', NULL, 9),
(18, 'Artificial Intelligence', 5, 26, '242466', 200.00, '81ddf0e8d640dcce00f9bd9beefe630b.jpg', NULL, '2025-04-11 05:13:38', NULL, 11),
(19, 'Digital Image Processing', 5, 28, '242467', 180.00, '7e8004e8a6a2ca26f25880135a3c72ba.jpg', NULL, '2025-04-11 05:14:37', NULL, 5),
(20, 'Cloud Computing', 5, 29, '242468', 180.00, 'af19877dc5c72acd0267b3111190a176.jpg', NULL, '2025-04-11 05:15:22', NULL, 15),
(21, 'Computer Architecture And Organization ', 9, 32, '242469', 200.00, '57a99191234cb72b4c7b14870ecd8db8.jpg', NULL, '2025-04-11 05:16:52', NULL, 8),
(22, 'Machine Learning', 9, 33, '242470', 220.00, '5bb87588476bd9460ce1114e85b0d762.jpg', NULL, '2025-04-11 05:17:51', NULL, 16),
(23, 'Object Oriented Programming With C++', 9, 35, '242471', 236.00, '333c46fea9090969eacdcb97df63d2fa.jpg', NULL, '2025-04-11 05:18:35', NULL, 11),
(24, 'Technical Communication', 5, 36, '242472', 144.00, '2f7125617f2846cca49ec313919cdc36.jpg', NULL, '2025-04-11 05:19:26', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(5, 'Technology', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(6, 'Science', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(7, 'Management', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(8, 'General', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(9, 'Programming', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `remark` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`, `remark`) VALUES
(1, 1, 'SID002', '2025-01-13 11:12:40', '2025-01-14 06:00:56', 1, 0, 'NA'),
(2, 7, 'SID010', '2025-01-14 05:55:25', NULL, NULL, NULL, 'NA'),
(3, 1, 'SID010', '2025-01-14 05:55:39', '2025-03-19 06:15:23', 1, 0, 'NA'),
(5, 1, 'SID002', '2025-01-14 06:02:14', '2025-01-14 06:03:36', 1, 0, 'ds'),
(7, 13, 'SID013', '2025-01-17 14:24:47', '2025-01-17 14:25:52', 1, 0, 'NA'),
(8, 13, 'SID012', '2025-01-17 14:25:34', '2025-03-13 07:47:54', 1, 50, 'NA'),
(10, 1, 'SID016', '2025-03-19 08:56:34', '2025-03-19 08:58:59', 1, 0, 'ok'),
(12, 8, 'SID016', '2025-03-22 09:28:11', NULL, NULL, NULL, 'ok'),
(13, 7, 'SID021', '2025-04-07 08:38:50', NULL, NULL, NULL, 'issue');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `EnrollmentNo` varchar(20) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `EnrollmentNo`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'SID002', NULL, 'Anuj kumar', 'anujk@gmail.com', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 0, '2024-01-03 07:23:03', '2025-03-18 08:22:01'),
(4, 'SID005', NULL, 'sdfsd', 'csfsd@dfsfks.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 0, '2024-01-03 07:23:03', '2025-03-18 08:22:05'),
(8, 'SID009', NULL, 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-03-18 08:21:59'),
(9, 'SID010', NULL, 'Amit', 'amit@gmail.com', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-01-07 06:20:36'),
(10, 'SID011', NULL, 'Sarita Pandey', 'sarita@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 0, '2024-01-03 07:23:03', '2025-03-20 03:15:55'),
(12, 'SID013', NULL, 'Ajay Kumar Singh', 'ajay12@t.com', '1231231230', 'f925916e2754e5e03f75dd58a5733251', 1, '2025-01-17 14:20:50', '2025-01-17 14:21:21'),
(14, 'SID015', NULL, 'johm', 'john@gmail.com', '1256987654', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2025-03-17 07:52:10', NULL),
(15, 'SID016', NULL, 'Urvish SOE', 'urvish@gmail.com', '8643567890', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2025-03-19 07:18:35', '2025-03-24 04:46:42'),
(20, 'SID021', '21SE02CE043', 'Urvish S.', 'urvish1@gmail.com', '7654356767', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2025-04-07 08:20:23', '2025-04-07 08:24:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

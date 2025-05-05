-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 01:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


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
(1, 'URVISH', 'admin@gmail.com', 'admin', '1ffbefaa1a414cc75b765a075c8c26ba', '2025-05-05 09:12:44');

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
(1, 'PHP And MySql programming', 5, 1, 'SLB0001', 20.00, 'f7ab993cf36afd6df181c1c6660949af.jpg', 0, '2024-01-02 01:23:03', '2025-05-05 10:05:16', 10),
(3, 'physics', 6, 4, 'SLB0002', 150.00, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', 0, '2024-01-02 01:23:03', '2025-05-05 10:05:22', 11),
(5, 'Murach\'s MySQL', 5, 1, 'SLB0003', 455.00, 'a39cdf7c98f25415cbb07c6294c629b8.jpg', NULL, '2024-01-02 01:23:03', '2025-05-05 10:05:30', 20),
(7, 'WordPress Mastery Guide..', 5, 11, 'SLB0004', 530.00, '90083a56014186e88ffca10286172e64.jpg', NULL, '2024-01-02 01:23:03', '2025-05-05 10:05:27', 14),
(8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'SLB0005', 120.00, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-02 01:23:03', '2025-05-05 10:05:34', 5),
(9, 'The Girl Who Drank the Moon', 8, 13, 'SLB0006', 200.00, 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2024-01-02 01:23:03', '2025-05-05 10:05:36', 1),
(10, 'C++: The Complete Reference, 4th Edition', 5, 14, 'SLB0007', 142.00, '36af5de9012bf8c804e499dc3c3b33a5.jpg', 0, '2024-01-02 01:23:03', '2025-05-05 10:53:11', 2),
(11, 'ASP.NET Core 5 for Beginners', 9, 11, 'SLB0008', 422.00, 'b1b6788016bbfab12cfd2722604badc9.jpg', NULL, '2024-01-02 01:23:03', '2025-05-05 10:05:43', 5),
(12, 'Python Packages', 9, 16, 'SLB0009', 3034.00, 'ba719639def504c64ebac89cdd0d0a85.jpg', NULL, '2025-01-07 06:56:50', '2025-05-05 10:05:46', 25),
(13, 'Python All-in-One for Dummies', 9, 18, 'SLB0010', 700.00, 'f4ba4705a075527dd6ff5bd83a7d7562.jpg', 0, '2025-01-17 14:23:48', '2025-05-05 10:05:56', 30),
(15, 'Internet Of Things', 5, 22, 'SLB0011', 389.00, 'e3a2c623093a2ed378b663fb10a361aa.jpg', NULL, '2025-04-10 06:13:34', '2025-05-05 10:45:11', 7),
(16, 'Mobile Computing', 9, 23, 'SLB0012', 140.00, '71a620255af1db98f09e23b1b9625027.jpg', NULL, '2025-04-11 03:29:40', '2025-05-05 10:06:06', 7),
(17, 'Information Theory & Coding', 9, 24, 'SLB0013', 220.00, 'd6b1d5c6814e4167166b9a9234c2163b.jpg', 0, '2025-04-11 05:12:41', '2025-05-05 10:47:10', 9),
(18, 'Artificial Intelligence', 5, 26, 'SLB0014', 200.00, '1d7220ed8c9f7639eda861b77cf9943d.jpg', NULL, '2025-04-11 05:13:38', '2025-05-05 10:45:34', 11),
(19, 'Digital Image Processing', 5, 28, 'SLB0015', 180.00, '42070673b366233232263b0aa5093618.jpg', NULL, '2025-04-11 05:14:37', '2025-05-05 10:45:56', 5),
(20, 'Cloud Computing', 5, 29, 'SLB0016', 180.00, '62a9962b3f6e3584d271b5e2b353c462.jpg', NULL, '2025-04-11 05:15:22', '2025-05-05 10:46:28', 15),
(21, 'Computer Architecture And Organization ', 9, 32, 'SLB0017', 200.00, '57a99191234cb72b4c7b14870ecd8db8.jpg', NULL, '2025-04-11 05:16:52', '2025-05-05 10:06:25', 8),
(22, 'Machine Learning', 9, 33, 'SLB0018', 220.00, '5bb87588476bd9460ce1114e85b0d762.jpg', NULL, '2025-04-11 05:17:51', '2025-05-05 10:06:29', 16),
(23, 'Object Oriented Programming With C++', 9, 35, 'SLB0019', 236.00, '333c46fea9090969eacdcb97df63d2fa.jpg', NULL, '2025-04-11 05:18:35', '2025-05-05 10:06:33', 11),
(24, 'Technical Communication', 5, 36, 'SLB0020', 144.00, '2f7125617f2846cca49ec313919cdc36.jpg', NULL, '2025-04-11 05:19:26', '2025-05-05 10:06:37', 10);

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
(1, 1, 'SID002', '2025-03-01 06:12:40', '2025-04-03 10:56:00', 1, 125, 'NA'),
(5, 1, 'SID002', '2025-01-14 06:02:14', '2025-01-14 10:03:36', 1, 0, 'NA'),
(14, 18, 'SID004', '2025-03-05 10:07:14', '2025-04-07 10:56:20', 1, 107, 'ISSUE'),
(15, 3, 'SID003', '2025-05-01 06:00:59', '2025-05-02 10:16:58', 1, 0, 'ISSUE\r\n'),
(16, 16, 'SID007', '2025-04-30 09:00:59', '2025-05-03 10:57:45', 1, 0, 'ISSUE\r\n'),
(17, 1, 'SID006', '2025-03-05 10:09:57', '2025-03-10 10:17:32', 1, 0, 'ISSUE'),
(18, 17, 'SID005', '2025-02-05 04:10:56', '2025-02-19 10:47:10', 1, 0, 'ISSUE'),
(19, 10, 'SID005', '2025-04-01 07:20:39', '2025-04-05 05:52:51', 1, 0, 'NA'),
(20, 19, 'SID006', '2025-02-03 04:50:42', '2025-03-20 10:55:03', 1, 0, 'ISSUE'),
(21, 12, 'SID004', '2025-05-05 11:05:32', NULL, NULL, NULL, 'ISSUE\r\n');

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
(1, 'SID001', '19SE02CS054', 'Anuj Chauhan', '19se02cs054@ppsu.ac.in', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 0, '2024-01-03 07:23:03', '2025-05-05 11:09:25'),
(9, 'SID002', '23SS01IT034', 'Amit Parmar', '21ss01it034@ppsu.ac.in', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-05-05 10:03:07'),
(10, 'SID003', '22SE01IE003', 'Sarita Pandey', '22se01ie003@ppsu.ac.in', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-05-05 10:03:12'),
(12, 'SID004', '01SE03CE022', 'Ajay Kumar Singh', 'ajay.singh@ppsu.ac.in', '1231231230', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-18 14:20:50', '2025-05-05 11:00:44'),
(21, 'SID005', '21SE02CE043', 'Urvish Suhagiya', '21se02ce043@ppsu.ac.in', '9837352849', 'b856540fa360c340f8707be106df422a', 1, '2021-02-09 07:51:58', '2025-05-05 11:01:00'),
(23, 'SID006', '21SE02CE042', 'Nevil Sorathiya', '21se02ce042@ppsu.ac.in', '9643567890', '012318a2b720092d09ff1dc00b16ce82', 1, '2021-01-21 08:47:14', '2025-05-05 11:01:30'),
(30, 'SID007', '21SE02CE040', 'Raj Koradiya', '21se02ce040@ppsu.ac.in', '9837352849', 'ff34cc5a7a8097a7f86da38e47e4b72c', 1, '2022-01-11 09:10:49', '2025-05-05 11:01:20');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

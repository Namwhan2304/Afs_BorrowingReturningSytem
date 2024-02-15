-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 12:41 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afs_databases`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `ID_Borrowing` int(8) UNSIGNED ZEROFILL NOT NULL,
  `ID_Employee` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `ID_Tool` int(6) UNSIGNED ZEROFILL DEFAULT NULL,
  `Site` varchar(50) DEFAULT NULL,
  `Date_Borrow` date DEFAULT NULL,
  `Date_Return` date NOT NULL,
  `Status` int(1) NOT NULL COMMENT '1-กำลังยืม 2-คืนแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `ID_Employee` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสพนักงาน',
  `Em_FirstName` varchar(30) NOT NULL COMMENT 'ชื่อพนักงาน',
  `Em_LastName` varchar(30) NOT NULL COMMENT 'สกุลพนักงาน',
  `Em_Phone` varchar(10) NOT NULL COMMENT 'Phone number',
  `Password` varchar(128) NOT NULL,
  `Status` varchar(1) NOT NULL COMMENT '0=User\r\n1=Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`ID_Employee`, `Em_FirstName`, `Em_LastName`, `Em_Phone`, `Password`, `Status`) VALUES
(000000, 'Admin', 'AFS', '0', 'a1e11c5d0b12fb74fd97f392c088b16ea641fcc55f80c8b0d4e5e1a2903887b70173c487ab994516f26f0b13a72da36f61ac00b5644bb1a2e9a78cbd4a4c4dc9', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tool_data`
--

CREATE TABLE `tool_data` (
  `ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `Tool_Name` varchar(255) DEFAULT NULL,
  `ID_MainCategoryTool` int(2) DEFAULT NULL,
  `ID_SubcategoryTool` int(2) DEFAULT NULL,
  `Tool_Image` varchar(255) DEFAULT NULL,
  `Equipment_Sequence` int(11) DEFAULT NULL,
  `Status` varchar(1) NOT NULL COMMENT '0 - ว่าง\r\n1- ไม่ว่าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tool_maincategory`
--

CREATE TABLE `tool_maincategory` (
  `ID_MainCategory` int(2) NOT NULL,
  `Name_MainCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tool_maincategory`
--

INSERT INTO `tool_maincategory` (`ID_MainCategory`, `Name_MainCategory`) VALUES
(1, 'Electrical'),
(2, 'Ladders'),
(3, 'Trolley');

-- --------------------------------------------------------

--
-- Table structure for table `tool_subcategory`
--

CREATE TABLE `tool_subcategory` (
  `ID_Subcategory` int(2) NOT NULL,
  `Name_SubCategory` varchar(50) NOT NULL,
  `ID_MainCategory` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tool_subcategory`
--

INSERT INTO `tool_subcategory` (`ID_Subcategory`, `Name_SubCategory`, `ID_MainCategory`) VALUES
(1, 'Set A', 1),
(2, 'Set B', 1),
(3, 'Platform ladders', 2),
(4, 'A-Frame', 2),
(5, 'Single/Extension ladder', 2),
(6, 'AFS 1', 3),
(7, 'AFS 2', 3),
(8, 'AFS 3', 3),
(9, 'AFS 4', 3),
(10, 'AFS 5', 3),
(11, 'AFS 6', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tool_subsubcategory`
--

CREATE TABLE `tool_subsubcategory` (
  `ID_SubSubcategory` int(11) NOT NULL,
  `Name_SubSubcategory` varchar(50) NOT NULL,
  `ID_Subcategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tool_subsubcategory`
--

INSERT INTO `tool_subsubcategory` (`ID_SubSubcategory`, `Name_SubSubcategory`, `ID_Subcategory`) VALUES
(6, 'Impact screw gun', 1),
(7, 'Screw driver gun', 1),
(8, 'Hammer drill', 1),
(9, 'Charger', 1),
(10, 'Battery (3 batteries per 1 set)', 1),
(11, '6 ft', 3),
(12, '7 ft', 3),
(13, '10 ft', 4),
(14, '15 ft (single)', 5),
(15, '20 ft (single)', 5),
(16, '10 ft (extend to 18 ft)', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`ID_Borrowing`),
  ADD KEY `ID_Employee` (`ID_Employee`),
  ADD KEY `ID_Tool` (`ID_Tool`);

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`ID_Employee`);

--
-- Indexes for table `tool_data`
--
ALTER TABLE `tool_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tool_maincategory`
--
ALTER TABLE `tool_maincategory`
  ADD PRIMARY KEY (`ID_MainCategory`);

--
-- Indexes for table `tool_subcategory`
--
ALTER TABLE `tool_subcategory`
  ADD PRIMARY KEY (`ID_Subcategory`),
  ADD KEY `ID_MainCategory` (`ID_MainCategory`);

--
-- Indexes for table `tool_subsubcategory`
--
ALTER TABLE `tool_subsubcategory`
  ADD PRIMARY KEY (`ID_SubSubcategory`),
  ADD KEY `ID_Subcategory` (`ID_Subcategory`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `ID_Borrowing` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tool_data`
--
ALTER TABLE `tool_data`
  MODIFY `ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tool_maincategory`
--
ALTER TABLE `tool_maincategory`
  MODIFY `ID_MainCategory` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tool_subcategory`
--
ALTER TABLE `tool_subcategory`
  MODIFY `ID_Subcategory` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tool_subsubcategory`
--
ALTER TABLE `tool_subsubcategory`
  MODIFY `ID_SubSubcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`ID_Employee`) REFERENCES `employee_data` (`ID_Employee`);

--
-- Constraints for table `tool_subcategory`
--
ALTER TABLE `tool_subcategory`
  ADD CONSTRAINT `tool_subcategory_ibfk_1` FOREIGN KEY (`ID_MainCategory`) REFERENCES `tool_maincategory` (`ID_MainCategory`);

--
-- Constraints for table `tool_subsubcategory`
--
ALTER TABLE `tool_subsubcategory`
  ADD CONSTRAINT `tool_subsubcategory_ibfk_1` FOREIGN KEY (`ID_Subcategory`) REFERENCES `tool_subcategory` (`ID_Subcategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

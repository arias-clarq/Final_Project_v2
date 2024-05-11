-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 05:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `date` date NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  `attendance_status_id` int(255) DEFAULT NULL,
  `worktime_status_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `employee_id`, `date`, `time_in`, `time_out`, `attendance_status_id`, `worktime_status_id`) VALUES
(7, 24, '2024-05-09', '2024-05-09 07:00:34', '2024-05-09 22:00:39', 1, 2),
(8, 26, '2024-05-09', '2024-05-09 09:13:20', '2024-05-09 10:15:30', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance_status`
--

CREATE TABLE `tbl_attendance_status` (
  `attendance_status_id` int(255) NOT NULL,
  `attendance_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance_status`
--

INSERT INTO `tbl_attendance_status` (`attendance_status_id`, `attendance_status`) VALUES
(1, 'PRESENT'),
(2, 'LATE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `bill_id` int(255) NOT NULL,
  `sss` varchar(200) NOT NULL,
  `phil` varchar(200) NOT NULL,
  `pagibig` varchar(200) NOT NULL,
  `salary` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`bill_id`, `sss`, `phil`, `pagibig`, `salary`) VALUES
(23, '456', '456', '456', 49999),
(24, '5423243', '321211', '3221243', 50000),
(26, '213', '3213', '3213', 50000),
(27, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(255) NOT NULL,
  `category` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category`) VALUES
(7, 'Snack\'s'),
(8, 'Candy\'s'),
(9, 'Beverage\'s'),
(10, 'Canned Good\'s'),
(12, 'Soft Drink\'s');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_account`
--

CREATE TABLE `tbl_customer_account` (
  `customer_id` int(255) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `login_role_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer_account`
--

INSERT INTO `tbl_customer_account` (`customer_id`, `username`, `password`, `login_role_id`) VALUES
(1, 'customer@gmail.com', 'customer', 3),
(5, 'customer2@gmail.com', 'customer2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_info`
--

CREATE TABLE `tbl_customer_info` (
  `customer_info_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `firstname` varchar(300) DEFAULT NULL,
  `lastname` varchar(300) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `age` int(100) DEFAULT NULL,
  `phone_num` bigint(20) DEFAULT NULL,
  `municipality` varchar(300) DEFAULT NULL,
  `province` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer_info`
--

INSERT INTO `tbl_customer_info` (`customer_info_id`, `customer_id`, `firstname`, `lastname`, `birthdate`, `gender`, `age`, `phone_num`, `municipality`, `province`) VALUES
(1, 1, 'clarq', 'arias', '2003-08-08', 'male', 20, 9123456789, 'Candaba', 'Pampanga'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_account`
--

CREATE TABLE `tbl_employee_account` (
  `employee_id` int(255) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `login_role_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_account`
--

INSERT INTO `tbl_employee_account` (`employee_id`, `username`, `password`, `login_role_id`) VALUES
(23, 'clarq@gmail.com', 'clarq', 1),
(24, 'juliana@gmail.com', 'juliana', 2),
(26, 'rhea@gmail.com', 'rhea', 2),
(27, 'admin@gmail.com', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_info`
--

CREATE TABLE `tbl_employee_info` (
  `employee_info_id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `relation_id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `bill_id` int(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(100) NOT NULL,
  `marital_status` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_num` bigint(20) NOT NULL,
  `province` varchar(200) NOT NULL,
  `municipality` varchar(200) NOT NULL,
  `elem` varchar(300) DEFAULT NULL,
  `jhs` varchar(300) DEFAULT NULL,
  `shs` varchar(300) DEFAULT NULL,
  `college` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee_info`
--

INSERT INTO `tbl_employee_info` (`employee_info_id`, `employee_id`, `relation_id`, `job_id`, `bill_id`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `age`, `marital_status`, `email`, `phone_num`, `province`, `municipality`, `elem`, `jhs`, `shs`, `college`) VALUES
(23, 23, 23, 23, 23, 'clarq anderson', 'pangan', 'arias', '2003-08-08', 'male', 20, 'single', 'clarq@gmail.com', 9123456789, 'Pampanga', 'Candaba', 'mandasig', 'hcc', 'hcc', 'hcc'),
(24, 24, 24, 24, 24, 'juliana', 'arla', 'paguinto', '2003-04-28', 'female', 21, 'single', 'juliana@gmail.com', 9876754321, 'Pampanga', 'Arayat', 'arayat1', 'arayat2', 'arayat3', 'hcc'),
(26, 26, 26, 26, 26, 'rhea joy', 'misa', 'pangkubit', '2002-10-20', 'female', 22, 'single', 'rhea@gmail.com', 33333333333, 'Pampanga', 'Arayat', 'arayat', 'arayat', 'hcc', 'hcc'),
(27, 27, 27, 27, 27, 'admin', 'admin', 'admin', '0101-01-01', 'other', 20, 'its_complicated', 'admin@gmail.com', 11111111111, 'Ilocos Norte', 'Adams', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job`
--

CREATE TABLE `tbl_job` (
  `job_id` int(255) NOT NULL,
  `job_title` varchar(300) NOT NULL,
  `employement_num` varchar(300) NOT NULL,
  `department` varchar(300) NOT NULL,
  `hire_date` date NOT NULL,
  `hire_status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job`
--

INSERT INTO `tbl_job` (`job_id`, `job_title`, `employement_num`, `department`, `hire_date`, `hire_status`) VALUES
(23, 'chief operating officer', '42069', 'hr', '2024-05-04', 'full-time employees'),
(24, 'manager', '32131333', 'hr', '2024-05-07', 'seasonal employees'),
(26, 'chief marketing officer', '3231', 'production', '2024-05-09', 'seasonal employees'),
(27, 'chief operating officer', '1111', 'hr', '2024-05-09', 'full-time employees');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_role`
--

CREATE TABLE `tbl_login_role` (
  `login_role_id` int(255) NOT NULL,
  `login_role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login_role`
--

INSERT INTO `tbl_login_role` (`login_role_id`, `login_role`) VALUES
(1, 'admin'),
(2, 'employee'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `payed` decimal(10,2) NOT NULL,
  `quantity_buy` int(200) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `is_received` tinyint(1) NOT NULL,
  `is_delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `product_id`, `payed`, `quantity_buy`, `total_cost`, `is_received`, `is_delivered`) VALUES
(10, 1, 6, 45.00, 1, 45.00, 0, 0),
(11, 1, 4, 400.00, 3, 330.00, 0, 1),
(12, 1, 6, 400.00, 2, 330.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(255) NOT NULL,
  `supplier_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `supplier_id`, `category_id`, `product_name`, `description`, `price`, `stock`, `expiry_date`, `image`) VALUES
(4, 2, 10, 'Corn Beef', 'masarap', 80.00, 20, '2026-10-20', 'template.png'),
(6, 2, 12, 'Coke', 'masarap', 45.00, 12, '2025-09-11', 'coke.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_relation`
--

CREATE TABLE `tbl_relation` (
  `relation_id` int(255) NOT NULL,
  `person_name` varchar(300) NOT NULL,
  `relationship` varchar(300) NOT NULL,
  `person_num` bigint(20) NOT NULL,
  `person_email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_relation`
--

INSERT INTO `tbl_relation` (`relation_id`, `person_name`, `relationship`, `person_num`, `person_email`) VALUES
(23, 'sun and moon', 'gg', 9123456788, 'sunandmoon@yahoo.com'),
(24, 'jdsjhjha', 'sdadad', 312312312313, 'jhsdaj@gmail.com'),
(26, 'dsaddas', 'sdasdsad', 22222222222, 'sdasda@gmail.com'),
(27, 'admin', 'admin', 22222222222, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(255) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_contact` bigint(20) NOT NULL,
  `supplier_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_address`) VALUES
(2, 'Cheenee', 69696969696, 'Mesulo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `ticket_id` int(255) NOT NULL,
  `employee_id` int(255) DEFAULT NULL,
  `customer_id` int(255) NOT NULL,
  `issue_date` date NOT NULL,
  `resolve_date` date DEFAULT NULL,
  `message` varchar(2000) NOT NULL,
  `is_resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`ticket_id`, `employee_id`, `customer_id`, `issue_date`, `resolve_date`, `message`, `is_resolved`) VALUES
(7, 27, 1, '2024-05-11', '2024-05-11', 'wala akong pera men', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_worktime_status`
--

CREATE TABLE `tbl_worktime_status` (
  `worktime_status_id` int(255) NOT NULL,
  `worktime_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_worktime_status`
--

INSERT INTO `tbl_worktime_status` (`worktime_status_id`, `worktime_status`) VALUES
(0, 'PENDING'),
(1, 'NORMAL'),
(2, 'OVERTIME'),
(3, 'UNDERTIME');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `fk_employee` (`employee_id`),
  ADD KEY `fk_attendance_status` (`attendance_status_id`),
  ADD KEY `fk_worktime_status` (`worktime_status_id`);

--
-- Indexes for table `tbl_attendance_status`
--
ALTER TABLE `tbl_attendance_status`
  ADD PRIMARY KEY (`attendance_status_id`);

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer_account`
--
ALTER TABLE `tbl_customer_account`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_login_role` (`login_role_id`);

--
-- Indexes for table `tbl_customer_info`
--
ALTER TABLE `tbl_customer_info`
  ADD PRIMARY KEY (`customer_info_id`),
  ADD KEY `fk_customer_account` (`customer_id`);

--
-- Indexes for table `tbl_employee_account`
--
ALTER TABLE `tbl_employee_account`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `login_role` (`login_role_id`);

--
-- Indexes for table `tbl_employee_info`
--
ALTER TABLE `tbl_employee_info`
  ADD PRIMARY KEY (`employee_info_id`),
  ADD KEY `fk_info` (`employee_id`),
  ADD KEY `fk_bill` (`bill_id`),
  ADD KEY `fk_job` (`job_id`),
  ADD KEY `fk_relation` (`relation_id`);

--
-- Indexes for table `tbl_job`
--
ALTER TABLE `tbl_job`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_login_role`
--
ALTER TABLE `tbl_login_role`
  ADD PRIMARY KEY (`login_role_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_customer` (`customer_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_supplier` (`supplier_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `tbl_relation`
--
ALTER TABLE `tbl_relation`
  ADD PRIMARY KEY (`relation_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_worktime_status`
--
ALTER TABLE `tbl_worktime_status`
  ADD PRIMARY KEY (`worktime_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_attendance_status`
--
ALTER TABLE `tbl_attendance_status`
  MODIFY `attendance_status_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_customer_account`
--
ALTER TABLE `tbl_customer_account`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_employee_account`
--
ALTER TABLE `tbl_employee_account`
  MODIFY `employee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_employee_info`
--
ALTER TABLE `tbl_employee_info`
  MODIFY `employee_info_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_login_role`
--
ALTER TABLE `tbl_login_role`
  MODIFY `login_role_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `ticket_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_worktime_status`
--
ALTER TABLE `tbl_worktime_status`
  MODIFY `worktime_status_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `fk_attendance_status` FOREIGN KEY (`attendance_status_id`) REFERENCES `tbl_attendance_status` (`attendance_status_id`),
  ADD CONSTRAINT `fk_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee_account` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_worktime_status` FOREIGN KEY (`worktime_status_id`) REFERENCES `tbl_worktime_status` (`worktime_status_id`);

--
-- Constraints for table `tbl_customer_account`
--
ALTER TABLE `tbl_customer_account`
  ADD CONSTRAINT `fk_login_role` FOREIGN KEY (`login_role_id`) REFERENCES `tbl_login_role` (`login_role_id`);

--
-- Constraints for table `tbl_customer_info`
--
ALTER TABLE `tbl_customer_info`
  ADD CONSTRAINT `fk_customer_account` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer_account` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_employee_account`
--
ALTER TABLE `tbl_employee_account`
  ADD CONSTRAINT `login_role` FOREIGN KEY (`login_role_id`) REFERENCES `tbl_login_role` (`login_role_id`);

--
-- Constraints for table `tbl_employee_info`
--
ALTER TABLE `tbl_employee_info`
  ADD CONSTRAINT `fk_bill` FOREIGN KEY (`bill_id`) REFERENCES `tbl_bill` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_info` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee_account` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_job` FOREIGN KEY (`job_id`) REFERENCES `tbl_job` (`job_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_relation` FOREIGN KEY (`relation_id`) REFERENCES `tbl_relation` (`relation_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer_account` (`customer_id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`),
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`);

--
-- Constraints for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD CONSTRAINT `tbl_ticket_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer_account` (`customer_id`),
  ADD CONSTRAINT `tbl_ticket_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee_account` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

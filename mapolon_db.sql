-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 07:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapolon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `id` int(255) NOT NULL,
  `appointment_date` varchar(255) NOT NULL,
  `timeslot` varchar(6) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_mobile_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`id`, `appointment_date`, `timeslot`, `patient_name`, `patient_mobile_number`, `status`, `user_id`, `patient_id`) VALUES
(11, '1996-03-03', '12:59', 'Sample Nickname2', '09298129283', 'Appointment Approved', 5, 166),
(12, '1999-06-04', '23:58', 'Sample Nickname', '09298129283', 'Appointment Approved', 5, 168);

-- --------------------------------------------------------

--
-- Table structure for table `patient_bill_table`
--

CREATE TABLE `patient_bill_table` (
  `id` int(11) NOT NULL,
  `bill_date` varchar(255) NOT NULL,
  `bill_type` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `amount_charge` varchar(255) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_prescription_table`
--

CREATE TABLE `patient_prescription_table` (
  `id` int(11) NOT NULL,
  `prescription_date` date NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_prescription_table`
--

INSERT INTO `patient_prescription_table` (`id`, `prescription_date`, `medicine`, `description`, `patient_id`) VALUES
(7, '2020-10-21', 'sample medicine', 'sample description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`id`, `username`, `password`, `birthday`, `age`, `mobile_number`, `full_address`, `gender`, `nickname`, `occupation`) VALUES
(166, 'patient', 'c09e1656fcee73056c555c9531ae7a55', '1998-12-30', '31', '09123456789', 'Manila', 'Male', 'Sample Nickname2', 'None'),
(168, 'patient2', '11e139e475416ef55023c0bb67e185e3', '1994-12-25', '29', '09282881234', 'Cabuyao City', 'Male', 'Sample Nickname1', 'None'),
(169, 'test', '05a671c66aefea124cc08b76ea6d30bb', '1996-06-23', '24', '09123456789', 'Manila City', 'Male', 'Test', 'Test Occupation');

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment_table`
--

CREATE TABLE `patient_treatment_table` (
  `id` int(11) NOT NULL,
  `treatment_date` varchar(255) NOT NULL,
  `tooth_number` varchar(255) NOT NULL,
  `findings` varchar(255) NOT NULL,
  `procedures` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `full_name`, `user_role`, `username`, `password`, `birthday`, `age`, `mobile_number`, `full_address`, `created_at`) VALUES
(4, 'Test', 'admin', 'test', '05a671c66aefea124cc08b76ea6d30bb', '1993-11-01', '26', '09282881232', 'test', '2020-11-06 10:15:06'),
(5, 'Dra. Mapolon', 'dentist', 'sample', '6ad492ae3f3437963b8df4ab045165f1', '1996-01-30', '21', '09282881234', 'sample', '2020-11-06 13:04:16'),
(6, 'Qweqweqwe', 'admin', 'testqwejl', '7e3364c7b757dafef4b0276d74a6fe70', '1997-01-31', '32', '+639287285612', 'hajahdasdahsdhasd', '2020-11-07 17:23:44'),
(7, 'Sampletest', 'admin', 'sampletest', '61c8f412bb3fb2a7d649965ecec27f8a', '1995-12-01', '25', '09282881234', 'sampletest', '2020-11-08 04:09:48'),
(8, 'Dr. Sample', 'admin', 'sample123', '4e91b1cbe42b5c884de47d4c7fda0555', '1995-01-01', '23', '09123456789', 'Manila ', '2020-11-23 00:54:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_appointment_fk` (`patient_id`),
  ADD KEY `user_patient_appointment_fk` (`user_id`);

--
-- Indexes for table `patient_bill_table`
--
ALTER TABLE `patient_bill_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_bill_fk` (`patient_id`);

--
-- Indexes for table `patient_prescription_table`
--
ALTER TABLE `patient_prescription_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_fk` (`patient_id`);

--
-- Indexes for table `patient_table`
--
ALTER TABLE `patient_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_treatment_table`
--
ALTER TABLE `patient_treatment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_treatment_fk` (`patient_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_bill_table`
--
ALTER TABLE `patient_bill_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_prescription_table`
--
ALTER TABLE `patient_prescription_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient_table`
--
ALTER TABLE `patient_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `patient_treatment_table`
--
ALTER TABLE `patient_treatment_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD CONSTRAINT `patient_appointment_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_patient_appointment_fk` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_bill_table`
--
ALTER TABLE `patient_bill_table`
  ADD CONSTRAINT `patient_bill_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_treatment_table`
--
ALTER TABLE `patient_treatment_table`
  ADD CONSTRAINT `patient_treatment_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

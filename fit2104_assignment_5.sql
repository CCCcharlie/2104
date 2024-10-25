-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 12:17 AM
-- Server version: 9.0.1
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit2104_assignment_5`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `message` text,
  `organisation_id` int DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `contractor_email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`id`, `first_name`, `last_name`, `phone_number`, `contractor_email`, `created`, `modified`) VALUES
(1, 'John', 'Doe', '0412345678', 'john.doe@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(2, 'Jane', 'Smith', '0412678901', 'jane.smith@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(3, 'Michael', 'Brown', '0412234567', 'michael.brown@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(4, 'Emily', 'Davis', '0412987654', 'emily.davis@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(5, 'Sarah', 'Wilson', '0412345987', 'sarah.wilson@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(6, 'David', 'Johnson', '0412567890', 'david.johnson@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(7, 'Laura', 'Martinez', '0412678234', 'laura.martinez@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(8, 'Robert', 'Lee', '0412789345', 'robert.lee@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(9, 'Michelle', 'Harris', '0412890456', 'michelle.harris@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(10, 'William', 'Clark', '0412901567', 'william.clark@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(11, 'Jessica', 'Lewis', '0412123456', 'jessica.lewis@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(12, 'Brian', 'Walker', '0412234678', 'brian.walker@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(13, 'Olivia', 'Hall', '0412345789', 'olivia.hall@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(14, 'James', 'Allen', '0412456890', 'james.allen@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(15, 'Isabella', 'Young', '0412567901', 'isabella.young@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(16, 'Daniel', 'Wright', '0412678012', 'daniel.wright@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(17, 'Ava', 'Scott', '0412789123', 'ava.scott@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(18, 'Matthew', 'Adams', '0412890234', 'matthew.adams@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(19, 'Sophie', 'Nelson', '0412901345', 'sophie.nelson@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(20, 'Andrew', 'Carter', '0412123567', 'andrew.carter@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(21, 'Chloe', 'Mitchell', '0412234678', 'chloe.mitchell@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(22, 'Ethan', 'Roberts', '0412345789', 'ethan.roberts@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(23, 'Mia', 'Turner', '0412456890', 'mia.turner@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(24, 'Lucas', 'Phillips', '0412567901', 'lucas.phillips@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(25, 'Emma', 'Campbell', '0412678012', 'emma.campbell@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(26, 'Alexander', 'Parker', '0412789123', 'alexander.parker@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(27, 'Lily', 'Evans', '0412890234', 'lily.evans@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(28, 'Jacob', 'Edwards', '0412901345', 'jacob.edwards@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(29, 'Charlotte', 'Collins', '0412123456', 'charlotte.collins@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(30, 'Ryan', 'Stewart', '0412234567', 'ryan.stewart@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(31, 'Amelia', 'Morris', '0412345678', 'amelia.morris@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(32, 'Aiden', 'Rogers', '0412456789', 'aiden.rogers@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(33, 'Grace', 'Reed', '0412567890', 'grace.reed@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(34, 'Noah', 'Cook', '0412678901', 'noah.cook@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(35, 'Mia', 'Bell', '0412789012', 'mia.bell@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(36, 'Jack', 'Murphy', '0412890123', 'jack.murphy@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(37, 'Ella', 'Bailey', '0412901234', 'ella.bailey@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(38, 'Lucas', 'Rivera', '0412123345', 'lucas.rivera@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(39, 'Harper', 'Cooper', '0412234456', 'harper.cooper@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(40, 'Benjamin', 'Richardson', '0412345567', 'benjamin.richardson@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(41, 'Lily', 'Wood', '0412456678', 'lily.wood@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(42, 'Mason', 'Cox', '0412567789', 'mason.cox@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(43, 'Aria', 'Ward', '0412678890', 'aria.ward@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(44, 'James', 'Foster', '0412789901', 'james.foster@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(45, 'Zoe', 'James', '0412890012', 'zoe.james@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(46, 'Elijah', 'Bennett', '0412901123', 'elijah.bennett@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(47, 'Scarlett', 'Gray', '0412123234', 'scarlett.gray@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(48, 'Matthew', 'Simmons', '0412234345', 'matthew.simmons@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(49, 'Evelyn', 'Hayes', '0412345456', 'evelyn.hayes@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41'),
(50, 'Jack', 'Brooks', '0412456567', 'jack.brooks@example.com', '2024-10-13 15:38:41', '2024-10-13 15:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `contractors_skills`
--

CREATE TABLE `contractors_skills` (
  `id` int NOT NULL,
  `contractor_id` int DEFAULT NULL,
  `skill_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int NOT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `contact_first_name` varchar(255) DEFAULT NULL,
  `contact_last_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `current_website` varchar(255) DEFAULT NULL,
  `industry` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `project_id` int DEFAULT NULL,
  FOREIGN KEY (`project_id`) REFERENCES `projects`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `business_name`, `contact_first_name`, `contact_last_name`, `contact_email`, `current_website`, `industry`, `created`, `modified`) VALUES
(1, 'Tech Innovators', 'John', 'Smith', 'john.smith@techinnovators.com', 'http://techinnovators.com', 'Technology', '2024-01-10 09:30:00', '2024-01-11 10:00:00'),
(2, 'Green Solutions', 'Emily', 'Johnson', 'emily.johnson@greensolutions.com', 'http://greensolutions.com', 'Environmental', '2024-02-15 11:15:00', '2024-02-15 13:30:00'),
(3, 'Future Enterprises', 'Michael', 'Brown', 'michael.brown@futureenterprises.com', 'http://futureenterprises.com', 'Consulting', '2024-03-20 14:45:00', '2024-03-21 16:00:00'),
(4, 'Healthcare Plus', 'David', 'Wilson', 'david.wilson@healthcareplus.com', 'http://healthcareplus.com', 'Healthcare', '2024-04-12 08:00:00', '2024-04-12 09:30:00'),
(5, 'Urban Creatives', 'Sarah', 'Davis', 'sarah.davis@urbancreatives.com', 'http://urbancreatives.com', 'Design', '2024-05-05 12:00:00', '2024-05-05 14:00:00'),
(6, 'AgriTech Solutions', 'James', 'White', 'james.white@agritechsolutions.com', 'http://agritechsolutions.com', 'Agriculture', '2024-06-22 10:45:00', '2024-06-22 11:30:00'),
(7, 'FinTech Global', 'Laura', 'Taylor', 'laura.taylor@fintechglobal.com', 'http://fintechglobal.com', 'Finance', '2024-07-18 13:30:00', '2024-07-18 15:00:00'),
(8, 'Blue Ocean Logistics', 'Robert', 'Lee', 'robert.lee@blueoceanlogistics.com', 'http://blueoceanlogistics.com', 'Logistics', '2024-08-03 09:00:00', '2024-08-03 10:00:00'),
(9, 'SolarFuture', 'Eva', 'Martinez', 'eva.martinez@solarfuture.com', 'http://solarfuture.com', 'Renewable Energy', '2024-09-10 08:30:00', '2024-09-10 09:30:00'),
(10, 'Innovative Marketing', 'Daniel', 'Clark', 'daniel.clark@innovativemarketing.com', 'http://innovativemarketing.com', 'Marketing', '2024-10-05 12:45:00', '2024-10-05 14:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `description` text,
  `management_tool_link` varchar(255) DEFAULT NULL,
  `project_due_date` datetime DEFAULT NULL,
  `last_checked` datetime DEFAULT NULL,
  `complete` tinyint(1) DEFAULT NULL,
  `contractor_id` int DEFAULT NULL,
  `organisation_id` int DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `description`, `management_tool_link`, `project_due_date`, `last_checked`, `complete`, `contractor_id`, `organisation_id`, `created`, `modified`) VALUES
(1, 'Website Redesign', 'Complete redesign of the company website, including a new user interface and enhanced mobile compatibility.', 'http://trello.com/project1', '2024-12-01 00:00:00', '2024-09-25 10:30:00', 0, 1, 1, '2024-08-01 12:00:00', '2024-09-01 10:00:00'),
(2, 'Mobile App Development', 'Develop a mobile app for online booking services.', 'http://jira.com/project2', '2025-02-15 00:00:00', '2024-09-20 14:00:00', 0, 2, 2, '2024-07-10 12:00:00', '2024-09-15 11:00:00'),
(3, 'Social Media Marketing Campaign', 'Plan and execute a social media marketing strategy for the launch of a new product.', 'http://asana.com/project3', '2024-11-05 00:00:00', '2024-09-18 09:30:00', 1, 3, 3, '2024-06-20 14:00:00', '2024-08-25 08:00:00'),
(4, 'Cybersecurity Audit', 'Conduct a full audit of the organization’s IT infrastructure for vulnerabilities.', 'http://monday.com/project4', '2024-10-30 00:00:00', '2024-09-22 16:45:00', 0, 4, 1, '2024-07-15 09:00:00', '2024-09-10 10:00:00'),
(5, 'E-commerce Platform Migration', 'Migrate the existing e-commerce platform to a new cloud-based solution.', 'http://basecamp.com/project5', '2025-01-20 00:00:00', '2024-09-25 11:15:00', 0, 5, 2, '2024-08-05 10:30:00', '2024-09-20 15:30:00'),
(6, 'Brand Identity Development', 'Develop a new brand identity including logo, colors, and typography.', 'http://trello.com/project6', '2024-11-15 00:00:00', '2024-09-25 13:30:00', 1, 6, 3, '2024-06-25 14:00:00', '2024-09-01 12:30:00'),
(7, 'Data Center Upgrade', 'Upgrade the organization’s data center to support new server architecture.', 'http://jira.com/project7', '2024-12-20 00:00:00', '2024-09-18 17:00:00', 0, 4, 7, '2024-07-05 15:00:00', '2024-09-10 12:45:00'),
(8, 'SEO Optimization', 'Optimize the company’s website for better search engine ranking.', 'http://asana.com/project8', '2024-10-10 00:00:00', '2024-09-16 10:30:00', 1, 1, 5, '2024-05-15 10:00:00', '2024-09-05 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int NOT NULL,
  `skill_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
INSERT INTO `skills` (`id`, `skill_name`) VALUES
(1, 'Java'),
(2, 'Python'),
(3, 'Project Management'),
(4, 'Data Analysis'),
(5, 'Web Development'),
(6, 'Database Administration'),
(7, 'Machine Learning'),
(8, 'Cybersecurity'),
(9, 'Cloud Computing'),
(10, 'Digital Marketing');


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE projects_skills (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `project_id` INT NOT NULL,
    `skill_id` INT NOT NULL,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (skill_id) REFERENCES skills(id) ON DELETE CASCADE
);

CREATE TABLE contractors_skills (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `contractor_id` INT NOT NULL,
    `skill_id` INT NOT NULL,
    FOREIGN KEY (contractor_id) REFERENCES contractors(id),
    FOREIGN KEY (skill_id) REFERENCES skills(id)
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractors_skills`
--
ALTER TABLE `contractors_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contractor_id` (`contractor_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skill_name` (`skill_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contractors_skills`
--
ALTER TABLE `contractors_skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contractors_skills`
--
ALTER TABLE `contractors_skills`
  ADD CONSTRAINT `contractors_skills_ibfk_1` FOREIGN KEY (`contractor_id`) REFERENCES `contractors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contractors_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`contractor_id`) REFERENCES `contractors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

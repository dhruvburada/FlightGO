-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2024 at 03:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FlightGO`
--

-- --------------------------------------------------------

--
-- Table structure for table `AboutUS`
--

CREATE TABLE `AboutUS` (
  `title` varchar(255) NOT NULL,
  `para1` varchar(1000) NOT NULL,
  `para2` varchar(1000) NOT NULL,
  `feat_1` varchar(255) NOT NULL,
  `feat_1_desc` varchar(1000) NOT NULL,
  `feat_2` varchar(255) NOT NULL,
  `feat_2_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AboutUS`
--

INSERT INTO `AboutUS` (`title`, `para1`, `para2`, `feat_1`, `feat_1_desc`, `feat_2`, `feat_2_desc`) VALUES
('Who Are We?', 'Fly with ease and confidence with our premier flight booking platform. We\'re dedicated to offering unbeatable deals on flight tickets, ensuring your journey is both seamless and affordable.', 'As a rapidly expanding service, we remain steadfast in our commitment to core principles. We prioritize collaboration, innovation, and above all, customer satisfaction. Continuously striving to enhance our offerings, we\'re dedicated to providing you with the best possible experience for all your travel needs.', 'Adaptable Travel Solutions', 'We\'re engineering a digital approach that seamlessly extends to every aspect of your flight booking experience.', 'Flight Booking Platform', 'We embrace innovation by blending simplicity with sophisticated solutions.');

-- --------------------------------------------------------

--
-- Table structure for table `AdditionalTraveler`
--

CREATE TABLE `AdditionalTraveler` (
  `AdditionalTravelerID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL CHECK (`Age` > 0),
  `Nationality` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AdditionalTraveler`
--

INSERT INTO `AdditionalTraveler` (`AdditionalTravelerID`, `CustomerID`, `FirstName`, `LastName`, `Age`, `Nationality`) VALUES
(1, 1, 'Aarav', 'Joshi', 28, 'India'),
(2, 3, 'Riya', 'Verma', 32, 'India'),
(3, 4, 'Rahul', 'Yadav', 30, 'India'),
(4, 5, 'Priya', 'Sharma', 26, 'India'),
(5, 2, 'Aryan', 'Gupta', 22, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`AdminID`, `Username`, `Password`) VALUES
(1, 'dhruvburada', 'Dhruv@8488'),
(2, 'paullawrence', 'Paul@111'),
(3, 'archilgajera', 'Archil@222');

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int(11) NOT NULL,
  `airline` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `airline`, `seats`) VALUES
(1, 'Air India', 150),
(2, 'AirAsia', 150),
(3, 'Avelo', 200),
(4, 'GoAir', 200),
(5, 'Indigo', 220),
(6, 'SpiceJet', 180),
(7, 'Vistara', 180);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `City` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`City`) VALUES
('Mumbai'),
('Jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `ContactUS`
--

CREATE TABLE `ContactUS` (
  `Full Name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone Number` varchar(20) NOT NULL,
  `Message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Nationality` varchar(50) NOT NULL,
  `Age` int(11) NOT NULL CHECK (`Age` > 0),
  `Country` varchar(50) NOT NULL,
  `State` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `PROFILE_PIC` varchar(50) DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`UserID`, `FirstName`, `LastName`, `Nationality`, `Age`, `Country`, `State`, `City`, `PostalCode`, `Email`, `Phone`, `PROFILE_PIC`) VALUES
(1, 'Dhruv', 'Burada', 'Indian', 20, 'India', 'Gujarat', 'Rajkot', '360311', 'demo5@mail.com', '8488997323', 'profile_pic_6613ee731f23a.png'),
(2, 'Dhruv', 'Burada', 'Indian', 20, 'India', 'Gujarat', 'Rajkot', '360311', 'tstark@yopmail.com', '8488997323', 'profile.png'),
(3, 'Paul', 'Lawrence', 'India', 35, 'India', 'Delhi', 'Delhi', '110001', 'paul@rku.ac.in', '9876543212', 'profile.png'),
(4, 'Mayur', 'Rogheliya', 'India', 28, 'India', 'Uttar Pradesh', 'Lucknow', '226001', 'mayur@rku.ac.in', '9876543213', 'profile.png'),
(5, 'Brijesh', 'Sakhiya', 'India', 27, 'India', 'Telangana', 'Hyderabad', '500001', 'brijesh@rku.ac.in', '9876543214', 'profile.png'),
(16, 'mayur', 'rogheliya', 'Indian', 20, 'India', 'Gujarat', 'Rajkot', '360311', 'mrogheliya585@rku.ac.in', '8488997323', 'profile_pic_6628a20164f6f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `DiscountCoupon`
--

CREATE TABLE `DiscountCoupon` (
  `CouponID` int(11) NOT NULL,
  `CouponCode` varchar(20) NOT NULL,
  `DiscountAmount` decimal(5,2) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `UsageLimit` int(11) NOT NULL DEFAULT 1,
  `PointsRequired` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DiscountCoupon`
--

INSERT INTO `DiscountCoupon` (`CouponID`, `CouponCode`, `DiscountAmount`, `ExpiryDate`, `UsageLimit`, `PointsRequired`) VALUES
(1, 'SAVE10', 10.00, '2024-12-31', 72, 10),
(2, 'FLY50', 50.00, '2024-06-30', 13, 50),
(3, 'HOLIDAY25', 25.00, '2024-08-31', 73, 25),
(4, 'SPECIAL20', 20.00, '2024-10-31', 200, 20),
(5, 'TRAVEL15', 15.00, '2024-09-30', 150, 15);

-- --------------------------------------------------------

--
-- Table structure for table `Flight`
--

CREATE TABLE `Flight` (
  `FlightID` int(11) NOT NULL,
  `Flight Name` varchar(255) NOT NULL,
  `Source` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `DepartureDate` date NOT NULL,
  `DepartureTime` time NOT NULL,
  `FlightCostPerPerson` decimal(10,2) NOT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Issue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Flight`
--

INSERT INTO `Flight` (`FlightID`, `Flight Name`, `Source`, `Destination`, `DepartureDate`, `DepartureTime`, `FlightCostPerPerson`, `Status`, `Issue`) VALUES
(1, 'Indigo', 'Mumbai', 'Delhi', '2024-03-15', '08:00:00', 3000.00, NULL, NULL),
(2, 'Indigo', 'Bangalore', 'Kolkata', '2024-03-16', '10:30:00', 2500.00, NULL, NULL),
(3, 'Indigo', 'Chennai', 'Hyderabad', '2024-03-17', '12:45:00', 2000.00, NULL, NULL),
(4, 'Indigo', 'Jaipur', 'Ahmedabad', '2024-03-18', '14:20:00', 1800.00, NULL, NULL),
(5, 'Indigo', 'Lucknow', 'Patna', '2024-03-19', '16:00:00', 2200.00, NULL, NULL),
(6, 'Avelo', 'Mumbai', 'Delhi', '2024-04-25', '08:00:00', 3000.00, NULL, NULL),
(7, 'SpiceJet', 'Mumbai', 'Delhi', '2024-04-26', '09:30:00', 3200.00, NULL, NULL),
(8, 'Air India', 'Mumbai', 'Delhi', '2024-04-27', '11:45:00', 3500.00, NULL, NULL),
(9, 'GoAir', 'Mumbai', 'Delhi', '2024-04-28', '13:20:00', 3100.00, NULL, NULL),
(10, 'Vistara', 'Mumbai', 'Delhi', '2024-04-29', '15:00:00', 3400.00, NULL, NULL),
(11, 'Avelo', 'Bangalore', 'Kolkata', '2024-04-25', '08:30:00', 3500.00, NULL, NULL),
(12, 'SpiceJet', 'Bangalore', 'Kolkata', '2024-04-26', '10:00:00', 3300.00, NULL, NULL),
(13, 'Air India', 'Bangalore', 'Kolkata', '2024-04-27', '11:15:00', 3700.00, NULL, NULL),
(14, 'GoAir', 'Bangalore', 'Kolkata', '2024-04-28', '12:45:00', 3200.00, NULL, NULL),
(15, 'Vistara', 'Bangalore', 'Kolkata', '2024-04-29', '14:30:00', 3400.00, NULL, NULL),
(16, 'SpiceJet', 'Jaipur', 'Ahmedabad', '2024-04-25', '09:00:00', 3200.00, NULL, NULL),
(17, 'Avelo', 'Jaipur', 'Ahmedabad', '2024-04-26', '10:30:00', 3500.00, NULL, NULL),
(18, 'AirAsia', 'Jaipur', 'Ahmedabad', '2024-04-27', '12:00:00', 3100.00, NULL, NULL),
(19, 'GoAir', 'Jaipur', 'Ahmedabad', '2024-04-28', '13:45:00', 3300.00, NULL, NULL),
(20, 'Vistara', 'Jaipur', 'Ahmedabad', '2024-04-29', '15:15:00', 3400.00, NULL, NULL),
(21, 'Air India', 'Jaipur', 'Lucknow', '2024-04-25', '09:30:00', 3800.00, NULL, NULL),
(22, 'Avelo', 'Jaipur', 'Lucknow', '2024-04-26', '11:00:00', 3600.00, NULL, NULL),
(23, 'SpiceJet', 'Jaipur', 'Lucknow', '2024-04-27', '12:15:00', 3400.00, NULL, NULL),
(24, 'Vistara', 'Jaipur', 'Lucknow', '2024-04-28', '14:00:00', 3700.00, NULL, NULL),
(25, 'GoAir', 'Jaipur', 'Lucknow', '2024-04-29', '15:30:00', 3500.00, NULL, NULL),
(26, 'GoAir', 'Jaipur', 'Patna', '2024-04-25', '10:00:00', 4000.00, NULL, NULL),
(27, 'Avelo', 'Jaipur', 'Patna', '2024-04-26', '11:30:00', 3900.00, NULL, NULL),
(28, 'SpiceJet', 'Jaipur', 'Patna', '2024-04-27', '13:00:00', 3800.00, NULL, NULL),
(29, 'Air India', 'Jaipur', 'Patna', '2024-04-28', '14:45:00', 4200.00, NULL, NULL),
(30, 'Vistara', 'Jaipur', 'Patna', '2024-04-29', '16:15:00', 4100.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Order`
--

CREATE TABLE `Order` (
  `OrderID` int(11) NOT NULL,
  `OrderAmount` decimal(10,2) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FlightID` int(11) DEFAULT NULL,
  `PaymentScreenshotFile` varchar(255) DEFAULT NULL,
  `PaymentStatus` enum('Pending','Paid','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Order`
--

INSERT INTO `Order` (`OrderID`, `OrderAmount`, `UserID`, `FlightID`, `PaymentScreenshotFile`, `PaymentStatus`) VALUES
(1, 9000.00, 1, 1, 'payment1.png', 'Paid'),
(2, 7500.00, 2, 2, 'payment2.png', 'Paid'),
(3, 6000.00, 3, 3, 'payment3.png', 'Pending'),
(4, 7200.00, 4, 4, 'payment4.png', 'Paid'),
(5, 11000.00, 5, 5, 'payment5.png', 'Cancelled'),
(17, 6040.00, 16, 24, 'RazorPay', 'Paid'),
(18, 6000.00, 16, 23, 'RazorPay', 'Paid'),
(19, 6000.00, 16, 8, 'RazorPay', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `RewardPoint`
--

CREATE TABLE `RewardPoint` (
  `RewardID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PointsEarned` int(11) NOT NULL DEFAULT 0,
  `PointsRedeemed` int(11) NOT NULL DEFAULT 0,
  `PointsBalance` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RewardPoint`
--

INSERT INTO `RewardPoint` (`RewardID`, `UserID`, `PointsEarned`, `PointsRedeemed`, `PointsBalance`) VALUES
(1, 1, 100, 50, 50),
(3, 3, 200, 100, 100),
(4, 4, 300, 200, 100),
(5, 5, 250, 50, 200),
(6, 2, 100, 50, 50),
(7, 16, 150, 100, 50);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brief` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `info_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `name`, `brief`, `description`, `image_url`, `info_url`) VALUES
(1, 'London', 'London is the capital city of England and the United Kingdom, situated on the River Thames in southeastern England.', 'London, the capital city of England, is a vibrant and diverse metropolis known for its rich history, iconic landmarks, and world-class attractions. One of the must-visit attractions is the historic Tower of London, a UNESCO World Heritage Site, where you can explore the Crown Jewels and learn about the city\'s medieval history. Another iconic landmark is Buckingham Palace, the official residence of the Queen, where you can witness the Changing of the Guard ceremony. For art enthusiasts, the British Museum, home to a vast collection of art and artifacts from around the world, is a must-visit. To experience the city\'s bustling atmosphere, take a stroll along the Thames River or visit Covent Garden, known for its street performers, shops, and restaurants. To explore these attractions, you should budget around INR 5,000 to INR 10,000 per person per day, depending on your preferences and the type of experiences you wish to have.', 'img/slider/1.jpg', 'London.php'),
(2, 'Mumbai', 'Mumbai is a bustling city on India\'s west coast, renowned for its vibrant culture, thriving economy, and bustling streets.', 'Mumbai, the financial capital of India, is a bustling metropolis known for its vibrant culture, historic landmarks, and bustling street life. One of the most popular attractions is the Gateway of India, an iconic monument overlooking the Arabian Sea, built during the British Raj. Marine Drive, also known as the Queen\'s Necklace, is another must-visit destination, offering stunning views of the city skyline. For a taste of Bollywood, visit Film City, where you can take a tour of the studios and witness the behind-the-scenes action of Indian cinema. To experience the city\'s rich heritage, explore Chhatrapati Shivaji Maharaj Vastu Sangrahalaya (formerly known as Prince of Wales Museum) and Elephanta Caves, both UNESCO World Heritage Sites. To explore these attractions, you should budget around INR 2,000 to INR 5,000 per person per day, depending on your preferences and the type of experiences you wish to have.', 'img/slider/2.jpg', 'Mumbai.php'),
(3, 'New York', 'New York City is a vibrant metropolis in the northeastern United States, renowned for its iconic skyline, diverse culture, and bustling streets.', 'New York City, often referred to as the \"Big Apple,\" is a city that never sleeps and offers a plethora of attractions for every type of traveler. One of the most iconic landmarks is the Statue of Liberty, a symbol of freedom and democracy, located on Liberty Island. Another must-visit destination is Times Square, known for its dazzling lights, Broadway shows, and vibrant atmosphere. Central Park, an oasis in the heart of the city, offers scenic landscapes, walking trails, and recreational activities. The Metropolitan Museum of Art, commonly known as the Met, is one of the world\'s largest and most prestigious art museums, housing an extensive collection of artworks from around the globe. For a bird\'s eye view of the city, head to the top of the Empire State Building or the One World Observatory. To explore these attractions, you should budget around INR 8,000 to INR 15,000 per person per day, depending on your accommodation, dining, and entertainment choices.', 'img/slider/3.jpg', 'NewYork.php'),
(4, 'Paris', 'Paris is the capital city of France, known for its romantic ambiance, iconic landmarks such as the Eiffel Tower, and rich history in art and culture.', 'Paris, often called the \"City of Love,\" is renowned for its romantic ambiance, stunning architecture, and world-class art and culture. The Eiffel Tower, an iconic symbol of France, offers breathtaking views of the cityscape. The Louvre Museum is home to thousands of works of art, including the Mona Lisa and the Venus de Milo. Notre-Dame Cathedral, with its magnificent Gothic architecture, is another must-visit landmark. Stroll along the Seine River, explore the charming streets of Montmartre, and indulge in delicious French cuisine at local bistros and cafes. To experience the best of Paris, budget around INR 7,000 to INR 12,000 per person per day, covering accommodation, meals, transportation, and sightseeing.', 'img/slider/4.jpg', 'Paris.php'),
(5, 'Tokyo', 'Tokyo, the bustling capital of Japan, is a vibrant metropolis known for its futuristic skyscrapers, traditional temples, and vibrant pop culture scene.', 'Tokyo, the bustling capital of Japan, seamlessly combines modernity and tradition. The city offers a fascinating mix of futuristic skyscrapers, ancient temples, and vibrant street life. Visit the historic Senso-ji Temple, explore the bustling neighborhoods of Shibuya and Shinjuku, and experience the serenity of the Meiji Shrine. Don\'t miss the iconic Tokyo Tower, which offers panoramic views of the city. Enjoy authentic Japanese cuisine, including sushi, ramen, and tempura, at local restaurants and izakayas. For a memorable experience, budget around INR 8,000 to INR 15,000 per person per day, covering accommodation, meals, transportation, and entertainment.', 'img/slider/5.jpg', 'Tokyo.php'),
(6, 'Sydney', 'Sydney, located on Australia\'s east coast, is famous for its stunning harbor, iconic Opera House, beautiful beaches, and vibrant cosmopolitan lifestyle.', 'Sydney, the capital of New South Wales, Australia, is famous for its stunning harbor, iconic landmarks, and beautiful beaches. The Sydney Opera House, with its distinctive sail-like design, is a UNESCO World Heritage site and a must-visit attraction. Take a stroll across the Sydney Harbour Bridge for panoramic views of the city and harbor. Bondi Beach and Manly Beach are perfect for swimming, surfing, and sunbathing. Explore the historic Rocks district, enjoy a ferry ride to Taronga Zoo, and indulge in fresh seafood at the Sydney Fish Market. To explore Sydney comfortably, budget around INR 6,000 to INR 10,000 per person per day, covering accommodation, meals, transportation, and activities.', 'img/slider/6.jpg', 'Sydney.php');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Time` datetime DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `OTP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `Email`, `Time`, `Token`, `OTP`) VALUES
(21, 'vjadav219@rku.ac.in', '2024-04-09 17:36:43', '2e987f53d1cbbd14ab2276830932b64481b4d372ab12c7b0361fdb5c6ca5cf03907dcf0511f04991c88ec2442e70bce2e63dea1091a56f9dbbcfde79245d8b6c', 175672);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Email`, `Password`, `Token`, `IsActive`) VALUES
(1, 'demo1@mail.com', '12345678', NULL, 1),
(2, 'demo2@mail.com', 'Demo@2222', NULL, 1),
(3, 'demo3@mail.com', 'Demo@3333', NULL, 0),
(4, 'demo4@mail.com', 'Demo@4444', NULL, 0),
(5, 'demo5@mail.com', 'Demo@5555', NULL, 0),
(16, 'dburada367@rku.ac.in', 'Captain@99', '66289ae55269366289ae552698', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdditionalTraveler`
--
ALTER TABLE `AdditionalTraveler`
  ADD PRIMARY KEY (`AdditionalTravelerID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `DiscountCoupon`
--
ALTER TABLE `DiscountCoupon`
  ADD PRIMARY KEY (`CouponID`),
  ADD UNIQUE KEY `CouponCode` (`CouponCode`);

--
-- Indexes for table `Flight`
--
ALTER TABLE `Flight`
  ADD PRIMARY KEY (`FlightID`);

--
-- Indexes for table `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FlightID` (`FlightID`),
  ADD KEY `UserID` (`UserID`) USING BTREE;

--
-- Indexes for table `RewardPoint`
--
ALTER TABLE `RewardPoint`
  ADD PRIMARY KEY (`RewardID`),
  ADD KEY `CustomerID` (`UserID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdditionalTraveler`
--
ALTER TABLE `AdditionalTraveler`
  MODIFY `AdditionalTravelerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `DiscountCoupon`
--
ALTER TABLE `DiscountCoupon`
  MODIFY `CouponID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Flight`
--
ALTER TABLE `Flight`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Order`
--
ALTER TABLE `Order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `RewardPoint`
--
ALTER TABLE `RewardPoint`
  MODIFY `RewardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AdditionalTraveler`
--
ALTER TABLE `AdditionalTraveler`
  ADD CONSTRAINT `AdditionalTraveler_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customer` (`UserID`);

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Customer` (`UserID`),
  ADD CONSTRAINT `Order_ibfk_2` FOREIGN KEY (`FlightID`) REFERENCES `Flight` (`FlightID`);

--
-- Constraints for table `RewardPoint`
--
ALTER TABLE `RewardPoint`
  ADD CONSTRAINT `RewardPoint_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Customer` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

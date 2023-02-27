-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 09:21 PM
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
-- Database: `rijudb_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `toEmail` varchar(100) NOT NULL,
  `fromEmail` varchar(100) NOT NULL,
  `message_Datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `message`, `toEmail`, `fromEmail`, `message_Datetime`) VALUES
(2, 'fffffffffffffwwwwwwwwwwwwwwwww', 'ffff@gmail.com', 'xxx@gmail.com', '2022-10-28 21:06:07'),
(4, 'Project is almost finished', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:20:14'),
(5, 'Project is almost finished(2)', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:20:35'),
(7, 'Now its really close to finishing', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:22:51'),
(8, 'Now its really close to finishing\"`', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:23:09'),
(9, 'Now it\'s really close to finishing\"`', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:35:30'),
(10, 'it\'s', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:48:19'),
(11, 'it\'s \"\"working\"\"', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:49:01'),
(12, 'it\'s \"working\"', 'www@gmail.com', 'xxx@gmail.com', '2022-10-29 20:50:31'),
(14, 'grhytthgfgbf', 'www@gmail.com', 'ffff@gmail.com', '2022-10-29 20:56:27'),
(15, 'It\'s finally here!', 'www@gmail.com', 'ffff@gmail.com', '2022-10-29 20:59:30'),
(16, 'vvvvvvvvvvvvvvvvvvvvvvv', 'xxx@gmail.com', 'www@gmail.com', '2022-11-03 05:19:58'),
(17, 'qqqqqqqqqqqqqq', 'xxx@gmail.com', 'www@gmail.com', '2022-11-03 05:20:38'),
(18, 'wwwwwww', 'xxx@gmail.com', 'www@gmail.com', '2022-11-05 07:22:00'),
(19, 'xxxxxxxxxxx', 'xxx@gmail.com', 'www@gmail.com', '2022-11-05 07:22:17'),
(20, 'From F, To X', 'xxx@gmail.com', 'ffff@gmail.com', '2022-11-05 01:56:22'),
(21, 'Sending this to fff', 'ffff@gmail.com', 'xxx@gmail.com', '2022-11-05 02:26:47'),
(24, 'hi xxx. this is aaa. ', 'xxx@gmail.com', 'aaa@gmail.com', '2022-11-05 19:47:26'),
(25, 'hi xxx. fff has received your msg. ', 'xxx@gmail.com', 'ffff@gmail.com', '2022-11-05 19:58:14'),
(26, 'still buggy', 'aaa@gmail.com', 'xxx@gmail.com', '2022-11-05 21:12:41'),
(27, 'Not yet bug free. But code is mostly working as expected..', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:43:33'),
(28, 'Now Msg box will be cleared upon sending', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:49:24'),
(29, 'Now Msg box will be cleared upon sending(2)', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:52:35'),
(30, 'Now Msg box will be cleared upon sending(3)', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:54:19'),
(31, 'Now Msg box will be cleared upon sending(4)', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:55:56'),
(32, '4th ATTEMPT WORKED!!!', 'aaa@gmail.com', 'ffff@gmail.com', '2022-11-08 04:56:18'),
(33, 'Seems so', 'ffff@gmail.com', 'aaa@gmail.com', '2022-11-08 04:57:13'),
(34, 'This is wax', 'wax@gmail.com', 'wax@gmail.com', '2022-11-11 02:37:24'),
(35, 'Implemented', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 02:37:47'),
(36, 'wwwwwwwww', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 02:57:35'),
(37, 'aaaaaaaaa', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:00:52'),
(38, 'tttttttttt', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:10:19'),
(39, 'rrrrrrrrrrrr', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:15:13'),
(40, '😁', 'www@gmail.com', 'aaa@gmail.com', '2022-11-18 03:15:50'),
(41, '(^o^)/', 'www@gmail.com', 'aaa@gmail.com', '2022-11-18 03:17:33'),
(42, '~(≧▽≦)/~', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:19:00'),
(43, 'xxxxxxx', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:27:18'),
(44, 'yyyyy', 'www@gmail.com', 'aaa@gmail.com', '2022-11-18 03:28:02'),
(45, 'only user side not updating yet', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:29:04'),
(46, 'same', 'www@gmail.com', 'aaa@gmail.com', '2022-11-18 03:29:26'),
(47, 'how bout now?', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:39:14'),
(48, '>:)', 'aaa@gmail.com', 'www@gmail.com', '2022-11-18 03:40:10'),
(49, 'Waxxxx', 'wax@gmail.com', 'www@gmail.com', '2022-11-18 03:44:10'),
(50, 'wwwwwwww', 'www@gmail.com', 'wax@gmail.com', '2022-11-18 03:45:47'),
(51, 'It took 3+ months...', 'wax@gmail.com', 'www@gmail.com', '2022-11-18 03:47:09'),
(52, 'yeah but it\'s finally done..', 'www@gmail.com', 'wax@gmail.com', '2022-11-18 03:47:46'),
(53, 'aaaaaa', 'aaa@gmail.com', 'wax@gmail.com', '2022-11-19 04:10:09'),
(54, 'more error..', 'wax@gmail.com', 'aaa@gmail.com', '2022-11-19 04:53:24'),
(55, 'is it working now??', 'aaa@gmail.com', 'wax@gmail.com', '2022-11-19 04:59:11'),
(56, 'x', 'www@gmail.com', 'aaa@gmail.com', '2022-11-20 23:15:10'),
(57, 'Yz', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:15:57'),
(58, ':o', 'www@gmail.com', 'aaa@gmail.com', '2022-11-20 23:17:14'),
(59, '(✦o✦)', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:17:27'),
(60, 'ᕙ(⍢)ᕗ', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:17:43'),
(61, '(𓁹‿𓁹)', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:17:57'),
(62, '( ͡≖_ ͡≖)', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:18:09'),
(63, ' (づ^ω^)づ', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:18:18'),
(64, '(⌢⌣⌢)', 'aaa@gmail.com', 'www@gmail.com', '2022-11-20 23:18:28'),
(65, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'www@gmail.com', 'aaa@gmail.com', '2022-11-20 23:21:19'),
(66, 'It wasn\'t but it\'s now(almost)', 'ffff@gmail.com', 'www@gmail.com', '2022-11-20 23:23:47'),
(67, 'does it still work after closing the server?', 'www@gmail.com', 'ffff@gmail.com', '2022-11-20 23:28:44'),
(68, 'nope! :/', 'www@gmail.com', 'ffff@gmail.com', '2022-11-20 23:29:09'),
(69, 'Sending this from firefox', 'ffff@gmail.com', 'www@gmail.com', '2022-11-22 01:12:39'),
(70, 'Sending from brave', 'www@gmail.com', 'ffff@gmail.com', '2022-11-22 01:12:58'),
(71, 'ws also works in powershell', 'ffff@gmail.com', 'www@gmail.com', '2022-11-22 01:13:35'),
(72, 'fffffffffffffffffffffffffffffffaaaaaaaaafffffffffffffffffffffafassssssssweeeeeeee', 'ffff@gmail.com', 'nekketsu1992@gmail.com', '2022-11-22 01:38:37'),
(73, '.ps1 works', 'www@gmail.com', 'ffff@gmail.com', '2022-11-23 04:52:35'),
(74, 'rtfjhdrsghrtgewfges', 'aaa@gmail.com', 'ffff@gmail.com', '2022-12-03 02:07:57'),
(75, 'iiiiiiiiiiiiiiiiiiiiiiiii', 'ffff@gmail.com', 'aaa@gmail.com', '2022-12-03 02:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `picture` varchar(500) NOT NULL,
  `status` int(1) NOT NULL,
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`email`, `name`, `password`, `picture`, `status`, `logout_time`) VALUES
('aaa@gmail.com', 'aaa', 'aaa', 'images/Enslaved 2019-05-18 03-38-18.png', 0, '2022-12-04 06:41:29'),
('ccc@gmail.com', 'ccc', 'cccccC6.', 'images/images(5).jpg', 0, '2022-11-20 22:42:54'),
('ffff@gmail.com', 'ffff', 'ffff', 'images/Grand Theft Auto V 13-Mar-19 1_28_05 AM.png', 1, '2022-12-03 18:38:17'),
('nekketsu1992@gmail.com', 'Bio Rakun 1992', 'Nekketsu.1992', 'images/react5.jpeg', 1, '2022-12-04 20:03:13'),
('nekketsu333@gmail.com', 'Rage Wulf', 'Rage@123', 'images/img897_file.jpg', 0, '2022-12-04 07:03:50'),
('nesplayer01@gmail.com', 'v', 'TFAawdw456$@d', 'images/', 0, '2022-11-25 02:02:04'),
('rijumistri@gmail.com', 'RJ001', 'Qwerty123*', 'images/Szbw3jGM_400x400.jpg', 1, '2022-12-04 20:01:09'),
('rrr@gmail.com', 'rrr', 'rrr😬😠💀', 'images/christmas-tree-star-clipart-art-ioncom-icon-free-download-at-icons-icon-christmas-tree-star-clipart-free-download-at-icons-clip-art.jpg', 0, '2022-11-20 22:16:34'),
('uxplayer01@gmail.com', 'Negatron99', 'Negatron.99', 'images/be_fr-battery-b600beb-galaxy-s4-eb-b600bebecww-000043524-front1-black.jpeg', 0, '2022-12-03 19:31:14'),
('wax@gmail.com', 'wax', 'wax', 'images/Kingdoms of Amalur_ Reckoning 06-Nov-19 9_45_59 PM.png', 1, '2022-11-18 15:45:28'),
('www@gmail.com', 'www', 'www', 'images/Cemu 1.22.7 - FPS_ 23.27 [Vulkan] [NVIDIA GPU] [TitleId_ 00050000-101c9500] Breath of the Wild [EU v208] 15-Sep-21 4_38_27 AM.png', 0, '2022-11-22 01:19:19'),
('xxx@gmail.com', 'xxx', 'xxx', 'images/2019-08-31 20_19_17-Window.jpg', 0, '2022-11-08 04:32:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

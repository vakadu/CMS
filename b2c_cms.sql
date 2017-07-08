-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2017 at 11:29 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-12~ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b2c_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(12, 'Anime'),
(13, 'Manga'),
(15, 'Football'),
(18, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 14, 'hell', 'h@h.com', 'if i know', 'Approved', '2017-05-15'),
(2, 15, 'dfdf', 'test@g.com', 'dsfsdf', 'Unapproved', '2017-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(15, 13, 'vbvbbv', 'bvb', '2017-07-01', '377247.jpg', 'bvbv', 'bv', '0', 'draft', 1),
(16, 13, 'dcsdc', 'dcscds', '2017-07-03', '1488793976_tmp_img1.jpg', '<p>dscsdcsd</p>', 'dcsd', '0', 'draft', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT 'no image',
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(11, 'sanji', '$2y$10$w7RHv7IFETgjkwKm7nIh1uhXqLz2mUDzRM6P.P3o1xYpOKEM1aUaa', 'Vinsmoke', 'Sanji', 'sanji@s.com', 'no image', 'Subscriber', '$2y$10$iusesomecrazystrings22'),
(12, 'ace', '$2y$10$iusesomecrazystrings2uFHYqX907yezWmq7xwKHOMYEIPkpDd7G', 'Potugas.D.', 'Ace', 'ace@ace.com', 'no image', 'Admin', '$2y$10$iusesomecrazystrings22'),
(15, 'zoro', '$2y$10$4GcA61W2gY0xzt39r4fJIu.7LLGJAT1/EI3sptcB1qYX9xGi3oE0u', 'Roronora', 'Zoro', 'z@o.com', 'no image', 'Subscriber', '$2y$10$iusesomecrazystrings22'),
(16, 'naruto', '$2y$10$S2bjfL6vsOzkFFQt2dWeoe67LH2wW3e/4MYnEzis5alBb1KfxOmze', 'Uzumaki', 'Naruto', 'n@u.com', 'no image', 'Subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(8, '01hb3mvqrh84i17b0pksjln0c6', 1494348735),
(9, '4n59ghsisu0pipbul2oviiild2', 1494345721),
(10, 'tu6plnbnr93fuoc227ls6at5m2', 1494348654),
(11, 'msbh3bn5qki06gf2ica8qim8t7', 1494438764),
(12, 'u7c9r0jjkkug7pnsduj75dmtp3', 1494483856),
(13, '2dddgja3ei329n4uv5gj2lk097', 1494522710),
(14, 'g71u03gqd8h0oeclebpmndjo31', 1494526390),
(15, '5kp9ot81g2bavl60ltp9l219d4', 1494684284),
(16, 'uea2eb9hlq4g8j70q3qg5ci4k2', 1494745704),
(17, '85l2u47t5uedm6h1bsmjhbdnr7', 1494866522),
(18, 'up30bs936vjd3ene7dco5traq4', 1494870495),
(19, 'lprs8c3fq34vr8ah4t7qu77j60', 1494910866),
(20, 'n48mqr4ofi4m1l2sjo8e1mg065', 1495011640),
(21, '9ndrgpkpm59ij2pnvcu0a07v67', 1495206737),
(22, '334jqivr03nhn32s080e7un031', 1495291719),
(23, 'rfuna0na7stbcuugki2u0jvgv3', 1495375086),
(24, 'vnr6t8jsf5cln73ibm5bkdtav3', 1495439244),
(25, 'hd5qhgf1g7it7reridiiol81f2', 1495560327),
(26, '8afljuj2vhuh6qvtuu696o7c13', 1496054744),
(27, 'd1400o69o5ageut3l66bfcmmq2', 1496210901),
(28, 'ifsdr197ml7a6gu4gqa9d72ir1', 1498361872),
(29, 'kopq72ifjtg0i4mru3bk006hi0', 1498564026),
(30, '0g6c0ohbbpliboi9spva8q0ld6', 1498827804),
(31, '3lm2q95bkmrmn57bte2etei5d1', 1498929275),
(32, 'he5iam9ll31pnpjh3lglq6sod1', 1498976318),
(33, 'nrbfdlpopsttvb97mk2b9bg7l0', 1498998158),
(34, 'g7r3dqee9pok9743qbkm9kts41', 1499066655),
(35, '7p5s8rpfn4mhigbjmvmkih3ul1', 1499081317),
(36, 'if9rara4b5k9bu81ksg0460gv4', 1499100716),
(37, 'ct9tslvkaideoggu9kkh5oqac2', 1499172223),
(38, 'h4k6fsguf5dtu4er73bhsssen2', 1499237584),
(39, '71dirtkkvnocc7e29r1clvq1u7', 1499323281);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

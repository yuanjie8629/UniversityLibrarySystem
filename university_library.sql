-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 01, 2022 at 02:34 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` json NOT NULL,
  `pages` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('AVAILABLE','BORROWED','LOST') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `books_title_unique` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `categories`, `pages`, `image`, `status`) VALUES
(1, 'Fantastic Beasts and Where to Find Them: Cinematic Guide: Newt Scamander Do Not Feed Out', 'Felicity Baker', 'Unknown', '[\"Unknown\"]', 64, 'http://books.google.com/books/content?id=eq9XvgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(2, 'Harry Potter and the Cursed Child', 'J. K. Rowling', 'Sphere', '[\"Fiction\"]', 352, 'http://books.google.com/books/content?id=kLAoswEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(3, 'Harry Potter and the Sorcerer\'s Stone', 'J. K. Rowling', 'Scholastic', '[\"Juvenile Fiction\"]', 320, 'http://books.google.com/books/content?id=mvmGPgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'BORROWED'),
(4, 'The Psychology of Harry Potter', 'Neil Mulholland', 'BenBella Books', '[\"Literary Criticism\"]', 326, 'http://books.google.com/books/content?id=L18VBQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(5, 'The Ultimate Harry Potter and Philosophy', 'William Irwin', 'John Wiley & Sons', '[\"Philosophy\"]', 304, 'http://books.google.com/books/content?id=lJB5DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(6, 'Harry Potter and the Half-Blood Prince', 'J. K. Rowling', 'Unknown', '[\"England\"]', 672, 'http://books.google.com/books/content?id=L2EQuwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(7, 'Harry Potter Coloring Book', 'Inc. Scholastic', 'Scholastic Incorporated', '[\"Juvenile Fiction\"]', 96, 'http://books.google.com/books/content?id=lMM4jgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(8, 'Harry Potter: Exploring Hogwarts', 'Jody Revenson', 'Insight Kids', '[\"Juvenile Nonfiction\"]', 48, 'http://books.google.com/books/content?id=vnbgDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(9, 'Harry Potter and the Deathly Hallows', 'J. K. Rowling', 'Arthur a Levine', '[\"Juvenile Fiction\"]', 759, 'http://books.google.com/books/content?id=GZAoAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(11, 'Head First HTML and CSS', 'Elisabeth Robson', '\"O\'Reilly Media, Inc.\"', '[\"Computers\"]', 723, 'http://books.google.com/books/content?id=BZIYQtV6yKsC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(12, 'HTML Unleashed', 'Rick Darnell', 'Sams', '[\"Computers\"]', 1030, 'http://books.google.com/books/content?id=TYc_AQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(13, 'HTML Web Design in 7 Days', 'Unknown', 'Siamak Sarmady', '[\"Unknown\"]', 0, 'http://books.google.com/books/content?id=YwEQoMAJjj8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(14, 'Beginning HTML and CSS', 'Rob Larsen', 'John Wiley & Sons', '[\"Computers\"]', 672, 'http://books.google.com/books/content?id=QwnWLMtXU7cC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(15, 'HTML', 'Paul Whitehead', 'Visual', '[\"Computers\"]', 305, 'http://books.google.com/books/content?id=EKVVAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(16, 'Kenya National Assembly Official Record (Hansard)', 'Unknown', 'Unknown', '[\"Unknown\"]', 896, 'http://books.google.com/books/content?id=pvwVH2fQKWQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(17, 'HTML & CSS: The Complete Reference, Fifth Edition', 'Thomas Powell', 'McGraw Hill Professional', '[\"Computers\"]', 856, 'http://books.google.com/books/content?id=2w7_BOl1eL8C&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(18, 'HTML and CSS', 'Elizabeth Castro', 'Peachpit Press', '[\"Computers\"]', 576, 'http://books.google.com/books/content?id=WbQ-AAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(19, 'More HTML for Dummies', 'Ed Tittel', 'For Dummies', '[\"Computers\"]', 390, 'http://books.google.com/books/content?id=-Ik_AQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(20, 'Raggett on HTML 4', 'Dave Raggett', 'Addison-Wesley Professional', '[\"Computers\"]', 437, 'http://books.google.com/books/content?id=tE4PAQAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(21, 'The New User’s Guide to the Sun Workstation', 'Michael Russo', 'Springer Science & Business Media', '[\"Computers\"]', 203, 'http://books.google.com/books/content?id=EfEICAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(22, 'Decisions and Orders of the National Labor Relations Board', 'United States. National Labor Relations Board', 'Unknown', '[\"Labor laws and legislation\"]', 0, 'http://books.google.com/books/content?id=sP5ZAAAAYAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(23, 'Examples & Explanations for Federal Income Tax', 'Katherine Pratt', 'Aspen Publishers', '[\"Law\"]', 608, 'http://books.google.com/books/content?id=KTqDDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(24, 'Federal Income Tax', 'Joseph Bankman', 'Wolters Kluwer', '[\"Law\"]', 587, 'http://books.google.com/books/content?id=YAz3cqf64Q8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(25, 'The Sun Technology Papers', 'Mark Hall', 'Springer', '[\"Computers\"]', 257, 'http://books.google.com/books/content?id=JUDTBwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(26, 'The King of Drugs', 'Nora Barrett', 'Unknown', '[\"Unknown\"]', 199, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-thriller-book-cover-design-template-3675ae3e3ac7ee095fc793ab61b812cc_screen.jpg?ts=1637008457', 'AVAILABLE'),
(27, 'Memory', 'Angelina Aludo', 'Unknown', '[\"Unknown\"]', 0, 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/contemporary-fiction-night-time-book-cover-design-template-1be47835c3058eb42211574e0c4ed8bf_screen.jpg?ts=1637012564', 'AVAILABLE'),
(30, 'Financial Management and Policy', 'James C. Van Horne', 'Pearson Education India', '[\"Corporations\"]', 583, 'http://books.google.com/books/content?id=Y45EAAAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(31, 'Financial Services, 2E', 'Gurusamy', 'Tata McGraw-Hill Education', '[\"Financial services industry\"]', 590, 'http://books.google.com/books/content?id=hd-_y8FG8c4C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(32, 'Risk Management and Financial Institutions', 'John C. Hull', 'John Wiley & Sons', '[\"Business & Economics\"]', 832, 'http://books.google.com/books/content?id=nWpRDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(33, 'Financial Management', 'Arthur J. Keown', 'Prentice Hall', '[\"Business & Economics\"]', 801, 'http://books.google.com/books/content?id=35EwPwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(34, 'Intermediate Financial Management', 'Eugene F. Brigham', 'Cengage Learning', '[\"Business & Economics\"]', 1168, 'http://books.google.com/books/content?id=dgcJzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(35, 'Guide to Financial Management', 'John Tennent', 'Economist the', '[\"Business & Economics\"]', 359, 'http://books.google.com/books/content?id=drv8ngEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(36, 'Financial Entrepreneurship for Economic Growth in Emerging Nations', 'Woldie, Atsede', 'IGI Global', '[\"Business & Economics\"]', 304, 'http://books.google.com/books/content?id=R4wtDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(37, 'Financial Accounting for Management', 'Ambrish Gupta', 'Pearson Education India', '[\"Business & Economics\"]', 986, 'http://books.google.com/books/content?id=dKq_PW81mh8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(38, 'Principles of Business Financial Accounting', 'Pramod Gupta', 'AuthorHouse', '[\"Business & Economics\"]', 228, 'http://books.google.com/books/content?id=j3KEko2yalgC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(39, 'Changing Financial Landscapes in India and Indonesia', 'Heiko Schrader', 'LIT Verlag Münster', '[\"Social Science\"]', 293, 'http://books.google.com/books/content?id=8rf7nIIz8ikC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'BORROWED'),
(40, 'Outlook Business', 'Unknown', 'Unknown', '[\"Unknown\"]', 58, 'http://books.google.com/books/content?id=ljEEAAAAMBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(41, 'International Business', 'Peter J. Buckley', 'Oxford University Press', '[\"International business enterprises\"]', 708, 'http://books.google.com/books/content?id=IZRODwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(42, 'Journal of Small Business and Entrepreneurship', 'Unknown', 'Unknown', '[\"Unknown\"]', 86, 'http://books.google.com/books/content?id=rXs3fIlDb3cC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(43, 'The Business Environment', 'Paul Wetherly', 'Oxford University Press', '[\"Unknown\"]', 528, 'http://books.google.com/books/content?id=hBFQDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(44, 'Global Business Environment', 'Mansi Kapoor', 'SAGE Publications Pvt. Limited', '[\"Business & Economics\"]', 280, 'http://books.google.com/books/content?id=TZXAwgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(45, 'Cases on Small Business Economics and Development During Economic Crises', 'Stephens, Simon', 'IGI Global', '[\"Business & Economics\"]', 281, 'http://books.google.com/books/content?id=SuREEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(46, 'True Story', 'Ty Montague', 'Harvard Business Press', '[\"Business & Economics\"]', 224, 'http://books.google.com/books/content?id=wbMTAAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(47, 'The Business Book', 'DK', 'Dorling Kindersley Ltd', '[\"Business & Economics\"]', 352, 'http://books.google.com/books/content?id=H4TYBQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(48, 'Blockchain Revolution', 'Don Tapscott', 'Penguin', '[\"Technology & Engineering\"]', 432, 'http://books.google.com/books/content?id=8qlPEAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(49, 'The Business Blockchain', 'William Mougayar', 'John Wiley & Sons', '[\"Business & Economics\"]', 208, 'http://books.google.com/books/content?id=X8oXDAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(50, 'Blockchain Basics', 'Daniel Drescher', 'Apress', '[\"Computers\"]', 255, 'http://books.google.com/books/content?id=8tM0MQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'BORROWED'),
(51, 'Handbook of Research on Blockchain Technology', 'Saravanan Krishnan', 'Academic Press', '[\"Science\"]', 476, 'http://books.google.com/books/content?id=lKjODwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(52, 'Mastering Blockchain', 'Lorne Lantz', 'O\'Reilly Media', '[\"Business & Economics\"]', 284, 'http://books.google.com/books/content?id=Z8QIEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(53, 'Bitcoin, Blockchain, and Cryptoassets', 'Fabian Schar', 'MIT Press', '[\"Business & Economics\"]', 384, 'http://books.google.com/books/content?id=_L34DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(54, 'Cryptocurrencies and Blockchain Technology Applications', 'Gulshan Shrivastava', 'John Wiley & Sons', '[\"Business & Economics\"]', 336, 'http://books.google.com/books/content?id=s0nhDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(55, 'Blockchain A to Z Explained', 'Rajesh Dhuddu', 'BPB Publications', '[\"Computers\"]', 202, 'http://books.google.com/books/content?id=cCNAEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'BORROWED'),
(56, 'Introduction to Blockchain Technology', 'Tiana Laurence', 'Van Haren', '[\"Education\"]', 250, 'http://books.google.com/books/content?id=uD-4DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(57, 'Blockchain Foundations', 'Mary C. Lacity', 'Unknown', '[\"Business & Economics\"]', 472, 'http://books.google.com/books/content?id=JWYGEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(58, 'The NFT Handbook', 'QuHarrison Terry', 'John Wiley & Sons', '[\"Business & Economics\"]', 288, 'http://books.google.com/books/content?id=zDVCEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(59, 'Non Fungible Token (NFT)', 'Vicky V. Choudhary', 'Vicky Choudhary', '[\"Business & Economics\"]', 73, 'http://books.google.com/books/content?id=YEBcEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(60, 'NFTs For Dummies', 'Tiana Laurence', 'John Wiley & Sons', '[\"Business & Economics\"]', 272, 'http://books.google.com/books/content?id=XytLEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(61, 'NFT (Non Fungible Tokens), Guide; Buying, Selling, Trading, Investing in Crypto Collectibles Art. Create Wealth and Build Assets', 'Nft Trending', 'Nft Cryptocurrency Investment Guides', '[\"Unknown\"]', 164, 'http://books.google.com/books/content?id=sfdezgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(62, 'How to NFT', 'Benjamin Hor', 'CoinGecko', '[\"Business & Economics\"]', 220, 'http://books.google.com/books/content?id=S3JXEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(63, 'NFT Non-Fungible Tokens: for Beginners', 'Alfonso Hanim', 'Unknown', '[\"Unknown\"]', 77, 'http://books.google.com/books/content?id=X0VkzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(64, 'NFT Guide', 'Charles Pett', 'Unknown', '[\"Unknown\"]', 84, 'http://books.google.com/books/content?id=ecJozgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(65, 'NFT Blueprint - Cryptocurrency Investing For Beginners', 'Freedom Economics Publications', 'Unknown', '[\"Unknown\"]', 344, 'http://books.google.com/books/content?id=rA2LzgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'AVAILABLE'),
(66, 'The Hyprocite World', 'Sophia Hills', 'Unknown', '[\"Unknown\"]', 84, 'https://marketplace.canva.com/EAD7WuSVrt0/1/0/1003w/canva-colorful-illustration-young-adult-book-cover-LVthABb24ik.jpg', 'AVAILABLE'),
(67, 'Quick Guide for Creating, Selling and Buying Non-Fungible Tokens (NFTs)', 'Dr. Hidaia Mahmood Alassouli', 'Lulu Press, Inc', '[\"Business & Economics\"]', 0, 'http://books.google.com/books/content?id=GV5cEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'AVAILABLE'),
(69, 'The Martian', 'Andy Weir', 'Andy', '[\"Novels\"]', 300, 'https://lumiere-a.akamaihd.net/v1/images/image_a119dd78.jpeg', 'AVAILABLE'),
(71, 'My Book Cover', 'Me', 'Book Publisher', '[\"Myself\"]', 2000, 'https://edit.org/images/cat/book-covers-big-2019101610.jpg', 'AVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
CREATE TABLE IF NOT EXISTS `borrows` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borrows_book_id_foreign` (`book_id`),
  KEY `borrows_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`id`, `book_id`, `user_id`, `borrow_date`, `return_date`) VALUES
(3, 29, 2, '2022-04-14', NULL),
(2, 29, 2, '2022-04-14', NULL),
(6, 4, 1, '2022-04-15', '2022-04-22'),
(7, 3, 3, '2022-04-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_09_130914_create_user_table', 1),
(3, '2022_04_09_131302_create_book_table', 1),
(4, '2022_04_09_135208_create_borrow_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('STUDENT','LECTURER','ADMIN') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metafield` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `telephone`, `password`, `metafield`) VALUES
(1, 'Lean Wei Liang', 'ADMIN', 'lwleo2000@gmail.com', '0124228523', '$2y$10$jhiDloeT8FYecLZKubIMIOF/mdhMSmYcT4gs8zrEsXdEUZk6G97IK', NULL),
(3, 'Tan Yuan Jie', 'LECTURER', 'yuanjie2000@gmail.com', '0129224545', '$2y$10$T/U6eUfLrKkQBdyeZv4ikujnKqf0NoVjHOinykWpGBcIMHeWz0hFO', NULL),
(4, 'Seow Kai Sheng', 'STUDENT', 'kai411@gmail.com', '0129222929', '$2y$10$nSJDumlki0wyuDeg0s.Ds.nUlSA7E17os3AvvcDoeKQu7Z9iYmQFa', NULL),
(5, 'Chong Chit Siang', 'STUDENT', 'edison@gmail.com', '0129222929', '$2y$10$jEm8EVK37BgSHz2a5TQHz.tW6w7mM.qZls/CVvy49g8h3mYO955Li', NULL),
(7, 'Ali Abu Akao', 'STUDENT', 'aliabuakao@gmail.com', '0123456789', '$2y$10$WbcZmavlpzjTCINsxZAtme9Ei0fm.FYEbjegsN1Vt6BnLjCbkVNNu', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

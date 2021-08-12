-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2015 at 11:13 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smart_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE IF NOT EXISTS `adminlogin` (
`adminId` int(11) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminId`, `userName`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `auxilary`
--

CREATE TABLE IF NOT EXISTS `auxilary` (
  `auxId` int(11) NOT NULL,
  `aboutUsContent` text NOT NULL,
  `deliveryContent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auxilary`
--

INSERT INTO `auxilary` (`auxId`, `aboutUsContent`, `deliveryContent`) VALUES
(1, 'Smart Shop has arrived to be your most favorite shop! Smart Shop is the ultimate online shopping destination for Bangladesh offering completely hassle-free shopping experience through secure and trusted gateways. We offer you trendy and reliable shopping with all your favorite brands and more. Now shopping is easier, faster and always joyous. We help you make the right choice here.', 'On placing an order, we will hold the product for you about 24 hours from purchase time.\r\n\r\nWhen products reaches at your door  you have to pay the products otherwise we will cancel your order and you have to bear the shipping charges.\r\n\r\nWe do not accept exchanges or returns of our products. We guarantee the products to be in good condition.\r\n\r\nThe color shades of the product might slightly differ from the photo displayed on website due to camera lighting.\r\n\r\nCustomers have to bear the shipping charges.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`categoryId` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
(1, 'DRESS FOR MEN'),
(2, 'DRESS FOR WOMEN'),
(3, 'JEWELRY');

-- --------------------------------------------------------

--
-- Table structure for table `customerlogin`
--

CREATE TABLE IF NOT EXISTS `customerlogin` (
`userId` int(11) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customerlogin`
--

INSERT INTO `customerlogin` (`userId`, `userName`, `email`, `password`) VALUES
(1, 'user', 'mshohel2157@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`customerId` int(10) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `postalCode` varchar(40) NOT NULL,
  `phoneNumber` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `firstName`, `lastName`, `address`, `city`, `postalCode`, `phoneNumber`, `email`) VALUES
(1, 'shohel', 'Mojumder', 'vil-Delapara P.O-kutubpur P.S-Fatullah', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com'),
(2, 'shohel', 'Mojumder', 'vil-Delapara P.O-kutubpur P.S-Fatullah', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com'),
(3, 'Sahadat', 'Hossain', '65 bonogram road wari', 'Dhaka', '1100', '01717272271', 'bscmojumder@yahoo.com'),
(4, 'shohel', 'Mojumder', 'vil-Delapara P.O-kutubpur P.S-Fatullah', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com'),
(5, 'shohel', 'mojumder', 'delpara', 'dhaka', '1', '11', 'mshohel2157@gmail.com'),
(6, 'shohel', 'Mojumder', 'vil-Delapara P.O-kutubpur P.S-Fatullah', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com'),
(7, '', '', '', '', '', '', ''),
(8, '', '', '', '', '', '', ''),
(9, 'Shohel', 'Mojumder', 'vil -delpara p.s fatullah', 'dhaka', '11', '111', 'mshohel2157@gmail.com'),
(10, 'Shohel', 'Mojumder', 'Vi--Delpara', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com'),
(11, 'shohel', 'Mojumder', 'vil-Delpara', 'Dhaka', '1421', '01682542281', 'mshohel2157@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
`orderDetailsId` int(11) NOT NULL,
  `orderId` int(10) NOT NULL,
  `ProductId` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `ProductPrice` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetailsId`, `orderId`, `ProductId`, `quantity`, `ProductPrice`) VALUES
(1, 1, 11, 1, 800),
(2, 1, 12, 1, 820),
(3, 1, 10, 2, 180),
(4, 1, 18, 1, 800);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orderId` int(10) NOT NULL,
  `customerId` int(10) NOT NULL,
  `orderDate` datetime NOT NULL,
  `totalAmount` int(10) NOT NULL,
  `discountPercent` int(10) NOT NULL,
  `discountAmount` int(10) NOT NULL,
  `payableAmount` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `orderDate`, `totalAmount`, `discountPercent`, `discountAmount`, `payableAmount`) VALUES
(1, 10, '2015-04-21 03:15:22', 2780, 10, 259, 2521);

-- --------------------------------------------------------

--
-- Table structure for table `productsdescription`
--

CREATE TABLE IF NOT EXISTS `productsdescription` (
`productId` int(20) NOT NULL,
  `categoryName` varchar(20) NOT NULL,
  `subcategoryName` varchar(20) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `actualPrice` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `frontDisplay` int(10) DEFAULT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `productsdescription`
--

INSERT INTO `productsdescription` (`productId`, `categoryName`, `subcategoryName`, `productName`, `price`, `discount`, `actualPrice`, `quantity`, `photo`, `frontDisplay`, `description`) VALUES
(1, 'DRESS FOR MEN', 'T-SHIRTS', 'Bangladesh World Cup T-shirt (Green)', 275, 5, 261, 50, 'Tshirt1.jpg', NULL, 'Exclusive T-shirt in Green color that will satisfy your mind. It feels you cool and comfortable with wonderful fabric and trendy style.'),
(2, 'DRESS FOR MEN', 'T-SHIRTS', 'East West North South T-shirt (Black)', 370, 5, 352, 40, 'Tshirt2.jpg', NULL, 'Exclusive East West North South T-shirt in cool color that will satisfy your mind. Nice t-shirt with best quality fabrics. Grab this fashionable t-shirt in best price.'),
(3, 'DRESS FOR MEN', 'T-SHIRTS', 'Bangladesh Flag T-shirt (Green)', 300, 5, 285, 20, 'Tshirt3.jpg', NULL, 'Exclusive t-shirt in cool color that will satisfy your mind. It feels you cool and comfortable with wonderful fabric and trendy style.'),
(4, 'DRESS FOR MEN', 'T-SHIRTS', 'Master Design T-shirt (Light Ash)', 350, 5, 333, 80, 'Tshirt4.jpg', NULL, 'Exclusive Master Design T-shirt in cool color that will satisfy your mind. Nice t-shirt with best quality fabrics. Grab this fashionable t-shirt in best price.'),
(5, 'DRESS FOR MEN', 'T-SHIRTS', 'East West North South T-shirt (Chocolate)', 370, 5, 352, 50, 'Tshirt5.jpg', NULL, 'Exclusive East West North South T-shirt in cool color that will satisfy your mind. Nice t-shirt with best quality fabrics. Grab this fashionable t-shirt in best price.'),
(6, 'DRESS FOR MEN', 'T-SHIRTS', 'East West North South T-shirt (Olive)', 370, 5, 352, 100, 'Tshirt6.jpg', NULL, 'Exclusive East West North South T-shirt in cool color that will satisfy your mind. Nice t-shirt with best quality fabrics. Grab this fashionable t-shirt in best price.'),
(7, 'DRESS FOR MEN', 'T-SHIRTS', 'East West North South T-shirt (Lemon)', 370, 5, 352, 25, 'Tshirt7.jpg', NULL, 'Exclusive East West North South T-shirt in cool color that will satisfy your mind. Nice t-shirt with best quality fabrics. Grab this fashionable t-shirt in best price.'),
(8, 'DRESS FOR MEN', 'T-SHIRTS', 'Autism T-Shirt (Red)', 180, 5, 171, 30, 'Tshirt8.jpg', NULL, 'Exclusive Autism t-shirt in cool color that will satisfy your mind. Nice t-shirt with innovative design & vibrant color. Grab the t-shirt that will speak about you. New products at a highly affordable price!'),
(9, 'DRESS FOR MEN', 'T-SHIRTS', 'Autism T-Shirt (Black)', 180, 5, 171, 20, 'Tshirt9.jpg', NULL, 'Exclusive Autism t-shirt in cool color that will satisfy your mind. Nice t-shirt with innovative design & vibrant color. Grab the t-shirt that will speak about you. New products at a highly affordable price!'),
(10, 'DRESS FOR MEN', 'T-SHIRTS', 'Autism T-Shirt (Dark Purple)', 180, 5, 171, 50, 'Tshirt10.jpg', 1, 'Exclusive Autism T-Shirt in cool color that will satisfy your mind. Nice t-shirt with innovative design & vibrant color. Grab the t-shirt that will speak about you. New products at a highly affordable price!'),
(11, 'DRESS FOR MEN', 'SHIRTS', 'Smart X-Side Full Sleeved Shirt', 800, 5, 760, 30, 'shirts1.jpg', 2, 'Exclusive Check Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(12, 'DRESS FOR MEN', 'PUNJABI', 'Black Self Stripe Cotton Punjabi for Men', 820, 5, 779, 40, 'punjabi1.jpg', 3, 'Elegant Cotton Punjabi for Men in cool color that will satisfy your mind. Nice Punjabi with best quality cotton fabrics. Adorn yourself with gorgeous look.'),
(13, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set', 3600, 5, 3420, 40, 'salwarkamiz1.jpg', 4, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(14, 'DRESS FOR WOMEN', 'SAREE', 'Original Indian Half Shifon Shari', 3500, 5, 3325, 20, 'saree1.jpg', 5, 'Grab an original Indian half shifon shari for you! Express who you are through what you are wearing. Adorn yourself with gorgeous look with exclusive party Shari.'),
(17, 'JEWELRY', 'NECKLACE', 'Titanic Theme Ocean of Love Necklace', 750, 28, 540, 20, 'necklace2.jpg', NULL, 'This Titanic Theme Ocean of Love Necklace has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece.'),
(18, 'JEWELRY', 'NECKLACE', 'Blue Ocean Peacock Heart Earring and Pendant Set', 800, 20, 640, 20, 'necklace3.jpg', 7, 'This Blue Ocean Pendant & Earring Set has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece.'),
(19, 'JEWELRY', 'EAR TOP', 'Rose Theme Long Earring (Sky Blue)', 400, 5, 380, 30, 'eartop1.jpg', 8, 'This Rose Theme Long Earring has texture galore and is so on trend! You will love the assortment of finishes in the statement piece.'),
(20, 'JEWELRY', 'BRACELET', 'Classic Beads Bracelet', 220, 5, 209, 20, 'bracelet1.jpg', NULL, 'Explore your beauty with this elegant Classic Beads Bracelet. Fashionable beads crafted attractive bracelet to offer you stylish look. Fine workmanship and finely polished.'),
(22, 'DRESS FOR MEN', 'SHIRTS', 'Superstyle DLOAD Check Shirt', 750, 25, 563, 30, 'shirts2.jpg', NULL, 'Exclusive Check Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Color Combination of Black, Blue and White.'),
(23, 'DRESS FOR MEN', 'SHIRTS', 'Blue Stripe Formal Full Sleeved Shirt', 670, 5, 637, 20, 'shirts3.jpg', NULL, 'Exclusive Stripe Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(24, 'DRESS FOR MEN', 'SHIRTS', 'Check Design Full Sleeved Shirt', 830, 5, 789, 15, 'shirts4.jpg', NULL, 'Exclusive Check Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(25, 'DRESS FOR MEN', 'SHIRTS', 'Stylish Stripe Half Sleeved Shirt (Black & White)', 700, 5, 665, 20, 'shirts6.jpg', NULL, 'Exclusive half sleeved in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(26, 'DRESS FOR MEN', 'SHIRTS', 'Stylish Check Shirt', 800, 25, 600, 30, 'shirts7.jpg', NULL, 'Exclusive Check Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(27, 'DRESS FOR MEN', 'SHIRTS', 'Jack & Jones Check Shirt for Men', 700, 15, 595, 40, 'shirts9.jpg', NULL, 'Exclusive Casual Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(28, 'DRESS FOR MEN', 'SHIRTS', 'Formal Shirt for Men (Purple)', 800, 20, 640, 20, 'shirts10.jpg', NULL, 'Exclusive Formal Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(29, 'DRESS FOR MEN', 'SHIRTS', 'Multicolor Check Cotton Shirt', 750, 5, 713, 10, 'shirts11.jpg', NULL, 'Exclusive Check Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(30, 'DRESS FOR MEN', 'SHIRTS', 'Ck Shirt for Men', 1400, 5, 1330, 10, 'shirts12.jpg', NULL, 'Exclusive Semi Formal Design Shirt in cool color that will satisfy your mind. Nice shirt with best quality cotton fabrics. Grab this fashionable shirt in best price. Combination of style and comfort.'),
(31, 'DRESS FOR MEN', 'PUNJABI', 'Green Self Stipe Cotton Punjabi for Men', 750, 5, 713, 25, 'punjabi2.jpg', NULL, 'Elegant Cotton Punjabi for Men in cool color that will satisfy your mind. Nice Punjabi with best quality cotton fabrics. Adorn yourself with gorgeous look.'),
(32, 'DRESS FOR MEN', 'PUNJABI', 'Fashionable Red & White Punjabi for Men', 750, 5, 713, 30, 'punjabi3.jpg', NULL, 'Fashionable Cotton Punjabi for Men in cool color that will satisfy your mind. Nice Punjabi with best quality cotton fabrics. Adorn yourself with Bangladeshi look!'),
(35, 'DRESS FOR MEN', 'PUNJABI', 'Elegant Silk Punjabi for Men', 1700, 5, 1615, 40, 'punjabi4.jpg', NULL, 'Elegant Silk Punjabi for Men in cool color that will satisfy your mind. Nice Punjabi with best quality silk fabrics. Adorn yourself with Bangladeshi look!'),
(36, 'DRESS FOR MEN', 'PUNJABI', 'Elegant Cotton Punjabi for Men', 1300, 5, 1235, 40, 'punjabi5.jpg', NULL, 'Elegant Cotton Punjabi for Men in cool color that will satisfy your mind. Nice Punjabi with best quality cotton fabrics. Adorn yourself with Bangladeshi look!'),
(38, 'DRESS FOR MEN', 'PUNJABI', 'COTTON PUNJABI-2', 1650, 5, 1568, 10, 'punjabi7.jpg', NULL, 'This is a 100% cotton Punjabi with nice blue color'),
(39, 'DRESS FOR MEN', 'PUNJABI', 'LONG PUNJABI', 850, 5, 808, 40, 'punjabi8.jpg', NULL, 'This is a nice strip long Punjabi'),
(40, 'DRESS FOR MEN', 'PUNJABI', 'Long Punjabi with Karchupi work', 4000, 5, 3800, 30, 'punjabi9.jpg', NULL, 'Long Panjabi with Karchupi work'),
(41, 'DRESS FOR MEN', 'PUNJABI', 'Long Panjabi with Karchupi work-2', 3000, 5, 2850, 12, 'punjabi10.jpg', NULL, 'This is a nice long Punjabi with Karchupi work.'),
(42, 'DRESS FOR MEN', 'PUNJABI', 'Nogordola', 1400, 5, 1330, 20, 'punjabi11.jpg', NULL, 'This is a nice Punjabi with the different color'),
(44, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-1', 3300, 7, 3069, 20, 'salwarkamiz2.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(45, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-2', 4000, 10, 3600, 20, 'salwarkamiz4.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(46, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-3', 3200, 5, 3040, 30, 'salwarkamiz5.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(47, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-4', 3300, 10, 2970, 5, 'salwarkamiz6.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(48, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-5', 3300, 5, 3135, 15, 'salwarkamiz7.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(49, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-56', 3800, 5, 3610, 10, 'salwarkamiz8.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(50, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-6', 3200, 5, 3040, 20, 'salwarkamiz9.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(51, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-7', 3500, 5, 3325, 10, 'salwarkamiz10.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(52, 'DRESS FOR WOMEN', 'SALWAR KAMIZ', 'Original Indian Embroidery Salwar Kamiz Set-8', 3400, 5, 3230, 20, 'salwarkamiz11.jpg', NULL, 'Original Indian Salwar Kamiz Set in heavy embroidery! Extraordinary design and exclusive work. Comfortable to wear and good looking at the same time. Exactly what you need to get a perfect look.'),
(53, 'DRESS FOR WOMEN', 'SAREE', 'Original Indian Half Shifon Shari-1', 3500, 7, 3255, 20, 'saree2.jpg', NULL, 'Grab an original Indian half shifon shari for you! Express who you are through what you are wearing. Adorn yourself with gorgeous look with exclusive party Shari.'),
(54, 'DRESS FOR WOMEN', 'SAREE', 'Original Indian Half Shifon Shari-2', 3400, 5, 3230, 30, 'saree3.jpg', NULL, 'Grab an original Indian half Shifon Shari for you! Express who you are through what you are wearing. Adorn yourself with gorgeous look with exclusive party Shari.'),
(55, 'DRESS FOR WOMEN', 'SAREE', 'Red & Golden Work Jamdani Shari', 3000, 5, 2850, 15, 'saree4.jpg', NULL, 'Grab an outstanding Jamdani Shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic all over work Jamdani Shari.'),
(56, 'DRESS FOR WOMEN', 'SAREE', 'Moslin Shari with Sequence Embroidery (Chocolate)', 9200, 5, 8740, 20, 'saree5.jpg', NULL, 'Grab an outstanding Moslin shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer Moslin shari.'),
(57, 'DRESS FOR WOMEN', 'SAREE', 'Half Silk Shari with Pure Silk Anchal (Maroon)', 5000, 5, 4750, 10, 'saree7.jpg', NULL, 'Grab an outstanding half silk shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer half silk shari.'),
(58, 'DRESS FOR WOMEN', 'SAREE', 'Exclusive Hand Paint Cotton Shari', 2700, 5, 2565, 20, 'saree8.jpg', NULL, 'Grab an outstanding Hand Paint Cotton Shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer cotton Shari.'),
(59, 'DRESS FOR WOMEN', 'SAREE', 'Jorjet Shari with Embroidery & Chumki Work', 7500, 10, 6750, 20, 'saree9.jpg', NULL, 'Grab an outstanding jorjet shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer jorjet shari.'),
(60, 'DRESS FOR WOMEN', 'SAREE', 'Exclusive Cotton Block Print Shari', 1700, 5, 1615, 10, 'saree10.jpg', NULL, 'Grab an outstanding Cotton Block Print shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer cotton shari'),
(61, 'DRESS FOR WOMEN', 'SAREE', 'Exclusive Hand Paint Cotton Shari (Navy Blue)', 2600, 5, 2470, 20, 'saree11.jpg', NULL, 'Grab an outstanding Hand Paint Cotton Shari for you! Express who you are through what you are wearing. Adorn yourself with Bangladeshi look with authentic designer cotton Shari.'),
(64, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-2', 450, 5, 428, 20, 'scarf-hijab4.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(66, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-4', 400, 5, 380, 29, 'scarf-hijab6.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(67, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-5', 400, 5, 380, 20, 'scarf-hijab7.jpg', NULL, 'Nice outstanding Hijab As like picture.'),
(68, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-6', 400, 4, 384, 20, 'scarf-hijab8.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(69, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-7', 450, 10, 405, 15, 'scarf-hijab9.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(70, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-8', 450, 10, 405, 9, 'scarf-hijab10.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(73, 'JEWELRY', 'NECKLACE', 'Blue Ocean Zigzag Heart Earring and Pendant Set', 900, 5, 855, 20, 'necklace5.jpg', NULL, 'This Blue Ocean Pendant & Earring Set has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(74, 'JEWELRY', 'NECKLACE', 'Titanic Theme Necklace', 520, 5, 494, 20, 'necklace6.jpg', NULL, 'This Titanic Theme Ocean of Love Necklace has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(75, 'JEWELRY', 'NECKLACE', 'Diamond Cut Big Stone Long Necklace', 700, 5, 665, 10, 'necklace7.jpg', NULL, 'This Diamond Cut Big Stone Long Necklace has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(76, 'JEWELRY', 'NECKLACE', 'Love Theme Gold Plated Pendant', 600, 5, 570, 20, 'necklace8.jpg', NULL, 'This Love Theme Gold Plated Pendant has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(77, 'JEWELRY', 'NECKLACE', 'Black Flower Stone Crafted Necklace', 450, 10, 405, 20, 'necklace9.jpg', NULL, 'Elegant black flower stone crafted necklace with metal finishing for gorgeous ladies! The adjustable fit is the most appealing part of this beautiful necklace! Make a bold statement with this necklace.'),
(78, 'JEWELRY', 'NECKLACE', 'Multicolor Studded Stone Necklace', 600, 5, 570, 20, 'necklace10.jpg', NULL, 'This Multicolor Studded Stone Necklace has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(79, 'JEWELRY', 'NECKLACE', 'NAKLESS', 900, 5, 855, 10, 'necklace11.jpg', NULL, 'Fashionable and trendy Swan Design Long Necklace. Available in silver with multicolor. The necklace will look amazing on you. Fine workmanship and finely polished.'),
(80, 'JEWELRY', 'EAR TOP', 'Rose Theme Long Earring (Black)', 450, 5, 428, 20, 'eartop3.jpg', NULL, 'This Rose Theme Long Earring has texture galore and is so on trend! You will love the assortment of finishes in the statement piece. It will look amazing on you!'),
(81, 'JEWELRY', 'EAR TOP', 'Rose Theme Long Earring (Red)', 450, 5, 428, 10, 'eartop4.jpg', NULL, 'This Rose Theme Long Earring has texture galore and is so on trend! You will love the assortment of finishes in the statement piece. It will look amazing on you!'),
(82, 'JEWELRY', 'EAR TOP', 'Handmade Special Earring (Design 2)', 1100, 5, 1045, 5, 'eartop5.jpg', NULL, 'Stunning Handmade Special Earring for fashionable lady. All the beads and stones are assorted carefully with hand. Perfect piece to complement your look. Available in multicolor. It will look amazing on you!'),
(83, 'JEWELRY', 'EAR TOP', 'Handmade Special Earring (Design 1)', 1100, 5, 1045, 10, 'eartop7.jpg', NULL, 'Stunning Handmade Special Earring for fashionable lady. All the beads and stones are assorted carefully with hand. Perfect piece to complement your look. Available in multicolor. It will look amazing on you!'),
(84, 'JEWELRY', 'EAR TOP', 'Light Blue Elegant Earring', 600, 20, 480, 20, 'eartop8.jpg', NULL, 'Fashionable and trendy Light Blue Elegant Earring for wonderful women! Perfect piece to complement your look. Available in light blue and silver color. It will look amazing on you!'),
(85, 'JEWELRY', 'EAR TOP', 'Fashion hit color geometric earrings', 600, 30, 420, 20, 'eartop9.jpg', NULL, 'Designed with vibrant hit color â€˜Alloyâ€™ for a playful, pebble-type effect, these trapezoidal post earrings prove geometry can be fun indeed! It will complement your outfit and make you gorgeous.'),
(86, 'JEWELRY', 'EAR TOP', 'Wild Tassel Shell Fashion Earrings', 400, 5, 380, 5, 'eartop10.jpg', NULL, 'Intricate beading sets off a tribal vibe from these wild tassel shell fashion earrings. The shell pattern on this pair is accented by small stones for a modern effect. Perfect ornament for any party!'),
(88, 'JEWELRY', 'EAR TOP', 'Crystal Leaf Blue Earring', 500, 10, 450, 20, 'eartop11.jpg', NULL, 'Fashionable and trendy Crystal Leaf Blue Earring for wonderful women! Perfect piece to complement your look. Available in sparkling blue color. It will look amazing on you!'),
(89, 'JEWELRY', 'EAR TOP', 'Trend Icon Ear Top (Blue)', 550, 20, 440, 10, 'eartop12.jpg', NULL, 'Fashionable and trendy Ear Top for wonderful women! Perfect piece to complement your look. Available in blue with golden color. It will look amazing on you!'),
(90, 'JEWELRY', 'BRACELET', 'Ball Design Wooden Bracelet', 250, 28, 180, 20, 'bracelet2.jpg', 9, 'Explore your beauty with this Ball Design Wooden Bracelet. Fashionable wooden crafted attractive bracelet to offer you stylish look.'),
(91, 'JEWELRY', 'BRACELET', 'Classic Beads Bracelet (Sky Blue)', 180, 10, 162, 20, 'bracelet3.jpg', NULL, 'Explore your beauty with this elegant Classic Beads Bracelet. Fashionable beads crafted attractive bracelet to offer you stylish look. Fine workmanship and finely polished.'),
(92, 'JEWELRY', 'BRACELET', 'Exclusive Titanic Ocean of Love Bangle', 1000, 20, 800, 20, 'bracelet4.jpg', NULL, 'This Titanic Theme Ocean of Love bangle has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!'),
(93, 'JEWELRY', 'BRACELET', 'Double Layer Wooden Bracelet (Multicolor)', 250, 28, 180, 15, 'bracelet5.jpg', NULL, 'Explore your beauty with this Double Layer Wooden Bracelet. Fashionable wooden crafted attractive bracelet to offer you stylish look. Fine workmanship and finely polished.'),
(94, 'JEWELRY', 'BRACELET', 'Red and White Love Theme Bangle', 550, 29, 391, 5, 'bracelet6.jpg', NULL, 'Explore your beauty with this elegant Red and White Love Theme Bangle. Fashionable attractive bangle to offer you stylish look. Fine workmanship & finely polished. Open on hinges to fit all sizes.'),
(95, 'JEWELRY', 'BRACELET', 'Love Theme Stone Bracelet', 600, 25, 450, 15, 'bracelet7.jpg', NULL, 'Explore your beauty with this elegant Love Theme Stone Bracelet. Fashionable stone crafted attractive bracelet to offer you stylish look. Fine workmanship & finely polished. Open on hinges to fit all sizes.'),
(96, 'JEWELRY', 'BRACELET', 'Wooden Wide Bracelet', 250, 28, 180, 5, 'bracelet8.jpg', NULL, 'Explore your beauty with this Wooden Wide Bracelet. Fashionable wooden crafted attractive bracelet to offer you stylish look. Fine workmanship and finely polished.'),
(97, 'JEWELRY', 'BRACELET', 'Royal Blue Stone Crafted Bangle', 500, 21, 395, 10, 'bracelet9.jpg', NULL, 'Explore your beauty with this elegant Royal Blue Stone Crafted Bangle. Fashionable stone crafted attractive bangle to offer you stylish look. Fine workmanship and finely polished.'),
(98, 'JEWELRY', 'BRACELET', 'Classic Beads Bracelet (Pink)', 250, 5, 238, 10, 'bracelet10.jpg', NULL, 'Explore your beauty with this elegant Classic Beads Bracelet. Fashionable beads crafted attractive bracelet to offer you stylish look. Fine workmanship and finely polished.'),
(101, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'LADIES SCARF-3', 400, 10, 360, 20, 'scarf-hijab3.jpg', NULL, 'Nice outstanding hijab As like picture.'),
(104, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'Silk Satin Scarves Shawl Hijab', 400, 5, 380, 20, 'scarf-hijab12.jpg', NULL, 'Women 90*90cm satin Square Scarf High Quality Imitated Silk Satin Scarves Shawl Hijab 2014 fashion style.'),
(105, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'long cape silk Hijab-2', 400, 5, 380, 20, 'scarf-hijab13.jpg', 6, '2014 new design fashion long cape silk chiffon tippet muffler echarpes scarves bandanas shawl and hijab women.'),
(106, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'Winter silk scarf', 450, 5, 428, 30, 'scarf-hijab14.jpg', NULL, 'new fashion Chiffon Bohemia Winter silk scarf women grid print silk blend plaid scarves shawl echarpes hijab'),
(107, 'DRESS FOR WOMEN', 'SCARF-HIJAB', 'autumn fashion hijab', 600, 10, 540, 30, 'scarf-hijab15.jpg', NULL, 'new autumn fashion women scarves voile silk scarf glitter leopard printed shawl muslim hijab Multi-functional scarves.'),
(108, 'JEWELRY', 'NECKLACE', 'Heart Design Earring & Pendant Set', 700, 5, 665, 30, 'necklace12.jpg', NULL, 'This Blue Heart Earring & Pendant Set has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you.'),
(109, 'JEWELRY', 'NECKLACE', 'Small Size Titanic Ocean of Love Pendant', 300, 5, 285, 10, '', NULL, 'This Titanic Theme Ocean of Love Locket has texture galore and is so on trend! You will love the assortment of finishes and materials used in the statement piece. It will look amazing on you!');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
`subcategoryId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `subcategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategoryId`, `categoryId`, `subcategoryName`) VALUES
(1, 1, 'T-SHIRTS'),
(2, 1, 'SHIRTS'),
(3, 1, 'PUNJABI'),
(4, 2, 'SALWAR KAMIZ'),
(5, 2, 'SAREE'),
(6, 2, 'SCARF-HIJAB'),
(7, 3, 'NECKLACE'),
(8, 3, 'EAR TOP'),
(9, 3, 'BRACELET');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
 ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `auxilary`
--
ALTER TABLE `auxilary`
 ADD PRIMARY KEY (`auxId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customerlogin`
--
ALTER TABLE `customerlogin`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
 ADD PRIMARY KEY (`orderDetailsId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `productsdescription`
--
ALTER TABLE `productsdescription`
 ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
 ADD PRIMARY KEY (`subcategoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customerlogin`
--
ALTER TABLE `customerlogin`
MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `customerId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
MODIFY `orderDetailsId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `orderId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productsdescription`
--
ALTER TABLE `productsdescription`
MODIFY `productId` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
MODIFY `subcategoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

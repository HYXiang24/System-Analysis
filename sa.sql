-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-18 16:58:58
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `sa`
--

-- --------------------------------------------------------

--
-- 資料表結構 `busy`
--

CREATE TABLE `busy` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `busy`
--

INSERT INTO `busy` (`id`, `status`) VALUES
(0, 0),
(1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`id`, `product`, `quantity`, `price`) VALUES
(39553914, '炒泡麵套餐', 1, 105),
(39553914, '雞塊', 1, 60),
(39553914, '奶茶', 1, 50),
(1556171665, '巧克力吐司', 1, 25),
(1556171665, '花生吐司', 1, 25),
(1556171665, '雞塊', 1, 60),
(1655144395, '炒泡麵套餐', 1, 105),
(1655144395, '牛肉漢堡', 2, 160),
(183295439, '花生吐司', 1, 25),
(183295439, '雞塊', 1, 60),
(754764231, '巧克力吐司', 5, 125),
(869263767, '巧克力吐司', 5, 125),
(1862849972, '牛肉漢堡', 1, 80),
(888994948, '牛肉漢堡', 1, 80),
(76614303, '巧克力吐司', 1, 25),
(76614303, '花生吐司', 1, 25),
(445250920, '奶茶', 4, 200),
(1440631719, '奶茶', 99, 4950),
(2047904213, '薯條', 10, 400),
(276402152, '紅茶', 3, 90),
(1717149089, '蔥抓餅套餐', 1, 90),
(163419221, '紅茶', 1, 30),
(63666977, '炒泡麵套餐', 2, 210),
(903029233, '蔥抓餅套餐', 3, 270),
(903029233, '牛肉漢堡', 2, 160),
(566590122, '炒泡麵套餐', 1, 105),
(566590122, '牛肉漢堡', 1, 80),
(566590122, '豬肉漢堡', 1, 75),
(1001011637, '炒泡麵套餐', 1, 105);

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `phone_number` char(10) NOT NULL COMMENT '手機號碼',
  `isBlockList` int(1) NOT NULL DEFAULT 0 COMMENT '黑名單'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`phone_number`, `isBlockList`) VALUES
('0900000014', 0),
('0900000114', 0),
('0912132132', 0),
('0912345678', 0),
('0925360767', 1),
('0925360768', 0),
('0925360777', 1),
('0987654321', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `c_order`
--

CREATE TABLE `c_order` (
  `id` int(11) NOT NULL COMMENT '訂單編號',
  `time` datetime DEFAULT NULL COMMENT '訂單時間',
  `price` int(11) DEFAULT NULL COMMENT '總金額',
  `phone_number` varchar(15) DEFAULT NULL COMMENT '電話',
  `isCheck` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `c_order`
--

INSERT INTO `c_order` (`id`, `time`, `price`, `phone_number`, `isCheck`) VALUES
(39553914, '2024-06-08 15:21:44', 215, '0912345678', 1),
(63666977, '2024-06-10 16:13:28', 210, '0912132132', 1),
(76614303, '2024-06-08 15:43:09', 50, '0900000014', 1),
(163419221, '2024-06-08 20:59:25', 30, '0925360768', 1),
(183295439, '2024-06-08 15:26:59', 85, '0900000014', 1),
(276402152, '2024-06-08 20:37:01', 90, '0900000014', 1),
(445250920, '2024-06-08 19:49:27', 200, '0912132132', 1),
(566590122, '2024-06-10 21:56:04', 260, '0925360768', 1),
(754764231, '2024-06-08 15:31:12', 125, '0900000014', 1),
(869263767, '2024-06-08 15:32:51', 125, '0900000014', 1),
(888994948, '2024-06-08 15:35:43', 80, '0900000014', 1),
(903029233, '2024-06-10 16:26:57', 430, '0912132132', 1),
(1001011637, '2025-05-18 18:33:58', 105, '0925360768', 0),
(1440631719, '2024-06-08 19:50:56', 4950, '0912132132', 1),
(1556171665, '2024-06-08 15:24:36', 110, '0987654321', 1),
(1655144395, '2024-06-08 15:25:27', 265, '0900000114', 1),
(1717149089, '2024-06-08 20:45:51', 90, '0925360768', 1),
(1862849972, '2024-06-08 15:33:47', 80, '0900000014', 1),
(2047904213, '2024-06-08 19:52:43', 400, '0912132132', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL COMMENT '食材編號',
  `name` varchar(255) DEFAULT NULL COMMENT '食材名稱',
  `quantity` int(11) DEFAULT NULL COMMENT '食材數量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `food`
--

INSERT INTO `food` (`id`, `name`, `quantity`) VALUES
(10, '蛋', 32),
(11, '牛肉', 8),
(12, '豬肉', 39),
(13, '馬鈴薯', 25),
(14, '番茄', 38),
(15, '洋蔥', 5),
(16, '胡蘿蔔', 8),
(17, '牛奶', 2),
(18, '麵包', 38),
(19, '青菜', 32),
(20, '薯條', 3),
(21, '雞塊', 77),
(23, '奶茶成分', 10),
(24, '巧克力', 9),
(25, '吐司', 7),
(26, '紅茶成分', 5),
(27, '泡麵', 44),
(28, '花生醬', 13),
(29, '小肉豆', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `category` varchar(20) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT './image/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`category`, `name`, `price`, `image_path`) VALUES
('drink', '奶茶', 50, './image/奶茶.png'),
('snack', '小肉豆', 30, './image/小肉豆.png'),
('toast', '巧克力吐司', 25, './image/巧克力吐司.png'),
('set_meal', '炒泡麵套餐', 105, './image/炒泡麵套餐.jpeg'),
('burger', '牛肉漢堡', 80, './image/牛肉漢堡.jpg'),
('drink', '紅茶', 30, './image/紅茶.png'),
('toast', '花生吐司', 25, './image/花生吐司.png'),
('set_meal', '蔥抓餅套餐', 90, './image/蔥抓餅套餐.png'),
('snack', '薯條', 40, './image/薯條.png'),
('burger', '豬肉漢堡', 75, './image/'),
('snack', '雞塊', 60, './image/雞塊.png');

-- --------------------------------------------------------

--
-- 資料表結構 `menu_composition`
--

CREATE TABLE `menu_composition` (
  `name` varchar(255) NOT NULL COMMENT '餐點名稱',
  `composition` varchar(255) NOT NULL COMMENT '食材',
  `quantity` int(11) DEFAULT NULL COMMENT '數量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `menu_composition`
--

INSERT INTO `menu_composition` (`name`, `composition`, `quantity`) VALUES
('雞塊', '雞塊', 1),
('豬肉漢堡', '麵包', 1),
('豬肉漢堡', '青菜', 1),
('豬肉漢堡', '番茄', 1),
('豬肉漢堡', '豬肉', 1),
('豬肉漢堡', '蛋', 1),
('奶茶', '奶茶成分', 1),
('紅茶', '紅茶成分', 1),
('牛肉漢堡', '麵包', 1),
('牛肉漢堡', '牛肉', 1),
('牛肉漢堡', '青菜', 1),
('牛肉漢堡', '番茄', 1),
('牛肉漢堡', '蛋', 1),
('巧克力吐司', '巧克力', 1),
('巧克力吐司', '吐司', 1),
('花生吐司', '花生醬', 1),
('花生吐司', '吐司', 1),
('薯條', '薯條', 1),
('小肉豆', '小肉豆', 1),
('炒泡麵套餐', '泡麵', 1),
('炒泡麵套餐', '青菜', 1),
('炒泡麵套餐', '蛋', 1),
('炒泡麵套餐', '豬肉', 1),
('炒泡麵套餐', '紅茶成分', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`phone_number`);

--
-- 資料表索引 `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`name`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `c_order`
--
ALTER TABLE `c_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=2054176437;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '食材編號', AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

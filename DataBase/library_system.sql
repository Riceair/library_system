-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 
-- 伺服器版本： 8.0.17
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `library_system`
--

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `author` text COLLATE utf8_unicode_ci NOT NULL,
  `book_name` text COLLATE utf8_unicode_ci NOT NULL,
  `publication_item` text COLLATE utf8_unicode_ci NOT NULL,
  `book_caid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`book_id`, `author`, `book_name`, `publication_item`, `book_caid`) VALUES
(0, '李凱鈞', '利用位元向量從產品資料庫有效探勘具約束條件之可篩除項目集(Efficiently Mining Constrained Erasable Itemsets from a Product Database by Bit Vectors)', '[高雄市] : 撰者, 民111[2022]', 0),
(1, '彭威淳', '自適應成本敏感深度學習以處理不平衡資料分類問題(Adaptively Cost-sensitive Deep Learning for Classification Problems with Imbalanced Datasets)', '[高雄市] : 撰者, 民110[2021]', 1),
(2, '賴煒勛', '基於遺傳演算法之配對交易技術的三個改進方法(Three Improvement Approaches to GA-Based Pairs Trading Techniques)', '[高雄市] : 撰者, 民110[2021]', 2),
(3, '蔡侑霖', '基於加權項目及樹狀結構之資料探勘對偶性(Duality Property of Weighted and Tree-based Data Mining)', '[高雄市] : 撰者, 民110[2021]', 0),
(4, '許悅佳', '應用生成深度網路於類別遞增式學習(Applying Generative Deep Networks to Class-incremental Learning)', '[高雄市] : 撰者, 民110[2021]', 1),
(5, '邱振嘉', '可篩除項目集之蛻變測試(Metamorphic Testing of Erasable-Itemset Mining)', '[高雄市] : 撰者, 民109[2020]', 0),
(6, '張浩', '具時序特性之可篩除項目集探勘(Erasable Itemset Mining with the Temporal Property)', '[高雄市] : 撰者, 民110[2021]', 0),
(7, '古孟平', '模糊平均效益資料探勘(Fuzzy Average-utility Data Mining)', '[高雄市] : 撰者, 民110[2021]', 0),
(9, 'Author', 'Book Name', '[高雄市] R~~', 0),
(10, 'AuthorBM', 'New Book123', '[高市]', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `book_category`
--

CREATE TABLE `book_category` (
  `caid` int(11) NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `book_category`
--

INSERT INTO `book_category` (`caid`, `category`) VALUES
(0, '資料探勘'),
(1, '深度學習'),
(2, '演化式計算');

-- --------------------------------------------------------

--
-- 資料表結構 `borrow_list`
--

CREATE TABLE `borrow_list` (
  `bid` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `borrow_account` text COLLATE utf8_unicode_ci NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `borrow_list`
--

INSERT INTO `borrow_list` (`bid`, `borrow_date`, `return_date`, `borrow_account`, `book_id`) VALUES
(0, '2022-04-25 18:11:45', NULL, 'handy00095', 5),
(2, '2022-04-25 18:15:08', NULL, 'dih0687', 1),
(3, '2022-04-25 18:15:12', NULL, 'dih0687', 7),
(4, '2022-04-25 21:47:42', '2022-04-25 21:49:21', 'dib', 10);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_account` text COLLATE utf8_unicode_ci NOT NULL,
  `user_pwd` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`user_name`, `user_account`, `user_pwd`, `user_email`, `user_phone`) VALUES
('王小明', 'handytest00095', 'handytestpwd', 'handytest00095@gmail.com', '0912345678'),
('李大華', 'handy00095', 'handypwd', 'handy00095@gmail.com', '0987654321'),
('DiH', 'dih0687', 'dihpwd', 'dih0687@gmail.com', '0954698735'),
('Ambiguity', 'dib', 'dibpwd', 'handy00095@gmail.com', '0976842354');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- 資料表索引 `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`caid`);

--
-- 資料表索引 `borrow_list`
--
ALTER TABLE `borrow_list`
  ADD PRIMARY KEY (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

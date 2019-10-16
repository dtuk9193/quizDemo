-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 15, 2019 at 08:13 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `question`
--

-- --------------------------------------------------------

--
-- Table structure for table `CategoryTable`
--

CREATE TABLE `CategoryTable` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `QuestionTable`
--

CREATE TABLE `QuestionTable` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question` varchar(1024) NOT NULL,
  `correct_answer` varchar(1024) NOT NULL,
  `answers` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ScoreTable`
--

CREATE TABLE `ScoreTable` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `total_count` int(11) NOT NULL,
  `correct_count` int(11) NOT NULL,
  `answer` varchar(1024) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CategoryTable`
--
ALTER TABLE `CategoryTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `QuestionTable`
--
ALTER TABLE `QuestionTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ScoreTable`
--
ALTER TABLE `ScoreTable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CategoryTable`
--
ALTER TABLE `CategoryTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `QuestionTable`
--
ALTER TABLE `QuestionTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ScoreTable`
--
ALTER TABLE `ScoreTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

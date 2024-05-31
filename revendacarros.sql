-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/05/2024 às 20:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `revendacarros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `status` enum('novo','seminovo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cars`
--

INSERT INTO `cars` (`id`, `marca`, `modelo`, `cor`, `ano`, `valor`, `status`) VALUES
(3, 'Gol', '1.1', 'cinza', 2002, 5000.00, 'seminovo'),
(53, 'Chevrolet', 'Onix', 'prata', 2018, 45000.00, 'seminovo'),
(61, 'BMW', 'Black Burnout', 'black', 2005, 2.00, 'novo'),
(63, 'Fusca', 'Volkswagen', 'white', 1999, 1500.00, 'seminovo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

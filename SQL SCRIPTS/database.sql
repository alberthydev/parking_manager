-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 09/07/2023 às 22:14
-- Versão do servidor: 10.11.4-MariaDB
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pessoal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(100) NOT NULL,
  `Customer_CPF` varchar(11) NOT NULL,
  `Customer_Phone` varchar(11) NOT NULL,
  `Customer_Address` varchar(255) NOT NULL,
  `Customer_Registration_Date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `parking`
--

CREATE TABLE `parking` (
  `Parked_ID` int(11) NOT NULL,
  `Parking_Space_ID` int(11) NOT NULL,
  `Vehicle_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Parking_Arrived_Date` timestamp NOT NULL,
  `Parking_Departure_Date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vehicles`
--

CREATE TABLE `vehicles` (
  `Vehicle_ID` int(11) NOT NULL,
  `Vehicle_Desc` varchar(60) NOT NULL,
  `Vehicle_Plate` varchar(7) NOT NULL,
  `Vehicle_Registration_Date` timestamp NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Vehicle_Parked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD UNIQUE KEY `Customer_CPF` (`Customer_CPF`);

--
-- Índices de tabela `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`Parked_ID`),
  ADD KEY `fk_vehicle_parking` (`Vehicle_ID`),
  ADD KEY `fk_customer_parking` (`Customer_ID`);

--
-- Índices de tabela `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`Vehicle_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `parking`
--
ALTER TABLE `parking`
  MODIFY `Parked_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `fk_customer_parking` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`),
  ADD CONSTRAINT `fk_vehicle_parking` FOREIGN KEY (`Vehicle_ID`) REFERENCES `vehicles` (`Vehicle_ID`);

--
-- Restrições para tabelas `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

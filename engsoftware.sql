-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Maio-2019 às 18:08
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engsoftware`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `geolocation`
--

CREATE TABLE `geolocation` (
  `id` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `IP` varchar(18) DEFAULT NULL,
  `continent_code` varchar(45) DEFAULT NULL,
  `continent_name` varchar(45) DEFAULT NULL,
  `country_code2` varchar(45) DEFAULT NULL,
  `country_code3` varchar(145) DEFAULT NULL,
  `country_name` varchar(145) DEFAULT NULL,
  `country_capital` varchar(145) DEFAULT NULL,
  `state_prov` varchar(145) DEFAULT NULL,
  `district` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `zipcode` varchar(145) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `is_eu` varchar(45) DEFAULT NULL,
  `calling_code` varchar(145) DEFAULT NULL,
  `country_tld` varchar(145) DEFAULT NULL,
  `languages` varchar(145) DEFAULT NULL,
  `country_flag` varchar(245) DEFAULT NULL,
  `connection_type` varchar(145) DEFAULT NULL,
  `organization` varchar(245) DEFAULT NULL,
  `geoname_id` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcelamento`
--

CREATE TABLE `parcelamento` (
  `id` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `parcelas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `nome` varchar(245) DEFAULT NULL,
  `cpf` varchar(18) DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  `n_parcelas` int(11) DEFAULT NULL,
  `forma_pagamento` int(11) DEFAULT NULL,
  `valor_parcelado` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `geolocation`
--
ALTER TABLE `geolocation`
  ADD PRIMARY KEY (`id`,`idPedido`),
  ADD KEY `idLocal_idx` (`idPedido`);

--
-- Indexes for table `parcelamento`
--
ALTER TABLE `parcelamento`
  ADD PRIMARY KEY (`id`,`idPedido`),
  ADD UNIQUE KEY `idtable1_UNIQUE` (`id`),
  ADD KEY `idPedido_parc_idx` (`idPedido`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `geolocation`
--
ALTER TABLE `geolocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parcelamento`
--
ALTER TABLE `parcelamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `geolocation`
--
ALTER TABLE `geolocation`
  ADD CONSTRAINT `idLocal_geo` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `parcelamento`
--
ALTER TABLE `parcelamento`
  ADD CONSTRAINT `idPedido_parc` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

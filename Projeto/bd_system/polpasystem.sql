-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 04-Dez-2019 às 23:08
-- Versão do servidor: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polpasystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cidade` varchar(255) DEFAULT 'São Paulo',
  `endereco` varchar(200) NOT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `senha` char(40) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `telefone` varchar(15) NOT NULL,
  `imagem` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id_usuario`, `nome`, `cpf`, `usuario`, `email`, `cidade`, `endereco`, `empresa`, `senha`, `flag`, `telefone`, `imagem`) VALUES
(1, 'Usuario de Teste', '999.999.999-99', 'Cliente', 'teste01@gmail.com', 'São Paulo', 'Rua Santa Cruz da Silvaa', 'DoceFeliz', 'c5c7d5ee3d61d57405741c1f2b6ad5e45e668e19', 0, '99-99999-9999', 'Imagem2.jpg'),
(2, 'Usuario de Teste ', '888.888.888-88', 'Adm', 'adm@gmail.comm', 'São Paulo', 'Rua santa luzia 365', 'Mercado Jobs ', '42ef63e7836ef622d9185c1a456051edf16095cc', 1, '88-88888-8888', 'user.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `assunto` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comentario` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `quantidade` int(3) NOT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `unidade` int(2) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id`, `nome`, `quantidade`, `preco`, `unidade`, `data`) VALUES
(6, 'Abacaxi ', 20, '11.00', 1, '2019-08-26 10:55:41'),
(8, 'Açai', 10, '15.00', 2, '2019-08-26 10:57:18'),
(9, 'Acerola', 10, '13.00', 1, '2019-08-26 10:57:42'),
(10, 'Uva', 20, '20.00', 20, '2019-08-26 11:46:41'),
(11, 'ABACAXI C/ HORTELÃ', 10, '12.00', 1, '2019-08-26 12:07:22'),
(12, 'AÇAÍ', 10, '15.50', 1, '2019-08-26 12:07:22'),
(13, 'ACEROLA', 10, '11.00', 1, '2019-08-26 12:07:22'),
(14, 'ACEROLA/LARANJA', 10, '12.00', 1, '2019-08-26 12:07:22'),
(15, 'AMORA', 10, '16.00', 1, '2019-08-26 12:07:22'),
(16, 'CACAU', 10, '15.50', 1, '2019-08-26 12:07:22'),
(17, 'CAJÁ', 10, '15.50', 1, '2019-08-26 12:07:22'),
(18, 'CAJU', 10, '11.00', 1, '2019-08-26 12:07:22'),
(19, 'COCO', 10, '15.50', 1, '2019-08-26 12:07:22'),
(20, 'CUPUAÇU', 10, '15.50', 1, '2019-08-26 12:07:22'),
(21, 'GOIABA', 10, '10.50', 1, '2019-08-26 12:07:22'),
(22, 'GRAVIOLA', 10, '15.50', 1, '2019-08-26 12:07:22'),
(23, 'KIWI', 10, '14.00', 1, '2019-08-26 12:07:22'),
(24, 'LIMÃO', 10, '10.50', 1, '2019-08-26 12:07:22'),
(25, 'MAMÃO', 10, '10.50', 1, '2019-08-26 12:07:22'),
(26, 'MANGA', 10, '11.00', 1, '2019-08-26 12:07:22'),
(27, 'MARACUJÁ', 10, '15.50', 1, '2019-08-26 12:07:22'),
(28, 'MELÃO', 10, '11.00', 1, '2019-08-26 12:07:22'),
(29, 'MELANCIA', 10, '11.00', 1, '2019-08-26 12:07:22'),
(30, 'MORANGO', 10, '13.50', 1, '2019-08-26 12:07:22'),
(31, 'PÊSSEGO', 10, '14.00', 1, '2019-08-26 12:07:22'),
(32, 'PITANGA', 10, '16.00', 1, '2019-08-26 12:07:22'),
(33, 'TAMARINDO', 10, '14.50', 1, '2019-08-26 12:07:22'),
(34, 'UMBU', 10, '14.50', 1, '2019-08-26 12:07:22'),
(35, 'UVA', 10, '12.00', 1, '2019-08-26 12:07:22'),
(36, 'VITAMINA MISTA - BANANA', 10, '12.00', 1, '2019-08-26 12:07:22'),
(37, 'VITAMINA MISTA - MAÇÃ', 10, '12.00', 1, '2019-08-26 12:07:22'),
(38, 'VITAMINA MISTA - MAMÃO', 10, '12.00', 1, '2019-08-26 12:07:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(255) NOT NULL,
  `nome_pedido` varchar(40) NOT NULL,
  `data_pedido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `valor_pedido` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status_pedido` varchar(100) DEFAULT 'Verificando pedido',
  `quantidade_pedido` int(11) NOT NULL,
  `observacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `troca`
--

CREATE TABLE `troca` (
  `id_troca` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `pedido` varchar(100) NOT NULL,
  `motivo_troca` longtext NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `obs_vendedor` varchar(255) NOT NULL,
  `telefone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedido_ibfk_1` (`id_usuario`);

--
-- Indexes for table `troca`
--
ALTER TABLE `troca`
  ADD PRIMARY KEY (`id_troca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `troca`
--
ALTER TABLE `troca`
  MODIFY `id_troca` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

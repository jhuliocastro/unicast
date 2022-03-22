-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Mar-2022 às 10:34
-- Versão do servidor: 10.6.5-MariaDB
-- versão do PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `erpcastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `pessoaContato` varchar(255) DEFAULT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `uf` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `rg` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_estoque`
--

DROP TABLE IF EXISTS `historico_estoque`;
CREATE TABLE IF NOT EXISTS `historico_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acao` int(11) NOT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nfe`
--

DROP TABLE IF EXISTS `nfe`;
CREATE TABLE IF NOT EXISTS `nfe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `chave` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` int(11) DEFAULT NULL,
  `ie` int(11) DEFAULT NULL,
  `emissao` date DEFAULT NULL,
  `tipoNFE` varchar(255) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras`
--

DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

DROP TABLE IF EXISTS `orcamentos`;
CREATE TABLE IF NOT EXISTS `orcamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `aberto` tinyint(1) DEFAULT 1,
  `faturado` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos_pedidos`
--

DROP TABLE IF EXISTS `orcamentos_pedidos`;
CREATE TABLE IF NOT EXISTS `orcamentos_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) DEFAULT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `precoVenda` float DEFAULT NULL,
  `precoCompra` float DEFAULT NULL,
  `unidadeMedida` varchar(255) DEFAULT NULL,
  `estoqueMinimo` int(11) DEFAULT NULL,
  `estoqueAtual` int(11) DEFAULT NULL,
  `codigoBarras` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produtos_nome_uindex` (`nome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nomeCompleto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_usuario_uindex` (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) DEFAULT NULL,
  `orcamento` int(11) DEFAULT NULL,
  `valorTotal` float DEFAULT NULL,
  `desconto` float DEFAULT NULL,
  `troco` float DEFAULT NULL,
  `valorPago` float DEFAULT NULL,
  `formaPagamento` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Adminer 4.8.1 MySQL 5.5.5-10.6.5-MariaDB dump

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
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

INSERT INTO `clientes` (`id`, `nome`, `pessoaContato`, `sexo`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`, `cpf`, `rg`, `telefone`, `email`, `created_at`, `updated_at`) VALUES
(1,	'JHULIO CESAR OLIVEIRA DE CASTR',	'',	'm',	'55819-750',	'pe',	'',	'',	'',	'',	'',	'113.286.244-20',	'',	'(81) 99631-3392',	'',	'2022-03-11 21:28:45',	'2022-03-11 21:28:45');

DROP TABLE IF EXISTS `historico_estoque`;
CREATE TABLE `historico_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acao` int(11) NOT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

INSERT INTO `historico_estoque` (`id`, `acao`, `produto`, `quantidade`, `created_at`, `updated_at`) VALUES
(1,	1,	2,	3,	'2022-03-05 18:36:55',	'2022-03-05 18:36:55'),
(2,	1,	2,	3,	'2022-03-05 18:37:18',	'2022-03-05 18:37:18'),
(3,	1,	2,	3,	'2022-03-05 18:38:52',	'2022-03-05 18:38:52'),
(4,	1,	2,	4,	'2022-03-09 04:12:54',	'2022-03-09 04:12:54'),
(5,	1,	2,	1,	'2022-03-11 17:42:26',	'2022-03-11 17:42:26');

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

INSERT INTO `log` (`id`, `evento`, `usuario`, `ip`, `created_at`, `updated_at`) VALUES
(1,	'ERRO LOGIN',	NULL,	'::1',	'2022-02-24 01:30:00',	'2022-02-24 01:30:00'),
(2,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 01:32:00',	'2022-02-24 01:32:00'),
(3,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 02:13:05',	'2022-02-24 02:13:05'),
(4,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 02:21:39',	'2022-02-24 02:21:39'),
(5,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 03:33:24',	'2022-02-24 03:33:24'),
(6,	'ERRO LOGIN',	NULL,	'::1',	'2022-02-24 03:54:28',	'2022-02-24 03:54:28'),
(7,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 03:55:08',	'2022-02-24 03:55:08'),
(8,	'DESLOGOU',	NULL,	'::1',	'2022-02-24 03:57:00',	'2022-02-24 03:57:00'),
(9,	'DESLOGOU',	NULL,	'::1',	'2022-02-24 03:57:28',	'2022-02-24 03:57:28'),
(10,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 03:58:16',	'2022-02-24 03:58:16'),
(11,	'DESLOGOU',	NULL,	'::1',	'2022-02-24 03:58:33',	'2022-02-24 03:58:33'),
(12,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 04:57:59',	'2022-02-24 04:57:59'),
(13,	'DESLOGOU',	NULL,	'::1',	'2022-02-24 05:26:43',	'2022-02-24 05:26:43'),
(14,	'ERRO LOGIN',	NULL,	'::1',	'2022-02-24 20:27:12',	'2022-02-24 20:27:12'),
(15,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-24 20:27:17',	'2022-02-24 20:27:17'),
(16,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:50:13',	'2022-02-24 21:50:13'),
(17,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:50:26',	'2022-02-24 21:50:26'),
(18,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:55:54',	'2022-02-24 21:55:54'),
(19,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:56:18',	'2022-02-24 21:56:18'),
(20,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:56:45',	'2022-02-24 21:56:45'),
(21,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'PRODUTO TESTE\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-02-24 21:58:50',	'2022-02-24 21:58:50'),
(22,	'ERRO CADASTRO DE PRODUTOS',	NULL,	'::1',	'2022-02-24 21:58:50',	'2022-02-24 21:58:50'),
(23,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-02-24 21:59:15',	'2022-02-24 21:59:15'),
(24,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-26 02:16:31',	'2022-02-26 02:16:31'),
(25,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-26 02:52:10',	'2022-02-26 02:52:10'),
(26,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-26 03:41:57',	'2022-02-26 03:41:57'),
(27,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-02-27 21:57:40',	'2022-02-27 21:57:40'),
(28,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-03 01:34:35',	'2022-03-03 01:34:35'),
(29,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-03 02:42:15',	'2022-03-03 02:42:15'),
(30,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-03 02:42:54',	'2022-03-03 02:42:54'),
(31,	'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'jhulio\' for key \'produtos_nome_uindex\'',	NULL,	'::1',	'2022-03-03 02:43:38',	'2022-03-03 02:43:38'),
(32,	'ERRO CADASTRO DE PRODUTOS',	NULL,	'::1',	'2022-03-03 02:43:38',	'2022-03-03 02:43:38'),
(33,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-03 02:43:47',	'2022-03-03 02:43:47'),
(34,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-03 03:05:16',	'2022-03-03 03:05:16'),
(35,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-03 03:35:28',	'2022-03-03 03:35:28'),
(36,	'ESTOQUE CADASTRADO',	NULL,	'::1',	'2022-03-05 18:38:52',	'2022-03-05 18:38:52'),
(37,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-06 04:00:56',	'2022-03-06 04:00:56'),
(38,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-06 04:12:59',	'2022-03-06 04:12:59'),
(39,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-06 04:41:12',	'2022-03-06 04:41:12'),
(40,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-07 23:07:33',	'2022-03-07 23:07:33'),
(41,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-08 05:48:08',	'2022-03-08 05:48:08'),
(42,	'ESTOQUE CADASTRADO',	NULL,	'::1',	'2022-03-09 04:12:54',	'2022-03-09 04:12:54'),
(43,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-11 15:10:18',	'2022-03-11 15:10:18'),
(44,	'USUÁRIO jhuliocastro LOGADO',	NULL,	'::1',	'2022-03-11 15:23:17',	'2022-03-11 15:23:17'),
(45,	'ESTOQUE CADASTRADO',	NULL,	'::1',	'2022-03-11 17:42:26',	'2022-03-11 17:42:26'),
(46,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-11 23:45:19',	'2022-03-11 23:45:19'),
(47,	'PRODUTO CADASTRADO',	NULL,	'::1',	'2022-03-13 06:34:02',	'2022-03-13 06:34:02');

DROP TABLE IF EXISTS `orcamentos`;
CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `aberto` tinyint(1) DEFAULT 1,
  `faturado` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

INSERT INTO `orcamentos` (`id`, `cliente`, `valor`, `aberto`, `faturado`, `created_at`, `updated_at`) VALUES
(1,	1,	0,	0,	0,	'2022-03-12 00:07:21',	'2022-03-12 00:17:33'),
(2,	1,	0,	0,	0,	'2022-03-12 00:17:43',	'2022-03-12 02:17:20'),
(3,	1,	0,	0,	0,	'2022-03-12 02:17:32',	'2022-03-12 02:17:36'),
(4,	1,	0,	0,	0,	'2022-03-12 02:18:17',	'2022-03-12 02:18:44'),
(5,	1,	0,	0,	0,	'2022-03-12 02:19:00',	'2022-03-12 03:13:17'),
(6,	1,	0,	0,	0,	'2022-03-12 03:13:27',	'2022-03-13 06:41:25'),
(7,	1,	0,	0,	0,	'2022-03-13 06:41:33',	'2022-03-13 20:13:14'),
(8,	1,	0,	0,	0,	'2022-03-13 20:13:21',	'2022-03-13 20:22:49'),
(9,	1,	0,	0,	0,	'2022-03-13 20:22:51',	'2022-03-13 20:23:32'),
(10,	1,	0,	0,	0,	'2022-03-13 20:23:37',	'2022-03-13 21:25:47'),
(11,	1,	0,	0,	0,	'2022-03-13 21:58:40',	'2022-03-13 21:58:56'),
(12,	1,	0,	0,	0,	'2022-03-13 22:11:08',	'2022-03-13 22:11:16'),
(13,	1,	0,	0,	0,	'2022-03-13 22:11:46',	'2022-03-13 22:11:53'),
(14,	1,	0,	0,	0,	'2022-03-13 22:12:23',	'2022-03-13 22:12:31'),
(15,	1,	173.8,	0,	0,	'2022-03-13 22:13:28',	'2022-03-14 00:04:02'),
(16,	1,	7.9,	0,	0,	'2022-03-14 00:03:10',	'2022-03-14 00:04:15'),
(17,	1,	39.5,	0,	0,	'2022-03-14 00:03:58',	'2022-03-14 00:04:32'),
(18,	1,	0,	0,	0,	'2022-03-14 00:04:08',	'2022-03-14 00:19:41'),
(19,	1,	0,	0,	0,	'2022-03-14 00:04:25',	'2022-03-14 00:19:46'),
(20,	1,	0,	0,	0,	'2022-03-14 00:07:35',	'2022-03-14 00:19:51'),
(21,	1,	0,	0,	0,	'2022-03-14 00:10:44',	'2022-03-14 00:19:57'),
(22,	1,	0,	0,	0,	'2022-03-14 00:22:49',	'2022-03-14 00:45:38'),
(23,	1,	15.8,	0,	0,	'2022-03-14 00:22:52',	'2022-03-14 00:24:18'),
(24,	1,	63.2,	0,	0,	'2022-03-14 00:25:47',	'2022-03-14 00:44:09'),
(25,	1,	0,	0,	0,	'2022-03-14 00:45:12',	'2022-03-14 00:45:28');

DROP TABLE IF EXISTS `orcamentos_pedidos`;
CREATE TABLE `orcamentos_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orcamento` int(11) DEFAULT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

INSERT INTO `orcamentos_pedidos` (`id`, `orcamento`, `produto`, `quantidade`, `created_at`, `updated_at`) VALUES
(1,	7,	11,	1,	'2022-03-13 19:24:17',	'2022-03-13 19:24:17'),
(2,	7,	11,	1,	'2022-03-13 19:24:34',	'2022-03-13 19:24:34'),
(3,	7,	11,	7,	'2022-03-13 19:24:58',	'2022-03-13 19:24:58'),
(4,	7,	11,	1,	'2022-03-13 19:25:09',	'2022-03-13 19:25:09'),
(5,	7,	11,	1,	'2022-03-13 19:48:00',	'2022-03-13 19:48:00'),
(6,	7,	11,	2,	'2022-03-13 19:50:33',	'2022-03-13 19:50:33'),
(7,	7,	11,	6,	'2022-03-13 20:03:13',	'2022-03-13 20:03:13'),
(8,	8,	11,	1,	'2022-03-13 20:13:27',	'2022-03-13 20:13:27'),
(9,	8,	11,	1,	'2022-03-13 20:18:45',	'2022-03-13 20:18:45'),
(10,	8,	11,	2,	'2022-03-13 20:19:40',	'2022-03-13 20:19:40'),
(11,	8,	11,	1,	'2022-03-13 20:20:33',	'2022-03-13 20:20:33'),
(12,	8,	11,	1,	'2022-03-13 20:21:12',	'2022-03-13 20:21:12'),
(13,	8,	11,	1,	'2022-03-13 20:22:02',	'2022-03-13 20:22:02'),
(14,	10,	11,	1,	'2022-03-13 20:34:16',	'2022-03-13 20:34:16'),
(15,	10,	11,	2,	'2022-03-13 20:34:25',	'2022-03-13 20:34:25'),
(16,	10,	11,	2,	'2022-03-13 20:34:26',	'2022-03-13 20:34:26'),
(17,	10,	11,	1,	'2022-03-13 20:35:00',	'2022-03-13 20:35:00'),
(18,	10,	11,	1,	'2022-03-13 20:36:09',	'2022-03-13 20:36:09'),
(19,	10,	11,	1,	'2022-03-13 20:36:26',	'2022-03-13 20:36:26'),
(20,	10,	11,	1,	'2022-03-13 20:42:52',	'2022-03-13 20:42:52'),
(21,	10,	11,	1,	'2022-03-13 20:43:50',	'2022-03-13 20:43:50'),
(22,	10,	11,	1,	'2022-03-13 20:46:28',	'2022-03-13 20:46:28'),
(23,	10,	11,	1,	'2022-03-13 20:47:00',	'2022-03-13 20:47:00'),
(24,	10,	11,	1,	'2022-03-13 20:49:51',	'2022-03-13 20:49:51'),
(25,	10,	11,	1,	'2022-03-13 20:50:26',	'2022-03-13 20:50:26'),
(26,	10,	11,	1,	'2022-03-13 20:50:35',	'2022-03-13 20:50:35'),
(27,	10,	11,	1,	'2022-03-13 20:50:57',	'2022-03-13 20:50:57'),
(28,	10,	11,	1,	'2022-03-13 20:51:27',	'2022-03-13 20:51:27'),
(29,	10,	11,	1,	'2022-03-13 20:51:30',	'2022-03-13 20:51:30'),
(30,	10,	11,	1,	'2022-03-13 20:52:06',	'2022-03-13 20:52:06'),
(31,	10,	11,	1,	'2022-03-13 20:52:59',	'2022-03-13 20:52:59'),
(32,	10,	11,	1,	'2022-03-13 20:53:04',	'2022-03-13 20:53:04'),
(33,	10,	11,	1,	'2022-03-13 20:53:15',	'2022-03-13 20:53:15'),
(34,	10,	11,	1,	'2022-03-13 20:53:33',	'2022-03-13 20:53:33'),
(35,	10,	11,	8,	'2022-03-13 20:54:21',	'2022-03-13 20:54:21'),
(36,	11,	11,	10,	'2022-03-13 21:58:53',	'2022-03-13 21:58:53'),
(37,	12,	11,	2,	'2022-03-13 22:11:14',	'2022-03-13 22:11:14'),
(38,	13,	11,	1,	'2022-03-13 22:11:50',	'2022-03-13 22:11:50'),
(39,	14,	11,	1,	'2022-03-13 22:12:29',	'2022-03-13 22:12:29'),
(40,	15,	11,	20,	'2022-03-13 22:13:53',	'2022-03-13 22:13:53'),
(41,	15,	11,	2,	'2022-03-13 22:18:54',	'2022-03-13 22:18:54'),
(42,	16,	11,	1,	'2022-03-14 00:04:13',	'2022-03-14 00:04:13'),
(43,	17,	11,	5,	'2022-03-14 00:04:30',	'2022-03-14 00:04:30'),
(44,	23,	11,	2,	'2022-03-14 00:24:11',	'2022-03-14 00:24:11'),
(45,	24,	11,	1,	'2022-03-14 00:43:53',	'2022-03-14 00:43:53'),
(46,	24,	11,	7,	'2022-03-14 00:44:07',	'2022-03-14 00:44:07');

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
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

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `precoVenda`, `precoCompra`, `unidadeMedida`, `estoqueMinimo`, `estoqueAtual`, `codigoBarras`, `created_at`, `updated_at`) VALUES
(2,	'PRODUTO TESTE',	'',	10.2,	10.2,	'UN',	1,	30,	NULL,	'2022-02-24 21:56:43',	'2022-03-11 17:42:26'),
(3,	'ESPATULA',	'',	2,	2,	'UN',	1,	1,	NULL,	'2022-02-24 21:59:15',	'2022-02-24 21:59:15'),
(4,	'etset',	'TESTE',	20,	20,	'UN',	1,	0,	NULL,	'2022-03-03 02:42:14',	'2022-03-03 02:42:14'),
(5,	'jhulio',	'tesr',	20,	20,	'UN',	1,	0,	NULL,	'2022-03-03 02:42:54',	'2022-03-03 02:42:54'),
(6,	'TESTE',	'DSADASD',	10,	20,	'UN',	1,	0,	NULL,	'2022-03-03 02:43:47',	'2022-03-03 02:43:47'),
(7,	'testeffffff',	'dsfsdfds',	324.1,	10,	'UN',	1,	20,	NULL,	'2022-03-03 03:05:16',	'2022-03-03 03:05:16'),
(8,	'TESTE FINAL',	'DESCRI TEST3 I',	10,	19.2,	'UN',	1,	3,	NULL,	'2022-03-07 23:07:33',	'2022-03-07 23:07:33'),
(9,	NULL,	NULL,	0,	0,	NULL,	0,	0,	NULL,	'2022-03-08 05:48:08',	'2022-03-08 05:48:08'),
(10,	NULL,	NULL,	0,	0,	NULL,	0,	0,	NULL,	'2022-03-11 23:45:19',	'2022-03-11 23:45:19'),
(11,	'ESPATULA TESTE',	'',	7.9,	4,	'UN',	1,	0,	'254514556314545215341',	'2022-03-13 06:34:02',	'2022-03-13 06:34:02');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nomeCompleto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_usuario_uindex` (`usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nomeCompleto`, `created_at`, `updated_at`) VALUES
(1,	'jhuliocastro',	'67046763505c60c4abcda5df9e2c155a',	'JHULIO CESAR OLIVEIRA DE CASTRO',	NULL,	NULL);

-- 2022-03-14 11:49:53

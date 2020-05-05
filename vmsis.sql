-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 05/05/2020 às 20:02
-- Versão do servidor: 5.6.41-84.1
-- Versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vmsys_vm`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_admin`
--

CREATE TABLE `ci_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_verify` tinyint(4) NOT NULL DEFAULT '1',
  `is_admin` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `is_supper` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `contrato` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `ci_admin`
--

INSERT INTO `ci_admin` (`admin_id`, `admin_role_id`, `username`, `firstname`, `lastname`, `email`, `mobile_no`, `image`, `password`, `last_login`, `is_verify`, `is_admin`, `is_active`, `is_supper`, `token`, `password_reset_code`, `last_ip`, `contrato`, `created_at`, `updated_at`) VALUES
(31, 1, 'superadmin33', 'Rafael', 'Benetti', 'marketing@altechindustria.com.br', '47997799705', '', '$2y$10$3h721xTsJbI6WX0/oS4n.eVFAvsfcZ1vIIMnoDROrbBBOrlLCg86y', '0000-00-00 00:00:00', 1, 1, 1, 1, '', '', '', '', '2019-01-16 06:01:58', '2020-01-23 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_admin_roles`
--

CREATE TABLE `ci_admin_roles` (
  `admin_role_id` int(11) NOT NULL,
  `admin_role_title` varchar(30) CHARACTER SET utf8 NOT NULL,
  `admin_role_status` int(11) NOT NULL,
  `admin_role_created_by` int(1) NOT NULL,
  `admin_role_created_on` datetime NOT NULL,
  `admin_role_modified_by` int(11) NOT NULL,
  `admin_role_modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `ci_admin_roles`
--

INSERT INTO `ci_admin_roles` (`admin_role_id`, `admin_role_title`, `admin_role_status`, `admin_role_created_by`, `admin_role_created_on`, `admin_role_modified_by`, `admin_role_modified_on`) VALUES
(1, 'Super Admin', 1, 0, '2018-03-15 12:48:04', 0, '2018-03-17 12:53:16'),
(2, 'Cliente', 1, 0, '2018-03-15 12:53:19', 0, '2020-02-28 01:40:59'),
(4, 'Operador', 1, 0, '2018-03-16 05:52:45', 0, '2020-01-22 12:24:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_calendar`
--

CREATE TABLE `ci_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(126) DEFAULT NULL,
  `description` text,
  `color` varchar(24) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(64) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_catfin`
--

CREATE TABLE `ci_catfin` (
  `id` int(11) NOT NULL,
  `categorias` varchar(50) NOT NULL,
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_clientes`
--

CREATE TABLE `ci_clientes` (
  `id` int(11) NOT NULL,
  `clienteusername` varchar(50) NOT NULL,
  `clientename` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fone` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_verify` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_estoque_itens`
--

CREATE TABLE `ci_estoque_itens` (
  `id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `maq_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tipo_operacao` enum('entrada','saida') NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Fazendo dump de dados para tabela `ci_estoque_itens`
--

INSERT INTO `ci_estoque_itens` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`) VALUES
(20, 5000, 81, 0, 31, '2020-05-04 00:00:00', '2020-05-04 00:00:00', 'entrada'),
(21, -30, 81, 0, 31, '2020-05-05 05:53:45', '2020-05-05 05:53:45', 'saida'),
(22, -30, 81, 0, 31, '2020-05-05 05:54:01', '2020-05-05 05:54:01', 'saida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_estoque_machine`
--

CREATE TABLE `ci_estoque_machine` (
  `id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `maq_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tipo_operacao` enum('entrada','saida') NOT NULL DEFAULT 'entrada',
  `id_operacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Fazendo dump de dados para tabela `ci_estoque_machine`
--

INSERT INTO `ci_estoque_machine` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`, `id_operacao`) VALUES
(62, -12, 75, 46, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 53),
(63, -11, 76, 43, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 54),
(64, -1, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 55),
(65, 0, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 56),
(66, 0, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 57),
(67, -1, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 58),
(68, -5, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 59),
(69, -10, 75, 44, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 60),
(70, 100, 76, 43, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'entrada', 0),
(71, 100, 76, 43, 31, '2020-04-28 00:00:00', '2020-04-28 00:00:00', 'saida', 0),
(72, 100, 76, 43, 31, '2020-04-29 00:00:00', '2020-04-29 00:00:00', 'saida', 0),
(73, 100, 76, 43, 31, '2020-04-29 00:00:00', '2020-04-29 00:00:00', 'saida', 0),
(74, 100, 76, 43, 31, '2020-04-29 00:00:00', '2020-04-29 00:00:00', 'saida', 0),
(75, -100, 76, 43, 31, '2020-04-29 00:00:00', '2020-04-29 00:00:00', 'saida', 0),
(76, -500, 76, 43, 31, '2020-04-29 00:00:00', '2020-04-29 00:00:00', 'saida', 0),
(77, 100, 75, 46, 31, '2020-04-30 00:00:00', '2020-04-30 00:00:00', 'entrada', 0),
(78, 30, 81, 48, 31, '2020-05-05 05:53:45', '2020-05-05 05:53:45', 'entrada', 0),
(79, 30, 81, 47, 31, '2020-05-05 05:54:01', '2020-05-05 05:54:01', 'entrada', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_financeiro`
--

CREATE TABLE `ci_financeiro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `data` varchar(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipopgto` varchar(255) NOT NULL,
  `tipo_entrada` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_admin` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_general_settings`
--

CREATE TABLE `ci_general_settings` (
  `id` int(11) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `application_name` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `copyright` tinytext,
  `email_from` varchar(100) NOT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `google_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `recaptcha_site_key` varchar(255) DEFAULT NULL,
  `recaptcha_lang` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `ci_general_settings`
--

INSERT INTO `ci_general_settings` (`id`, `favicon`, `logo`, `application_name`, `timezone`, `currency`, `copyright`, `email_from`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `facebook_link`, `twitter_link`, `google_link`, `youtube_link`, `linkedin_link`, `instagram_link`, `recaptcha_secret_key`, `recaptcha_site_key`, `recaptcha_lang`, `created_date`, `updated_date`) VALUES
(1, 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'VM System', 'America/Sao_Paulo', 'BRL', 'Copyright © 2019 Altech All rights reserved.', 'marketing@altechindustria.com', 'mail.altechindustria.com', 25, 'marketing@altechindustria.com', 'pipoca123', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'https://youtube.com', 'https://linkedin.com', 'https://instagram.com', '6Lf8Pt0UAAAAALo_d1yxGKGt2AB6maRn8PXK1HlK', '6Lf8Pt0UAAAAALswA1YgTTK7rd65Br8a-Tp-pqGh', 'pt-BR', '2020-03-18 05:03:09', '2020-03-18 05:03:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_itens`
--

CREATE TABLE `ci_itens` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `quantidade` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `ci_itens`
--

INSERT INTO `ci_itens` (`id`, `item`, `quantidade`, `valor`, `is_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(81, 'Urso Comum', '', '5.00', 0, 1, '2020-05-04 00:00:00', '2020-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_machines`
--

CREATE TABLE `ci_machines` (
  `id` int(11) NOT NULL,
  `tipomaquina` int(11) NOT NULL DEFAULT '0',
  `pontodevenda` int(30) NOT NULL,
  `serial` int(30) NOT NULL,
  `cont_inicial` int(50) NOT NULL,
  `cont_saida_inicial` int(11) NOT NULL,
  `valorvenda` decimal(10,2) NOT NULL,
  `imagem` text NOT NULL,
  `noteiro` enum('0','1') NOT NULL,
  `ficheiro` enum('0','1') NOT NULL,
  `observacoes_equip` text NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `nome_imagem` varchar(128) DEFAULT NULL,
  `qtde_insumos` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `ci_machines`
--

INSERT INTO `ci_machines` (`id`, `tipomaquina`, `pontodevenda`, `serial`, `cont_inicial`, `cont_saida_inicial`, `valorvenda`, `imagem`, `noteiro`, `ficheiro`, `observacoes_equip`, `is_active`, `created_at`, `updated_at`, `nome_imagem`, `qtde_insumos`, `item_id`) VALUES
(47, 73, 45, 1212, 0, 0, '500.00', '', '1', '1', 'teste', '1', '2020-05-04 00:00:00', '2020-05-05 05:05:44', 'contador_inicial_47.jpg', 0, 81),
(48, 74, 45, 1010, 1, 0, '5.00', '', '1', '1', 'teste', '1', '2020-05-05 05:52:22', '2020-05-05 05:52:22', 'contador_inicial_48.png', 0, 81);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_operacoes`
--

CREATE TABLE `ci_operacoes` (
  `id` int(11) NOT NULL,
  `maq_id` int(11) NOT NULL,
  `cont_anterior` int(11) NOT NULL,
  `cont_atual` int(11) NOT NULL,
  `cont_saida_anterior` int(11) NOT NULL,
  `cont_saida_atual` int(11) NOT NULL,
  `vendas` varchar(50) NOT NULL,
  `qnt_vendas` varchar(50) NOT NULL,
  `saldo` varchar(50) NOT NULL,
  `imagem` text NOT NULL,
  `imagem_cont_saida` text NOT NULL,
  `status_op` text NOT NULL,
  `observacoes_equip` text NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ponto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `qtde_saida` int(11) NOT NULL DEFAULT '0',
  `valor_insumo` double NOT NULL DEFAULT '0',
  `saidas` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_pontos`
--

CREATE TABLE `ci_pontos` (
  `id` int(11) NOT NULL,
  `ponto` varchar(50) NOT NULL,
  `nomefan` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comissao` int(50) NOT NULL,
  `responsavel` varchar(30) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `bairro` varchar(256) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `tipo_comissao` enum('percentual','valor') NOT NULL DEFAULT 'valor'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `ci_pontos`
--

INSERT INTO `ci_pontos` (`id`, `ponto`, `nomefan`, `email`, `comissao`, `responsavel`, `telefone`, `endereco`, `numero`, `cidade`, `estado`, `latitude`, `longitude`, `is_admin`, `is_active`, `created_at`, `updated_at`, `bairro`, `cep`, `tipo_comissao`) VALUES
(45, 'Shopping', 'Andorinhas', 'teste@teste.com', 10, 'Rafa', '(37) 73738-3838', 'Rua Dionísio Moraes', '174', 'Sapucaia do Sul', 'RS', '-29.8387232', '-51.1277841', 0, 1, '2020-05-04 00:00:00', '2020-05-05 08:05:18', 'Ipiranga', '93230-450', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_tipos`
--

CREATE TABLE `ci_tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `nome_imagem` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `ci_tipos`
--

INSERT INTO `ci_tipos` (`id`, `tipo`, `is_admin`, `is_active`, `created_at`, `updated_at`, `nome_imagem`) VALUES
(73, 'Grua Unicórnio', 0, 1, '2020-05-04 00:00:00', '2020-05-04 00:00:00', 'WhatsApp Image 2020-04-21 at 14.32.17.jpeg'),
(74, 'Grua Vintage', 0, 1, '2020-05-05 05:05:13', '2020-05-05 05:05:13', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_users`
--

CREATE TABLE `ci_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_verify` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `profile_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_users_machines`
--

CREATE TABLE `ci_users_machines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `maq_id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_users_pontos`
--

CREATE TABLE `ci_users_pontos` (
  `id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_user_profile`
--

CREATE TABLE `ci_user_profile` (
  `id` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `perfil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Fazendo dump de dados para tabela `ci_user_profile`
--

INSERT INTO `ci_user_profile` (`id`, `nome`, `perfil_id`) VALUES
(1, 'Usuario', 1),
(2, 'Operador', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `controller_name` varchar(255) NOT NULL,
  `fa_icon` varchar(100) NOT NULL,
  `operation` text NOT NULL,
  `sort_order` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `controller_name`, `fa_icon`, `operation`, `sort_order`) VALUES
(1, 'Admin List', 'admin', '', 'view|add|edit|delete|change_status|access', 0),
(2, 'Role & Permissions', 'admin_roles', '', 'view|add|edit|delete|change_status|access', 0),
(3, 'User Manage', 'users', '', 'view|add|edit|delete|change_status|access', 0),
(7, 'Export', 'export', '', 'access', 0),
(8, 'General Settings', 'general_settings', '', 'view|add|edit|delete|change_status|access', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `module_access`
--

CREATE TABLE `module_access` (
  `id` int(11) NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `operation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `module_access`
--

INSERT INTO `module_access` (`id`, `admin_role_id`, `module`, `operation`) VALUES
(0, 2, 'users', 'view'),
(1, 1, 'users', 'view'),
(2, 1, 'users', 'add'),
(3, 1, 'users', 'edit'),
(5, 1, 'users', 'access'),
(6, 1, 'users', 'change_status'),
(7, 1, 'export', 'access'),
(8, 1, 'general_settings', 'view'),
(9, 1, 'general_settings', 'add'),
(10, 1, 'general_settings', 'edit'),
(11, 1, 'general_settings', 'access'),
(12, 1, 'admin_roles', 'view'),
(13, 1, 'admin_roles', 'change_status'),
(14, 1, 'admin', 'change_status'),
(15, 1, 'admin', 'view'),
(16, 1, 'admin', 'add'),
(17, 1, 'admin', 'access'),
(18, 1, 'admin_roles', 'add'),
(19, 1, 'admin_roles', 'access'),
(20, 1, 'admin_roles', 'edit'),
(21, 1, 'admin', 'edit'),
(22, 1, 'admin', 'delete'),
(23, 1, 'admin_roles', 'delete'),
(24, 1, 'users', 'delete'),
(25, 1, 'clientes', 'view'),
(26, 1, 'clientes', 'add'),
(27, 1, 'clientes', 'edit'),
(28, 1, 'clientes', 'access'),
(29, 1, 'clientes', 'change_status');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `ci_admin`
--
ALTER TABLE `ci_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices de tabela `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  ADD PRIMARY KEY (`admin_role_id`);

--
-- Índices de tabela `ci_calendar`
--
ALTER TABLE `ci_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_catfin`
--
ALTER TABLE `ci_catfin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_clientes`
--
ALTER TABLE `ci_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_estoque_itens`
--
ALTER TABLE `ci_estoque_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_itens`
--
ALTER TABLE `ci_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_machines`
--
ALTER TABLE `ci_machines`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `nomedamaquina` (`cont_inicial`);

--
-- Índices de tabela `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `ci_pontos`
--
ALTER TABLE `ci_pontos`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `ponto` (`ponto`);

--
-- Índices de tabela `ci_tipos`
--
ALTER TABLE `ci_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Índices de tabela `module_access`
--
ALTER TABLE `module_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoleId` (`admin_role_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `ci_admin`
--
ALTER TABLE `ci_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  MODIFY `admin_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ci_calendar`
--
ALTER TABLE `ci_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `ci_catfin`
--
ALTER TABLE `ci_catfin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `ci_clientes`
--
ALTER TABLE `ci_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `ci_estoque_itens`
--
ALTER TABLE `ci_estoque_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ci_itens`
--
ALTER TABLE `ci_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `ci_machines`
--
ALTER TABLE `ci_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `ci_pontos`
--
ALTER TABLE `ci_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `ci_tipos`
--
ALTER TABLE `ci_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

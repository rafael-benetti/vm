-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2020 às 18:12
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vmsis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_admin`
--

CREATE TABLE `ci_admin` (
  `id` int(11) NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_verify` tinyint(4) NOT NULL DEFAULT 1,
  `is_admin` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_supper` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `contrato` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_admin`
--

INSERT INTO `ci_admin` (`id`, `admin_role_id`, `username`, `firstname`, `lastname`, `email`, `mobile_no`, `image`, `password`, `last_login`, `is_verify`, `is_admin`, `is_active`, `is_supper`, `token`, `password_reset_code`, `last_ip`, `contrato`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin', 'Rafael sddd', 'Benetti5555', 'marketing@altechindustria.com.br', '47997799705', '', '$2y$10$3h721xTsJbI6WX0/oS4n.eVFAvsfcZ1vIIMnoDROrbBBOrlLCg86y', '0000-00-00 00:00:00', 1, 1, 1, 1, '', '', '', '', '2019-01-16 06:01:58', '2020-05-22 00:00:00'),
(32, 1, 'jeronimo', 'jeronimo', 'cardoso', 'jeronimo.alvescardoso@gmail.com', '(11) 97229-6726', '', '$2y$10$8KONhbfhgGgCak/DtxDR..L5PTqAXaDfG0s8Bc.NPTQGS6Svi6qh6', '0000-00-00 00:00:00', 1, 1, 1, 0, '', '', '', '', '2020-05-14 00:00:00', '2020-05-14 00:00:00'),
(33, 2, 'operador', 'operador', 'operador', 'operador@operador.com', '123456789', '', '$2y$10$iBuwZReVl3sCSJAI3mfIU.tjtusJbTHZlxnRmP6o0vStzKHp0oHJi', '0000-00-00 00:00:00', 1, 1, 1, 0, '', '', '', '', '2020-05-14 00:00:00', '2020-05-14 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_admin_roles`
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
-- Extraindo dados da tabela `ci_admin_roles`
--

INSERT INTO `ci_admin_roles` (`admin_role_id`, `admin_role_title`, `admin_role_status`, `admin_role_created_by`, `admin_role_created_on`, `admin_role_modified_by`, `admin_role_modified_on`) VALUES
(1, 'Super Admin', 1, 0, '2018-03-15 12:48:04', 0, '2018-03-17 12:53:16'),
(2, 'Operador', 1, 0, '2018-03-16 05:52:45', 0, '2020-01-22 12:24:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_calendar`
--

CREATE TABLE `ci_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(126) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(24) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(64) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_calendar`
--

INSERT INTO `ci_calendar` (`id`, `title`, `description`, `color`, `start_date`, `end_date`, `create_at`, `create_by`, `modified_at`, `modified_by`) VALUES
(36, 'Accusantium totam oc', 'At ut cum rerum dese', '#FF8C00', '2020-05-01', '2020-05-15', '2020-05-21 01:33:01', NULL, NULL, NULL),
(37, 'a', 'a', '#FF0000', '0000-00-00', '0000-00-00', '2020-05-21 01:35:34', NULL, NULL, NULL),
(38, 'Quo earum qui et seq', 'Eu labore et ut adip', '#FF0000', '2020-05-19', '2020-05-27', '2020-05-21 01:35:49', NULL, NULL, NULL),
(39, 'Vel est aperiam culp', 'Aut similique in obc', '#FF8C00', '2020-04-27', '2020-04-28', '2020-05-21 01:35:57', NULL, '2020-05-21 01:36:07', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_catfin`
--

CREATE TABLE `ci_catfin` (
  `id` int(11) NOT NULL,
  `categorias` varchar(50) NOT NULL,
  `is_admin` int(11) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_catfin`
--

INSERT INTO `ci_catfin` (`id`, `categorias`, `is_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(76, 'teste', 0, 1, '2020-04-11 07:04:44', '2020-04-11 07:04:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_clientes`
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
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_verify` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_estoque_itens`
--

CREATE TABLE `ci_estoque_itens` (
  `id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `maq_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tipo_operacao` enum('entrada','saida') NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_estoque_itens`
--

INSERT INTO `ci_estoque_itens` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`) VALUES
(28, -10, 0, 0, 33, '2020-05-17 00:00:00', '2020-05-17 00:00:00', 'saida'),
(29, 500, 83, 0, 31, '2020-05-18 00:00:00', '2020-05-18 00:00:00', 'entrada'),
(30, -10, 83, 0, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida'),
(31, -100, 83, 0, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida'),
(32, -90, 83, 0, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida'),
(33, -10, 83, 0, 31, '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'saida'),
(34, -100, 84, 0, 31, '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'saida'),
(35, -25, 84, 0, 1, '2020-05-22 00:00:00', '2020-05-22 00:00:00', 'saida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_estoque_machine`
--

CREATE TABLE `ci_estoque_machine` (
  `id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `maq_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tipo_operacao` enum('entrada','saida') NOT NULL DEFAULT 'entrada',
  `id_operacao` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_estoque_machine`
--

INSERT INTO `ci_estoque_machine` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`, `id_operacao`) VALUES
(86, 10, 0, 57, 33, '2020-05-17 00:00:00', '2020-05-17 00:00:00', 'entrada', 0),
(87, 10, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'entrada', 0),
(88, -10, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida', 66),
(89, -30, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida', 67),
(90, 100, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'entrada', 0),
(91, -40, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'saida', 68),
(92, 90, 83, 57, 33, '2020-05-19 00:00:00', '2020-05-19 00:00:00', 'entrada', 0),
(93, 10, 83, 74, 31, '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'entrada', 0),
(94, 100, 84, 76, 31, '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'entrada', 0),
(95, 25, 84, 76, 1, '2020-05-22 00:00:00', '2020-05-22 00:00:00', 'entrada', 0),
(96, -10, 83, 74, 33, '2020-05-25 00:00:00', '2020-05-25 00:00:00', 'saida', 70);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_financeiro`
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
-- Estrutura da tabela `ci_general_settings`
--

CREATE TABLE `ci_general_settings` (
  `id` int(11) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `proprietario` varchar(128) NOT NULL,
  `application_name` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `copyright` tinytext DEFAULT NULL,
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
-- Extraindo dados da tabela `ci_general_settings`
--

INSERT INTO `ci_general_settings` (`id`, `favicon`, `logo`, `proprietario`, `application_name`, `timezone`, `currency`, `copyright`, `email_from`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `facebook_link`, `twitter_link`, `google_link`, `youtube_link`, `linkedin_link`, `instagram_link`, `recaptcha_secret_key`, `recaptcha_site_key`, `recaptcha_lang`, `created_date`, `updated_date`) VALUES
(1, 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'Altech Indústria', 'VM System', 'America/Sao_Paulo', 'BRL', 'Copyright © 2019 Altech All rights reserved.', 'marketing@altechindustria.com', 'mail.altechindustria.com', 25, 'marketing@altechindustria.com', 'pipoca123', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'https://youtube.com', 'https://linkedin.com', 'https://instagram.com', '6Lf8Pt0UAAAAALo_d1yxGKGt2AB6maRn8PXK1HlK', '6Lf8Pt0UAAAAALswA1YgTTK7rd65Br8a-Tp-pqGh', 'pt-BR', '2020-05-13 00:00:00', '2020-05-13 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_itens`
--

CREATE TABLE `ci_itens` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `quantidade` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `is_admin` int(11) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_itens`
--

INSERT INTO `ci_itens` (`id`, `item`, `quantidade`, `valor`, `is_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(83, 'Ursinho Comum', '-500', '4.50', 0, 1, '2020-05-08 08:05:11', '2020-05-08 08:05:11'),
(84, 'Ursinho Prêmium', '', '8.50', 33, 1, '2020-05-08 08:05:31', '2020-05-08 08:05:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_machines`
--

CREATE TABLE `ci_machines` (
  `id` int(11) NOT NULL,
  `tipomaquina` int(11) NOT NULL DEFAULT 0,
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
  `qtde_insumos` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `nome_imagem_analogico` varchar(256) DEFAULT NULL,
  `valordoequipamento` double NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_machines`
--

INSERT INTO `ci_machines` (`id`, `tipomaquina`, `pontodevenda`, `serial`, `cont_inicial`, `cont_saida_inicial`, `valorvenda`, `imagem`, `noteiro`, `ficheiro`, `observacoes_equip`, `is_active`, `created_at`, `updated_at`, `nome_imagem`, `qtde_insumos`, `item_id`, `nome_imagem_analogico`, `valordoequipamento`) VALUES
(57, 80, 0, 1234, 0, 0, '10.00', '', '1', '1', 'teste', '1', '2020-05-17 00:00:00', '2020-05-17 00:00:00', 'contador_inicial_57.jpg', 0, 83, NULL, 0),
(58, 80, 0, 987654789, 10, 10, '100.00', '', '1', '0', 'sssssss', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_58.jpg', 0, 83, 'contador_inicial_58.jpg', 0),
(59, 80, 51, 123, 1, 1, '10.00', '', '0', '0', 'ssss', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_59.jpg', 0, 0, 'contador_inicial_59.jpg', 0),
(60, 80, 0, 125412, 1, 1, '1.00', '', '1', '0', 'xxxxxxx', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_60.jpg', 0, 0, 'contador_inicial_60.jpg', 0),
(61, 80, 0, 12541254, 1, 1, '1.00', '', '1', '1', 'aaaa', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_61.jpg', 0, 0, 'contador_inicial_61.jpg', 0),
(62, 80, 51, 123456987, 2, 3, '1.00', '', '1', '1', 'ssssss', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_62.jpg', 0, 0, 'contador_inicial_62.jpg', 0),
(63, 80, 0, 1254521, 1, 1, '1.00', '', '0', '0', 'sssss', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', NULL, 0, 0, 'contador_analogico_63.jpg', 1),
(64, 80, 0, 2, 2, 2, '2.00', '', '0', '0', '', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'contador_inicial_64.jpg', 0, 0, 'contador_inicial_64.jpg', 2),
(65, 80, 0, 1, 1, 1, '1.00', '', '0', '0', '1', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', NULL, 0, 0, NULL, 11),
(66, 79, 51, 2147483647, 1, 1, '1.00', '', '0', '0', 'xxxxxxxx', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', NULL, 0, 0, NULL, 1),
(67, 80, 0, 123456, 123456, 123456, '12.00', '', '0', '0', 'xxxxxx', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', NULL, 0, 0, NULL, 12.34),
(68, 80, 0, 125632, 12, 12, '12.00', '', '0', '0', 'zzzzzzz', '0', '2020-05-20 00:00:00', '2020-05-20 00:00:00', '1.jpg', 0, 0, '11.jpg', 12),
(69, 80, 0, 2147483647, 1, 1, '1.00', '', '0', '0', '1', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'cont_inicial_69', 0, 0, 'cont_analogico_69', 1),
(70, 80, 0, 12585236, 1, 1, '1.00', '', '0', '0', 'sssssss', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'file_cont_inicial_.jpg', 0, 0, 'file_cont_inicial_1.jpg', 1),
(71, 80, 0, 125452136, 1, 1, '1.00', '', '0', '0', '1', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', NULL, 0, 0, NULL, 1),
(72, 80, 0, 1254521545, 1, 1, '1.00', '', '0', '0', 'aaa', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'file_cont_inicial_.jpg', 0, 83, 'file_cont_inicial_1.jpg', 1),
(73, 80, 0, 2147483647, 1, 1, '1.00', '', '0', '0', 'xxxxxx', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'file_cont_inicial_73.jpg', 0, 0, 'file_cont_inicial_73.jpg', 1),
(74, 80, 51, 2147483647, 0, 1, '1.00', '', '1', '1', 'dddddddddd', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', '', 0, 83, 'file_cont_inicial_741.jpg', 1),
(75, 80, 51, 2147483647, 0, 0, '121212.12', '', '0', '0', '', '1', '2020-05-20 00:00:00', '2020-05-26 00:00:00', 'file_cont_inicial_75.jpg', 0, 83, 'file_cont_inicial_751.jpg', 0),
(76, 80, 0, 2147483647, 1, 1, '1234.56', '', '1', '0', 'teste de cadastro', '1', '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'file_cont_inicial_76.jpg', 0, 84, 'file_cont_inicial_761.jpg', 9876.54),
(77, 80, 50, 2147483647, 0, 1, '1234.56', '', '0', '0', 'teste', '1', '2020-05-22 00:00:00', '2020-05-25 00:00:00', 'file_cont_inicial_771.jpg', 0, 83, 'file_cont_inicial_772.jpg', 98765.43);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_operacoes`
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
  `user_id` int(11) NOT NULL DEFAULT 0,
  `qtde_saida` int(11) NOT NULL DEFAULT 0,
  `valor_insumo` double NOT NULL DEFAULT 0,
  `saidas` double NOT NULL DEFAULT 0,
  `sangria` float NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_operacoes`
--

INSERT INTO `ci_operacoes` (`id`, `maq_id`, `cont_anterior`, `cont_atual`, `cont_saida_anterior`, `cont_saida_atual`, `vendas`, `qnt_vendas`, `saldo`, `imagem`, `imagem_cont_saida`, `status_op`, `observacoes_equip`, `is_active`, `created_at`, `updated_at`, `ponto`, `user_id`, `qtde_saida`, `valor_insumo`, `saidas`, `sangria`) VALUES
(68, 57, 30, 40, 30, 40, '100', '10', '55', '1.jpg', '21.jpg', '0', 'teste', '1', '2020-05-19 11:52:34', '2020-05-19 11:52:34', 50, 33, 10, 4.5, 45, 10),
(67, 57, 10, 30, 10, 30, '200', '20', '110', '2.jpg', '4.jpg', '0', 'teste', '1', '2020-05-19 11:27:07', '2020-05-19 11:27:07', 50, 33, 20, 4.5, 90, 25),
(66, 57, 10, 10, 10, 10, '0', '0', '0', '', '', '0', 'teste', '1', '2020-05-19 10:25:55', '2020-05-19 10:25:55', 50, 33, 0, 4.5, 0, 10),
(65, 57, 0, 10, 0, 10, '0', '10', '0', '', '', '0', '', '1', '2020-05-18 19:47:17', '2020-05-18 19:47:17', 49, 33, 10, 0, 0, 12),
(69, 0, 0, 10, 0, 10, '0', '10', '0', '11.jpg', '12.jpg', '0', '', '1', '2020-05-22 15:47:51', '2020-05-22 15:47:51', 52, 1, 10, 0, 0, 1000),
(70, 74, 0, 10, 1, 10, '10', '10', '-30.5', 'kisspng-hamburger-cheeseburger-wendy-s-burger-king-food-veggie-wrap-burger-king-best-burger-2017-5b677e495bfe27_0477149515335091933768.jpg', 'kisspng-coca-cola-cherry-fizzy-drinks-diet-coke-coca-cola-png-transparent-images-5aadb56e581eb8_590981901521333614361.jpg', '0', 'teste', '1', '2020-05-25 18:50:31', '2020-05-25 18:50:31', 50, 33, 9, 4.5, 40.5, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_pontos`
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
  `is_admin` int(11) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `bairro` varchar(256) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `tipo_comissao` enum('percentual','valor') NOT NULL DEFAULT 'valor',
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_pontos`
--

INSERT INTO `ci_pontos` (`id`, `ponto`, `nomefan`, `email`, `comissao`, `responsavel`, `telefone`, `endereco`, `numero`, `cidade`, `estado`, `latitude`, `longitude`, `is_admin`, `is_active`, `created_at`, `updated_at`, `bairro`, `cep`, `tipo_comissao`, `user_id`) VALUES
(51, 'Sem dono', '', 'semdono@teste.com', 10, 'teste', '(11) 98010-2250', 'Rua Pascoal Ruiz', '25', 'São Paulo', 'SP', '-23.7707827', '-46.6767842', 0, 1, '2020-05-18 07:42:13', '2020-05-18 07:42:13', 'Jardim Noronha', '04853-100', 'percentual', 31),
(50, 'santa casa 12', '', 'santa@santaca.com', 10, 'junior', '(11) 19801-0250', 'Rua Pascoal Ruiz', '23', 'São Paulo', 'SP', '-23.7707293', '-46.6771045', 0, 1, '2020-05-17 07:49:38', '2020-05-18 00:00:00', 'Jardim Noronha', '04853-100', '', 33),
(49, 'RIO GRANDE', '', 'TESTE@TESTE.COM', 10, 'rafael', '(46) 54654-6545', 'Rua Tenente Timbauva', '174', 'Sapucaia do Sul', 'RS', '-29.8414212', '-51.1505997', 0, 1, '2020-05-17 07:11:48', '2020-05-17 00:00:00', 'Capão da Cruz', '93226-540', '', 33),
(52, 'POnto teste atualizar', '', 'pontoatualizar@tste.com', 11, 'responsavel atualizar', '(22) 22222-2222', 'Rua Riachuelo', '617', 'São Carlos', 'SP', '-22.0168508', '-47.8958752', 0, 0, '2020-05-19 09:15:12', '2020-05-19 00:00:00', 'Centro', '13560-110', '', 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_rotas`
--

CREATE TABLE `ci_rotas` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `pontos` varchar(512) NOT NULL,
  `operador` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_rotas`
--

INSERT INTO `ci_rotas` (`id`, `nome`, `created_at`, `updated_at`, `user_id`, `is_active`, `pontos`, `operador`) VALUES
(12, 'ss', '2020-05-25 17:18:50', '2020-05-25 17:18:50', 1, 1, 'RIO GRANDE,POnto teste atualizar', ''),
(13, 'ddddd', '2020-05-25 17:45:00', '2020-05-25 17:45:00', 1, 1, 'POnto teste atualizar', ' '),
(14, 'dsgfsdfasfsadf', '2020-05-26 13:01:10', '2020-05-26 13:01:10', 1, 1, 'santa casa 12,RIO GRANDE', ' ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_rotas_pontos`
--

CREATE TABLE `ci_rotas_pontos` (
  `id` int(11) NOT NULL,
  `rota_id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_rotas_pontos`
--

INSERT INTO `ci_rotas_pontos` (`id`, `rota_id`, `ponto_id`) VALUES
(3, 4, 50),
(4, 4, 52),
(5, 3, 50),
(6, 7, 49),
(7, 7, 52),
(8, 8, 50),
(9, 8, 49),
(10, 8, 52),
(11, 9, 50),
(12, 9, 49),
(13, 9, 52),
(14, 10, 50),
(15, 10, 49),
(16, 11, 49),
(17, 11, 52),
(18, 12, 49),
(19, 12, 52),
(20, 13, 52),
(21, 14, 50),
(22, 14, 49);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_tipos`
--

CREATE TABLE `ci_tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `is_admin` int(11) DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `nome_imagem` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_tipos`
--

INSERT INTO `ci_tipos` (`id`, `tipo`, `is_admin`, `is_active`, `created_at`, `updated_at`, `nome_imagem`) VALUES
(80, 'Grua Vintage', 0, 1, '2020-05-08 08:05:30', '2020-05-20 00:00:00', 'file_img_tipos_82.jpg'),
(79, 'Grua Black', 0, 1, '2020-05-08 08:05:16', '2020-05-22 00:00:00', 'Grua_Black.jpg'),
(81, 'teste', 0, 1, '2020-05-20 00:00:00', '2020-05-22 00:00:00', 'teste.jpg'),
(82, 'sssssssss', 0, 1, '2020-05-20 00:00:00', '2020-05-20 00:00:00', 'file_img_tipos_82.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_users`
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
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_verify` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `profile_id` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_users`
--

INSERT INTO `ci_users` (`id`, `username`, `firstname`, `lastname`, `email`, `mobile_no`, `password`, `address`, `role`, `is_active`, `is_verify`, `is_admin`, `token`, `password_reset_code`, `last_ip`, `created_at`, `updated_at`, `profile_id`) VALUES
(51, 'rafa', 'Rafael', 'Benetti', 'rafa@rafa.com', '(47) 99999-9999', '$2y$10$pV7ceT31/PcuUQVxJPrfbeQrs90.H4I49/ZfggeaPbhIMBfmWy51m', '', 1, 1, 0, 0, '', '', '', '2020-05-08 08:05:37', '2020-05-08 08:05:37', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_users_machines`
--

CREATE TABLE `ci_users_machines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `maq_id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_users_machines`
--

INSERT INTO `ci_users_machines` (`id`, `user_id`, `maq_id`, `ponto_id`, `created_at`, `updated_at`) VALUES
(15, 0, 57, 0, '2020-05-18 12:48:53', '2020-05-18 12:48:53'),
(19, 33, 57, 52, '2020-05-18 19:44:38', '2020-05-19 12:25:47'),
(20, 0, 74, 50, '2020-05-20 18:02:32', '2020-05-20 19:58:45'),
(21, 33, 73, 50, '2020-05-20 18:56:01', '2020-05-20 18:56:01'),
(22, 0, 76, 0, '2020-05-20 20:25:48', '2020-05-20 20:25:48'),
(23, 33, 75, 0, '2020-05-20 20:27:09', '2020-05-20 20:27:09'),
(24, 31, 75, 51, '2020-05-21 12:17:10', '2020-05-21 12:17:10'),
(25, 31, 72, 51, '2020-05-21 12:18:01', '2020-05-21 12:18:01'),
(26, 31, 72, 51, '2020-05-21 12:19:32', '2020-05-21 12:19:32'),
(27, 33, 76, 0, '2020-05-22 15:35:44', '2020-05-22 15:35:44'),
(28, 31, 76, 51, '2020-05-22 15:44:50', '2020-05-22 15:44:50'),
(30, 33, 77, 0, '2020-05-26 13:04:34', '2020-05-26 13:04:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_users_pontos`
--

CREATE TABLE `ci_users_pontos` (
  `id` int(11) NOT NULL,
  `ponto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_user_profile`
--

CREATE TABLE `ci_user_profile` (
  `id` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `perfil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_user_profile`
--

INSERT INTO `ci_user_profile` (`id`, `nome`, `perfil_id`) VALUES
(1, 'Usuario', 1),
(2, 'Operador', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `module`
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
-- Extraindo dados da tabela `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `controller_name`, `fa_icon`, `operation`, `sort_order`) VALUES
(1, 'Admin List', 'admin', '', 'view|add|edit|delete|change_status|access', 0),
(2, 'Role & Permissions', 'admin_roles', '', 'view|add|edit|delete|change_status|access', 0),
(3, 'User Manage', 'users', '', 'view|add|edit|delete|change_status|access', 0),
(7, 'Export', 'export', '', 'access', 0),
(8, 'General Settings', 'general_settings', '', 'view|add|edit|delete|change_status|access', 0),
(9, 'Ponto', 'ponto', '', 'view|add|edit|delete|change_status|access', 1),
(10, 'Máquinas', 'machines', '', 'view|add|edit|delete|change_status|access', 0),
(11, 'Itens', 'itens', '', 'view|add|edit|delete|change_status|access', 0),
(12, 'Operações', 'operar', '', 'view|add|edit|delete|change_status|access', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `module_access`
--

CREATE TABLE `module_access` (
  `id` int(11) NOT NULL,
  `admin_role_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `operation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `module_access`
--

INSERT INTO `module_access` (`id`, `admin_role_id`, `module`, `operation`) VALUES
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
(29, 1, 'clientes', 'change_status'),
(30, 2, 'ponto', 'view'),
(31, 2, 'ponto', 'add'),
(32, 2, 'ponto', 'edit'),
(33, 2, 'ponto', 'change_status'),
(34, 2, 'ponto', 'access'),
(35, 2, 'machines', 'view'),
(39, 2, 'operar', 'view'),
(40, 2, 'operar', 'add'),
(43, 2, 'itens', 'view');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ci_admin`
--
ALTER TABLE `ci_admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  ADD PRIMARY KEY (`admin_role_id`);

--
-- Índices para tabela `ci_calendar`
--
ALTER TABLE `ci_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_catfin`
--
ALTER TABLE `ci_catfin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_clientes`
--
ALTER TABLE `ci_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_estoque_itens`
--
ALTER TABLE `ci_estoque_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_itens`
--
ALTER TABLE `ci_itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_machines`
--
ALTER TABLE `ci_machines`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `nomedamaquina` (`cont_inicial`);

--
-- Índices para tabela `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `ci_pontos`
--
ALTER TABLE `ci_pontos`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `ponto` (`ponto`);

--
-- Índices para tabela `ci_rotas`
--
ALTER TABLE `ci_rotas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_rotas_pontos`
--
ALTER TABLE `ci_rotas_pontos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_tipos`
--
ALTER TABLE `ci_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Índices para tabela `module_access`
--
ALTER TABLE `module_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoleId` (`admin_role_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ci_admin`
--
ALTER TABLE `ci_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  MODIFY `admin_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ci_calendar`
--
ALTER TABLE `ci_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ci_itens`
--
ALTER TABLE `ci_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `ci_machines`
--
ALTER TABLE `ci_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `ci_pontos`
--
ALTER TABLE `ci_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `ci_rotas`
--
ALTER TABLE `ci_rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `ci_rotas_pontos`
--
ALTER TABLE `ci_rotas_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `ci_tipos`
--
ALTER TABLE `ci_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de tabela `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `module_access`
--
ALTER TABLE `module_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Maio-2020 às 22:01
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmsis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_admin`
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
-- Extraindo dados da tabela `ci_admin`
--

INSERT INTO `ci_admin` (`admin_id`, `admin_role_id`, `username`, `firstname`, `lastname`, `email`, `mobile_no`, `image`, `password`, `last_login`, `is_verify`, `is_admin`, `is_active`, `is_supper`, `token`, `password_reset_code`, `last_ip`, `contrato`, `created_at`, `updated_at`) VALUES
(31, 1, 'superadmin', 'Rafael', 'Benetti', 'marketing@altechindustria.com.br', '47997799705', '', '$2y$10$3h721xTsJbI6WX0/oS4n.eVFAvsfcZ1vIIMnoDROrbBBOrlLCg86y', '0000-00-00 00:00:00', 1, 1, 1, 1, '', '', '', '', '2019-01-16 06:01:58', '2020-01-23 00:00:00');

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
(2, 'Cliente', 1, 0, '2018-03-15 12:53:19', 0, '2020-02-28 01:40:59'),
(4, 'Operador', 1, 0, '2018-03-16 05:52:45', 0, '2020-01-22 12:24:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_calendar`
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
-- Estrutura da tabela `ci_catfin`
--

CREATE TABLE `ci_catfin` (
  `id` int(11) NOT NULL,
  `categorias` varchar(50) NOT NULL,
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
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
-- Estrutura da tabela `ci_estoque_itens`
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
-- Extraindo dados da tabela `ci_estoque_itens`
--

INSERT INTO `ci_estoque_itens` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`) VALUES
(20, 5000, 81, 0, 31, '2020-05-08 08:12:14', '2020-05-08 08:12:14', 'entrada'),
(21, 3000, 82, 0, 31, '2020-05-08 08:12:40', '2020-05-08 08:12:40', 'entrada'),
(22, 5000, 83, 0, 31, '2020-05-08 08:22:11', '2020-05-08 08:22:11', 'entrada'),
(23, 3000, 84, 0, 31, '2020-05-08 08:22:31', '2020-05-08 08:22:31', 'entrada'),
(24, -60, 84, 0, 31, '2020-05-08 08:27:56', '2020-05-08 08:27:56', 'saida'),
(25, -60, 83, 0, 31, '2020-05-08 08:28:28', '2020-05-08 08:28:28', 'saida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_estoque_machine`
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
-- Extraindo dados da tabela `ci_estoque_machine`
--

INSERT INTO `ci_estoque_machine` (`id`, `qtde`, `item_id`, `maq_id`, `user_id`, `created_at`, `updated_at`, `tipo_operacao`, `id_operacao`) VALUES
(78, 60, 84, 48, 31, '2020-05-08 08:27:56', '2020-05-08 08:27:56', 'entrada', 0),
(79, 60, 83, 47, 31, '2020-05-08 08:28:28', '2020-05-08 08:28:28', 'entrada', 0),
(80, -1, 84, 48, 31, '2020-05-08 08:32:49', '2020-05-08 08:32:49', 'saida', 61),
(81, -1, 83, 47, 31, '2020-05-08 08:33:50', '2020-05-08 08:33:50', 'saida', 62);

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
-- Extraindo dados da tabela `ci_general_settings`
--

INSERT INTO `ci_general_settings` (`id`, `favicon`, `logo`, `proprietario`, `application_name`, `timezone`, `currency`, `copyright`, `email_from`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `facebook_link`, `twitter_link`, `google_link`, `youtube_link`, `linkedin_link`, `instagram_link`, `recaptcha_secret_key`, `recaptcha_site_key`, `recaptcha_lang`, `created_date`, `updated_date`) VALUES
(1, 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'assets/img/52146e792d37f1a9af76f4d931cf2f88.png', 'Altech', 'VM System', 'America/Sao_Paulo', 'BRL', 'Copyright © 2019 Altech All rights reserved.', 'marketing@altechindustria.com', 'mail.altechindustria.com', 25, 'marketing@altechindustria.com', 'pipoca123', 'https://facebook.com', 'https://twitter.com', 'https://google.com', 'https://youtube.com', 'https://linkedin.com', 'https://instagram.com', '6Lf8Pt0UAAAAALo_d1yxGKGt2AB6maRn8PXK1HlK', '6Lf8Pt0UAAAAALswA1YgTTK7rd65Br8a-Tp-pqGh', 'pt-BR', '2020-03-18 05:03:09', '2020-03-18 05:03:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_itens`
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
-- Extraindo dados da tabela `ci_itens`
--

INSERT INTO `ci_itens` (`id`, `item`, `quantidade`, `valor`, `is_admin`, `is_active`, `created_at`, `updated_at`) VALUES
(83, 'Ursinho Comum', '', '4.50', 0, 1, '2020-05-08 08:05:11', '2020-05-08 08:05:11'),
(84, 'Ursinho Prêmium', '', '8.50', 0, 1, '2020-05-08 08:05:31', '2020-05-08 08:05:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_machines`
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
-- Extraindo dados da tabela `ci_machines`
--

INSERT INTO `ci_machines` (`id`, `tipomaquina`, `pontodevenda`, `serial`, `cont_inicial`, `cont_saida_inicial`, `valorvenda`, `imagem`, `noteiro`, `ficheiro`, `observacoes_equip`, `is_active`, `created_at`, `updated_at`, `nome_imagem`, `qtde_insumos`, `item_id`) VALUES
(48, 79, 46, 1515, 100, 0, '5.00', '', '1', '1', 'Ok para operar', '1', '2020-05-08 08:27:15', '2020-05-08 08:27:15', 'contador_inicial_48.png', 0, 84),
(47, 80, 46, 1212, 1, 0, '5.00', '', '1', '1', 'Ok para operar', '1', '2020-05-08 08:26:11', '2020-05-08 08:26:11', 'contador_inicial_47.png', 0, 83);

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
  `user_id` int(11) NOT NULL DEFAULT '0',
  `qtde_saida` int(11) NOT NULL DEFAULT '0',
  `valor_insumo` double NOT NULL DEFAULT '0',
  `saidas` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_operacoes`
--

INSERT INTO `ci_operacoes` (`id`, `maq_id`, `cont_anterior`, `cont_atual`, `cont_saida_anterior`, `cont_saida_atual`, `vendas`, `qnt_vendas`, `saldo`, `imagem`, `imagem_cont_saida`, `status_op`, `observacoes_equip`, `is_active`, `created_at`, `updated_at`, `ponto`, `user_id`, `qtde_saida`, `valor_insumo`, `saidas`) VALUES
(62, 47, 1, 21, 0, 1, '100', '20', '95.5', '12.png', '13.png', '0', 'ok', '1', '2020-05-08 20:33:50', '2020-05-08 20:33:50', 46, 31, 1, 4.5, 4.5),
(61, 48, 100, 110, 0, 1, '50', '10', '41.5', '1.png', '11.png', '0', 'ok', '1', '2020-05-08 20:32:49', '2020-05-08 20:32:49', 46, 31, 1, 8.5, 8.5);

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
  `is_admin` int(11) DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `bairro` varchar(256) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `tipo_comissao` enum('percentual','valor') NOT NULL DEFAULT 'valor'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ci_pontos`
--

INSERT INTO `ci_pontos` (`id`, `ponto`, `nomefan`, `email`, `comissao`, `responsavel`, `telefone`, `endereco`, `numero`, `cidade`, `estado`, `latitude`, `longitude`, `is_admin`, `is_active`, `created_at`, `updated_at`, `bairro`, `cep`, `tipo_comissao`) VALUES
(46, 'Shopping Sapucaia do Sul', '', 'sap@teste.com', 10, 'Victor', '(51) 98798-7987', 'Rua Tenente Timbauva', '177', 'Sapucaia do Sul', 'RS', '-29.8413714', '-51.1509928', 0, 1, '2020-05-08 08:05:22', '2020-05-08 08:05:22', 'Capão da Cruz', '93226-540', 'percentual');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_rotas`
--

CREATE TABLE `ci_rotas` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_rotas`
--

INSERT INTO `ci_rotas` (`id`, `nome`) VALUES
(3, 'teste');

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
(2, 3, 46);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_tipos`
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
-- Extraindo dados da tabela `ci_tipos`
--

INSERT INTO `ci_tipos` (`id`, `tipo`, `is_admin`, `is_active`, `created_at`, `updated_at`, `nome_imagem`) VALUES
(80, 'Grua Vintage', 0, 1, '2020-05-08 08:05:30', '2020-05-08 08:05:30', 'Grua_Vintage.png'),
(79, 'Grua Black', 0, 1, '2020-05-08 08:05:16', '2020-05-08 08:05:16', 'Grua_Black.jpg');

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
  `ponto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ci_users_machines`
--

INSERT INTO `ci_users_machines` (`id`, `user_id`, `maq_id`, `ponto_id`) VALUES
(5, 51, 48, 46),
(6, 51, 47, 46);

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
(8, 'General Settings', 'general_settings', '', 'view|add|edit|delete|change_status|access', 0);

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
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_admin`
--
ALTER TABLE `ci_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  ADD PRIMARY KEY (`admin_role_id`);

--
-- Indexes for table `ci_calendar`
--
ALTER TABLE `ci_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_catfin`
--
ALTER TABLE `ci_catfin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_clientes`
--
ALTER TABLE `ci_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_estoque_itens`
--
ALTER TABLE `ci_estoque_itens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_itens`
--
ALTER TABLE `ci_itens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_machines`
--
ALTER TABLE `ci_machines`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `nomedamaquina` (`cont_inicial`);

--
-- Indexes for table `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ci_pontos`
--
ALTER TABLE `ci_pontos`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `ponto` (`ponto`);

--
-- Indexes for table `ci_rotas`
--
ALTER TABLE `ci_rotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_rotas_pontos`
--
ALTER TABLE `ci_rotas_pontos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_tipos`
--
ALTER TABLE `ci_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_access`
--
ALTER TABLE `module_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoleId` (`admin_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_admin`
--
ALTER TABLE `ci_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ci_admin_roles`
--
ALTER TABLE `ci_admin_roles`
  MODIFY `admin_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_calendar`
--
ALTER TABLE `ci_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ci_catfin`
--
ALTER TABLE `ci_catfin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `ci_clientes`
--
ALTER TABLE `ci_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ci_estoque_itens`
--
ALTER TABLE `ci_estoque_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ci_estoque_machine`
--
ALTER TABLE `ci_estoque_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `ci_financeiro`
--
ALTER TABLE `ci_financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_general_settings`
--
ALTER TABLE `ci_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_itens`
--
ALTER TABLE `ci_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `ci_machines`
--
ALTER TABLE `ci_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ci_operacoes`
--
ALTER TABLE `ci_operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `ci_pontos`
--
ALTER TABLE `ci_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ci_rotas`
--
ALTER TABLE `ci_rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_rotas_pontos`
--
ALTER TABLE `ci_rotas_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_tipos`
--
ALTER TABLE `ci_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `ci_users_machines`
--
ALTER TABLE `ci_users_machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_users_pontos`
--
ALTER TABLE `ci_users_pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_user_profile`
--
ALTER TABLE `ci_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

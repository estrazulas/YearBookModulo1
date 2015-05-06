-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Maio-2014 às 02:28
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daw_yearbook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `sigaEstado` char(2) NOT NULL,
  `nomeEstado` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstado`),
  UNIQUE KEY `sigaEstado` (`sigaEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`idEstado`, `sigaEstado`, `nomeEstado`) VALUES
(1, 'AL', '	Alagoas'),
(2, 'AP', '	Amapá'),
(3, 'AM', '	Amazonas'),
(4, 'BA', '	Bahia'),
(5, 'CE', '	Ceará'),
(6, 'DF', '	Distrito Federal'),
(7, 'ES', '	Espírito Santo'),
(8, 'GO', '	Goiás'),
(9, 'MA', '	Maranhão'),
(10, 'MT', '	Mato Grosso'),
(11, 'MS', '	Mato Grosso do Sul'),
(12, 'MG', '	Minas Gerais'),
(13, 'PA', '	Pará'),
(14, 'PB', '	Paraíba'),
(15, 'PR', '	Paraná'),
(16, 'PE', '	Pernambuco'),
(17, 'PI', '	Piauí'),
(18, 'RJ', '	Rio de Janeiro'),
(19, 'RN', '	Rio Grande do Norte'),
(20, 'RS', '	Rio Grande do Sul'),
(21, 'RO', '	Rondônia'),
(22, 'RR', '	Roraima'),
(23, 'SC', '	Santa Catarina'),
(24, 'SP', '	São Paulo'),
(25, 'SE', '	Sergipe'),
(26, 'TO', '	Tocantins'),
(27, 'AC', 'Acre');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

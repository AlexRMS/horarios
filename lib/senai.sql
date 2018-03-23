CREATE DATABASE IF NOT EXISTS `spd`;

USE `spd`;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `alterar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alteracao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `turma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `turno` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;



CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) AUTO_INCREMENT,
  `idTurma` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idSala` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `turno` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_turmaHorario` (`idTurma`),
  KEY `FK_professorHorario` (`idProfessor`),
  KEY `FK_salaHorario` (`idSala`),
  KEY `FK_tipoHorario` (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `registro` (
  `id` bigint AUTO_INCREMENT,
  `idHorario` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_horarioRegistro` (`idHorario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `horario`
  ADD CONSTRAINT `FK_professorHorario` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `FK_salaHorario` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`),
  ADD CONSTRAINT `FK_turmaHorario` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `FK_tipoHorario` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`id`);

ALTER TABLE `registro`
    ADD CONSTRAINT `FK_horarioRegistro` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`id`);

INSERT INTO usuario (id, nome, login, senha) VALUES
(1, 'Administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3');

INSERT INTO alterar (alteracao) VALUES
(1);
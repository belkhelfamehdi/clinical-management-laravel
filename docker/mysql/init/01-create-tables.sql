-- Create tables based on old pfc database structure

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(225) NOT NULL,
  `user` varchar(225) NOT NULL,
  `pwd` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`id`, `fullname`, `user`, `pwd`) VALUES
(1, 'admin', 'BasicAdmin', '202cb962ac59075b964b07152d234b70')
ON DUPLICATE KEY UPDATE `id`=`id`;

CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nom` varchar(225) NOT NULL,
  `prenom` varchar(225) NOT NULL,
  `daten` date NOT NULL,
  `gen` varchar(225) NOT NULL,
  `num` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `addr` varchar(225) NOT NULL,
  `gs` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(225) NOT NULL,
  `prenom` varchar(225) NOT NULL,
  `daten` date NOT NULL,
  `dateem` date NOT NULL,
  `gen` varchar(225) NOT NULL,
  `num` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `fonction` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `chambre` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id_p` int(11) NOT NULL,
  `id_e` int(11) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `id_p` (`id_p`),
  KEY `id_e` (`id_e`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `facture` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `Montant` float NOT NULL,
  `id_p` int(11) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `id_p` (`id_p`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `medicament` (
  `numM` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(225) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`numM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `stocks` (
  `gs` varchar(225) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`gs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `donneur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(225) NOT NULL,
  `prenom` varchar(225) NOT NULL,
  `numero` int(11) NOT NULL,
  `gs` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `cong` (
  `num_cn` int(11) NOT NULL AUTO_INCREMENT,
  `id_em` int(11) NOT NULL,
  `dated` date NOT NULL,
  `datef` date NOT NULL,
  PRIMARY KEY (`num_cn`),
  KEY `id_em` (`id_em`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `consultation` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `id_p` int(11) NOT NULL,
  `id_e` int(11) DEFAULT NULL,
  PRIMARY KEY (`num`),
  KEY `id_p` (`id_p`),
  KEY `id_e` (`id_e`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ordonnance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_ord` date NOT NULL,
  `id_em` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `salaire` (
  `id` int(11) NOT NULL,
  `salaire` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

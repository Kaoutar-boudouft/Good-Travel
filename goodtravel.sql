-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 juin 2022 à 22:45
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `goodtravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

DROP TABLE IF EXISTS `billet`;
CREATE TABLE IF NOT EXISTS `billet` (
  `idbillet` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) DEFAULT NULL,
  `Type` enum('voyage','Tour') DEFAULT NULL,
  `idvoyage` int(11) DEFAULT NULL,
  `idtour` int(11) DEFAULT NULL,
  `nbrdeplace` int(11) NOT NULL,
  `numerodeplaces` varchar(500) NOT NULL,
  `boughtin` datetime NOT NULL,
  `totalapayes` float NOT NULL,
  PRIMARY KEY (`idbillet`),
  KEY `UserName` (`UserName`),
  KEY `idvoyage` (`idvoyage`),
  KEY `idtour` (`idtour`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`idbillet`, `UserName`, `Type`, `idvoyage`, `idtour`, `nbrdeplace`, `numerodeplaces`, `boughtin`, `totalapayes`) VALUES
(1, 'kaoutar', 'Tour', NULL, 6, 2, 'place n:1/place n:2/', '2022-02-14 16:52:56', 836),
(2, NULL, 'Tour', NULL, 2, 2, 'place n:1/place n:2/', '2022-02-15 01:45:59', 1144),
(3, 'kaoutar', 'voyage', 1, NULL, 2, 'place n:1/place n:2/', '2022-02-19 20:15:38', 440),
(4, 'kaoutar', 'voyage', 1, NULL, 3, 'place n:3/place n:4/place n:5/', '2022-02-24 11:21:35', 660),
(6, 'kaoutar', 'voyage', 1, NULL, 6, 'place n:6/place n:7/place n:8/place n:9/place n:10/place n:11/', '2022-02-25 19:56:29', 1320),
(7, 'nouhaila', 'Tour', NULL, 36, 2, 'place n:1/place n:2/', '2022-02-25 22:47:38', 488.4),
(8, 'nouhaila', 'voyage', 2, NULL, 4, 'place n:1/place n:2/place n:3/place n:4/', '2022-02-25 23:03:08', 2200),
(9, 'kaoutar', 'voyage', 5, NULL, 2, 'place n:1/place n:2/', '2022-02-25 23:10:50', 500),
(10, 'kaoutar', 'voyage', 1, NULL, 3, 'place n:12/place n:13/place n:14/', '2022-02-25 23:36:29', 660),
(11, 'nouhaila', 'voyage', 1, NULL, 2, 'place n:15/place n:16/', '2022-02-25 23:39:15', 440),
(12, 'nouhaila', 'Tour', NULL, 43, 2, 'place n:1/place n:2/', '2022-02-25 23:40:00', 484),
(13, 'nouhaila', 'voyage', 5, NULL, 1, 'place n:3/', '2022-02-25 23:41:05', 250),
(14, 'a', 'voyage', 1, NULL, 3, 'place n:17/place n:18/place n:19/', '2022-02-26 11:38:05', 660),
(15, 'kaoutar', 'Tour', NULL, 2, 2, 'place n:3/place n:4/', '2022-03-19 18:42:38', 1144),
(16, 'a', 'Tour', NULL, 1, 3, 'place n:1/place n:2/place n:3/', '2022-03-19 23:49:42', 1500),
(25, 'a', 'voyage', 11, NULL, 2, 'place n:1/place n:2/', '2022-03-20 02:02:16', 1340),
(26, 'a', 'voyage', 8, NULL, 3, 'place n:1/place n:2/place n:3/', '2022-03-21 19:24:15', 360),
(27, 'a', 'voyage', 8, NULL, 3, 'place n:4/place n:5/place n:6/', '2022-03-21 19:24:20', 360),
(28, 'a', 'voyage', 7, NULL, 5, 'place n:1/place n:2/place n:3/place n:4/place n:5/', '2022-03-21 21:23:06', 500),
(30, 'a', 'Tour', NULL, 43, 2, 'place n:3/place n:4/', '2022-03-21 21:33:39', 484),
(31, 'a', 'voyage', 8, NULL, 4, 'place n:7/place n:8/place n:9/place n:10/', '2022-03-21 21:35:29', 480),
(32, 'a', 'Tour', NULL, 5, 3, 'place n:1/place n:2/place n:3/', '2022-03-21 22:37:54', 900),
(33, 'a', 'Tour', NULL, 35, 1, 'place n:1/', '2022-03-21 22:44:50', 337.44),
(34, 'a', 'voyage', 7, NULL, 1, 'place n:6/', '2022-03-21 23:00:50', 100),
(35, 'a', 'voyage', 8, NULL, 3, 'place n:11/place n:12/place n:13/', '2022-03-21 23:04:47', 360),
(36, 'a', 'voyage', 11, NULL, 1, 'place n:3/', '2022-03-21 23:06:36', 670),
(37, 'a', 'voyage', 4, NULL, 2, 'place n:1/place n:2/', '2022-03-21 23:10:15', 200),
(38, 'a', 'voyage', 2, NULL, 1, 'place n:5/', '2022-03-21 23:12:11', 550),
(39, 'a', 'voyage', 11, NULL, 2, 'place n:4/place n:5/', '2022-03-21 23:22:01', 1340),
(40, 'a', 'voyage', 11, NULL, 1, 'place n:6/', '2022-03-21 23:27:32', 670),
(41, 'a', 'Tour', NULL, 36, 3, 'place n:3/place n:4/place n:5/', '2022-03-21 23:28:10', 555),
(42, 'kaoutar', 'voyage', 8, NULL, 1, 'place n:14/', '2022-04-02 17:51:39', 108),
(43, 'kaoutar', 'voyage', 8, NULL, 2, 'place n:15/place n:16/', '2022-04-02 17:59:37', 216),
(44, 'kaoutar', 'Tour', NULL, 1, 3, 'place n:4/place n:5/place n:6/', '2022-04-21 22:35:43', 1500),
(45, 'kaoutar', 'Tour', NULL, 35, 2, 'place n:2/place n:3/', '2022-06-29 13:31:27', 351.648);

-- --------------------------------------------------------

--
-- Structure de la table `cartebancaire`
--

DROP TABLE IF EXISTS `cartebancaire`;
CREATE TABLE IF NOT EXISTS `cartebancaire` (
  `numcarte` varchar(100) NOT NULL,
  `detenteur` varchar(50) DEFAULT NULL,
  `anneeexp` varchar(4) DEFAULT NULL,
  `moisexp` varchar(2) DEFAULT NULL,
  `crypto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`numcarte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cartebancaire`
--

INSERT INTO `cartebancaire` (`numcarte`, `detenteur`, `anneeexp`, `moisexp`, `crypto`) VALUES
('123456789', 'tdm', '2022', '12', '123');

-- --------------------------------------------------------

--
-- Structure de la table `emailspublicitaire`
--

DROP TABLE IF EXISTS `emailspublicitaire`;
CREATE TABLE IF NOT EXISTS `emailspublicitaire` (
  `email` varchar(500) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emailspublicitaire`
--

INSERT INTO `emailspublicitaire` (`email`, `name`) VALUES
('a@gmail.com', 'a'),
('kaoutarboudouft2@gmail.com', 'kaoutar');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` text,
  `subject` varchar(200) DEFAULT NULL,
  `msg` text,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `msg`, `username`) VALUES
(3, 'abc', 'abcde@gmail.com', 'test test test ', 'yoyoyoyoye wax wesal msg dyali', NULL),
(4, 'kaoutar', 'kaoutarboudouft2@gmail.com', 'darouri!', 'haha la machi Darouri', 'kaoutar'),
(5, 'kaoutar', 'kaoutarboudouft2@gmail.com', 'test', 'fayn wslat chi haja?', NULL),
(6, 'nouhaila', 'nouhailaben@gmail.com', 'my destination', 'i would like to know when the trip to rabat is going to be available plzzzz jaweb ', 'nouhaila'),
(7, 'animal', 'nouhailabenhaddou97@gmail.com', 'chat ', 'bghit n3raf wax momkin billet wahd ndi m3aya fih khuti ah wdaruri mama matkhafxi ba la aykun mxrul', 'nouhailaa'),
(8, 'a', 'a@gmail.com', 'a', 'a', NULL),
(9, 'c', 'c@gmail.com', 'c', 'c', NULL),
(10, 'chi wahd', 'chiwahd@gmail.com', 'hada subject', 'hada message', NULL),
(11, 'a', 'kaoutarboudouft2@gmail.com', 'a', 'a', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `specialstours`
--

DROP TABLE IF EXISTS `specialstours`;
CREATE TABLE IF NOT EXISTS `specialstours` (
  `idtour` int(11) NOT NULL AUTO_INCREMENT,
  `idcateg` int(11) DEFAULT NULL,
  `titretour` varchar(200) DEFAULT NULL,
  `city` varchar(150) NOT NULL,
  `datedepart` datetime NOT NULL,
  `descriptiontour` text,
  `capacite` int(11) NOT NULL,
  `image` text,
  `prix` float DEFAULT NULL,
  `Region` varchar(200) NOT NULL,
  `imageweb` varchar(500) NOT NULL,
  PRIMARY KEY (`idtour`),
  KEY `specialstours_ibfk_1` (`idcateg`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `specialstours`
--

INSERT INTO `specialstours` (`idtour`, `idcateg`, `titretour`, `city`, `datedepart`, `descriptiontour`, `capacite`, `image`, `prix`, `Region`, `imageweb`) VALUES
(1, 1, 'A tour in the most important universities in Casablanca', 'Casablanca', '2022-05-30 07:30:00', 'Faculte de medecine - UM6SS/Faculte de medecine dentaire - UM6SS/Faculte de pharmacie - UM6SS/La Faculté des Lettres et des Sciences Humaines/La Facultes Ben Msik et autres surprises..', 51, 'toursimages/chefchaouen.jpg', 1500, 'Grand Casablanca', 'https://www.challenge.ma/wp-content/uploads/2017/04/image.jpeg'),
(2, 1, 'A tour in the most important universities in Fes', 'Fès', '2022-06-12 07:30:00', 'Université Sidi Mohamed Ben Abdellah /Faculté des Lettres et des Sciences Humaines - Sais / Faculté des Sciences et Techniques /faculté des sciences de Dhar El Mahraz.et autres surprises..', 50, 'toursimages/usmba.jpg', 1300, 'Fès-Boulemane', 'https://www.lopinion.ma/photo/art/default/59456559-43688865.jpg?v=1633889450'),
(3, 2, 'A tour in the most popular city in morocco : Marrakech', 'Marrakech', '2022-07-30 10:00:00', 'Jemaa el-Fnaa,Jardin Majorelle,Palais de la Bahia,Les Jardins de la Ménara et autres surprises..le prix pour 3 personnes sinon pour chaque personne en plus le prix va sera augmenter de 12%', 42, 'toursimages/Menara-Gardens.jpg', 1800, 'Marrakech-Tensift-Al Haouz', 'https://cache.magazine-avantages.fr/data/photo/w1536_ci/5n/marrakech-voyage-tourisme-culture.webp'),
(4, 2, 'A tour in the most esthetique city in morocco :Essaouira', 'Essaouira', '2022-08-15 11:30:00', 'Plage d\'Essaouira,Sqala du Port,Palma Quad,Castelo Real et autres surprises..le prix pour 3 personnes sinon pour chaque personne en plus le prix va sera augmenter de 12%', 40, 'toursimages/gettyimages-625079568.jpg', 1500, 'Marrakech-Tensift-Al Haouz', 'https://www.magtoo.fr/wp-content/uploads/2021/07/too43-voyage-essaouira-1.jpg'),
(5, 3, 'A tour in the most quieter city in morocco :Safi', 'Safi', '2022-04-02 01:00:00', 'Cathédrale portugaise,Ksar El Bahr,The mausoleum of Ouled Ben Zmirou et autres surprises..', 60, 'toursimages/1024px-Safi1_js-800x523.jpg', 900, 'Marrakech-Tensift-Al Haouz', 'https://maptourisme.ma/wp-content/uploads/2020/12/Safi2-copier-1.jpg'),
(6, 3, 'A tour in the most safer city in morocco :Al Hoceima', 'Al Hoceïma', '2022-03-24 22:25:00', 'Plage Quemado,Espace miramar,Plage Sfiha,Place Mohamed VI et autres surprises..', 60, 'toursimages/alhoceima.jpg', 950, 'Taza-Al Hoceima-Taounate', 'https://aujourdhui.ma/wp-content/uploads/2020/03/al-houceima.jpg'),
(35, 2, 'A tour in the most esthetique city in morocco :Chefchaouene', 'Chefchaouen', '2044-04-04 04:04:00', 'Visitez les plus beaux endroits de Chefchaouen, (Nord du Maroc), et préparez votre voyage (hébergement, location, transport, activités). Retrouvez les plus belles photos, lieux..', 44, 'toursimages/Chefchaouene chef.jpg', 444, 'Nord', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/3d/fd/a8/medina-stairs.jpg?w=1400&h=-1&s=1'),
(36, 3, 'Tour In a Pupolar Moroccan Tamazight : Merzoga', 'Merzoga', '2055-05-05 05:05:00', 'Merzouga Aux portes du grand désert rouge… Avis aux voyageurs en quête d’aventure ! Merzouga et l’erg Chebbi constituent une des principales curiosités du sud-est marocain. ..', 55, 'toursimages/Merzoga mrz.jpg', 555, 'Sahara', 'https://www.excursionsmarrakech.ma/wp-content/uploads/2016/11/merzo.jpg'),
(41, 3, 'A Frutful Tour in Moroccan Port City :Tangier', 'Tangier', '2022-04-07 14:05:00', 'Tangier is a true port town with all of the international, cross cultural influence and great seafood that implies. Sip on a freshsqueezed orange juice on a balcony in the old kasbah.....', 38, 'toursimages/Tangier tanger.jpg', 560, 'Nord', 'https://www.mifuguemiraison.com/wp-content/uploads/2019/05/mosquee-medina-tanger-1200x800.jpg'),
(43, 2, 'A Romantic Tour In : Kelaat-MGouna', 'Kelaat-MGouna', '2023-02-14 14:00:00', 'Parmi les quartiers dEl-Kelaa on trouve : Ait Aissi, Rkon, Elkelaa, Zaoui Aguerd, Ait Baâmrane, Hay Annahda,....et dautres surprises......', 45, 'toursimages/Kelaat-MGouna mgouna.jpg', 550, 'Mgouna', 'https://cdn.shopify.com/s/files/1/1466/9138/files/brqxbr7008000000_l_large.jpg?v=1553170431');

-- --------------------------------------------------------

--
-- Structure de la table `specialtourscategories`
--

DROP TABLE IF EXISTS `specialtourscategories`;
CREATE TABLE IF NOT EXISTS `specialtourscategories` (
  `idcate` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`idcate`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `specialtourscategories`
--

INSERT INTO `specialtourscategories` (`idcate`, `titre`, `description`) VALUES
(1, 'Students Package', 'Are you a student at a baccalaureate level or equivalent?\r\nWant to explore Moroccan universities to determine your future destination...\r\nOur Student Offers, offer you all of this and more...\r\nComprehensive tours in all cities of the Kingdom , join us now!'),
(2, 'Familly Package', '      Do you have a vacation and want to use it to strengthen your relationship with your family?\nOur Families Offers ,offer you all of this and more...\nComprehensive tours in all cities of the Kingdom , join us now!'),
(3, 'OnePersone Package', 'Tired of your usual routine and so many people around you?\r\nWant to relax and have fun away from all this?\r\nOur OnePersone Offers ,offer you all of this and more...\r\nComprehensive tours in all cities of the Kingdom , join us now!');

-- --------------------------------------------------------

--
-- Structure de la table `stats_visites`
--

DROP TABLE IF EXISTS `stats_visites`;
CREATE TABLE IF NOT EXISTS `stats_visites` (
  `ip` varchar(100) NOT NULL,
  `date_visite` date NOT NULL,
  `pages_vues` int(11) DEFAULT NULL,
  `Country` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  PRIMARY KEY (`ip`,`date_visite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stats_visites`
--

INSERT INTO `stats_visites` (`ip`, `date_visite`, `pages_vues`, `Country`, `City`) VALUES
('127.0.0.1', '2022-02-26', 15, 'Morocco', 'Tangier\n'),
('127.0.0.1', '2022-03-15', 1, 'Morocco', 'Tangier\n'),
('127.0.0.1', '2022-03-19', 2, 'Morocco', 'Tangier\n'),
('127.0.0.1', '2022-03-21', 2, 'Morocco', 'Tangier\n'),
('127.0.0.1', '2022-04-02', 3, 'Morocco', 'Tangier\n'),
('127.0.0.1', '2022-04-29', 4, 'Morocco', 'Casablanca\n'),
('192.168.56.1', '2022-03-19', 3, 'Morocco', 'Tangier\n'),
('192.168.56.1', '2022-03-21', 1, 'Morocco', 'Tangier\n'),
('::1', '2022-02-20', 21, 'Morocco', 'Tangier\n'),
('::1', '2022-02-21', 12, 'Morocco', 'Tangier\n'),
('::1', '2022-02-22', 19, 'Morocco', 'Tangier\n'),
('::1', '2022-02-23', 48, 'Morocco', 'Tangier\n'),
('::1', '2022-02-24', 54, 'Morocco', 'Tangier\n'),
('::1', '2022-02-25', 35, 'Morocco', 'Tangier\n'),
('::1', '2022-02-26', 25, 'Morocco', 'Casablanca\n'),
('::1', '2022-03-17', 1, 'Morocco', 'Tangier\n'),
('::1', '2022-03-19', 8, 'Morocco', 'Tangier\n'),
('::1', '2022-03-21', 2, 'Morocco', 'Tangier\n'),
('::1', '2022-04-02', 50, 'Morocco', 'Tangier\n'),
('::1', '2022-04-03', 3, 'Morocco', 'Tangier\n'),
('::1', '2022-04-16', 1, 'Morocco', 'Tangier\n'),
('::1', '2022-04-21', 8, 'Morocco', 'Tangier\n'),
('::1', '2022-06-28', 1, 'Morocco', 'Tangier\n'),
('::1', '2022-06-29', 5, 'Morocco', 'Tangier\n');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(500) DEFAULT NULL,
  `Pass` varchar(20) DEFAULT NULL,
  `datenaissance` text,
  `Profilepic` varchar(500) NOT NULL DEFAULT 'im/utilisateur.png',
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `profilepicmobile` varchar(1000) NOT NULL DEFAULT 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1',
  `coupon` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserName`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserName`, `Email`, `Pass`, `datenaissance`, `Profilepic`, `Admin`, `profilepicmobile`, `coupon`) VALUES
('a', 'a@gmail.com', 'a', '0199-12-12', 'im/utilisateur.png', 0, 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1', 1),
('abcdefg', 'abcdefg@gmail.com', '123456789', '2001-02-02', 'im/utilisateur.png', 0, 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1', 0),
('kaoutar', 'kaoutarboudouft2@gmail.com', '123', '1997-07-22', 'uploadedimg/kaoutar R.jfif', 1, 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1', 0),
('nouhaila', 'nouhailaben@gmail.com', '0123', '2002-11-06', 'im/utilisateur.png', 0, 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1', 0),
('nouhailaa', 'nouhailabenhaddou97@gmail.com', '0123', '2002-11-06', 'im/utilisateur.png', 1, 'https://th.bing.com/th/id/OIP.kXyjL7nXhWLU-u3E1pSeuQHaH3?pid=ImgDet&rs=1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `idvoyage` int(11) NOT NULL AUTO_INCREMENT,
  `villedepart` varchar(120) DEFAULT NULL,
  `villearriver` varchar(120) DEFAULT NULL,
  `datedepart` date DEFAULT NULL,
  `datearriver` date NOT NULL,
  `heuredepart` time NOT NULL,
  `heurearrive` time NOT NULL,
  `capacite` int(11) NOT NULL,
  `outile` enum('flight','train','bus') DEFAULT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`idvoyage`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`idvoyage`, `villedepart`, `villearriver`, `datedepart`, `datearriver`, `heuredepart`, `heurearrive`, `capacite`, `outile`, `prix`) VALUES
(1, 'Tangier', 'Nador', '2022-03-12', '2023-03-12', '17:15:00', '23:50:00', 19, 'train', 220),
(2, 'Tangier', 'Ad Dakhla', '2022-03-09', '2023-03-10', '10:05:00', '18:12:00', 150, 'flight', 550),
(4, 'Marrakech', 'Agadir', '2022-03-01', '2023-03-02', '22:35:00', '02:15:00', 150, 'train', 100),
(5, 'Fes', 'Laayoune', '2022-03-18', '2023-03-04', '21:10:00', '10:15:00', 90, 'train', 250),
(6, 'Al Hoceima', 'Oujda-Angad', '2022-03-10', '2023-03-10', '16:45:00', '23:55:00', 56, 'bus', 350),
(7, 'Ksar El Kebir', 'Tetouan', '2022-03-03', '2023-03-03', '12:05:00', '14:00:00', 73, 'bus', 100),
(8, 'Fes', 'Tetouan', '2022-04-05', '2023-04-06', '22:25:00', '02:00:00', 250, 'train', 120),
(11, 'Agadir', 'Tangier', '2022-03-08', '2023-03-08', '20:00:00', '23:00:00', 200, 'flight', 670);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `billet_ibfk_2` FOREIGN KEY (`idvoyage`) REFERENCES `voyage` (`idvoyage`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `billet_ibfk_3` FOREIGN KEY (`idtour`) REFERENCES `specialstours` (`idtour`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`UserName`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `specialstours`
--
ALTER TABLE `specialstours`
  ADD CONSTRAINT `specialstours_ibfk_1` FOREIGN KEY (`idcateg`) REFERENCES `specialtourscategories` (`idcate`) ON DELETE CASCADE ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

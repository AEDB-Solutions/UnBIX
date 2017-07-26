-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: UnBix_database
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Complaints`
--

DROP TABLE IF EXISTS `Complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Complaints` (
  `ComplaintID` bigint(20) NOT NULL AUTO_INCREMENT,
  `IDuser` bigint(20) NOT NULL,
  `LocalID` bigint(20) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `Descricao` varchar(140) NOT NULL,
  `Categoria` enum('Iluminacao','Banheiro','Bebedouro','Infraestrutura','Seguranca','Barulho','Outro') NOT NULL,
  `Emergencia` enum('1','2','3','4','5') DEFAULT NULL,
  `Likes` int(11) DEFAULT NULL,
  `Dislikes` int(11) DEFAULT NULL,
  `Averiguado` tinyint(4) DEFAULT NULL,
  `Time` bigint(20) DEFAULT NULL,
  `Deleted` tinyint(4) DEFAULT NULL,
  `Validade` tinyint(4) DEFAULT '0',
  `Pronto` bigint(20) DEFAULT '0',
  PRIMARY KEY (`ComplaintID`),
  KEY `IDuser` (`IDuser`),
  KEY `LocalID` (`LocalID`),
  CONSTRAINT `Complaints_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `Users` (`Userid`),
  CONSTRAINT `Complaints_ibfk_2` FOREIGN KEY (`LocalID`) REFERENCES `Localidades` (`localID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Complaints`
--

LOCK TABLES `Complaints` WRITE;
/*!40000 ALTER TABLE `Complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `Complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cursos`
--

DROP TABLE IF EXISTS `Cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cursos` (
  `Cursoid` bigint(20) NOT NULL AUTO_INCREMENT,
  `Curso_Nome` varchar(300) NOT NULL,
  PRIMARY KEY (`Cursoid`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cursos`
--

LOCK TABLES `Cursos` WRITE;
/*!40000 ALTER TABLE `Cursos` DISABLE KEYS */;
INSERT INTO `Cursos` VALUES (1,'Administração'),(2,'Agronomia'),(3,'Arquiterura e Urbanismo'),(4,'Arquivologia'),(5,'Artes Cênicas'),(6,'Artes Visuais'),(7,'Biblioteconomia'),(8,'Biotecnologia'),(9,'Ciência da Computação'),(10,'Ciência Política'),(11,'Ciências Ambientais'),(12,'Ciências Biológicas'),(13,'Ciências Contábeis'),(14,'Ciências Econômicas'),(15,'Ciências Sociais'),(16,'Computação'),(17,'Comunicação Social'),(18,'Design'),(19,'Direito'),(20,'Educação Artística'),(21,'Educação Física'),(22,'Enfermagem'),(23,'Engenharia Ambiental'),(24,'Engenharia Civil'),(25,'Engenharia de Computação'),(26,'Engenharia de Produção'),(27,'Engenharia de Redes de Comunicação'),(28,'Engenharia Elétrica'),(29,'Engenharia Florestal'),(30,'Engenharia Mecânica'),(31,'Engenharia Mecatrônica'),(32,'Engenharia Química'),(33,'Estatística'),(34,'Farmácia'),(35,'Filosofia'),(36,'Física'),(37,'Geofísica'),(38,'Geologia'),(39,'Gestão de Agronegócios'),(40,'História'),(41,'Gestão de Políticas Públicas'),(42,'Jornalismo'),(43,'Letras'),(44,'Letras-Tradução'),(45,'Letras-Tradução Espanhol'),(46,'Língua de Sinais Brasileira/Português como Segunda Língua'),(47,'Línguas Estrangeiras Aplicadas-MSI'),(48,'Matemática'),(49,'Matemática - Segunda Licenciatura'),(50,'Medicina'),(51,'Medicina Veterinária'),(52,'Museologia'),(53,'Música'),(54,'Nutrição'),(55,'Odontologia'),(56,'Pedagogia'),(57,'Pedagogia - Primeira Licenciatura'),(58,'Psicologia'),(59,'Química'),(60,'Química Tecnológica'),(61,'Relações Internacionais'),(62,'Saúde Coletiva'),(63,'Serviço Social'),(64,'Teoria Crítica e História da Arte'),(65,'Turismo'),(66,'Administração Pública'),(67,'Artes Visuais'),(68,'Teatro');
/*!40000 ALTER TABLE `Cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Localidades`
--

DROP TABLE IF EXISTS `Localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Localidades` (
  `localID` bigint(20) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `descricao` varchar(140) NOT NULL,
  `keypoint` tinyint(1) NOT NULL,
  `categoria` enum('Banheiro M','Bebedouro','Banheiro F','Indefinido') DEFAULT 'Indefinido',
  PRIMARY KEY (`localID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Localidades`
--

LOCK TABLES `Localidades` WRITE;
/*!40000 ALTER TABLE `Localidades` DISABLE KEYS */;
INSERT INTO `Localidades` VALUES (1,-15.763611793518066,-47.872989654541016,'Banheiro F. Mecânica',1,'Banheiro F'),(2,-15.763364791870117,-47.872657775878906,'Banheiro M. Mecânica',1,'Banheiro M'),(3,-15.763545036315918,-47.872962951660156,'Bebedouro Mecânica',1,'Bebedouro'),(4,-15.763463,-47.872682,'Banheiro F. Civil',1,'Banheiro F'),(5,-15.76313,-47.87244,'Banheiro M. Civil',1,'Banheiro M'),(6,-15.763412,-47.872575,'Bebedouro Civil',1,'Bebedouro'),(7,-15.763226,-47.872365,'Banheiro F. Elétrica',1,'Banheiro F'),(13,-15.763121,-47.87229,'Banheiro M. Elétrica',1,'Banheiro M'),(14,-15.763615,-47.872089,'Banheiro F. CA Redes',1,'Banheiro F'),(15,-15.763798,-47.871858,'Banheiro M. CA Redes',1,'Banheiro M'),(16,-15.76399,-47.872359,'Banheiro F. Florestal',1,'Banheiro F'),(17,-15.763845,-47.872583,'Banheiro M. Florestal',1,'Banheiro M'),(18,-15.764227,-47.872733,'Banheiro F. CA Mecatrônica',1,'Banheiro F'),(19,-15.764234,-47.872384,'Banheiro M. CA Mecatrônica',1,'Banheiro M'),(20,-15.763295,-47.871307,'Banheiro F. Amarelinho',1,'Banheiro F'),(21,-15.762996,-47.871501,'Banheiro M. Amarelinho',1,'Banheiro M'),(22,-15.761768,-47.870217,'Bebedouro ICC Norte Corredor',1,'Bebedouro'),(23,-15.76077,-47.870824,'Banheiro F. Departamento História',1,'Banheiro F'),(24,-15.760757,-47.870808,'Banheiro M. Departamento História',1,'Banheiro M'),(25,-15.760688,-47.870813,'Bebedouro Departamento História',1,'Bebedouro'),(26,-15.761155,-47.870743,'Banheiro M. Departamento de Filosofia',1,'Banheiro M'),(27,-15.761202,-47.870709,'Banheiro F. Departamento de Filosofia',1,'Banheiro F'),(28,-15.760885,-47.870781,'Bebedouro Departamento de Filosofia',1,'Bebedouro'),(29,-15.761998,-47.870378,'Banheiro Departamento de Serviço Social',1,'Banheiro M'),(30,-15.762002,-47.870438,'Banheiro F. Departamento de Serviço Social',1,'Banheiro F'),(31,-15.761976,-47.870485,'Bebedouro Departamento de Serviço Social',1,'Bebedouro'),(32,-15.761543,-47.870512,'Banheiro F. Departamento de Geografia',1,'Banheiro F'),(33,-15.761571,-47.870548,'Banheiro M. Departamento de Geografia',1,'Banheiro M'),(34,-15.761856,-47.870402,'Bebedouro Departamento de Geografia',1,'Bebedouro'),(35,-15.763711211457998,-47.87113845348358,'banana de pijama',0,'Indefinido');
/*!40000 ALTER TABLE `Localidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Session`
--

DROP TABLE IF EXISTS `Session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Session` (
  `UserID` bigint(20) NOT NULL,
  `IDcomplaint` bigint(20) NOT NULL,
  `Value` tinyint(4) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `IDcomplaint` (`IDcomplaint`),
  CONSTRAINT `Session_c` FOREIGN KEY (`IDcomplaint`) REFERENCES `Complaints` (`ComplaintID`) ON DELETE CASCADE,
  CONSTRAINT `Session_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`Userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Session`
--

LOCK TABLES `Session` WRITE;
/*!40000 ALTER TABLE `Session` DISABLE KEYS */;
/*!40000 ALTER TABLE `Session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `Userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `Curso` bigint(20) DEFAULT NULL,
  `Nome` varchar(500) NOT NULL,
  `Matricula` bigint(20) NOT NULL,
  `Email` varchar(500) NOT NULL,
  `Senha` text NOT NULL,
  `Genero` enum('M','F','Outro') DEFAULT NULL,
  `Power` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Userid`),
  KEY `Curso` (`Curso`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`Curso`) REFERENCES `Cursos` (`Cursoid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-25 21:38:21

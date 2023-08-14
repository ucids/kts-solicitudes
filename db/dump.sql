


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table articulos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articulos`;

CREATE TABLE `articulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `solicitud_id` int DEFAULT NULL,
  `numero_parte` varchar(100) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `notas` varchar(100) DEFAULT NULL,
  `cerrado` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'FALSE',
  `cantidad_entregada` int DEFAULT '0',
  `fk_almacen` int DEFAULT NULL,
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  `cantidad_recibida` int DEFAULT NULL,
  `entregada` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitud_id` (`solicitud_id`),
  CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;

INSERT INTO `articulos` (`id`, `solicitud_id`, `numero_parte`, `cantidad`, `precio`, `unidad`, `descripcion`, `notas`, `cerrado`, `cantidad_entregada`, `fk_almacen`, `fecha_entrega`, `cantidad_recibida`, `entregada`) VALUES
	(108, 44, '9090', 1, 2399.00, 'Caja', 'Modem', NULL, 'TRUE', 1, 46, '2023-07-28 01:32:55', 1, NULL),
	(111, 45, 'I-930', 3, 199.00, 'calca', 'Calca', NULL, 'TRUE', NULL, 46, '2023-07-27 20:40:16', 3, NULL),
	(112, 44, '9091', 2, 2399.00, 'Caja', 'Modem', NULL, 'TRUE', 2, 46, '2023-07-28 01:49:35', 2, 'TRUE'),
	(115, 47, '121212', 142, 1000.00, 'pieza', 'sillas', NULL, '0', 123, 46, '2023-08-14 04:35:40', 123, '0'),
	(118, 48, '001', 16, 40.00, 'piezas', 'fixtura oblicua', NULL, '1', 16, 46, '2023-08-09 22:00:40', 16, '1'),
	(119, 49, 'i-9000', 2, 9000.00, 'Caja', 'Procesador', NULL, '1', 2, 46, '2023-08-09 20:13:02', 2, '1');

/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table departamento
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `id_departamento` int NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;

INSERT INTO `departamento` (`id_departamento`, `departamento`) VALUES
	(1, 'Envios'),
	(2, 'Materiales'),
	(3, 'RH'),
	(4, 'Mejora Continua'),
	(5, 'Seguridad e Higiene'),
	(6, 'Mantenimiento'),
	(7, 'Calidad'),
	(8, 'Ingenieria'),
	(9, 'Tool Crib'),
	(10, 'Entrenamiento'),
	(11, 'Enfermeria'),
	(12, 'Compras'),
	(13, 'Gerencia'),
	(14, 'Almacen');

/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table estatus_solicitud
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estatus_solicitud`;

CREATE TABLE `estatus_solicitud` (
  `id_estado` int NOT NULL,
  `descripcion_estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `estatus_solicitud` WRITE;
/*!40000 ALTER TABLE `estatus_solicitud` DISABLE KEYS */;

INSERT INTO `estatus_solicitud` (`id_estado`, `descripcion_estado`) VALUES
	(0, 'Nueva solicitud'),
	(1, 'En revisión'),
	(2, 'Aprobada por supervisor'),
	(3, 'Rechazada'),
	(4, 'Aprobada por gerente'),
	(5, 'Registrada por departamento de compras'),
	(6, 'Llegada a almacén'),
	(7, 'Entregada por almacén'),
	(8, 'Finalizada'),
	(9, 'Pendiente Almacen');

/*!40000 ALTER TABLE `estatus_solicitud` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table log_solicitud
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log_solicitud`;

CREATE TABLE `log_solicitud` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `fk_solicitud` int DEFAULT NULL,
  `fk_user` int DEFAULT NULL,
  `fk_status` int DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table proveedores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(100) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=930 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;

INSERT INTO `proveedores` (`id`, `proveedor`, `numero`, `direccion`, `telefono`) VALUES
	(617, 'A & M Ring De Mexico S De Rl De Cv', 554, 'Industrial Delta Omicron', '4779629170'),
	(618, 'Agr Precision Tools S De Rl De Cv', 333, 'Rancho El Aguila Aguila Azteca', NULL),
	(619, 'Agua Hielo Baja Sa De Cv', 419, 'Ejido Chilpancingo Murua', NULL),
	(620, 'Aguilar Castro Froylan', 194, 'Zona Centro Calle 8Va', '664-6340454'),
	(621, 'Alcaraz Sanchez Teresa De Jesus', 514, 'Reforma Paseo Reforma', '6898223'),
	(622, 'Alvarez Santos Juan Jose', 501, ' ', NULL),
	(623, 'Anabel Velazquez Lujan', NULL, 'Calle Ave. Martires De Chicago No. Exterior 731 Colonia  Obrera 1Era Seccion Cp 22625', '664 103 5949'),
	(624, 'Angel Gopar Uribe', NULL, NULL, NULL),
	(625, 'Aparicio Aparicio Delmar', 829, ' Victor Islas Parra', '6645175185'),
	(626, 'Arcangeles Hospital S.A De C.V', 166, 'Guanajuato Guadalajara', '6868059'),
	(627, 'Arcangeles Hospital S.A. De C.V.', NULL, 'Av. Guadalajara No. 6908 Col. Guanajuato22640', NULL),
	(628, 'Arena Vazquez Bruno', 516, 'Zona Centro Madero', '682-2414'),
	(629, 'Arguello Oros Martin', 616, 'Infonavit Villas De Baja Calif De Todos Los Santos', '975-54-66'),
	(630, 'Arturo Gonzalez Avila', NULL, NULL, NULL),
	(631, 'Arturo Parra Bojorquez', NULL, 'Calle Alamos 20101 Buenos Aires Norte ', '(664) 103-55-79'),
	(632, 'Avalos Cerpas Maria Del Rocio', 607, 'Lucio Blanco Valente Cordero', '(664) 113-5568'),
	(633, 'Baez Gerardo Rolando', 699, 'El Pedregal Pedregal', '6646216266'),
	(634, 'Baja Inflables Sa', 322, 'Altabrisa Calzada Tecnologico', NULL),
	(635, 'Baja Paint Sa De Cv', 189, 'Los Españoles Federico Benitez', NULL),
	(636, 'Baja Paints.A. De C.V.', NULL, 'Boulevard Federico Benitez No. 320 Fracc. Los Españoles', '6646291781 664629819'),
	(637, 'Baja Safety De Mexico S De Rl De Cv', 793, 'Mariano Matamoros Norte Ruta Matamoros', '6646299847'),
	(638, 'Bajapaint Sa De Cv', 189, 'Los Españoles Federico Benitez', NULL),
	(639, 'Balderrama Garcia Juan Francisco', 599, 'Rio Tijuana 3Ra Etapa Paseo Del Rio', '9067144'),
	(640, 'Barragan Rangel Luis Enrique', 551, 'Obrera 1A Seccion Martires De Chicago', '664 628-8719'),
	(641, 'Basculas Y Sistemas Industriales Demexico Sa De Cv', 713, 'Insurgentes Oeste Josefina Haro', '6649765551'),
	(642, 'Beltronica S.A. De C.V.', 209, 'Zona Centro Av. Constitucion', '6859560'),
	(643, 'Benitez Nunez Julio Cesar', 814, 'Santa Elena Blvc Federico Benitez', '6646282838'),
	(644, 'Benitez Nuñez Julio Cesar', 814, 'Santa Elena Blvc Federico Benitez', '6646282838'),
	(645, 'Bermudes Jasso Hector Manuel', 670, 'Capistrano Infonavit Privada Río Guadiana', '6643809685'),
	(646, 'Betancourt Ramirez Carlos Enrique', 72, 'Nueva Tijuana Av Lopez Portillo Ponient', NULL),
	(647, 'Bio Regeneradora De Baja Californiasa De Cv', 493, 'Ejido Tampico Carr. Aeropuerto', '6642804243'),
	(648, 'Bravo Rangel Ricardo', 271, 'Fracc. Mision De Las Californi Priv. Mision San Javier', '6457503'),
	(649, 'Bucio Castillo Jose', 647, 'Lomas Del Campestre Lomas Del Alamo', '8112559184'),
	(650, 'Buenavista Tirado Juan Ricardo', 820, 'Mariano Matamoros Norte 1Ro De Mayo', '6642848379'),
	(651, 'Cabanillas Leal Ada Graciela', 253, 'Asentamiento 17 De Mayo Av Marmoleros', '1761839'),
	(652, 'Cafe La Negrita Sa De Cv', NULL, 'Zona Centro Calle 6Ta Flores Magon', NULL),
	(653, 'Cafe La Negrita S.A. De C.V.', 191, 'Zona Centro Calle 6Ta Flores Magon', '6211130'),
	(654, 'Cafeterias Y Cocinas Ricardos S.A. De C.V.', NULL, NULL, NULL),
	(655, 'Camara Nacional De La Industria De Transformacion Delegacion En Tijuana Baja C', 424, ' ', NULL),
	(656, 'Candido Valenzuela Eguino', NULL, 'Blvd. Diaz Ordaz No. 3557 Int No. 2 ', NULL),
	(657, 'Carbajal Centeno Rosa Maria', 94, 'Colonia Calle', 'Telefono'),
	(658, 'Cardenas Cornejo Luis Enrique', 780, 'Otay Constituyentes Aeropuerto', '6646243292'),
	(659, 'Cardenas Ramos Karen Ivette', 134, 'Otay Constituyentes Calzada Tecnologico', NULL),
	(660, 'Casa Diaz De Maquinas De Coser S.A. De C.V.', 180, 'Obrera Fray Servando Teresa De Mier', NULL),
	(661, 'Casa Diaz De Maquinas De Coser Sa De Cv', 77, 'Colonia Calle', '6224125'),
	(662, 'Casa Segovia Thompson Sa De Cv', 466, ' ', NULL),
	(663, 'Castaneda Fuentes Augusto Danilo', 52, 'Playas De Tijuana Seccion El De La Cima', NULL),
	(664, 'Castro Jorge', 706, 'Fuentes Del Valle Pedro Rosales De Leon', NULL),
	(665, 'Centercomm Jm S De Rl De Cv', 145, 'Chepevera Dr Angel Martinez Villareal', NULL),
	(666, 'Cet Industrial Sa De Cv', 716, 'Constitucion Del 17 Chihuahua', '6646892867'),
	(667, 'Christian Aaron Garcia', NULL, 'Boulevard Agua Caliente 11988 6 Agua Caliente 22024', NULL),
	(668, 'Christian Martin Cordova Sanchez', NULL, NULL, NULL),
	(669, 'Coaching Ejecutivo Del Noroeste Sc', 420, 'Zona Urbana Río Tijuana Paseo De Los Héroes', NULL),
	(670, 'Colegio De Educacion Profesional Tecnica Del Estado De Bc', 155, ' ', NULL),
	(671, 'Comander De Baja California Sa De Cv', 269, 'Anexa 20 De Noviembre Prolongacion Paseo De Los Heroes', '6222345'),
	(672, 'Comedores De Hospitalidad Saludablessa De Cv', 687, 'Recursos Hidraulicos De Calle 1', '6642696329'),
	(673, 'Comercializadora De Frecuencias Satelitales S De Rl De Cv', 453, ' ', NULL),
	(674, 'Comercializadora De Frecuencias Satelitales S. De R.L. De C.V.  ', NULL, NULL, NULL),
	(675, 'Comercializadora De Frecuencias Satelitales S. De R.L. De C.V.', 453, ' ', NULL),
	(676, 'Comercializadora De Pan S.A. De C.V.', 256, 'Zona Centro Blvd. Agua Caliente', '6 84 74 90'),
	(677, 'Contreras Sugich Mariana De Jesus', 394, ' ', NULL),
	(678, 'Controles Industriales Mecatronicasa De Cv', 725, 'Jardin Dorado Azucenas', '6643839892'),
	(679, 'Coorporacion De Asesoria En Proteccionsentry S De Rl De Cv', 74, 'Colinas De San Jeronimo Blvd Puerta Del Sol', NULL),
	(680, 'Corporativo Sns Sa De Cv', 747, 'Obispado Privada Liendo Sur', '8112888180'),
	(681, 'Cortez Guzman Maria Del Rosario', 729, ' San Ramiro', '6648105440'),
	(682, 'Cortinas De Acero Fronteriza Sa De Cv', 317, 'La Mesa Av Ferrocarril Km 8.5', '6262126'),
	(683, 'Cota Rodelo Luis Enrique', 480, 'Lomas De La Amistad Ejercito Trigarante', '664 300 0376\t\t'),
	(684, 'Creadores De Espacios Excepcionales Mober Sa De Cv', 349, 'Prados Del Centenario Reforma', NULL),
	(685, 'Cristaclara S.A. De C.V', 82, 'Chilpancingo Murua', '6477065'),
	(686, 'Cristaclara Sa De Cv', 82, 'Chilpancingo Murua', '6477065'),
	(687, 'Cuellar Cansino Mario Alberto', 13, 'Fracc Acapulco Calle San Felipe', NULL),
	(688, 'D Alba Eventos S De Rl De Cv', NULL, NULL, NULL),
	(689, 'Damian Marin Andres', 771, 'Machado Norte La Paz', '6611109125'),
	(690, 'Dias Orduñez Ramon', 219, 'Playas De Tijuana Agua Marina', NULL),
	(691, 'Diaz Orduñez Ramon', 351, ' ', NULL),
	(692, 'Diplasticca Sa De Cv', 826, 'Lomas Altas Av Paseo De La Reforma', '5519195625'),
	(693, 'Diseño E Ingenieria En Automatizacion Sa De Cv', 817, 'Rio Tijuana 3Ra Etapa Blvd Insurgentes', '6649695650'),
	(694, 'Dm Tecnologias Sa De Cv', NULL, 'Guillermo Laveaga #3869 Col. Pemex Culiacan Sinaloa', '6677147878'),
	(695, 'Ega Industrial Electrico Sa De Cv', 694, 'Santa Maria Del Granjeno Juan Jose Torres Landa', '6951225204'),
	(696, 'Ega Industrial Tijuana Sa De Cv', 719, 'Centro Ignacio Zaragoza', '6951225204'),
	(697, 'Electronica Steren De Tijuana Sa De Cv', 218, 'Zona Centro Calle Segunda Juarez', '6851898'),
	(698, 'Electronica Steren Sa De Cv', 284, 'San Salvador Xochimanca Biologo Maximino Martinez', '6851898'),
	(699, 'Empresas Baja Sa De Cv', 618, 'Zona Urbana Rio Tijuana Paseo Centenario', '664 753-07-99'),
	(700, 'Empresas Syes Sa De Cv', 60, 'Fracc Jardin Dorado Calle Dalias', '7014444'),
	(701, 'Equihua Salgado Roberto', 210, 'Libertad Aquiles Serdan', NULL),
	(702, 'Equipos Industriales Californias Sa De Cv.', 821, 'Rio Tijuana 3Ra Etapa Via Rapida Oriente', '6646345194'),
	(703, 'Escudero Chavez Daniel', 248, 'Valle Del Angel Valle Verde', NULL),
	(704, 'Espacios E Imagen De Oficina Sa De Cv', 483, 'Rio Tijuana 3Ra Etapa Via Rapida Oriente', NULL),
	(705, 'Especialistas En Finanzas Y Economia Sc', 531, 'Zona Urbana Rio Tijuana Paseo De Los Heroes', '6643433311'),
	(706, 'Espinosa Castillo Enrique', 427, ' ', NULL),
	(707, 'Espinoza Dicochea Eduardo Hiram', 808, 'La Cienega Poniente Av. Jose De San Martin', '6644835579'),
	(708, 'Estrada Gonzalez Raul', 346, 'Zona Este Novena Y Pio Pico', '6855228'),
	(709, 'Excell Fumigadora Sa De Cv', 555, '20 De Noviembre Gabilondo Soler', '9710402'),
	(710, 'Fierro Garcia Cosme Fernando', 636, 'Buenos Aires Sur Bahia Concepcion', '664-629-5801\t\t'),
	(711, 'Figueroa Campusano Mayde', 597, 'Ejido Francisco Villa Popotla', '6631215967'),
	(712, 'Figueroa Galvan Jose Jesus', 389, 'Ejido Francisco Villa Popotla', NULL),
	(713, 'Flor Airam Ruiz Gonzalez', NULL, 'Carretera Tecate- Tijuana Km.8 Col. Paso Del Águila C.P. 21470 Tecate B.C ', NULL),
	(714, 'Flores Rincon Martha Esther', 153, ' ', NULL),
	(715, 'Forklifts De La Frontera S.A. De C.V.', 125, 'Guadalajara La Mesa Atemajac', '6868837      9720547'),
	(716, 'Forklifts De La Frontera Sa De Cv', NULL, 'Calle Atemajac No. 35 - A Guadalajara La Mesa', '(664) 686-8837'),
	(717, 'Formas Metalicas Del Pacifico Sa De Cv', 196, 'Jose Sandoval Av. De Los Charro', '3802270'),
	(718, 'Fuentes Brotantes De Tijuana Sa De Cv', 441, 'Fracc. Garcia Av. Guadalupe', '9023829'),
	(719, 'Fuentes Gonzalez Victor Manuel', 347, ' ', NULL),
	(720, 'Futufarma Sa De Cv', 345, 'Centro Victoria', '0'),
	(721, 'Galaxi Electrica S De Rl De Cv', 350, 'Ejido Fco Villa Ii Seccion 10', '6644486483'),
	(722, 'Garcia Garza Hector', 583, 'Heroe De Nacozari Av 29 De Junio', '6865499910'),
	(723, 'Gastroequipos Industriales Sa De Cv', 667, 'Revolucion Agua Caliente', '6646829700'),
	(724, 'Gavila Iii Jewell Philip Anthony', 70, 'Jardin Dorado Av Margaritas', NULL),
	(725, 'General De Insumos Industriales Sa De Cv', 161, 'Fracc. Rubio La  Mesa Av.  34  Sur', '6890171'),
	(726, 'Gerardo Alberto Olivas Quintero', NULL, 'Rio De La Concepción # 10369-1', NULL),
	(727, 'Gil Villavicencio Jorge Adulfo', 819, 'Terrazas De La Presa La Encantada', '6641890514'),
	(728, 'Gis Sewing Machine S De Rl De Cv', 502, 'El Dorado Residencial Priv. Mineral Del Oro', '(664) 3174827'),
	(729, 'Gis Sewing Machine S De Rl De Cv', 502, 'El Dorado Residencial Priv. Mineral Del Oro', '(664) 3174827'),
	(730, 'Godinez Gomez Ayesha Elizabeth', 187, ' ', NULL),
	(731, 'Godinez Perez Jorge Alberto', 32, 'Playas De Tijuana De Las Rocas', 'Telefono'),
	(732, 'Gomez Gomez Olga Lidia', 360, ' ', NULL),
	(733, 'Gonzalez Avila Arturo', 115, 'Aguaje De La Tuna Rio De La Concepcion', '6366861'),
	(734, 'Gonzalez Lopez Raul', 192, 'Roma Viena', NULL),
	(735, 'Gopar Uribe Angel', 164, 'Zona Centro 9Na', NULL),
	(736, 'Graciano Vejar Melanie Aglael', 714, '20 De Noviembre Las Americas', '6647369045'),
	(737, 'Graffiti Digital Sa De Cv', 237, ' Boulevard Insurgentes', '9720272'),
	(738, 'Granados Vallejo Jesus', 772, 'Las Huertas 5Ta Secc C', '6646890909'),
	(739, 'Granite Galery S De Rl De Cv', NULL, NULL, NULL),
	(740, 'Gruas Y Maniobras De Tijuana Sa De Cv', NULL, 'Calle Santa Elena #6050 Rio Tijuana', '(664) 626 1226 Y 686'),
	(741, 'Grupo Comercial Yazbek Sa De Cv', NULL, NULL, NULL),
	(742, 'Grupo Electromecanico Del Noroeste  S.A. De C.V.', 9, ' Vasco De Quiroga', NULL),
	(743, 'Grupo Electromecanico Del Noroeste Sa Cv', 9, '20 De Noviembre Vazco De Quiroga', NULL),
	(744, 'Grupo Industrial Gilsam S De Rl De Cv', 329, 'Altamira Sur Calz Ermita Norte Los Españoles', '6262252'),
	(745, 'Grupo Industrial Gilsam S De Rl De Cv.', NULL, 'Avenida Ermita Norte N. 201 Col.Españoles  Tijuana Bc Cp.22104', NULL),
	(746, 'Grupo Lv S De Rl De Cv', 813, 'Revolucion Av Rio Bravo', '6646346710'),
	(747, 'Grupo Plavex Sa De Cv', 598, 'Valle Del Campestre Ricardo Margain Zozaya', '6643930593'),
	(748, 'Grupo Uno Consultoria S De Rl De Cv', 512, ' Zona Urbana Rio Tijuana Bc C. Paseo De Los Heroes 10231 301', '6312219'),
	(749, 'Grupo Uno Consultoria S. De R.L. De C.V.', NULL, NULL, NULL),
	(750, 'Guerrero Basulto Jonathan Uziel', 273, 'Otro Estado 29', NULL),
	(751, 'Guerrero Martinez Ivette Guadalupe', 123, 'Infonavot Presidentes Agustin Iturbide', '6649717923'),
	(752, 'Guerrero Martinez Jesus Antonio', 185, 'Infonavit Agustina Iturbide', '9717923'),
	(753, 'Guzman Medel Luis Fabian', 116, 'Colonia Avenida Juan Ojeda Robles', '6820116'),
	(754, 'Hector Reyna Esteban', NULL, 'Boulevard Tres De Octubre No. 10238 Int. Manzana 72 Lote 5', '6897395'),
	(755, 'Hernandez Gonzalez Juan Jose', 795, 'La Escondida Marte', '(664) 292 7209'),
	(756, 'Hernandez Herrera Daniel', 201, 'Villa Fontana Blvd Cucapah', ' (664)701-97-36'),
	(757, 'Hernandez Reyes Alfonso', 730, 'Progreso Nacional 17', '5555122621'),
	(758, 'Hernandez Rivera Joshua', 789, 'Pradera Dorada Rancho Las Pampas', '6561679515'),
	(759, 'Hurtado Perez Jose De La Luz', 661, 'El Pipila Culiacan', '6641720139'),
	(760, 'I Source Noroeste S De Rl De Cv', 791, 'Internacional Tijuana Produccion', '6646249460'),
	(761, 'Ibarra Flores Marine', 627, 'Florido 2A Seccion El Refugio', '664 8370140\t\t'),
	(762, 'Icr Sa De Cv', 357, 'Zona Urbana Rio Tijuana Paseo De Los Heroes', '6334223'),
	(763, 'Impulsora Altair Del Noroestesa De Cv', 524, 'Zona Urbana Rio Tijuana Avenida Dr. Atl', '6851771'),
	(764, 'Impulsora Comercial Y Serviciosindustriales Sa De Cv', 704, 'Reforma Negrete', '6616131434'),
	(765, 'Industrial Castor Sa De Cv', 285, 'Soler Rafael Buelna', '6804141'),
	(766, 'Industrial Com S.A. De C.V.', 629, 'Parque Industrial De La Plata', '6643459246\t\t'),
	(767, 'Industrial Com Sa De Cv', 629, 'Parque Industrial De La Plata', '6643459246\t\t'),
	(768, 'Industrial Safety De Mexico Sa De Cv', 235, 'El Porvenir Principal', NULL),
	(769, 'Industrial Safety De México Sa De Cv', NULL, 'El Porvenir C. Principal', NULL),
	(770, 'Industrial Safety De Mexico S.A De C.V.', 97, 'El Porvenir C. Principal', NULL),
	(771, 'Industrial Work Shoes S De Rl De Cv', 624, 'Camino Verde (Cañada Verde) Libramiento', '(664) 6083978\t\t'),
	(772, 'Ingenieria Vectorial S De Rl De Cv', 770, 'Acapulco San Felipe', '6461829908'),
	(773, 'Ingenieria Y Administracion Estrategicasa De Cv', 700, 'Guillen Puebla', '6641045144'),
	(774, 'Innovacion Farmaceutica Sa De Cv', 803, 'Las Americas Del Plan', '6649065343'),
	(775, 'Instituto Fibonacci De Ciencias Para La Salud Y La Educacion S C', NULL, 'Camino Ejido Matamoros No. 470 Col. Lomas Del Matamoros Cp: 22206', NULL),
	(776, 'Inversiones Montana Sa De Cv', 368, 'Revolucion Blvd. Agua Caliente', '(664) 625-1379'),
	(777, 'Inzunza Bueno Jose Luis', 503, ' ', NULL),
	(778, 'Janisource Distribuidores S De Rl De Cv', 143, 'Sepanal Av. Mexicali', NULL),
	(779, 'Jimenez Torres Samuel Adiel', 726, 'Ribera Del Bosque Olmos', '6645423132'),
	(780, 'Jimenez Zamudio Marisela', 444, ' ', NULL),
	(781, 'Jm Services Bc S De Rl De Cv', 590, 'Jardines Del Lago Lazaro Cardenas', '6865565624'),
	(782, 'Joka Servicios Y Suministross De Rl De Cv', 809, 'Gas Y Anexas Borgia', '6631065796'),
	(783, 'Jopak Construcciones Sa De Cv', 179, 'Hipodromo Calle Tapachula', NULL),
	(784, 'Jose Martin Esquer Figuero', NULL, NULL, NULL),
	(785, 'Jose Martin Esquer Figueroa', NULL, NULL, NULL),
	(786, 'Kafco De Mexico Sa De Cv', 229, 'Ciudad Industrial Nueva Tijuan Calle Tres Sur', '6074640'),
	(787, 'Kafco De Mexico S. A. De C.V.', 230, 'Ciudad Industrial Nueva Tijuan Calle Tres Sur', '6074640'),
	(788, 'Keyence Mexico Sa De Cv', 553, 'Cuauhtemoc Paseo De La Reforma', '01-800-Keyence (539'),
	(789, 'Laboratorio Jaba Sa De Cv', 628, 'Garita De Otay Garita De Otay', '6561754402'),
	(790, 'Lavadores Tecnicos Sa De Cv', 99, 'Colonia Calle', 'Telefono'),
	(791, 'Lectra Systemes Sa De Cv', 40, 'Insurgentes Mixcoac Cadiz', NULL),
	(792, 'Ligac Comercial Universal S.A. De C.V.', 593, 'Otay Constituyentes Av. General Lazaro Cardenas', '6232110'),
	(793, 'Live Baja Building S De Rl De Cv', 650, 'Rancho Chula Vista Derecho De Via Cfe', '6611121439'),
	(794, 'Logistica De Reciclaje Industrial Masts De Rl De Cv', 423, 'Garita De Otay Fray Juniperro  Serra', '6646076778'),
	(795, 'Lopez Castillo Rayito De Luna', 812, ' El Colibri', '6642562128'),
	(796, 'Lopez Gonzalez Javier De Jesus', 649, 'Playas De Tijuana Lluvia', '664 3755234'),
	(797, 'Lopez Lopez Ricardo Daniel', 790, 'Cerro Colorado 2Da. Secc Blvd Los Insurgentes', '6642928455'),
	(798, 'Lopez Orozco Ruben Eduardo', 550, 'Playas De Tijuana Seccion El D Paseo Pedregal', '664 315 1066'),
	(799, 'Maniobras De Precision Sa De Cv', 7, 'Florido Carr Tecate Carretera Tijuana-Mexicali Km 16.4', '9013064'),
	(800, 'Maniobras De Precision S.A. De C.V.', NULL, 'Carretera Tijuana-Mexicali Km 16.4-092.20 No. Sn Int. No. A3 Florido 1A. Seccion 22237', NULL),
	(801, 'Mantenimiento Y Servicios Industrialesla Gloria S De Rl De Cv', 370, 'Mariano Matamoros Norte Francisco Javier Mina', NULL),
	(802, 'Maqherr Solutions Sa De Cv', 805, ' Zertuche', '6462069830'),
	(803, 'Maqtex Sa De Cv', 731, 'La Mesa Boulevard Diaz Ordaz', '6641045262'),
	(804, 'Maquinado De Procesos Especiales Pemaq Sa De Cv', 827, 'Ejido Francisco Villa 2Da Secc La Encantada', '6641884371'),
	(805, 'Mar Valenzuela Sergio', 529, 'Aeropuerto Internacional', '623-5936'),
	(806, 'Maria De Los Angeles Mora Pina', NULL, 'Calle Privada Violetas No. Exterior 9905 No. Interior 36 Colonia Cañadas Del Florido ', NULL),
	(807, 'Marisela Jimenez Zamudio', NULL, NULL, NULL),
	(808, 'Martha Esther Flores', NULL, NULL, NULL),
	(809, 'Martin Del Campo Landeros Pamela', NULL, NULL, NULL),
	(810, 'Mascindustrial S De Rl De Cv', 701, 'Industrial Pacifico Ii Pacifico', '6649059599'),
	(811, 'Medam S. De R.L. De C.V.', 584, 'Atlampa Fresno', '664 4060148\t\t'),
	(812, 'Mendez Hernandez Deyanira Del Rosario', 458, ' ', NULL),
	(813, 'Metal Synergy Group S. R. L. De C.V.', NULL, NULL, NULL),
	(814, 'Miguel Angel Cota Bravo', NULL, NULL, NULL),
	(815, 'Miller Freight De Mexico S De Rl De Cv', 392, 'Zona Urbana Rio Tijuana Blvd Sanchez Taboada', NULL),
	(816, 'Moises Olvera Barrios', NULL, 'Calle Andalucia 3523 Col. Murua 22520 Tijuana Baja California México', '(664)596-4678'),
	(817, 'Mondragon Ordaz Jose Angel Gustavo', 102, 'Colonia Calle', 'Telefono'),
	(818, 'Montaño Fimbres Rosa Del Carmen', 449, ' ', NULL),
	(819, 'Montes De Oca Hilados Sa De Cv', 297, 'Francisco Villa Rio De La Plata', '6377845'),
	(820, 'Montes De Oca Textil Sa De Cv', 291, 'Francisco Villa Rio De La Plata', NULL),
	(821, 'Mora Piña Maria De Los Angeles', 220, 'Cañadas Del Florido Privada Violetas', NULL),
	(822, 'Morales Mosqueda Sergio Javier', 359, 'Pro Hogar Rio Culiacan', '(686) 567-17-06\t'),
	(823, 'Moreno Cuevas Jesus Anahi', 586, 'Madero Hermosillo', '6084095'),
	(824, 'Morzan Corporation Sa De Cv', 625, 'Fortin De Las Flores Anahuac', '664 689-0770 \t\t'),
	(825, 'Mosso Cienfuegos Yeimi', 195, 'Castro Av. Mariscal Sucre', NULL),
	(826, 'Motores Y Controles Electricos S De Rl De Cv', 335, 'Parque Industrial Pacifico Blvd Pacifico', '6260949'),
	(827, 'Movimiento Y Fluido Industrial Sa De Cv', 525, 'La Campiña Avenida De La Campiña', '664 104 03 20'),
	(828, 'Mro Supply Sa De Cv', 388, 'Cuauhtémoc Norte Callejón Cuba', '6865682145'),
	(829, 'Multieventos Corp S De Rl De Cv', 678, 'Los Españoles Av Ermita', '6646087769'),
	(830, 'Nortec S.A. De C.V.', 494, ' Miguel Aleman', '3336754050'),
	(831, 'Nutrimex Loza S De Rl De Cv', 437, ' ', NULL),
	(832, 'Oasis  Mx S. De R.L. De C.V', 448, ' ', NULL),
	(833, 'Ochoa Torres Mauricio', 69, 'Colonia Calle', NULL),
	(834, 'Office Depot De Mexico Sa De Cv', 113, 'Col Tlatilco Av Jardin', '6216561'),
	(835, 'Office Depot De México Sa De Cv', NULL, 'Juan Salvador Agraz # 101 Santa Fe Cuajimalpa De Morelos Df 05348', '6646216561'),
	(836, 'Oficemart Sa De Cv', 787, 'Nueva Francisco I. Madero', '6646892823'),
	(837, 'Ofimueble De Baja California Sa De Cv', 677, 'Zona Urbana Rio Tijuana General Sanchez Taboada', '6642084907'),
	(838, 'Ojeda Ramos Jorge Ismael', 56, 'Colonia Calle', 'Telefono'),
	(839, 'Olivas Quintero Gerardo Alberto', 296, 'El Aguaje De La Tuna 1Ra Secci Rio De La Concepcion', '6646262600'),
	(840, 'Olmos Olmos Armando', 414, ' ', NULL),
	(841, 'Olvera Diaz Mariela', 433, 'Reforma Decima', NULL),
	(842, 'Omaña De Lara Eduardo Alfonso', 214, 'Fracc. La Sierra Av. Popocatepetl', '664-684-4430'),
	(843, 'Ornelas Rubio Roberta', 690, 'Playas De Tijuana Seccion Cost Prolongacion Paseo Playas', NULL),
	(844, 'Ortiz Zamora David Abraham', 78, 'Colonia Calle', 'Telefono'),
	(845, 'P I Profesional Innovatton S De Rlde Cv', 305, 'San Marino Circuito Benevento', NULL),
	(846, 'Pablo Ulises Arellano Pelagio', NULL, NULL, NULL),
	(847, 'Parra Bojorquez Mara Cecilia', 471, ' ', NULL),
	(848, 'Perez Garcia Leonardo Alejandro', 691, 'Ejido Matamoros Vista Hermosa', '6648305521'),
	(849, 'Pitones Salazar Edgardo', 207, 'Los Españoles Blvd. Federico Benitez', NULL),
	(850, 'Prado Carrillo Ismael', 499, ' ', NULL),
	(851, 'Profesional De Eventos Sa De Cv', 781, 'Col. Juarez Ave. Television', '6646339093'),
	(852, 'Proservind De Bc Sa De Cv', 203, 'Libertad Pino Suarez', NULL),
	(853, 'Proteus Consulting De Mexico Sa De Cv\t\t', 620, 'Tomas Aquino Churubusco', '664 686-1106\t\t'),
	(854, 'Proyectarq Integradora Occidente S De Rlde Cv', 367, 'Col. Arcos Sur Francisco De Quevedo', '33-3271-6534'),
	(855, 'Quintero Angulo Juan Manuel', 26, 'Otay Constituyentes Blvd Industrial Mercado Plaza Otay', '6237483'),
	(856, 'Ramón Días Orduñez', NULL, 'Calle Agua Marina # 771 Playas Secc. Coronado C.P. 22504', NULL),
	(857, 'Raul Gonzalez Lopez', NULL, NULL, NULL),
	(858, 'Recicladora Temarry De México S.A. De C.V.', NULL, 'Carretera Federal Número 2 Mexicali Tijuana Km. 121 San Pablo Tecate B.C. C.P.21530', '(665)655-1462'),
	(859, 'Recicladora Temarry De Mexico Sa De Cv', 133, 'Colonia Calle', 'Telefono'),
	(860, 'Recolectora De Desechos Y Residuos Kingkong Sa De Cv', 92, 'Colonia Calle', 'Telefono'),
	(861, 'Redysoft Sas De Cv', 799, 'Buenaventura Francisco De Ulloa', '6641820258'),
	(862, 'Renteria Hernandez Edmundo Pedro', 279, '20 De Noviembre Prol. Paseo De Los Heroes', '6210466'),
	(863, 'Reyes Gomez Jose Gabriel', 707, 'Villa Del Real Xi San Diego', '6641035831'),
	(864, 'Reyes Calderon Roberto', 602, 'Padre Kino Mision Santa Ines', '664 219 71 53'),
	(865, 'Reyna Esteban Hector', 117, 'Manzana 72 Lote 5 3 De Octubre Boulevard Tres De Octubre', NULL),
	(866, 'Reyna Rodriguez Jose Raymundo', 785, '3 De Octubre Blvd 3 De Octubre', '6641100455');
INSERT INTO `proveedores` (`id`, `proveedor`, `numero`, `direccion`, `telefono`) VALUES
	(867, 'Ricardo Uriel Rodriguez Martinez', NULL, NULL, NULL),
	(868, 'Rico Copiadoras Fax Sa De Cv', 128, 'Jardines De San Carlos Blvd. Diaz Ordaz', '6646811103'),
	(869, 'Rico Copiadoras Fax S.A. De C.V.', 128, 'Jardines De San Carlos Blvd. Diaz Ordaz', '6646811103'),
	(870, 'Rios Solis Felipe Alfredo', 717, 'Florido 3A Seccion Girasol', '6631490213'),
	(871, 'Robledo Contreras Gerardo Alberto', 106, 'Colonia Calle', 'Telefono'),
	(872, 'Rodinmex S De Rl De Cv', 585, 'Guaycura Av. Del Águila', '6645248262'),
	(873, 'Rodriguez Martinez Ricardo Uriel', 465, ' ', NULL),
	(874, 'Rodriguez Sanchez Luis Antonio', 390, 'Pedregal De Santa Julia Av. Jose Maria Morelos', '6344971'),
	(875, 'Rojano Jimenez Pedro', 147, 'Buenos Aires Sur Bahia Concepcion', '6294042'),
	(876, 'Romero Silva Juan Carlos', 62, 'Colonia Calle', 'Telefono'),
	(877, 'Rotulos And Signs Tj Sa De Cv', 797, 'Jardin Dorado Fresno', '664 1035831'),
	(878, 'Rubio Reyes Elias', 186, 'Jardines Del Rubi Maneadero', NULL),
	(879, 'Rueda Salomon Miguel Angel', 228, 'Nueva Aurora General Arnulfo Arnaiz', NULL),
	(880, 'Ruiz Cedillo Edgar', 783, 'Jardines De La Mesa Diaz Ordaz', '(664) 355 3830'),
	(881, 'Ruiz Gonzalez Flor Airam', 231, 'Paso Del Aguila Carretera Tkt Tijuana Km 8', NULL),
	(882, 'Salon De Eventos Mahavira Sa De Cv', 249, 'Rio Tijuana Priv Benton', NULL),
	(883, 'Servicios De Transporte Y Logistica Galisa S De Rl De Cv', NULL, NULL, NULL),
	(884, 'Servicios Escolares Integrales S De Rl De Cv', 478, ' ', NULL),
	(885, 'Servicios Escolares Integrales S De Rl De Cv ', NULL, 'Blvd. Fundadores  Colonia El Rubi #6428  C.P. 22626', NULL),
	(886, 'Servicios Ind De Inv Y Seguridad Privadasa De Cv', 104, 'Colonia Calle', 'Telefono'),
	(887, 'Servicios Integrales S De Rl De Cv ', NULL, 'Blvd. Fundadores  Colonia El Rubi #6428  C.P. 22626', NULL),
	(888, 'Servicios Preventivos En Salud Ocupacional Sc', 105, 'Colonia Calle', 'Telefono'),
	(889, 'Servicios Y Logistica Eba S De Rl De Cv', 697, 'Puesta Del Sol Cometa', '6646092800'),
	(890, 'Sicocsa Sa De Cv', 64, 'Independencia Ave Pipila', NULL),
	(891, 'Sodexo Motivation Solutions Mexico Sa Decv', 4, 'Lomas De Chapultepec Paseo De La Reforma', '18001101999'),
	(892, 'Soldaduras Especializadas De Sonorasa De Cv', 467, 'Sahuaro Enrique Quijada', '6645338175'),
	(893, 'Strong Tech Safety S De Rl De Cv', 594, 'Mariano Matamoros Centro Ruta Matamoros', '(664) 545 56 40'),
	(894, 'Suarez Carrillo Walther Hiram', 100, 'Tijuana Blvd. Agua Caliente', '9710899'),
	(895, 'Sya Procesadora Industrial Sa De Cv', 136, 'Garita De Otay C Fray Junipero Serra', '6076778'),
	(896, 'T Seguridad Electronica Privada Sa', 18, 'Zona Centro Miguel Hidalgo', NULL),
	(897, 'T Seguridad Electronica S.A.', 15, 'Zona Centro Calle 8A', NULL),
	(898, 'Taner Organizadora De Espacios Sa De Cv', 655, 'Vallejo Paganini', '554333 0000\t\t'),
	(899, 'Tecnicas Industriales Quimicas Sa De Cv', 773, 'Presa Rodriguez Asfalto', '6644058768'),
	(900, 'Tecno All De Mexico Sa De Cv', 788, 'Ciudad Industrial Cinco Sur', '6646821244'),
	(901, 'Telco Produce Service S.C.', 22, 'Colonia Calle', 'Telefono'),
	(902, 'Telecomunicaciones Aplicadas Sa De Cv', 233, 'Buena Vista Av. De Las Lomas', NULL),
	(903, 'Teresa De Jesus Alcaraz Sanchez\t\t', NULL, NULL, NULL),
	(904, 'Tijuana Bowling Sa De Cv', 410, 'San Jose Av. Via Rapida Poniente', NULL),
	(905, 'Torres Ramirez Martha', 385, ' Angostura 15326 Campestre', NULL),
	(906, 'Toyota Lift Rentals Sa De Cv', NULL, 'Venustiano Carranza #2000 Gonzalez Ortega', NULL),
	(907, 'Toyotalift De Bc Sa De Cv', 150, 'Col Gonzalez Ortega Blvd. Venustiano Carranza', '5928237'),
	(908, 'Toyotalift De Bc Sa De Cv ', NULL, 'Carretera Aeropuerto #416 Fracc. Garita De Otay\t', NULL),
	(909, 'Transporte De Personal Libertad Tijuanasa De Cv', 724, 'Industrial Pacifico Pacifico', '6641655009'),
	(910, 'Transportes De Personal Coras Sa De Cv', 66, 'Colonia Calle', 'Telefono'),
	(911, 'Turismos Klingu Sa De Cv', 286, 'Chapultepec Aguacaliente', NULL),
	(912, 'Uline Shipping Supplies S De Rl De Cv', 103, 'Colonia Calle', '01-800-295-5510'),
	(913, 'Uniformes Industriales Barba S En Nc Decv', 828, 'Colinas Del Sol Cenzontle', '6646888077'),
	(914, 'V Y R Asesores En Salud Ocupacional Sc', 157, 'Otay Constituyentes Centro Comercial', '6 82 29 13'),
	(915, 'Valdez Castel Carlos', 617, 'El Lago Boulevard  Insurgentes', '664-102-5101'),
	(916, 'Valencia Campos Jesus Antonio', 681, 'Garita Otay Av Jose Ma Salvatierra', '6641655009'),
	(917, 'Valencia Carrera Oscar Fidel', 654, 'Benton Benton', '6645148113'),
	(918, 'Valenzuela Holguin Ignacio Martin', 824, 'Ampliacion Guaycura Santa Catarina', '6643540166'),
	(919, 'Valenzuela Rodriguez Adrian', 165, 'Ejido Islas Agrarias A Felipa Velazquez Viuda De Arellano', NULL),
	(920, 'Vargas Meza Sergio Cesar', 455, ' ', NULL),
	(921, 'Vazquez Hoyos Simon', 341, 'Lomas Del Porvenir Ave. Baja California', NULL),
	(922, 'Velazquez Castillo Delia Adriana', 160, 'Fracc. Residencial Del Bosque Privada De Los Narcisos', NULL),
	(923, 'Velazquez Lujan Anabel', 511, 'Obrera 1Ra. Seccion Calle Ave. Martires De Chicago', '6641035949'),
	(924, 'Velazquez Vazquez Oscar Otoniel', 438, 'Roberto De La Madrid Quinta', '6643972759'),
	(925, 'Velazquez Velazquez Sergio', 565, ' ', NULL),
	(926, 'Verjan Guerrero Victor Hugo', 712, 'Playas De Tijuana Seccion Jard Paseo Del Pedregal', '6641700338'),
	(927, 'Victor Hugo Nuñez Ponce', NULL, NULL, NULL),
	(928, 'Vls Recovery Services De Mexico Sa De Cv', 810, 'Ciudad Industrial Nueve Sur', '6641183139'),
	(929, 'Yeimi Mosso Cienfuegos', NULL, NULL, NULL);

/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
	(1, 'Admin'),
	(2, 'Compras'),
	(3, 'Gerente'),
	(4, 'Supervisor'),
	(5, 'Solicitante'),
	(6, 'Almacen');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table solicitudes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `solicitudes`;

CREATE TABLE `solicitudes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(100) DEFAULT NULL,
  `proyecto` varchar(100) DEFAULT NULL,
  `solicitante` varchar(100) DEFAULT NULL,
  `notas` text,
  `fk_user` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(3) DEFAULT NULL,
  `divisa` varchar(3) DEFAULT NULL,
  `urgente` tinyint(1) DEFAULT '0',
  `folio` int DEFAULT NULL,
  `ipos` varchar(100) DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `fk_supervisor` int DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `cerrado` varchar(10) DEFAULT NULL,
  `notas_almacen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departamento` (`fk_departamento`),
  KEY `fk_supervisor` (`fk_supervisor`),
  CONSTRAINT `fk_departamento` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id_departamento`),
  CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`fk_supervisor`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;

INSERT INTO `solicitudes` (`id`, `proveedor`, `proyecto`, `solicitante`, `notas`, `fk_user`, `status`, `tipo`, `divisa`, `urgente`, `folio`, `ipos`, `fk_departamento`, `fecha_aprobacion`, `fk_supervisor`, `rate`, `fecha_entrega`, `cerrado`, `notas_almacen`) VALUES
	(44, 'WWW', 'Internet', NULL, 'Falla el Internet\r\n', 45, 7, 'op', 'MXN', 0, NULL, 'IPOS2', 8, NULL, 44, 0, '2023-07-28 01:51:20', 'FALSE', NULL),
	(45, 'Zsh', 'Cualifica', '45', 'Casa de juan', 45, 7, 'tj', 'USD', 0, NULL, 'IPOS1', 8, NULL, 44, 16.7, '2023-07-28 01:50:10', 'FALSE', NULL),
	(47, 'Godinez Perez Jorge Alberto', 'sillas costura', '44', 'sillas viejas', 47, 9, 'op', 'MXN', 0, NULL, 'I-929291', 8, NULL, 44, 0, NULL, 'FALSE', ''),
	(48, 'Agr Precision Tools S De Rl De Cv', 'fixturas nuevas', '42', 'fuxturas de costura nuevas', 47, 8, 'op', 'USD', 0, NULL, '189', 8, NULL, 44, 16.8, '2023-08-07 17:50:20', 'FALSE', 'Notas locas.com'),
	(49, 'Cabanillas Leal Ada Graciela', 'Pollos', NULL, 'Buen Procesador', 47, 8, 'op', 'MXN', 0, NULL, '190', 8, NULL, 44, 0, '2023-08-07 07:21:05', 'FALSE', 'Pedido llego completo');

/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_rol` int DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fk_departamento` int DEFAULT NULL,
  `scope` json DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_rol` (`fk_rol`),
  KEY `fk_departamento` (`fk_departamento`),
  CONSTRAINT `fk_rol` FOREIGN KEY (`fk_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `fk_rol`, `nombre`, `apellidos`, `fk_departamento`, `scope`) VALUES
	(41, 'ucid', '$2y$10$PPshzfQeTWpUSwUR0usxH.kydY1JRMEqWFI5BPqBeC/VuHBpBhGu.', 'ucid@allsafeit.com', 1, 'Uriel', 'Cid', 4, '[1,2,3,4,5,6,7,8,9,10]'),
	(42, 'vfuentes', '$2y$10$4ibau6yhDJnLcig0V1c/OeNiFFTWs12/sXZtpkJ/bcjkmLJmmayoO', 'vfuentes@allsafeit.com', 3, 'victor', 'fuentes', 13, '[1,2,3,4,5,6,7,8,9,10,11,12,13]'),
	(43, 'kiara', '$2y$10$xdmyLTC9CYgg4Y7280a0DOeMix3bnP4dyj1OgtjpANHvXkkX7HkFG', 'kiara@katzkin.com', 2, 'Kiara', 'Gonzalez', 12, '[1,2,3,4,5,6,7,8,9,10,11,12,13]'),
	(44, 'chikis', '$2y$10$qzCezewiYuqZHrA3Whs68ufftC1yFMx.DMOE2ytWWu4kIO74PWDfu', 'chikis@katzkin.com', 4, 'Edgar', 'chikis', 8, '[8,6]'),
	(45, 'qc', '$2y$10$x/qP0UVLqSZ0I0kFWBC8C.l4e/xxddDrfLHgs3blD5ethKEXDdqvq', 'qc@katzkin.com', 5, 'qc', 'Calidad', 8, '[8]'),
	(46, 'almacen', '$2y$10$.urrNpzKapKm2M7CH0VOV.MNW3pevz1/Iw3/CPGTRyKLmOFtk4i0O', 'almacen@katzkin.com', 6, 'almacen', 'yarp', 14, '[1,2,3,4,5,6,7,8,9,10,11,12,13]'),
	(47, 'sewing', '$2y$10$.urrNpzKapKm2M7CH0VOV.MNW3pevz1/Iw3/CPGTRyKLmOFtk4i0O', 'sewing@katzkin.com', 5, 'Sewing', 'P', 8, '[8]');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



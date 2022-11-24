-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2022 a las 17:06:03
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nullpointer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `id` int(11) NOT NULL,
  `director` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id`, `director`) VALUES
(1, 'Martin Scorsese'),
(2, 'Stanley Kubrick'),
(3, 'Steven Allan Spielberg'),
(4, 'Christopher Nolan'),
(5, 'Alfred Joseph Hitchcock'),
(6, 'John Lasseter'),
(7, 'Neil Burger'),
(8, 'Chris Columbus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `genero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `genero`) VALUES
(1, 'comedia'),
(2, 'accion'),
(3, 'romantica'),
(4, 'ciencia fi'),
(5, 'terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(10) NOT NULL,
  `resultado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `fecha`, `accion`, `resultado`) VALUES
(1, 'luismi', '2022-11-24 16:09:23', 'Insert fil', 'Acción realizada correctamente'),
(2, 'admin', '2022-11-24 16:15:21', 'Update fil', 'Modificación de la pelicula 1 realizada correctamente'),
(3, 'admin', '2022-11-24 16:15:42', 'Update fil', 'Modificación de la pelicula 1 realizada correctamente'),
(4, 'admin', '2022-11-24 16:49:59', 'Update fil', 'Modificación de la pelicula 38 realizada correctamente'),
(5, 'admin', '2022-11-24 16:50:03', 'Delete fil', 'La pelicula 38 ha sido borrada correctamente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `pelicula` varchar(40) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `director` int(11) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `url_trailer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `pelicula`, `genero`, `director`, `descripcion`, `url`, `url_trailer`) VALUES
(1, 'El lobo de Wall Street', 1, 1, 'El prestigioso cineasta Martin Scorsese ha llevado a la gran pantalla la historia basada en hechos reales del corredor de bolsa neoyorquino Jordan Belfort (Leonardo DiCaprio). Empezando por el sueño americano, hasta llegar a la codicia corporativa a finales de los ochenta, Belfort pasa de las acciones especulativas y la honradez, al lanzamiento indiscriminado de empresas en Bolsa y la corrupción. Su enorme éxito y fortuna cuando tenía poco más de veinte años como fundador de la agencia bursátil Belfort le valió el mote de \"El lobo de Wall Street\".', 'ellobodewallstreet.jpg', 'https://www.youtube.com/watch?v=DO_96Ee_qWw&ab_channel=UniversalSpain'),
(2, 'Shutter Island', 5, 1, 'En el verano de 1954, los agentes judiciales Teddy Daniels (DiCaprio) y Chuck Aule (Ruffalo) son destinados a una remota isla del puerto de Boston para investigar la desaparición de una peligrosa asesina (Mortimer) que estaba recluida en el hospital psiquiátrico Ashecliffe, un centro penitenciario para criminales perturbados dirigido por el siniestro doctor John Cawley (Kingsley). Pronto descubrirán que el centro guarda muchos secretos y que la isla esconde algo más peligroso que los pacientes. Thriller psicológico basado en la novela homónima de Dennis Lehane.', 'shutterisland.jpg', 'https://www.youtube.com/watch?v=sybSFbmzyUg&ab_channel=TERRORLAND-TierraDeTerror-'),
(3, 'El aviador', 2, 1, 'Biografía del polifacético Howard Hughes, un hombre que con el poco dinero que heredó de su padre se trasladó a Hollywood, donde amasó un gran fortuna. Fue uno de los productores más destacados del cine americano durante las décadas de los treinta y los cuarenta.', 'El_aviador.jpg', 'https://www.youtube.com/watch?v=LhPphTTGYLw&ab_channel=PabloCasta%C3%B1eda'),
(4, 'La naranja mecánica', 4, 2, 'Gran Bretaña, en un futuro indeterminado. Alex (Malcolm McDowell) es un joven muy agresivo que tiene dos pasiones: la violencia desaforada y Beethoven. Es el jefe de la banda de los drugos, que dan rienda suelta a sus instintos más salvajes apaleando, violando y aterrorizando a la población.', 'La_naranja_mecanica.jpg', 'https://www.youtube.com/watch?v=A1eC4pG8rC0&ab_channel=KokyD.M.'),
(5, 'El resplandor', 5, 2, 'Jack Torrance se traslada con su mujer y su hijo de siete años al impresionante hotel Overlook, en Colorado, para encargarse del mantenimiento de las instalaciones durante la temporada invernal, época en la que permanece cerrado y aislado por la nieve.', 'El_resplandor.jpg', 'https://www.youtube.com/watch?v=IiSjPcRWjYA&ab_channel=TERRORLAND-TierraDeTerror-'),
(6, '2001: A Space Odyssey', 4, 2, 'La película de ciencia-ficción por excelencia de la historia del cine narra los diversos periodos de la historia de la humanidad, no sólo del pasado, sino también del futuro. Hace millones de años, antes de la aparición del \"homo sapiens\", unos primates descubren un monolito que los conduce a un estadio de inteligencia superior', 'odiseaenelespacio.jpg', 'https://www.youtube.com/watch?v=yS4Xu6FeWNY&ab_channel=DavidG.Maciejewski'),
(7, 'Poltergeist ', 5, 3, 'Una joven familia recibe la visita de fantasmas en su propia casa. Al principio las apariciones parecen amistosas, mueven objetos en la casa, lo que divierte a sus ocupantes. Pero entonces se vuelven agresivos y comienza una espiral de terror que termina con la desaparición de la hija pequeña.', 'poltergeist.jpg', 'https://www.youtube.com/watch?v=rjfK14dBrjc&ab_channel=20thCenturyStudiosEspa%C3%B1a'),
(8, 'Transformers', 4, 3, 'Dos razas de robots extraterrestres transformables (los villanos \"decepticons\" y los amistosos \"autobots\") llegan a la Tierra en busca de una misteriosa fuente de poder. En la guerra que estalla entre las dos razas, los hombres toman partido por los \"autobots\". S', 'transformer.jpg', 'https://www.youtube.com/watch?v=B_CzSjhOGzM&ab_channel=CocochaChannel'),
(9, 'Cars', 1, 6, 'El aspirante a campeón de carreras Rayo McQueen parece que está a punto de conseguir el éxito, la fama y todo lo que había soñado, hasta que por error toma un desvío inesperado en la polvorienta y solitaria Ruta 66. ', 'Cars.jpg', 'https://www.youtube.com/watch?v=SbXIj2T-_uk&ab_channel=N.B.'),
(10, 'Psicosis ', 5, 5, 'Marion Crane, una joven secretaria, tras cometer el robo de un dinero en su empresa, huye de la ciudad y, después de conducir durante horas, decide descansar en un pequeño y apartado motel de carretera regentado por un tímido joven, Norman Bates, que vive en la casa de al lado con su madre.', 'Psicosis.jpg', 'https://www.youtube.com/watch?v=mC2gOyWuSEY&ab_channel=amboliatoto'),
(11, 'El Ilusionista', 2, 7, 'El Ilusionista es una película de 2006 escrita y dirigida por Neil Burger y protagonizada por Edward Norton, Jessica Biel, Rufus Sewell y Paul Giamatti. La película está basada en la novela \"Eisenheim the Illusionist\" escrita por Steven Millhauser.\r\n\r\nEn la Viena de principios de siglo XX, Eisenheim (Edward Norton) es un misterioso mago cuyo espectáculo de ilusionismo cautiva a la población.', 'El_ilusionista.jpg', 'https://www.youtube.com/watch?v=uAt3kiJgzKM&ab_channel=Recomiendo%23Cine'),
(12, 'Harry Potter y la orden del fenix', 2, 8, 'Comienza la rebelión! Lord Voldemort ha regresado, pero el Ministerio de Magia está haciendo todo lo posible para ocultar la verdad al mundo de los magos, designando, incluso, a la engañosa Dolores Umbridge como nueva profesora de Defensa contra las Artes Oscuras.', 'Harry_potter_y_el_caliz_de_fuego.jpg', 'https://www.youtube.com/watch?v=jdEulcjAvQI&ab_channel=HBOMaxLatinoam%C3%A9rica'),
(13, 'Inception', 4, 4, 'Dom Cobb es un calificado ladrón que roba secretos valiosos de lo más profundo del subconsciente durante el sueño. La rara habilidad de Cobb lo ha convertido en un codiciado jugador en el mundo del espionaje corporativo, pero también lo ha convertido en un fugitivo que le ha costado todo lo que alguna vez ha amado', 'inception.jpg', 'https://www.youtube.com/watch?v=YoHD9XEInc0&ab_channel=RottenTomatoesClassicTrailers'),
(14, 'The Dark Knight', 2, 4, 'La continuación de Batman Begins, El Caballero Oscuro, vuelve a reunir al director Christopher Nolan y a su protagonista Christian Bale, quien interpreta de nuevo su papel de Batman/Bruce Wayne en su lucha contra el crimen. Con la ayuda del teniente Jim Gordon (Gary Oldman) y el nuevo y comprometido fiscal del distrito Harvey Dent, Batman se propone destruir para siempre el crimen organizado en la ciudad de Gotham.', 'caballerooscuro.jpg', 'https://www.youtube.com/watch?v=EXeTwQWrcwY&ab_channel=RottenTomatoesClassicTrailers'),
(15, 'Interstellar', 4, 4, 'Al ver que la vida en la Tierra está llegando a su fin, un grupo de exploradores decide embarcarse en la que puede ser la misión más importante de la historia de la humanidad y emprender un viaje más allá de nuestra galaxia en el que descubrirán si las estrellas pueden albergar el futuro de la raza humana.\r\n De la mano del prestigioso director Christopher Nolan (saga El caballero oscuro, Origen) nos llega Interstellar, una película protagonizada por los ganadores de un Oscar® Matthew McConaughey (Dallas Buyers Club) y Anne Hathaway (Los Miserables), la nominada a los Oscar®', 'interstellar.jpg', 'https://www.youtube.com/watch?v=UoSSbmD9vqc&ab_channel=WarnerBros.PicturesEspa%C3%B1a'),
(16, 'Harry Potter y el caliz de fuego', 2, 8, 'Este año, Howgarts será la sede del Torneo de los Tres Magos, una de las competiciones mágicas más apasionantes y peligrosas de la comunidad de magos. Se elegirá un campeón de cada uno de los tres colegios de magia más grandes y prestigiosos. Cuando el nombre de Harry Potter aparece en el encantado Cáliz de Fuego para representar a Howgarts, Harry tiene que competir en una serie de peligrosas pruebas para ganar la Copa de los Tres Magos.', 'harrypotterylaordendelfenix.jpg', 'https://www.youtube.com/watch?v=wX5dWfUKGPg&ab_channel=HBOMaxLatinoam%C3%A9rica'),
(39, 'pepe2', 4, 4, 'fdsgfh', 'hfgkj', 'https://www.youtube.com/watch?v=H0dbkCSfIrk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `userName` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `rol` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userName`, `password`, `rol`) VALUES
('admin', 'admin', 'admin'),
('admin2', 'admin', NULL),
('admin3', 'admin', NULL),
('admin4', 'admin', NULL),
('prueba', '123', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genero` (`genero`),
  ADD KEY `director` (`director`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `directores`
--
ALTER TABLE `directores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`genero`) REFERENCES `generos` (`id`),
  ADD CONSTRAINT `peliculas_ibfk_2` FOREIGN KEY (`director`) REFERENCES `directores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

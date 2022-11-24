create database nullPointer;
use nullPointer;
CREATE USER nullPointer IDENTIFIED BY "123";
GRANT ALL PRIVILEGES ON nullPointer.* TO nullPointer;
CREATE TABLE users (
    userName varchar(25) not null,
    password varchar(25) not null,
    rol varchar(5),
    primary key (userName)
);
CREATE TABLE generos (
    id int AUTO_INCREMENT,
    genero varchar(10),
    primary key(id)
);
CREATE TABLE directores(
    id int AUTO_INCREMENT,
    director varchar(25),
    primary key(id)
);
CREATE TABLE peliculas(
    id int AUTO_INCREMENT,
    pelicula varchar(25),
    genero int,
    director int,
    descripcion varchar(140),
    url varchar(100),
    url_trailer varchar(100),
    primary key (id),
    FOREIGN KEY (genero) REFERENCES generos(id),
    FOREIGN KEY (director) REFERENCES directores(id)
);
CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(10) NOT NULL,
  `resultado` varchar(200) NOT NULL
);
INSERT INTO `directores` (`id`, `director`) VALUES (NULL, 'Martin Scorsese'), (NULL, 'Stanley Kubrick'), (NULL, 'Steven Allan Spielberg'), (NULL, 'Christopher Nolan'), (NULL, 'Alfred Joseph Hitchcock');
INSERT INTO `generos` (`id`, `genero`) VALUES (NULL, 'comedia'), (NULL, 'accion'), (NULL, 'romantica'), (NULL, 'ciencia ficcion'), (NULL, 'terror');
INSERT INTO `peliculas` (`id`, `pelicula`, `genero`, `director`, `descripcion`) VALUES (NULL, 'El lobo de Wall Street', '1', '1', NULL), (NULL, 'Shutter Island', '5', '1', NULL), (NULL, 'El aviador', '2', '1', NULL), (NULL, 'La naranja mecánica', '4', '2', NULL), (NULL, 'El resplandor', '5', '2', NULL), (NULL, '2001: A Space Odyssey', '4', '2', NULL), (NULL, 'Poltergeist ', '5', '3', NULL), (NULL, 'Transformers', '4', '3', NULL), (NULL, 'Finding Oscar', '2', '3', NULL), (NULL, 'Psicosis ', '5', '5', NULL), (NULL, 'La sombra de una duda', '5', '5', NULL), (NULL, 'The Lady Vanishes', '5', '5', NULL), (NULL, 'Inception', '4', '4', NULL), (NULL, 'The Dark Knight', '2', '4', NULL), (NULL, 'Interstellar', '4', '4', NULL);
INSERT INTO `users` (`userName`, `password`, `rol`) VALUES ('admin', 'admin', 'admin'), ('pepe', '123', NULL);

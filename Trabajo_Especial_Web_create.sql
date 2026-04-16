-- Created by Redgate Data Modeler (https://datamodeler.redgate-platform.com)
-- Last modification date: 2026-04-16 19:34:49.56

-- tables
-- Table: PARTICIPANTE
CREATE TABLE PARTICIPANTE (
    id_elenco int  NOT NULL,
    nombre varchar(100)  NOT NULL,
    nacimiento date  NOT NULL,
    nacionalidad varchar(100)  NOT NULL,
    rol varchar(100)  NOT NULL,
    PELICULA_id_pelicula int  NOT NULL,
    CONSTRAINT PARTICIPANTE_pk PRIMARY KEY (id_elenco)
);

-- Table: PELICULA
CREATE TABLE PELICULA (
    id_pelicula int  NOT NULL,
    titulo varchar(100)  NOT NULL,
    descripcion text  NOT NULL,
    categoria varchar(100)  NOT NULL,
    anio_publicacion int  NOT NULL,
    CONSTRAINT PELICULA_pk PRIMARY KEY (id_pelicula)
);

-- foreign keys
-- Reference: PARTICIPANTE_PELICULA (table: PARTICIPANTE)
ALTER TABLE PARTICIPANTE ADD CONSTRAINT PARTICIPANTE_PELICULA
    FOREIGN KEY (PELICULA_id_pelicula)
    REFERENCES PELICULA (id_pelicula)  
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE
;

-- End of file.


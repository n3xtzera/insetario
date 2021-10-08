CREATE DATABASE aluno_insetario;
USE aluno_insetario;

CREATE TABLE ordem(
    PRIMARY KEY (id),
    id          int(11) NOT NULL AUTO_INCREMENT,
    nome        varchar(60) NOT NULL,
    ncomum      varchar(200) NOT NULL,
    caract      varchar(500),
    controle    varchar(500)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE familia(
    PRIMARY KEY (id),
    id          int(11) NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (id_ordem)
        REFERENCES ordem(id),
    id_ordem    int(11) NOT NULL,
    nome        varchar(60) NOT NULL,
    ncomum      varchar(200) NOT NULL,
    caract      varchar(500),
    controle    varchar(500)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE usuario (
    PRIMARY KEY (id),
    id          int(11) NOT NULL AUTO_INCREMENT,
    nome        varchar(40) NOT NULL,
    email       varchar(40) NOT NULL,
    senha       varchar(40) NOT NULL,
    coordenador boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

insert into usuario 
(nome, email, senha, coordenador)
values ("root", "root@gmail.com", "7b24afc8bc80e548d66c4e7ff72171c5", 1);

CREATE TABLE inseto(
    PRIMARY KEY (id),
    id              int(11) NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (id_familia)
        REFERENCES familia(id),
    id_familia      int(11) NOT NULL,
    nomeCientifico  varchar(60) NOT NULL,
    ncomum          varchar(200) NOT NULL,
    caract          varchar(500),
    controle        varchar(500)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE foto(
    PRIMARY KEY(id),
    id              int(11) NOT NULL AUTO_INCREMENT,
    FOREIGN KEY(id_inseto)
        REFERENCES inseto(id),
    id_inseto       int(11) NOT NULL,
    fotografo       varchar(100),
    coletor         varchar(100) NOT NULL,
    local_          varchar(250),
    foto            blob NOT NULL,
    foto_nome       varchar(150)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;
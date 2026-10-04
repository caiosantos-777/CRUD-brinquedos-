create database if not exists crud_brinquedos
    character set utf8mb4
    collate utf8mb4_unicode_ci;

use crud_brinquedos;

create table if not exists brinquedos (
    id int primary key auto_increment,
    nome varchar(100) not null,
    categoria varchar(50) not null,
    faixa_etaria varchar(30) not null,
    preco decimal(10,2) not null,
    estoque int not null default 0,

    check (preco >= 0),
    check (estoque >= 0)
);

insert into brinquedos (nome, categoria, faixa_etaria, preco, estoque) values
('Bloco de Montar 100 peças', 'Educativo', '3 a 6 anos', 59.90, 25),
('Boneca Articulada', 'Bonecas', '4 a 8 anos', 79.90, 15),
('Carrinho de Controle Remoto', 'Veículos', '6 a 10 anos', 129.90, 10),
('Quebra-Cabeça 200 peças', 'Jogos', '7 a 12 anos', 44.50, 30),
('Chocalho Colorido', 'Bebês', '0 a 12 meses', 19.90, 40),
('Jogo de Tabuleiro Aventura', 'Jogos', '8 anos ou mais', 99.00, 12),
('Massinha de Modelar 12 cores', 'Artes', '3 a 8 anos', 24.90, 50),
('Dinossauro de Borracha', 'Animais', '2 a 5 anos', 34.90, 20);

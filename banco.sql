DROP DATABASE if exists turismo;
CREATE DATABASE IF NOT EXISTS turismo;
USE turismo; -- DROP DATABASE turismo;

CREATE TABLE tb_login(
id_login				INT NOT NULL AUTO_INCREMENT,
usuario				VARCHAR(255) NOT NULL,
senha					VARCHAR(255) NOT NULL,

PRIMARY KEY(id_login)
);

INSERT INTO tb_login (usuario,senha) VALUES 
("Heloa","M0rangu1nho!"),
("Eduardo","Pklkgdv25");

SELECT * FROM tb_login;

CREATE TABLE tb_turismo (
id_turismo			INT NOT NULL AUTO_INCREMENT,
titulo				VARCHAR(255) NOT NULL,
endereco				TEXT NOT NULL,
imagem            varchar(255) NOT NULL,
informacoes       VARCHAR(255) NOT NULL,
telefone       VARCHAR(20) NOT NULL,
id_categoria     INT,
PRIMARY KEY(id_turismo)
);

INSERT INTO tb_turismo (titulo, endereco, imagem, informacoes, telefone, id_categoria) VALUES
('Praia do Sol Nascente', 'Avenida Beira-Mar, 1020', 'colegio_freira.jpg', 'Praia tranquila com águas claras, ideal para banho e prática de esportes.', '(21) 93456-7810', 2),
('Parque das Cachoeiras', 'Rodovia Municipal 210, km 8', 'estacao.jpg', 'Área ampla com trilhas ecológicas, três cachoeiras e espaço para piquenique.', '(31) 98812-4590', 5),
('Cachoeira do Arco-Íris', 'Estrada da Serra Alta, km 12', 'camara_municipal.jpeg', 'Queda d’água colorida ao entardecer, trilha leve e ótimo local para fotos.', '(47) 91234-5678', 3),
('Mirante da Colina Verde', 'Rua das Araucárias, 450 - Centro', 'feira_noturna.jpeg', 'Vista panorâmica da cidade, ideal para caminhadas e observação da natureza.', '(41) 99876-5432', 5),
('Mirante das Estrelas', 'Rua das Pedras, 120 - Centro', 'area-de-exercicios-e.jpg', 'Local ideal para observar o pôr do sol e as estrelas.', '(11) 99999-1111', 1),
('Praia do Horizonte Azul', 'Avenida Litorânea, 500', '7.-palacio-do-cafe2.jpg', 'Praia tranquila, perfeita para famílias e esportes aquáticos.', '(21) 98888-2222', 2),
('Cachoeira Véu de Cristal', 'Estrada da Serra, km 18', 'sp.jpg', 'Cachoeira com trilha leve e área para banho.', '(31) 97777-3333', 3),
('Parque das Araucárias', 'Rodovia Estadual 045, s/n', 'theatro-avenida.jpg','O Mirante das Estrelas é um dos pontos turísticos mais visitados da região, conhecido pela vista panorâmica que oferece do pôr do sol e do céu noturno. Localizado no topo de uma formação rochosa natural, o mirante possui acesso facilitado por uma trilha leve, cercada por vegetação nativa e bancos de madeira para descanso. Ao anoitecer, o ambiente se transforma em um cenário ideal para observar constelações e registrar fotos espetaculares. A área conta com placas informativas sobre astronomia e história local, além de uma pequena estrutura para piqueniques e descanso. É um destino recomendado para famílias, casais e amantes da natureza que buscam tranquilidade e contemplação.', '(41) 96666-4444', 1);

CREATE TABLE tb_categoria(
id_categoria			INT NOT NULL AUTO_INCREMENT,
nome				VARCHAR(255) NOT NULL,
PRIMARY KEY(id_categoria)
);

INSERT INTO tb_categoria(nome) VALUES
("Restaurante"),
("Cafeterias"),
("Pizzaria"),
("Teatro"),
("Parque"),
("Sorveteria"),
("Praças");

SELECT * FROM tb_categoria;

SELECT * FROM tb_turismo ORDER BY id_turismo DESC LIMIT 8;

SELECT * FROM tb_login WHERE usuario = 'admin' AND senha = '123';

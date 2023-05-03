CREATE TABLE IF NOT EXISTS usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    telefone VARCHAR(12) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `cpf` (`cpf`),
    ativa BOOLEAN NOT NULL DEFAULT 0);

CREATE TABLE IF NOT EXISTS entregadores (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    online BOOLEAN NOT NULL DEFAULT 1,
    ultimo_pedido int,
    veiculo varchar(200),
    placa varchar(20),
);

CREATE TABLE IF NOT EXISTS pedidos (
  id INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  id_entregador INT,
  local_de_entrega VARCHAR(100) NOT NULL,
  local_de_busca VARCHAR(100) NOT NULL,
  descricao TEXT NOT NULL,
  peso INT NOT NULL,
  status VARCHAR(200),
  tamanho_pacote VARCHAR(100),
  urgencia BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (id_entregador) REFERENCES entregadores(id),
  date DATETIME,
  rastreio varchar(5) NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  repasse DECIMAL(10,2),
  recebedor varchar(50) NOT NULL,
  nome_recebedor varchar(50),
  doc_recebedor varchar(50),
  vision varchar(700)
);



INSERT INTO usuarios (nome, email, senha, cpf, telefone)
VALUES ('João Silva', 'joao.silva@gmail.com', 'senha123', '11122233344','23123213213');

INSERT INTO entregadores (nome, email, senha, cpf)
VALUES ('Maria Santos', 'maria.santos@gmail.com', 'senha456', '22233344455');

INSERT INTO pedidos (id_usuario, local_de_entrega, local_de_busca, descricao, peso, tamanho_pacote, urgencia,status, rastreio, valor)
VALUES (1, 'Rua A, 123', 'Rua B, 456', 'Caixa com documentos', 2, 'Pequeno', 0, 'ongoing',12345, 12.32);

select * from pedidos;
select * from entregadores;
select* from usuarios;
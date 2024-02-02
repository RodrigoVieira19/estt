<?php

$servername = "localhost"; // Host do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "dados_pessoais"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// verificar a conexao
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>




-- Tabela crud_clientes
CREATE TABLE crud_clientes (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(220) NOT NULL,
    cpf VARCHAR(220) NOT NULL,
    rg VARCHAR(220) NOT NULL,
    email VARCHAR(220) NOT NULL,
    telefone1 INT(11) NOT NULL,
    telefone2 INT(11) NOT NULL,
    data_nascimento DATE NOT NULL,
    ativo INT(11) NOT NULL,
    id_login INT(11) NOT NULL
);

-- Tabela crud_enderecos
CREATE TABLE crud_enderecos (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT(11) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    longadoro VARCHAR(220) NOT NULL,
    numero INT(11) NOT NULL,
    bairro VARCHAR(220) NOT NULL
);

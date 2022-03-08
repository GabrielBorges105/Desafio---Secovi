<?php
require_once("../global/conexao.php");

$queryCreateTablePessoas = "CREATE TABLE IF NOT EXISTS pessoas (id SERIAL PRIMARY KEY, nome TEXT NOT NULL, dt_insercao DATE NOT NULL DEFAULT CURRENT_DATE)";
pg_query($conn, $queryCreateTablePessoas) or die ("Erro ao criar tabela pessoas!");

$queryCreateTableContatos = "CREATE TABLE IF NOT EXISTS contatos (id SERIAL PRIMARY KEY, id_pessoa TEXT NOT NULL, contato TEXT NOT NULL)";
pg_query($conn, $queryCreateTableContatos) or die ("Erro ao criar tabela contatos!");

$queryCreateTableEnderecos = "CREATE TABLE IF NOT EXISTS enderecos (id SERIAL PRIMARY KEY, id_pessoa TEXT NOT NULL, endereco TEXT NOT NULL)";
pg_query($conn, $queryCreateTableEnderecos) or die ("Erro ao criar tabela enderecos!");



$queryInsertPessoa = "INSERT INTO public.pessoas (id, nome) VALUES (1, 'Pessoa 1'), (2, 'Pessoa 2'), (3, 'Pessoa 3'), (4, 'Pessoa 4')";
pg_query($conn, $queryInsertPessoa) or die ('Erro ao inserir pessoa 1, 2, 3 e 4!');

$queryInsertContato = "INSERT INTO public.contatos (id_pessoa, contato) VALUES (1, 'pessoa1@teste.com'), (2, 'pessoa2@teste.com')";
pg_query($conn, $queryInsertContato) or die ('Erro ao inserir contato das pessoas 1 e 2!');

$queryInsertContato = "INSERT INTO public.enderecos (id_pessoa, endereco) VALUES (1, 'rua da pessoa 1, nº 1'), (3, 'rua da pessoa 3, nº 3')";
pg_query($conn, $queryInsertContato) or die ('Erro ao inserir endereco das pessoas 1 e 3!');



$querySelectPessoasComContato = "SELECT pessoas.nome AS nome, contatos.contato AS contato, enderecos.endereco AS endereco, to_char(pessoas.dt_insercao, 'dd/mm/yyyy') AS dt_insercao FROM pessoas, contatos, enderecos WHERE pessoas.id = contatos.id_pessoa";
$result = pg_query($conn, $querySelectPessoasComContato);

if(!$result) die("Erro ao executar query!");

while($row = pg_fetch_assoc($result)){
	echo "=========================<br/><br/>";

	echo "NOME: ".$row["nome"]."<br/>";
	echo "CONTATO: ".$row["contato"]."<br/>";
	echo "ENDEREÇO: ".$row["endereco"]."<br/>";
	echo "DATA DE INSERÇÃO: ".$row["dt_insercao"]."<br/>";

	echo "=========================<br/><br/>";
}

echo "FIM";

?>
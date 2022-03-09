<?php 
require_once("../global/conexao.php");


//get - listar pessoas
if(isset($_GET['listarTodos'])){
    $query = "SELECT p.id AS id, p.nome AS nome, c.contato AS contato, e.endereco AS endereco, to_char(p.dt_insercao, 'dd/mm/yyyy') AS dt_insercao FROM pessoas AS p FULL OUTER JOIN contatos AS c ON c.id_pessoa = p.id FULL OUTER JOIN enderecos AS e ON e.id_pessoa = p.id";
    // $query = "SELECT * FROM pessoas";
    $result = pg_query($conn, $query);
    $row = pg_fetch_all($result);
    echo json_encode($row);
}

//get - visualizar pessoa
elseif(isset($_GET['visualizarPessoa'])){
    $visualizarPessoa = $_GET['visualizarPessoa'];
    $query = "SELECT p.id AS id, p.nome AS nome, c.contato AS contato, e.endereco AS endereco, to_char(p.dt_insercao, 'dd/mm/yyyy') AS dt_insercao FROM pessoas AS p LEFT OUTER JOIN  contatos AS c ON c.id_pessoa = $visualizarPessoa LEFT OUTER JOIN  enderecos AS e ON e.id_pessoa = $visualizarPessoa WHERE  p.id = $visualizarPessoa ";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    echo json_encode($row);

    // echo "psql -U postgres -d teste_secovi -c \"$query\"";
}
//get - cadastrar pessoa
elseif(isset($_GET['cadastrar'])){
    $nome = $_GET['nome'];
    $contato = $_GET['contato'];
    $endereco = $_GET['endereco'];

    $query0 = "SELECT id FROM pessoas ORDER BY DESC LIMIT 1";
    $result0 = pg_query($conn, $query0);
    $row0 = pg_fetch_assoc($result0);
    $id = $row ? $row+1 : 1;
    
    $query1 = "INSERT INTO pessoas(id, nome) VALUES($id, nome = '$nome') ";
    $result1 = pg_query($conn, $query1);
    echo json_encode($query1);

    $query2 = "INSERT INTO contatos(id_pessoa, contato) VALUES ($id, '$contato')";
    $result2 = pg_query($conn, $query2);

    $query3 = "INSERT INTO enderecos(id_pessoa, endereco) VALUES ($id, '$endereco')";
    $result3 = pg_query($conn, $query3);

    if($result1 && $result2 && $result3){
        echo json_encode(["sucesso" => true, "msgm" => "Pessoa cadastrada com sucesso!"]);
    }
}

//get - cadastrar pessoa
elseif(isset($_GET['atualizar'])){
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $contato = $_GET['contato'];
    $endereco = $_GET['endereco'];


    $query1 = "UPDATE pessoas SET nome = '$nome' WHERE id = $id";
    $result1 = pg_query($conn, $query1);
    echo json_encode($query1);

    $query2 = "UPDATE contatos SET contato = '$contato' WHERE id_pessoa = $id";
    $result2 = pg_query($conn, $query2);

    $query3 = "UPDATE enderecos SET endereco = '$endereco' WHERE id_pessoa = $id";
    $result3 = pg_query($conn, $query3);

    if($result1 && $result2 && $result3){
        echo json_encode(["sucesso" => true, "msgm" => "Pessoa atualizada com sucesso!"]);
    }
}

?>
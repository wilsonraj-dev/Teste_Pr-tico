<?php
    $conn = new mysqli("localhost","root", "","teste_pratico");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    
    $result = array('error'=>false);
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM users");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['users'] = $users;
    }

    if($action == 'create'){
        $produto = $_POST['produto'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $sql = $conn->query("INSERT INTO users (produto, descricao, preco) VALUES('$produto', '$descricao', '$preco')");
        
        if($sql){
            $result['message'] = "Produto adicionado com sucesso.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Erro ao cadastrar novo produto.";
        }
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $produto = $_POST['produto'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $sql = $conn->query("UPDATE users SET produto='$produto', descricao='$descricao', preco='$preco' WHERE id='$id'");
        
        if($sql){
            $result['message'] = "Produto atualizado com sucesso.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Erro ao atualizar produto.";
        }
    }

    if($action == 'delete'){
        $id = $_POST['id'];
        
        $sql = $conn->query("DELETE FROM users WHERE id='$id'");
        
        if($sql){
            $result['message'] = "Produto deletado com sucesso.";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Erro ao deletar produto.";
        }
    }

    $conn->close();
    echo json_encode($result);
?>
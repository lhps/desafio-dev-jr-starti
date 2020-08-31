<?php 
  $connection = new mysqli("localhost", "root", "1231591472846", "crud_vue");
  if($connection->connect_error) {
    die("Connection Failed".$connection->connect_error);
  }

  $result = array('error'=>false);
  $action = '';

  if(isset($_GET['action'])){
    $action = $_GET['action'];
  }

  if($action == 'read') {
    $sql = $connection->query("SELECT * FROM users");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
      array_push($users, $row);
    }
    $result['users'] = $users;
  }

  if($action == 'create') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = $connection->query("INSERT INTO users (name, email, phone) 
      VALUES('$name', '$email', '$phone')");

    if($sql) {
      $result['message'] = "Usuário criado com sucesso!";
    } else {
      $result['error'] = true;
      $result['message'] = "Falha ao criar o usuário!";
    }

  }

  if($action == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = $connection->query("UPDATE users SET name='$name',email='$email',phone='$phone' WHERE id='$id'");

    if($sql) {
      $result['message'] = "Usuário atualizado com sucesso!";
    } else {
      $result['error'] = true;
      $result['message'] = "Falha ao atualizar o usuário!";
    }

  }

  if($action == 'delete') {
    $id = $_POST['id'];

    $sql = $connection->query("DELETE FROM users WHERE id='$id'");

    if($sql) {
      $result['message'] = "Usuário deletado com sucesso!";
    } else {
      $result['error'] = true;
      $result['message'] = "Falha ao deletar o usuário!";
    }

  }

  $connection->close();
  echo json_encode($result);
?>
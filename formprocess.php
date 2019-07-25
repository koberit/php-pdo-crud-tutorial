<?php

session_start();

require_once 'classes/crud.php';

$crud = new Crud();

if(isset($_POST['submit'])){
  if(isset($_POST['firstname']) && !empty($_POST['firstname']) &&
     isset($_POST['lastname']) && !empty($_POST['lastname']) &&
     isset($_POST['email']) && !empty($_POST['email'])
  ){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    if($crud->createMember($firstname,$lastname,$email)){
      $_SESSION['msg-class'] = "success";
      $_SESSION['msg'] = "Eintragen war erfolgreich!";

      header('location: index.php');
    }else{
      $_SESSION['msg-class'] = "danger";
      $_SESSION['msg'] = "Es ging etwas schief!";

      header('location: index.php');
    }

  }
}

if(isset($_POST['update'])){
  if(isset($_POST['firstname']) && !empty($_POST['firstname']) &&
     isset($_POST['lastname']) && !empty($_POST['lastname']) &&
     isset($_POST['email']) && !empty($_POST['email']) &&
     isset($_POST['id']) && !empty($_POST['id'])
  ){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    if($crud->updateMember($id,$firstname,$lastname,$email)){
      $_SESSION['msg-class'] = "success";
      $_SESSION['msg'] = "Update war erfolgreich!";

      header('location: index.php');
    }else{
      $_SESSION['msg-class'] = "danger";
      $_SESSION['msg'] = "Es ging etwas schief!";

      header('location: index.php');
    }

  }
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $crud->deleteMember($id);
}

 ?>

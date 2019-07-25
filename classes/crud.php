<?php

require_once 'database.php';

class Crud {

  private $conn;

  public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
  }

  public function createMember($firstname,$lastname,$email){
    $stmt = $this->conn->prepare("INSERT INTO members (firstname,lastname,email) VALUES (:firstname, :lastname, :email);");
    $erg = $stmt->execute(array(
                                ':firstname' => $firstname,
                                ':lastname' => $lastname,
                                ':email' => $email
    ));

    return $erg;
  }

  public function getMembers(){
    $stmt = $this->conn->query("SELECT * FROM members ORDER BY id");
    $data = $stmt->fetchAll();
    return $data;
  }

  public function getMember($id){
    $stmt = $this->conn->prepare("SELECT * FROM members WHERE id=:id");
    $stmt->execute(array(':id' => $id));
    $data = $stmt->fetch();
    return $data;
  }

  public function updateMember($id,$firstname,$lastname,$email){
    $stmt = $this->conn->prepare("UPDATE members SET firstname=:firstname, lastname=:lastname, email=:email WHERE id=:id");
    $erg = $stmt->execute(array(
                        ':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':email' => $email,
                        ':id' => $id
    ));

    return $erg;
  }

  public function deleteMember($id){
    $stmt = $this->conn->prepare("DELETE FROM members WHERE id=:id");
    $erg = $stmt->execute(array(':id' => $id));
    return $erg;
  }

}

 ?>

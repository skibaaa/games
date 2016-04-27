<?php

class Users {
   protected $pdo;
   public $id;
   public $user;
   public $password;

   public function __construct(PDO $pdo) {
      $this->pdo = $pdo;
   }

   function listAll() {
      return $this->pdo->query("SELECT * FROM users ORDER BY id ");

   }

   function add($login,$password) {
      $passwordh=password_hash($password,PASSWORD_DEFAULT);
       $stmt = $this->pdo->prepare("INSERT INTO users SET login=?,password=?");
       $stmt->bindParam(1,$login);
       $stmt->bindParam(2,$passwordh);
       $stmt->execute();

       return $stmt->rowCount()==1;

   }

   function delete($id) {
      $stmt = $this->pdo->prepare("DELETE FROM users WHERE id=?");
      $stmt->bindParam(1,$id);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }

   function edit($id,$login,$password) {
      $stmt = $this->pdo->prepare("UPDATE users SET login=?, password=? WHERE id=?");
      $stmt->bindParam(1,$login);
      $stmt->bindParam(2,$password);
      $stmt->bindParam(3,$id);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }

}

?>

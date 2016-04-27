<?php
class Genres {
   protected $pdo;
   public $id;
   public $name;

   public function __construct(PDO $pdo) {
      $this->pdo = $pdo;
   }

   function listAll() {
      return $this->pdo->query("SELECT * FROM genres ORDER BY id");

   }

   function add($name) {
      $stmt = $this->pdo->prepare("INSERT INTO genres SET name=?");
      $stmt->bindParam(1,$name);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }

   function delete($id) {
      $stmt = $this->pdo->prepare("DELETE FROM genres WHERE id=?");
      $stmt->bindParam(1,$id);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }

   function edit($id,$name) {
      $stmt = $this->pdo->prepare("UPDATE genres SET name=? WHERE id=?");
      $stmt->bindParam(1,$name);
      $stmt->bindParam(2,$id);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }

   function find($id) {
      $stmt = $this->pdo->prepare("SELECT * FROM genres WHERE id=?");
      $stmt->bindParam(1,$id);
      $stmt->execute();

      return $stmt->fetch();
   }

}

?>

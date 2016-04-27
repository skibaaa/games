<?php
class Lists {
   protected $pdo;
   public $id;
   public $name;
   public $genre;
   public $type;
   static $types=array("Płyta","Gazeta CDA","Gazeta");

   public function __construct(PDO $pdo) {
      $this->pdo = $pdo;
   }

   function listAll() {
      return $this->pdo->query("SELECT l.*,g.name gname FROM `list` l,`genres` g WHERE g.id=l.genre ORDER BY id");

   }

   function add($name,$genre,$type) {
       $stmt = $this->pdo->prepare("INSERT INTO list SET name=?,genre=?,type=?");
       $stmt->bindParam(1,$name);
       $stmt->bindParam(2,$genre);
       $stmt->bindParam(3,$type);
       $stmt->execute();

       return $stmt->rowCount()==1;

   }

   function findType($id) {
      return isset(self::$types[$id]);
   }

   function delete($id) {
      $stmt = $this->pdo->prepare("DELETE FROM list WHERE id=?");
      $stmt->bindParam(1,$id);
      $stmt->execute();

      return $stmt->rowCount()==1;
   }


}
?>

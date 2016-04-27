<?php
include "db.php";
session_start ();

$login=$_POST['login'];
$password=$_POST['password'];

try
{
    $polaczenie= new PDO($db,$db_user,$db_password);
}
catch (PDOException $e)
{
    print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";
    die();
}

$stmt = $polaczenie -> prepare("SELECT * FROM  users WHERE login=? ");
$stmt -> bindParam(1, $login);
$stmt -> execute();
$user=$stmt -> fetch(PDO::FETCH_OBJ);

if ($user !== FALSE) {

   if (password_verify($password,$user->password)) {
      $_SESSION['user_id']=$user->id;
      header('Location:admin.php');
   }
   else {
      echo "nie";
   }
}
else {
   header('Location:index.php');
}
?>

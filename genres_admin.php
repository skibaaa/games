<?php
require_once "include.php";
check_login();
$genres=new Genres($db);
$active = "genres";
include "header.php";


if (isset($_POST['name'])) {
   $name=$_POST['name'];


   if ($name=="")  {
      echo '<div class="alert alert-danger" role="alert">Gatunek musi posiadać nazwe!</div>';
   }
   elseif ($genres->add($name)) {
      echo '<div class="alert alert-success" role="alert">Gatunek został dodany!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się dodać gatunku</div>';
   }

}

if (isset($_POST['del_id'])) {
   $del_id=$_POST['del_id'];

   if ($genres->delete($del_id)) {
      echo '<div class="alert alert-success" role="alert">Gatunek został usunięty!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się usunąć Gatunku</div>';
   }
}

if (isset($_POST['genre-name'],$_POST['genre-id'])) {
   $genre_name=$_POST['genre-name'];
   $genre_id=$_POST['genre-id'];

   if ($genre_name=="")  {
      echo '<div class="alert alert-danger" role="alert">Gatunek musi miec nazwe!</div>';
   }

   elseif ($genres->edit($genre_id,$genre_name)) {
      echo '<div class="alert alert-success" role="alert">Dane zostały zaktualizowane!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się zaktualizować danych!</div>';
   }
}

?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <h4 class="modal-title" id="myModalLabel">Dodawanie gatunku</h4>
</div>
<form method="POST" action="genres_admin.php">
<div class="modal-body">
   <div class="form-group">
      <label for="add-login">Nazwa:</label>
      <input type="text" class="form-control" id="add-login" name="name" placeholder="Nazwa:" autofocus required>
   </div>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
 <input type="submit" class="btn btn-success" value="Dodaj">
</div>
</form>
</div>
</div>
</div>
<div class="row">
   <div class="col-md-4 col-md-offset-4">
      <div class="hidden panel" id="edit-genre">
         <form class="edit" method="POST" action="genres_admin.php">
            <div class="form-group">
               <label for="genre-name">Nazwa:</label>
               <input type="text" class="form-control" id="genre-name" name="genre-name" placeholder="Login:" required>
               <input type="hidden" class="form-cotnrol" id="genre-id" name="genre-id" value="" >
            </div>
            <input type="submit" class="btn btn-primary btn-block edit" value="Zapisz">
         </form>
      </div>
   </div>
</div>
<div class="panel panel-default">
   <div class="panel-heading"><b>Genres</b></div>
      <div class="panel-body">
         <div class="row">
            <div class="col-xs-6">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
               Dodaj
               </button>
            </div>
            <div class="col-xs-6">
               <form class="pull-right" role="search">
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Search">
                  </div>
               </form>
            </div>
         </div>
      </div>
   <table class="table">
      <tr><th>Nazwa</th><th>Akcje</th></tr>
<?php foreach ($genres->listAll() as $genre): ?>
            <tr>
               <td><?php echo esc($genre['name']); ?></td>
               <td>
                  <form method="POST" class="delete-form">
                     <input type="hidden" value="<?php echo esc($genre['id']);?>" name="del_id">
                     <input type="submit" class="btn btn-danger btn-xs" value="DEL">
                     <button type="button" data-genre-id="<?php echo esc($genre['id']);?>" data-genre-name="<?php echo esc($genre['name']); ?>" class="btn btn-info btn-xs edit-genre">EDIT</button>
                  </form>
               </td>
            </tr>
<?php endforeach; ?>
   </table>
</div>
<?php
include "footer.php";

?>

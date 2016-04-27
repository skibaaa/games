<?php
require_once "include.php";
check_login();
$lists =new Lists($db);
$genres=new Genres($db);
$active = "list";
include "header.php";

if (isset($_POST['name'],$_POST['genre'],$_POST['type'])) {
   $name=$_POST['name'];
   $genre=$_POST['genre'];
   $type=$_POST['type'];


   if ($name=="" || $genres->find($genre)==FALSE || $lists->findType($type)==FALSE)  {
      echo '<div class="alert alert-danger" role="alert">Złe dane!</div>';
   }
   elseif ($lists->add($name,$genre,$type)) {
      echo '<div class="alert alert-success" role="alert">Pozycja została dodana!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się dodać pozycji</div>';
   }

}

if (isset($_POST['del_id'])) {
   $del_id=$_POST['del_id'];

   if ($lists->delete($del_id)) {
      echo '<div class="alert alert-success" role="alert">Gra została usunięta!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się usunąć gry</div>';
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
<form method="POST" action="list_admin.php">
<div class="modal-body">
   <div class="form-group">
      <label for="add-name">Nazwa:</label>
      <input type="text" class="form-control" id="add-name" name="name" placeholder="Nazwa:" autofocus required>
   </div>
      <div class="form-group">
      <label for="add-genre">Gatunek</label>
      <select id="add-genre" class="form-control" name="genre">
      <?php foreach ($genres->listAll() as $genre) :
         echo "<option value=".esc($genre['id']).">".esc($genre['name'])."</option>";
      endforeach; ?>
      </select>
   </div>
   <div class="form-group">
      <label for="add-type">Typ:</label>
      <select id="add-type" class="form-control" name="type">
      <?php foreach (Lists::$types as $type_id => $type) :
         echo "<option value=".esc($type_id).">".esc($type)."</option>";
      endforeach; ?>
      </select>
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
      <div class="panel panel-default">
         <div class="panel-heading"><b>List</b></div>
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
            <tr><th>Nazwa</th><th>Gatunek</th><th>Typ</th><th>Akcje</th></tr>
         <?php foreach ($lists->listAll() as $list): ?>
                     <tr>
                        <td><?php echo esc($list['name']); ?></td>
                        <td><?php echo esc($list['gname']); ?></td>
                        <td><?php echo esc(Lists::$types[$list['type']]); ?></td>
                        <td>
                           <form method="POST" class="delete-form">
                              <input type="hidden" value="<?php echo esc($list['id']);?>" name="del_id">
                              <input type="submit" class="btn btn-danger btn-xs" value="DEL">
                              <button type="button" data-list-id="<?php echo esc($list['id']);?>" data-list-name="<?php echo esc($list['name']); ?>" data-list-genre="<?php echo esc($list['genre']); ?>" data-list-type="<?php echo esc($list['type']); ?>" class="btn btn-info btn-xs edit-list">EDIT</button>
                           </form>
                        </td>
                     </tr>
         <?php endforeach; ?>
         </table>
      </div>
<?php
include "footer.php" ;
?>

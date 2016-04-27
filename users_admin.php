<?php
require_once "include.php";
check_login();
$users=new Users($db);
$active = "users";
include "header.php";

if (isset($_POST['login'],$_POST['password'])) {
   $login=$_POST['login'];
   $password=$_POST['password'];

   if ($login=="" || $password=="")  {
      echo '<div class="alert alert-danger" role="alert">Użytkownik musi mieć login i hasło!</div>';
   }
   elseif ($users->add($login,$password)) {
      echo '<div class="alert alert-success" role="alert">Użytkownik został dodany!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się dodać użytkownika</div>';
   }

}

if (isset($_POST['del_id'])) {
   $del_id=$_POST['del_id'];
   if ($del_id==$_SESSION['user_id']) {
      echo '<div class="alert alert-danger" role="alert">Nie możesz usunąć samego siebie</div>';
   }
   elseif ($users->delete($del_id)) {
      echo '<div class="alert alert-success" role="alert">Użytkownik został usunięty!</div>';
   }
   else {
      echo '<div class="alert alert-danger" role="alert">Nie udało się usunąć użytkownika</div>';
   }
}

if (isset($_POST['edit-login'],$_POST['edit-id'],$_POST['edit-password'])) {
   $edit_login=$_POST['edit-login'];
   $edit_password=password_hash($_POST['edit-password'],PASSWORD_DEFAULT);
   $edit_id=$_POST['edit-id'];

   if ($edit_login=="" || password_verify("",$edit_password))  {
      echo '<div class="alert alert-danger" role="alert">Użytkownik musi mieć login i hasło!</div>';
   }

   elseif ($users->edit($edit_id,$edit_login,$edit_password)) {
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
 <h4 class="modal-title" id="myModalLabel">Dodawanie użytkownika</h4>
</div>
<form method="POST" action="users_admin.php">
<div class="modal-body">
   <div class="form-group">
      <label for="add-login">Login:</label>
      <input type="text" class="form-control" id="add-login" name="login" placeholder="Login:" autofocus required>
   </div>
   <div class="form-group">
      <label for="add-password">Hasło:</label>
      <input type="password" class="form-control" id="add-password" name="password" placeholder="Hasło:" required>
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
      <div class="hidden panel" id="edit-user">
         <form class="edit" method="POST" action="users_admin.php">
            <div class="form-group">
               <label for="edit-login">Login:</label>
               <input type="text" class="form-control" id="edit-login" name="edit-login" placeholder="Login:" required>
               <input type="hidden" class="form-cotnrol" id="edit-login-id" name="edit-id" value="" >
            </div>
            <div class="form-group">
               <label for="edit-user-password">Hasło:</label>
               <input type="password" class="form-control" id="edit-user-password" name="edit-password" placeholder="Hasło:" required>
            </div>
            <input type="submit" class="btn btn-primary btn-block edit" value="Zapisz">
         </form>
      </div>
   </div>
</div>
<div class="panel panel-default">
   <div class="panel-heading"><b>Users</b></div>
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
      <tr><th>Login</th><th>Akcje</th></tr>
<?php foreach ($users->listAll() as $user): ?>
            <tr>
               <td><?php echo esc($user['login']); ?></td>
               <td>
                  <?php if ($user['id']!=$_SESSION['user_id']) : ?>
                  <form method="POST" class="delete-form">
                     <input type="hidden" value="<?php echo esc($user['id']);?>" name="del_id">
                     <input type="submit" class="btn btn-danger btn-xs" value="DEL">
                     <button type="button" data-user-id="<?php echo esc($user['id']);?>" data-user-login="<?php echo esc($user['login']); ?>" class="btn btn-info btn-xs edit-user">EDIT</button>
                  </form>

                  <?php endif; ?>
               </td>
            </tr>
<?php endforeach; ?>
         </table>
      </div>
<?php
include "footer.php" ;
?>

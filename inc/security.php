<?php
function check_login() {
   if (!isset($_SESSION['user_id'])) {
      header("Location:index.php");
      exit();
   }
}

function esc($string){
   return htmlspecialchars($string);
}

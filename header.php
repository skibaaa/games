<html>
<head>
   <META HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">
   <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <script src="js/main.js"></script>
   <link rel="Stylesheet" type="text/css" href="style/admin.css" />
</head>
<body>
   <nav class="navbar navbar-default">
      <div class="container-fluid">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php"><b># Project 1</b></a>
         </div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

               <li<?php if ($active == 'users') echo ' class="active"'; ?>><a href="users_admin.php">Użytkownicy</a></li>
               <li<?php if ($active == 'genres') echo ' class="active"'; ?>><a href="genres_admin.php">Gatunki</a></li>
               <li<?php if ($active == 'list') echo ' class="active"'; ?>><a href="list_admin.php">Lista</a></li>
               <li><a href="log_out.php">Wyloguj</a></li>
            </ul>
         </div>
      </div>
   </nav>
   <div class="container">

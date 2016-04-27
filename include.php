<?php
session_start();
require_once "inc/security.php";
require_once "inc/user.class.php";
require_once "inc/genre.class.php";
require_once "inc/list.class.php";

try
{
    $db= new PDO("mysql:host=localhost;dbname=project_1","admin","admin123");
    $db->query("SET NAMES UTF-8");
}
catch (PDOException $e)
{
    print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";
    die();
}

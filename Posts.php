<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }
$_SESSION['postSection'] = $_POST['postSection'];
$postContent = $_SESSION['postSection'];

$_SESSION['photoOnPost'] = $_POST['photoOnPost'];
$photoOnPost = $_SESSION['photoOnPost'];

$_SESSION['title'] = $_POST['title'];
$title = $_SESSION['title'];

$_SESSION['cash'] = $_POST['cash'];
$cash = $_SESSION['cash'];

$date = date('Y-m-d H:i:s');

$connec = new PDO(DBName, 'root', '0000');
 $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $request = $connec->prepare('INSERT INTO products (title, description, creationDate, picture_address, price) VALUES (:title, :description, :creationDate, :picture_address, :price)');
 $request->execute([
   ":title" => $title,
   ":description" => $postContent,
   ":creationDate" => $date,
   ':picture_address' => $photoOnPost,
   ":price" => $cash
 ]);
header('Location: page1.php');

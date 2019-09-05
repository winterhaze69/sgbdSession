<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_POST["ban"])) {
$userID = $_POST["userID"];
  deleteOneUser($userID);
  header('Location: page1.php');
}elseif (isset($_POST["upgrade"])) {
  $promotion = '2';
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE users SET status_id = :status_id WHERE id = :id ");
  $request->bindParam(':status_id', $promotion);
  $request->bindParam(':id', $_POST['userID']);
  $request->execute();

  header('Location: page1.php');
}

 ?>

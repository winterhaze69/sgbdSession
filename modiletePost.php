<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_POST["del"])) {
$postID = $_POST["postID"];
  deleteOnePost($postID);

}elseif (isset($_POST["mod"])) {
  echo 'There is a problem with the server atm, please try again later .. :(';die;
}

header('Location: page1.php');
 ?>

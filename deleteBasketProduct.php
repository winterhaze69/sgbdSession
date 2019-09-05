<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_POST["basketProductID"])) {
  $toDelete = $_POST["basketProductID"];
    deleteOneProductBasket($toDelete);
  header('Location: basket.php');
}

 ?>

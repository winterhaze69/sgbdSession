<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }

  $users = getAllUser();

  if (isset($_POST["name"])) {
    $_SESSION['name'] = $_POST["name"];
    $name = $_SESSION['name'];

    $_SESSION['password'] = $_POST['password'];
    $password = $_SESSION['password'];


    foreach ($users as $user) {
      if ($user['nickname'] == $name) {
        if (password_verify($password, $user['password'])) {
          return header('Location: page1.php');
        } else {
          header('Location: noregister.php');
        }
      }
    }
  }else {
    $guest = 'guest';
      $_SESSION['name'] = $guest;
      return header('Location: page1.php');
  }
  header('Location: noregister.php');

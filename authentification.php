<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }


$users = getAllUser();

$_SESSION['age'] = $_POST['age'];
$age = $_SESSION['age'];
$_SESSION['firstName'] = $_POST['firstName'];
$firstName = $_SESSION['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$lastName = $_SESSION['lastName'];
$_SESSION['name'] = $_POST['name'];
$userName = $_SESSION['name'];
$_SESSION['password'] = $_POST['password'];
$userPassword = $_SESSION['password'];
$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

  if ($age <= '18') {
   echo "<p>Sorry you must be over 18 years old to buy our products!</p>";
   echo "<p>You can still watch them as guest: <button><a href='./home.php'>Back to login</a></button></p>";
   return;
  }

foreach ($users as $key => $user) {
   if (in_array($userName, $user)) {
     //mettre dans une alarme
     echo "<p>WHOOOPS !</p>";
     echo "<div> username already used </div>";
    //  echo "<br>";
      echo "<button><a href='./register.php'>back to register</a></button>";
      return true;
   }else {
     echo "";
   }
 }
 $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('INSERT INTO users (nickname, password, firstName, lastName, age) VALUES (:nickname, :password, :firstName, :lastName, :age)');
  $request->execute([
    ":nickname" => $userName,
    ":password" => $hashedPassword,
    ":firstName" => $firstName,
    ":lastName" => $lastName,
    ":age" => $age,

  ]);
    header('Location: page1.php');


?>

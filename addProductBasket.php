<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }
$prodID = $_POST['prodID'];
$userID = $_SESSION['name'];
$me = getConnectedUserID($userID);
$realMe = $me['id'];

$allMyProds = getAllBasketByUser($realMe);

foreach ($allMyProds as $key => $myProd) {
  if($myProd['product_id'] == $prodID){
  $quantity = $myProd['quantity'];
  $oneMore = $quantity + 1;

  $one =  getBasketByProductID($prodID);
  $finally = $one[0]['id'];
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE user_has_products_in_basket SET quantity = :quantity WHERE id = :id ");
  $request->bindParam(':quantity', $oneMore);
  $request->bindParam(':id', $finally);
  $request->execute();
  header('Location: basket.php');
  return;
}else {

}

}


$connec = new PDO(DBName, 'root', '0000');
 $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $request = $connec->prepare('INSERT INTO user_has_products_in_basket (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)');
 $request->execute([
   ":user_id" => $realMe,
   ":product_id" => $prodID,
   ":quantity" => '1',

 ]);
header('Location: basket.php');

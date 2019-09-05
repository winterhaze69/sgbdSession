<?php

const DBName = 'mysql:dbname=awesomeTable';


session_start();


function getAllUser() {
  $request = '
  SELECT *
  FROM  users
  ';
  $connec = new PDO( DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare($request);
  $request->execute();
  return $request->fetchAll();
}

function getConnectedUser($userName) {
  $request = '
  SELECT status_id
  FROM  users
  WHERE nickname = :nickname
  ';
  $connec = new PDO(DBName, 'root', '0000');

  $request = $connec->prepare("SELECT status_id FROM users WHERE nickname = :nickname");
  $request->bindParam(':nickname', $userName);
  $request->execute();
  return $request->fetch(PDO::FETCH_ASSOC);
}
function getConnectedUserID($userName) {
  $request = '
  SELECT id
  FROM  users
  WHERE nickname = :nickname
  ';
  $connec = new PDO(DBName, 'root', '0000');

  $request = $connec->prepare("SELECT id FROM users WHERE nickname = :nickname");
  $request->bindParam(':nickname', $userName);
  $request->execute();
  return $request->fetch(PDO::FETCH_ASSOC);
}


function getAllPosts() {
  $request = '
  SELECT *
  FROM  products
  ORDER BY id DESC
  ';
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare($request);
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}
function getThisPost($q) {

  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare("SELECT * FROM products WHERE title LIKE concat('%', :title ,'%')");
  $request->bindParam(':title', $q);
  $request->execute();
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

function deleteOnePost($postID) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('DELETE FROM products WHERE id = :id');
  $request->execute([
    ":id" => $postID,
  ]);
}

function deleteOneUser($userID) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('DELETE FROM users WHERE id = :id');
  $request->execute([
    ":id" => $userID,
  ]);
}

function getAllBasketByUser($userID) {
  $request = '
  SELECT *
  FROM  user_has_products_in_basket
  WHERE user_id = :user_id
  ';
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare($request);
  $request->execute([
    ":user_id" => $userID,
  ]);
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

function getProductbyID($userID) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('SELECT * FROM products WHERE id = :id');
  $request->execute([
    ":id" => $userID,
  ]);
  return $request->fetchAll(PDO::FETCH_ASSOC);
}
function deleteOneProductBasket($toDelete) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('DELETE FROM user_has_products_in_basket WHERE id = :id');
  $request->execute([
    ":id" => $toDelete,
  ]);
}

function getBasketByProductID($prodID) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request = $connec->prepare('SELECT * FROM user_has_products_in_basket WHERE product_id = :product_id');
  $request->execute([
    ":product_id" => $prodID,
  ]);
  return $request->fetchAll(PDO::FETCH_ASSOC);
}

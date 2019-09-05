<?php
require_once('function.php');

if (isset($_POST['title'])) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE products SET title = :title WHERE id = :id ");
  $request->bindParam(':title', $_POST['title']);
  $request->bindParam(':id', $_POST['postID']);
  $request->execute();
  return;
}elseif (isset($_POST['content'])) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE products SET description = :description WHERE id = :id ");
  $request->bindParam(':description', $_POST['content']);
  $request->bindParam(':id', $_POST['postID']);
  $request->execute();
  return;
}elseif (isset($_POST['picture'])) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE products SET picture_address = :picture_address WHERE id = :id ");
  $request->bindParam(':picture_address', $_POST['picture']);
  $request->bindParam(':id', $_POST['postID']);
  $request->execute();
  return;
}elseif (isset($_POST['price'])) {
  $connec = new PDO(DBName, 'root', '0000');
  $connec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $request= $connec->prepare("UPDATE products SET price = :price WHERE id = :id ");
  $request->bindParam(':price', $_POST['price']);
  $request->bindParam(':id', $_POST['postID']);
  $request->execute();
  return;
}else {
  return 'nope';
}

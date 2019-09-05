<?php
require_once('function.php');
if(!isset($_SESSION))
    {
        session_start();
    }

if (isset($name)) {
  $sessName = $name;
}elseif (isset($userName)) {
  $sessName = $userName;
}
if (isset($_SESSION['name'])) {
  $sessName = $_SESSION['name'];
}else {
  $sessName = 'guest';
}
if ($sessName != 'guest') {
  $connectedUser = getConnectedUser($sessName);
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Feod'art</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Shojumaru&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</head>


 <header class="clearfix">
     <div class="container">
 			<div class="header-left">
 				<h1 style="font-family:'Shojumaru', cursive">Feod'art</h1>
 			</div>
 			<div class="header-right">
 				<label for="open">
 					<span class="hidden-desktop"></span>
 				</label>
 				<nav style="display: flex;">
          <form style="" method="GET">
             <input type="search" name="q" placeholder="Search for products..." />
             <input class="btn btn-info"type="submit" value="Search" />
          </form>

 				<a href="logout.php" style="margin-left:240px" class="btn btn-success fa fa-sign-out">Logout</a>
        <div style="font-family: 'Shojumaru', cursive; margin-left:5px;display:flex">  <?= $sessName?></div>
 				</nav>
 			</div>
 		</div>
 	</header>


  <body>
<div class="main div">


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
              <?php
                if ($sessName == 'theAdmin69') {
                  ?>
              <img src="./img/logo.png" alt="" style="height:150px;width:200px;position:fixed">
              <div class="dropdown">
              <h2 style="color:white; margin-top:150px; position:fixed; font-family: 'Shojumaru', cursive;">Disciples<span class="dropbtn fa fa-chevron-down moto" onclick="myFunction()" style="color:white"></span></h2>
            <div id="myDropdown" class="dropdown-content">
              <?php $applicants = getAllUser();
               $aspirants = [];
               $initiates = [];
                foreach ($applicants as $myBoy) {
                    if ($myBoy['status_id'] == 1) {
                      $aspirants[] = $myBoy;
                    }elseif ($myBoy['status_id'] == 2) {
                       $initiates[] = $myBoy;
                    }
                }
              ?>
              <div><span style="background-color:lightblue; font-family:'Shojumaru', cursive">Aspirants:</span>
                <?php
                  foreach ($aspirants as $newbie) {
                  echo "<form action='promoDeleteUser.php' method='post' style='background-color: rgba(0, 0, 0, 0.6);color:white;font-family:Shojumaru, cursive';> <p style='color:white;font-family:Shojumaru, cursive';>$newbie[4]<input type='hidden' name='userID' value='$newbie[0]'><input class='btn btn-info' type='submit' name='upgrade' value='Promote' style='margin-left:10px'><input class='btn btn-danger' type='submit' name='ban' value='Ban' style='margin-left:10px'></p></form>";
                  }
                 ?>

              </div>
              <div><span style="background-color:#ffdbad; font-family:'Shojumaru', cursive">Initiates:</span>
                <?php
                  foreach ($initiates as $upgraded) {
                  echo "<form class='' action='promoDeleteUser.php' method='post' style='background-color: rgba(0, 0, 0, 0.6);color:white;font-family:Shojumaru, cursive';><p style='color:white;font-family:Shojumaru, cursive';>$upgraded[4]<input type='hidden' name='userID' value='$upgraded[0]'><input class='btn btn-danger' type='submit' name='ban' value='Ban' style='margin-left:10px'></p></form>";
                  }
                 ?>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
            <div class="col-md-4" style="height:900px;">
              <div class="display">
              <?php
              if ($sessName == 'theAdmin69') {
                ?><h1 class="margin" style="color:white; font-family:'Shojumaru', cursive"> All hail the mighty Admin!!</h1><?php
              }else {
                 ?><h1 class="margin" style="color:white; font-family:'Shojumaru', cursive"> Welcome to feod'art!</h1><?php
              } ?>

                  <div class="card margin" style="text-align: center;">
                    <h3>Japanese swords:</h3>
                  </div>

                  <?php
                  if ($sessName == 'theAdmin69') {
                    ?>
                  <form class="card margin" action="Posts.php" method="post">
                      <h4 class="card-header" style="text-align:center">Admin Editor</h4>
                      <div class="card-body">
                      <label>Product title:</label>
                      <br>
                      <input type="text" name="title" value="" required>
                      <br>
                      <label>Copy picture link address:</label>
                      <br>
                      <input type="text" name="photoOnPost" cols="40" value="" required>
                      <br>
                      <label>Product description:</label>
                      <textarea name="postSection" cols="40" rows="5" required></textarea>
                      <br>
                      <label>Product price:</label>
                      <br>
                      <input type="text" name="cash" value="" required>USD
                      <input type="hidden" name="nameAgain" value="<?= $sessName ?>">
                      <input class="btn btn-info"type="submit" name="subPost" value="Post-it!">
                    </div>
                  </form>
                <?php }

    if(isset($_GET['q']) AND !empty($_GET['q'])) {
      $q = htmlspecialchars($_GET['q']);
       $posts = getThisPost($q);
    }else {
      $posts = getAllPosts();
    }

    foreach ($posts as $post) {
       $postID = $post["id"];
    ?>
      <div class="card margin">
          <p class="t<?= $post['id'] ?> card-header"><?= $post["title"] ?>
            <?php
            if ($sessName == 'theAdmin69') {
              ?>
          <input data-content="<?= $post['title'] ?>" data-id="<?= $post['id'] ?>" class="titleSubmit btn btn-info" type="submit" name="titleSubmit" value="Edit title" style="width: 83px; margin-left:10px"></p>
        <?php } ?>
              <div class="imgHere">
                <img class="m<?= $post['id'] ?>" src="<?= $post["picture_address"] ?>" alt="">
              </div>
              <?php
              if ($sessName == 'theAdmin69') {
                ?>
              <input data-content="<?= $post['picture_address'] ?>" data-id="<?= $post['id'] ?>" class="pictureSubmit btn btn-info" type="submit" name="pictureSubmit" value="Edit Picture"></p>
            <?php } ?>
              <div class="card-body">
                <p class="p<?= $post['id'] ?>"><?= $post["description"] ?></p>
                <form class='' action='modiletePost.php' method='post'>
                  <input type="hidden" name="postID" value="<?= $postID ?>">
                  <?php
                  if ($sessName == 'theAdmin69') {
                    ?>
                  <input data-content="<?= $post['description'] ?>" data-id="<?= $post['id'] ?>" class="submit btn btn-info" type="submit" name="mod" value="Edit description">
                <?php } ?>
                </form>
              </div>
              <div class="card-header">
                <p class="r<?= $post['id'] ?>"><?= $post["price"] ?> USD
                  <?php
                  if ($sessName == 'theAdmin69') {
                    ?>
                <input data-content="<?= $post['price'] ?>" data-id="<?= $post['id'] ?>" class="priceSubmit btn btn-info" type="submit" name="priceSubmit" value="Edit price" style="margin-left:10px"></p>
              <?php } ?>
              </div>
              <?php
              $userStatus = getConnectedUser($sessName);
              if ($userStatus['status_id'] == '2'): ?>
              <?php $posty = $post['id']; ?>
              <form class="" action="addProductBasket.php" method="post">
                <input type="hidden" name="prodID" value="<?=$posty?>">
              <input type="submit" class="btn btn-success" name="" value="Add to cart" style="width:546px">
              </form>
              <?php endif; ?>
          <?php if ($sessName == 'theAdmin69'): ?>
          <div class="btnAction card-header">
          <form class='' action='modiletePost.php' method='post'>
            <input type="hidden" name="postID" value="<?= $postID ?>">
            <input type="submit" class="btn btn-danger" name="del" value="Delete post">
          </form>
          </div>
        <?php  endif ?>
      </div>
<?php }?>
    </div>
  </div>
<div class="col-md-4">
  <?php
    if ($userStatus['status_id'] == '2'): ?>
  <a href="basket.php">
  <span href='login.php' style="width:70px;position:fixed" class="fa fa-shopping-basket btn btn-success">My basket</span>
  </a>
    <?php  endif ?>
</div>
</div>
</div>
</div>
  </body>
</html>

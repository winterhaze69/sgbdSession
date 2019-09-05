<?php
require_once('function.php');

if(!isset($_SESSION))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./style.css">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <title>Feod'art</title>
  </head>
  <body style="background-color:white;color:white">
 <?php
 $userName = $_SESSION['name'];
 $userID = getConnectedUserID($userName);
 $me = $userID['id'];
 $myProducts = getAllBasketByUser($me);

  ?>
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $prices = [];
                      foreach ($myProducts as $mine) {

                        $oneProd = $mine['product_id'];
                        $theProds = getProductbyID($oneProd);


                      foreach ($theProds as $aProd) {
                            //tour de magie --> ICI!!
                            $rest = substr($aProd['price'], 0, -3);
                            $again = explode(",", $rest);
                            $now = $again[0].$again[1];
                            if ($mine['quantity'] > 1) {
                            $now = (($again[0].$again[1]) *2);
                            }
                            $prices[] = $now;


                       ?>
                        <tr>
                            <td><img src="<?=$aProd['picture_address']?>" /> </td>
                            <td><?=$aProd['title']?></td>
                            <td>In stock</td>
                            <td><?=$mine['quantity']?></td>
                            <td class="text-right"><?=$aProd['price']?></td>
                            <td class="text-right"><form class="" action="deleteBasketProduct.php" method="post">
                              <input type="hidden" name="basketProductID" value="<?=$mine['id']; ?>">
                              <button type="submit"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                            </form>
                        </tr>
                    <?php     }
                         } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                              <?php
                              $allSum = array_sum($prices);
                               ?>
                            <td class="text-right"><?= $allSum.'.00 USD'; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <?php
                            $shipping = '6.90'
                             ?>
                            <td class="text-right"><?= $shipping.' USD' ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong><?=$allSum + $shipping.'0 USD' ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                  <a href="./page1.php"><button class="btn btn-block btn-light">Continue Shopping</button></a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a href="pdf.php"><button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

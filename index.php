<?php

require_once("./function.php");

$uri = $_SERVER["REQUEST_URI"];
$decoupe = explode("/", $uri );

if ($decoupe[1] === ""  ) {
  header('Location: home.php');
} else {
    $decoupe[1]();
};

<?php 

session_start(); 
  
require "config/autoload.php";  

// if (isset($_SESSION["message"])) {
//     echo $_SESSION["message"];
//     unset($_SESSION["message"]); // Supprimez le message de la session pour qu'il ne s'affiche qu'une fois
// }

$router = new Router();  
  
if(isset($_GET["path"]))  
{  
    $router->checkRoute($_GET["path"]);  
}  
else  
{  
    $router->checkRoute("");  
}
<?php

session_start();
require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';
use App\eCommerce\Controller\ControllerUtilisateur;
use App\eCommerce\Controller\ControllerProduit;
use App\eCommerce\Model\Repository\DataBaseConnection;

// instantiate the loader
$loader = new App\eCommerce\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
//$loader->addNamespace('App\eCommerce', __DIR__ . '/../src');

// /home/ann2/gonfiantinig/public_html/ProjetWebEcommerce/src/Model/Repository/ProduitRepository.php
$loader->addNamespace('App\eCommerce', __DIR__ . '/../src');
// register the autoloader
$loader->register();

if(!isset($_COOKIE["panierInvite"])){
    //On initialise le panier de un invité avec une durée de vie de 1 an
    setcookie("panierInvite","initialisationCookieInvite", time() + 31536000,"/");
}


// On recupère l'action passée dans l'URL
if(isset($_GET['controller']) == null){
    $controller = "produit";
}
else{
    $controller = $_GET['controller'];
}


$controllerClassName = 'App\eCommerce\Controller\Controller' . ucfirst($controller);
//echo "controller : " . $controllerClassName;

if(!class_exists($controllerClassName)){
    $controllerClassName::error("Le controller " . $controller .  " n'existe pas !");
}


if(isset($_GET['action']) == null){
    $action = "affichePageAcceuil";
}
/*else if(!in_array($_GET['action'],get_class_methods( $controllerClassName))){
    ControllerProduit::error("La vue " . $_GET['action'] ." n'existe pas !");
}*/
else{
    $action = $_GET['action'];
}


$controllerClassName::$action();

?>
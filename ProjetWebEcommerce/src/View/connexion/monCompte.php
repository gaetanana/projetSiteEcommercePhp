<?php

use App\eCommerce\Model\Repository\UtilisateurRepository;
$id= $_SESSION['id']  ;

//J'obtiens l'utilisateur qui est actuellement connecté
$soldeUtilisateur = UtilisateurRepository::getSolde($id);

echo "<h3>Voici les informations sur votre compte</h3>";

echo "<p>Solde de votre compte : $soldeUtilisateur €</p>";


if(isset($retourChangementMDP)){
    echo "<p>Votre mot de passe a été changé</p>";
}

echo "<p><a href='frontController.php?controller=utilisateur&action=affichePageChangementMDP'>Changer de mot de passe</a></p>";
echo "<p><a href='frontController.php?controller=utilisateur&action=affichePageAjoutSolde'>Ajouter du solde à votre compte</a></p>";
echo "<p><a href='frontController.php?controller=utilisateur&action=affichePageListeCommandes'>Mes commandes</a></p>";

if(isset($messageAjoutSolde)){
    echo "<p>$messageAjoutSolde</p>";
}

?>
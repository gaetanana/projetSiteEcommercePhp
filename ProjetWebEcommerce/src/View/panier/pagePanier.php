<?php
//Mes tests pour le panier
/*$listeDeListe = array(
    array("idProduit" => 1, "quantiteProduit" => 2),
    array("idProduit" => 2, "quantiteProduit" => 3));

$panierEncode = json_encode($listeDeListe);

setcookie("panierTest", $panierEncode, time() + 3600, "/");

$decode = json_decode($_COOKIE['panierTest'], true);
//echo "decode : " . $decode[0]['idProduit'];
echo "<br>";
echo "<br>";*/
//Fin de mes tests pour le panier


//Partie pour afficher le panier

use App\eCommerce\Model\Repository\PanierRepository;
use App\eCommerce\Model\Repository\ProduitRepository;


if(isset($messagePaiement)){
    echo "<p>$messagePaiement</p>";
}

if (isset($_SESSION['login']) && isset($_COOKIE['utilisateur' . $_SESSION['login']])) {
    $loginHTML = $_SESSION['login'];

    $nomCookie = "utilisateur" . $loginHTML;
    //tableau panier , avec le nom du produit et la quantité du produit et son prix total;
    $panier = json_decode($_COOKIE[$nomCookie], true);

} else if (isset($_COOKIE["panierInvite"])) {
    //Si la personne n'est pas connecté elle a le panier d'un invité
    $nomCookieInvite = "panierInvite";
    $panier = json_decode($_COOKIE[$nomCookieInvite], true);
}

if (isset($panier) && !empty($panier)) {

    echo '<h3>Votre panier</h3>';

    echo "<table class='table-fill'>";
    echo "<tr class='firstRow'>";
    echo "<th>Nom du produit</th>";
    echo "<th>Image</th>";
    echo "<th>Quantité</th>";
    echo "<th>Prix unitaire</th>";
    echo "<th>Prix total</th>";
    echo "<th>Supprimer</th>";
    echo "</tr>";

    $prixTotalPanier = 0;
    foreach ($panier as $produit) {
        //Supprime du panier les produits qui ont une quantité de 0 dans la BD et dans le panier
        //PanierRepository::updatePanier($produit['idProduit'], $produit['quantiteProduit']);
        /***********************************************************************************/

        $produitCourant = ProduitRepository::getProduitByID($produit['idProduit']);
        $stockProduitCourantDansPanier = PanierRepository::getStockProduitDansPanier($produitCourant->getIdProduit());
        $stockProduitDansBD = ProduitRepository::getStockProduitById($produitCourant->getIdProduit());

        if ($stockProduitCourantDansPanier > 0 && $stockProduitDansBD > 0
            && $stockProduitCourantDansPanier <= $stockProduitDansBD) {
            $quantiteProduit = $produit['quantiteProduit'];
            $nomProduit = $produitCourant->getNomProduit();
            $prixProduit = $produitCourant->getPrixProduit();
            $prixTotal = $prixProduit * $quantiteProduit;
            $prixTotalPanier += $prixTotal;
            echo "<tr>";
            echo "<td>" . $nomProduit . "</td>";
            $idImageProduit = ProduitRepository::getIdImageProduit($produitCourant->getIdProduit());
            $bin = ProduitRepository::afficheImageProduit($idImageProduit);
            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>';
            echo "<td>" . $quantiteProduit . "</td>";
            echo "<td>" . $prixProduit . "</td>";
            echo "<td>" . $prixTotal . "</td>";
            echo "<td>

            <form action='frontController.php?controller=panier&action=supprimerProduit' method='post'>
                <input type='hidden' name='idProduit' value='" . $produitCourant->getIdProduit() . "'>
                <input type='number' name='quantiteProduit' min='1' max='$stockProduitCourantDansPanier' value='1'>
                <input type='submit' value='Supprimer'>
                
            </form>    
            </td>";
            echo "</tr>";
        }
        else{
            $quantiteASupprimer = $stockProduitCourantDansPanier-$stockProduitDansBD;
            PanierRepository::supprimerProduitDuPanier($produitCourant->getIdProduit(), $quantiteASupprimer);
            header('Location: frontController.php?controller=panier&action=affichePanier');
            exit();
        }
    }

    echo '<tr> <td colspan="4">TOTAL (TTC):</td> <td>' . $prixTotalPanier . ' €</td><td></td> </tr>';
    echo "</table>";

    echo "<a href='frontController.php?controller=panier&action=videPanier'>Vider le panier</a>";

    echo "<br>";

    echo "<a href='frontController.php?controller=panier&action=affichePagePaiement'>Payer</a>";


} else {
    echo "<h3>Votre panier est vide</h3>";
}



?>
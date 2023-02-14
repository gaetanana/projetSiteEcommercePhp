<?php

use App\eCommerce\Model\Repository\PanierRepository;
use App\eCommerce\Model\Repository\ProduitRepository;

if (isset($_SESSION['login']) && isset($_COOKIE['utilisateur' . $_SESSION['login']])) {
    $loginHTML = $_SESSION['login'];

    $nomCookie = "utilisateur" . $loginHTML;
    //tableau panier , avec le nom du produit et la quantité du produit et son prix total;
    $panier = json_decode($_COOKIE[$nomCookie], true);

}

if (isset($panier)) {

    echo '<h3>Récapitulatif de votre panier</h3>';

    echo "<table>";
    echo "<tr class='firstRow'>";
    echo "<th>Nom du produit</th>";
    echo "<th>Image</th>";
    echo "<th>Quantité</th>";
    echo "<th>Prix unitaire</th>";
    echo "<th>Prix total</th>";

    echo "</tr>";

    $prixTotalPanier = 0;


    foreach ($panier as $produit) {
        $produitCourant = ProduitRepository::getProduitByID($produit['idProduit']);
        $stockProduitCourantDansPanier = PanierRepository::getStockProduitDansPanier($produitCourant->getIdProduit());
        $stockProduitDansBD = ProduitRepository::getStockProduitById($produitCourant->getIdProduit());

        if ($stockProduitCourantDansPanier > 0 && $stockProduitDansBD > 0) {
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
            echo "</tr>";
        }
        else{
            $quantiteASupprimer = $stockProduitCourantDansPanier-$stockProduitDansBD;
            PanierRepository::supprimerProduitDuPanier($produitCourant->getIdProduit(), $quantiteASupprimer);
        }
    }

    echo '<tr> <td colspan="4">TOTAL (TTC):</td> <td>' . $prixTotalPanier . ' €</td> </tr>';
    echo "</table>";



}

?>

<form method="POST" action="frontController.php?controller=panier&action=payer">
    <fieldset>
        <div>
            <legend>Moyen de paiment</legend>
            <div class="formSubtitle">

            </div>
        </div>

        <p>
            <label for="soldeCompte">Solde compte</label>
            <input type="radio"  name="moyenPaiement" value="soldeCompte"/>
        </p>

        <p>
            <label for="carteBancaire">Carte bancaire</label>
            <input type="radio"  name="moyenPaiement" value="carteBancaire" />
        </p>

        <p>
            <input type="submit" name = "" value="Choisir"/>
        </p>

    </fieldset>

</form>



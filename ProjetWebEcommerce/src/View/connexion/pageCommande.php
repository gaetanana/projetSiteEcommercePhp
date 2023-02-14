<?php

use App\eCommerce\Model\Repository\UtilisateurRepository;
use App\eCommerce\Model\Repository\ProduitRepository;
use App\eCommerce\Model\DataObject\produit\Produit;

$commande = UtilisateurRepository::getCommande($_GET['id']);

if(!UtilisateurRepository::commandeBonUtilisateur($_GET['id'], $_SESSION['id'])
    && $_SESSION['status'] != "admin"
    && $_SESSION['status'] != "fondateur"){
    echo "<p>Commande inconnue</p>";
    return;
}

else {
echo "<h3>Détails de la commande</h3>";
echo "<p>Commande passée le " . date(" d/m/Y à H:i", strtotime($commande['datecommande'])) . "</p>";
echo "<table>";
echo "<tr class='firstRow'>";
echo "<th>Nom du produit</th>";
echo "<th>Image du produit</th>";
echo "<th>Quantité</th>";
echo "<th>Prix unitaire</th>";
echo "<th>Prix total</th>";
echo "</tr>";

$infoCommande = $commande['infocommande'];

$infoCommande = explode(";", $infoCommande);
$infoCommande = array_filter($infoCommande);
$prixTotal = 0;

foreach ($infoCommande as $info) {
    $info = explode(":", $info);
    $idProduit = $info[0];
    $quantiteProduit = $info[2];
    $prixProduit = $info[1];

    $produit = ProduitRepository::getProduitByID($idProduit);

    $nomProduit = $produit->getNomProduit();
    $prixTotalProduit = $prixProduit * $quantiteProduit;
    $prixTotal = $prixTotalProduit + $prixTotal;

    echo "<tr>";
    echo "<td>$nomProduit</td>";
    $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
    $bin = ProduitRepository::afficheImageProduit($idImageProduit);
    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>';
    echo "<td>$quantiteProduit</td>";
    echo "<td>$prixProduit €</td>";
    echo "<td>$prixTotalProduit €</td>";
    echo "</tr>";
}

echo "<tr>
        <td colspan='4'>Total de la commande (TTC)</td>
        <td>".$prixTotal." €</td>
    </tr>";
echo "</table>";
}


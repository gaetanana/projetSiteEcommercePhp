<?php

use App\eCommerce\Model\Repository\UtilisateurRepository;

if ($_SESSION['status'] != "fondateur" && $_SESSION['status'] != "admin") {
    header('Location: frontController.php?controller=produit&action=affichePageAcceuil');
}


$commandes = UtilisateurRepository::getCommandes();

echo "<h3>Commandes</h3>";
echo "<table>";
echo "<tr class='firstRow'>";
echo "<th>Id commande</th>";
echo "<th>Date commande</th>";
echo "<th>Quantité de produit commandé</th>";
echo "<th>Prix total de la commande</th>";
echo "<th>Détails</th>";
echo "</tr>";

foreach ($commandes as $commande) {
    $idCommande = $commande['idcommande'];
    $dateCommande = $commande['datecommande'];

    $dateCommande = date(" d/m/Y à H:i", strtotime($dateCommande));

    $infoCommande = $commande['infocommande'];

    $infoCommande = explode(";", $infoCommande);
    $infoCommande = array_filter($infoCommande);

    $quantiteProduitCommande = 0;
    $prixTotalCommande = 0;

    foreach ($infoCommande as $info) {
        $info = explode(":", $info);
        $quantiteProduitCommande += $info[2];
        $prixTotalCommande += $info[1] * $info[2];
    }

    echo "<tr>";
    echo "<td>$idCommande</td>";
    echo "<td>le $dateCommande</td>";
    echo "<td>$quantiteProduitCommande</td>";
    echo "<td>$prixTotalCommande €</td>";
    echo "<td><a href='frontController.php?controller=utilisateur&action=afficheCommande&id=$idCommande'>Détails</a></td>";
    echo "</tr>";
}

echo "</table>";

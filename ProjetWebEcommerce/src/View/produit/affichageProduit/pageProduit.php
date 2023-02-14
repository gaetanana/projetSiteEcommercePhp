<?php
use App\eCommerce\Model\Repository\ProduitRepository;
$produit = ProduitRepository::getProduitById($_GET['id']);
$type = ProduitRepository::getTypeProduit($_GET['id']);


echo '<div class="AffichageProduit"><div class="PanneauProduitGauche"><div class="TitreProduit"><h3>'. $produit->getNomProduit() . '</h3>';
if ($type == "Vinyle") {
    echo '<p>'. $produit->getArtistVinyle() . '</p></div>';
} else if ($type == "Ampli") {
    echo '<p>'. $produit->getMarqueAmplis() . '</p></div>';
} else if ($type == "Platine") {
    echo '<p>'. $produit->getMarquePlatine() . '</p></div>';
} else if ($type == "Enceinte") {
    echo '<p>'. $produit->getMarqueEnceinte() . '</p></div>';
}

$idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
$bin = ProduitRepository::afficheImageProduit($idImageProduit);
echo '<div class="ImageProduit"><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></div></div>';
echo '<div class="PanneauProduitDroite"><div><p>'. $produit->getDescriptionProduit() . '</p>';
echo '<p>'. $produit->getPrixProduit() . '€</p></div>';
echo '<div class="FormAjoutPanier"><form action="frontController.php?controller=panier&action=ajoutDansPanier&id='.$produit->getIdProduit().'" method="post">';

if($produit->getStockProduit() > 0) {
    echo '<input type="number" name="quantiteProduit" min="1" max="'.$produit->getStockProduit().'" value="1">';

    echo '<input type="hidden" name="idProduit" value="'.$produit->getIdProduit().'">';

    echo '<input type="submit" value="Ajouter au panier">';
} else {
    echo '<input type="submit" disabled="disabled" value="Rupture de stock">';
}

?>
</form></div></div></div>

<h3 style="margin: 20px">Caractéristiques</h3>

<table>
    <thead>
        <tr>
            <th colspan="2">Caractéristiques</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($type == "Vinyle") {
        echo '<tr><td>Nom</td><td>'. $produit->getNomProduit() . '</td></tr>';
        echo '<tr><td>Artiste</td><td>'. $produit->getArtistVinyle() . '</td></tr>';
        echo '<tr><td>Genre</td><td>'. $produit->getGenreVinyle() . '</td></tr>';
        echo '<tr><td>Description</td><td>'. $produit->getDescriptionProduit() . '</td></tr>';
        echo '<tr><td>Taille</td><td>'. $produit->getTailleVinyle() . '</td></tr>';

    } else if ($type == "Ampli") {
        echo '<tr><td>Nom</td><td>'. $produit->getNomProduit() . '</td></tr>';
        echo '<tr><td>Marque</td><td>'. $produit->getMarqueAmplis() . '</td></tr>';
        echo '<tr><td>Description</td><td>'. $produit->getDescriptionProduit() . '</td></tr>';
        echo '<tr><td>Puissance</td><td>'. $produit->getPuissanceAmplis() . '</td></tr>';
        echo '<tr><td>Sensibilité</td><td>'. $produit->getSensibiliteAmplis() . '</td></tr>';

    } else if ($type == "Platine") {
        echo '<tr><td>Nom</td><td>'. $produit->getNomProduit() . '</td></tr>';
        echo '<tr><td>Marque</td><td>'. $produit->getMarquePlatine() . '</td></tr>';
        echo '<tr><td>Description</td><td>'. $produit->getDescriptionProduit() . '</td></tr>';
        echo '<tr><td>Format Vinyle</td><td>'. $produit->getFormatVinyle() . '</td></tr>';
        echo '<tr><td>Bluetooth</td><td>'. $produit->getBluetooth() . '</td></tr>';

    } else if ($type == "Enceinte") {
        echo '<tr><td>Nom</td><td>'. $produit->getNomProduit() . '</td></tr>';
        echo '<tr><td>Marque</td><td>'. $produit->getMarqueEnceinte() . '</td></tr>';
        echo '<tr><td>Description</td><td>'. $produit->getDescriptionProduit() . '</td></tr>';
        echo '<tr><td>Puissance</td><td>'. $produit->getPuissanceEnceinte() . '</td></tr>';
        echo '<tr><td>Sensibilité</td><td>'. $produit->getSensibiliteEnceinte() . '</td></tr>';
    }
    ?>
    </tbody>
</table>


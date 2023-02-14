<label for="pet-select">Quels produits voulez-vous afficher?</label>

<form method="post">
    <select name="listeArticles">
        <option value="Produits">Tous</option>
        <option value="Platines">Platines</option>
        <option value="Enceintes">Enceintes</option>
        <option value="Vinyles">Vinyles</option>
        <option value="Amplis">Amplis</option>

    </select>
    <input type="submit" value="Valider">

</form>


<h3>Liste des
<?php
//Si ce n'est pas un fondateur ni un admin, on redirige vers la page d'accueil
if ($_SESSION['status'] != "fondateur" && $_SESSION['status'] != "admin") {
    header('Location: frontController.php?controller=produit&action=affichePageAcceuil');
}

use App\eCommerce\Controller\ControllerAdmin;
use App\eCommerce\Model\Repository\ProduitRepository;


/**
 * @return void
 */
function afficherTousLesProduits(): void
{
    $listeProduits = ProduitRepository::getAllProduits();
    echo 'Produits </h3> <table>
    <thead>
    <tr>
        <th colspan="6">
            Produits
        </th>
    </tr>
    </thead>
    <tbody>
    <tr class="firstRow">
        <td>id</td>
        <td>nom</td>
        <td>image</td>
        <td>Stock</td>
        <td>modification</td>
        <td>suppression</td>
    </tr>';

    foreach (ProduitRepository::getAllProduits() as $produit) {
        $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
        $idProduit = $produit->getIdProduit();
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);

        echo '    <tr>
        <td>' . $idProduit . '</td>
        <td>' . $produit->getNomProduit() . '</td>
        <td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>';
        if ($produit->getStockProduit() > 0) {
            echo '<td>' . $produit->getStockProduit() . '</td>';
        } else {
            echo '<td>RUPTURE</td>';
        }
        echo "<td><a href='frontController.php?controller=admin&action=modifieProduitSelonType&id=$idProduit''>Modifier</a></td>";
        echo "<td><a href='frontController.php?controller=admin&action=supprimeProduit&id=$idProduit''>Supprimer</a></td>";
        echo '</tr>';
    }
    echo '</tbody> </table>';
}

if (isset($_POST['listeArticles'])) {
    $article = $_POST['listeArticles'];

    if ($article == 'Produits') {

        afficherTousLesProduits();

    } elseif ($article == 'Vinyles') {
        echo 'Vinyles </h3> <table>
    <thead>
    <tr>
        <th colspan="9">
            Vinyles
        </th>
    </tr>
    </thead>
    <tbody>
    <tr class="firstRow">
        <td>id</td>
        <td>nom</td>
        <td>Artiste</td>
        <td>image</td>
        <td>prix</td>
        <td>genre</td>
        <td>stock</td>
        <td>modification</td>
        <td>suppression</td>
        
    </tr>';

        $listeVinyles = ProduitRepository::getProduitsVinyles();
        if ($listeVinyles == null) {
            echo '<tr><td colspan="9">Aucun vinyle</td></tr>';
        } else {
            foreach ($listeVinyles as $produit) {
                $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
                $idProduit = $produit->getIdProduit();
                $bin = ProduitRepository::afficheImageProduit($idImageProduit);

                echo '    <tr>
        <td>' . $idProduit . '</td>
        <td>' . $produit->getNomProduit() . '</td>
        <td>' . $produit->getArtistVinyle() . '</td>
        <td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>
        <td>' . $produit->getPrixProduit() . '</td>
        <td>' . $produit->getGenreVinyle() . '</td>';

                if ($produit->getStockProduit() > 0) {
                    echo '<td>' . $produit->getStockProduit() . '</td>';
                } else {
                    echo '<td>RUPTURE</td>';
                }

                echo "<td><a href='frontController.php?controller=admin&action=modifieProduitSelonType&id=$idProduit''>Modifier</a></td>";
                echo "<td><a href='frontController.php?controller=admin&action=supprimeProduit&id=$idProduit''>Supprimer</a></td>";
                echo '</tr>';

            }
            echo '</tbody> </table>';
        }

    } elseif ($article == 'Platines') {
        echo 'Platines </h3> <table>
    <thead>
    <tr>
        <th colspan="9">
            Platines
        </th>
    </tr>
    </thead>
    <tbody>
    <tr class="firstRow">
        <td>id</td>
        <td>nom</td>
        <td>marque</td>
        <td>image</td>
        <td>bluetooth</td>
        <td>prix</td>
        <td>stock</td>
        <td>modification</td>
        <td>suppression</td>
    </tr>';

        $listePlatines = ProduitRepository::getProduitsPlatines();
        if ($listePlatines == null) {
            echo '<tr><td colspan="9">Aucune platine</td></tr>';
        } else {
            foreach ($listePlatines as $produit) {
                $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
                $idProduit = $produit->getIdProduit();
                $bin = ProduitRepository::afficheImageProduit($idImageProduit);

                echo '    <tr>
        <td>' . $idProduit . '</td>
        <td>' . $produit->getNomProduit() . '</td>
        <td>' . $produit->getMarquePlatine() . '</td>
        <td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>
        <td>' . $produit->getBluetooth() . '</td>
        <td>' . $produit->getPrixProduit() . '</td>';

                if ($produit->getStockProduit() > 0) {
                    echo '<td>' . $produit->getStockProduit() . '</td>';
                } else {
                    echo '<td>RUPTURE</td>';
                }

                echo "<td><a href='frontController.php?controller=admin&action=modifieProduitSelonType&id=$idProduit''>Modifier</a></td>";
                echo "<td><a href='frontController.php?controller=admin&action=supprimeProduit&id=$idProduit''>Supprimer</a></td>";
                echo '</tr>';

            }
            echo '</tbody> </table>';
        }

    } elseif ($article == 'Enceintes') {
        echo 'Enceintes </h3> <table>
    <thead>
    <tr>
        <th colspan="10">
            Enceintes
        </th>
    </tr>
    </thead>
    <tbody>
    <tr class="firstRow">
        <td>id</td>
        <td>nom</td>
        <td>marque</td>
        <td>image</td>
        <td>sensibilité</td>
        <td>puissance</td>
        <td>prix</td>
        <td>stock</td>
        <td>modification</td>
        <td>suppression</td>
        </tr>';

        $listeEnceintes = ProduitRepository::getProduitsEnceintes();
        if ($listeEnceintes == null) {
            echo '<tr><td colspan="10">Aucune enceinte</td></tr>';
        } else {
            foreach ($listeEnceintes as $produit) {
                $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
                $idProduit = $produit->getIdProduit();
                $bin = ProduitRepository::afficheImageProduit($idImageProduit);

                echo '    <tr>
        <td>' . $idProduit . '</td>
        <td>' . $produit->getNomProduit() . '</td>
        <td>' . $produit->getMarqueEnceinte() . '</td>
        <td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>
        <td>' . $produit->getSensibiliteEnceinte() . '</td>
        <td>' . $produit->getPuissanceEnceinte() . '</td>
        <td>' . $produit->getPrixProduit() . '</td>';

                if ($produit->getStockProduit() > 0) {
                    echo '<td>' . $produit->getStockProduit() . '</td>';
                } else {
                    echo '<td>RUPTURE</td>';
                }

                echo "<td><a href='frontController.php?controller=admin&action=modifieProduitSelonType&id=$idProduit''>Modifier</a></td>";
                echo "<td><a href='frontController.php?controller=admin&action=supprimeProduit&id=$idProduit''>Supprimer</a></td>";
                echo '</tr>';

            }
            echo '</tbody> </table>';
        }

    } elseif ($article == 'Amplis') {
        echo 'Amplis </h3> <table>
    <thead>
    <tr>
        <th colspan="10">
            Amplis
        </th>
    </tr>
    </thead>
    <tbody>
    
    <tr class="firstRow">
        <td>id</td>
        <td>nom</td>
        <td>marque</td>
        <td>image</td>
        <td>sensibilité</td>
        <td>puissance</td>
        <td>prix</td>
        <td>stock</td>
        <td>modification</td>
        <td>suppression</td>
    </tr>';

        $listeAmplis = ProduitRepository::getProduitsAmplis();
        if ($listeAmplis == null) {
            echo '<tr><td colspan="10">Aucun ampli</td></tr>';
        } else {
            foreach ($listeAmplis as $produit) {
                $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
                $idProduit = $produit->getIdProduit();
                $bin = ProduitRepository::afficheImageProduit($idImageProduit);

                echo '    <tr>
            <td>' . $idProduit . '</td>
            <td>' . $produit->getNomProduit() . '</td>
            <td>' . $produit->getMarqueAmplis() . '</td>
            <td><img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/></td>
            <td>' . $produit->getSensibiliteAmplis() . '</td>
            <td>' . $produit->getPuissanceAmplis() . '</td>
            <td>' . $produit->getPrixProduit() . '</td>';

            if ($produit->getStockProduit() > 0) {
                    echo '<td>' . $produit->getStockProduit() . '</td>';
                } else {
                    echo '<td>RUPTURE</td>';
                }

                echo "<td><a href='frontController.php?controller=admin&action=modifieProduitSelonType&id=$idProduit''>Modifier</a></td>";


                echo "<td><a href='frontController.php?controller=admin&action=supprimeProduit&id=$idProduit''>Supprimer</a></td>";
                echo '</tr>';

            }
            echo '</tbody> </table>';
        }
    }


} else {
    afficherTousLesProduits();
}


echo "</tbody> </table>";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<a href='frontController.php?controller=admin&action=afficheFormulaireAjoutProduit'>Ajouter un produit</a>";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

if (isset($messageSupp)) {
    echo "<p>$messageSupp</p>";
}
if (isset($messageModif)) {
    echo "<p>$messageModif</p>";
}




?>
<div class="affichageProduits">
    <div class="panneauCaractéristiques">
        <h3>Filtrer les Platines</h3>

        <form method="post">
            <p> Prix: </p>
            <p>de
                <input type="number" name="prixMin" min="0" max="1000" value="0">
                à
                <input type="number" name="prixMax" min="0" max="1000" value="1000">
                €
            </p>

            <?php
            use App\eCommerce\Model\Repository\ProduitRepository;

            $marques = ProduitRepository::getListeMarquesPlatine();
            echo '<p>Marque: </p>';
            foreach ($marques as $marque) {
                echo '<div><input type="checkbox" name="marque[]" value="' . $marque['marquePlatine'] . '">'.$marque['marquePlatine'] . '</div>';
            }
            ?>
            <input type="submit" value="Valider">
        </form>
    </div>

    <?php

    use App\eCommerce\Model\DataObject\produit\Platine;

    echo '<div class="TousLesVinyles">';

    if (isset($_POST['prixMin']) && isset($_POST['prixMax'])) {
        foreach ($listeProduitsPlatines as $key => $produitsPlatine) {
            if ($produitsPlatine->getPrixProduit() < $_POST['prixMin'] || $produitsPlatine->getPrixProduit() > $_POST['prixMax']) {
                unset($listeProduitsPlatines[$key]);
            }
        }
    }

    if (isset($_POST['marque'])) {
        foreach ($listeProduitsPlatines as $key => $produitsPlatine) {
            if (!in_array($produitsPlatine->getMarquePlatine(), $_POST['marque'])) {
                unset($listeProduitsPlatines[$key]);
            }
        }
    }

    if (isset($listeProduitsPlatines) && !empty($listeProduitsPlatines)) {
        foreach ($listeProduitsPlatines as $produitsPlatine) {
            echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produitsPlatine->getIdProduit() . '"><div class="ProduitListe">';
            $idImageProduit = ProduitRepository::getIdImageProduit($produitsPlatine->getIdProduit());
            $bin = ProduitRepository::afficheImageProduit($idImageProduit);
            echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
            echo '<div>' . $produitsPlatine->getMarquePlatine() . '</div>';
            echo '<div>' . $produitsPlatine->getNomProduit() . '</div>';
            echo '<div>' . $produitsPlatine->getPrixProduit() . ' €</div>';
            echo '</div></a>';

        }

    } else if ($listeProduitsPlatines == null) {
        echo "<p>Il n'y a pas de platine correspondant à votre recherche dans la base de données</p>";
    }

    ?>
</div>
</div>



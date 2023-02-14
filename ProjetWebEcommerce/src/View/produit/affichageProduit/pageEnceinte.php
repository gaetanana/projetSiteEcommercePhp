<div class="affichageProduits">
    <div class="panneauCaractéristiques">
        <h3>Filter les Enceintes</h3>

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

            $marques = ProduitRepository::getListeMarquesEnceinte();
            echo '<p>Marque: </p>';
            foreach ($marques as $marque) {
                echo '<div><input type="checkbox" name="marque[]" value="' . $marque['marqueEnceinte'] . '">' . $marque['marqueEnceinte'] . '</div>';
            }
            ?>
            <input type="submit" value="Valider">
        </form>
    </div>


    <?php

    use App\eCommerce\Model\DataObject\produit\Enceinte;


    echo '<div class="TousLesVinyles">';

    if (isset($_POST['prixMin']) && isset($_POST['prixMax'])) {
        foreach ($listeProduitsEnceintes as $key => $produitsEnceinte) {
            if ($produitsEnceinte->getPrixProduit() < $_POST['prixMin'] || $produitsEnceinte->getPrixProduit() > $_POST['prixMax']) {
                unset($listeProduitsEnceintes[$key]);
            }
        }
    }

    if (isset($_POST['marque'])) {
        foreach ($listeProduitsEnceintes as $key => $produitsEnceinte) {
            if (!in_array($produitsEnceinte->getMarqueEnceinte(), $_POST['marque'])) {
                unset($listeProduitsEnceintes[$key]);
            }
        }
    }

    if (isset($listeProduitsEnceintes) && !empty($listeProduitsEnceintes)) {
        foreach ($listeProduitsEnceintes as $produitEnceinte) {

            echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produitEnceinte->getIdProduit() . '"><div class="ProduitListe">';
            $idImageProduit = ProduitRepository::getIdImageProduit($produitEnceinte->getIdProduit());
            $bin = ProduitRepository::afficheImageProduit($idImageProduit);
            echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
            echo '<div>' . $produitEnceinte->getMarqueEnceinte() . '</div>';
            echo '<div>' . $produitEnceinte->getNomProduit() . '</div>';
            echo '<div>' . $produitEnceinte->getPrixProduit() . ' €</div>';
            echo '</div></a>';
        }

    } else if ($listeProduitsEnceintes == null) {
        echo "<p>Il n'y a pas d'enceinte correspondant à votre recherche dans la base de données</p>";
    }

    ?>
</div>
</div>

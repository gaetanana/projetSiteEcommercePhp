<div class="affichageProduits">
    <div class="panneauCaractéristiques">
        <h3>Filter les Amplificateurs</h3>

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

            $marques = ProduitRepository::getListeMarquesAmplis();
            echo '<p>Marque: </p>';
            foreach ($marques as $marque) {
                echo '<div><input type="checkbox" name="marque[]" value="' . $marque['marqueAmplis'] . '">'.$marque['marqueAmplis'] . '</div>';
            }
            ?>
            <input type="submit" value="Valider">
        </form>
    </div>


    <?php
use App\eCommerce\Model\DataObject\produit\Amplis;


echo '<div class="TousLesVinyles">';

    if (isset($_POST['prixMin']) && isset($_POST['prixMax'])) {
        foreach ($listeProduitsAmplis as $key => $produitsAmplis) {
            if ($produitsAmplis->getPrixProduit() < $_POST['prixMin'] || $produitsAmplis->getPrixProduit() > $_POST['prixMax']) {
                unset($listeProduitsAmplis[$key]);
            }
        }
    }

    if (isset($_POST['marque'])) {
        foreach ($listeProduitsAmplis as $key => $produitsAmplis) {
            if (!in_array($produitsAmplis->getMarqueAmplis(), $_POST['marque'])) {
                unset($listeProduitsAmplis[$key]);
            }
        }
    }

if (isset($listeProduitsAmplis) && !empty($listeProduitsAmplis)) {
    foreach ($listeProduitsAmplis as $produitAmpli) {
        echo'<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id='.$produitAmpli->getIdProduit().'"><div class="ProduitListe">';
        $idImageProduit = ProduitRepository::getIdImageProduit($produitAmpli->getIdProduit());
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
        echo '<div>' . $produitAmpli->getMarqueAmplis() . '</div>';
        echo '<div>' . $produitAmpli->getNomProduit() . '</div>';
        echo '<div>' . $produitAmpli->getPrixProduit() . ' €</div>';
        echo '</div></a>';
    }

} else if ($listeProduitsAmplis == null) {
    echo "<p>Il n'y a pas d'ampli correspondant à votre recherche dans la base de données</p>";
}

?>
</div>
</div>

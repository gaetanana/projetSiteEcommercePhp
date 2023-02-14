<div class="affichageProduits">
    <div class="panneauCaractéristiques">
        <h3>Filtrer les vinyles</h3>

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

            $artistes = ProduitRepository::getListeArtistesVinyle();
            /* format de $artistes:
             Array ( [0] => Array ( [artisteVinyle] => The Clash [0] => The Clash ) [1] => Array ( [artisteVinyle] => Nirvana [0] => Nirvana ) [2] => Array ( [artisteVinyle] => The Beatles [0] => The Beatles ) [3] => Array ( [artisteVinyle] => Fleetwood Mac [0] => Fleetwood Mac ) [4] => Array ( [artisteVinyle] => Queen [0] => Queen ) [5] => Array ( [artisteVinyle] => Michael Jackson [0] => Michael Jackson ) [6] => Array ( [artisteVinyle] => Imagine Dragons [0] => Imagine Dragons ) [7] => Array ( [artisteVinyle] => Lana Del Rey [0] => Lana Del Rey ) [8] => Array ( [artisteVinyle] => Arctic Monkeys [0] => Arctic Monkeys ) [9] => Array ( [artisteVinyle] => Nekfeu [0] => Nekfeu ) )  */

            //choix de l'artiste (avec checkbox)
            echo '<p>Artiste:</p>';
            foreach ($artistes as $artiste) {
                echo '<div><input type="checkbox" name="artiste[]" value="' . $artiste['artisteVinyle'] . '">'.$artiste['artisteVinyle'] . '</div>';
            }


            //choix du genre (avec checkbox)
            $genres = ProduitRepository::getListeGenresVinyle();
            echo '<p>Genre:</p>';

            //format de $genres:
            //ray(17) { [0]=> string(4) "Punk" [1]=> string(6) "Grunge" [2]=> string(9) "Hard Rock" [3]=> string(10) "Alternatif" [4]=> string(4) "Rock" [5]=> string(4) "Folk" [6]=> string(4) "Rock" [7]=> string(3) "Pop" [8]=> string(4) "Rock" [9]=> string(3) "Pop" [10]=> string(4) "Rock" [11]=> string(7) "Electro" [12]=> string(10) "Rock indé" [13]=> string(10) "Alternatif" [14]=> string(10) "Rock indé" [15]=> string(13) "Rap Français" [16]=> string(7) "Hip-Hop" }
            foreach ($genres as $genre) {
                echo '<div><input type="checkbox" name="genre[]" value="' . $genre . '">'.$genre . '</div>';
            }
            ?>
            <input type="submit" value="Valider">
        </form>
    </div>

    <?php

    echo '<div class="TousLesVinyles">';

    if (isset($_POST['prixMin']) && isset($_POST['prixMax'])) {
        foreach ($listeProduitsVinyles as $key => $produitsVinyle) {
            if ($produitsVinyle->getPrixProduit() < $_POST['prixMin'] || $produitsVinyle->getPrixProduit() > $_POST['prixMax']) {
                unset($listeProduitsVinyles[$key]);
            }
        }
    }

    if (isset($_POST['artiste'])) {
        foreach ($listeProduitsVinyles as $key => $produitsVinyle) {
            if (!in_array($produitsVinyle->getArtistVinyle(), $_POST['artiste'])) {
                unset($listeProduitsVinyles[$key]);
            }
        }
    }

    //getGenreArrayVinyle retourne un tableau de genre du vinyle courant
    if (isset($_POST['genre'])) {
        foreach ($listeProduitsVinyles as $key => $produitsVinyle) {
            if (!array_intersect($produitsVinyle->getGenreArray(), $_POST['genre'])) {
                unset($listeProduitsVinyles[$key]);
            }
        }
    }

    if (isset($listeProduitsVinyles) && !empty($listeProduitsVinyles)) {
        foreach ($listeProduitsVinyles as $produitsVinyle) {
            echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produitsVinyle->getIdProduit() . '"><div class="VinyleAccueil">';
            $idImageProduit = ProduitRepository::getIdImageProduit($produitsVinyle->getIdProduit());
            $bin = ProduitRepository::afficheImageProduit($idImageProduit);
            echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
            echo '<div>' . $produitsVinyle->getNomProduit() . '</div>';
            echo '<div>' . $produitsVinyle->getArtistVinyle() . '</div>';
            echo '<div>' . $produitsVinyle->getPrixProduit() . ' €</div>';
            echo '</div></a>';
        }
    } else if ($listeProduitsVinyles == null) {
        echo "<p>Il n'y a pas de vinyle correspondant à votre recherche dans la base de données</p>";
    }

    ?>
</div>
</div>
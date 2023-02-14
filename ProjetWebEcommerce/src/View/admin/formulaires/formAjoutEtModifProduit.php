<?php

use App\eCommerce\Model\Repository\ProduitRepository;

/*******************************Partie ajout produit******************************************************/
if (isset($ajoutProduit) && $ajoutProduit) {


    ?>
    <!--Demander si c'est un vinyl ou une platine ou une enceinte-->
    <div class="FormulaireAdmin">
        <div class="Formulaire">
            <label for="pet-select">Quel article voulez-vous rajouter</label>

            <form method="post">
                <select name="listeArticles">
                    <option value="">--Choisir--</option>
                    <option value="platine">Platine</option>
                    <option value="enceinte">Enceinte</option>
                    <option value="vinyle">Vinyle</option>
                    <option value="amplis">Amplis</option>

                </select>
                <input type="submit" value="Valider">

            </form>
        </div>
        <div class="FormulaireDroite">
            <?php
            if (isset($_POST['listeArticles'])) {
                $article = $_POST['listeArticles'];
                if ($article == '') {
                    echo '<p>Rien séléctionné</p>';

                } elseif ($article == 'platine') {
                    //Changer les actions
                    echo "
        
        <form method='POST' action='frontController.php?controller=admin&action=ajouteProduitPlatine' enctype='multipart/form-data'>

    <fieldset>
        <legend>Ajout d'une platine</legend>

        <p>
            <label for='nomProduit'>Nom du produit</label>
            <input type='text'  name='nomProduit' required/>
        </p>

        <p>
            <label for='descriptionProduit'>Description du produit</label>
            <input type='text'  name='descriptionProduit' required/>
        <p>

        <p>
            <label for='prixProduit'>Prix du produit</label>
            <input type='text'  name='prixProduit' required/>
        <p>

        <p>
            <label for='imageProduit'>Image produit</label>
            <input type='file'  name='imageProduit' required/>

        <p>

        <p>
            <label for='stockProduit'>Stock produit</label>
            <input type='text'  name='stockProduit' required/>
        <p>
        
        <p>
            <label for='formatVinyl'>Format vinyle</label>
            <input type='text'  name='formatVinyl' required/>
        <p>
        
        <p>
            <label for='bluetooth'>Bluetooh</label>
            <input type='text'  name='bluetoothPlatine' required/>
        <p>
        
        <p>
            <label for='marquePlatine'>Marque platine</label>
            <input type='text'  name='marquePlatine' required/>
        <p>



            <input type='submit' value='Ajouter'/>
        </p>
    </fieldset>

</form>";
                } elseif ($article == 'enceinte') {

                    echo "
        
        <form method='POST' action='frontController.php?controller=admin&action=ajouteProduitEnceinte' enctype='multipart/form-data'>

    <fieldset>
        <legend>Ajout d'une enceinte</legend>

        <p>
            <label for='nomProduit'>Nom du produit</label>
            <input type='text'  name='nomProduit' required/>
        </p>

        <p>
            <label for='descriptionProduit'>Description du produit</label>
            <input type='text'  name='descriptionProduit' required/>
        <p>

        <p>
            <label for='prixProduit'>Prix du produit</label>
            <input type='text'  name='prixProduit' required/>
        <p>

        <p>
            <label for='imageProduit'>Image produit</label>
            <input type='file'  name='imageProduit' required/>

        <p>

        <p>
            <label for='stockProduit'>Stock produit</label>
            <input type='text'  name='stockProduit' required/>
        <p>
        
        <p>
            <label for='sensibiliteEnceinte'>Sensibilité de l'enceinte</label>
            <input type='text'  name='sensibiliteEnceinte' required/>
        <p>
        
        <p>
            <label for='puissanceEnceinte'>Puissance enceinte</label>
            <input type='text'  name='puissanceEnceinte' required/>
        <p>
        
         <p>
            <label for='marqueEnceinte'>Marque enceinte</label>
            <input type='text'  name='marqueEnceinte' required/>
        <p>

            <input type='submit' value='Ajouter'/>
        </p>
    </fieldset>

</form>";


                } elseif ($article == 'vinyle') {
                    echo "
        
        <form method='POST' action='frontController.php?controller=admin&action=ajouteProduitVinyle' enctype='multipart/form-data'>

    <fieldset>
        <legend>Ajout d'un vinyle</legend>

        <p>
            <label for='nomProduit'>Nom du produit</label>
            <input type='text'  name='nomProduit' required/>
        </p>

        <p>
            <label for='descriptionProduit'>Description du produit</label>
            <input type='text'  name='descriptionProduit' required/>
        <p>

        <p>
            <label for='prixProduit'>Prix du produit</label>
            <input type='text'  name='prixProduit' required/>
        <p>

        <p>
            <label for='imageProduit'>Image produit</label>
            <input type='file'  name='imageProduit' required/>

        <p>

        <p>
            <label for='stockProduit'>Stock produit</label>
            <input type='text'  name='stockProduit' required/>
        <p>
        
        <p>
            <label for='tailleVinyle'>Taille vinyle</label>
            <input type='text'  name='tailleVinyle' required/>
        <p>
        
        <p>
            <label for='artisteVinyle'>Artiste</label>
            <input type='text'  name='artisteVinyle' required/>
        <p>
        
        <p>
            <label for='genreVinyle'>Genre vinyle</label>
            <input type='text'  name='genreVinyle' required/>
        <p>

            <input type='submit' value='Ajouter'/>
        </p>
    </fieldset>

</form>";
                } else if ($article == 'amplis') {
                    echo "
        
        <form method='POST' action='frontController.php?controller=admin&action=ajouteProduitAmpli' enctype='multipart/form-data'>

    <fieldset>
        <legend>Ajout d'un ampli</legend>

        <p>
            <label for='nomProduit'>Nom du produit</label>
            <input type='text'  name='nomProduit' required/>
        </p>

        <p>
            <label for='descriptionProduit'>Description du produit</label>
            <input type='text'  name='descriptionProduit' required/>
        <p>

        <p>
            <label for='prixProduit'>Prix du produit</label>
            <input type='text'  name='prixProduit' required/>
        <p>

        <p>
            <label for='imageProduit'>Image produit</label>
            <input type='file'  name='imageProduit' required/>

        <p>

        <p>
            <label for='stockProduit'>Stock produit</label>
            <input type='text'  name='stockProduit' required/>
        <p>
        
        <p>
            <label for='puissanceAmplis'>Puissance ampli</label>
            <input type='text'  name='puissanceAmplis' required/>
        <p>
        
        <p>
            <label for='artisteVinyle'>Sensibilité ampli</label>
            <input type='text'  name='sensibiliteAmplis' required/>
        <p>
        
        <p>
            <label for='marqueAmplis'>Marque ampli</label>
            <input type='text'  name='marqueAmplis' required/>
        <p>
            <input type='submit' value='Ajouter'/>
        </p>
    </fieldset>

</form>";

                }

            }
            ?>
        </div>
    </div>

    <?php
}

/*******************************Partie modification produit******************************************************/



else if (isset($typeProduit) && $typeProduit == "Ampli") { ?>
    <div class="FormulaireDroite">
    <form method='POST' action='frontController.php?controller=admin&action=modifieAmplis'
          enctype='multipart/form-data'>

        <?php

        //Produit à modifier
        if (isset($idProduit)) {
            $produitAmplis = ProduitRepository::getProduitById($idProduit);
            echo "<input type='hidden' name = 'idProduit' value='$idProduit'>";
        }


        ?>


        <fieldset>
            <legend>Modifie un ampli</legend>

            <p>
                <label for='nomProduit'>Nom du produit</label>
                <?php
                $nomAmplis = $produitAmplis->getNomProduit();
                echo "<input type='text' value='$nomAmplis' name='nomAmplis' required/>";
                ?>
            </p>

            <p>
                <label for='descriptionProduit'>Description du produit</label>
                <?php
                $descriptionAmplis = $produitAmplis->getDescriptionProduit();
                echo "<input type='text' value='$descriptionAmplis' name='descriptionAmplis' required/>";
                ?>
            <p>

            <p>
                <label for='prixProduit'>Prix du produit</label>
                <?php
                $prixAmplis = $produitAmplis->getPrixProduit();
                echo "<input type='text' value='$prixAmplis' name='prixAmplis' required/>";
                ?>

            <p>

            <p>
                <label for='imageProduit'>Image produit</label>
                <?php
                echo "<input type='file' name='imageAmplis'/>";
                ?>
            <p>

            <p>
                <label for='stockProduit'>Stock produit</label>
                <?php

                $stockAmplis = ProduitRepository::getStockProduitById($idProduit);
                echo "<input type='text' value='$stockAmplis' name='stockAmplis' required/>";
                ?>
            <p>

            <p>
                <label for='puissanceAmplis'>Puissance ampli</label>
                <?php
                $puissanceAmplis = $produitAmplis->getPuissanceAmplis();
                echo "<input type='text' value='$puissanceAmplis' name='puissanceAmplis' required/>";
                ?>
            <p>

            <p>
                <label for='sensibiliteAmpli'>Sensibilité ampli</label>
                <?php
                $sensibiliteAmplis = $produitAmplis->getSensibiliteAmplis();
                echo "<input type='text' value='$sensibiliteAmplis' name='sensibiliteAmplis' required/>";
                ?>
            <p>

            <p>
                <label for='marqueAmplis'>Marque ampli</label>
                <?php
                $marqueAmplis = $produitAmplis->getMarqueAmplis();
                echo "<input type='text' value='$marqueAmplis' name='marqueAmplis' required/>";
                ?>

            <p>
                <input type='submit' value='Modifier'/>
            </p>
        </fieldset>

    </form>
    </div>

<?php } else if (isset($typeProduit) && $typeProduit == "Enceinte") { ?>
    <div class="FormulaireDroite">
    <form method='POST' action='frontController.php?controller=admin&action=modifieEnceinte'
          enctype='multipart/form-data'>

        <?php


        //Produit à modifier
        if (isset($idProduit)) {
            $produitEnceinte = ProduitRepository::getProduitById($idProduit);
            echo "<input type='hidden' name = 'idProduit' value='$idProduit'>";
        }


        ?>


        <fieldset>
            <legend>Modifie une enceinte</legend>

            <p>
                <label for='nomProduit'>Nom du produit</label>
                <?php
                $nomEnceinte = $produitEnceinte->getNomProduit();
                echo "<input type='text' value='$nomEnceinte' name='nomEnceinte' required/>";
                ?>
            </p>

            <p>
                <label for='descriptionProduit'>Description du produit</label>
                <?php
                $descriptionEnceinte = $produitEnceinte->getDescriptionProduit();
                echo "<input type='text' value='$descriptionEnceinte' name='descriptionEnceinte' required/>";
                ?>
            <p>

            <p>
                <label for='prixProduit'>Prix du produit</label>
                <?php
                $prixEnceinte = $produitEnceinte->getPrixProduit();
                echo "<input type='text' value='$prixEnceinte' name='prixEnceinte' required/>";
                ?>

            <p>

            <p>
                <label for='imageProduit'>Image produit</label>
                <?php
                echo "<input type='file' name='imageEnceinte'/>";
                ?>
            <p>

            <p>
                <label for='stockProduit'>Stock produit</label>
                <?php
                $stockEnceinte = ProduitRepository::getStockProduitById($idProduit);
                echo "<input type='text' value='$stockEnceinte' name='stockEnceinte' required/>";
                ?>
            <p>

            <p>
                <label for='puissanceEnceinte'>Puissance enceinte</label>
                <?php
                $puissanceEnceinte = $produitEnceinte->getPuissanceEnceinte();
                echo "<input type='text' value='$puissanceEnceinte' name='puissanceEnceinte' required/>";
                ?>
            <p>


            <p>
                <label for='puissanceAmplis'>Sensibilité enceinte</label>
                <?php
                $sensibiliteEnceinte = $produitEnceinte->getSensibiliteEnceinte();
                echo "<input type='text' value='$sensibiliteEnceinte' name='sensibiliteEnceinte' required/>";
                ?>
            <p>

            <p>
                <label for='marqueAmplis'>Marque ampli</label>
                <?php
                $marqueEnceinte = $produitEnceinte->getMarqueEnceinte();
                echo "<input type='text' value='$marqueEnceinte' name='marqueEnceinte' required/>";
                ?>

            <p>
                <input type='submit' value='Modifier'/>
            </p>
        </fieldset>

    </form>
    </div>

<?php } else if (isset($typeProduit) && $typeProduit == "Platine") { ?>
    <div class="FormulaireDroite">
    <form method='POST' action='frontController.php?controller=admin&action=modifiePlatine'
          enctype='multipart/form-data'>

        <?php


        //Produit à modifier
        if (isset($idProduit)) {
            $produitPlatine = ProduitRepository::getProduitById($idProduit);
            echo "<input type='hidden' name = 'idProduit' value='$idProduit'>";
        }


        ?>


        <fieldset>
            <legend>Modifie une platine</legend>

            <p>
                <label for='nomProduit'>Nom du produit</label>
                <?php
                $nomPlatine = $produitPlatine->getNomProduit();
                echo "<input type='text' value='$nomPlatine' name='nomPlatine' required/>";
                ?>
            </p>

            <p>
                <label for='descriptionProduit'>Description du produit</label>
                <?php
                $descriptionPlatine = $produitPlatine->getDescriptionProduit();
                echo "<input type='text' value='$descriptionPlatine' name='descriptionPlatine' required/>";
                ?>
            <p>

            <p>
                <label for='prixProduit'>Prix du produit</label>
                <?php
                $prixPlatine = $produitPlatine->getPrixProduit();
                echo "<input type='text' value='$prixPlatine' name='prixPlatine' required/>";
                ?>

            <p>

            <p>
                <label for='imageProduit'>Image produit</label>
                <?php
                echo "<input type='file' name='imagePlatine'/>";
                ?>
            <p>

            <p>
                <label for='stockProduit'>Stock produit</label>
                <?php
                $stockPlatine = ProduitRepository::getStockProduitById($idProduit);
                echo "<input type='text' value='$stockPlatine' name='stockPlatine' required/>";
                ?>
            <p>

            <p>
                <label for='formatVinyle'>Format vinyle</label>
                <?php
                $formatVinyle = $produitPlatine->getFormatVinyle();
                echo "<input type='text' value='$formatVinyle' name='formatVinyle' required/>";
                ?>
            <p>


            <p>
                <label for='bluetooth'>Bluetooth</label>
                <?php
                $bluetoothPlatine = $produitPlatine->getBluetooth();
                echo "<input type='text' value='$bluetoothPlatine' name='bluetoothPlatine' required/>";
                ?>
            <p>

            <p>
                <label for='marquePlatine'>Marque platine</label>
                <?php
                $marquePlatine = $produitPlatine->getMarquePlatine();
                echo "<input type='text' value='$marquePlatine' name='marquePlatine' required/>";
                ?>

            <p>
                <input type='submit' value='Modifier'/>
            </p>
        </fieldset>

    </form>
    </div>

<?php } else if (isset($typeProduit) && $typeProduit == "Vinyle") { ?>
    <div class="FormulaireDroite">
    <form method='POST' action='frontController.php?controller=admin&action=modifieVinyle'
          enctype='multipart/form-data'>

        <?php


        //Produit à modifier
        if (isset($idProduit)) {
            $produitVinyle = ProduitRepository::getProduitById($idProduit);
            echo "<input type='hidden' name = 'idProduit' value='$idProduit'>";
        }


        ?>


        <fieldset>
            <legend>Modifie un vinyle</legend>

            <p>
                <label for='nomProduit'>Nom du produit</label>
                <?php
                $nomVinyle = $produitVinyle->getNomProduit();
                echo "<input type='text' value='$nomVinyle' name='nomVinyle' required/>";
                ?>
            </p>

            <p>
                <label for='descriptionProduit'>Description du produit</label>
                <?php
                $descriptionVinyle = $produitVinyle->getDescriptionProduit();
                echo "<input type='text' value='$descriptionVinyle' name='descriptionVinyle' required/>";
                ?>
            <p>

            <p>
                <label for='prixProduit'>Prix du produit</label>
                <?php
                $prixVinyle = $produitVinyle->getPrixProduit();
                echo "<input type='text' value='$prixVinyle' name='prixVinyle' required/>";
                ?>

            <p>

            <p>
                <label for='imageProduit'>Image produit</label>
                <?php
                echo "<input type='file' name='imageVinyle'/>";
                ?>
            <p>

            <p>
                <label for='stockProduit'>Stock produit</label>
                <?php
                $stockVinyle = ProduitRepository::getStockProduitById($idProduit);
                echo "<input type='text' value='$stockVinyle' name='stockVinyle' required/>";
                ?>
            <p>

            <p>
                <label for='tailleVinyle'>Taille vinyle</label>
                <?php
                $tailleVinyle = $produitVinyle->getTailleVinyle();
                echo "<input type='text' value='$tailleVinyle' name='tailleVinyle' required/>";
                ?>
            <p>


            <p>
                <label for='artiste'>Artiste</label>
                <?php
                $artisteVinyle = $produitVinyle->getArtistVinyle();
                echo "<input type='text' value='$artisteVinyle' name='artisteVinyle' required/>";
                ?>
            <p>

            <p>
                <label for='genreVinyle'>Genre vinyle</label>
                <?php
                $genreVinyle = $produitVinyle->getGenreVinyle();
                echo "<input type='text' value='$genreVinyle' name='genreVinyle' required/>";
                ?>
            <p>


                <input type='submit' value='Modifier'/>
            </p>
        </fieldset>

    </form>
    </div>

<?php }

?>


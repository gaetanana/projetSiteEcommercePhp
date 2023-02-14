<h3>Résultat de votre recherche</h3>
<div class="TousLesVinyles">

<?php

use App\eCommerce\Controller\ControllerAdmin;
use App\eCommerce\Model\DataObject\produit\Enceinte;
use App\eCommerce\Model\DataObject\produit\Platine;
use App\eCommerce\Model\DataObject\produit\Vinyle;
use App\eCommerce\Model\Repository\ProduitRepository;

if(isset($typeDeRecherche) && $typeDeRecherche == "platine"){

    $listeProduits = ProduitRepository::getProduitsPlatines();
    foreach ($listeProduits as $produit) {
        //Affiche les produits
        afficherProduit($produit);
    }

}
else if(isset($typeDeRecherche) && $typeDeRecherche == "enceinte"){

    $listeProduits = ProduitRepository::getProduitsEnceintes();


}else if(isset($typeDeRecherche) && $typeDeRecherche == "vinyle"){

    $listeProduits = ProduitRepository::getProduitsVinyles();


}else if(isset($typeDeRecherche) && $typeDeRecherche == "amplis"){

    $listeProduits = ProduitRepository::getProduitsAmplis();
    foreach ($listeProduits as $produit) {
        //Affiche les produits
        afficherProduit($produit);
    }


}
else if(isset($typeDeRecherche) && $typeDeRecherche == "nomProduit") {

    if(isset($requeteUtilisateur)){
        $listeProduits = ProduitRepository::chercherProduitParNom($requeteUtilisateur);
        foreach ($listeProduits as $produit) {
            //Affiche les produits
            afficherProduit($produit);

        }
    }

}

else if(isset($typeDeRecherche) && $typeDeRecherche == "marque") {


    if(isset($requeteUtilisateur)){
        $listeProduits = ProduitRepository::chercherProduitParMarque($requeteUtilisateur);
        foreach ($listeProduits as $produit) {
            //Affiche les produits
            afficherProduit($produit);

        }
    }

}

else if(isset($typeDeRecherche) && $typeDeRecherche == "artiste") {

    if(isset($requeteUtilisateur)){
        $listeProduits = ProduitRepository::chercherProduitParArtiste($requeteUtilisateur);
        foreach ($listeProduits as $produit) {
            //Affiche les produits
            afficherProduit($produit);

        }
    }

}
else if(isset($typeDeRecherche) && $typeDeRecherche == "genre"){

    if(isset($requeteUtilisateur)){
        $listeProduits = ProduitRepository::chercherProduitParGenre($requeteUtilisateur);
        foreach ($listeProduits as $produit) {
            //Affiche les produits
            afficherProduit($produit);

        }
    }

}
else{
    echo "<p>Vous n'avez pas fait de recherche</p>";
}




function afficherProduit($produit) : void {
    $type = ProduitRepository::getTypeProduit($produit->getIdProduit());
    $produit = ProduitRepository::getProduitByID($produit->getIdProduit());

    if ($type == "Platine"){
        echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produit->getIdProduit() . '"><div class="ProduitListe">';
        $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
        echo '<div>' . $produit->getMarquePlatine() . '</div>';
        echo '<div>' . $produit->getNomProduit() . '</div>';
        echo '<div>' . $produit->getPrixProduit() . ' €</div>';
        echo '</div></a>';
    } else if ($type == "Vinyle"){
        echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produit->getIdProduit() . '"><div class="VinyleAccueil">';
        $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
        echo '<div>' . $produit->getNomProduit() . '</div>';
        echo '<div>' . $produit->getArtistVinyle() . '</div>';
        echo '<div>' . $produit->getPrixProduit() . ' €</div>';
        echo '</div></a>';
    } else if ($type == "Enceinte"){
        echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produit->getIdProduit() . '"><div class="ProduitListe">';
        $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
        echo '<div>' . $produit->getMarqueEnceinte() . '</div>';
        echo '<div>' . $produit->getNomProduit() . '</div>';
        echo '<div>' . $produit->getPrixProduit() . ' €</div>';
        echo '</div></a>';
    } else if ($type == "Ampli"){
        echo '<a class="noStyleLink" href="frontController.php?controller=produit&action=affichePageProduitID&id=' . $produit->getIdProduit() . '"><div class="ProduitListe">';
        $idImageProduit = ProduitRepository::getIdImageProduit($produit->getIdProduit());
        $bin = ProduitRepository::afficheImageProduit($idImageProduit);
        echo '<img src="data:image/jpeg;base64,' . base64_encode($bin) . '"/>';
        echo '<div>' . $produit->getMarqueAmplis() . '</div>';
        echo '<div>' . $produit->getNomProduit() . '</div>';
        echo '<div>' . $produit->getPrixProduit() . ' €</div>';
        echo '</div></a>';
    }
}
?>

</div>

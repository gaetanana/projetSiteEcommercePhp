<?php

namespace App\eCommerce\Controller;

use App\eCommerce\Model\Repository\ProduitRepository;

//use App\eCommerce\Model\Repository\ProduitRepository;


class ControllerProduit
{


    //Affiche la page d'acceuil avec des produits
    public static function affichePageAcceuil(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Vinyl Avenue",
            "cheminVueBody" => "produit/pageAcceuilSite.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    public static function affichePageResultatRecherche(): void
    {
        $typeDeRecherche = "";
        $requete = $_POST['requete'];
        $boolCherchePlatine = ProduitRepository::chercehPlatineBool($requete);
        $boolChercheEnceinte = ProduitRepository::chercehEnceinteBool($requete);
        $boolChercheVinyle = ProduitRepository::chercehVinyleBool($requete);
        $boolChercheAmplis = ProduitRepository::chercehAmplisBool($requete);
        //-------------------------------------------------------------------------------
        $boolChercheParNomProduit = ProduitRepository::chercehProduitParNomBool($requete);
        $boolChercheParMarqueProduit = ProduitRepository::chercehProduitParMarqueBool($requete);
        $boolChercheParArtisteProduit = ProduitRepository::chercehArtisteBool($requete);
        $boolChercheParGenreProduit = ProduitRepository::chercehGenreBool($requete);

        if($boolCherchePlatine){
            $typeDeRecherche = "platine";
        }
        else if($boolChercheEnceinte){
            $typeDeRecherche = "enceinte";
        }
        else if($boolChercheVinyle){
            $typeDeRecherche = "vinyle";
        }
        else if($boolChercheAmplis){
            $typeDeRecherche = "amplis";
        }
        else if($boolChercheParMarqueProduit){
            $typeDeRecherche = "marque";
        }
        else if($boolChercheParNomProduit){
            $typeDeRecherche = "nomProduit";
        }
        else if($boolChercheParArtisteProduit){
            $typeDeRecherche = "artiste";
        }
        else if($boolChercheParGenreProduit){
            $typeDeRecherche = "genre";
        }
        else{
            $typeDeRecherche = "rien";
        }







        self::afficheVue('view.php', ["pagetitle" => "Résultat de la Recherche",
            "cheminVueBody" => "produit/pageResultatRecherche.php"
            , "cheminVueNav" => "connexion/navigation.php", "typeDeRecherche" => $typeDeRecherche
            , "requeteUtilisateur" => $requete]);

    }

    //Action qui affiche tous les produits du site
    public static function affichePageProduit(): void
    {
        $produit = ProduitRepository::getProduitByID();
        self::afficheVue('view.php', ["pagetitle" => "Vinyl Avenue",
            "cheminVueBody" => "produit/pageProduit.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui affiche les Amplis
    public static function affichePageAmplis(): void
    {
        $listeProduits = ProduitRepository::getProduitsAmplis();
        self::afficheVue('view.php', ["pagetitle" => "Amplis",
            "cheminVueBody" => "produit/affichageProduit/pageAmplis.php", "cheminVueNav" => "connexion/navigation.php", "listeProduitsAmplis" => $listeProduits]);
    }

    //Action qui affiche les Enceintes
    public static function affichePageEnceintes(): void
    {
        $listeProduits = ProduitRepository::getProduitsEnceintes();
        self::afficheVue('view.php', ["pagetitle" => "Enceintes",
            "cheminVueBody" => "produit/affichageProduit/pageEnceinte.php", "cheminVueNav" => "connexion/navigation.php", "listeProduitsEnceintes" => $listeProduits]);
    }

    //Action qui affiche les Platines
    public static function affichePagePlatines(): void
    {
        $listeProduits = ProduitRepository::getProduitsPlatines();
        self::afficheVue('view.php', ["pagetitle" => "Platines",
            "cheminVueBody" => "produit/affichageProduit/pagePlatine.php", "cheminVueNav" => "connexion/navigation.php", "listeProduitsPlatines" => $listeProduits]);
    }

    //Action qui affiche les Vinyles
    public static function affichePageVinyles(): void
    {
        $listeProduits = ProduitRepository::getProduitsVinyles();
        self::afficheVue('view.php', ["pagetitle" => "Vinyles",
            "cheminVueBody" => "produit/affichageProduit/pageVinyle.php", "cheminVueNav" => "connexion/navigation.php", "listeProduitsVinyles" => $listeProduits]);
    }

    //Action qui affiche la page d'un produit
    public static function affichePageProduitID(): void
    {
        $id = $_GET['id'];
        $produit = ProduitRepository::getProduitByID($id);
        self::afficheVue('view.php', ["pagetitle" => $produit->getNomProduit(),
            "cheminVueBody" => "produit/affichageProduit/pageProduit.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    public static function error(string $errorMessage = "")
    {
        self::afficheVue("/produit/error.php", ["messageErreur" => $errorMessage]);
    }

    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../View/$cheminVue"; // Charge la vue
    }


}

?>
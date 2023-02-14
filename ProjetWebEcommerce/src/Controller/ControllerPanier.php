<?php

namespace App\eCommerce\Controller;

use App\eCommerce\Model\Repository\PanierRepository;
use App\eCommerce\Model\Repository\ProduitRepository;

class ControllerPanier
{

    //Cette ligne on la remet pas dans le code
    //$remetStockBool = PanierRepository::remetStockProduit($idProduit, $quantiteProduit);

    //Ajouter cette ligne  quand la personne aura payé
    //$enleveStockProduitBool = PanierRepository::enleverProduitDuStock($idProduit, $quantiteProduit);

    //Action qui permet d'ajouter un produit dans le panier
    public static function ajoutDansPanier()
    {

        //On récupère l'id du produit et la quantité
        $idProduit = $_POST['idProduit'];
        $quantiteProduit = $_POST['quantiteProduit'];
        //On ajoute le produit dans le panier
        $ajoutPanierBool = PanierRepository::ajouterProduitDansPanier($idProduit, $quantiteProduit);
        if ($ajoutPanierBool) {
            //On redirige vers la page du type de produit
            $typeProduit = ProduitRepository::getTypeProduit($idProduit);
            if ($typeProduit == "Ampli")
                header('Location: frontController.php?controller=produit&action=affichePageAmplis');
            else if ($typeProduit == "Platine") {
                header('Location: frontController.php?controller=produit&action=affichePagePlatines');
            } else if ($typeProduit == "Enceinte") {
                header('Location: frontController.php?controller=produit&action=affichePageEnceintes');
            } else if ($typeProduit == "Vinyle") {
                header('Location: frontController.php?controller=produit&action=affichePageVinyles');
            }
        }

    }


    //Action qui permet de supprimer un produit du panier
    public static function supprimerProduit()
    {

        //On récupère l'id du produit
        $idProduit = $_POST['idProduit'];
        $quantiteProduit = $_POST['quantiteProduit'];

        $SupprimeProduitPanierBool = PanierRepository::supprimerProduitDuPanier($idProduit, $quantiteProduit);

        if ($SupprimeProduitPanierBool) {
            header('Location: frontController.php?controller=panier&action=affichePanier');

            self::afficheVue('view.php', ["pagetitle" => "Panier",
                "cheminVueBody" => "panier/pagePanier.php"
                , "cheminVueNav" => "connexion/navigation.php"]);


        }
    }


    //Action qui permet de vider le panier
    public static function videPanier()
    {
        $boolPanierVide = PanierRepository::videPanierUtilisateur();

        if ($boolPanierVide) {
            header('Location: frontController.php?controller=panier&action=affichePanier');

            self::afficheVue('view.php', ["pagetitle" => "Panier",
                "cheminVueBody" => "panier/pagePanier.php"
                , "cheminVueNav" => "connexion/navigation.php"]);
        } else {
            header('Location: frontController.php?controller=panier&action=affichePanier');

            self::afficheVue('view.php', ["pagetitle" => "Panier",
                "cheminVueBody" => "panier/pagePanier.php"
                , "cheminVueNav" => "connexion/navigation.php"]);
        }

    }

    //Action qui permet de payer
    public static function payer()
    {
        //Je récupère le choix du moyen de paiement
        $panier = PanierRepository::getPanierUtilisateur();

        $choixPaiement = $_POST['moyenPaiement'];


        if ($choixPaiement == "carteBancaire") {
            self::afficheVue('view.php', ["pagetitle" => "Paiement CB",
                "cheminVueBody" => "panier/pageFormCarteBancaire.php"
                , "cheminVueNav" => "connexion/navigation.php", "panier" => $panier]);

        } else if ($choixPaiement == "soldeCompte") {
            $boolSoldeCompte = PanierRepository::soldeSuffisant();

            if ($boolSoldeCompte) {
                $montantPanier = PanierRepository::getTotalPanier();

                /**********************Je récupère les informations du panier avant qu'il soit supprimé*************************/
                $informationCommande = "";
                $panier = PanierRepository::getPanierUtilisateur();
                foreach ($panier as $produitPanier) {
                    $idProduit = $produitPanier['idProduit'];
                    $quantiteProduit = $produitPanier['quantiteProduit'];
                    $prixProduit = ProduitRepository::getPrixProduit($idProduit);
                    $informationCommande .= $idProduit . ":" . $prixProduit . ":" . $quantiteProduit . ";";


                }
                /*****************************************************/


                $boolPaiementSolde = PanierRepository::payeAvecSoldeCompte($montantPanier, $panier);


                if ($boolPaiementSolde) {

                    header('Location: frontController.php?controller=panier&action=affichePanier');
                    PanierRepository::insertCommande($_SESSION['id'], date('Y-m-d H:i:s'), $informationCommande);
                    self::afficheVue('view.php', ["pagetitle" => "Panier",
                        "cheminVueBody" => "panier/pagePanier.php"
                        , "cheminVueNav" => "connexion/navigation.php", "messagePaiement" => "Le paiement a bien été effectué"]);


                } else {
                    self::afficheVue('view.php', ["pagetitle" => "Panier",
                        "cheminVueBody" => "panier/pagePanier.php"
                        , "cheminVueNav" => "connexion/navigation.php", "messagePaiement" => "Le paiement n'a pas été effectué"]);

                }
            } else {
                //Le solde est insufisant
                $message = "Le solde de votre compte est insufisant";
                self::afficheVue('view.php', ["pagetitle" => "Panier",
                    "cheminVueBody" => "panier/pagePaiement.php"
                    , "cheminVueNav" => "connexion/navigation.php", "messagePaiement" => $message]);
            }
        }
    }

    public static function payeEnCB()
    {
        $panier = PanierRepository::getPanierUtilisateur();
        /**********************Je récupère les informations du panier avant qu'il soit supprimé*************************/
        $informationCommande = "";
        $panier = PanierRepository::getPanierUtilisateur();
        foreach ($panier as $produitPanier) {
            $idProduit = $produitPanier['idProduit'];
            $quantiteProduit = $produitPanier['quantiteProduit'];
            $prixProduit = ProduitRepository::getPrixProduit($idProduit);
            $informationCommande .= $idProduit . ":" . $prixProduit . ":" . $quantiteProduit . ";";


        }
        /*****************************************************/

        $boolPaiement = PanierRepository::payerEnCB($panier);


        if ($boolPaiement) {
            header('Location: frontController.php?controller=panier&action=affichePanier');
            PanierRepository::insertCommande($_SESSION['id'], date('Y-m-d H:i:s'), $informationCommande);
            self::afficheVue('view.php', ["pagetitle" => "Panier",
                "cheminVueBody" => "panier/pagePanier.php"
                , "cheminVueNav" => "connexion/navigation.php", "messagePaiement" => "Le paiement a bien été effectué"]);



        } else {
            self::afficheVue('view.php', ["pagetitle" => "Panier",
                "cheminVueBody" => "panier/pagePanier.php"
                , "cheminVueNav" => "connexion/navigation.php", "messagePaiement" => "Le paiement n'a pas été effectué"]);
        }

    }


    /******************Action qui me sevent d'outils ******************/

//Action qui permet de savoir si le panier est vide ou pas
    public
    static function estVide()
    {
        $bool = PanierRepository::panierEstVide();
        if ($bool) {
            echo "<script>alert('Le panier est vide')</script>";
        } else {
            echo "<script>alert('Le panier nest pas vide')</script>";
        }
    }


    /******************Affichage des vues******************/

//Action qui permet d'afficher le panier de l'utilisateur ou de l'invité (si il n'est pas connecté)
    public
    static function affichePanier()
    {
        $panier = PanierRepository::getPanierUtilisateur();
        //var_dump($panier);

        self::afficheVue('view.php', ["pagetitle" => "Panier",
            "cheminVueBody" => "panier/pagePanier.php", "cheminVueNav" => "connexion/navigation.php"]);



    }

//Action qui permet d'afficher la vue de la page de paiement
    public
    static function affichePagePaiement()
    {



        //Si la personne n'est pas connecté on la renvoie vers la page de connexion
        if (isset($_SESSION['login'])) {
            self::afficheVue('view.php', ["pagetitle" => "Paiement",
                "cheminVueBody" => "panier/pagePaiement.php", "cheminVueNav" => "connexion/navigation.php"]);
        } else {
            $message = "Vous devez être connecté pour accéder à cette page";
            self::afficheVue('view.php', ["pagetitle" => "Connexion",
                "cheminVueBody" => "connexion/formulaires/pageConnexion.php"
                , "cheminVueNav" => "connexion/navigation.php"
                , "messageDoitEtreConnecte" => $message]);
        }


    }

    private
    static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../View/$cheminVue"; // Charge la vue
    }

}

?>
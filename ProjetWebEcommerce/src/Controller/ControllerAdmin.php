<?php

namespace App\eCommerce\Controller;

use App\eCommerce\Model\DataObject\produit\Amplis;
use App\eCommerce\Model\DataObject\produit\Enceinte;
use App\eCommerce\Model\DataObject\produit\Platine;
use App\eCommerce\Model\DataObject\produit\Vinyle;
use App\eCommerce\Model\Repository\DataBaseConnection;
use App\eCommerce\Model\Repository\ProduitRepository;
use App\eCommerce\Model\Repository\UtilisateurRepository;

class ControllerAdmin
{


    public static function supprimeUnUtilisateur(): void
    {
        $id = $_GET['id'];
        UtilisateurRepository::supprimerUtilisateur($id);
        self::afficheListeUtilisateur();
    }

    public static function modifieUnUtilisateur(): void
    {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $solde = $_POST['solde'];


        $bool = UtilisateurRepository::modifierUtilisateur($id, $login, $nom, $prenom, $email, $adresse, $solde);
        if ($bool) {
            $message = "Utilisateur : " . $login . " modifié";
            //Affiche la vue de la liste des utilisateurs avec le message
            self::afficheVue('view.php', ["pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "admin/listeUtilisateurs.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);

        } else {
            $message = "Erreur de mofification avec l'utilisateur : " . $login;
            self::afficheVue('view.php', ["pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "admin/listeUtilisateurs.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);

        }

    }

    public static function afficheFormModifUtilisateur(): void
    {
        if ($_SESSION['status'] != "fondateur" && $_SESSION['status'] != "admin") {
            header('Location: frontController.php?controller=produit&action=affichePageAcceuil');
        }else{
            $id = $_GET['id'];
            self::afficheVue('view.php', ["pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "admin/formulaires/formModifieUtilisateur.php", "cheminVueNav" => "connexion/navigation.php", "id" => $id]);

        }

    }


    public static function afficheListeUtilisateur(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "admin/listeUtilisateurs.php", "cheminVueNav" => "connexion/navigation.php"]);
    }



    /*------------------------------------------------------------------------------------------------------------*/
    //Partie Produit


    //ajouteProduitPlatine
    //ajouteProduitEnceinte
    //ajouteProduitVinyle
    //ajouteProduitAmpli

    public static function ajouteProduitPlatine(): void
    {

        $idProduit = DataBaseConnection::getPdo()->lastInsertId();
        $nomProduit = $_POST['nomProduit'];
        $descriptionProduit = $_POST['descriptionProduit'];
        $prixProduit = $_POST['prixProduit'];
        $stockProduit = $_POST['stockProduit'];

        $formatVinyl = $_POST['formatVinyl'];
        $bluetoothPlatine = $_POST['bluetoothPlatine'];
        $marquePlatine = $_POST['marquePlatine'];


        $platine = new Platine($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $formatVinyl, $bluetoothPlatine, $marquePlatine);

        ProduitRepository::ajouterProduit($platine);
        ProduitRepository::ajoutProduitPlatine($platine);

        self::afficheListeProduit();
    }

    public static function ajouteProduitEnceinte(): void
    {
        $idProduit = DataBaseConnection::getPdo()->lastInsertId();
        $nomProduit = $_POST['nomProduit'];
        $descriptionProduit = $_POST['descriptionProduit'];
        $prixProduit = $_POST['prixProduit'];
        $stockProduit = $_POST['stockProduit'];

        $sensibiliteEnceinte = $_POST['sensibiliteEnceinte'];
        $puissanceEnceinte = $_POST['puissanceEnceinte'];
        $marqueEnceinte = $_POST['marqueEnceinte'];


        $enceinte = new Enceinte($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $sensibiliteEnceinte, $puissanceEnceinte, $marqueEnceinte);

        ProduitRepository::ajouterProduit($enceinte);
        ProduitRepository::ajoutProduitEnceinte($enceinte);

        self::afficheListeProduit();
    }

    public static function ajouteProduitVinyle(): void
    {

        $idProduit = DataBaseConnection::getPdo()->lastInsertId();
        $nomProduit = $_POST['nomProduit'];
        $descriptionProduit = $_POST['descriptionProduit'];
        $prixProduit = $_POST['prixProduit'];
        $stockProduit = $_POST['stockProduit'];

        $tailleVinyle = $_POST['tailleVinyle'];
        $artisteVinyle = $_POST['artisteVinyle'];
        $genreVinyle = $_POST['genreVinyle'];


        $vinyle = new Vinyle($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $tailleVinyle, $artisteVinyle,$genreVinyle);

        ProduitRepository::ajouterProduit($vinyle);
        ProduitRepository::ajoutProduitVinyle($vinyle);

        self::afficheListeProduit();
    }

    public static function ajouteProduitAmpli(): void
    {
        $idProduit = DataBaseConnection::getPdo()->lastInsertId();
        $nomProduit = $_POST['nomProduit'];
        $descriptionProduit = $_POST['descriptionProduit'];
        $prixProduit = $_POST['prixProduit'];
        $stockProduit = $_POST['stockProduit'];

        $puissanceAmpli = $_POST['puissanceAmplis'];
        $sensibiliteAmpli = $_POST['sensibiliteAmplis'];
        $marqueAmpli = $_POST['marqueAmplis'];


        $ampli = new Amplis($idProduit, $nomProduit, $descriptionProduit, $prixProduit
            , $stockProduit, $puissanceAmpli, $sensibiliteAmpli, $marqueAmpli);


        ProduitRepository::ajouterProduit($ampli);
        ProduitRepository::ajoutProduitAmplis($ampli);

        self::afficheListeProduit();

    }

    //Action qui permet de supprimer un produit avec son id
    public static function supprimeProduit(): void
    {
        $id = $_GET['id'];
        $bool = ProduitRepository::supprimeProduitByID($id);
        if ($bool) {
            $message = "Suppression du produit avec l'id : " . $id . " effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageSupp" => $message]);
        } else {
            $message = "Suppression du produit avec l'id : " . $id . " non effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageSupp" => $message]);
        }
    }

    //Action qui permet d'afficher le formulaire de modification
    public static function modifieProduitSelonType()
    {
        $idProduit = $_GET['id'];
        $typeProduit = ProduitRepository::getTypeProduit($idProduit);

        if ($typeProduit == "Ampli") {
            //Affiche la vue de modification d'un ampli
            $typeProduit = "Ampli";
            self::afficheVue('view.php', ["pagetitle" => "Modification d'un ampli",
                "cheminVueBody" => "admin/formulaires/formAjoutEtModifProduit.php"
                , "cheminVueNav" => "connexion/navigation.php", "idProduit" => $idProduit,"typeProduit" => $typeProduit]);
        }

        else if ($typeProduit == "Enceinte") {
            //Affiche la vue de modification d'une enceinte
            self::afficheVue('view.php', ["pagetitle" => "Modification d'un ampli",
                "cheminVueBody" => "admin/formulaires/formAjoutEtModifProduit.php"
                , "cheminVueNav" => "connexion/navigation.php", "idProduit" => $idProduit,"typeProduit" => $typeProduit]);
        }

        else if ($typeProduit == "Platine") {
            //Affiche la vue de modification d'une platine
            self::afficheVue('view.php', ["pagetitle" => "Modification d'un ampli",
                "cheminVueBody" => "admin/formulaires/formAjoutEtModifProduit.php"
                , "cheminVueNav" => "connexion/navigation.php", "idProduit" => $idProduit,"typeProduit" => $typeProduit]);
        }

        else if ($typeProduit == "Vinyle") {
            //Affiche la vue de modification d'un vinyle
            self::afficheVue('view.php', ["pagetitle" => "Modification d'un ampli",
                "cheminVueBody" => "admin/formulaires/formAjoutEtModifProduit.php"
                , "cheminVueNav" => "connexion/navigation.php", "idProduit" => $idProduit,"typeProduit" => $typeProduit]);
        }

    }

    //Action qui permet de modifier un amplis
    public static function modifieAmplis()
    {
        //J'update l'image

        $idProduit = $_POST['idProduit'];
        $idImage = ProduitRepository::getIdImageProduit($idProduit);

        if (isset($_FILES['imageAmplis']['name']) && $_FILES['imageAmplis']['name'] != "") {

            $requeteImage = "UPDATE imagessite SET 
                 nom = :nomImage
               , taille = :tailleImage
               , typeImage = :typeImage
               ,bin = :binImage
             
             
             WHERE id = :idImage";

            $pdoStatement = DataBaseConnection::getPdo()->prepare($requeteImage);
            $pdoStatement->execute(array(
                ":nomImage" => $_FILES['imageAmplis']['name'],
                ":tailleImage" => $_FILES['imageAmplis']['size'],
                ":typeImage" => $_FILES['imageAmplis']['type'],
                ":binImage" => file_get_contents($_FILES['imageAmplis']['tmp_name']),
                ":idImage" => $idImage
            ));


        }

        $nomAmplis = $_POST['nomAmplis'];
        $descriptionAmplis = $_POST['descriptionAmplis'];
        $prixAmplis = $_POST['prixAmplis'];


        $stockAmplis = $_POST['stockAmplis'];
        $puissanceAmplis = $_POST['puissanceAmplis'];
        $sensibiliteAmplis = $_POST['sensibiliteAmplis'];
        $marqueAmplis = $_POST['marqueAmplis'];

        $bool = ProduitRepository::modifieUneAmpli($idProduit, $nomAmplis, $descriptionAmplis, $prixAmplis, $stockAmplis, $puissanceAmplis, $sensibiliteAmplis, $marqueAmplis);

        if ($bool) {

            $message = "Modification de l'ampli avec l'id : " . $idProduit . " effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        } else {
            $message = "Modification de l'ampli avec l'id : " . $idProduit . " non effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        }

    }

    //Action qui permet de modifier une enceinte
    public static function modifieEnceinte()
    {
        //J'update l'image

        $idProduit = $_POST['idProduit'];
        $idImage = ProduitRepository::getIdImageProduit($idProduit);

        if (isset($_FILES['imageEnceinte']['name']) && $_FILES['imageEnceinte']['name'] != "") {

            $requeteImage = "UPDATE imagessite SET 
                 nom = :nomImage
               , taille = :tailleImage
               , typeImage = :typeImage
               ,bin = :binImage
             
             
             WHERE id = :idImage";

            $pdoStatement = DataBaseConnection::getPdo()->prepare($requeteImage);
            $pdoStatement->execute(array(
                ":nomImage" => $_FILES['imageEnceinte']['name'],
                ":tailleImage" => $_FILES['imageEnceinte']['size'],
                ":typeImage" => $_FILES['imageEnceinte']['type'],
                ":binImage" => file_get_contents($_FILES['imageEnceinte']['tmp_name']),
                ":idImage" => $idImage
            ));
        }


        $nomEnceinte = $_POST['nomEnceinte'];
        $descriptionEnceinte = $_POST['descriptionEnceinte'];
        $prixEnceinte = $_POST['prixEnceinte'];
        $stockEnceinte = $_POST['stockEnceinte'];
        $puissanceEnceinte = $_POST['puissanceEnceinte'];
        $sensibiliteEnceinte = $_POST['sensibiliteEnceinte'];
        $marqueEnceinte = $_POST['marqueEnceinte'];

        $bool = ProduitRepository::modifieUneEnceinte($idProduit, $nomEnceinte, $descriptionEnceinte, $prixEnceinte, $stockEnceinte, $puissanceEnceinte, $sensibiliteEnceinte, $marqueEnceinte);

        if ($bool) {

            $message = "Modification de l'enceinte avec l'id : " . $idProduit . " effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        } else {
            $message = "Modification de l'enceinte avec l'id : " . $idProduit . " non effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        }


    }

    //Action qui permet de modifier une platine
    public static function modifiePlatine(){
        //J'update l'image

        $idProduit = $_POST['idProduit'];
        $idImage = ProduitRepository::getIdImageProduit($idProduit);

        if (isset($_FILES['imagePlatine']['name']) && $_FILES['imagePlatine']['name'] != "") {

            $requeteImage = "UPDATE imagessite SET 
                 nom = :nomImage
               , taille = :tailleImage
               , typeImage = :typeImage
               ,bin = :binImage
             
             
             WHERE id = :idImage";

            $pdoStatement = DataBaseConnection::getPdo()->prepare($requeteImage);
            $pdoStatement->execute(array(
                ":nomImage" => $_FILES['imagePlatine']['name'],
                ":tailleImage" => $_FILES['imagePlatine']['size'],
                ":typeImage" => $_FILES['imagePlatine']['type'],
                ":binImage" => file_get_contents($_FILES['imagePlatine']['tmp_name']),
                ":idImage" => $idImage
            ));
        }
        $nomPlatine = $_POST['nomPlatine'];
        $descriptionPlatine = $_POST['descriptionPlatine'];
        $prixPlatine = $_POST['prixPlatine'];
        $stockPlatine = $_POST['stockPlatine'];
        $formatVinyle = $_POST['formatVinyle'];
        $bluetooth = $_POST['bluetoothPlatine'];
        $marquePlatine = $_POST['marquePlatine'];


        $bool = ProduitRepository::modifieUnePlatine($idProduit, $nomPlatine, $descriptionPlatine, $prixPlatine, $stockPlatine, $formatVinyle, $bluetooth, $marquePlatine);

        if ($bool) {

            $message = "Modification de la platine avec l'id : " . $idProduit . " effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        } else {
            $message = "Modification de la platine avec l'id : " . $idProduit . " non effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        }

    }

    //Action qui permet de modifier un vinyle
    public static function modifieVinyle(){
        //J'update l'image

        $idProduit = $_POST['idProduit'];
        $idImage = ProduitRepository::getIdImageProduit($idProduit);

        if (isset($_FILES['imageVinyle']['name']) && $_FILES['imageVinyle']['name'] != "") {

            $requeteImage = "UPDATE imagessite SET 
                 nom = :nomImage
               , taille = :tailleImage
               , typeImage = :typeImage
               ,bin = :binImage
             
             
             WHERE id = :idImage";

            $pdoStatement = DataBaseConnection::getPdo()->prepare($requeteImage);
            $pdoStatement->execute(array(
                ":nomImage" => $_FILES['imageVinyle']['name'],
                ":tailleImage" => $_FILES['imageVinyle']['size'],
                ":typeImage" => $_FILES['imageVinyle']['type'],
                ":binImage" => file_get_contents($_FILES['imageVinyle']['tmp_name']),
                ":idImage" => $idImage
            ));

        }
        $nomVinyle = $_POST['nomVinyle'];
        $descriptionVinyle = $_POST['descriptionVinyle'];
        $prixVinyle = $_POST['prixVinyle'];
        $stockVinyle = $_POST['stockVinyle'];


        $tailleVinyle = $_POST['tailleVinyle'];
        $artisteVinyle = $_POST['artisteVinyle'];
        $genreVinyle = $_POST['genreVinyle'];

        $bool = ProduitRepository::modifieUnVinyle($idProduit, $nomVinyle, $descriptionVinyle, $prixVinyle, $stockVinyle, $tailleVinyle, $artisteVinyle, $genreVinyle);

        if ($bool) {

            $message = "Modification du vinyle avec l'id : " . $idProduit . " effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        } else {
            $message = "Modification du vinyle avec l'id : " . $idProduit . " non effectué";
            self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
                "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php", "messageModif" => $message]);
        }


    }

    public static function afficheListeProduit(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Liste des produits",
            "cheminVueBody" => "admin/listeProduit.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    public static function afficheFormulaireAjoutProduit(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Ajouter un produit",
            "cheminVueBody" => "admin/formulaires/formAjoutEtModifProduit.php", "cheminVueNav" => "connexion/navigation.php","ajoutProduit"=>true]);
    }

    public static function afficheListeCommandes(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Liste des commandes",
            "cheminVueBody" => "admin/listeCommandes.php", "cheminVueNav" => "connexion/navigation.php"]);
    }


    private static function afficheVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require __DIR__ . "/../View/$cheminVue"; // Charge la vue
    }



}

?>
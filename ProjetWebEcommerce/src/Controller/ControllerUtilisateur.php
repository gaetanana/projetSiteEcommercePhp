<?php

namespace App\eCommerce\Controller;

use App\eCommerce\Model\DataObject\MotDePasse;
use App\eCommerce\Model\DataObject\Utilisateur;
use App\eCommerce\Model\Repository\DataBaseConnection;
use App\eCommerce\Model\Repository\UtilisateurRepository;

class ControllerUtilisateur
{


    //Action d'inscription
    public static function inscription(): void
    {
        $postLogin = $_POST['login'];
        $postPassword = $_POST['password'];
        $postPasswordVerif = $_POST['passwordVerif'];
        $postNom = $_POST['nom'];
        $postPrenom = $_POST['prenom'];
        $postEmail = $_POST['adresseMail'];
        $postAdresse = $_POST['adresseClient'];

        $loginHtml = htmlspecialchars($postLogin);
        $passwordHtmlClair = htmlspecialchars($postPassword);
        $passwordVerifHtmlClair = htmlspecialchars($postPasswordVerif);
        $mdpChiffre = MotDePasse::hacher($passwordHtmlClair);
        $mdp2chiffre = MotDePasse::hacher($passwordVerifHtmlClair);
        $nomHtml = htmlspecialchars($postNom);
        $prenomHtml = htmlspecialchars($postPrenom);
        $emailHtml = htmlspecialchars($postEmail);
        $adresseHtml = htmlspecialchars($postAdresse);

        //$passwordHtml == $passwordVerifHtml

        if (MotDePasse::verifier($passwordHtmlClair, $mdpChiffre) &&
            MotDePasse::verifier($passwordVerifHtmlClair, $mdpChiffre) &&

            MotDePasse::verifier($passwordHtmlClair, $mdp2chiffre) &&
            MotDePasse::verifier($passwordVerifHtmlClair, $mdp2chiffre)
        ) {

            //Tout est ok j'ajoute l'utilisateur dans la base de donnée
            $id = DataBaseConnection::getPdo()->lastInsertId();
            $utilisateur = new Utilisateur($id, $loginHtml, $mdpChiffre, $nomHtml, $prenomHtml, $emailHtml, $adresseHtml);
            $estSauvegarder = UtilisateurRepository::sauvegarder($utilisateur);

            if ($estSauvegarder) {
                //L'utilisateur est bien enregistré
                UtilisateurRepository::envoieDuMailConfirmationCompte($postLogin, $postEmail);
                echo "<script>alert('Votre compte a bien été créé, un mail de confirmation vous a été envoyé')</script>";
                self::affichePageConnexion();

            } else {
                //Affiche pas d'inscription mais en gardant des champs remplis
                self::affichePageInscription();
            }


        } else {
            //Les mots de passe ne correspondent pas
            //echo "<script>alert(\"Les mots de passe ne correspondent pas\")</script>";
            self::affichePageInscription();
        }

    }

    //Action qui permet de se connecter
    public static function connexion(): void
    {

        $postLogin = $_POST['login']; //C'est grâce à name = "login" dans le formulaire que je récupère la valeur
        $postPassword = $_POST['password'];

        $retourConnexion = UtilisateurRepository::verficationConnexion($postLogin, $postPassword);

        self::afficheVue('view.php', ["pagetitle" => "SiteDeCarte",
            "cheminVueBody" => "produit/pageAcceuilSite.php", "cheminVueNav" => "connexion/navigation.php", "retourConnexion" => $retourConnexion]);
    }

    //Action qui permet de changer de mot de passe
    public static function changeMotDePasse(): void
    {
        $login = $_SESSION['login'];

        $postAncienMdp = $_POST['ancienPassword'];
        $postNouveauMdp = $_POST['nouveauMotDePasse'];
        $postNouveauMdpVerif = $_POST['verifNouveauMotDePasse'];

        $ancienMdpHtmlClair = htmlspecialchars($postAncienMdp);
        $nouveauMdpHtmlClair = htmlspecialchars($postNouveauMdp);
        $nouveauMdpVerifHtmlClair = htmlspecialchars($postNouveauMdpVerif);

        $ancienMdpChiffre = MotDePasse::hacher($ancienMdpHtmlClair);
        $nouveauMdpChiffre = MotDePasse::hacher($nouveauMdpHtmlClair);
        $nouveauMdpVerifChiffre = MotDePasse::hacher($nouveauMdpVerifHtmlClair);

        if (
            MotDePasse::verifier($ancienMdpHtmlClair, $ancienMdpChiffre) &&

            MotDePasse::verifier($nouveauMdpHtmlClair, $nouveauMdpChiffre) &&
            MotDePasse::verifier($nouveauMdpHtmlClair, $nouveauMdpVerifChiffre) &&

            MotDePasse::verifier($nouveauMdpVerifHtmlClair, $nouveauMdpVerifChiffre) &&
            MotDePasse::verifier($nouveauMdpVerifHtmlClair, $nouveauMdpChiffre)


        ) {
            //Les mots de passe correspondent
            $retourChangementMDP = UtilisateurRepository::changementMotDePasse($login, $nouveauMdpChiffre);
            self::afficheVue("view.php", ["pagetitle" => "mon compte", "cheminVueBody" => "connexion/monCompte.php", "cheminVueNav" => "connexion/navigation.php", "retourChangementMDP" => $retourChangementMDP]);

        } else {
            //Les mots de passe ne correspondent pas
            self::afficheVue("view.php", ["pagetitle" => "mon compte", "cheminVueBody" => "connexion/monCompte.php", "cheminVueNav" => "connexion/navigation.php", "retourChangementMDP" => "Les mots de passe ne correspondent pas"]);

        }
    }

    //Action qui envoie un mail de réinitialisation de mot de passe
    public static function envoiMailRenitialisationMDP(): void
    {
        $mail = $_POST['mailRecuperation'];
        //Permet de vérifier si l'utilisateur existe
        $utilisateur = UtilisateurRepository::getUtilisateurByAdresseMail($mail);

        if ($utilisateur != null) {

            //Ici je vais utiliser une une fonction de UtilisateurRepository qui va envoyer un mail de réinitialisation de mot de passe
            $boolMailEnvoye = UtilisateurRepository::envoieDuMailReinitialisationMdp($mail);
            if ($boolMailEnvoye) {
                $message = "Le mail a été envoyé";
                self::afficheVue('view.php', ["pagetitle" => "Réinitialisation de mot de passe",
                    "cheminVueBody" => "connexion/formulaires/pageEnvoieMailRenitialisationMDP.php", "cheminVueNav" => "connexion/navigation.php", "message" => $message]);
            } else {
                $message = "Le mail ne s'est pas envoyé";
                self::afficheVue('view.php', ["pagetitle" => "Réinitialisation de mot de passe",
                    "cheminVueBody" => "connexion/formulaires/pageEnvoieMailRenitialisationMDP.php", "cheminVueNav" => "connexion/navigation.php", "message" => $message]);
            }

        } else {
            $message = "L'adresse mail n'existe pas";
            self::afficheVue('view.php', ["pagetitle" => "Réinitialisation de mot de passe",
                "cheminVueBody" => "connexion/formulaires/pageEnvoieMailRenitialisationMDP.php", "cheminVueNav" => "connexion/navigation.php", "message" => $message]);
        }


    }

    //Action qui permet de réinitialiser son mot de passe
    public static function renitialiseMotDePasse(): void
    {

        $nouveauMDPClair = $_POST['nouveauMotDePasse'];
        $nouveauMDPVerifClair = $_POST['verifNouveauMotDePasse'];
        $login = $_POST['login'];

        $nouveauMDPChiffre = MotDePasse::hacher($nouveauMDPClair);
        $nouveauMDPVerifChiffre = MotDePasse::hacher($nouveauMDPVerifClair);

        if (
            MotDePasse::verifier($nouveauMDPClair, $nouveauMDPChiffre) &&
            MotDePasse::verifier($nouveauMDPVerifClair, $nouveauMDPVerifChiffre) &&
            MotDePasse::verifier($nouveauMDPVerifClair, $nouveauMDPChiffre)
        ) {
            //Les mots de passe correspondent
            $retourChangementMDPRenitialisation = UtilisateurRepository::changementMotDePasse($login, $nouveauMDPChiffre);
            self::afficheVue("view.php", ["pagetitle" => "mon compte", "cheminVueBody" => "connexion/formulaires/pageConnexion.php", "cheminVueNav" => "connexion/navigation.php", "retourChangementMDPRenitialisation" => $retourChangementMDPRenitialisation]);
        }


    }

    //Action qui permet de se déconnecter
    public static function deconnexion(): void
    {
        $_SESSION = array();
        session_destroy();
        self::afficheVue('view.php', ["pagetitle" => "SiteDeCarte",
            "cheminVueBody" => "produit/pageAcceuilSite.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet d'ajouter du solde au compte
    public static function ajouteSoldeCompte(){
        $montant = $_POST['montantSolde'];
        $idUtilisateur = $_SESSION['id'];

        $retourAjoutSolde = UtilisateurRepository::ajouterMontantAuSolde($idUtilisateur, $montant);

        if($retourAjoutSolde) {
            $message = "Le solde a été ajouté";
            self::afficheVue('view.php', ["pagetitle" => "Ajout de solde",
                "cheminVueBody" => "connexion/monCompte.php", "cheminVueNav" => "connexion/navigation.php", "messageAjoutSolde" => $message]);

        }
        else{
            $message = "Le solde n'a pas été ajouté";
            self::afficheVue('view.php', ["pagetitle" => "Ajout de solde",
                "cheminVueBody" => "connexion/monCompte.php", "cheminVueNav" => "connexion/navigation.php", "messageAjoutSolde" => $message]);
        }



    }

    //Action qui permet de consulter son compte
    public static function consulterMonCompte(): void
    {
        self::afficheVue("view.php", ["pagetitle" => "mon compte", "cheminVueBody" => "connexion/monCompte.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet d'afficher la page pour ajouter du solde
    public static function affichePageAjoutSolde(): void
    {
        self::afficheVue("view.php", ["pagetitle" => "Ajout de solde", "cheminVueBody" => "connexion/formulaires/pageAjoutSolde.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet d'afficher la page du panier
    public static function affichePanierUtilisateur(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Panier",
            "cheminVueBody" => "produit/pagePanier.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet d'afficher le formulaire de changement de mot de passe
    public static function affichePageChangementMDP(): void
    {


        self::afficheVue('view.php', ["pagetitle" => "Changement de mot de passe",
            "cheminVueBody" => "connexion/formulaires/pageChangementMDP.php", "cheminVueNav" => "connexion/navigation.php"]);
    }


    //Action qui permet d'afficher la page de réinitialisation de mot de passe
    public static function affichePageMailMDP(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Réinitialisation de mot de passe",
            "cheminVueBody" => "connexion/formulaires/pageEnvoieMailRenitialisationMDP.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet d'afficher la page de connexion
    public static function affichePageConnexion(): void
    {


        self::afficheVue('view.php', ["pagetitle" => "Connexion",
            "cheminVueBody" => "connexion/formulaires/pageConnexion.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui permet de rediriger vers la page de connexion avec un message
    public static function affichePageConnexionAvecMessage(): void
    {
        $message = $_GET['message'];
        self::afficheVue('view.php', ["pagetitle" => "Connexion",
            "cheminVueBody" => "connexion/formulaires/pageConnexion.php", "cheminVueNav" => "connexion/navigation.php", "message" => $message]);

    }


    //Action qui permet d'afficher la page d'inscription
    public static function affichePageInscription(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Inscription", "cheminVueBody" => "connexion/formulaires/pageInscription.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    //Action qui affiche la page de réinitialisation de mot de passe
    public static function affichePageReinitialisationMDP(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Réinitialisation de mot de passe",
            "cheminVueBody" => "connexion/formulaires/pageReinitialisationMDP.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    public static function affichePageListeCommandes(): void
    {
        self::afficheVue('view.php', ["pagetitle" => "Mes Commandes",
            "cheminVueBody" => "connexion/mesCommandes.php", "cheminVueNav" => "connexion/navigation.php"]);
    }

    public static function afficheCommande(): void
    {
        $idCommande = $_GET['id'];
        self::afficheVue('view.php', ["pagetitle" => "Commande n°" . $idCommande,
            "cheminVueBody" => "connexion/pageCommande.php", "cheminVueNav" => "connexion/navigation.php"]);
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
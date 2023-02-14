<?php

namespace App\eCommerce\Model\Repository;


use App\eCommerce\Model\DataObject\MotDePasse;
use App\eCommerce\Model\DataObject\Utilisateur;


class UtilisateurRepository
{


    //Fonction qui permet de récupérer tous les utilisateurs de la base de données
    public static function getUtilisateurs(): ?array
    {
        $listeUtilisateurs = [];
        $sql = "SELECT id,login,password,nom,prenom,adresseMail,adresseClient FROM utilisateur ORDER BY statusClient DESC";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute();
        foreach ($pdoStatement as $utilisateurFormatTableau) {
            $utilisateur = new Utilisateur($utilisateurFormatTableau['id'], $utilisateurFormatTableau['login'], $utilisateurFormatTableau['password'], $utilisateurFormatTableau['nom'], $utilisateurFormatTableau['prenom'], $utilisateurFormatTableau['adresseMail'], $utilisateurFormatTableau['adresseClient']);
            //echo $utilisateur->getLoginClient();
            $listeUtilisateurs[] = $utilisateur;
        }

        if ($listeUtilisateurs == null) {
            //echo "La liste des utilisateurs est vide";
            return null;
        } else {
            return $listeUtilisateurs;
        }

    }

    //Fonction qui permet de récupérer un utilisateur en fonction de son login
    public static function getUtilisateurByLogin(string $login): ?Utilisateur
    {
        $sql = "SELECT id,login,password,nom,prenom,adresseMail,adresseClient FROM utilisateur WHERE login = :login";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':login' => $login));
        $utilisateurFormatTableau = $pdoStatement->fetch();
        if ($utilisateurFormatTableau == null) {
            return null;
        } else {
            $utilisateur = new Utilisateur($utilisateurFormatTableau['id'], $utilisateurFormatTableau['login'], $utilisateurFormatTableau['password'], $utilisateurFormatTableau['nom'], $utilisateurFormatTableau['prenom'], $utilisateurFormatTableau['adresseMail'], $utilisateurFormatTableau['adresseClient']);
            return $utilisateur;
        }
    }


    //Fonction qui permet d'avoir un utilisateur à partir de son id
    public static function getUtilisateurById(int $idUtilisateur): ?Utilisateur
    {


        $sql = "SELECT * from utilisateur WHERE id=:idUtilisateurTag";
        // Préparation de la requête
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            "idUtilisateurTag" => $idUtilisateur,
        );

        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $utilisateur = $pdoStatement->fetch();

        if (!$utilisateur) {
            //echo "Il n'y a pas d'utilisateur avec cette id";
            return null;
        }

        return new Utilisateur($utilisateur['id'], $utilisateur['login'], $utilisateur['password'], $utilisateur['nom'], $utilisateur['prenom'], $utilisateur['adresseMail'], $utilisateur['adresseClient']);
    }

    //Fonction qui permet d'avoir un utilisateur à partir de son adresse mail
    public static function getUtilisateurByAdresseMail(string $adresseMail): ?Utilisateur
    {
        $sql = "SELECT * from utilisateur WHERE adresseMail=:adresseMailTag";
        // Préparation de la requête
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            "adresseMailTag" => $adresseMail,
        );

        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $utilisateur = $pdoStatement->fetch();

        if (!$utilisateur) {
            //echo "Il n'y a pas d'utilisateur avec cette adresse mail";
            return null;
        }

        return new Utilisateur($utilisateur['id'], $utilisateur['login'], $utilisateur['password'], $utilisateur['nom'], $utilisateur['prenom'], $utilisateur['adresseMail'], $utilisateur['adresseClient']);
    }

    public static function getIdByLogin($login): ?int
    {
        $sql = "SELECT id from utilisateur WHERE login=:loginTag";
        // Préparation de la requête
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            "loginTag" => $login,
        );

        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $utilisateur = $pdoStatement->fetch();

        if (!$utilisateur) {
            //echo "Il n'y a pas d'utilisateur avec cette id";
            return null;
        }

        return $utilisateur['id'];
    }

    //Fonction qui permet de sauvegarder un utilisateur dans la base de données
    public static function sauvegarder(Utilisateur $utilisateur): bool
    {
        $listeUtilisateur = UtilisateurRepository::getUtilisateurs();

        if ($listeUtilisateur != null) {
            foreach ($listeUtilisateur as $element) {
                if ($element->getAdresseMailClient() == $utilisateur->getAdresseMailClient()) {
                    //echo "L'utilisateur existe déjà";
                    //echo "<script> alert('L\'adresse email est déja utilisé')</script>";
                    return false;

                }
                if ($element->getLoginClient() == $utilisateur->getLoginClient()) {
                    //echo "L'utilisateur existe déjà";
                    //echo "<script> alert('Le login est déja prit')</script>";
                    return false;

                }
            }
        }

        $longeurCle = 15;
        $key = "";
        //Génère une clé aléatoire
        for ($i = 1; $i < $longeurCle; $i++) {
            $key .= mt_rand(0, 9);
        }


        $sql = "INSERT INTO utilisateur(login,password,nom,prenom,adresseMail,confirmeKey,confirmer,adresseClient,statusClient,soldeClient) VALUES (
:loginTag,:passwordTag,:nomTag,:prenomTag,:adresseMailTag,:confirmeKeyTag,:confirmerTag,:adresseClientTag,:statusClientTag,:soldeClientTag)";

        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            ':loginTag' => $utilisateur->getLoginClient(),
            ':passwordTag' => $utilisateur->getMdpClient(),
            ':nomTag' => $utilisateur->getNomClient(),
            ':prenomTag' => $utilisateur->getPrenomClient(),
            ':confirmeKeyTag' => $key,
            ':confirmerTag' => 0,
            ':adresseMailTag' => $utilisateur->getAdresseMailClient(),
            ':adresseClientTag' => $utilisateur->getAdresseClient(),
            ':statusClientTag' => "client",
            ':soldeClientTag' => 0,
        );

        $pdoStatement->execute($values);
        return true;
    }

    //Fonction qui permet de vérifier si un peut se connecter ou pas
    public static function verficationConnexion(string $login, string $passwordClair): string
    {

        $loginHtml = htmlspecialchars($login);
        $passwordHtmlClair = htmlspecialchars($passwordClair);


        //Fait une requete qui me récuèpre le mot de passe haché
        $sql = "SELECT password from utilisateur WHERE login=:loginTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $values = array(
            "loginTag" => $loginHtml,
        );
        $pdoStatement->execute($values);
        $passwordHache = $pdoStatement->fetch();

        $verifMDP = MotDePasse::verifier($passwordHtmlClair, $passwordHache['password']);
        $verifCompteConfirme = self::compteVerifier($loginHtml);
        if ($verifMDP && $verifCompteConfirme) {

            $_SESSION['login'] = $loginHtml;
            $_SESSION['password'] = $passwordHache;
            $_SESSION['id'] = UtilisateurRepository::getIdByLogin($loginHtml);

            if (self::estAdmin($loginHtml)) {
                $_SESSION['status'] = "admin";
            } else if (self::estFondateur($loginHtml)) {
                $_SESSION['status'] = "fondateur";
            } else {
                $_SESSION['status'] = "client";
            }

            //Le client est connecté un cookie se crée pour lui si il n'en a pas
            //Il ne possède pas de valeur par défaut
            //Mais plus tard ça sera une liste de liste qui contiendra des produits
            $nomCookie = "utilisateur" . $loginHtml;
            if (!isset($_COOKIE[$nomCookie])) {
                setcookie($nomCookie, "", time() + 31536000, "/");
            }

            //Je vérifie que le panier invite ne soit pas vide
            $boolPanierInviteVide = PanierRepository::panierInviteEstVide();
            if (!$boolPanierInviteVide) {
                //Si le panier de l'invité est pas vide je met tous les éléments dans le panier de l'utilisateur
                PanierRepository::mettrePanierInviteDansPanierUtilisateur();
            }


            return "<p>Vous êtes connecté</p>";

        } else if (!$verifMDP) {
            return "<p>Le mot de passe est incorrect<p>";
        } else if (!$verifCompteConfirme) {
            return "<p>Le compte n'est pas confirmé</p>";
        }

        return "Erreur";
    }

    //Fonction qui permet de changer de mot de passe
    public static function changementMotDePasse($login, $nouveauMotDePasse): bool
    {

        $sql = "UPDATE utilisateur SET password = :passwordTag WHERE login = :loginTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            ':passwordTag' => $nouveauMotDePasse,
            ':loginTag' => $login,
        );

        $pdoStatement->execute($values);

        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de savoir si un utilisateur est admin ou pas
    public static function estAdmin($login): bool
    {
        $sql = "SELECT * FROM utilisateur WHERE login = :loginTag AND statusClient = :statusClientTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            ':loginTag' => $login,
            ':statusClientTag' => "admin",
        );

        $pdoStatement->execute($values);

        if ($pdoStatement->rowCount() > 0) {

            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de savoir si un utilisateur est fondateur ou pas
    public static function estFondateur($login): bool
    {
        $sql = "SELECT * FROM utilisateur WHERE login = :loginTag AND statusClient = :statusClientTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            ':loginTag' => $login,
            ':statusClientTag' => "fondateur",
        );

        $pdoStatement->execute($values);

        if ($pdoStatement->rowCount() > 0) {

            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de confirmer un compte
    public static function confirmationMail(): bool
    {
        if (isset($_GET['login'], $_GET['key'])) {
            $login = htmlspecialchars(urldecode($_GET['login']));
            $key = intval($_GET['key']);
            $sql = "SELECT * FROM utilisateur WHERE login = :loginTag AND confirmeKey = :keyTag";
            $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

            $pdoStatement->execute(array(':loginTag' => $login, ':keyTag' => $key));
            $nombreUser = $pdoStatement->rowCount();

            if ($nombreUser == 1) {
                $user = $pdoStatement->fetch();
                if ($user['confirmer'] == 0) {
                    //Je confirme l'utilisateur
                    $sql = "UPDATE utilisateur SET confirmer = 1 WHERE login = :loginTag";
                    $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
                    $pdoStatement->execute(array(':loginTag' => $login));
                    return true;
                    //echo "Votre compte a bien été confirmé";

                } else {
                    return false;
                    //echo "Votre compte a déjà été confirmé";
                }
            } else {
                //echo "L'utilisateur n'existe pas";
                return false;
            }
        }
        return false;

    }

    //Fonction qui permet d'avoir la clé d'un utilisateur
    public static function getKey($login)
    {
        $sql = "SELECT confirmeKey FROM utilisateur WHERE login = :loginTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);

        $values = array(
            ':loginTag' => $login,
        );

        $pdoStatement->execute($values);

        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetch()['confirmeKey'];
        } else {
            return null;
        }
    }

    //Fonction qui me permet de vérifier si un compte est confirmé ou pas
    public static function compteVerifier($login): bool
    {
        //Verifie si le compte est vérifié
        $sql = "SELECT * FROM utilisateur WHERE login = :loginTag AND confirmer = 1";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':loginTag' => $login));
        $nombreUser = $pdoStatement->rowCount();
        if ($nombreUser == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de supprimer un utilisateur (Pour l'admin)
    public static function supprimerUtilisateur($id)
    {
        $sql = "DELETE FROM utilisateur WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        /*if ($pdoStatement->rowCount() > 0) {
            echo "L'utilisateur a bien été supprimé";
        } else {
            echo "L'utilisateur n'a pas été supprimé";
        }*/
    }

    //Fonction qui permet de mettre admin un utilisateur (Pour l'admin et le fondateur)

    public static function mettreAdmin($id): bool
    {
        $sql = "UPDATE utilisateur SET statusClient = 'admin' WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));

        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de mettre un admin en client (uniquement pour le fondateur)

    public static function mettreClient($id): bool
    {
        $sql = "UPDATE utilisateur  SET statusClient = 'client' WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    //Fonction qui permet d'avoir le status d'un client avec son id

    public static function getStatusClient($id)
    {
        $sql = "SELECT statusClient FROM utilisateur WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetch()['statusClient'];
        } else {
            return null;
        }
    }

    //Fonction envoie un mail à l'utilisateur pour confirmer son compte
    public static function envoieDuMailConfirmationCompte($login, $mail)
    {
        //GetKey from database
        $key = UtilisateurRepository::getKey($login);

        $header = "MIME-Version: 1.0\r\n";
        $header .= 'From:ecommercevinyl@gmail.com' . "\n";
        $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
        $header .= 'Content-Transfer-Encoding: 8bit';

        //YOPMail ne comprend pas les balises html

        /*$message = '<html>
                        <body>  
                            <div>
                            
                            <p>Bonjour, merci de vous être inscrit sur notre site, pour confirmer votre compte merci de cliquer sur le lien ci-dessous
                            <br>
                            
                            <a referrerpolicy="unsafe-url" href="localhost/projetWeb/web/frontController.php?controller=utilisateur&action=affichePageConnexion&login=' . urlencode($login) . '&key=' . $key . '">Confirmer votre compte</a>
                            </p>
                                
                            </div>
                        </body>
                    </html>';*/

        $messagePourYOPMail = "Bonjour, merci de vous être inscrit sur notre site, pour confirmer votre compte merci de cliquer sur le lien ci-dessous\n
                https://webinfo.iutmontp.univ-montp2.fr/~beralq/ProjetWebEcommerce/web/frontController.php?controller=utilisateur&action=affichePageConnexion&login=" . urlencode($login) . "&key=" . $key;
        mail($mail, "Confirmation d'inscription", $messagePourYOPMail, $header);

    }

    //Fonction qui me permet d'envoyer un mail de réinitialisation de mot de passe
    public static function envoieDuMailReinitialisationMdp($mail): bool
    {
        //GetKey from database
        $utilisateur = UtilisateurRepository::getUtilisateurByAdresseMail($mail);

        $login = $utilisateur->getLoginClient();
        $key = UtilisateurRepository::getKey($login);

        $header = "MIME-Version: 1.0\r\n";
        $header .= 'From:ecommercevinyl@gmail.com' . "\n";
        $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
        $header .= 'Content-Transfer-Encoding: 8bit';

        /*$message = '<html>
                        <body>  
                            <div>
                            
                            <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe
                            <br>
                            
                            <a referrerpolicy="unsafe-url" href="localhost/projetWeb/web/frontController.php?controller=utilisateur&action=affichePageReinitialisationMDP&login=' . urlencode($login) . '&key=' . $key . '">Réinitialiser votre mot de passe</a>
                            </p>
                                
                            </div>
                        </body>
                    </html>';*/

        $messagePourYOPMail = "Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe\n
                https://webinfo.iutmontp.univ-montp2.fr/~beralq/ProjetWebEcommerce/web/frontController.php?controller=utilisateur&action=affichePageReinitialisationMDP&login=" . urlencode($login) . "&key=" . $key;


        $bool = mail($mail, "Réinitialisation de mot de passe", $messagePourYOPMail, $header);
        if ($bool) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui me permet d'ajouter un montant au solde d'un utilisateur
    public static function ajouterMontantAuSolde($id, $montant): bool
    {
        $sql = "UPDATE utilisateur SET soldeClient = soldeClient + :montantTag WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':montantTag' => $montant, ':idTag' => $id));

        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui me permet de récupérer le solde d'un utilisateur
    public static function getSolde($id)
    {
        $sql = "SELECT soldeClient FROM utilisateur WHERE id = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetch()['soldeClient'];
        } else {
            return null;
        }
    }


    //Fonction qui permet de modifier un utilisateur
    public static function modifierUtilisateur($idClient, $login, $nom, $prenom, $adresseMail, $adresseClient, $soldeClient): bool
    {

        $sql = "UPDATE utilisateur SET login = :loginTag,nom = :nomTag,prenom = :prenomTag,
                       adresseMail = :adresseMailTag,adresseClient = :adresseClientTag,
                       soldeClient = :soldeClientTag WHERE id = $idClient";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':loginTag' => $login, ':nomTag' => $nom, ':prenomTag' => $prenom, ':adresseMailTag' => $adresseMail, ':adresseClientTag' => $adresseClient, ':soldeClientTag' => $soldeClient));

        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui permet de récupérer les commandes d'un utilisateur en fonction de son id
    public static function getListeCommandes($id)
    {
        $sql = "SELECT * FROM commandes WHERE idclient = :idTag ORDER BY dateCommande DESC";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetchAll();
        } else {
            return null;
        }
    }

    //Récupère une commande en fonction de son id
    public static function getCommande($id)
    {
        $sql = "SELECT * FROM commandes WHERE idcommande = :idTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idTag' => $id));
        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetch();
        } else {
            return null;
        }
    }

    public static function commandeBonUtilisateur($idCommande, $idClient): bool
    {
        $sql = "SELECT * FROM commandes WHERE idcommande = :idCommandeTag AND idclient = :idClientTag";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute(array(':idCommandeTag' => $idCommande, ':idClientTag' => $idClient));
        if ($pdoStatement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getCommandes() {
        $sql = "SELECT * FROM commandes";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($sql);
        $pdoStatement->execute();
        if ($pdoStatement->rowCount() > 0) {
            return $pdoStatement->fetchAll();
        } else {
            return null;
        }
    }
}


?>
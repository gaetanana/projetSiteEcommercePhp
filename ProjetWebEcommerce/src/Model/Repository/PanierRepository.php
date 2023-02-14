<?php

namespace App\eCommerce\Model\Repository;

class PanierRepository
{
    //Le panier d'un utilisateur est stocké dans un cookie

    //On peut récupérer le panier d'un utilisateur avec son login :
    //$panierUtilisateur = "utilisateur".$_SESSION['login'];


    //Fonction qui permet d'ajouter un produit dans le panier d'un utilisateur avec une quantité donnée
    //Cette fonction permet d'ajouter dans un panier utilisateur ou invité
    //Si un produit est déja présent dans le panier on ajoute la quantité au produit (sans pour autant remettre le produit)

    //En etat de fonctionnement
    public static function ajouterProduitDansPanier(int $idProduit, int $quantiteProduit): bool
    {
        if (isset($_SESSION['login'])) {
            //On récupère le panier de l'utilisateur
            $panierUtilisateur = "utilisateur" . $_SESSION['login'];

            if(isset($_COOKIE[$panierUtilisateur])){
                $panier = json_decode($_COOKIE[$panierUtilisateur], true);

            }
            else{
                setcookie($panierUtilisateur, "", time() + 3600, "/");
            }

            //Je veux parcourir le panier pour voir si le produit est déjà présent
            if (!empty($panier)) {
                foreach ($panier as $key => $value) {
                    if ($value['idProduit'] == $idProduit) {
                        //Le produit est déjà présent dans le panier
                        //On ajoute la quantité au produit
                        $panier[$key]['quantiteProduit'] += $quantiteProduit;
                        //On met à jour le panier
                        setcookie($panierUtilisateur, json_encode($panier), time() + 31536000, "/");
                        return true;
                    }
                }
            }


            //On ajoute le produit dans le panier
            $panier[] = array("idProduit" => $idProduit, "quantiteProduit" => $quantiteProduit);

            //On encode le panier
            $panierEncode = json_encode($panier);

            //On met à jour le cookie
            setcookie($panierUtilisateur, $panierEncode, time() + 31536000, "/");
            return true;
        } else if (isset($_COOKIE['panierInvite'])) {

            //On récupère le panier de l'utilisateur
            $panier = json_decode($_COOKIE["panierInvite"], true);

            //Je veux parcourir le panier pour voir si le produit est déjà présent

            if (!empty($panier)) {
                foreach ($panier as $key => $value) {
                    if ($value['idProduit'] == $idProduit) {
                        //Le produit est déjà présent dans le panier
                        //On ajoute la quantité au produit
                        $panier[$key]['quantiteProduit'] += $quantiteProduit;
                        //On met à jour le panier
                        setcookie("panierInvite", json_encode($panier), time() + 3600, "/");
                        return true;
                    }
                }
            }
            //On est dans le cas ou le produit est nouveau dans le panier (en bas)

            //On ajoute le produit dans le panier
            $panier[] = array("idProduit" => $idProduit, "quantiteProduit" => $quantiteProduit);

            //On encode le panier
            $panierEncode = json_encode($panier);

            //On met à jour le cookie
            setcookie("panierInvite", $panierEncode, time() + 31536000, "/");
            return true;
        }


        return false;

    }

    //Fonction qui permet de supprimer un produit du panier d'un utilisateur
    //En etat de fonctionnement
    public static function supprimerProduitDuPanier(int $idProduit, int $quantiteProduit): bool
    {
        if (isset($_SESSION['login'])) {
            //On récupère le panier de l'utilisateur
            $panierUtilisateur = "utilisateur" . $_SESSION['login'];
            $panier = json_decode($_COOKIE[$panierUtilisateur], true);


            //On parcours le panier pour trouver le produit à supprimer
            if (!empty($panier)) {
                foreach ($panier as $key => $value) {
                    if ($value['idProduit'] == $idProduit) {

                        //Si on doit supprimer la totalité du produit du panier
                        //Dans ce cas le panier est supprimé du panier
                        if ($quantiteProduit == $value['quantiteProduit']) {
                            unset($panier[$key]);
                            setcookie($panierUtilisateur, json_encode($panier), time() + 31536000, "/");
                            return true;
                        }
                        //Sinon on supprime la quantité donnée du produit
                        //Et le produit reste dans le panier
                        else {
                            $panier[$key]['quantiteProduit'] -= $quantiteProduit;
                            //On met à jour le panier
                            setcookie($panierUtilisateur, json_encode($panier), time() + 31536000, "/");
                            return true;
                        }
                    }
                }
            }

        } else if (isset($_COOKIE['panierInvite'])) {
            $panierInvite = "panierInvite";
            //On récupère le panier de l'utilisateur
            $panier = json_decode($_COOKIE["panierInvite"], true);


            //On parcours le panier pour trouver le produit à supprimer
            if (!empty($panier)) {
                foreach ($panier as $key => $value) {
                    if ($value['idProduit'] == $idProduit) {
                        //Si on doit supprimer la totalité du produit du panier
                        //Dans ce cas le panier est supprimé du panier
                        if ($quantiteProduit == $value['quantiteProduit']) {
                            unset($panier[$key]);
                            setcookie($panierInvite, json_encode($panier), time() + 31536000, "/");
                            return true;
                        }
                        //Sinon on supprime la quantité donnée du produit
                        //Et le produit reste dans le panier
                        else {
                            $panier[$key]['quantiteProduit'] -= $quantiteProduit;
                            //On met à jour le panier
                            setcookie($panierInvite, json_encode($panier), time() + 31536000, "/");
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }


    //Fonction qui permet de supprimer tous le panier d'un utilisateur
    public static function videPanierUtilisateur(): bool
    {
        if ($_SESSION['login']) {
            //Avant de vider le panier on doit remettre le stock des produits
            //On récupère le panier de l'utilisateur

            $panierUtilisateur = "utilisateur" . $_SESSION['login'];
            setcookie($panierUtilisateur, "", time() + 31536000, "/");
            return true;
        } else {
            setcookie("panierInvite", "", time() + 31536000, "/");
            return true;
        }
    }

    //Fonction qui enlève un certains nombre de produit du sotck d'un produit
    //En etat de fonctionnement
    public static function enleverProduitDuStock(int $idProduit, int $quantiteProduit): bool
    {
        //On récupère le produit
        $produit = ProduitRepository::getProduitById($idProduit);

        //On récupère la quantité du produit
        $quantiteProduitActuel = $produit->getStockProduit();

        //On enlève la quantité du produit
        $quantiteProduitActuel = $quantiteProduitActuel - $quantiteProduit;

        //On met à jour la quantité du produit
        //En faisant une requete sql

        $requete = "UPDATE produits SET stockProduit = :quantiteProduitActuel WHERE idProduit = :idProduit";
        $pdoStatement = DataBaseConnection::getPDO()->prepare($requete);
        $values = array(
            ":quantiteProduitActuel" => $quantiteProduitActuel,
            ":idProduit" => $idProduit
        );
        $bool = $pdoStatement->execute($values);

        return $bool;
    }

    public static function payeAvecSoldeCompte($montant, $panier): bool
    {

        $login = $_SESSION['login'];
        $requete = "UPDATE utilisateur SET soldeClient = soldeClient - :montant WHERE login = :login";
        $pdoStatement = DataBaseConnection::getPDO()->prepare($requete);
        $values = array(
            ":montant" => $montant,
            ":login" => $login
        );
        $pdoStatement->execute($values);

        //Parcour du panier pour enlever les produits du stock
        foreach ($panier as $key => $value) {
            $idProduit = $value['idProduit'];
            $quantiteProduit = $value['quantiteProduit'];

            self::enleverProduitDuStock($idProduit, $quantiteProduit);

        }


        //Je vide le panier de l'utilisateur
        self::videPanierUtilisateur();

        return true;
    }

    public static function payerEnCB($panier): bool
    {
        //Parcour du panier pour enlever les produits du stock
        foreach ($panier as $key => $value) {
            $idProduit = $value['idProduit'];
            $quantiteProduit = $value['quantiteProduit'];

            self::enleverProduitDuStock($idProduit, $quantiteProduit);

        }
        //Je vide le panier de l'utilisateur
        self::videPanierUtilisateur();

        return true;
    }

    /***********************Fonction qui me servent d'outil***************/

    //Fonction qui me permet de récupérer les éléments d'un panier
    public static function getPanierUtilisateur(): ?array
    {
        if (isset($_SESSION['login'])) {
            $panierUtilisateur = "utilisateur" . $_SESSION['login'];
            if (isset($_COOKIE[$panierUtilisateur])) {
                $panier = json_decode($_COOKIE[$panierUtilisateur], true);
                return $panier;
            }
            return null;
        } else {
            if (isset($_COOKIE["panierInvite"])) {
                $panier = json_decode($_COOKIE["panierInvite"], true);
                return $panier;
            }
            else{
                return null;
            }
        }
    }

    //Fonction qui me permet de récupérer les éléments du panier invité
    public static function getPanierInvite(): ?array
    {
        $panier = json_decode($_COOKIE['panierInvite'], true);
        return $panier;
    }

    //Fonction qui me permet de savoir si le contenue panier est vide ou pas
    //En état de fonctionnement
    public static function panierEstVide(): bool
    {
        $panier = self::getPanierUtilisateur();

        if (empty($panier)) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui me permet de savoir si le panier d'un invité est vide
    public static function panierInviteEstVide(): bool
    {
        if (isset($_COOKIE['panierInvite'])) {
            $panier = json_decode($_COOKIE['panierInvite'], true);
            if (empty($panier)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //Fonction qui me permet de savoir le stock d'un produit dans un panier avec son id

    public static function getStockProduitDansPanier(int $idProduit): int
    {
        $panier = self::getPanierUtilisateur();
        foreach ($panier as $key => $value) {
            if ($value['idProduit'] == $idProduit) {
                return $value['quantiteProduit'];
            }
        }
        return 0;
    }

    //Fonction qui me permet de mettre tous les produits du panier de l'invité dans un panier utilisateur
    public static function mettrePanierInviteDansPanierUtilisateur(): bool
    {
        if (isset($_COOKIE['panierInvite'])) {
            $panierInvite = json_decode($_COOKIE['panierInvite'], true);
            if (!empty($panierInvite)) {
                foreach ($panierInvite as $key => $value) {
                    $idProduit = $value['idProduit'];
                    $quantiteProduit = $value['quantiteProduit'];
                    self::ajouterProduitDansPanier($idProduit, $quantiteProduit);
                }
                setcookie("panierInvite", "", time() + 31536000, "/");
                return true;
            }
        }
        return false;
    }

    //Fonction qui vérifie si la personne à assez dans son solde pour acheter les produits
    public static function soldeSuffisant(): bool
    {
        $panier = self::getPanierUtilisateur();
        $total = 0;
        foreach ($panier as $key => $value) {
            $produit = ProduitRepository::getProduitById($value['idProduit']);
            $prixProduit = $produit->getPrixProduit();
            $quantiteProduit = $value['quantiteProduit'];
            $total += $prixProduit * $quantiteProduit;
        }
        $soldeUtilisateur = UtilisateurRepository::getSolde($_SESSION['id']);

        if ($soldeUtilisateur >= $total) {
            return true;
        } else {
            return false;
        }
    }

    //Fonction qui me permet d'avoir la somme totale d'un panier
    public static function getTotalPanier(): float
    {
        $panier = self::getPanierUtilisateur();
        $total = 0;
        foreach ($panier as $key => $value) {
            $produit = ProduitRepository::getProduitById($value['idProduit']);
            $prixProduit = $produit->getPrixProduit();
            $quantiteProduit = $value['quantiteProduit'];
            $total += $prixProduit * $quantiteProduit;
        }
        return $total;
    }


    //Fonction qui met à jour le panier si la quantité d'un produit est égale à 0
    public static function updatePanier(int $idProduit, int $quantiteProduit): bool
    {
        $panier = self::getPanierUtilisateur();
        $quantiteProduiDansBD = ProduitRepository::getStockProduitById($idProduit);

        foreach ($panier as $key => $value) {
            if ($value['idProduit'] == $idProduit) {
                $panier[$key]['quantiteProduit'] = $quantiteProduit;
                if ($panier[$key]['quantiteProduit'] == 0 || $quantiteProduiDansBD <=0) {
                    //Si la quantité du produit est égale à 0 ou que le stock du produit est égale à 0
                    //Je supprime le produit du panier
                    unset($panier[$key]);
                }
                $panier = json_encode($panier);
                setcookie("panierUtilisateur", $panier, time() + 31536000, "/");
                return true;
            }
        }
        return false;
    }

    //Fonction qui permet d'envoyer un mail au client pour le remercier de sa commande
    public static function envoieMailRemercimentAchat($login, $mail)
    {
        //GetKey from database
        $key = UtilisateurRepository::getKey($login);

        $header = "MIME-Version: 1.0\r\n";
        $header .= 'From:ecommercevinyl@gmail.com' . "\n";
        $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
        $header .= 'Content-Transfer-Encoding: 8bit';
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
        $message = "Merci de votre achat sur notre site !";
        mail($mail, "Confirmation d'inscription", $message, $header);

    }


    /*****************************************Fonction pour les commandes******************************************************/

    //Fonction qui me permet d'insérer une commande dans la base de données
    public static function insertCommande($idClient,$dateCommande,$infoCommande): bool
    {
        $db = DataBaseConnection::getPdo();
        $req = $db->prepare("INSERT INTO commandes(idClient,dateCommande,infoCommande) 
        VALUES (:idClient,:dateCommande,:infoCommande)");
        $values = [
            'idClient' => $idClient,
            'dateCommande' => $dateCommande,
            'infoCommande' => $infoCommande
        ];
        $req->execute($values);
        return true;

    }

}

?>
<?php

namespace App\eCommerce\Model\Repository;


use App\eCommerce\Model\DataObject\produit\Amplis;
use App\eCommerce\Model\DataObject\produit\Enceinte;
use App\eCommerce\Model\DataObject\produit\Platine;
use App\eCommerce\Model\DataObject\produit\Produit;
use App\eCommerce\Model\DataObject\produit\Vinyle;
use PDO;


class ProduitRepository
{

    //Fonction qui me permet de récupérer tous les produits
    public static function getAllProduits(): ?array
    {
        $pdo = DataBaseConnection::getPdo();
        $sql = "SELECT * FROM produits";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        foreach ($pdoStatement as $produitFormatTableau) {

            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit'], $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            $listeProduit[] = $produit;
        }

        if (isset($listeProduit) == null) {
            //echo "La liste des utilisateurs est vide";
            return null;
        } else {
            return $listeProduit;
        }


    }

    //Fonction qui me permet de récupérer le prix d'une produit en bd
    public static function getPrixProduit(int $idProduit): ?float
    {
        $pdo = DataBaseConnection::getPdo();
        $sql = "SELECT prixProduit FROM produits WHERE idProduit = :idProduit";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(":idProduit", $idProduit, PDO::PARAM_INT);
        $pdoStatement->execute();

        $prixProduit = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        if ($prixProduit == null) {
            //echo "La liste des utilisateurs est vide";
            return null;
        } else {
            return $prixProduit['prixProduit'];
        }
    }

    //Fonction qui me permet de récupérer le stock d'un produit dans la BD
    public static function getStockProduitById(int $idProduit): ?int
    {
        $pdo = DataBaseConnection::getPdo();
        $sql = "SELECT stockProduit FROM produits WHERE idProduit = :idProduit";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(":idProduit", $idProduit, PDO::PARAM_INT);
        $pdoStatement->execute();

        $stockProduit = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $stockProduit['stockProduit'];
    }

    //Fonction qui me permet de récupérer tous les Amplis
    public static function getProduitsAmplis(): ?array
    {
        $pdo = DataBaseConnection::getPdo();

        $sql = "SELECT * FROM produits JOIN amplis ON produits.idProduit = amplis.idProduitAmplis";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        foreach ($pdoStatement as $produitFormatTableau) {
            $produit = new Amplis($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit']
                , $produitFormatTableau['stockProduit'], $produitFormatTableau['puissanceAmplis']
                , $produitFormatTableau['sensibiliteAmplis'], $produitFormatTableau['marqueAmplis']);


            $listeProduit[] = $produit;
        }


        if (isset($listeProduit) == null) {
            return null;
        } else {
            return $listeProduit;
        }
    }

    //Fonction qui me permet de récupérer toutes les Enceintes
    public static function getProduitsEnceintes(): ?array
    {
        $pdo = DataBaseConnection::getPdo();

        $sql = "SELECT * FROM produits JOIN enceinte ON produits.idProduit = enceinte.idProduitEnceinte";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        foreach ($pdoStatement as $produitFormatTableau) {
            $produit = new Enceinte($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit']
                , $produitFormatTableau['stockProduit'], $produitFormatTableau['sensibiliteEnceinte'],
                $produitFormatTableau['puissanceEnceinte'],
                $produitFormatTableau['marqueEnceinte']);

            $listeProduit[] = $produit;
        }

        if (isset($listeProduit) == null) {
            return null;
        } else {
            return $listeProduit;
        }
    }

    //Fonction qui me permet de récupérer tous les Platines
    public static function getProduitsPlatines(): ?array
    {
        $pdo = DataBaseConnection::getPdo();

        $sql = "SELECT * FROM produits JOIN platine ON produits.idProduit = platine.idProduitPlatine";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        foreach ($pdoStatement as $produitFormatTableau) {
            $produit = new Platine($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit']
                , $produitFormatTableau['stockProduit'], $produitFormatTableau['formatVinyle'],
                $produitFormatTableau['bluetooth'],
                $produitFormatTableau['marquePlatine']);

            $listeProduit[] = $produit;
        }

        if (isset($listeProduit) == null) {
            return null;
        } else {
            return $listeProduit;
        }
    }


    //Fonction qui me permet de  récupérer tous les Vinyles
    public static function getProduitsVinyles(): ?array
    {
        $pdo = DataBaseConnection::getPdo();

        $sql = "SELECT * FROM produits JOIN vinyle ON produits.idProduit = vinyle.idProduitVinyle";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        foreach ($pdoStatement as $produitFormatTableau) {
            $produit = new Vinyle($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit']
                , $produitFormatTableau['stockProduit'], $produitFormatTableau['tailleVinyle'],
                $produitFormatTableau['artisteVinyle'],
                $produitFormatTableau['genreVinyle']);

            $listeProduit[] = $produit;
        }

        if (isset($listeProduit) == null) {
            return null;
        } else {
            return $listeProduit;
        }
    }


    //Fonction qui me permet d'ajouter un produit
    public static function ajouterProduit(Produit $produit): void
    {
        $requeteImage = "INSERT INTO imagessite (nom,taille,typeImage,bin) VALUES (?, ?, ?, ?)";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($requeteImage);

        $pdoStatement->execute(array($_FILES['imageProduit']['name'],
            $_FILES['imageProduit']['size'],
            $_FILES['imageProduit']['type'],
            file_get_contents($_FILES['imageProduit']['tmp_name'])));

        //Je dois obtenir l'id de l'image que j'ai inséré
        $idImage = DataBaseConnection::getPdo()->lastInsertId();


        $db = DataBaseConnection::getPdo();
        $sql = "INSERT INTO produits (nomProduit,prixProduit,descriptionProduit,idImageProduit,stockProduit) VALUES (:nomProduit,:prixProduit,:descriptionProduit,:idImageProduit,:stockProduit)";
        $pdoStatement = $db->prepare($sql);

        $pdoStatement->execute(array(
            ':nomProduit' => $produit->getNomProduit(),
            ':prixProduit' => $produit->getPrixProduit(),
            ':descriptionProduit' => $produit->getDescriptionProduit(),
            ':idImageProduit' => $idImage,
            ':stockProduit' => $produit->getStockProduit()
        ));


    }

    //Fonction qui me permet d'ajouter une platine dans sa table
    public static function ajoutProduitPlatine(Platine $platine)
    {
        $requete = "INSERT INTO platine (idProduitPlatine,formatVinyle,bluetooth,marquePlatine) VALUES (:idProduitPlatine,:formatVinyle,:bluetooth,:marquePlatine)";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($requete);

        $pdoStatement->execute(array(
            ':idProduitPlatine' => DataBaseConnection::getPdo()->lastInsertId(),
            ':formatVinyle' => $platine->getFormatVinyle(),
            ':bluetooth' => $platine->getBluetooth(),
            ':marquePlatine' => $platine->getMarquePlatine()
        ));
    }

    //Fonction qui me permet d'ajouter une enceinte dans sa table
    public static function ajoutProduitEnceinte(Enceinte $enceinte)
    {
        $requete = "INSERT INTO enceinte (idProduitEnceinte,sensibiliteEnceinte,puissanceEnceinte,marqueEnceinte) VALUES (:idProduitPlatine,:formatVinyle,:bluetooth,:marqueEnceinte)";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($requete);

        $pdoStatement->execute(array(
            ':idProduitPlatine' => DataBaseConnection::getPdo()->lastInsertId(),
            ':formatVinyle' => $enceinte->getSensibiliteEnceinte(),
            ':bluetooth' => $enceinte->getPuissanceEnceinte(),
            ':marqueEnceinte' => $enceinte->getMarqueEnceinte()
        ));
    }

    //Fonction qui me permet d'ajouter un vinyle dans sa table
    public static function ajoutProduitVinyle(Vinyle $vinyle)
    {
        $requete = "INSERT INTO vinyle (idProduitVinyle,tailleVinyle,artisteVinyle,genreVinyle) VALUES (:idProduitVinyle,:tailleVinyle,:artisteVinyle,:genreVinyle)";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($requete);

        $pdoStatement->execute(array(
            ':idProduitVinyle' => DataBaseConnection::getPdo()->lastInsertId(),
            ':tailleVinyle' => $vinyle->getTailleVinyle(),
            ':artisteVinyle' => $vinyle->getArtistVinyle(),
            ':genreVinyle' => $vinyle->getGenreVinyle()
        ));
    }

    //Fonction qui me permet d'ajouter des amplis dans sa table
    public static function ajoutProduitAmplis(Amplis $amplis)
    {
        $requete = "INSERT INTO amplis (idProduitAmplis,puissanceAmplis,sensibiliteAmplis,marqueAmplis) 
        VALUES (:idProduitAmplis,:puissanceAmplis,:sensibiliteAmplis,:marqueAmplis)";
        $pdoStatement = DataBaseConnection::getPdo()->prepare($requete);

        $pdoStatement->execute(array(
            ':idProduitAmplis' => DataBaseConnection::getPdo()->lastInsertId(),
            ':puissanceAmplis' => $amplis->getPuissanceAmplis(),
            ':sensibiliteAmplis' => $amplis->getSensibiliteAmplis(),
            ':marqueAmplis' => $amplis->getMarqueAmplis()
        ));
    }

    //Fonction qui me permet d'avoir l'id d'une image avec l'id d'un produit
    public static function getIdImageProduit(int $idProduit): ?int
    {
        $db = DataBaseConnection::getPdo();
        $sql = "SELECT idImageProduit FROM produits WHERE idProduit = :idProduit";
        $pdoStatement = $db->prepare($sql);
        $pdoStatement->execute(array(
            ':idProduit' => $idProduit
        ));

        $idImage = $pdoStatement->fetch();

        if ($idImage == null) {
            return null;
        } else {
            return $idImage['idImageProduit'];
        }
    }


    //Fonction qui me permet de rechercher un produit dans la site
    public static function rechercheProduit(): ?array
    {
        $listeDifferentOrtographEnceinte = array("Enceinte", "enceinte", "enceintes", "Enceintes");

        foreach ($listeDifferentOrtographEnceinte as $mot) {
            if ($_POST["requete"] == $mot) {
                //Afficher les enceintes
                $db = DataBaseConnection::getPdo();
                $sql = "SELECT * FROM produits INNER JOIN enceinte ON produits.idProduit = enceinte.idProduitEnceinte";
                $pdoStatement = $db->prepare($sql);
                $pdoStatement->execute();

                foreach ($pdoStatement as $produitFormatTableau) {

                    $produit = new Enceinte($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                        , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit'], $produitFormatTableau['sensibiliteEnceinte'], $produitFormatTableau['puissanceEnceinte'], $produitFormatTableau['marqueEnceinte']);
                    $listeProduit[] = $produit;
                }

                if (isset($listeProduit) == null) {
                    //echo "La liste des utilisateurs est vide";
                    return null;
                } else {
                    return $listeProduit;
                }

            }
        }
        $listeDifferentOrtographAmplis = array("Amplis", "amplis", "ampli", "Ampli");

        foreach ($listeDifferentOrtographAmplis as $mot) {
            if ($_POST["requete"] == $mot) {
                //Afficher les amplis
                $db = DataBaseConnection::getPdo();
                $sql = "SELECT * FROM produits INNER JOIN amplis ON produits.idProduit = amplis.idProduitAmplis";
                $pdoStatement = $db->prepare($sql);
                $pdoStatement->execute();

                foreach ($pdoStatement as $produitFormatTableau) {

                    $produit = new Amplis($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                        , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit'], $produitFormatTableau['puissanceAmplis'], $produitFormatTableau['sensibiliteAmplis'], $produitFormatTableau['marqueAmplis']);
                    $listeProduit[] = $produit;
                }

                if (isset($listeProduit) == null) {
                    //echo "La liste des utilisateurs est vide";
                    return null;
                } else {
                    return $listeProduit;
                }

            }
        }

        //Si l'utilisateur ne cherche pas une platine ni une enceinte ni un vinyle on passe en dessous
        return null;
    }

    //Fonction qui me permet de savoir si un utilisateur cherche une platine
    public static function chercehPlatineBool($recherche): bool
    {
        $listeDifferentOrtographPlatine = array("Platine", "platine", "platines", "Platines");

        foreach ($listeDifferentOrtographPlatine as $mot) {
            if ($recherche == $mot) {
                return true;

            }
        }
        return false;
    }

    //Fonction qui me permet de savoir si un utilisateur cherche une enceinte
    public static function chercehEnceinteBool($recherche): bool
    {
        $listeDifferentOrtographEnceinte = array("Enceinte", "enceinte", "enceintes", "Enceintes");

        foreach ($listeDifferentOrtographEnceinte as $mot) {
            if ($recherche == $mot) {
                return true;

            }
        }
        return false;
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un vinyle
    public static function chercehVinyleBool($recherche): bool
    {
        $listeDifferentOrtographVinyle = array("Vinyle", "vinyle", "vinyles", "Vinyles");

        foreach ($listeDifferentOrtographVinyle as $mot) {
            if ($recherche == $mot) {
                return true;

            }
        }
        return false;
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un amplis
    public static function chercehAmplisBool($recherche): bool
    {
        $listeDifferentOrtographAmplis = array("Amplis", "amplis", "ampli", "Ampli");

        foreach ($listeDifferentOrtographAmplis as $mot) {
            if ($recherche == $mot) {
                return true;

            }
        }
        return false;
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un produit par son nom
    public static function chercehProduitParNomBool($recherche): bool
    {
        $db = DataBaseConnection::getPdo();
        $sql = "SELECT * FROM produits WHERE nomProduit LIKE :nomProduit";
        $pdoStatement = $db->prepare($sql);
        $pdoStatement->execute(array(
            ':nomProduit' => "%" . $recherche . "%"
        ));

        $produit = $pdoStatement->fetch();

        if ($produit == null) {
            return false;
        } else {
            return true;
        }
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un produit par sa marque
    public static function chercehProduitParMarqueBool($recherche): bool
    {
        $db = DataBaseConnection::getPdo();
        $requete1 = "SELECT * FROM produits INNER JOIN amplis ON produits.idProduit = amplis.idProduitAmplis WHERE marqueAmplis LIKE :marqueProduit";
        $requete2 = "SELECT * FROM produits INNER JOIN enceinte ON produits.idProduit = enceinte.idProduitEnceinte WHERE marqueEnceinte LIKE :marqueProduit";
        $requete3 = "SELECT * FROM produits INNER JOIN platine ON produits.idProduit = platine.idProduitPlatine WHERE marquePlatine LIKE :marqueProduit";

        $pdoStatement1 = $db->prepare($requete1);
        $pdoStatement2 = $db->prepare($requete1);
        $pdoStatement3 = $db->prepare($requete1);

        $pdoStatement1->execute(array(
            ':marqueProduit' => "%" . $recherche . "%"
        ));
        $pdoStatement2->execute(array(
            ':marqueProduit' => "%" . $recherche . "%"
        ));
        $pdoStatement3->execute(array(
            ':marqueProduit' => "%" . $recherche . "%"
        ));

        $result1 = $pdoStatement1->fetch();
        $result2 = $pdoStatement2->fetch();
        $result3 = $pdoStatement3->fetch();

        if ($result1 == null && $result2 == null && $result3 == null) {
            return false;
        } else {
            return true;
        }
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un artiste
    public static function chercehArtisteBool($recherche): bool
    {
        $db = DataBaseConnection::getPdo();
        $sql = "SELECT * FROM vinyle WHERE artisteVinyle LIKE :nomArtiste";
        $pdoStatement = $db->prepare($sql);
        $pdoStatement->execute(array(
            ':nomArtiste' => "%" . $recherche . "%"
        ));

        $artiste = $pdoStatement->fetch();

        if ($artiste == null) {
            return false;
        } else {
            return true;
        }
    }

    //Fonction qui me permet de savoir si un utilisateur cherche un genre
    public static function chercehGenreBool($recherche): bool
    {
        $db = DataBaseConnection::getPdo();
        $sql = "SELECT * FROM vinyle WHERE genreVinyle LIKE :nomGenre";
        $pdoStatement = $db->prepare($sql);
        $pdoStatement->execute(array(
            ':nomGenre' => "%" . $recherche . "%"
        ));

        $genre = $pdoStatement->fetch();

        if ($genre == null) {
            return false;
        } else {
            return true;
        }
    }



    /**********************Recherche des produits**********************/

    //Fonction qui permet de chercher un produit par son nom
    public static function chercherProduitParNom($nomProduit): ?array
    {
        $db = DataBaseConnection::getPdo();
        $sql = "SELECT * FROM produits WHERE nomProduit LIKE :nomProduit";
        $pdoStatement = $db->prepare($sql);
        $pdoStatement->execute(array(
            ':nomProduit' => "%" . $nomProduit . "%"
        ));

        $listeProduit = array();

        foreach ($pdoStatement as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            $listeProduit[] = $produit;
        }

        return $listeProduit;
    }

    //Fonction qui permet de chercher un produit par sa marque
    public static function chercherProduitParMarque($marqueProduit): ?array
    {
        $db = DataBaseConnection::getPdo();
        $requete1 = "SELECT * FROM produits INNER JOIN amplis ON produits.idProduit = amplis.idProduitAmplis WHERE marqueAmplis LIKE :marqueProduit";
        $requete2 = "SELECT * FROM produits INNER JOIN enceinte ON produits.idProduit = enceinte.idProduitEnceinte WHERE marqueEnceinte LIKE :marqueProduit";
        $requete3 = "SELECT * FROM produits INNER JOIN platine ON produits.idProduit = platine.idProduitPlatine WHERE marquePlatine LIKE :marqueProduit";

        $pdoStatement1 = $db->prepare($requete1);
        $pdoStatement2 = $db->prepare($requete1);
        $pdoStatement3 = $db->prepare($requete1);

        $pdoStatement1->execute(array(
            ':marqueProduit' => "%" . $marqueProduit . "%"
        ));
        $pdoStatement2->execute(array(
            ':marqueProduit' => "%" . $marqueProduit . "%"
        ));
        $pdoStatement3->execute(array(
            ':marqueProduit' => "%" . $marqueProduit . "%"
        ));
        $listeProduit = array();
        foreach ($pdoStatement1 as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            array_push( $listeProduit,$produit);
        }
        foreach ($pdoStatement2 as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            array_push( $listeProduit,$produit);
        }
        foreach ($pdoStatement3 as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            array_push( $listeProduit,$produit);
        }

        return $listeProduit;
    }

    //Fonction qui me permet de chercher un produit par artiste
    public static function chercherProduitParArtiste($artisteProduit): ?array
    {
        $db = DataBaseConnection::getPdo();
        $requete1 = "SELECT * FROM produits INNER JOIN vinyle ON produits.idProduit = vinyle.idProduitVinyle WHERE artisteVinyle LIKE :artisteProduit";

        $pdoStatement1 = $db->prepare($requete1);

        $pdoStatement1->execute(array(
            ':artisteProduit' => "%" . $artisteProduit . "%"
        ));
        $listeProduit = array();
        foreach ($pdoStatement1 as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            array_push( $listeProduit,$produit);
        }

        return $listeProduit;
    }

    //Fonction qui me permet de chercher un produit par genre
    public static function chercherProduitParGenre($genreProduit): ?array
    {
        $db = DataBaseConnection::getPdo();
        $requete1 = "SELECT * FROM produits INNER JOIN vinyle ON produits.idProduit = vinyle.idProduitVinyle WHERE genreVinyle LIKE :genreProduit";

        $pdoStatement1 = $db->prepare($requete1);

        $pdoStatement1->execute(array(
            ':genreProduit' => "%" . $genreProduit . "%"
        ));
        $listeProduit = array();
        foreach ($pdoStatement1 as $produitFormatTableau) {
            $produit = new Produit($produitFormatTableau['idProduit'], $produitFormatTableau['nomProduit'], $produitFormatTableau['descriptionProduit']
                , $produitFormatTableau['prixProduit'], $produitFormatTableau['stockProduit']);
            array_push( $listeProduit,$produit);
        }

        return $listeProduit;
    }


    //Fonction qui cherche par Genre


    //Fonction qui permet de retourner le bin de l'image
    public static function afficheImageProduit($idImage): mixed
    {
        $db = DataBaseConnection::getPdo();

        // Prépare la requête pour récupérer l'image
        $stmt = $db->prepare("SELECT * FROM imagessite WHERE id = :idImage");

        // Met la valeur dans un tableau
        $values = array(
            ':idImage' => $idImage
        );

        // Exécute la requête avec la valeur du tableau
        $result = $stmt->execute($values);

        if ($result == false) {
            //echo "L'image n'existe pas";
            return null;
        } else {
            $image = $stmt->fetch(PDO::FETCH_ASSOC);
            //echo '<img src="data:image/jpeg;base64,' . base64_encode($image['bin']) . '"/>';
            return $image['bin'];
        }
    }

    //Fonction qui permet de récupérer la classe d'un produit avec son id
    public static function getTypeProduit($idProduit)
    {
        //Je souhaite savoir le type du produit
        $db = DataBaseConnection::getPdo();

        $requeteAmplis = "SELECT * FROM produits JOIN 
        amplis ON produits.idProduit = amplis.idProduitAmplis WHERE produits.idProduit = :idProduit";
        $pdoStatement1 = $db->prepare($requeteAmplis);
        $pdoStatement1->execute(array(
            ':idProduit' => $idProduit
        ));


        $requetePlatine = "SELECT * FROM produits JOIN 
        platine ON produits.idProduit = platine.idProduitPlatine WHERE produits.idProduit = :idProduit";

        $pdoStatement2 = $db->prepare($requetePlatine);
        $pdoStatement2->execute(array(
            ':idProduit' => $idProduit
        ));

        $requeteVinyle = "SELECT * FROM produits JOIN
        vinyle ON produits.idProduit = vinyle.idProduitVinyle WHERE produits.idProduit = :idProduit";

        $pdoStatement3 = $db->prepare($requeteVinyle);
        $pdoStatement3->execute(array(
            ':idProduit' => $idProduit
        ));

        $requeteEnceinte = "SELECT * FROM produits JOIN
        enceinte ON produits.idProduit = enceinte.idProduitEnceinte WHERE produits.idProduit = :idProduit";

        $pdoStatement4 = $db->prepare($requeteEnceinte);
        $pdoStatement4->execute(array(
            ':idProduit' => $idProduit
        ));


        if ($pdoStatement1->rowCount() > 0) {
            return "Ampli";
        }
        if ($pdoStatement2->rowCount() > 0) {
            return "Platine";
        }
        if ($pdoStatement3->rowCount() > 0) {
            return "Vinyle";
        }
        if ($pdoStatement4->rowCount() > 0) {
            return "Enceinte";
        }
        return null;

    }


    //Fonction qui permet de supprimer un produit avec son id
    //Ordre de suppression
    //1)Table du type du produit
    //2)Le produit dans la table produit
    //3)Les images du produit dans la table image
    public static function supprimeProduitByID($idProduit): bool
    {
        //Je dois identifier quel produit c'est (si c'est une enceinte ou une platine)
        $typeProduit = self::getTypeProduit($idProduit);
        if ($typeProduit == null) {
            return false;
        } else if ($typeProduit == "Ampli") {
            $db = DataBaseConnection::getPdo();
            $idImage = self::getIdImageProduit($idProduit);

            //Première requete permet de supprimer de la table amplis
            $requete1 = "DELETE FROM amplis WHERE idProduitAmplis= :idProduit";
            $pdoStatement1 = $db->prepare($requete1);
            $pdoStatement1->execute(array(
                ':idProduit' => $idProduit
            ));

            //Deuxième requete permet de supprimer de la table produit
            $requete2 = "DELETE FROM produits WHERE idProduit = :idProduit";
            $pdoStatement2 = $db->prepare($requete2);
            $pdoStatement2->execute(array(
                ':idProduit' => $idProduit
            ));


            //Troisième requete permet de supprimer de la table image
            $requete3 = "DELETE FROM imagessite WHERE id = :idImage";
            $pdoStatement3 = $db->prepare($requete3);
            $pdoStatement3->execute(array(
                ':idImage' => $idImage
            ));

            if ($pdoStatement1 == null || $pdoStatement2 == null || $pdoStatement3 == null) {
                return false;
            } else {
                return true;
            }


        } else if ($typeProduit == "Platine") {
            $db = DataBaseConnection::getPdo();
            $idImage = self::getIdImageProduit($idProduit);
            //Première requete permet de supprimer de la table platine
            $requete1 = "DELETE FROM platine WHERE idProduitPlatine = :idProduit";
            $pdoStatement1 = $db->prepare($requete1);
            $pdoStatement1->execute(array(
                ':idProduit' => $idProduit
            ));

            //Deuxième requete permet de supprimer de la table produit
            $requete2 = "DELETE FROM produits WHERE idProduit = :idProduit";
            $pdoStatement2 = $db->prepare($requete2);
            $pdoStatement2->execute(array(
                ':idProduit' => $idProduit
            ));

            //Troisième requete permet de supprimer de la table image
            $requete3 = "DELETE FROM imagessite WHERE id = :idImage";
            $pdoStatement3 = $db->prepare($requete3);
            $pdoStatement3->execute(array(
                ':idImage' => $idImage
            ));

            if ($pdoStatement1 == null || $pdoStatement2 == null || $pdoStatement3 == null) {
                return false;
            } else {
                return true;
            }
        } else if ($typeProduit == "Vinyle") {
            $db = DataBaseConnection::getPdo();
            $idImage = self::getIdImageProduit($idProduit);
            //Première requete permet de supprimer de la table vinyle
            $requete1 = "DELETE FROM vinyle WHERE idProduitVinyle = :idProduit";
            $pdoStatement1 = $db->prepare($requete1);
            $pdoStatement1->execute(array(
                ':idProduit' => $idProduit
            ));
            //Deuxième requete permet de supprimer de la table produit
            $requete2 = "DELETE FROM produits WHERE idProduit = :idProduit";
            $pdoStatement2 = $db->prepare($requete2);
            $pdoStatement2->execute(array(
                ':idProduit' => $idProduit
            ));

            //Troisième requete permet de supprimer de la table image
            $requete3 = "DELETE FROM imagessite WHERE id = :idImage";
            $pdoStatement3 = $db->prepare($requete3);
            $pdoStatement3->execute(array(
                ':idImage' => $idImage
            ));

            if ($pdoStatement1 == null || $pdoStatement2 == null || $pdoStatement3 == null) {
                return false;
            } else {
                return true;
            }

        } else if ($typeProduit == "Enceinte") {
            $db = DataBaseConnection::getPdo();
            $idImage = self::getIdImageProduit($idProduit);
            //Première requete permet de supprimer de la table enceinte
            $requete1 = "DELETE FROM enceinte WHERE idProduitEnceinte = :idProduit";
            $pdoStatement1 = $db->prepare($requete1);
            $pdoStatement1->execute(array(
                ':idProduit' => $idProduit
            ));

            //Deuxième requete permet de supprimer de la table produit
            $requete2 = "DELETE FROM produits WHERE idProduit = :idProduit";
            $pdoStatement2 = $db->prepare($requete2);
            $pdoStatement2->execute(array(
                ':idProduit' => $idProduit
            ));

            //Troisième requete permet de supprimer de la table image
            $requete3 = "DELETE FROM imagessite WHERE id = :idImage";
            $pdoStatement3 = $db->prepare($requete3);
            $pdoStatement3->execute(array(
                ':idImage' => $idImage
            ));

            if ($pdoStatement1 == null || $pdoStatement2 == null || $pdoStatement3 == null) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    //Fonction qui permet de modifier un produit de type ampli
    public static function modifieUneAmpli($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockAmplis, $puissanceProduit, $sensibiliteAmplis, $marqueProduit): bool
    {
        $db = DataBaseConnection::getPdo();

        // Prépare la requête pour mettre à jour la table amplis
        $pdoStatement1 = $db->prepare("UPDATE amplis SET  puissanceAmplis = :puissanceProduit, sensibiliteAmplis = :sensibiliteAmplis, marqueAmplis = :marqueProduit WHERE idProduitAmplis = :idProduit");

        // Met les valeurs dans un tableau
        $values1 = array(
            ':puissanceProduit' => $puissanceProduit,
            ':sensibiliteAmplis' => $sensibiliteAmplis,
            ':marqueProduit' => $marqueProduit,
            ':idProduit' => $idProduit
        );

        // Exécute la requête avec le tableau de valeurs
        $result1 = $pdoStatement1->execute($values1);

        // Prépare la requête pour mettre à jour la table produits
        $pdoStatement2 = $db->prepare("UPDATE produits SET nomProduit = :nomProduit, prixProduit = :prixProduit, descriptionProduit = :descriptionProduit, stockProduit = :stockAmplis WHERE idProduit = :idProduit");

        // Met les valeurs dans un tableau
        $values2 = array(
            ':nomProduit' => $nomProduit,
            ':prixProduit' => $prixProduit,
            ':descriptionProduit' => $descriptionProduit,
            ':stockAmplis' => $stockAmplis,
            ':idProduit' => $idProduit
        );

        // Exécute la requête avec le tableau de valeurs
        $result2 = $pdoStatement2->execute($values2);

        if ($result1 == false || $result2 == false) {
            return false;
        } else {
            return true;
        }
    }

    //Fonction qui permet de modifier un produit de type enceinte
    public static function modifieUneEnceinte($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockAmplis, $puissanceEnceinte, $sensibiliteEnceinte, $marqueProduit): bool
    {
        $db = DataBaseConnection::getPdo();

        // Préparez la requête pour la table enceinte
        $pdoStatement1 = $db->prepare("UPDATE enceinte SET puissanceEnceinte = :puissance, sensibiliteEnceinte = :sensibilite, marqueEnceinte = :marque WHERE idProduitEnceinte = :id");

        // Assignez les valeurs à la requête en utilisant un tableau
        $values = array(
            ":puissance" => $puissanceEnceinte,
            ":sensibilite" => $sensibiliteEnceinte,
            ":marque" => $marqueProduit,
            ":id" => $idProduit
        );

        // Exécutez la requête
        $result1 = $pdoStatement1->execute($values);


        // Préparez la requête pour la table produits
        $pdoStatement2 = $db->prepare("UPDATE produits SET nomProduit = :nom, prixProduit = :prix, descriptionProduit = :description, stockProduit = :stock WHERE idProduit = :id");

        // Assignez les valeurs à la requête en utilisant un tableau
        $values = array(
            ":nom" => $nomProduit,
            ":prix" => $prixProduit,
            ":description" => $descriptionProduit,
            ":stock" => $stockAmplis,
            ":id" => $idProduit
        );

        // Exécutez la requête
        $result2 = $pdoStatement2->execute($values);
        if ($result1 == false || $result2 == false) {
            return false;
        }

        return true;
    }

    //Fonction qui me permet de modifier un produit de type platine
    public static function modifieUnePlatine($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockPlatine, $formatVinyle, $bluetooth, $marqueProduit): bool
    {
        $db = DataBaseConnection::getPdo();

        // Préparez la requête pour la table platine
        $pdoStatement = $db->prepare("UPDATE platine SET formatVinyle = :format, bluetooth = :bluetooth, marquePlatine = :marque WHERE idProduitPlatine = :id");

        // Assignez les valeurs à la requête en utilisant un tableau
        $values = array(
            ":format" => $formatVinyle,
            ":bluetooth" => $bluetooth,
            ":marque" => $marqueProduit,
            ":id" => $idProduit
        );

        // Exécutez la requête
        $result1 = $pdoStatement->execute($values);


        // Préparez la requête pour la table produits
        $pdoStatement2 = $db->prepare("UPDATE produits SET nomProduit = :nom, prixProduit = :prix, descriptionProduit = :description, stockProduit = :stock WHERE idProduit = :id");

        // Assignez les valeurs à la requête en utilisant un tableau
        $values = array(
            ":nom" => $nomProduit,
            ":prix" => $prixProduit,
            ":description" => $descriptionProduit,
            ":stock" => $stockPlatine,
            ":id" => $idProduit
        );

        // Exécutez la requête
        $result2 = $pdoStatement2->execute($values);
        if ($result1 == false || $result2 == false) {
            return false;
        }

        return true;
    }

    //Fonction qui me permet de modifier un produit de type vinyle
    public static function modifieUnVinyle($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockVinyle, $tailleVinyle, $artisteVinyle, $genreVinyle): bool
    {
        $db = DataBaseConnection::getPdo();

        // Prépare la requête pour mettre à jour les informations du vinyle
        $pdoStatement = $db->prepare("UPDATE vinyle SET artisteVinyle = :artisteVinyle, tailleVinyle = :tailleVinyle, genreVinyle = :genreVinyle WHERE idProduitVinyle = :idProduit");

        // Met les valeurs dans un tableau
        $values = array(
            ':artisteVinyle' => $artisteVinyle,
            ':tailleVinyle' => $tailleVinyle,
            ':genreVinyle' => $genreVinyle,
            ':idProduit' => $idProduit
        );

        // Exécute la requête avec les valeurs du tableau
        $result = $pdoStatement->execute($values);


        // Prépare la requête pour mettre à jour les informations du produit
        $pdoStatement2 = $db->prepare("UPDATE produits SET nomProduit = :nomProduit, prixProduit = :prixProduit, descriptionProduit = :descriptionProduit, stockProduit = :stockProduit WHERE idProduit = :idProduit");

        // Met les valeurs dans un tableau
        $values2 = array(
            ':nomProduit' => $nomProduit,
            ':prixProduit' => $prixProduit,
            ':descriptionProduit' => $descriptionProduit,
            ':stockProduit' => $stockVinyle,
            ':idProduit' => $idProduit
        );

        // Exécute la requête avec les valeurs du tableau
        $result2 = $pdoStatement2->execute($values2);

        if ($result2 == false || $result == false) {
            return false;
        } else {
            return true;
        }
    }

    public
    static function getProduitByID($idProduit): ?Produit
    {
        //prepared statement
        $type = self::getTypeProduit($idProduit);

        if ($type == "Vinyle") {
            $db = DataBaseConnection::getPdo();
            $requete = "SELECT * FROM produits join vinyle on produits.idProduit = vinyle.idProduitVinyle WHERE idProduit = :id";
            $pdoStatement = $db->prepare($requete);
            $values = array(
                ":id" => $idProduit
            );
            $pdoStatement->execute($values);
            if ($pdoStatement->rowCount() > 0) {
                $resultat = $pdoStatement->fetch();
                return new Vinyle($resultat["idProduit"], $resultat["nomProduit"], $resultat["descriptionProduit"], $resultat["prixProduit"], $resultat["stockProduit"], $resultat["tailleVinyle"], $resultat["artisteVinyle"], $resultat["genreVinyle"]);
            }
        } elseif ($type == "Ampli") {
            $db = DataBaseConnection::getPdo();
            $requete = "SELECT * FROM produits join amplis on produits.idProduit = amplis.idProduitAmplis WHERE idProduit = :id";
            $pdoStatement = $db->prepare($requete);
            $values = array(
                ":id" => $idProduit
            );
            $pdoStatement->execute($values);
            if ($pdoStatement->rowCount() > 0) {
                $resultat = $pdoStatement->fetch();
                return new Amplis($resultat["idProduit"], $resultat["nomProduit"], $resultat["descriptionProduit"], $resultat["prixProduit"], $resultat["stockProduit"], $resultat["puissanceAmplis"], $resultat["sensibiliteAmplis"], $resultat["marqueAmplis"]);
            }
        } elseif ($type == "Platine") {
            $db = DataBaseConnection::getPdo();
            $requete = "SELECT * FROM produits join platine on produits.idProduit = platine.idProduitPlatine WHERE idProduit = :id";
            $pdoStatement = $db->prepare($requete);
            $values = array(
                ":id" => $idProduit
            );
            $pdoStatement->execute($values);
            if ($pdoStatement->rowCount() > 0) {
                $resultat = $pdoStatement->fetch();
                return new Platine($resultat["idProduit"], $resultat["nomProduit"], $resultat["descriptionProduit"], $resultat["prixProduit"], $resultat["stockProduit"], $resultat["formatVinyle"], $resultat["bluetooth"], $resultat["marquePlatine"]);
            }
        } elseif ($type == "Enceinte") {
            $db = DataBaseConnection::getPdo();
            $requete = "SELECT * FROM produits join enceinte on produits.idProduit = enceinte.idProduitEnceinte WHERE idProduit = :id";
            $pdoStatement = $db->prepare($requete);
            $values = array(
                ":id" => $idProduit
            );
            $pdoStatement->execute($values);
            if ($pdoStatement->rowCount() > 0) {
                $resultat = $pdoStatement->fetch();
                return new Enceinte($resultat["idProduit"], $resultat["nomProduit"], $resultat["descriptionProduit"], $resultat["prixProduit"], $resultat["stockProduit"], $resultat["sensibiliteEnceinte"], $resultat["puissanceEnceinte"], $resultat["marqueEnceinte"]);
            }
        }
        return null;
    }

    public
    static function getListeArtistesVinyle()
    {
        $db = DataBaseConnection::getPdo();
        $requete = "SELECT DISTINCT artisteVinyle FROM vinyle";
        $pdoStatement = $db->query($requete);
        if ($pdoStatement->rowCount() > 0) {
            $resultat = $pdoStatement->fetchAll();
            return $resultat;
        }
        return null;
    }

    public
    static function getListeGenresVinyle()
    {
        $db = DataBaseConnection::getPdo();
        $requete = "SELECT DISTINCT genreVinyle FROM vinyle";
        $pdoStatement = $db->query($requete);
        if ($pdoStatement->rowCount() > 0) {
            $resultat = $pdoStatement->fetchAll();

            //genre séparé par des virgules dans la base de données
            $listeGenres = array();

            foreach ($resultat as $genre) {
                $listeGenres = array_merge($listeGenres, explode(", ", $genre["genreVinyle"]));
            }

            return array_unique($listeGenres);
        }
        return null;
    }

//Fonction qui me permet de récupérer la liste des marques d'amplis (pour le filtre)
    public
    static function getListeMarquesAmplis()
    {
        $db = DataBaseConnection::getPdo();
        $requete = "SELECT DISTINCT marqueAmplis FROM amplis";
        $pdoStatement = $db->query($requete);
        if ($pdoStatement->rowCount() > 0) {
            $resultat = $pdoStatement->fetchAll();
            return $resultat;
        }
        return null;
    }

    public
    static function getListeMarquesPlatine()
    {
        $db = DataBaseConnection::getPdo();
        $requete = "SELECT DISTINCT marquePlatine FROM platine";
        $pdoStatement = $db->query($requete);
        if ($pdoStatement->rowCount() > 0) {
            $resultat = $pdoStatement->fetchAll();
            return $resultat;
        }
        return null;
    }

    public
    static function getListeMarquesEnceinte()
    {
        $db = DataBaseConnection::getPdo();
        $requete = "SELECT DISTINCT marqueEnceinte FROM enceinte";
        $pdoStatement = $db->query($requete);
        if ($pdoStatement->rowCount() > 0) {
            $resultat = $pdoStatement->fetchAll();
            return $resultat;
        }
        return null;
    }
}

?>
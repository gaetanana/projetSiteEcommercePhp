<?php
namespace App\eCommerce\Model\DataObject\produit;

use App\eCommerce\Model\DataObject\produit\Produit;


class Vinyle extends Produit{

    private $tailleVinyle;
    private $artistVinyle;

    private $genreVinyle;

    //Constructeur
    public function __construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $tailleVinyle, $artistVinyle,$genreVinyle)
    {
        parent::__construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit);
        $this->tailleVinyle = $tailleVinyle;
        $this->artistVinyle = $artistVinyle;
        $this->genreVinyle = $genreVinyle;
    }

    /**
     * @return mixed
     */
    public function getTailleVinyle()
    {
        return $this->tailleVinyle;
    }

    /**
     * @return mixed
     */
    public function getArtistVinyle()
    {
        return $this->artistVinyle;
    }

    public function getGenreVinyle()
    {
        return $this->genreVinyle;
    }

    public function getGenreArray()
    {
        return explode(", ",$this->genreVinyle);
    }



}


?>
<?php

namespace App\eCommerce\Model\DataObject\produit;

class Amplis extends Produit{

    private $puissanceAmpli;
    private $sensibiliteAmpli;
    private $marqueAmpli;

    //Constructeur
    public function __construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit
        , $puissanceAmpli, $sensibiliteAmpli, $marqueAmpli)
    {
        parent::__construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit);
        $this->puissanceAmpli = $puissanceAmpli;
        $this->sensibiliteAmpli = $sensibiliteAmpli;
        $this->marqueAmpli = $marqueAmpli;
    }

    //Getters
    public function getPuissanceAmplis()
    {
        return $this->puissanceAmpli;
    }

    public function getSensibiliteAmplis(){
        return $this->sensibiliteAmpli;
    }

    public function getMarqueAmplis(){
        return $this->marqueAmpli;
    }




}

?>
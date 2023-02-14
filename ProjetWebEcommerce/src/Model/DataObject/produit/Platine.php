<?php

namespace App\eCommerce\Model\DataObject\produit;

use App\eCommerce\Model\DataObject\produit\Produit;

class Platine extends Produit
{

    private $formatVinyle;
    private $bluetooth;

    private $marquePlatine;

    //Constructeur
    public function __construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $formatVinyle, $bluetooth,$marquePlatine)
    {
        parent::__construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit);
        $this->formatVinyle = $formatVinyle;
        $this->bluetooth = $bluetooth;
        $this->marquePlatine = $marquePlatine;
    }


    //Getters
    public function getFormatVinyle()
    {
        return $this->formatVinyle;
    }



    public function getBluetooth()
    {
        return $this->bluetooth;
    }

    public function getMarquePlatine()
    {
        return $this->marquePlatine;
    }

}


?>
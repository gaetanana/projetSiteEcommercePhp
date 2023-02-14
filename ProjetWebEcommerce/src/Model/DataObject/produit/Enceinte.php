<?php
namespace App\eCommerce\Model\DataObject\produit;

use App\eCommerce\Model\DataObject\produit\Produit;

class Enceinte extends Produit{

    private $sensibiliteEnceinte;
    private $puissanceEnceinte;

    private $marqueEnceinte;

    //Constructeur
    public function __construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit, $sensibiliteEnceinte, $puissanceEnceinte,$marqueEnceinte)
    {
        parent::__construct($idProduit, $nomProduit, $descriptionProduit, $prixProduit, $stockProduit);
        $this->sensibiliteEnceinte = $sensibiliteEnceinte;
        $this->puissanceEnceinte = $puissanceEnceinte;
        $this->marqueEnceinte = $marqueEnceinte;
    }

    //Getters
    public function getSensibiliteEnceinte()
    {
        return $this->sensibiliteEnceinte;
    }

    public function getPuissanceEnceinte(){
        return $this->puissanceEnceinte;
    }

    public function getMarqueEnceinte(){
        return $this->marqueEnceinte;
    }

}

?>
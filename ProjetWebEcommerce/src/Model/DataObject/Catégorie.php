<?php
namespace App\eCommerce\Model\DataObject;

class Catégorie{

    private $idCategorie;

    private $nomCategorie;



    public function __construct($idCategorie, $nomCategorie){
        $this->idCategorie = $idCategorie;
        $this->nomCategorie = $nomCategorie;
    }




}

?>
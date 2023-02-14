<?php

namespace App\eCommerce\Model\DataObject\produit;

class Produit
{

    private $idProduit;
    private $nomProduit;
    private $descriptionProduit;
    private $prixProduit;
    private $stockProduit;
    private $idimageProduit;
    private $idCategorie; //Clé étrangère


    /**
     * Produit constructor.
     * @param $idProduit
     * @param $nomProduit
     * @param $descriptionProduit
     * @param $prixProduit
     * @param $imageProduit
     * @param $idCategorie
     */
    public function __construct($idProduit,$nomProduit, $descriptionProduit, $prixProduit, $stockProduit)
    {
        $this->idProduit = $idProduit;
        $this->nomProduit = $nomProduit;
        $this->descriptionProduit = $descriptionProduit;
        $this->prixProduit = $prixProduit;
        $this->stockProduit = $stockProduit;
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @return mixed
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * @param mixed $nomProduit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }

    /**
     * @return mixed
     */
    public function getDescriptionProduit()
    {
        return $this->descriptionProduit;
    }

    /**
     * @param mixed $descriptionProduit
     */
    public function setDescriptionProduit($descriptionProduit)
    {
        $this->descriptionProduit = $descriptionProduit;
    }

    /**
     * @return mixed
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * @return mixed
     */
    public function getStockProduit()
    {
        return $this->stockProduit;
    }

    /**
     * @return mixed
     */






}

?>

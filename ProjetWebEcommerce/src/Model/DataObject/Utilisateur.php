<?php
namespace App\eCommerce\Model\DataObject;

class Utilisateur{

    private string $idClient;
    private string $loginClient;
    private string $mdpClient;
    private string $nomClient;
    private string $prenomClient;
    private string $adresseMailClient;
    private string $adresseClient;
    private string $statutClient; //Les admins ou les clients lambda
    private string $soldeClient;

    public function __construct($idClient,string $loginClient, string $mdpClient, string $nomClient, string $prenomClient, string $adresseMailClient,string $adresseClient)
    {
        $this->idClient = $idClient;
        $this->loginClient = $loginClient;
        $this->mdpClient = $mdpClient;
        $this->nomClient = $nomClient;
        $this->prenomClient = $prenomClient;
        $this->adresseMailClient = $adresseMailClient;
        $this->adresseClient = $adresseClient;
        $this->statutClient = "client";
        $this->soldeClient = 0;
    }

    /**
     * @return string
     */
    public function getIdClient(): string
    {
        return $this->idClient;
    }





    /**
     * @return string
     */
    public function getLoginClient(): string
    {
        return $this->loginClient;
    }

    /**
     * @return string
     */
    public function getMdpClient(): string
    {
        return $this->mdpClient;
    }

    /**
     * @return string
     */
    public function getNomClient(): string
    {
        return $this->nomClient;
    }

    /**
     * @return string
     */
    public function getPrenomClient(): string
    {
        return $this->prenomClient;
    }

    /**
     * @return string
     */
    public function getAdresseMailClient(): string
    {
        return $this->adresseMailClient;
    }

    /**
     * @return string
     */
    public function getAdresseClient(): string
    {
        return $this->adresseClient;
    }

    /**
     * @return string
     */
    public function getStatutClient(): string
    {
        return $this->statutClient;
    }

    /**
     * @return string
     */



    public function getSoldeClient(): string
    {
        return $this->soldeClient;
    }





   public function toString():string{
        return " loginClient : ".$this->loginClient." mdpClient :";
   }


}

?>
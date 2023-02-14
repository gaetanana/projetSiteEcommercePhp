<?php

class Panier{

    private string $loginUtilisateur;
    private array $panier; //Le panier sera une liste de produit

    public function __construct(string $loginUtilisateur, array $panier)
    {
        $this->loginUtilisateur = $loginUtilisateur;
        $this->panier = $panier;
    }

    public function getLoginUtilisateur(): string
    {
        return $this->loginUtilisateur;
    }


    public function getPanier(): array
    {
        return $this->panier;
    }


}


?>
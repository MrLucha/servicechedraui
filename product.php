<?php

class Product
{
    public int $idList;
    public int $idProduct;
    public string $price;
    public string $link;

    // public function __construct(int $idList, int $idProduct, int $price, string $link)
    // {
    //     $this->idList = $idList;
    //     $this->idProduct = $idProduct;
    //     $this->price = $price;
    //     $this->link = $link;
    // }

    //Setters
    public function setIdList(int $idList): void
    {
        $this->idList = $idList;
    }

    public function setIdProduct(int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    //Getters
    public function getIdList(): int
    {
        return $this->idList;
    }

    public function getIdProduct(): int
    {
        return $this->idProduct;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function getLink(): string
    {
        return $this->link;
    }
    
    // Declaración de un método
    public function mostrarVar() {
        //echo $this->var;
    }
}

?>
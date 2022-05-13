<?php

namespace Entities;

use Exception;

class Basket
{
    private $products;
    private $offers;

    public function __construct(Offer $offers)
    {
        $this->offers = $offers;
        $this->products = array();
    }

    // This function will check if the new product details has any duplicate
    private function checkDuplicate(Product $product)
    {
        foreach($this->products as $addedProducts){
            if($addedProducts->__getProductCode() == $product->__getProductCode()){
                return true;
            }
            if($addedProducts->__getProductName() == $product->__getProductName()){
                return true;
            }
        }

        return false;
    }

    // This function is used to add a product
    public function AddProduct(Product $product)
    {
        if ($this->checkDuplicate($product)) {
            throw new Exception('Duplicate Product',422);
        }

        array_push($this->products, $product);
    }

    //This is to calculate the final total after deducting any offers
    //Note: Assumption is that the user validation for eligibility of offer is done prior
    public function Total()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice = $totalPrice + $product->__getProductPrice();
        }

        return $totalPrice - $this->offers->getAmount($totalPrice);
    }

    // fetch the added products
    public function _getProducts()
    {
        return $this->products;
    }
}

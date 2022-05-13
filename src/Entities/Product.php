<?php

namespace Entities;

class Product
{
    private $productCode;
    private $productName;
    private $productPrice;

    // we inject the products when we initialise this class
    public function __construct($productCode, $productName, $productPrice)
    {
        $this->productCode = $productCode;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
    }

    //we use getters and setters for security
    public function __getProductCode()
    {
        return $this->productCode;
    }

    public function __setProductCode($productCode, $value)
    {
        if (property_exists($this, $productCode)) {
            $this->productCode = $value;
        }

        return $this;
    }

    public function __getProductName()
    {
            return $this->productName;
    }

    public function __setProductName($productName, $value)
    {
        if (property_exists($this, $productName)) {
            $this->productName = $value;
        }

        return $this;
    }

    public function __getProductPrice()
    {
        return $this->productPrice;
    }

    public function __setProductPrice($productPrice, $value)
    {
        if (property_exists($this, $productPrice)) {
            $this->productPrice = $value;
        }

        return $this;
    }
}

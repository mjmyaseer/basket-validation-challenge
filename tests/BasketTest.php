<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Entities\Basket;
use Entities\Offer;
use Entities\Product;

final class BasketTest extends TestCase
{
    /**
     *initialize the class and check if basic constructors are working
     */
    public function testBucketInit(): void
    {
        $offer = new Offer("testoffer", 0.2,true);

        $this->assertInstanceOf(
            Basket::class,
            new Basket($offer)
        );
    }

    /**
     * We create the initial test data in this function and use them in all our test cases
     * @return array
     */
    public function testBucketAddProduct(): array
    {
        $offer = new Offer("testoffer", 0.2,true);
        $basket = new Basket($offer);
        $product = new Product("12345", "testproduct", 300);

        $basket->AddProduct($product);

        $addedProducts = $basket->_getProducts();
        foreach($addedProducts as $p){
            $this->assertInstanceOf(Product::class, $p);
        }

        return ['products' => $addedProducts,
            'basket' => $basket,
            'product' => $product,
            'offer' => $offer];
    }

    /**
     * We are instructing that we need the results from testBucketAddProduct function
     * before proceeding to this
     * @depends testBucketAddProduct
     * @param array $addedProducts
     */
    public function testAddedProduct(array $addedProducts){
        $products = $addedProducts['product']->__getProductCode();

        $this->assertSame('12345', $products);
    }

    /**
     * We are instructing that we need the results from testBucketAddProduct function
     * before proceeding to this
     * @depends testBucketAddProduct
     * @param array $addedProducts
     * Here we calculate the total based on the assumption user is eligible for offer.
     */
    public function testBucketTotalEligibleOffer(array $addedProducts)
    {
        $total = $addedProducts['basket']->Total();
        $this->assertSame(240.0, $total);
    }

    /**
     * * We are instructing that we need the results from testBucketAddProduct function
     * before proceeding to this
     * @depends testBucketAddProduct
     * @param array $addedProducts
     * Here we override the user as ineligible for the offer and check if the amount
     * is being subtracted.
     */
    public function testBucketTotalNotEligibleOffer(array $addedProducts)
    {
        $addedProducts['offer']->__setOfferEligible(false);
        $total = $addedProducts['basket']->Total();
        $this->assertSame(300, $total);
    }

    /**
     * @depends testBucketAddProduct
     * Here we check if the system is able to identify if product being added has duplicates
     */
    public function testAddDuplicateProduct(array $addedProducts)
    {
        $this->expectExceptionMessage('Duplicate Product');
        $product = new Product("12345", "testproduct", 300);
        $addedProducts['basket']->addProduct($product);
    }
}

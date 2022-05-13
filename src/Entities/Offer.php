<?php

namespace Entities;

class Offer
{
    private $offerName;
    private $offerPercentage;
    private $offerEligible = false;

    // we inject the offers when we initialise this class
    public function __construct($offerName, $offerPercentage, $offerEligible)
    {
        $this->offerName = $offerName;
        $this->offerPercentage = $offerPercentage;
        $this->offerEligible = $offerEligible;
    }

    //we use getters and setters for security
    public function __getOfferName($offerName)
    {
        if (property_exists($this, $offerName)) {
            return $this->offerName;
        }
    }

    public function __setOfferName($offerName, $value)
    {
        if (property_exists($this, $offerName)) {
            $this->offerName = $value;
        }

        return $this;
    }

    public function __getOfferValue($offerPercentage)
    {
            return $this->offerPercentage;
    }

    public function __setOfferValue($offerPercentage, $value)
    {
        if (property_exists($this, $offerPercentage)) {
            $this->offerPercentage = $value;
        }

        return $this;
    }

    public function __getOfferEligble($offerEligible)
    {
        return $this->offerPercentage;
    }

    public function __setOfferEligible($value)
    {
            $this->offerPercentage = $value;

        return $this;
    }

    //If the user is eligible for offer, we calculate the offer amount and send to the total function.
    //Note: Assumption is that the user validation for eligibility of offer is done prior
    public function getAmount($amount)
    {
        if($this->offerEligible){
            return $amount * $this->offerPercentage;
        }
        return 0;
    }
}

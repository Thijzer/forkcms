<?php

namespace Backend\Modules\Immo\Model;

class Premise
{
    private $availabilityType;
    private $premiseType;
    private $contact;
    private $address;
    private $price;

    public function __construct(
        AvailabilityType $availabilityType,
        PremiseType $premiseType,
        Contact $contact,
        Address $address,
        string $price
    ) {
        $this->availabilityType = (string) $availabilityType;
        $this->premiseType = (string) $premiseType;
        $this->price = $price;
        $this->address = $address;
        $this->contact = $contact;
    }

    public function getAvailabilityType() : AvailabilityType
    {
        return new AvailabilityType($this->availabilityType);
    }

    public function setAvailabilityType(AvailabilityType $availabilityType)
    {
        $this->availabilityType = (string) $availabilityType;
    }

    public function getPremiseType() : PremiseType
    {
        return new PremiseType($this->premiseType);
    }

    public function setPremiseType(PremiseType $premiseType)
    {
        $this->premiseType = $premiseType;
    }

    public function getPrice() : string
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }
}

<?php

namespace Backend\Modules\Immo\Model;

class Address
{
    private $street;
    private $houseNumber;
    private $zipCode;
    private $city;
    private $country;

    public function __construct(
        string $street,
        string $houseNumber,
        string $zipCode,
        string $city,
        Country $country = null
    ) {
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->country = $country;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
}

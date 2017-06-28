<?php

namespace Backend\Modules\Immo\Model;

class Country
{
    private $country;

    public function __construct(string $country) {

        // @todo validation
        $this->country = $country;
    }

    public function __toString()
    {
        return $this->country;
    }
}

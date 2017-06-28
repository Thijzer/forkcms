<?php

namespace Backend\Modules\Immo\Model;

class PremiseType
{
    const APARTMENT = 'apartment';
    const HOUSE = 'house';
    const GROUND = 'ground';
    const OFFICE = 'office';
    const CAR_PLACE = 'car_place';

    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function is(string $type) : bool
    {
        return $this->type === $type;
    }

    public static function getAllTypes() : array
    {
        return array_values((new \ReflectionClass(__CLASS__))->getConstants());
    }

    public static function getAllTypesList() : array
    {
        $types = static::getAllTypes();
        return array_combine($types, $types);
    }
}

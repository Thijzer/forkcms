<?php

namespace Backend\Modules\Immo\Model;

class AvailabilityType
{
    const SALE = 'sale';
    const RENT = 'rent';

    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function is(string $type)
    {
        return $this->type === $type;
    }

    public static function getAllTypes()
    {
        return [
            self::SALE,
            self::RENT,
        ];
    }
}

<?php

namespace Backend\Modules\Immo\Model;

class Language
{
    private $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function __toString()
    {
        return $this->language;
    }
}

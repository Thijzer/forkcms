<?php

namespace Backend\Modules\Immo\Model;

class EmailAddress
{
    private $email;

    public function __construct(string $email)
    {
        $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($filteredEmail === false && explode('@', $filteredEmail) < 2) {
            throw new \Exception(sprintf('Invalid email-address : %s', $email));
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }
}

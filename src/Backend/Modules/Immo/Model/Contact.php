<?php

namespace Backend\Modules\Immo\Model;

class Contact
{
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $language;

    public function __construct(
        string $firstName,
        string $lastName,
        EmailAddress $email,
        string $phoneNumber = null,
        Language $language = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->language = $language;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function __toString()
    {
        return implode(' ', [$this->lastName, $this->firstName]);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(EmailAddress $email)
    {
        $this->email = $email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }
}

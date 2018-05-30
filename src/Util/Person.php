<?php
/**
 * Created by PhpStorm.
 * User: Admin Stagiaire
 * Date: 29/05/2018
 * Time: 09:44
 */

namespace App\Util;


class Person
{
    private $name;

    private $lastName;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    function __toString()
    {
        return "Personne : " . $this->getLastName() . ' / ' . $this->getName();
    }


}
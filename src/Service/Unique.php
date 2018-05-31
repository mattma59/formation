<?php
/**
 * Created by PhpStorm.
 * User: Admin Stagiaire
 * Date: 31/05/2018
 * Time: 14:50
 */

namespace App\Service;


class Unique
{
    private $message = 'Hello, je suis un service';

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
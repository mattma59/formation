<?php
/**
 * Created by PhpStorm.
 * User: Admin Stagiaire
 * Date: 01/06/2018
 * Time: 09:10
 */

namespace App\EventListener;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ExampleListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        dump($event);
    }
}
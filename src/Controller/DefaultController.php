<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/default", name="app_default_index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    /**
     * @Route("/autowiring", name="app_default_autowiring")
     */
    public function autowiring(LoggerInterface $logger)
    {
        $logger->info('test information');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);

    }
}

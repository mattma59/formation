<?php

namespace App\Controller;

use App\Service\Unique;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServiceController extends Controller
{
    /**
     * @Route("/service", name="service_index")
     */
    public function index(Unique $unique)
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'message' => $unique->getMessage()
        ]);
    }
}

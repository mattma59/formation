<?php

namespace App\Controller;

use App\Util\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemplateController extends Controller
{
    /**
     * @Route("/template/{code}", name="template_index")
     */
    public function index($code = null)
    {

        $liste = [
            'Stéphane',
            'Matthieu',
            'Thomas',
            'Teddy',
            'Pierre',
            'Carine',
            'Lucie',
            'Rémy',
            'Nicolas',
            'Dimitri',
            'Johann'
        ];

        $tab = [];

        $person = new Person();
        $person->setLastName('Marcel');
        $person->setName('Orchi');

        return $this->render('template/index.html.twig', [
            'controller_name' => 'TemplateController',
            'liste' => $liste,
            'tab' => $tab,
            'person' => $person,
            'code' => $code
        ]);
    }

    public function video($code)
    {
        sleep(7);
        return $this->render('template/video.html.twig', [
           'code' => $code
        ]);
    }
}

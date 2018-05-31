<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class SecureAreaController
 * @package App\Controller
 * @Route("/admin")
 */
class SecureAreaController extends Controller
{
    /**
     * @Route("/secure", name="securearea_index")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Accès interdit');


        return $this->render('secure_area/index.html.twig', [
            'controller_name' => 'SecureAreaController',
        ]);
    }


    /**
     * @Route("/secure/annotation", name="securearea_annotation")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function annotation()
    {

        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Accès interdit');


        return $this->render('secure_area/index.html.twig', [
            'controller_name' => 'SecureAreaController',
        ]);
    }


    /**
     * @Route("/secure/twig", name="securearea_twig")
     */
    public function twig()
    {

        return $this->render('secure_area/index.html.twig', [
            'controller_name' => 'SecureAreaController',
        ]);
    }
}

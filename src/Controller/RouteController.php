<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RouteController extends Controller
{
    /**
     * @Route(
     *     "/route/{name}.{_format}",
     *     name="app_route_index",
     *     defaults={"name":"matthieu", "_format":"html"},
     *     requirements={
     *          "name"="[a-z]+",
     *          "_format"="html|php"
     *     })
     */
    public function index($name, $_controller)
    {
        $name = ucfirst($name);

        dump($_controller);

        $number_url = $this->generateUrl('app_route_number', ['number' => 10]);

        return $this->render('route/index.html.twig', [
            'controller_name' => 'RouteController',
            'name' => $name,
            'number_url' => $number_url
        ]);
    }

    /**
     * @Route(
     *     "/route/{number}",
     *     name="app_route_number",
     *     requirements={
     *          "number"="[0-9]+"
     *     })
     * //@Method({"POST"})
     */
    public function number($number = 100)
    {
        return $this->render('route/number.html.twig', [
            'controller_name' => 'RouteController',
            'number' => $number
        ]);

    }
}

<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Translation\TranslatorInterface;

class I18nController extends Controller
{
    /**
     * @Route("/{_locale}/i18n", name="i18n_index")
     */
    public function index(TranslatorInterface $translator)
    {
        $informations = $translator->trans('informations');

        $count = 15;

        $countMaj = 85;


        return $this->render('i18n/index.html.twig', [
            'controller_name' => 'I18nController',
            'informations' => $informations,
            'count' => $count,
            'countmaj' => $countMaj
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CtrlController extends Controller
{
    /**
     * @Route("/ctrl", name="ctrl_index")
     */
    public function index(Request $request)
    {
        $pagination = $this->generateUrl('ctrl_index', ['page' => 2]); //?page=2
        $notFound = $this->generateUrl('ctrl_index', ['page' => 404]);
        $ie = $this->generateUrl('ctrl_index', ['page' => 500]);
        $google = $this->generateUrl('ctrl_index', ['page' => 'google']);

        if ($request->query->has('page')) {
            $page = $request->query->get('page');

            switch ($page) {
                case '404':
                    return $this->redirectToRoute('ctrl_notfound');
                    break;
                case '500':
                    return $this->redirectToRoute('ctrl_ie');
                    break;
                case 'google':
                    return $this->redirect('http://www.google.fr');
                    break;
                default:
                    dump('page=' . $page);
            }



        }

        return $this->render('ctrl/index.html.twig', [
            'controller_name' => 'CtrlController',
            'pagination' => $pagination,
            'notfound' => $notFound,
            'ie' => $ie,
            'google' => $google
        ]);
    }

    /**
     * @Route("/ctrl/404", name="ctrl_notfound")
     */
    public function notFound()
    {
        throw $this->createNotFoundException('La page de Formation n\'existe pas');
    }

    /**
     * @Route("/ctrl/500", name="ctrl_ie")
     */
    public function internalError()
    {
        throw new \Exception('Ceci est une erreur de type 500');
    }

    /**
     * @Route("/ctrl/response", name="ctrl_response")
     */
    public function withoutTemplate()
    {
        return new Response('<html><body><h3>TEst template responbse</h3></body>');
    }

    /**
     * @Route("/ctrl/json", name="ctrl_json")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function json_response()
    {
        return $this->json([
           'name' => 'toto',
            'age' => 15
        ]);
    }

    /**
     * @Route("/ctrl/download", name="ctrl_download")
     */
    public function download()
    {
        return $this->file(__DIR__ . '/../../public/download/file.txt');
    }

    /**
     * @Route("/ctrl/session", name="ctrl_session")
     */
    public function session(Request $request, SessionInterface $session)
    {
        if ($request->query->has('save')) {
            $session->set('name', 'Jean-MichMich');
        }

        if ($request->query->has('remove')) {
            $session->remove('name');
        }

        if ($request->query->has('flash')) {
            $this->addFlash('notice', 'Voilà la noticce');
            return $this->redirectToRoute('ctrl_session');
        }

        $name = $session->get('name', 'boulet');

        return $this->render('ctrl/session.html.twig', [
            'controller_name' => 'CtrlController',
            'name' => $name
        ]);
    }
}

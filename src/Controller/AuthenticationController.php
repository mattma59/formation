<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class AuthenticationController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class AuthenticationController extends Controller
{
    /**
     * @Route("/", name="auth_index")
     */
    public function index()
    {
        return $this->render('authentication/index.html.twig', [
            'controller_name' => 'AuthenticationController',
        ]);
    }

    /**
     * @Route("/login", name="auth_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $lastError = $utils->getLastAuthenticationError();

        $form = $this->createFormBuilder()
                    ->setAction($this->generateUrl('auth_check'))
                    ->add('login', TextType::class, ['label' => 'form.auth.login'])
                    ->add('password', PasswordType::class, ['label' => 'form.auth.password'])
                    ->add('save', SubmitType::class, ['label' => 'form.auth.save'])
                    ->getForm();

        return $this->render('authentication/login.html.twig', [
            //'controller_name' => 'AuthenticationController',
            'form' => $form->createView(),
            'errors' => $lastError
        ]);
    }

    /**
     * @Route("/check", name="auth_check")
     */
    public function check()
    {
        return new Response();
    }

    /**
     * @Route("/logout", name="auth_logout")
     */
    public function logout()
    {
        return new Response();
    }
}

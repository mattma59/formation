<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormController extends Controller
{
    /**
     * @Route("/form", name="form_index")
     */
    public function index()
    {

        $years = [];
        for ($i = 2018; $i >= 1850; $i--) {
            $years[] = $i;
        }

        $form = $this->createFormBuilder()
                    ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])
                    ->add('lastname', TextType::class, ['attr' => ['class' => 'form-control']])
                    ->add('biographie', TextareaType::class, ['attr' => ['class' => 'form-control']])
                    ->add('date', DateType::class, ['years' => $years])
                    ->add('birthday', BirthdayType::class)
                    ->add('save', SubmitType::class, ['attr' => ['class' => 'btn-primary']])
                    ->getForm();

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }
}

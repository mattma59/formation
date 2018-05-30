<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormController extends Controller
{
    /**
     * @Route("/form", name="form_index")
     */
    public function index(Request $request)
    {

        $years = [];
        for ($i = 2018; $i >= 1850; $i--) {
            $years[] = $i;
        }

        $form = $this->createFormBuilder()
                    ->add('name', TextType::class, [
                        'label' => 'Nom',
                        'label_attr' => [
                            'class' => 'col-sm-2 col-form-label'
                        ],
                        'data' => 'Défaut',
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('lastname', TextType::class, [
                        'label' => 'Prénom',
                        'label_attr' => [
                            'class' => 'col-sm-2 col-form-label'
                        ],
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('biographie', TextareaType::class, [
                        'label' => 'Biographie',
                        'label_attr' => [
                            'class' => 'col-sm-2 col-form-label'
                        ],
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('date', DateType::class, [
                        'label' => 'Date',
                        'label_attr' => [
                            'class' => 'col-sm-2 col-form-label'
                        ],
                        'years' => $years,
                        'widget' => 'single_text',
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('birthday', BirthdayType::class, [
                        'label' => 'Date de naissance',
                        'label_attr' => [
                            'class' => 'col-sm-2 col-form-label'
                        ],
                        'widget' => 'single_text',
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('save', SubmitType::class, [
                        'label' => 'Sauvegarder',
                        'attr' => [
                            'class' => 'btn-outline-primary'
                        ]
                    ])
                    ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
        }

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }
}

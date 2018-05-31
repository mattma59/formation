<?php

namespace App\Controller;

use App\Document\User;
use App\Form\UserType;
use App\Service\Checkunique;
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

    /**
     * @Route("/user", name="form_userform")
     */
    public function userForm(Request $request, Checkunique $checkunique)
    {
        $errorMessage = null;

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, [
            'label' => 'Sauvegarder',
            'attr' => [
                'class' => 'btn-outline-primary'
            ]
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            if ($checkunique->isUniqueValue(User::class, 'lastname', $user->getLastname())) {

                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($user);
                $dm->flush();

                return $this->redirectToRoute('form_listusers');
            } else {
                $errorMessage = $checkunique->getMessageErreur();
            }



            dump($user);
        }

        return $this->render('form/user.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
            'error_message' => $errorMessage
        ]);
    }


    /**
     * @Route("/bootstrap2", name="form_bootstrap")
     */
    public function bootstrap(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, [
            'label' => 'Sauvegarder',
            'attr' => [
                'class' => 'btn-outline-primary'
            ]
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();

            dump($user);
        }

        return $this->render('form/bootstrap.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/listusers", name="form_listusers")
     */
    public function listUsers()
    {
        $listUser = $this->get('doctrine_mongodb')
            ->getRepository(User::class)
            //->findAll();
            ->findAllOrderedByName();


        return $this->render('form/listuser.html.twig', [
            'controller_name' => 'FormController',
            'listuser' => $listUser

        ]);
    }

    /**
     * @Route("/updateuser/{id}", name="form_updateuserform")
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->get('doctrine_mongodb')
                    ->getRepository(User::class)
                    ->find($id);

        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, [
            'label' => 'Sauvegarder',
            'attr' => [
                'class' => 'btn-outline-primary'
            ]
        ]);


        $this->denyAccessUnlessGranted('edit', $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();


            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();

            return $this->redirectToRoute('form_listusers');

            dump($user);
        }

        return $this->render('form/user.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/deleteuser/{id}", name="form_deleteuserform")
     */
    public function deleteUser(Request $request, $id)
    {
        $user = $this->get('doctrine_mongodb')
            ->getRepository(User::class)
            ->find($id);

        $this->denyAccessUnlessGranted('delete', $user);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->remove($user);
        $dm->flush();



        return $this->redirectToRoute('form_listusers');
    }
}

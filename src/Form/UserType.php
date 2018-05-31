<?php

namespace App\Form;

use App\Document\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'col-sm-2 col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'error_bubbling' =>true
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'col-sm-2 col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'error_bubbling' =>true
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'col-sm-2 col-form-label'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'error_bubbling' =>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => User::class
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'Votre prénom']])
            ->add('lastName', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'Votre nom']])

            ->add('email')
            // ->add('roles')
            ->add('password', PasswordType::class)
            ->add('password_confirm', PasswordType::class)
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

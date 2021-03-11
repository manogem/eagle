<?php

declare(strict_types=1);

namespace Eagle\Module\User\UI\Web\Form;

use Eagle\Module\User\UI\Web\Request\UserRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [])
            ->add('password', TextType::class, [])
            ->add('email', TextType::class, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserRequest::class,
            'csrf_protection' => false,
        ]);
    }
}

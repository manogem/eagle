<?php

declare(strict_types=1);

namespace Eagle\Module\Measurement\UI\Web\Form;

use Eagle\Module\Measurement\UI\Web\Request\MeasurementRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subjectName', TextType::class)
            ->add('type', IntegerType::class)
            ->add('timestamp', TextType::class)
            ->add('payload', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeasurementRequest::class,
            'csrf_protection' => false,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\RequestService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_create')
            ->add('type_id')
            ->add('client_id')
            ->add('body')
            ->add('response')
            ->add('channel')
            ->add('priority')
            ->add('parent_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequestService::class,
        ]);
    }
}

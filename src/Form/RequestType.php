<?php

namespace App\Form;

use App\Entity\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_id')
            ->add('date_create')
            ->add('client_id')
            ->add('body')
            ->add('response')
            ->add('channel')
            ->add('priority')
            ->add('parent_request_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Request::class,
        ]);
    }
}

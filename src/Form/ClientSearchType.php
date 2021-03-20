<?php

namespace App\Form;

use App\Entity\ClientSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dogName', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom du Chien",
                ]
            ])
            ->add('owner',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom du Client",
                ]
            ])
            ->add('race',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Race du Chien",
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClientSearch::class,
            'method' => 'get',
        ]);
    }
}

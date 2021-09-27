<?php

namespace App\Form;

use App\Entity\Dog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom du Chien",
                ]
            ])
            ->add('race',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Race du Chien",
                ]
            ])
            ->add('owner',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Propriétaire du Chien",
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('tel', TelType::class, [
                'required' => false,
                'invalid_message' => 'Veuillez entrer un numéro de téléphone !',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}

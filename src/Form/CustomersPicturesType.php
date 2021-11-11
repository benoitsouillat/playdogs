<?php

namespace App\Form;

use App\Entity\Dog;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\CustomersPictures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CustomersPicturesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $dogs = $options['values'];
        $builder
            ->add('Dog', ChoiceType::class, [
                'label' => 'Choisissez un animal',
                'choices' => $dogs,
                'choice_label' => function ($value) {
                    if (is_object($value)) {
                        return $value->getName().' de M '.$value->getOwner();
                    } else {
                        return 0;
                    }
                },
                'choice_value' => function ($value) {
                    if (is_object($value)) {
                        return $value->getId();
                    } else {
                        return 0;
                    }
                }
            ])
            ->add('sentence', TextareaType::class, [
                'label' => 'Description de l\'image',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomersPictures::class,
        ]);
        $resolver->setRequired('values');
    }
}

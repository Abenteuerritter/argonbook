<?php

namespace Argon\GameBundle\Form\Race;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Argon\GameBundle\Form\Type\GenreType;
use Argon\GameBundle\Entity\Race;

class RaceEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modifier')
            ->add('genres', GenreType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Race::class,
            'intention'  => 'race_edit',
        ));
    }
}
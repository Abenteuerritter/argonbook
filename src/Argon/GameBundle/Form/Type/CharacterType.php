<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('abilities', CollectionType::class, array(
                'entry_type' => CharacterAbilityType::class,
            ))
            ->add('race', null, array(
                'placeholder' => 'character.race_placeholder',
            ))
            ->add('story', null, array(
                'required' => false,
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Argon\GameBundle\Entity\Character',
            'intention'  => 'character',
        ));
    }
}

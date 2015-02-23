<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('abilities', 'collection', array(
                'type' => 'character_ability',
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
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Argon\GameBundle\Entity\Character',
            'translation_domain' => 'forms',
            'intention'          => 'character',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'character';
    }
}

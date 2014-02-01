<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CharacterAbilityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code', 'hidden');
        $builder->add('modifier', null, array(
            'required' => false,
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Argon\GameBundle\Entity\CharacterAbility',
            'translation_domain' => 'forms',
            'intention'          => 'character_ability',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'character_ability';
    }
}
<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CharacterStoryConfirmType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // {{{ Character
            ->add('note', 'textarea', array(
                'required' => false,
            ))
            // }}}

            // {{{ CharacterExperience
            ->add('experience', 'number', array(
                'required' => true,
            ))
            ->add('reason', 'textarea', array(
                'required' => false,
            ))
            // }}}
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'forms',
            'intention'          => 'character_story_confirm',
        ));
    }

    /**
     * @deprecated on Symfony 3+
     * @return string
     */
    public function getName()
    {
        return 'character_story_confirm';
    }
}
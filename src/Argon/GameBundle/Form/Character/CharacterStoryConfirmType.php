<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('note', TextareaType::class, array(
                'required' => false,
            ))
            // }}}

            // {{{ CharacterExperience
            ->add('experience', NumberType::class, array(
                'required' => true,
            ))
            ->add('reason', TextareaType::class, array(
                'required' => false,
            ))
            // }}}
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'intention' => 'character_story_confirm',
        ));
    }
}
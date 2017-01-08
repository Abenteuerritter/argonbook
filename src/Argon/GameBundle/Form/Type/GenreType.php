<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'intention' => 'genre',
            'expanded'  => true,
            'multiple'  => true,
            'choices'   => array(
                'genres.FAN' => 'FAN',
                'genres.MID' => 'MID',
                'genres.VAM' => 'VAM',
                'genres.SFI' => 'SFI',
            ),
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
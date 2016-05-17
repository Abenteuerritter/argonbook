<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Argon\GameBundle\Provider\GameInterface;

class CharacterGameType extends AbstractType
{
    /**
     * @var GameInterface[]
     */
    protected $games;

    public function __construct(array $games)
    {
        $this->games = $games;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('game', ChoiceType::class, array(
            'choices' => $this->games,
            'choice_value' => function(GameInterface $game = null) {
                if ($game) {
                    return $game->getName();
                }
            },
            'choice_label' => function(GameInterface $game) {
                $info = $game->getInfo();

                if (array_key_exists('fullname', $info)) {
                    return $info['fullname'];
                }

                return $game->getName();
            },
            'group_by' => function(GameInterface $game) {
                $info = $game->getInfo();

                if (array_key_exists('category', $info)) {
                    return $info['category'];
                }
            },
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'intention' => 'character_game',
        ));
    }
}
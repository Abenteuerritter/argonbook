<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Argon\GameBundle\Form\ChoiceList\GameChoiceList;

class CharacterGameType extends AbstractType
{
    /**
     * @var \Argon\GameBundle\Form\ChoiceList\GameChoiceList
     */
    protected $gameChoiceList;

    public function __construct(GameChoiceList $gameChoiceList)
    {
        $this->gameChoiceList = $gameChoiceList;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('game', 'choice', array(
            'choice_list' => $this->gameChoiceList,
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'forms',
            'intention'          => 'character_game',
        ));
    }
}
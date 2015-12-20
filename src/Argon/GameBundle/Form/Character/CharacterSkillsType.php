<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Argon\GameBundle\Validator\Constraints\CharacterSkillsEnoughExperience;

class CharacterSkillsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('characterSkills', 'collection', array(
            'type' => 'character_skill',
            'constraints' => array(
                new CharacterSkillsEnoughExperience(),
            ),
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'forms',
            'intention'          => 'character_skills',
        ));
    }

    /**
     * @deprecated on Symfony 3+
     * @return string
     */
    public function getName()
    {
        return 'character_skills';
    }
}
<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Argon\GameBundle\Validator\Constraints\CharacterSkillsEnoughExperience;
use Argon\GameBundle\Form\Type\CharacterSkillType;

class CharacterSkillsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('characterSkills', CollectionType::class, array(
            'entry_type' => CharacterSkillType::class,
            'constraints' => array(
                new CharacterSkillsEnoughExperience(),
            ),
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'ArgonGameBundle',
            'intention'          => 'character_skills',
        ));
    }
}
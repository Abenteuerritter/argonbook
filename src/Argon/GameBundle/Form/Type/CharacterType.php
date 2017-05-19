<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Argon\GameBundle\Provider\GameInterface;

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
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view['abilities']->vars['help'] = 'character.abilities_help';

        foreach ($view['abilities']->children as $ability) {
            $ability->vars['label'] = false;
        }

        if (isset($options['game']) && $options['game'] instanceof GameInterface) {
            foreach ($view['race']->vars['choices'] as $index => $choice) {
                /** @var \Argon\GameBundle\Entity\Race $choice->data */
                if (!$choice->data->supportGame($options['game'])) {
                    unset($view['race']->vars['choices'][$index]);
                }
            }
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Argon\\GameBundle\\Entity\\Character',
            'intention'  => 'character',

            // Which game does this character belong to?
            'game' => null,
        ));
    }
}

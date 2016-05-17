<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('story', null, array(
                'required' => false,
            ))

            ->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
                /** @var \Argon\GameBundle\Entity\Character */
                $character = $event->getData();

                if ($character->getStoryConfirmedAt() === null) {
                    $event
                        ->getForm()
                        ->add('storyDraft', null, array(
                           'label'    => 'character.story_draft',
                           'required' => false,
                        ))
                    ;
                }
            })
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Argon\GameBundle\Entity\Character',
            'intention'  => 'character_edit',
        ));
    }
}
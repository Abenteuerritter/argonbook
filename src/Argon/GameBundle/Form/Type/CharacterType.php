<?php

namespace Argon\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

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
                'placeholder'   => 'character.race_placeholder',
                'query_builder' => function(EntityRepository $repository) use ($options) {
                    $queryBuilder = $repository->createQueryBuilder('r');
                    if (isset($options['game']) && $options['game'] instanceof GameInterface) {
                        $queryBuilder->where(
                            $queryBuilder->expr()->in('r.genres', $options['game']->getGenres())
                        );
                    }
                    return $queryBuilder;
                },
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
        foreach ($view['abilities']->children as $ability) {
            $ability->vars['label'] = false;
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

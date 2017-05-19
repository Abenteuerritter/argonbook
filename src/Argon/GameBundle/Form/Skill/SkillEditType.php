<?php

namespace Argon\GameBundle\Form\Skill;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

use Argon\GameBundle\Entity\Skill;

class SkillEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modifier')
            ->add('max')
            ->add('description')
            ->add('requirements', null, array(
                'expanded'      => true,
                'multiple'      => true,
                'query_builder' => function(EntityRepository $repository) use ($options) {
                    $queryBuilder = $repository->createQueryBuilder('r');
                    if (
                        isset($options['exclude_requirement_skill'])
                        && $options['exclude_requirement_skill'] instanceof Skill
                    ) {
                        $queryBuilder->where('r.id != :exclude_skill');
                        $queryBuilder->setParameter('exclude_skill', $options['exclude_requirement_skill']->getId());
                    }
                    return $queryBuilder;
                },
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Skill::class,
            'intention'  => 'skill_edit',

            'exclude_requirement_skill' => null,
        ));
    }
}
<?php

namespace Argon\GameBundle\Form\Character;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Argon\GameBundle\Form\DataTransformer\CharacterToUsernameTransformer;

/**
 * Form type for representing a UserInterface instance by its username string.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class CharacterUsernameType extends AbstractType
{
    /**
     * @var UserToUsernameTransformer
     */
    protected $usernameTransformer;

    /**
     * Constructor.
     *
     * @param UserToUsernameTransformer $usernameTransformer
     */
    public function __construct(CharacterToUsernameTransformer $usernameTransformer)
    {
        $this->usernameTransformer = $usernameTransformer;
    }

    /**
     * @see Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->usernameTransformer);
    }

    /**
     * @see Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * @see Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'character_username';
    }
}
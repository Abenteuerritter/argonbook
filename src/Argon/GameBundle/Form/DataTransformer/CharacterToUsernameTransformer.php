<?php

namespace Argon\GameBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

use Doctrine\Common\Persistence\ObjectManager;

use Argon\GameBundle\Entity\Character;

/**
 * Transforms between a Character instance and a username string.
 */
class CharacterToUsernameTransformer implements DataTransformerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms a Character instance into a username string.
     *
     * @param \Argon\GameBundle\Entity\Character|null $value
     *
     * @return string|null Username
     *
     * @throws \UnexpectedTypeException
     */
    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Character) {
            throw new UnexpectedTypeException($value, 'Argon\GameBundle\Entity\Character');
        }

        return $value->getSlug();
    }

    /**
     * Transforms a username string into a Character instance.
     *
     * @param string $value
     *
     * @return \Argon\GameBundle\Entity\Character
     *
     * @throws \UnexpectedTypeException
     */
    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $entity = $this->entityManager
                       ->getRepository('ArgonGameBundle:Character')
                       ->findOneBySlug($value);

        return $entity;
    }
}

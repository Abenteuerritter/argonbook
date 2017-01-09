<?php

namespace Argon\GameBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Argon\GameBundle\Provider\GameFactory;
use Argon\GameBundle\Provider\GameInterface;

class GameParamConverter implements ParamConverterInterface
{
    /**
     * @var \Argon\GameBundle\Provider\GameFactory
     */
    private $gameFactory;

    /**
     * @param \Argon\GameBundle\Provider\GameFactory $gameFactory
     */
    public function __construct(GameFactory $gameFactory)
    {
        $this->gameFactory = $gameFactory;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request                                $request
     * @param \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration
     *
     * @return boolean
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $gameName = $request->attributes->get('game');
        $game     = $this->gameFactory->create($gameName);

        if (null === $game) {
            throw new NotFoundHttpException(sprintf('Game %s not found.', $gameName));
        }

        $request->attributes->set($configuration->getName(), $game);

        return true;
    }

    /**
     * @param \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration
     *
     * @return boolean
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === GameInterface::class;
    }
}
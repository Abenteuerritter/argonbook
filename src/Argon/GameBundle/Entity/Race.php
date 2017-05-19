<?php

namespace Argon\GameBundle\Entity;

use Gedmo\Translatable\Translatable;

use Argon\GameBundle\Provider\GameInterface;

class Race implements Translatable
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $modifier;

    /**
     * @var array
     */
    protected $genres = array();

    /**
     * @var string
     */
    protected $locale;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $modifier
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * @return integer
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param string $genre
     */
    public function addGenre($genre)
    {
        $this->genres[] = $genre;
    }

    /**
     * @param array $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Returns true if the race support the given game.
     *
     * @param GameInterface $game
     *
     * @return boolean
     */
    public function supportGame(GameInterface $game)
    {
        return count(array_intersect($game->getGenres(), $this->getGenres())) > 0;
    }

    /**
     * @param string $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
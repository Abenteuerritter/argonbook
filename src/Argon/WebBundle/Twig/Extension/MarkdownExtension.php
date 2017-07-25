<?php

namespace Argon\WebBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;

use cebe\markdown\Markdown;

class MarkdownExtension extends Twig_Extension
{
    /**
     * @var \cebe\markdown\Markdown
     */
    protected $markdown;

    /**
     * @param \cebe\markdown\Markdown $markdown
     */
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * {@inheritDoc}
     * @see \Twig_Extension::getFilters()
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('markdown', array($this, 'parse')),
        );
    }

    /**
     * Parse text into markdown html.
     *
     * @param string $text
     *
     * @return string
     */
    public function parse($text)
    {
        return $this->markdown->parse($text);
    }
}
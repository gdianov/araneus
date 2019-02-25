<?php

declare(strict_types=1);

namespace Araneus\Rules;

abstract class BaseRule
{
    /**
     * The array of values ​​that were found for rule.
     *
     * @var array
     */
    protected $matches = [];

    /**
     * @param array $matches
     */
    public function setMatches(array $matches) : void
    {
        $this->matches = $matches;
    }

    /**
     * @return array
     */
    public function getMatches() : array
    {
        return $this->matches;
    }
}
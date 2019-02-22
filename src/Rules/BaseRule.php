<?php

namespace Araneus\Rules;

abstract class BaseRule
{
    protected $matches = [];

    public function setMatches(array $matches) : void
    {
        $this->matches = $matches;
    }

    public function getMatches() : array
    {
        return $this->matches;
    }
}
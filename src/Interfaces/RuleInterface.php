<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

interface RuleInterface
{
    public function getPattern() : string;

    public function setMatches(array $matches) : void;

    public function getMatches() : array;
}
<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

/**
 * Interface RuleInterface
 * @package Araneus\Interfaces
 */
interface RuleInterface
{
    /**
     * The pattern to be used in the search.
     * @example /(\d)+/
     *
     * @return string
     */
    public function getPattern() : string;

    /**
     * @param array $matches
     */
    public function setMatches(array $matches) : void;

    /**
     * @return array
     */
    public function getMatches() : array;
}
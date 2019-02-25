<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

/**
 * Interface ParserInterface
 * @package Araneus\Interfaces
 */
interface ParserInterface
{
    /**
     * @return mixed
     */
    public function run();

    /**
     * @return array
     */
    public function fetch() : array;

    /**
     * @return array
     */
    public function fetchRules(): array;
}
<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

interface RuleInterface
{
    public function getPattern() : string;

    public function getFileName() : string;
}
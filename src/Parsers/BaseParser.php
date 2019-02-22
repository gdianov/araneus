<?php

namespace Araneus\Parsers;

use Araneus\Interfaces\ParserInterface;
use Araneus\Interfaces\RuleInterface;

abstract class BaseParser implements ParserInterface
{
    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @param RuleInterface[] ...$rules
     * @return BaseParser
     */
    public function attachRules(RuleInterface ...$rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    public function detachRules() : void
    {
        $this->rules = [];
    }

    public function fetch(): array
    {
        $data = [];
        foreach ($this->rules as $rule) {
            $data[$rule->getPattern()] = $rule->getMatches();
        }

        return $data;
    }

    /**
     * @return RuleInterface[] array
     */
    public function fetchRules(): array
    {
        return $this->rules;
    }

    protected function clean($str)
    {
        return trim($str);
    }
}
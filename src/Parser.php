<?php

declare(strict_types=1);

namespace Araneus;

use Araneus\Interfaces\ParserInterface;
use Araneus\Interfaces\RuleInterface;
use Araneus\Interfaces\SourceInterface;

/**
 * Class Parser
 * @package Araneus
 */
class Parser implements ParserInterface
{
    /**
     * @var RuleInterface[]
     */
    protected $rules = [];

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * Parser constructor.
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
        $source->validate();
    }

    /**
     * Attach the rules that will be searched by text.
     * There may be several rules, all of which will be processed in turn.
     *
     * @param RuleInterface[] ...$rules
     * @return Parser
     */
    public function attachRules(RuleInterface ...$rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * Delete all loaded rules.
     */
    public function detachRules(): void
    {
        $this->rules = [];
    }

    /**
     * Get all the matches that were found in the text.
     * The key of the array will be a regular argument
     * and the value of the array of the values ​​found.
     *
     * @return array
     */
    public function fetch(): array
    {
        $data = [];
        foreach ($this->rules as $rule) {
            $data[$rule->getPattern()] = $rule->getMatches();
        }

        return $data;
    }

    /**
     * An array of rules will be returned to which the
     * loaded results.
     *
     * @return RuleInterface[] array
     */
    public function fetchRules(): array
    {
        return $this->rules;
    }

    /**
     * Start the search for values ​​in the text.
     *
     * @return $this|mixed
     */
    public function run()
    {
        $content = $this->source->getSourceContent()->getContent();
        if ($content) {
            foreach ($this->rules as $rule) {
                $matches = $this->find($rule, $content);
                $rule->setMatches($matches);
            }
        }

        return $this;
    }

    /**
     * Search by pattern using the function
     * @see http://php.net/manual/en/function.preg-match-all.php
     *
     * @param RuleInterface $rule
     * @param $content
     * @return array
     */
    protected function find(RuleInterface $rule, $content): array
    {
        preg_match_all($rule->getPattern(), $content, $matches);
        return $matches;
    }
}
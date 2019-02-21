<?php

declare(strict_types=1);

namespace Araneus\File;

use Araneus\Interfaces\ParserInterface;
use Araneus\Interfaces\RuleInterface;

class FileParser implements ParserInterface
{
    use FileTrait;

    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * @var string
     */
    protected $savePath;

    /**
     * @var File
     */
    protected $file;

    /**
     * FileParser constructor.
     * @param File $file
     * @throws \Exception
     */
    public function __construct(File $file)
    {
        $file->verify();
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getSavePath(): string
    {
        return $this->savePath;
    }

    /**
     * @param string $savePath
     * @return FileParser
     */
    public function setSavePath(string $savePath): self
    {
        $this->savePath = $savePath;
        return $this;
    }

    /**
     * @param RuleInterface[] ...$rules
     * @return FileParser
     */
    public function attachRules(RuleInterface ...$rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    public function parse()
    {
        foreach ($this->rules as $rule) {
            print_r($rule->getFileName());
            print_r($rule->getPattern());
        }

        $text = $this->file->getContent()->getText();
        return $text;
    }
}
<?php

declare(strict_types=1);

namespace Araneus\Executors;

use Araneus\Interfaces\Executable;
use Araneus\Interfaces\RuleInterface;

class DocumentExecutor implements Executable
{
    private $fileExtension = '.docx';

    private $rules = [];

    protected $savePath;

    /** @var \DirectoryIterator */
    protected $iterator;

    /**
     * DocumentExecutor constructor.
     * @param string $dir
     * @throws \Exception
     */
    public function __construct(string $dir)
    {
        if (!is_dir($dir)) {
            throw new \Exception('Invalid directory.');
        }

        $this->iterator = new \DirectoryIterator($dir);
    }

    /**
     * @return string
     */
    public function getSavePath() : string
    {
        return $this->savePath;
    }

    /**
     * @param string $savePath
     * @return DocumentExecutor
     */
    public function setSavePath(string $savePath): self
    {
        $this->savePath = $savePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @param RuleInterface $rule
     * @return DocumentExecutor
     */
    public function attachRule(RuleInterface $rule) : self
    {
        $this->rules[spl_object_hash($rule)] = $rule;

        return $this;
    }

    /**
     * @param RuleInterface $rule
     */
    public function detachRule(RuleInterface $rule) : void
    {
        unset($this->rules[spl_object_hash($rule)]);
    }

    public function execute(): void
    {
        // TODO: Implement execute() method.
    }
}
<?php

declare(strict_types=1);

namespace Araneus\Parsers;

use Araneus\Unpackers\Tar;
use Araneus\Unpackers\Zip;
use Araneus\Content\DocxContent;
use Araneus\Interfaces\ParserInterface;
use Araneus\Interfaces\RuleInterface;
use Araneus\Traits\FileTrait;

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
     * @var string
     */
    protected $dir;

    /**
     * @var array
     */
    protected $coreUnpackers = ['zip' => Zip::class, 'tar' => Tar::class];

    /**
     * @var array
     */
    protected $coreContents = ['docx' => DocxContent::class];

    /**
     * @param string $dir
     * @return FileParser
     * @throws \Exception
     */
    public function setDir(string $dir) : self
    {
        $this->dir = $dir;

        return $this;
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
     * @return FileParser
     */
    public function setSavePath(string $savePath): self
    {
        $this->savePath = $savePath;

        return $this;
    }

    /**
     * @param RuleInterface $rule
     * @return FileParser
     */
    public function attachRule(RuleInterface $rule) : self
    {
        $this->rules[spl_object_hash($rule)] = $rule;

        return $this;
    }

    /**
     * @param RuleInterface $rule
     */
    public function detachRule(RuleInterface $rule)
    {
        unset($this->rules[spl_object_hash($rule)]);
    }

    public function parse()
    {
        // TODO: Implement parse() method.
    }

    /**
     * @return array
     */
    public function getCoreUnpackers(): array
    {
        return $this->coreUnpackers;
    }

    /**
     * @return array
     */
    public function getCoreContents(): array
    {
        return $this->coreContents;
    }
}
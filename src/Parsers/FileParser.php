<?php

declare(strict_types=1);

namespace Araneus\Parsers;

use Araneus\File\File;

class FileParser extends BaseParser
{
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

    public function parse(): self
    {
        $text = $this->file->getSourceContent()->getContent();
        if ($text) {
            foreach ($this->rules as $rule) {
                $matches = [];
                preg_match($rule->getPattern(), $text, $matches);
                $matches = array_map([$this, 'clean'], $matches);
                $rule->setMatches($matches);
            }
        }

        return $this;
    }
}
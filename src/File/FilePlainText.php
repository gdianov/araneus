<?php

declare(strict_types=1);

namespace Araneus\File;

use Araneus\Content\PlainTextContent;
use Araneus\Interfaces\ContentInterface;
use Araneus\Interfaces\SourceInterface;

/**
 * Class FilePlainText
 * @package Araneus\File
 */
class FilePlainText extends File implements SourceInterface
{
    public function getSupportedExtension(): string
    {
        return 'txt';
    }

    public function getSourceContent(): ContentInterface
    {
        return new PlainTextContent($this);
    }
}
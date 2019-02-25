<?php

declare(strict_types=1);

namespace Araneus\File;

use Araneus\Content\DocumentContent;
use Araneus\Interfaces\ContentInterface;

/**
 * Class FileDocument
 * @package Araneus\File
 */
class FileDocument extends File
{
    /**
     * @return string
     */
    public function getSupportedExtension(): string
    {
        return 'docx';
    }

    /**
     * @return ContentInterface
     */
    public function getSourceContent(): ContentInterface
    {
        return new DocumentContent($this);
    }
}
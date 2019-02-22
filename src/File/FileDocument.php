<?php

namespace Araneus\File;

use Araneus\Content\DocumentContent;
use Araneus\Interfaces\ContentInterface;

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
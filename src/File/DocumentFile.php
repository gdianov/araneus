<?php

namespace Araneus\File;

use Araneus\Content\DocumentContent;
use Araneus\Interfaces\ContentInterface;

class DocumentFile extends File
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
    public function getContent(): ContentInterface
    {
        return new DocumentContent($this);
    }
}
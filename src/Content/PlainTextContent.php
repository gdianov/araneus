<?php

declare(strict_types=1);

namespace Araneus\Content;

use Araneus\File\FilePlainText;
use Araneus\Interfaces\ContentInterface;

class PlainTextContent implements ContentInterface
{
    /**
     * @var FilePlainText
     */
    private $file;

    /**
     * DocumentContent constructor.
     * @param FilePlainText $file
     */
    public function __construct(FilePlainText $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $filePath = $this->file->getPathFile();
        $content = '';
        if (is_readable($filePath)) {
            $fp = fopen($filePath, "rb");
            $content = fread($fp, filesize($filePath));
        }

        fclose($fp);

        return $content;
    }
}
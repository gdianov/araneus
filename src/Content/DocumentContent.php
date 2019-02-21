<?php

declare(strict_types=1);

namespace Araneus\Content;

use Araneus\File\DocumentFile;
use Araneus\Interfaces\ContentInterface;

class DocumentContent implements ContentInterface
{
    /**
     * @var DocumentFile
     */
    private $file;

    /**
     * DocumentContent constructor.
     * @param DocumentFile $file
     */
    public function __construct(DocumentFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getText(): string
    {
        $rawContent = '';
        $xmlElement = $this->getXmlElement();
        if ($xmlElement !== null && $text = $xmlElement->xpath('/w:document/w:body/w:p/w:r/w:t')) {
            $rawContent = implode(' ', $text);
        }

        return $rawContent;
    }

    /**
     * @throws \Exception
     */
    private function getXmlElement(): ?\SimpleXMLElement
    {
        $xmlStr = $this->getUnzippedXmlString();
        $xmlElement = null;
        if ($xmlStr) {
            $backup = libxml_disable_entity_loader(true);
            $backup_errors = libxml_use_internal_errors(true);
            $xmlElement = simplexml_load_string($xmlStr);
            libxml_disable_entity_loader($backup);
            libxml_clear_errors();
            libxml_use_internal_errors($backup_errors);
        }

        return $xmlElement;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getUnzippedXmlString(): string
    {
        $document = '';
        $zip = zip_open($this->file->getPathFile());
        if (!$zip || is_numeric($zip)) {
            throw new \Exception("Zip open error code: " . $zip);
        }
        while ($zip_entry = zip_read($zip)) {
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
            if (zip_entry_name($zip_entry) != "word/document.xml") continue;
            $document .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            zip_entry_close($zip_entry);
        }
        zip_close($zip);

        return $document;
    }
}
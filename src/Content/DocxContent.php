<?php

declare(strict_types=1);

namespace Araneus\Content;

use Araneus\Interfaces\ContentInterface;

class DocxContent implements ContentInterface
{
    protected $separator = '|';

    /**
     * @param $src
     * @return string
     * @throws \Exception
     */
    public function getContent($src): string
    {
        if (!extension_loaded('zip')) {
            trigger_error('Unloaded Zip extension', E_USER_ERROR);
        }
        $content = '';
        $zip = zip_open($src);
        if (!$zip || is_numeric($zip)) {
            throw new \Exception("Zip open error code: " . $zip);
        }
        while ($zip_entry = zip_read($zip)) {
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
            if (zip_entry_name($zip_entry) != "word/document.xml") continue;
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            zip_entry_close($zip_entry);
        }
        zip_close($zip);
        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', $this->separator, $content);
        $content = strip_tags($content);

        return $content;
    }
}
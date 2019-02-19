<?php

namespace Araneus\Unpackers;

use Araneus\Interfaces\UnpackInterface;

class Zip implements UnpackInterface
{
    /**
     * @param string $src
     * @param string $dst
     */
    public function unpack(string $src, string $dst)
    {
        exec('unzip ' . escapeshellarg($src) . ' -d ' . escapeshellarg($dst));
    }
}
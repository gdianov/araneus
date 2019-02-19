<?php

namespace Araneus\Unpackers;

use Araneus\Interfaces\UnpackInterface;

class Tar implements UnpackInterface
{
    /**
     * @param string $src
     * @param string $dst
     */
    public function unpack(string $src, string $dst)
    {
        exec('tar -C ' . escapeshellarg($dst) . ' -zxvf ' . escapeshellarg($src));
    }
}
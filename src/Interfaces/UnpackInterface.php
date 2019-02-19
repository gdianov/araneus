<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

interface UnpackInterface
{
    public function unpack(string $src, string $dst);
}
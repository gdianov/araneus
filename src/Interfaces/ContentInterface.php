<?php

namespace Araneus\Interfaces;

interface ContentInterface
{
    /**
     * @param $src
     * @return string
     */
    public function getContent($src) : string;
}
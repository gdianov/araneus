<?php

declare(strict_types=1);

namespace Araneus\Interfaces;

/**
 * Interface SourceInterface
 * @package Araneus\Interfaces
 */
interface SourceInterface
{
    /**
     * @return ContentInterface
     */
    public function getSourceContent(): ContentInterface;

    /**
     * Validate input for Source Entity.
     *
     * @return mixed
     */
    public function validate();
}
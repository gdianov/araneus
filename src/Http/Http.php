<?php

declare(strict_types=1);

namespace Araneus\Http;

use Araneus\Content\HttpContent;
use Araneus\Interfaces\ContentInterface;
use Araneus\Interfaces\SourceInterface;

/**
 * Class Http
 * @package Araneus\Http
 */
class Http implements SourceInterface
{
    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @throws \Exception
     */
    public function validate()
    {
        if (filter_var($this->url, FILTER_VALIDATE_URL) === false) {
            throw new \Exception("Not valid url: {$this->url}");
        }

        $request = \Requests::get($this->url);
        if (!$request->success) {
            throw new \Exception("Resource unavailable status code: {$request->status_code}");
        }
    }

    /**
     * @return ContentInterface
     */
    public function getSourceContent(): ContentInterface
    {
        return new HttpContent($this);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
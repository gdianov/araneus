<?php

declare(strict_types=1);

namespace Araneus\Content;

use Araneus\Http\Http;
use Araneus\Interfaces\ContentInterface;

class HttpContent implements ContentInterface
{
    /**
     * @var Http
     */
    private $http;

    /**
     * HttpContent constructor.
     * @param Http $http
     */
    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    /**
     * @return mixed|string
     */
    public function getContent()
    {
        $request = \Requests::get($this->http->getUrl());
        return $request->body;
    }
}
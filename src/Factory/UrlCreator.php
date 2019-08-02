<?php

namespace CSK\Recrutation\Factory;

use CSK\Recrutation\Url;

class UrlCreator
{
    public function Create(array $params): Url
    {
        return new Url ($params['protocol'], $params['domain'], $params['path'], $params['queryString']);
    }
}
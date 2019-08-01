<?php

namespace CSK\Recrutation\HelperUrl;

use CSK\Recrutation\Url;

final class FilterUrl
{
    /** @var Url[] */
    private $url;


    public function __construct(array $url)
    {
        $this->url = $url;
    }

    public function uniqueCollectionDomain(): array
    {
        $filteredUrls = [];

        foreach ($this->url as $url) {
            $filteredUrls[] = $url->getDomain();
        }
        return array_unique($filteredUrls);
    }
}
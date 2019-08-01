<?php


namespace CSK\Recrutation;


final class Url
{
    /** @var string */
    private $protocol;

    /** @var string */
    private $domain;

    /** @var string */
    private $path;

    /** @var array */
    private $params = [];


    public function __construct(string $protocol, string $domain, string $path, array $params = [])
    {
        $this->protocol = $protocol;
        $this->domain = $domain;
        $this->path = $path;
        $this->params = $params;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

}
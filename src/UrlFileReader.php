<?php

namespace CSK\Recrutation;

use CSK\Recrutation\Factory\UrlCreator;

final class UrlFileReader implements UrlReader
{

    /** @var UrlCreator */
    private $factoryUrl;

    public function __construct(UrlCreator $factoryUrl)
    {
        $this->factoryUrl = $factoryUrl;
    }

    /**
     * Reads a urls collection
     *
     * @return \CSK\Recrutation\Url[]
     */
    public function read(): array
    {
        $dataFromFile = file('../_data_/urls.txt');
        $regex = "@(?<protocol>https?|ftp)\:\/\/?(?<domain>[a-z0-9-.]*\.[a-z]{2,3})(?<path>[^\?]+)?(?<queryString>\?.*)?@";
        $urls = [];
        foreach ($dataFromFile as $string) {
            preg_match($regex, $string, $out);
            if (isset($out['queryString'])) {
                $tmpArray = explode('&', $out['queryString']);
                $out['queryString'] = [];
                foreach ($tmpArray as $key => $item) {
                    // split each query string into [key] => value
                    parse_str($item, $tmp2);
                    $out['queryString'][key($tmp2)] = $tmp2[key($tmp2)];
                }
            }else {
                $out['queryString'] = [];
            }

           $urls[] = $this->factoryUrl->Create($out);
        }

        return $urls;
    }
}

<?php

namespace CSK\Recrutation;

final class UrlFileReader implements UrlReader
{
    /**
     * Reads a urls collection
     *
     * @return \CSK\Recrutation\Url[]
     */
    public function read(): array
    {
        $dataFromFile = file('../_data_/urls.txt');
        $out = null;
        $regex = "@(https?|ftp)\:\/\/?([a-z0-9-.]*\.[a-z]{2,3})([^\?]+)?(\?.*)?@";
        $urls = [];
        foreach ($dataFromFile as $string) {
            $tmp=[];
            preg_match($regex, $string, $out);
            // [4] index = query string
            if (isset($out[4])) {
                $tmpArray = explode('&', $out[4]);
                $tmp = [];
                foreach ($tmpArray as $item) {

                    parse_str($item, $tmp2);
                    $tmp[] = $tmp2;
                }
            }

            $urls[] = new Url(
                $out[1], // protocol
                $out[2], //domain
                $out[3], // path
                $tmp // query string as array, can be empty
            );
        }
        return $urls;
    }
}

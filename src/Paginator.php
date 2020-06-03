<?php

namespace Pendragon\Util;

use Countable;

class Paginator implements \JsonSerializable, Countable
{
    private $content = [];

    public function __construct(array $content, int $div)
    {
        $i = 0;
        $j = 0;

        if ($div > sizeof($content)) {
            throw new \Exception("Impossible parse");
        }

        while(sizeof($content) != $i) {
            if ($i !== 0 && $i % $div == 0) {
                ++$j;
                $this->content[$j] = [];
            }

            $this->content[$j][] = $content[$i];
            $i++;
        }
    }

    public function last()
    {
        return sizeof($this->content);
    }

    public function page(int $page)
    {
        return $this->content[$page - 1];
    }

    public function count()
    {
        return sizeof($this->content);
    }

    public function jsonSerialize()
    {
        return json_encode([
            "paginator" => [
                "pages" => count($this),
                "last" => $this->last()
            ]
        ]);
    }
}
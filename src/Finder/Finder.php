<?php

declare(strict_type=1);

namespace Griffin\Harpy\Finder;

class Finder
{
    public function find(string $filename)
    {
        return [$filename];
    }
}

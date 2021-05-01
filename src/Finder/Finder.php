<?php

declare(strict_types=1);

namespace Griffin\Harpy\Finder;

class Finder
{
    public function find(string $filename, string ...$filenames)
    {
        array_unshift($filenames, $filename);

        return $filenames;
    }
}

<?php

declare(strict_types=1);

namespace Griffin\Harpy\Finder;

/**
 * Finder
 */
class Finder
{
    /**
     * Find Files
     *
     * @param string $filename File
     * @param string ..$filenames Additional Filenames
     * @return string[] Found Files
     */
    public function find(string $filename, string ...$filenames): array
    {
        array_unshift($filenames, $filename);

        return $filenames;
    }
}

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
     * @param string $pattern Search Pattern
     * @param string ..$filenames Additional Search Patterns
     * @return string[] Found Files
     */
    public function find(string $pattern, string ...$patterns): array
    {
        array_unshift($patterns, $pattern);

        $filenames = array_filter($patterns, fn($pattern) => is_file($pattern));

        return $filenames;
    }
}

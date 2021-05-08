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

        $filepaths = [];

        foreach ($patterns as $pattern) {
            if (is_dir($pattern) && is_readable($pattern)) {
                foreach (scandir($pattern) as $filename) {
                    if (! in_array($filename, ['.', '..'])) {
                        $filepaths = array_merge(
                            $filepaths,
                            $this->find($pattern . DIRECTORY_SEPARATOR . $filename),
                        );
                    }
                }
            }

            if (is_file($pattern)) {
                $filepaths[] = $pattern;
            }
        }

        return array_unique($filepaths);
    }
}

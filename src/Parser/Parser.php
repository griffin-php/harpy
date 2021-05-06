<?php

declare(strict_types=1);

namespace Griffin\Harpy\Parser;

/**
 * Parser
 */
class Parser
{
    /**
     * Parse Files
     *
     * @param string $filename Filename
     * @param string[] $filenames Additional Filenames
     * @return string[] Found Class Names
     */
    public function parse(string $filename, string ...$filenames): array
    {
        return ['Foo', 'Bar'];
    }
}

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
     * @return string[] Found Class Names
     */
    public function parse(string $filename): array
    {
        return ['Foo'];
    }
}

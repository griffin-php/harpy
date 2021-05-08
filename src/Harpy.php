<?php

declare(strict_types=1);

namespace Griffin\Harpy;

use Griffin\Harpy\Finder\Finder;
use Griffin\Harpy\Parser\Parser;

/**
 * Harpy
 */
class Harpy
{
    /**
     * Finder
     */
    protected Finder $finder;

    /**
     * Parser
     */
    protected Parser $parser;

    /**
     * Constructor
     *
     * @param ?Finder $finder Finder
     * @param ?Parser $parser Parser
     */
    public function __construct(?Finder $finder = null, ?Parser $parser = null)
    {
        $this->finder = $finder ?? new Finder();
        $this->parser = $parser ?? new Parser();
    }

    /**
     * Retrieve Finder
     *
     * @return Finder Expected Object
     */
    public function getFinder(): Finder
    {
        return $this->finder;
    }

    /**
     * Retrieve Parser
     *
     * @return Parser Expected Object
     */
    public function getParser(): Parser
    {
        return $this->parser;
    }

    /**
     * Search for Classes defined into Files
     *
     * @param string $pattern Search Pattern
     * @return string[] Found Class Names
     */
    public function search(string $pattern): array
    {
        $patterns = [$pattern];

        $filenames  = $this->getFinder()->find(...$patterns);
        $classnames = $this->getParser()->parse(...$filenames);

        return $classnames;
    }
}

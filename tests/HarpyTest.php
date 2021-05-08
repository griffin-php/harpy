<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use Griffin\Harpy\Finder\Finder;
use Griffin\Harpy\Harpy;
use Griffin\Harpy\Parser\Parser;
use PHPUnit\Framework\TestCase;

class HarpyTest extends TestCase
{
    public function testConstructor(): void
    {
        $finder = $this->createMock(Finder::class);
        $parser = $this->createMock(Parser::class);

        $harpy = new Harpy($finder, $parser);

        $this->assertSame($finder, $harpy->getFinder());
        $this->assertSame($parser, $harpy->getParser());
    }
}

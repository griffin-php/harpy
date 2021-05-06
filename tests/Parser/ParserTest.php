<?php

declare(strict_types=1);

namespace GriffinTest\Harpy\Parser;

use Griffin\Harpy\Parser\Parser;
use GriffinTest\Harpy\RootTrait;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    use RootTrait;

    protected function setUp(): void
    {
        $this->root();

        $this->parser = new Parser();
    }

    public function testBasic(): void
    {
    }
}

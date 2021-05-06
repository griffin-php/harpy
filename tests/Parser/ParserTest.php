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
        $classnames = $this->parser->parse(
            $this->foo->url(),
            $this->bar->url(),
        );

        $this->assertCount(2, $classnames);
        $this->assertContains('Foo', $classnames);
        $this->assertContains('Bar', $classnames);
    }
}

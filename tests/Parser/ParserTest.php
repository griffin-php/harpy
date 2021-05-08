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
            $this->foo->url(), // Foo
            $this->bar->url(), // Bar
            $this->baz->url(), // Baz + Qux
        );

        $this->assertCount(4, $classnames);
        $this->assertContains('Foo', $classnames);
        $this->assertContains('Bar', $classnames);
        $this->assertContains('Baz', $classnames);
        $this->assertContains('Qux', $classnames);
    }

    public function testNamespace(): void
    {
        $classnames = $this->parser->parse(
            $this->oneOne->url(),
            $this->oneTwo->url(),
        );

        $this->assertCount(2, $classnames);
        $this->assertContains('One\One', $classnames);
        $this->assertContains('One\Two', $classnames);
    }

    public function testEmpty(): void
    {
        $this->assertCount(0, $this->parser->parse($this->index->url()));
    }

    public function testMultiple(): void
    {
        $classnames = $this->parser->parse($this->nodesAwkward->url());

        $this->assertCount(4, $classnames);
        $this->assertContains('Top', $classnames);
        $this->assertContains('Bottom', $classnames);
        $this->assertContains('Nodes\Top', $classnames);
        $this->assertContains('Nodes\Bottom', $classnames);
    }

    public function testForbidden(): void
    {
        $this->assertCount(0, $this->parser->parse($this->cache->url()));
    }
}

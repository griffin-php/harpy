<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use Griffin\Harpy\Finder;
use Griffin\Harpy\Harpy;
use Griffin\Harpy\Parser;
use PHPUnit\Framework\TestCase;

class HarpyTest extends TestCase
{
    use RootTrait;

    protected function setUp(): void
    {
        $this->root();

        $this->harpy = new Harpy();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Finder::class, $this->harpy->getFinder());
        $this->assertInstanceOf(Parser::class, $this->harpy->getParser());
    }

    public function testConstructorWithParameters(): void
    {
        $finder = $this->createMock(Finder::class);
        $parser = $this->createMock(Parser::class);

        $harpy = new Harpy($finder, $parser);

        $this->assertSame($finder, $harpy->getFinder());
        $this->assertSame($parser, $harpy->getParser());
    }

    public function testBasic(): void
    {
        $this->assertNotEmpty($this->harpy->search($this->root->url()));
    }

    public function testFiles(): void
    {
        $classnames = $this->harpy->search(
            $this->foo->url(),
            $this->bar->url(),
        );

        $this->assertCount(2, $classnames);
        $this->assertContains('Foo', $classnames);
        $this->assertContains('Bar', $classnames);
    }

    public function testDirectory(): void
    {
        $classnames = $this->harpy->search($this->one->url());

        $this->assertCount(2, $classnames);
        $this->assertContains('One\One', $classnames);
        $this->assertContains('One\Two', $classnames);
    }
}

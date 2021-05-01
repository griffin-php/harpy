<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use Griffin\Harpy\Finder\Finder;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class FinderTest extends TestCase
{
    protected function setUp(): void
    {
        $this->finder = new Finder();

        $this->root = vfsStream::setup();

        $this->foo = vfsStream::newFile('Foo.php')->at($this->root);
        $this->bar = vfsStream::newFile('Bar.php')->at($this->root);
    }

    public function testFile(): void
    {
        $filenames = $this->finder->find(
            $this->foo->url(),
            $this->bar->url(),
        );

        $this->assertCount(2, $filenames);
        $this->assertContains($this->foo->url(), $filenames);
        $this->assertContains($this->bar->url(), $filenames);
    }

    public function testDirectory(): void
    {
        $filenames = $this->finder->find($this->root->url());

        $this->assertCount(2, $filenames);
        $this->assertContains($this->foo->url(), $filenames);
        $this->assertContains($this->bar->url(), $filenames);
    }
}

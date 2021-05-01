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
        $this->baz = vfsStream::newFile('Baz.php')->at($this->root);

        $this->one = vfsStream::newDirectory('One')->at($this->root);

        $this->oneOne = vfsStream::newFile('One.php')->at($this->root);
        $this->oneTwo = vfsStream::newFile('Two.php')->at($this->root);
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
        $this->assertNotContains($this->baz->url(), $filenames);
    }

    public function testDirectory(): void
    {
        $filenames = $this->finder->find($this->root->url());

        $this->assertCount(5, $filenames);
        $this->assertContains($this->foo->url(), $filenames);
        $this->assertContains($this->bar->url(), $filenames);
        $this->assertContains($this->baz->url(), $filenames);
        $this->assertContains($this->oneOne->url(), $filenames);
        $this->assertContains($this->oneTwo->url(), $filenames);
    }
}

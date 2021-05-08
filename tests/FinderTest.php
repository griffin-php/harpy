<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use Griffin\Harpy\Finder;
use PHPUnit\Framework\TestCase;

class FinderTest extends TestCase
{
    use RootTrait;

    protected function setUp(): void
    {
        $this->root();

        $this->finder = new Finder();
    }

    public function testFile(): void
    {
        $filenames = $this->finder->find(
            $this->foo->url(),
            $this->bar->url(),
            $this->bar->url(),
        );

        $this->assertCount(2, $filenames);
        $this->assertContains($this->foo->url(), $filenames);
        $this->assertContains($this->bar->url(), $filenames);
        $this->assertNotContains($this->baz->url(), $filenames);
    }

    public function testDirectory(): void
    {
        $filenames = $this->finder->find($this->one->url());

        $this->assertCount(2, $filenames);
        $this->assertContains($this->oneOne->url(), $filenames);
        $this->assertContains($this->oneTwo->url(), $filenames);
    }

    public function testDirectoryWithoutPermissions(): void
    {
        $this->assertCount(0, $this->finder->find($this->secrets->url()));
    }
}

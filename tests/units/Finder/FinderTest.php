<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use Griffin\Harpy\Finder\Finder;
use PHPUnit\Framework\TestCase;

class FinderTest extends TestCase
{
    protected function setUp(): void
    {
        $this->finder = new Finder();
    }

    protected function prefix($filename): string
    {
        return __DIR__ . '/../../examples/' . $filename;
    }

    public function testTrue(): void
    {
        $filenames = $this->finder->find($this->prefix('Foo.php'));

        $this->assertCount(1, $filenames);
        $this->assertContains($this->prefix('Foo.php'), $filenames);
    }
}

<?php

declare(strict_types=1);

namespace GriffinTest\Harpy;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

trait RootTrait
{
    protected vfsStreamDirectory $root;

    protected vfsStreamFile $foo;

    protected vfsStreamFile $bar;

    protected vfsStreamFile $baz;

    protected vfsStreamDirectory $one;

    protected vfsStreamFile $oneOne;

    protected vfsStreamFile $oneTwo;

    protected function root(): vfsStreamDirectory
    {
        $this->root = vfsStream::setup();

        $this->foo = vfsStream::newFile('Foo.php')->at($this->root);
        $this->bar = vfsStream::newFile('Bar.php')->at($this->root);
        $this->baz = vfsStream::newFile('Baz.php')->at($this->root);

        $this->one = vfsStream::newDirectory('One')->at($this->root);

        $this->oneOne = vfsStream::newFile('One.php')->at($this->root);
        $this->oneTwo = vfsStream::newFile('Two.php')->at($this->root);

        file_put_contents($this->foo->url(), '<?php class Foo {}');
        file_put_contents($this->bar->url(), '<?php class Bar {}');

        file_put_contents($this->oneOne->url(), '<?php namespace One; class One {}');
        file_put_contents($this->oneTwo->url(), '<?php namespace One; class Two {}');

        return $this->root;
    }
}

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

        $this->oneOne = vfsStream::newFile('One.php')->at($this->one);
        $this->oneTwo = vfsStream::newFile('Two.php')->at($this->one);

        $this->index = vfsStream::newFile('index.php')->at($this->root);

        $this->nodes = vfsStream::newDirectory('Nodes')->at($this->root);

        $this->nodesAwkward = vfsStream::newFile('Awkward.php')->at($this->nodes);

        $this->secrets = vfsStream::newDirectory('secrets')->at($this->root);

        $this->passwd = vfsStream::newFile('passwd')->at($this->secrets);

        $this->data = vfsStream::newDirectory('data')->at($this->root);

        $this->cache = vfsStream::newFile('cache')->at($this->data);

        $this->duplicated = vfsStream::newFile('Duplicated.php')->at($this->root);

        file_put_contents($this->foo->url(), '<?php class Foo {}');
        file_put_contents($this->bar->url(), '<?php class Bar {}');
        file_put_contents($this->baz->url(), '<?php class Baz {} class Qux {}');

        file_put_contents($this->oneOne->url(), '<?php namespace One; class One {}');
        file_put_contents($this->oneTwo->url(), '<?php namespace One; class Two {}');

        file_put_contents($this->index->url(), <<<'EOS'
<?php
require(__DIR__ . '/vendor/autoload.php');
One\One::two();
$response = (new Foo())->bar();
var_dump($response);
EOS
);

        file_put_contents($this->nodesAwkward->url(), <<<'EOS'
<?php
namespace {
    class Top {}
    ?><span>bacon</span><?php
}
namespace Nodes {
    class Top {}
    class Bottom {}
}
namespace {
    var_dump('somebody');
    class Bottom {}
    var_dump('someone');
}
?>
EOS
);

        chmod($this->secrets->url(), 0333); // Remove List Directory (Read) Permissions

        file_put_contents($this->cache->url(), '<?php class Cache {}');

        chmod($this->cache->url(), 0333); // Remove Read Permissions

        file_put_contents($this->duplicated->url(), '<?php class Duplicated {} class Duplicated {}');

        return $this->root;
    }
}

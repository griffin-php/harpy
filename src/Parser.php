<?php

declare(strict_types=1);

namespace Griffin\Harpy;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\ParserFactory;

/**
 * Parser
 */
class Parser
{
    /**
     * Parse Files
     *
     * @param string $filename Filename
     * @param string[] $filenames Additional Filenames
     * @return string[] Found Class Names
     */
    public function parse(string $filename, string ...$filenames): array
    {
        array_unshift($filenames, $filename);

        $classnames = [];

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        foreach ($filenames as $filename) {
            if (! (is_file($filename) && is_readable($filename))) {
                continue;
            }

            $nodes = $parser->parse(file_get_contents($filename));
            foreach ($nodes as $node) {
                if ($node instanceof Namespace_) {
                    $namespace = implode('\\', $node->name->parts ?? []);
                    $namespace = ($namespace ? $namespace . '\\' : $namespace);
                    foreach ($node->stmts as $subnode) {
                        if ($subnode instanceof Class_) {
                            $classnames[] = $namespace . $subnode->name->name;
                        }
                    }
                }
                if ($node instanceof Class_) {
                    $classnames[] = $node->name->name;
                }
            }
        }

        return array_unique($classnames);
    }
}

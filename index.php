<?php

require_once 'vendor/autoload.php';

$parser = new \Araneus\Parsers\FileParser(
    new \Araneus\File\FilePlainText(__DIR__ . '/demo.txt')
);

$parser->attachRules(new class extends \Araneus\Rules\BaseRule implements \Araneus\Interfaces\RuleInterface
{
    public function getPattern(): string
    {
        return '~(\d)+~';
    }
});

$result = $parser->parse()->fetch();
var_dump($result);
//$result = $parser->parse()->loaded();
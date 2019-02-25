Araneus
=====================
#### Araneus is php library for flexible parsing of data from different sources
**Supported Sources:** `docx, txt, http resources`

### How to use?

1. Create Rule
```php
<?php

require_once 'vendor/autoload.php';

//Create new Rule
class TitleRule extends \Araneus\Rules\BaseRule implements  \Araneus\Interfaces\RuleInterface
{
    public function getPattern(): string
    {
        return '|<title[^>]*?>(.*?)</title>|sei';
    }
}
``` 

2. Create Http Parser
```php
$parseHttp = new \Araneus\Parser(
  new \Araneus\Http\Http('https://google.com')
);

//Attach created rule
$parseHttp->attachRules(new TitleRule()); //You can attach many rules

$result = $parser->run()->fetch(); //array key = regexp, value = found values     
$result = $parser->run()->fetchRules(); //array of Rule objects

              ...
```
3. Create Plain Text Parser
```php
$parseTxt = new \Araneus\Parser(
    new \Araneus\File\FilePlainText(__DIR__.'/dst/txt/demo.txt')
);

$parseTxt->attachRules(
  new NumberRule(), 
  new DirtyWordsRule(),
  new UidRule()
);

$result = $parseTxt->run()->fetch();
```
3. Create Microsoft Word Document Parser
```php
$parseDocx = new \Araneus\Parser(
    new \Araneus\File\FileDocument(__DIR__.'/dst/documents/demo.docx')
);

$parseDocx->attachRules(
  new UsersRule(),
  new LinksToBooksRule()
);

$result = $parseDocx->run()->fetch();
```
> You can expand the possibilities by adding your sources or modify existing ones by implementing the interfaces: SourceInterface, ContentInterface, RuleInterface


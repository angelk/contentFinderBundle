# contentFinderBundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c0b4837f-a831-4b94-8270-422e7578b2bf/big.png)](https://insight.sensiolabs.com/projects/c0b4837f-a831-4b94-8270-422e7578b2bf)
[![Build Status](https://travis-ci.org/angelk/contentFinderBundle.svg?branch=master)](https://travis-ci.org/angelk/contentFinderBundle)

Usage:
- Register fileFinder service

Example:
```
services:
    simpleFileFinder:
        class: Potaka\ContentFinderBundle\Finder\File\SymfonyFinderBridge
```
- Register conentFinder service

example:
```
services:
    simpleContentFinder:
        class: Potaka\ContentFinderBundle\Finder\Content\SimpleInefficientContentFinder
```
- Register finder

example:
```
potaka_content_finder:
    services:
        - name: myServiceName
          fileFinder: simpleFileFinder
          contentFinder: simpleContentFinder

```

Now there is service named `myServiceName`

example usage:
```
$this->get('myServiceName')
         ->find('/var/www', '<?php');
```

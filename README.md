[![Latest Stable Version](https://poser.pugx.org/sanmai/parsed-url/v/stable)](https://packagist.org/packages/sanmai/parsed-url)
[![Build Status](https://travis-ci.com/sanmai/parsed-url.svg?branch=master)](https://travis-ci.com/sanmai/parsed-url)
[![Coverage Status](https://coveralls.io/repos/github/sanmai/parsed-url/badge.svg?branch=master)](https://coveralls.io/github/sanmai/parsed-url?branch=master)

# Install

    composer require sanmai/parsed-url

The latest version requires PHP 7.0 or greater, including PHP 8.0+.

# Use

```php
$url = new \ParsedUrl\ParsedUrl('https://www.example.com/index.html?foo=bar&baz=1');

var_dump($url->scheme); // string(5) "https"

var_dump($url->host); // string(15) "www.example.com"

var_dump($url->path); // "/index.html"

var_dump($url->query); // string(13) "foo=bar&baz=1"

var_dump($url->query()->foo); // string(3) "bar"
```

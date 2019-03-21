# Slug

[![PHP](https://img.shields.io/badge/PHP->=5.6-orange.svg)](http://php.net)
[![Total Downloads](https://poser.pugx.org/wispx/slug/downloads)](https://packagist.org/packages/wispx/slug)
[![Latest Stable Version](https://poser.pugx.org/wispx/slug/version)](https://packagist.org/packages/wispx/slug)
[![License](https://poser.pugx.org/wispx/slug/license)](https://packagist.org/packages/wispx/slug)

> 使用有道翻译实现的中文转英文、友好的、利于 SEO 的 URL 结构。

## 开始

注册有道智云：https://ai.youdao.com/?keyfrom=old-openapi

注册之后，创建一个应用，然后你会得到下面两个配置信息:
```
1. appKey
2. appSecret
```

## 安装

通过下面的命令行来安装:

```bash
composer require wispx/slug
```
或者在你的 `composer.json` 文件中添加:

```json
"wispx/slug": "~1.0"
```
然后执行 `composer update`

### 使用

```php
<?php

$config = [
    'appKey' => 'your appKey',
    'appSecret' => 'your appSecret'
];

$slug = new \Slug\Slug($config);

echo $slug->translate('代码是艺术的一部分');
// Code is part of the art

echo $slug->translug('代码是艺术的一部分');
// code-is-part-of-the-art

echo $slug->translug('代码是艺术的一部分', '_');
// code_is_part_of_the_art

// Facade
\Slug\Facade\Slug::setConfig($config);

// setConfig方法支持链式操作
\Slug\Facade\Slug::setConfig($config)->translug('代码是艺术的一部分');
// code-is-part-of-the-art

// 还可以这样
\slug($config)->translug('2333');
// or
\slug()->setConfig($config)->translug('2333');
```

### License

- MIT

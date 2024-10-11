<div align="center">
<h1>Scrawler Database </h1>
<a href="https://github.com/scrawler-labs/database/actions/workflows/main.yml"><img alt="GitHub Workflow Status" src="https://img.shields.io/github/actions/workflow/status/scrawler-labs/database/main.yml?style=flat-square"></a>&nbsp;
<a href="https://app.codecov.io/gh/scrawler-labs/database"><img alt="Codecov" src="https://img.shields.io/codecov/c/github/scrawler-labs/arca-orm?style=flat-square"></a>&nbsp;
<a href="https://github.com/scrawler-labs/arca-orm/actions/workflows/main.yml"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat-square" alt="PHPStan Enabled"></a>
<img alt="Packagist Version (including pre-releases)" src="https://img.shields.io/packagist/v/scrawler/arca?include_prereleases&style=flat-square">&nbsp;
<img alt="GitHub License" src="https://img.shields.io/github/license/scrawler-labs/arca-orm?color=blue&style=flat-square">
<br><br>
🔥Wrapper around <a href= "https://github.com/scrawler-labs/arca-orm">Arca ORM</a> to be integrated with scrawler framework 🔥<br>
 🇮🇳 Made in India 🇮🇳
<br><br>
</div>

## 💻 Installation
You can install Scrawler App via Composer. If you don't have composer installed , you can download composer from [here](https://getcomposer.org/download/)

```sh
composer require scrawler/database
```


## ✨ Basic usage
Repo of Arca Orm: <a href= "https://github.com/scrawler-labs/arca-orm">https://github.com/scrawler-labs/arca-orm</a>

```php
<?php

require __DIR__ . '/vendor/autoload.php';

 $connectionParams = array(
        'dbname' => 'YOUR_DB_NAME',
        'user' => 'YOUR_DB_USER',
        'password' => 'YOUR_DB_PASSWORD',
        'host' => 'YOUR_DB_HOST',
        'driver' => 'pdo_mysql', //You can use other supported driver this is the most basic mysql driver
    );

db()->connect($connectionParams);

$user = db()->create('user');
$user->name = 'test user';
$user->age = 12;
$user->save();
```

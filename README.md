# PHP Torrent File Library

[![Packagist](https://img.shields.io/packagist/v/arokettu/torrent-file.svg?style=flat-square)](https://packagist.org/packages/arokettu/torrent-file)
[![PHP](https://img.shields.io/packagist/php-v/arokettu/torrent-file.svg?style=flat-square)](https://packagist.org/packages/arokettu/torrent-file)
[![License](https://img.shields.io/packagist/l/arokettu/torrent-file.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Gitlab pipeline status](https://img.shields.io/gitlab/pipeline/sandfox/torrent-file/master.svg?style=flat-square)](https://gitlab.com/sandfox/torrent-file/-/pipelines)
[![Codecov](https://img.shields.io/codecov/c/gl/sandfox/torrent-file?style=flat-square)](https://codecov.io/gl/sandfox/torrent-file/)

A PHP Class to work with torrent files

## Usage

```php
<?php

use Arokettu\Torrent\TorrentFile;

// open file
$torrent = TorrentFile::load('debian.torrent');
// create for path (file or directory)
$torrent = TorrentFile::fromPath('/home/user/dists/debian');

// manipulate fields
$torrent->setAnnounce('http://tracker.example:1234');
```

## Installation

```bash
composer require arokettu/torrent-file
```

## Features

* Torrent file data manipulation
* Torrent file creation

## Documentation

Read full documentation here: <https://sandfox.dev/php/torrent-file.html>

Also on Read the Docs: <https://torrent-file.readthedocs.io/>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/torrent-file/-/issues>

Feel free to ask any questions in our room on Gitter: <https://gitter.im/arokettu/community>

Supported versions:

* 2.x (bugfixes, PHP 7.4+)
* 3.x (bugfixes, PHP 8.1+)
* 4.x (current, PHP 8.1+)
* 5.x (future, PHP 8.1+)

## License

The library is available as open source under the terms of the [MIT License].

[MIT License]:  https://opensource.org/licenses/MIT

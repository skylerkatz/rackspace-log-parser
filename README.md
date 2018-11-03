# Parse Log Files From Rackspace Cloud Files

[![Latest Version on Packagist](https://img.shields.io/packagist/v/skylerkatz/rackspace-log-parser.svg?style=flat-square)](https://packagist.org/packages/skylerkatz/rackspace-log-parser)
[![Build Status](https://img.shields.io/travis/skylerkatz/rackspace-log-parser/master.svg?style=flat-square)](https://travis-ci.org/skylerkatz/rackspace-log-parser)
[![Quality Score](https://img.shields.io/scrutinizer/g/skylerkatz/rackspace-log-parser.svg?style=flat-square)](https://scrutinizer-ci.com/g/skylerkatz/rackspace-log-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/skylerkatz/rackspace-log-parser.svg?style=flat-square)](https://packagist.org/packages/skylerkatz/rackspace-log-parser)


Rackspace Cloud Files provides access logs for all items uploaded to your account.  Since log files can be confusing to work with, this package will parse a log file and generate an array of easy to use Objects, each representing a row in the log.

## Installation

You can install the package via composer:

```bash
composer require skylerkatz/rackspace-log-parser
```

## Usage

``` php
$parser = new SkylerKatz\RackspaceLogParser('path-to-the-log.log');
$items $parser->parse();

var_dump($items[0]);

object(SkylerKatz\RackspaceLogParser\LogItem)#1 (10) {
  ["raw"]=>
  string(444) "173.203.44.122 - - [15/07/2014:20:52:25 +0000] "GET /5142b6e5e57f760d7ff4-c591437fc634f2a98934b7738b8b8571.r93.cf1.rackcdn.com/image1.png HTTP/1.1" 304 277 "http://www.rackspace.com/" "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0. 50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E; MS-RTC LM 8; Microsoft Outlook 14.0. 7109; ms-office; MSOffice 14)""
  ["clientIp"]=>
  string(14) "173.203.44.122"
  ["accessDate"]=>
  object(Carbon\Carbon)#22 (3) {
    ["date"]=>
    string(26) "2014-07-15 20:52:25.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(3) "UTC"
  }
  ["method"]=>
  string(3) "GET"
  ["request"]=>
  string(85) "/5142b6e5e57f760d7ff4-c591437fc634f2a98934b7738b8b8571.r93.cf1.rackcdn.com/image1.png"
  ["httpVersion"]=>
  string(8) "HTTP/1.1"
  ["returnCode"]=>
  int(304)
  ["bytesSent"]=>
  int(277)
  ["referrer"]=>
  string(25) "http://www.rackspace.com/"
  ["userAgent"]=>
  string(259) "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0. 50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E; MS-RTC LM 8; Microsoft Outlook 14.0. 7109; ms-office; MSOffice 14)""
}

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email skylerkatz@gmail.com instead of using the issue tracker.

## Credits

- [Skyler Katz](https://github.com/skylerkatz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

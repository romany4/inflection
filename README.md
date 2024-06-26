# inflection

![inflection](https://raw.github.com/rocsci/petrovich/master/petrovich.png)

[![Build Status](https://secure.travis-ci.org/romany4/petrovich-php.svg?branch=master)](https://secure.travis-ci.org/romany4/inflection) [![Coverage Status](https://coveralls.io/repos/github/romany4/inflection/badge.svg?branch=master&service=github)](https://coveralls.io/github/romany4/inflection?branch=master) [![Latest Stable Version](https://poser.pugx.org/romany4/inflection/v/stable)](https://packagist.org/packages/romany4/inflection) [![Code Quality](https://scrutinizer-ci.com/g/romany4/inflection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/romany4/inflection/?branch=master) [![Infection MSI](https://badge.stryker-mutator.io/github.com/romany4/inflection/master)](https://infection.github.io)

Склонение падежей русских имён, фамилий и отчеств. Портированная версия с [Ruby](https://github.com/petrovich/petrovich-ruby) на PHP, использует [официальные правила](https://github.com/petrovich/petrovich-rules)

## Установка и использование

Для работы требуется PHP >= 8

Для установке, добавьте данный пакет в зависимости *Composer*, либо вручную, либо используя следующую команду:

``
composer require romany4/inflection
``

### Пример использования

Пример склонения отдельно имени, фамилии и отчества:

```php
mb_internal_encoding('UTF-8');

require_once 'path-to-vendor/autoload.php';

$inflection = new romany4\inflection(romany4\inflection\Loader::load(romany4\inflection\Loader::getVendorRulesFilePath()));

// Родительный падеж
$lastNameGenitive   = $inflection->inflectLastName('Пушкин', romany4\inflection\ruleset::CASE_GENITIVE, romany4\inflection\ruleset::GENDER_MALE); // Пушкина
$firstNameGenitive  = $inflection->inflectFirstName('Александр', romany4\inflection\ruleset::CASE_GENITIVE, inflection\ruleset::GENDER_MALE); // Александра
$middleNameGenitive = $inflection->inflectMiddleName('Сергеевич', romany4\inflection\ruleset::CASE_GENITIVE, romany4\inflection\ruleset::GENDER_MALE); // Сергеевича
```

Пример склонения одновременно имени, фамилии и отчества:

```php
mb_internal_encoding('UTF-8');

require_once 'path-to-vendor/autoload.php';

$inflection = new romany4\inflection(romany4\inflection\Loader::load('path-to-rules.json'));

// Родительный падеж
// Важно! На данный момент, такой порядок обязателен
$fullNameGenitive = $inflection->inflectFullName('Пушкин Александр Сергеевич', romany4\inflection\ruleset::CASE_GENITIVE, romany4\inflection\ruleset::GENDER_MALE); // Пушкина Александра Сергеевича
```

Как можно определить пол по отчеству:

```php
mb_internal_encoding('UTF-8');

require_once 'path-to-vendor/autoload.php';

echo romany4\Inflection::detectGender('Петровна'); // inflection::GENDER_FEMALE
```

## Версионирование

При версионировании, следуем заветам [SemVer](http://semver.org/). Для просмотра доступных версий, взгляните на [теги этого репозитория](https://github.com/romany4/petrovich-php/tags).

## Авторы

Все [контрибьюторы оригинального проекта](https://github.com/petrovich/petrovich-php/contributors).

## Лицензия

Проект использует лицензию MIT - для просмотра лицензии, посмотрите файл [LICENSE.md](LICENSE.md)

## Благодарности

- [petrovich/petrovich-rules](https://github.com/petrovich/petrovich-rules)
- [cloudloyalty/petrovich-rules](https://github.com/cloudloyalty/petrovich-rules)
- [symfony/yaml](https://github.com/symfony/yaml)
- [infection/infection](https://github.com/infection/infection)
- [sebastianbergmann/phpunit](https://github.com/sebastianbergmann/phpunit)
- [squizlabs/php_codesniffer](https://github.com/squizlabs/php_codesniffer)
- [Coveralls](https://coveralls.io/)
- [Travis CI](https://travis-ci.org/)

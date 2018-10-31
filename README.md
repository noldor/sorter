## Установка

```bash
git clone https://github.com/noldors/sorter.git

cd sorter

composer install
```

## Тесты

Запуск тестов
```bash
composer test
```

Тесты с покрытием
```bash
composer coverage
```

Показать отчет по покрытию, только linux
```bash
composer coverage-show
```

## Использование

Если установлено расширение Intl, то сортировка будет происходить с помощью класса \Collator работает даже с азиатскими языками.
Если изменена локаль для LC_COLLATE, то она будет использована для сортировки.
В противном случае будет использована сортировка по коду символов, с поправкой для русского языка для буквы Ё.

$locale можно не передавать, тогда будет использовано значение по-умолчанию

```php
use Noldors\Sipuni\Sorter;

$text = 'some text';
$locale = 'en_US.UTF-8';

$sorter = new Sorter($text, $locale);
// or
$sorter = Sorter::make($text, $locale);

echo $sorter->get();
// or
echo $sorter;
// or
echo Sorter::sort($text, $locale);
```

## Sorter API

```
public function __construct(string $text, ?string $locale = null)
```

```
public static function sort(string $text, ?string $locale = null): string
```

```
public static function make(string $text, ?string $locale = null): self
```

```
public function get(): string
```

```
public function __toString(): string
```

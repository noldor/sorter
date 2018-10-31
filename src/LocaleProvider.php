<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

class LocaleProvider extends AbstractProvider
{
    protected function sort(array $chars): array
    {
        $oldLocale = \setlocale(\LC_COLLATE, 0);

        \setlocale(\LC_COLLATE, $this->locale);
        \asort($chars, \SORT_LOCALE_STRING);
        \setlocale(\LC_COLLATE, $oldLocale);

        return $chars;
    }
}

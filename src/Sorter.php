<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

class Sorter
{
    private const INTL_EXTENSION_NAME = 'intl';

    /**
     * @var \Noldors\Sipuni\AbstractProvider
     */
    private $provider;

    public function __construct(string $text, ?string $locale = null)
    {
        if (\extension_loaded(static::INTL_EXTENSION_NAME)) {
            $this->provider = new IntlProvider($text, $locale);
        } elseif (\setlocale(\LC_COLLATE, 0) !== 'C') {
            $this->provider = new LocaleProvider($text, $locale);
        } else {
            $this->provider = new DefaultProvider($text, $locale);
        }
    }

    public static function sort(string $text, ?string $locale = null): string
    {
        return (string) new static($text, $locale);
    }

    public static function make(string $text, ?string $locale = null): self
    {
        return new static($text, $locale);
    }

    public function get(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->provider->process();
    }
}

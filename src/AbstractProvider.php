<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

abstract class AbstractProvider
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var null|string
     */
    protected $locale;

    public function __construct(string $text, ?string $locale = null)
    {
        $this->text = $text;
        $this->locale = $locale;
    }

    abstract protected function sort(array $chars): array;

    public function process(): string
    {
        return \preg_replace_callback('/(\w*)/u', [$this, 'sortChars'], $this->text);
    }

    protected function sortChars(array $matches): string
    {
        $chars = \preg_split('//u', $matches[0], -1, \PREG_SPLIT_NO_EMPTY);

        return \implode('', $this->sort($chars));
    }
}

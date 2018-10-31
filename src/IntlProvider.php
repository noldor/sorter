<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

use Collator;
use Locale;

class IntlProvider extends AbstractProvider
{
    /**
     * @var \Collator
     */
    private $collator;

    public function __construct(string $text, ?string $locale = null)
    {
        parent::__construct($text, $locale);
        $this->collator = new Collator($this->locale ?? Locale::getDefault());
    }

    protected function sort(array $chars): array
    {
        $this->collator->sort($chars, Collator::SORT_STRING | Collator::LOWER_FIRST);

        return $chars;
    }
}

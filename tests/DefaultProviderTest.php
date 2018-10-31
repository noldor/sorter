<?php

declare(strict_types=1);

namespace Noldors\Sipuni;

use PHPUnit\Framework\TestCase;

class DefaultProviderTest extends TestCase
{
    public function stringsProvider(): array
    {
        return [
            ['', ''],
            ['lemon orange banana apple', 'elmno aegnor aaabnn aelpp'],
            ['lemon  orange   banana    apple', 'elmno  aegnor   aaabnn    aelpp'],
            ["\nlemon\n\norange\r\nbanana\tapple", "\nelmno\n\naegnor\r\naaabnn\taelpp"],
            ['test#word', 'estt#dorw'],
            ['лимон апельсин банан яблоко', 'илмно аеилнпсь аабнн бклооя'],
            ['αβγαβγ αβγαβγαβγ', 'ααββγγ αααβββγγγ'],
            [
                'zZyYxXwWvVuUtTsSrRqQpPoOnNmMlLkKjJiIhHgGfFeEdDcCbBaA',
                'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ'
            ],
            [
                'ZzYyXxWwVvUuTtSsRrQqPpOoNnMmLlKkJjIiHhGgFfEeDdCcBbAa',
                'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ'
            ],
            [
                'яЯюЮэЭьЬыЫъЪщЩшШчЧцЦхХфФуУтТсСрРпПоОнНмМлЛкКйЙиИзЗжЖёЁеЕдДгГвВбБаА',
                'аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ'
            ],
            [
                'ЯяЮюЭэЬьЫыЪъЩщШшЧчЦцХхФфУуТтСсРрПпОоНнМмЛлКкЙйИиЗзЖжЁёЕеДдГгВвБбАа',
                'аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ'
            ],
            [
                'яюэьыъщшчцхфутсрпонмлкйизжёедгвба',
                'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'
            ]
        ];
    }

    /**
     * @dataProvider stringsProvider
     */
    public function testProcess(string $actual, string $expected): void
    {
        $provider = new DefaultProvider($actual);

        $this->assertSame($expected, $provider->process());
    }
}

<?php

namespace Elbgoods\SwissCantonRule\Tests\Rules;

use Elbgoods\SwissCantonRule\Rules\SwissCantonNameRule;
use Elbgoods\SwissCantonRule\Tests\TestCase;

final class SwissCantonNameRuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_name_values(): void
    {
        static::assertTrue((new SwissCantonNameRule())->passes('canton', 'Appenzell Inner-Rhodes'));
        static::assertTrue((new SwissCantonNameRule())->locale('en')->passes('canton', 'Appenzell Inner-Rhodes'));
        static::assertFalse((new SwissCantonNameRule())->locale('de')->passes('canton', 'Appenzell Inner-Rhodes'));

        static::assertTrue((new SwissCantonNameRule())->passes('canton', 'Appenzell Innerrhoden'));
        static::assertTrue((new SwissCantonNameRule())->locale('de')->passes('canton', 'Appenzell Innerrhoden'));
        static::assertFalse((new SwissCantonNameRule())->locale('en')->passes('canton', 'Appenzell Innerrhoden'));

        static::assertTrue((new SwissCantonNameRule())->passes('canton', 'Appenzell Rhodes-Intérieures'));
        static::assertTrue((new SwissCantonNameRule())->locale('fr')->passes('canton', 'Appenzell Rhodes-Intérieures'));
        static::assertFalse((new SwissCantonNameRule())->locale('de')->passes('canton', 'Appenzell Rhodes-Intérieures'));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameEN
     */
    public function it_passes_valid_english_name_values(string $value): void
    {
        $rule = new SwissCantonNameRule('en');

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameDE
     */
    public function it_passes_valid_german_name_values(string $value): void
    {
        $rule = new SwissCantonNameRule('de');

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameFR
     */
    public function it_passes_valid_french_name_values(string $value): void
    {
        $rule = new SwissCantonNameRule('fr');

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameIT
     */
    public function it_passes_valid_italian_name_values(string $value): void
    {
        $rule = new SwissCantonNameRule('it');

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameRM
     */
    public function it_passes_valid_romanian_name_values(string $value): void
    {
        $rule = new SwissCantonNameRule('rm');

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonAbbreviation
     */
    public function it_fails_when_passed_abbreviation_values(string $value): void
    {
        $rule = new SwissCantonNameRule();

        static::assertFalse($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonZipCode
     */
    public function it_fails_when_passed_zip_code_values(int $value): void
    {
        $rule = new SwissCantonNameRule();

        static::assertFalse($rule->passes('canton', $value));
    }
}

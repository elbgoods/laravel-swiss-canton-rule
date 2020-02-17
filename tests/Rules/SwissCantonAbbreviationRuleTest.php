<?php

namespace Elbgoods\SwissCantonRule\Tests\Rules;

use Elbgoods\SwissCantonRule\Rules\SwissCantonAbbreviationRule;
use Elbgoods\SwissCantonRule\Tests\TestCase;

final class SwissCantonAbbreviationRuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_abbreviation_values(): void
    {
        $rule = new SwissCantonAbbreviationRule();

        static::assertTrue($rule->passes('canton', 'AG'));
        static::assertTrue($rule->passes('canton', 'BE'));
        static::assertTrue($rule->passes('canton', 'ZH'));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonAbbreviation
     */
    public function it_passes_valid_abbreviation_values(string $value): void
    {
        $rule = new SwissCantonAbbreviationRule();

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonZipCode
     */
    public function it_fails_when_passed_zip_code_values(int $value): void
    {
        $rule = new SwissCantonAbbreviationRule();

        static::assertFalse($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameEN
     */
    public function it_fails_when_passed_name_values(string $value): void
    {
        $rule = new SwissCantonAbbreviationRule();

        static::assertFalse($rule->passes('canton', $value));
    }
}

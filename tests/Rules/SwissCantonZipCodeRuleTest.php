<?php

namespace Elbgoods\SwissCantonRule\Tests\Rules;

use Elbgoods\SwissCantonRule\Rules\SwissCantonZipCodeRule;
use Elbgoods\SwissCantonRule\Tests\TestCase;

final class SwissCantonZipCodeRuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_zip_codes_values(): void
    {
        $rule = new SwissCantonZipCodeRule();

        static::assertTrue($rule->passes('canton', 3270));
        static::assertTrue($rule->passes('canton', '4912'));
        static::assertTrue($rule->passes('canton', 6974));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonZipCode
     */
    public function it_passes_valid_zip_code_values(int $value): void
    {
        $rule = new SwissCantonZipCodeRule();

        static::assertTrue($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonAbbreviation
     */
    public function it_fails_when_passed_abbreviation_values(string $value): void
    {
        $rule = new SwissCantonZipCodeRule();

        static::assertFalse($rule->passes('canton', $value));
    }

    /**
     * @test
     * @dataProvider provideSwissCantonNameEN
     */
    public function it_fails_when_passed_name_values(string $value): void
    {
        $rule = new SwissCantonZipCodeRule();

        static::assertFalse($rule->passes('canton', $value));
    }
}

<?php

namespace Elbgoods\SwissCantonRule\Tests\Rules;

use Elbgoods\SwissCantonRule\Rules\SwissCantonRule;
use Elbgoods\SwissCantonRule\Tests\TestCase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

final class SwissCantonRuleTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideValidSwissCantonFormats
     */
    public function it_accepts_all_possible_country_formats(string $format): void
    {
        $rule = new SwissCantonRule($format);

        static::assertInstanceOf(SwissCantonRule::class, $rule);
    }

    /** @test */
    public function it_throws_exception_when_passed_invalid_format(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('The given format "foobar" is not valid [abbreviation, name, zip_code]');

        new SwissCantonRule('foobar');
    }

    /** @test */
    public function it_is_required_by_default(): void
    {
        $rule = new SwissCantonRule(SwissCantonRule::FORMAT_ABBREVIATION);

        static::assertFalse($rule->isNullable());
        static::assertTrue($rule->isRequired());
    }

    /** @test */
    public function it_is_nullable(): void
    {
        $rule = new SwissCantonRule(SwissCantonRule::FORMAT_ABBREVIATION);
        $rule->nullable();

        static::assertTrue($rule->isNullable());
        static::assertFalse($rule->isRequired());
    }

    /**
     * @test
     * @dataProvider provideValidSwissCantonFormats
     */
    public function validator_generates_correct_message(string $format): void
    {
        $validator = Validator::make([
            'canton' => 'foobar',
        ], [
            'canton' => new SwissCantonRule($format),
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            static::assertArrayHasKey('canton', $errors);
            static::assertArrayHasKey(0, $errors['canton']);
            static::assertStringStartsWith('canton is not a valid swiss canton ', $errors['canton'][0]);
        }
    }

    /**
     * @test
     * @dataProvider provideValidSwissCantonFormats
     */
    public function validator_generates_correct_message_with_custom_translations(string $format): void
    {
        Lang::addLines([
            'validation.attributes.canton' => 'Canton-Abbreviation',
        ], Lang::getLocale());

        Lang::addLines([
            'validation.swiss_canton.'.$format => ':attribute should be a valid swiss Canton-Abbreviation.',
        ], Lang::getLocale(), 'swissCantonRule');

        $validator = Validator::make([
            'canton' => 'foobar',
        ], [
            'canton' => new SwissCantonRule($format),
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            static::assertArrayHasKey('canton', $errors);
            static::assertArrayHasKey(0, $errors['canton']);
            static::assertSame('Canton-Abbreviation should be a valid swiss Canton-Abbreviation.', $errors['canton'][0]);
        }
    }

    public function provideValidSwissCantonFormats(): array
    {
        return [
            [SwissCantonRule::FORMAT_ABBREVIATION],
            [SwissCantonRule::FORMAT_NAME],
            [SwissCantonRule::FORMAT_ZIP_CODE],
        ];
    }
}

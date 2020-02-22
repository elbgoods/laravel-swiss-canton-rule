<?php

namespace Elbgoods\SwissCantonRule\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;
use InvalidArgumentException;
use Wnx\SwissCantons\Canton;
use Wnx\SwissCantons\CantonManager;

class SwissCantonRule implements Rule
{
    public const FORMAT_ABBREVIATION = 'abbreviation';
    public const FORMAT_NAME = 'name';
    public const FORMAT_ZIP_CODE = 'zip_code';

    protected const FORMATS = [
        self::FORMAT_ABBREVIATION,
        self::FORMAT_NAME,
        self::FORMAT_ZIP_CODE,
    ];

    protected bool $required;
    protected string $format;
    protected ?string $locale;

    public function __construct(string $format, ?string $locale = null, bool $required = true)
    {
        if (! in_array($format, self::FORMATS)) {
            throw new InvalidArgumentException(sprintf('The given format "%s" is not valid [%s]', $format, implode(', ', self::FORMATS)));
        }

        $this->format = $format;
        $this->locale = $locale;
        $this->required = $required;
    }

    public function nullable(): self
    {
        $this->required = false;

        return $this;
    }

    public function locale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if ($value === null && $this->isNullable()) {
            return true;
        }

        try {
            $this->resolveCanton($value);
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return Lang::get('swissCantonRule::validation.swiss_canton.'.$this->format);
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isNullable(): bool
    {
        return ! $this->required;
    }

    /**
     * @param string|int $value
     *
     * @return Canton
     *
     * @throws Exception
     */
    protected function resolveCanton($value): Canton
    {
        switch ($this->format) {
            case self::FORMAT_ABBREVIATION:
                return $this->getCantonManager()->getByAbbreviation($value);
            case self::FORMAT_NAME:
                $canton = $this->getCantonManager()->getByName($value);
                if (
                    $this->locale !== null
                    && $canton->setLanguage($this->locale)->getName() !== $value
                ) {
                    throw new Exception(sprintf('The name of canton "%s" does not match the given locale "%s".', $canton->getAbbreviation(), $this->locale));
                }

                return $canton;
            case self::FORMAT_ZIP_CODE:
                return $this->getCantonManager()->getByZipcode(intval($value));
            default:
                throw new InvalidArgumentException(sprintf('The given format "%s" is not valid [%s]', $this->format, implode(', ', self::FORMATS)));
        }
    }

    protected function getCantonManager(): CantonManager
    {
        return app(CantonManager::class);
    }
}

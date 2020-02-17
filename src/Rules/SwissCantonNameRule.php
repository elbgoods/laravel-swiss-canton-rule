<?php

namespace Elbgoods\SwissCantonRule\Rules;

class SwissCantonNameRule extends SwissCantonRule
{
    public function __construct(?string $locale = null, bool $required = true)
    {
        parent::__construct(SwissCantonRule::FORMAT_NAME, $locale, $required);
    }
}

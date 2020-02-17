<?php

namespace Elbgoods\SwissCantonRule\Rules;

class SwissCantonAbbreviationRule extends SwissCantonRule
{
    public function __construct(bool $required = true)
    {
        parent::__construct(SwissCantonRule::FORMAT_ABBREVIATION, null, $required);
    }
}

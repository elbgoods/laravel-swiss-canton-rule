<?php

namespace Elbgoods\SwissCantonRule\Rules;

class SwissCantonZipCodeRule extends SwissCantonRule
{
    public function __construct(bool $required = true)
    {
        parent::__construct(SwissCantonRule::FORMAT_ZIP_CODE, $required);
    }
}

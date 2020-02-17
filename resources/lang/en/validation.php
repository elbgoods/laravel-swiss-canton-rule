<?php

use Elbgoods\SwissCantonRule\Rules\SwissCantonRule;

return [
    'swiss_canton' => [
        SwissCantonRule::FORMAT_ABBREVIATION => ':attribute is not a valid swiss canton abbreviation.',
        SwissCantonRule::FORMAT_NAME => ':attribute is not a valid swiss canton name.',
        SwissCantonRule::FORMAT_ZIP_CODE => ':attribute is not a valid swiss canton zip-code.',
    ],
];

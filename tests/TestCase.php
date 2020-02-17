<?php

namespace Elbgoods\SwissCantonRule\Tests;

use Elbgoods\SwissCantonRule\SwissCantonRuleServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use stdClass;
use Wnx\SwissCantons\Canton;
use Wnx\SwissCantons\Cantons;
use Wnx\SwissCantons\ZipcodeSearch;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SwissCantonRuleServiceProvider::class,
        ];
    }

    public function provideSwissCantonAbbreviation(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->getAbbreviation()];
        }, (new Cantons())->getAll());
    }

    public function provideSwissCantonZipCode(): array
    {
        $abbreviations = array_keys((new Cantons())->getAllAsArray());

        return array_filter(array_map(static function (stdClass $data) use ($abbreviations): ?array {
            if (empty($data->canton)) {
                return null;
            }

            if ($data->zipcode == 2400) {
                // @todo: https://github.com/stefanzweifel/php-swiss-cantons/issues/28
                return null;
            }

            if (! in_array($data->canton, $abbreviations)) {
                // @todo: https://github.com/stefanzweifel/php-swiss-cantons/issues/27
                return null;
            }

            return [$data->zipcode];
        }, (new ZipcodeSearch())->getDataSet()));
    }

    public function provideSwissCantonNameEN(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->setLanguage('en')->getName()];
        }, (new Cantons())->getAll());
    }

    public function provideSwissCantonNameDE(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->setLanguage('de')->getName()];
        }, (new Cantons())->getAll());
    }

    public function provideSwissCantonNameFR(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->setLanguage('fr')->getName()];
        }, (new Cantons())->getAll());
    }

    public function provideSwissCantonNameIT(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->setLanguage('it')->getName()];
        }, (new Cantons())->getAll());
    }

    public function provideSwissCantonNameRM(): array
    {
        return array_map(static function (Canton $canton): array {
            return [$canton->setLanguage('rm')->getName()];
        }, (new Cantons())->getAll());
    }
}

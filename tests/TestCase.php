<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    protected function getFixtureClassPath($classPath)
    {
        $fixtureClassPath = implode(DIRECTORY_SEPARATOR, [
            __DIR__,
            'Fixtures',
            'Rule',
            str_replace('\\', DIRECTORY_SEPARATOR, $classPath) . '.php',
        ]);

        if (!file_exists($fixtureClassPath)) {
            return '';
        }

        return $fixtureClassPath;
    }
}

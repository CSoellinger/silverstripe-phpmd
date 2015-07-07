<?php

namespace SilverStripe\PHPMD\Tests\Functional;

use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Process;

abstract class AbstractProcessTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $filename
     * @param string $ruleset
     *
     * @return Process
     */
    protected function runPhpmd($filename, $ruleset)
    {
        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix(__DIR__ . '/../../vendor/bin/phpmd');

        $processBuilder
            ->add(__DIR__ . '/../Fixtures/code/' . $filename)
            ->add('text')
            ->add(__DIR__ . '/../../Rulesets/' . $ruleset);

        $process = $processBuilder->getProcess();
        $process->run();

        return $process;
    }
}

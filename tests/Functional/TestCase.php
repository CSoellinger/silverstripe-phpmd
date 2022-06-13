<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional;

use CSoellinger\SilverStripe\PHPMD\Tests\TestCase as TestsTestCase;
use SimpleXMLElement;
use Symfony\Component\Process\Process;

abstract class TestCase extends TestsTestCase
{
    public $rulesetProperties = [];

    /**
     * @var Process
     */
    protected $process;

    protected function tearDown(): void
    {
        $this->rulesetProperties = [];
        $this->process->__destruct();

        if (file_exists($this->getTempRulesetPath())) {
            unlink($this->getTempRulesetPath());
        }
    }

    abstract public function getViolationOutput(): string;

    /**
     * @param string $filename
     * @param mixed  $classPath
     *
     * @return Process
     */
    protected function runPhpmd($classPath)
    {
        $this->process = new Process($this->getProcessCmd($classPath));
        $this->process->run();

        return $this->process;
    }

    protected function assertStringContainsStringOnViolation($needle, $haystack, $violation)
    {
        if ($violation === true) {
            $this->assertStringContainsString($needle, $haystack);

            return;
        }

        $this->assertStringNotContainsString($needle, $haystack);
    }

    protected function testFile($file, $violation)
    {
        $output = $this->runPhpmd($file)->getOutput();

        $this->assertStringContainsStringOnViolation($this->getViolationOutput(), $output, $violation);
    }

    protected function getRulesetProperties()
    {
        return $this->rulesetProperties;
    }

    private function getProcessCmd($classPath): array
    {
        return [
            $this->getPhpmdPath(),
            $this->getFixtureClassPath($classPath),
            'text',
            $this->getRulesetPath(),
        ];
    }

    private function getPhpmdPath(): string
    {
        return realpath(__DIR__ . '/../../vendor/bin/phpmd');
    }

    private function getRulesetPath(): string
    {
        if (count($this->getRulesetProperties()) === 0) {
            return realpath(__DIR__ . '/../../silverstripe-ruleset.xml');
        }

        $string = file_get_contents(__DIR__ . '/../../silverstripe-ruleset.xml');
        $string = str_replace('xmlns=', 'ns=', $string);
        $xml = new SimpleXMLElement($string);

        foreach ($this->getRulesetProperties() as $key => $properties) {
            foreach ($properties as $propertyKey => $propertyValue) {
                $property = $xml->xpath('//ruleset/rule[@name="' . $key . '"]/properties/property[@name="' . $propertyKey . '"]')[0];
                $property['value'] = (string) $propertyValue;
            }
        }

        $string = $xml->asXML();
        $string = str_replace('ns=', 'xmlns=', $string);

        file_put_contents($this->getTempRulesetPath(), $string);

        return $this->getTempRulesetPath();
    }

    private function getTempRulesetPath()
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . str_replace('\\', '_', get_class($this)) . '.xml';
    }
}

<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Functional;

use CSoellinger\SilverStripe\PHPMD\Tests\TestCase as TestsTestCase;
use SimpleXMLElement;
use Symfony\Component\Process\Process;

abstract class TestCase extends TestsTestCase
{
    /**
     * @var array<string,array<string,string>>
     */
    public $rulesetProperties = [];

    /**
     * @var ?Process
     */
    protected $process;

    protected function tearDown(): void
    {
        $this->rulesetProperties = [];

        if ($this->process !== null) {
            $this->process->__destruct();
        }

        if (file_exists($this->getTempRulesetPath())) {
            unlink($this->getTempRulesetPath());
        }
    }

    abstract public function getViolationOutput(): string;

    protected function runPhpmd(string $classPath): Process
    {
        $this->process = new Process($this->getProcessCmd($classPath));
        $this->process->run();

        return $this->process;
    }

    protected function assertStringContainsStringOnViolation(string $needle, string $haystack, bool $violation): void
    {
        if ($violation === true) {
            self::assertStringContainsString($needle, $haystack);

            return;
        }

        self::assertStringNotContainsString($needle, $haystack);
    }

    protected function testFile(string $file, bool $violation): void
    {
        $output = $this->runPhpmd($file)->getOutput();

        $this->assertStringContainsStringOnViolation($this->getViolationOutput(), $output, $violation);
    }

    /**
     * @return array<string,array<string,string>>
     */
    protected function getRulesetProperties()
    {
        return $this->rulesetProperties;
    }

    /**
     * @return string[]
     */
    private function getProcessCmd(string $classPath): array
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
        return (string) realpath(__DIR__ . '/../../vendor/bin/phpmd');
    }

    private function getRulesetPath(): string
    {
        if (count($this->getRulesetProperties()) === 0) {
            return (string) realpath(__DIR__ . '/../../silverstripe-ruleset.xml');
        }

        $string = (string) file_get_contents(__DIR__ . '/../../silverstripe-ruleset.xml');
        $string = str_replace('xmlns=', 'ns=', $string);
        $xml = new SimpleXMLElement($string);

        foreach ($this->getRulesetProperties() as $key => $properties) {
            foreach ($properties as $propertyKey => $_propertyValue) {
                $xpath = '//ruleset/rule[@name="' . $key . '"]/properties/property[@name="' . $propertyKey . '"]';
                // var_dump($xml->xpath($xpath));
                $_property = $xml->xpath($xpath)[0];
                $_property['value'] = $_propertyValue;
            }
        }

        $string = (string) $xml->asXML();
        $string = str_replace('ns=', 'xmlns=', $string);

        file_put_contents($this->getTempRulesetPath(), $string);

        return $this->getTempRulesetPath();
    }

    private function getTempRulesetPath(): string
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . str_replace('\\', '_', get_class($this)) . '.xml';
    }
}

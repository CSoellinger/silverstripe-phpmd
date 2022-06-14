<?php

namespace CSoellinger\SilverStripe\PHPMD\Tests\Unit;

use CSoellinger\SilverStripe\PHPMD\Tests\TestCase as TestsTestCase;
use ErrorException;
use Exception;
use Iterator;
use PDepend\Source\AST\ASTNamespace;
use PDepend\Source\Language\PHP\PHPBuilder;
use PDepend\Source\Language\PHP\PHPParserGeneric;
use PDepend\Source\Language\PHP\PHPTokenizerInternal;
use PDepend\Util\Cache\Driver\MemoryCacheDriver;
use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Report;
use PHPUnit\Framework\MockObject\MockObject;

abstract class TestCase extends TestsTestCase
{
    /** @var int At least one violation is expected */
    public const AL_LEAST_ONE_VIOLATION = -1;

    /** @var int No violation is expected */
    public const NO_VIOLATION = 0;

    /** @var int One violation is expected */
    public const ONE_VIOLATION = 1;

    /**
     * @var AbstractRule
     */
    protected $rule;

    protected function setUp(): void
    {
        $this->rule = $this->initRule();
    }

    /**
     * @param int $violationNumber
     *
     * @return MockObject|Report
     */
    protected function getReport($violationNumber = -1)
    {
        if ($violationNumber === self::AL_LEAST_ONE_VIOLATION) {
            $expects = $this->atLeastOnce();
        } elseif ($violationNumber === self::NO_VIOLATION) {
            $expects = $this->never();
        } elseif ($violationNumber === self::ONE_VIOLATION) {
            $expects = $this->once();
        } else {
            $expects = $this->exactly($violationNumber);
        }

        $report = $this->getMockBuilder('PHPMD\\Report')->getMock();
        $report
            ->expects($expects)
            ->method('addRuleViolation')
        ;

        return $report;
    }

    protected function getClassNode($fixtureClassPath, $className = null)
    {
        $className = $className ?: basename(str_replace('\\', '/', $fixtureClassPath));
        $parsedSource = $this->parseSource($this->getFixtureClassPath($fixtureClassPath));
        $node = $this->getNodeByName($parsedSource->getClasses(), $className);

        return new ClassNode(/** @scrutinizer ignore-type */ $node);
    }

    abstract protected function initRule();

    protected function getRule(): AbstractRule
    {
        return $this->rule;
    }

    private function getNodeByName(Iterator $nodes, $name)
    {
        foreach ($nodes as $node) {
            if ($node->getName() === $name) {
                return $node;
            }
        }

        throw new ErrorException("Cannot locate node named {$name}.");
    }

    /**
     * Parses the source of the given file and returns the first package found
     * in that file.
     *
     * @param string $sourceFile
     *
     * @throws ErrorException
     *
     * @return ASTNamespace
     */
    private function parseSource($sourceFile)
    {
        if (file_exists($sourceFile) === false) {
            throw new ErrorException('Cannot locate source file: ' . $sourceFile);
        }

        $tokenizer = new PHPTokenizerInternal();
        $tokenizer->setSourceFile($sourceFile);

        $builder = new PHPBuilder();

        $parser = new PHPParserGeneric(
            $tokenizer,
            $builder,
            new MemoryCacheDriver()
        );
        $parser->parse();

        $ns = $builder->getNamespaces()->current();

        if (!$ns) {
            throw new Exception('Error getting namespace', 1);
        }

        return $ns;
    }
}

<?php

namespace SilverStripe\PHPMD\Tests\Functional;

use SilverStripe\PHPMD\Tests\Functional\AbstractProcessTest;

class ClassNamingTest extends AbstractProcessTest
{

    public function testRule()
    {
        $output = $this
            ->runPhpmd('ClassNamingFail.php', 'silverstripe.xml')
            ->getOutput();

        $this->assertContains('ClassNamingFail.php:2	The class DifferentFromFilename is not named correctly for the file ClassNamingFail.php.', $output);
    }

}

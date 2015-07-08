<?php

namespace SilverStripe\PHPMD\Tests\Functional;

use SilverStripe\PHPMD\Tests\Functional\AbstractProcessTest;

class UnusedInstancePrivateFieldTest extends AbstractProcessTest
{

    public function testRule()
    {
        $output = $this
            ->runPhpmd('UnusedInstancePrivateFieldClass.php', 'silverstripe.xml')
            ->getOutput();

        $this->assertContains('UnusedInstancePrivateFieldClass.php:6	Avoid unused private instance fields such as \'$unusedInstanceField\'', $output);
        $this->assertNotContains('$unused_static_field', $output);
        $this->assertNotContains('$usedInstanceField', $output);
    }

}

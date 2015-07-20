<?php

namespace SilverStripe\PHPMD\Tests\Functional;

use SilverStripe\PHPMD\Tests\Functional\AbstractProcessTest;

class CamelCaseInstancePropertyTest extends AbstractProcessTest
{

    public function testRule()
    {
        $output = $this
            ->runPhpmd('Foo.php', 'all.xml')
            ->getOutput();

        $this->assertContains('Foo.php:2	The instance property $invalid_snake_case is not named in camelCase.', $output);
        $this->assertNotContains('$valid_snake_case', $output);
    }

}

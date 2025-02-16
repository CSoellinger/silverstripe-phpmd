<?php
/**
 * This file is part of PHP Mess Detector.
 *
 * Copyright (c) Manuel Pichler <mapi@phpmd.org>.
 * All rights reserved.
 *
 * Licensed under BSD License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Manuel Pichler <mapi@phpmd.org>
 * @copyright Manuel Pichler. All rights reserved.
 * @license https://opensource.org/licenses/bsd-license.php BSD License
 * @link http://phpmd.org/
 */

class RuleDoesNotApplyWhenLocalVariableIsUsedInStaticMemberPrefix
{
    private static $_foo = 23;

    public static $foo = 17;

    public function bar()
    {
        self::${$_foo = 'foo'} = 42;
    }
}

$o = new RuleDoesNotApplyWhenLocalVariableIsUsedInStaticMemberPrefix();
$o->bar();
var_dump($o::$foo);

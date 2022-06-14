<?php

/**
 * This file is part of PHP Mess Detector.
 *
 * Copyright (c) Christopher Söllinger <christopher.soellinger@gmail.com>.
 * All rights reserved.
 *
 * Licensed under BSD License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author Christopher Söllinger <christopher.soellinger@gmail.com>
 * @copyright Christopher Söllinger. All rights reserved.
 * @license https://opensource.org/licenses/bsd-license.php BSD License
 * @link http://phpmd.org/
 */

class RuleDoesNotApplyForStaticVariableWrite
{
    private static $cache_countries = [];

    public function getCountries()
    {
        $locale = 'de_DE';
        $localised = [];

        static::$cache_countries[$locale] = $localised;
    }
}

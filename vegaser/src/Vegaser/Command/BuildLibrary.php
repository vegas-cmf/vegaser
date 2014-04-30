<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf/vegaser
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser\Command;

use Vegaser\BuildHelper;
use Vegaser\CommandInterface;

class BuildLibrary extends BuildHelper implements CommandInterface
{
    public function getName()
    {
        return 'build-library';
    }

    public function run($args)
    {
        $this->copyStub();
        file_put_contents('./build.xml', file_get_contents('phar://vegaser.phar/stub/library.build.xml'));
        passthru('phing');
    }
}
 
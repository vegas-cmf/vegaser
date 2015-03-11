<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf/vegaser
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser\Command;

use Vegaser\BuildHelperTrait;
use Vegaser\CommandInterface;

/**
 * Class BuildProject
 *
 * Build starter project using phing
 *
 * @package Vegaser\Command
 */
class BuildProject implements CommandInterface
{
    use BuildHelperTrait;

    /**
     * @return string
     */
    public function getName()
    {
        return 'build-project';
    }

    /**
     * @param $args
     */
    public function run($args)
    {
        $this->copyStub();
        file_put_contents(
            '.' . DIRECTORY_SEPARATOR . 'build.xml',
            str_replace(
                '{{DS}}',
                DIRECTORY_SEPARATOR,
                file_get_contents(
                    'phar://vegaser.phar' . DIRECTORY_SEPARATOR . 'stub' .  DIRECTORY_SEPARATOR . 'project.build.xml'
                )
            )
        );
        passthru('phing');
    }
}
 
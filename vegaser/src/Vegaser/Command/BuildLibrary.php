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

use Vegaser\Config;
use Vegaser\Tasks;
use Vegaser\CommandInterface;

/**
 * Class BuildLibrary
 *
 * Build library structure using phing
 *
 * @package Vegaser\Command
 */
class BuildLibrary extends Tasks implements CommandInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'build-library';
    }

    /**
     * @param $args
     */
    public function run($args)
    {
        $name = $this->askDefault('Enter library name', 'test');
        $namespace = $this->askDefault('Enter library namespace', 'Test');
        $description = $this->ask('Enter library description');
        $author_name = $this->ask('Enter author of package');
        $author_email = $this->ask('Enter author email');

        Config::set('name', $name);
        Config::set('namespace', $namespace);
        Config::set('description', $description);
        Config::set('author_name', $author_name);
        Config::set('author_email', $author_email);

        $this->_copyDir('phar://vegaser.phar/stub/library', $this->currentDir);

        foreach (Config::get() as $key => $value) {
            $this->taskReplaceInFile($this->currentDir . '/composer.json')->from('%%' . $key . '%%')->to($value)->run();
        }
    }
}
 
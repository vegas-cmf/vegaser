<?php
/**
 * This file is part of Vegas package
 *
 * @author Mateusz Aniolek <mateusz.aniolek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf/vegaser
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser;

use Symfony\Component\Console\Output\ConsoleOutput;
use Vegaser\Task\File\Write;

class Tasks extends \Robo\Tasks
{
    /**
     * @var string $currentDir
     */
    protected $currentDir;

    /**
     * Tasks constructor.
     */
    public function __construct()
    {
        $console = new ConsoleOutput();

        Config::setOutput($console);

        $this->currentDir = exec('pwd');
    }

    /**
     * @return mixed
     */
    protected function getOutput()
    {
        return Config::getOutput();
    }

    /**
     * @param $question
     * @param array $options
     * @param $default
     * @return mixed
     */
    protected function askWithOptions($question, array $options, $default)
    {
        foreach ($options as $key => $option) {

            $question .= "\n\t$key. $option";
        }
        $question .= "\n";

        $answer = $this->askDefault($question, $default);

        if (!isset($options[$answer])) {
            $this->say('Invalid option selected. Default option were choose.');
            return $default;
        }

        return $options[$answer];
    }

    /**
     * @param $file
     * @return Write
     */
    protected function taskWriteToFile($file)
    {
        return new Write($file);
    }
}
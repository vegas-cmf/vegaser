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

use Vegaser\CommandInterface;
use Vegaser\Config;
use Vegaser\Tasks;

/**
 * Class BuildModule
 * @package Vegaser\Command
 */
class BuildModule extends Tasks implements CommandInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'build-module';
    }

    /**
     * @param $args
     */
    public function run($args)
    {
        $moduleName = $this->askDefault('Enter name of project (eg. test):', 'Test');
        $moduleName = ucfirst($moduleName);

        \Vegaser\Config::set('module_name', $moduleName);

        $this->checkDirectories();

        $this->say("Preparing module directory...");
        $this->_copyDir('phar://vegaser.phar/stub/module', $this->currentDir . '/app/modules/' . ucfirst($moduleName) . '/');

        $this->say("Preparing files...");

        $this->prepareFiles();

        $this->say("Vegas CMF project has been created successfully!");
    }

    protected function prepareFiles()
    {
        $filesList = [
            'Component/Table.php',
            'Config/routes.php',
            'Controller/Frontend/IndexController.php',
            'Model/Dao/Test.php',
            'Model/Test.php',
            'Service/Foo.php',
            'View/Frontend/Index/index.volt',
            'Module.php'
        ];

        $configData = \Vegaser\Config::get();
        $configKeys = array_keys($configData);

        foreach($filesList as $file) {
            foreach ($configKeys as $value) {
                $this->taskReplaceInFile($this->currentDir . '/app/modules/' . $configData['module_name'] . '/' . $file)
                    ->from('%%' . $value . '%%')
                    ->to($configData[$value])
                    ->run();

            }
        }
    }

    protected function checkDirectories()
    {
        $configData = Config::get();

        if (file_exists($this->currentDir . '/app')) {
            $this->taskFilesystemStack()->mkdir($this->currentDir . '/app');
        }

        if (file_exists($this->currentDir . '/app/modules')) {
            $this->taskFilesystemStack()->mkdir($this->currentDir . '/app/modules');
        }

        if (file_exists($this->currentDir . '/app/modules/' . $configData['module_name'])) {
            $this->say('Module ' . $configData['module_name'] . ' exists');
            exit;
        }
    }
}
 
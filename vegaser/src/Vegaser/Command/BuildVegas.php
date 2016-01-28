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

use Robo\Config;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vegaser\CommandInterface;
use Vegaser\Tasks;

/**
 * Class BuildProject
 *
 * Build starter project using phing
 *
 * @package Vegaser\Command
 */
class BuildVegas extends Tasks implements CommandInterface
{
    /**
     * @var
     */
    protected $currentDir;

    /**
     * @return string
     */
    public function getName()
    {
        return 'build-vegas';
    }

    /**
     * @param $args
     */
    public function run($args)
    {
        $this->currentDir = exec('pwd');

        if(file_exists($this->currentDir . '/app')) {
            $this->yell('Project already exists');
            exit;
        }

        $projectName = $this->askDefault('Enter name of project (eg. vegas-demo):', 'vegas-demo');
        $projectDescription = $this->askDefault('Enter description of project', 'Project based on Vegas CMF');
        $projectDomain = $this->askDefault('Enter project domain', 'vegasdemo.com');
        $projectDatabase = $this->askDefault("Choose a database\n\t1. Mongo\n\t2. Mysql\n\t0. None\n", '0');
        $projectLocale = $this->askDefault('Enter project locale', 'nl_NL');

        \Vegaser\Config::set('project_name', $projectName);
        \Vegaser\Config::set('project_description', $projectDescription);
        \Vegaser\Config::set('project_domain', $projectDomain);
        \Vegaser\Config::set('project_database', $projectDatabase);
        \Vegaser\Config::set('project_locale', $projectLocale);

        $this->getOutput()->writeln("\n");

        $this->say("Preparing project directory...");

        $this->_copyDir('phar://vegaser.phar/stub/vegas', $this->currentDir);

        $this->say("Preparing configs...");

        $this->replaceConfigData('/composer.json');
        $this->replaceConfigData('/app/config/config.sample.php');

        $this->say("Preparing file permissions...");

        $this->taskFilesystemStack()
            ->touch('/app/config/services.php')
            ->chmod('/app/config/services.php', 0777)
            ->touch('/app/config/modules.php')
            ->chmod('/app/config/modules.php', 0777)
            ->copy('/app/config/config.sample.php', '/app/config/config.php')
            ->run();

        if(!file_exists($this->currentDir . '/composer.phar')) {
            $this->say("Composer download...");
            exec("curl -sS https://getcomposer.org/installer | php");
        }

        $this->say("Install vendors...");
        $this->taskComposerInstall()->optimizeAutoloader()->run();

        $this->getOutput()->writeln("\n");

        $this->say("Vegas CMF project has been created successfully!");
        $this->getOutput()->writeln("Run `php composer.phar install` to install vendors\n\nEnjoy!\n");
    }

    protected function replaceConfigData($file)
    {
        $configData = \Vegaser\Config::get();
        $configKeys = array_keys($configData);

        foreach($configKeys as $value) {
            $this->taskReplaceInFile($this->currentDir . $file)
                ->from('%%' . $value . '%%')
                ->to($configData[$value])
                ->run();

        }
    }

}
 
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
 * @package Vegaser\Command
 */
class BuildProject extends Tasks implements CommandInterface
{

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

        $databases = [
            1 => 'Mongo',
            2 => 'Mysql'
        ];

        $templates = [
            1 => 'Volt',
            2 => 'Twig',
            3 => 'Phtml'
        ];

        $projectName = $this->askDefault('Enter name of project (eg. vegas-demo):', 'vegas-demo');
        $projectDescription = $this->askDefault('Enter description of project', 'Project based on Vegas CMF');
        $projectDomain = $this->askDefault('Enter project domain', 'vegasdemo.com');
        $projectDatabase = $this->askWithOptions("Choose a database", $databases, '1');
        $projectTemplateEngine = $this->askWithOptions("Choose a template engine", $templates, '1');

        $projectLocale = $this->askDefault('Enter project locale', 'nl_NL');

        \Vegaser\Config::set('project_name', $projectName);
        \Vegaser\Config::set('project_description', $projectDescription);
        \Vegaser\Config::set('project_domain', $projectDomain);
        \Vegaser\Config::set('project_database_service', 'App\Shared\\' . $projectDatabase);
        \Vegaser\Config::set('project_template_initializer', 'App\Initializer\\' . $projectTemplateEngine);
        \Vegaser\Config::set('project_locale', $projectLocale);

        $templateClasses = array_search($projectTemplateEngine, $templates);
        unset($templates[$templateClasses]);

        $this->getOutput()->writeln("\n");

        $this->say("Preparing project directory...");

        $this->_copyDir('phar://vegaser.phar/stub/project', $this->currentDir);

        $this->say("Preparing configs...");

        $this->replaceConfigData('/composer.json');
        $this->replaceConfigData('/app/config/config.sample.php');

        $this->say("Preparing initializators...");
        $this->removeInitializers($templates);

        $this->say("Preparing file permissions...");

        $this->taskFilesystemStack()
            ->touch($this->currentDir . '/app/config/services.php')
            ->chmod($this->currentDir . '/app/config/services.php', 0777)
            ->touch($this->currentDir . '/app/config/modules.php')
            ->chmod($this->currentDir . '/app/config/modules.php', 0777)
            ->copy($this->currentDir . '/app/config/config.sample.php', $this->currentDir . '/app/config/config.php')
            ->run();

        if(!file_exists($this->currentDir . '/composer.phar')) {
            $this->say("Composer download...");
            exec("curl -sS https://getcomposer.org/installer | php");
        }

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

    protected function removeInitializers(array $params)
    {
        foreach ($params as $initializer) {
            $this->taskFilesystemStack()->remove($this->currentDir . '/app/initializers/'.$initializer.'.php')->run();
        }
    }
}
 
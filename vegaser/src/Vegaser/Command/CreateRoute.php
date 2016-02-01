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

use Symfony\Component\Console\Output\ConsoleOutput;
use Vegaser\CommandInterface;
use Vegaser\Config;
use Vegaser\Tasks;

/**
 * Class CreateRoute
 *
 * Route create usage:
 *
 * - php vegaser.phar create-route path route [ http-method ]
 *
 * @package Vegaser\Command
 */
class CreateRoute extends Tasks implements CommandInterface
{
    /**
     * @var string $httpMethod
     */
    protected $httpMethod;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var string $path
     */
    protected $path;

    /**
     * @var string $routePath
     */
    protected $routePath;

    /**
     * @var string $controllerPath
     */
    protected $controllerPath;

    /**
     * @return string
     */
    public function getName()
    {
        return 'create-route';
    }

    /**
     * @param $args
     */
    public function run($args)
    {
        if (count($args) < 2) {
            $this->say('Missing parameters');
            exit;
        }

        $this->path = $args[0];
        $this->url = $args[1];

        if(isset($args[2])) {
            $this->httpMethod = $args[2];
        }

        $path = $this->getPath();

        $this->controllerPath = $this->currentDir . '/app/modules/' . $path['module'] . '/Controller/' . $path['controller'] . 'Controller.php';
        $this->routePath = $this->currentDir . '/app/modules/' . $path['module'] . '/Config/routes.php';

        if (!$this->validateArguments()) {
            $this->say('Invalid parameters format');
            exit;
        }

        if ($this->validatePath($path)) {
            $this->say('Path is not valid');
            exit;
        }

        Config::set('module_name', $path['module']);
        Config::set('http_method', ucfirst(strtolower($this->httpMethod)));
        Config::set('url', $this->url);
        Config::set('controller_path', $path['controller']);
        Config::set('action_name', $path['action']);

        $this->addRoute();
        $this->addControllerAction();

        foreach (Config::get() as $key => $value) {
            $this->taskReplaceInFile($this->controllerPath)->from('%%' . $key . '%%')->to($value)->run();
            $this->taskReplaceInFile($this->routePath)->from('%%' . $key . '%%')->to($value)->run();
        }
    }

    protected function addRoute()
    {
        if (!file_exists($this->routePath)) {
            $this->taskFileSystemStack()->touch($this->routePath)->run();
            $this->taskWriteToFile($this->routePath)->line("<?php")->run();
        }

        $this->taskWriteToFile($this->routePath)
            ->textFromFile('phar://vegaser.phar/stub/route/route')->append()->run();
    }

    protected function addControllerAction()
    {
        if (!file_exists($this->controllerPath)) {
            $this->taskFileSystemStack()->touch($this->controllerPath)->run();
            $this->taskWriteToFile($this->controllerPath)->textFromFile('phar://vegaser.phar/stub/route/controller')->run();
        }

        $this->taskWriteToFile($this->controllerPath)
            ->read()->regexReplace('/\}$/',
                $this->taskWriteToFile($this->controllerPath)
                    ->textFromFile('phar://vegaser.phar/stub/route/action', true)
            )->run();

        $controllerPath = Config::get()['controller_path'];

        $slashPosition = strrpos($controllerPath, '\\');
        $controllerNamespace = substr($controllerPath, 0, $slashPosition);
        if (!empty($controllerNamespace)) {
            $controllerNamespace = '\\' . $controllerNamespace;
        }

        $controllerName = substr($controllerPath, $slashPosition);

        Config::set('controller_name', $controllerName);
        Config::set('controller_namespace', $controllerNamespace);
    }

    /**
     * @return bool
     */
    public function validateArguments()
    {
        if (!isset($this->httpMethod) || in_array(strtoupper($this->httpMethod), ['POST', 'GET', 'PUT'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool|string
     */
    protected function getPath()
    {
        if(empty($this->path)) {
           return false;
        }

        $firstSlash = strpos($this->path, '\\');
        $lastSlash = strrpos($this->path, '\\');

        $module = substr($this->path, 0, $firstSlash);
        $controller = substr($this->path, $firstSlash + 1, $lastSlash - $firstSlash - 1);
        $action = substr($this->path, $lastSlash + 1);

        return [
            'module' => $module,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * @param $path
     * @return bool
     */
    protected function validatePath($path)
    {
        if (!isset($path['module']) || !isset($path['controller']) || !isset($path['action'])) {
            return true;
        }

        return false;
    }
}
 
<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace App\Initializer;

use App\View\Extension\ToStringFilter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Vegas\Env;
use Vegas\Mvc\Application\InitializerInterface;

class Volt implements InitializerInterface
{
    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function initialize(\Phalcon\DiInterface $di)
    {
        /** @var \Phalcon\Config $config */
        $config = $di->get('config');

        if ($di->has('view')) {
            /** @var \Phalcon\Mvc\View $view */
            $view = $di->get('view');

            $viewEngines = $view->getRegisteredEngines();
            if (!$viewEngines) {
                $viewEngines = [];
            }

            $viewEngines['.volt'] = function ($this, $di) use ($config) {
                $viewConfig = isset($config->application->view) ? $config->application->view->toArray() : [];

                $volt = new VoltEngine($this, $di);
                $volt->setOptions($viewConfig['engines']['volt']);

                if($config->application->environment == Env::DEVELOPMENT) {
                    array_map('unlink', glob($viewConfig['cacheDir'] . '*.php'));
                }

                $volt->getCompiler()->addFilter('toString', (new ToStringFilter())->getFilter());
                return $volt;
            };

            $view->registerEngines($viewEngines);
        }
    }
}
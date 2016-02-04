<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace App\View\Extension;

/**
 * Class ToStringFilter
 * @package App\View\Extension
 */
class ToStringFilter implements \Vegas\Mvc\View\Engine\Volt\FilterInterface
{
    /**
     * @return \Closure
     */
    public function getFilter()
    {
        return function($resolvedArgs, $exprArgs) {
            return sprintf('(string)%s', $resolvedArgs);
        };
    }
}
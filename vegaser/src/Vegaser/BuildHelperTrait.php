<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://github.com/vegas-cmf
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vegaser;

/**
 * Class BuildHelper
 * @package Vegaser
 */
trait BuildHelperTrait
{

    /**
     * Because phing needs to use files from stub directory, we need to copy them to the
     * directory, to make them readable by phing.
     * When phing finishes work, this directory will be removed.
     */
    public function copyStub()
    {
        $source = 'phar://vegaser.phar' . DIRECTORY_SEPARATOR . 'stub';
        $dest = '.' . DIRECTORY_SEPARATOR . 'stub';
        shell_exec('mkdir ' . $dest);
        foreach (
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST) as $item
        ) {
            if ($item->isDir()) {
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }
}
 
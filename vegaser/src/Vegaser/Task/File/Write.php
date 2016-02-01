<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 01.02.16
 * Time: 14:48
 */

namespace Vegaser\Task\File;


class Write extends \Robo\Task\File\Write
{
    /**
     * add a text from a file
     *
     * @param string $filename
     * @param bool $return
     *
     * @return Write The current instance
     */
    public function textFromFile($filename, $return = false)
    {
        $text = file_get_contents($filename);
        $this->text($text);

        if ($return) {
           return $text;
        }

        return $this;
    }

    public function read()
    {
        $this->body = file_get_contents($this->filename);
        return $this;
    }

}
<?php
//script for building .phar file
//php build.php

$srcRoot = "."  . DIRECTORY_SEPARATOR . "vegaser" . DIRECTORY_SEPARATOR . "src";
$buildRoot = "." . DIRECTORY_SEPARATOR . "build";

if (file_exists($buildRoot . DIRECTORY_SEPARATOR . "vegaser.phar")) {
    unlink($buildRoot . DIRECTORY_SEPARATOR . "vegaser.phar");
}

$phar = new Phar($buildRoot . DIRECTORY_SEPARATOR . "vegaser.phar",
    FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, "vegaser.phar");
$phar["index.php"] = file_get_contents($srcRoot . DIRECTORY_SEPARATOR . "index.php");
$phar["common.php"] = file_get_contents($srcRoot . DIRECTORY_SEPARATOR . "common.php");
$phar->buildFromDirectory(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vegaser');
$phar->setStub($phar->createDefaultStub("index.php"));
<?php
$srcRoot = "./vegaser/src";
$buildRoot = "./build";

if (file_exists($buildRoot . "/vegaser.phar")) {
    unlink($buildRoot . "/vegaser.phar");
}

$phar = new Phar($buildRoot . "/vegaser.phar",
    FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, "vegaser.phar");
$phar["index.php"] = file_get_contents($srcRoot . "/index.php");
$phar["common.php"] = file_get_contents($srcRoot . "/common.php");
$phar->buildFromDirectory(dirname(__FILE__) . '/vegaser');
$phar->setStub($phar->createDefaultStub("index.php"));
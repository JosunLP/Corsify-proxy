<?php


namespace webapp_php_sample_class;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;

class Build
{
	/**
	 * @param $source
	 * @param $dest
	 */
	public static function copyFiles($source, $dest): void
    {
        if (is_dir($source)) {
            $dir = opendir($source);
            if (!mkdir($dest) && !is_dir($dest)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $dest));
            }
            while (($file = readdir($dir))) {
                if (($file !== '.') && ($file !== '..')) {
                    if (is_dir($source . '/' . $file)) {
                        self::copyFiles($source . '/' . $file, $dest . '/' . $file);
                    } else {
                        copy($source . '/' . $file, $dest . '/' . $file);
                    }
                }
            }
            closedir($dir);
        } else {
            copy($source, $dest);
        }
    }

	/**
	 * @param $dirPath
	 */
	public static function setupDir($dirPath): void
    {
        if (!is_dir($dirPath) && !mkdir($dirPath, 0755, true) && !is_dir($dirPath)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dirPath));
        }
        $it = new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dirPath);
        if (!file_exists($dirPath) && !mkdir($dirPath, 0755, true) && !is_dir($dirPath)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dirPath));
        }
    }


}

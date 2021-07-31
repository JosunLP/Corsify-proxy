<?php


namespace webapp_php_sample_class;


use JsonException;

class ConfigLoader
{
	/**
	 * @param $path
	 * @throws JsonException
	 */
	public static function loadConfig($path): void
    {
        $config = self::validateConfig($path);

        if ($config !== false) {

            foreach ($config as $firstLevel) {
                foreach ($firstLevel as $key => $value) {
                    define(strtoupper($key), $value);
                }
            }
            error_reporting(E_ALL);
        }
    }

	/**
	 * @param $path
	 * @return mixed
	 * @throws JsonException
	 */
	private static function validateConfig($path): mixed
	{
        $files = scandir($path);

        foreach ($files as $file) {
            $fileParts = explode('.', $file);

            if ($fileParts[0] === 'config' && $fileParts[1] === 'json') {
                $config = file_get_contents($path . $file);
                $configObj = json_decode($config, true, 512, JSON_THROW_ON_ERROR);

                if ($configObj['head']['title'] === 'configFile') {
                    return $configObj;
                }
            }
        }
        return false;
    }
}

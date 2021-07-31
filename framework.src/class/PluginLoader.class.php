<?php


namespace webapp_php_sample_class;


use JsonException;
use webapp_php_sample_obj\pluginConfigBundle;

class PluginLoader
{
    const PLUGIN_PATH = './custom/plugin/';

	/**
	 * @throws JsonException
	 */
	public static function loadPlugins(): void
    {
        self::loadPluginConfig();
        $pluginList = array_diff(scandir(self::PLUGIN_PATH), DEFAULT_FILE_FILTER);
        foreach ($pluginList as $plugin) {
            if (self::checkPluginManifest($plugin)) {
                include self::PLUGIN_PATH . $plugin . "/manifest.php";
            }
        }
    }

	/**
	 * @throws JsonException
	 */
	public static function loadPluginConfig(): void
    {
        $pluginList = array_diff(scandir(self::PLUGIN_PATH), DEFAULT_FILE_FILTER);
        $configBundle = new pluginConfigBundle();
        foreach ($pluginList as $plugin) {
            if (self::checkPluginManifest($plugin)) {
                $pluginConfig = file_get_contents(self::PLUGIN_PATH . $plugin . '/config/config.json');
                $configObj = json_decode($pluginConfig, true, 512, JSON_THROW_ON_ERROR);
                $configBundle->configList[] = $configObj;
            }
        }

        $configFile = json_encode($configBundle->configList, JSON_THROW_ON_ERROR, 512);
        file_put_contents('./config/plugin.config.json', $configFile);
    }

	/**
	 * @param $pluginName
	 * @return bool
	 */
	protected static function checkPluginManifest($pluginName): bool
    {
        $pluginContent = scandir(self::PLUGIN_PATH . $pluginName);
        foreach ($pluginContent as $pluginPart) {
            $fileParts = explode('.', $pluginPart);
            if ($fileParts[0] === 'manifest') {
                return TRUE;
            }
        }
        return FALSE;
    }
}

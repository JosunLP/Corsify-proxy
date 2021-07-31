<?php


namespace webapp_php_sample_class;


class Cli
{
	/**
	 *
	 */
	public static function designLine(): void
    {
        echo "\n--------------------------------------------------------------\n";
    }

	/**
	 * @return string
	 */
	public static function designInput(): string
    {
        echo "\nPlease enter a command: \n";
        return readline('$ ');
    }

	/**
	 * @param $helpEntries
	 */
	public static function designHelp($helpEntries): void
    {
        echo "\n";
        foreach ($helpEntries as $helpName => $helpEntry) {
            echo $helpName . '           - ' . $helpEntry . "\n";
        }
    }

	/**
	 *
	 */
	public static function checkIfCli(): void
    {
        if (PHP_SAPI !== 'cli') {
            ErrorHandler::FireCLIError('No CLI Error', 'The Interface you use isn\'t a valid CL');
            die();
        }
    }

}

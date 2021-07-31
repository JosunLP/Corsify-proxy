<?php


use webapp_php_sample_class\Build;
use webapp_php_sample_class\Cli;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Migration;

$command = 'start';
$help = [
    'help' => 'is used to show all commands',
    'exit' => 'exits the cli',
    'run' => 'deploy the app'
];

Cli::designHelp($help);
while ($command !== 'exit') {
    Cli::designLine();
    $command = str_replace('/\s+/', '', Cli::designInput());

    switch ($command) {

        case 'help':
            Cli::designHelp($help);
            break;

        case 'create':
			try {
				Migration::createSimpleModelMigration();
			} catch (JsonException $e) {
				ErrorHandler::FireCLIError($e->getCode(), $e->getMessage());
			}
			break;

        case 'run':
            Cli::designLine();
            Build::setupDir('../framework.dist');
            Build::copyFiles('../framework.src/class', '../framework.dist/class');
            Build::copyFiles('../framework.src/config', '../framework.dist/config');
            Build::copyFiles('../framework.src/content', '../framework.dist/content');
            Build::copyFiles('../framework.src/core', '../framework.dist/core');
            Build::copyFiles('../framework.src/custom', '../framework.dist/custom');
            Build::copyFiles('../framework.src/model', '../framework.dist/model');
            Build::copyFiles('../framework.src/page', '../framework.dist/page');
            Build::copyFiles('../framework.src/.htaccess', '../framework.dist/.htaccess');
            Build::copyFiles('../framework.src/API.php', '../framework.dist/API.php');
            Build::copyFiles('../framework.src/CLI.php', '../framework.dist/CLI.php');
            Build::copyFiles('../framework.src/index.php', '../framework.dist/index.php');
            Build::copyFiles('../framework.src/robots.txt', '../framework.dist/robots.txt');

            echo 'Deploy done!';
            break;

        case 'exit':
            $command = 'exit';
            break;

        default:
            Cli::designLine();
            echo 'Please use a valid command!';
            break;
    }
}

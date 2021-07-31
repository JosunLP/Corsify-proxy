<?php

use webapp_php_sample_class\Cli;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Migration;

$command = 'start';
$help = [
    'help' => 'is used to show all commands',
    'exit' => 'exits the cli',
    'migrate' => 'runs the migrations against the Database',
    'create' => 'creates a migration based on the model classes',
    'list' => 'lists all migrations',
    'custom' => 'create a custom migration based on the user inputs',
    'check' => 'check all previous migrations run on the database'
];

$helpC = [
    'help' => 'is used to show all commands',
    'create table' => 'is used to create a new table',
    'alter table' => 'is used to update/ad table entries',
    'update table' => 'is used to update table columns'
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

        case 'custom':
            echo "What kind of migration do you want to create? \n";
            Cli::designHelp($helpC);
            $migrateMode = null;
            while ($migrateMode !== "exit") {
                $migrateMode = Cli::designInput();

                switch ($migrateMode) {
                    case 'create table':
                        echo "What is the name of your Migration? \n";
                        $mName = Cli::designInput();
                        echo "What is the name of your Table? \n";
                        $tName = Cli::designInput();
                        echo "How many columns do you want to ad? \n";
                        $cSum = null;
                        while ($cSum === null) {
                            try {
                                $cSum = (int)Cli::designInput();
                            } catch (Exception $e) {
                                $cSum = null;
                                ErrorHandler::FireCLIError($e->getCode(), $e->getMessage());
                            }
                        }

                        $rows = [];

                        for ($i = 0; $i < $cSum; $i++) {
                            echo "Please enter the column Name: \n";
                            $key = Cli::designInput();
                            echo "Please enter the column restrictions \n";
                            $val = Cli::designInput();
                            $pair = [$key => $val];
                            $rows[] = $pair;
                        }
                        Migration::createMigration($mName, 'create', $tName, $rows, null, null);
                        echo "\n";
                        echo 'Migration created!';
                        echo "\n";
                        break;

                    case 'help':
                        Cli::designHelp($helpC);
                        break;

                    default:
                        echo 'Please enter a valid mode';
                        break;
                }

            }
            break;

        case 'check':
            echo "\n";
            if ($obj = Migration::checkFiredMigrations()) {
                foreach ($obj as $key => $value) {
                    foreach ($value as $item) {
                        echo $key . ' : ' . $item . "\n";
                    }
                }
                echo "done\n";
                break;
            }

            echo "check failed!\n";
            break;

        case 'migrate':
            echo "\n";
            if (Migration::loadMigrations()) {
                echo "\n Migrations done! \n";
            } else {
                echo "\n Something went wrong! \n";
            }
            break;

        case 'list':
            echo "\n";
            echo "List: \n";
            Migration::listMigrations();
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

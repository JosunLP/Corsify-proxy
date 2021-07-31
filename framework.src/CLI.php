<?php

use webapp_php_sample_class\Cli;

include "core/loader/core.loader.php";

$CLIString = "./core/CLI/";

$CLIFiles = array_diff(scandir($CLIString), DEFAULT_FILE_FILTER);

Cli::checkIfCli();

$command = null;

echo "commands:\n";

foreach ($CLIFiles as $file) {
    $fileName = explode(".", $file);
    echo "    " . $fileName[0] . "\n";
}

echo "\n\n";

$mode = readline("Please insert the cli mode you want to use: \n");

while (!in_array($mode . ".CLI.php", $CLIFiles, true)) {
    echo "The command you used is invalid \n";

    $mode = Cli::designInput();
}

foreach ($CLIFiles as $file) {
    $fileName = explode(".", $file);

    if ($fileName[0] === $mode) {
        include $CLIString . $file;
    }
}

<?php


namespace webapp_php_sample_class;

use JsonException;
use mysqli;
use webapp_php_sample_obj\pageMap;
use webapp_php_sample_obj\pageObj;

class StartUp
{
	/**
	 * @return string
	 * @throws JsonException
	 */
	public static function loadPages(): string
    {
        $files = self::dirCheck('page/open/');

        $fileMap = new pageMap();
        $fileMapExplicit = $fileMap::$PageMap;

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $fileObj = new pageObj();
                $filePart = explode('.', $file);
                $fileObj->Path = 'page/open/' . $file;
                $fileLines = file($fileObj->Path);

                $titleCheckLine = $fileLines[4];
                $titleCheckParts = explode(':', $titleCheckLine);
                $titleCheckParts = explode(';', $titleCheckParts[1]);

                $titleCheck = filter_var(
                    str_replace(' ', '', $titleCheckParts[0]),
                    FILTER_VALIDATE_BOOLEAN);
                $fileObj->Name = $filePart[0];
                $fileObj->File = $file;

                $masterCheckLine = $fileLines[5];
                $masterCheckParts = explode(':', $masterCheckLine);
                $masterCheckParts = explode(';', $masterCheckParts[1]);

                $fileObj->Master = str_replace(' ', '', $masterCheckParts[0]);

                if ($titleCheck === true) {
                    $fileObj->IsSet = TRUE;
                } elseif ($titleCheck === false) {
                    $fileObj->IsSet = FALSE;
                }

                if ($filePart[0] !== 'Home') {
                    $fileMapExplicit[] = $fileObj;
                } elseif ($filePart[0] === 'Home') {
                    array_unshift($fileMapExplicit, $fileObj);
                }
            }
        }

        $fileJSON = json_encode($fileMapExplicit, JSON_THROW_ON_ERROR, 512);
        file_put_contents('./config/pagemap.config.json', $fileJSON);
        return $fileJSON;
    }

	/**
	 * @param $dir
	 * @return array
	 */
	private static function dirCheck($dir): array
    {
        $dirPath = $dir . '/';
        $files = array_diff(scandir($dirPath), DEFAULT_FILE_FILTER);

        foreach ($files as $file) {

            $nameParts = explode('.', $file);

            if ($nameParts[1] === $dir || $file !== '.' || $file !== '..') {
                continue;
            }

            echo "<script>console.log('$file')</script>";
            die("Not all files in the folder correspond to the 'expample." . $dir . ".php' pattern!");
        }
        return $files;
    }

	/**
	 *
	 */
	public static function checkDatabaseStatus(): void
    {
        $databaseLink = self::loadDatabase();
        $sqlFile = fopen('core/database/setup/webapp_php_sample.sql', 'rb');
        $tableRequest = 'SHOW TABLES';
        $sqlLines = fread($sqlFile, filesize('core/database/setup/webapp_php_sample.sql'));

        if ($result = $databaseLink->query($tableRequest, MYSQLI_USE_RESULT)) {
            while ($rArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                foreach ($rArray as $table) {
                    if (!in_array($table, DATABASE_TABLE_LIST, true)) {
                        $databaseLink->query($sqlLines);
                    }
                }
            }
        }
        fclose($sqlFile);
    }

	/**
	 * @return mysqli
	 */
	public static function loadDatabase(): mysqli
    {
        $db_link = new mysqli(
            MYSQL_HOST,
            MYSQL_USER,
            MYSQL_KEYWORD,
            MYSQL_DATABASE
        );

        if (!$db_link) {
            $db_link->query('CREATE DATABASE IF NOT EXISTS ' . MYSQL_DATABASE . ';');
            die('Connection is dead:' . mysqli_connect_error());
        }

        return $db_link;
    }
}

<?php


namespace webapp_php_sample_class;


use mysqli_result;

class DatabaseHandler
{
	/**
	 * @param $mode
	 * @param $tableName
	 * @param $rows
	 * @param $values
	 * @param $valueString
	 * @return mixed
	 */
	public static function createSqlRequest($mode, $tableName, $rows, $values, $valueString): mixed
	{
        $db_link = StartUp::loadDatabase();
        switch ($mode) {
            case 'insert':
                $joinRow = implode(', ', $rows);
                $valueRow = implode("', '", $values);
                $requestString = "INSERT INTO " . $tableName . "  (" . $joinRow . ") VALUES ('" . $valueRow . "')";
                if ($result = $db_link->query($requestString)) {
                    return $result;
                }

                return false;
                break;

            case 'alter':
                foreach ($rows as $row => $datatype) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . " " . $datatype;
                    if ($result = $db_link->query($requestString)) {
                        return $result;
                    }

                    return false;
                }
                break;
            case 'create':
                $check = null;
                $tableRows = [];
                foreach ($rows as $row) {
                    foreach ($row as $key => $data) {
                        $var = $key . ' ' . $data;
                        $tableRows[] = $var;
                    }
                }
                $joinRow = implode(', ', $tableRows);
                $requestString = "CREATE TABLE " . $tableName . " ( " . $joinRow . " ) ";
                if ($db_link->query($requestString)) {
                    $check = true;
                } else {
                    echo "create request failed \n";
                    die();
                }
                if ($check === false) {
                    echo "something went wrong \n";
                }
                break;
            case 'select':
                if (is_array($rows)) {
                    $rows = implode(', ', $rows);
                }
                if ($valueString !== null) {
                    $requestString = 'SELECT ' . $rows . ' FROM ' . $tableName . ' WHERE ' . $valueString;
                } else {
                    $requestString = 'SELECT ' . $rows . ' FROM ' . $tableName;
                }

                if ($result = $db_link->query($requestString, MYSQLI_USE_RESULT)) {
                    while ($obj = $result->fetch_all(MYSQLI_ASSOC)) {
                        return $obj;
                    }
                }
                ErrorHandler::FireWarning('Database Warning', 'The SELECT request failed');

                break;
            case 'update':
                foreach ($values as $key => $value) {
                    $setValue = $key . ' = "' . $value . '"';
                    $requestString = 'UPDATE ' . $tableName . ' SET ' . $setValue . ' WHERE ' . $valueString;
                    $db_link->query($requestString, MYSQLI_USE_RESULT);
                }
                return true;
                break;
            default:
                ErrorHandler::FireWarning('Database Warning', 'No Sql request mode chosen');
                break;
        }
    }
}

<?php


namespace webapp_php_sample_class;


use JsonException;

class JsonHandler
{
	/**
	 * @param $key
	 * @param $value
	 * @throws JsonException
	 */
	public static function FireSimpleJson($key, $value): void
    {
        $array = [[$key => $value]];
        try {
			$json = self::BuildJson($array);
			echo $json;
		} catch (JsonException $e) {
        	ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
		}
    }

	/**
	 * @param $objectArray
	 * @return bool|string
	 * @throws JsonException
	 */
	public static function BuildJson($objectArray): bool|string
	{
        $arrayMaster = [];
        foreach ($objectArray as $value) {
            $arrayMaster[] = $value;
        }
        return json_encode($arrayMaster, JSON_THROW_ON_ERROR, 512);
    }

}

<?php

namespace webapp_php_sample_class;

use Error;
use JetBrains\PhpStorm\Pure;
use JsonException;
use RuntimeException;

/**
 * Class ErrorHandler
 * @package webapp_php_sample_class
 */
class ErrorHandler
{
    /** Constant Footer
     *  The Footer String that is used for each Sweet Alert Popup
     */
    private const FOOTER = '<span>For help ask at <a href="https://gitlab.com/waps/framework">https://gitlab.com/waps/framework</a></span>';

    /**
     * The message type
     * @param $type
     * The message content
     * @param $message
     */
    public static function FireError($type, $message): void
    {
    	try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
    		self::FireError($e->getCode(), $e->getMessage());
		}
        echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
    }

    /**
     * The log key
     * @param $key
     * The log message
     * @param $message
     */
    protected static function CreateLog($key, $message): void
    {
        $logPath = './custom/log/crashlog/';
        $files = array_diff(scandir($logPath), DEFAULT_FILE_FILTER);
        $currentDate = date('Y_m_d');
        $newLine = self::WriteLogLine($key, $message);

        if (!in_array($currentDate . '.log', $files, true)) {
            $file = fopen($logPath . $currentDate . '.log', 'wb') or die('Unable to create log file!');
            fclose($file);
        }

        foreach ($files as $file) {
            if ($file === $currentDate) {
                $logFile = fopen($currentDate . '.log', 'ab') or die('Unable to open log file!');
                fwrite($logFile, $newLine);
                fclose($logFile);
            }
        }
    }

    /**
     * The log key
     * @param $key
     * The log message
     * @param $message
     * The method returns a string, containing the log message and timestamp
     * @return string
     */
    #[Pure] private static function WriteLogLine($key, $message): string
    {
        $clientIp = Main::checkRequest('post', 'ip');
        $ip = Main::getRealIp();
        $currentDate = date('Y.m.d_H:i:s');
        return '[' . $currentDate . ']:  (' . $clientIp . '/' . $ip . ') - Error Key: ' . $key . ' | Error Message: ' . $message . ' ;';
    }

    /**
     * The message type
     * @param $type
     * The message content
     * @param $message
     */
    public static function FireWarning($type, $message): void
    {
		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			self::FireError($e->getCode(), $e->getMessage());
		}
        echo "<script>Swal.fire({type: 'warning', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";
    }

    /**
     * The message type
     * @param $type
     * The message content
     * @param $message
     */
    public static function FireSuccess($type, $message): void
    {
		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			self::FireError($e->getCode(), $e->getMessage());
		}
        echo "<script>Swal.fire({type: 'success', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";
    }

    /**
     * The error type
     * @param $type
     * The error message
     * @param $message
     * The weight of the error
     * @param $weight
     * The confirm that the error is fatal
     * @param $isFatal
     */
    public static function CreateError($type, $message, $weight, $isFatal): void
    {
        if ($weight >= 3 && $isFatal) {
			try {
				self::CreateLog($type, $message);
			} catch (Error $e) {
				self::FireError($e->getCode(), $e->getMessage());
			}
            throw new RuntimeException("<script>Swal.fire({type: 'error', title: '$type', text: '$message . This is a fatal Error!', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>");
        }

        if ($weight <= 3 && !$isFatal) {
			try {
				self::CreateLog($type, $message);
			} catch (Error $e) {
				self::FireError($e->getCode(), $e->getMessage());
			}
            echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
        }
    }

	/**
	 * The message type
	 * @param $type
	 * The message content
	 * @param $message
	 * @throws JsonException
	 */
    public static function FireJsonError($type, $message): void
    {
		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			self::FireError($e->getCode(), $e->getMessage());
		}
        JsonHandler::FireSimpleJson($type, $message);
    }

    /**
     * The message type
     * @param $type
     * The message content
     * @param $message
     */
    public static function FireCLIError($type, $message): void
    {
		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			self::FireError($e->getCode(), $e->getMessage());
		}
        echo '[' . date('YmdHis') . '|' . $type . ']' . '{' . $message . '}';
    }
}

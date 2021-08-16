<?php

namespace webapp_php_sample_class;

use FFI\Exception;
use webapp_php_sample_class\ErrorHandler;

/**
 * Class FeedValidator
 * @package webapp_php_sample_class
 */
class FeedValidator
{
    /**
     * The validation of a rss feed
     * @param $feed
     */
    public static function validate_RSS(string $feed): bool
    {
        return self::checkForXmlFields($feed, "channel");
    }

    /**
     * The validation of a atom feed
     * @param $feed
     */
    public static function validate_ATOM(string $feed): bool
    {
        return self::checkForXmlFields($feed, "subtitle");
    }

    /**
     * The check for specific XML fields
     * @param $xml string of the xml to check
     * @param $target string check value
     */
    private static function checkForXmlFields(string $xml, $target): bool
    {
        try {
            $obj = simplexml_load_string($xml);
        } catch(Exception $e) {
            ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
            die;
        }

        try {
            if (property_exists($obj, $target)) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            ErrorHandler::FireJsonError('Bad input', 'The data you tried to load does not contain a valid feed.');
            die;
        }
    }
}

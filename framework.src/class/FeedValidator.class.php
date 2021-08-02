<?php

namespace webapp_php_sample_class;

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
        $data = DatatypeConverter::xml2json($feed);
        $obj = json_decode($data);

        if (is_bool($data, false)) {
            return false;
        }

        if ($obj->rss) {
            return true;
        }

        return false;
    }

    /**
     * The validation of a atom feed
     * @param $feed
     */
    public static function validate_ATOM(string $feed): bool
    {
        $data = DatatypeConverter::xml2json($feed);
        $obj = json_decode($data);

        if (is_bool($data, false)) {
            return false;
        }

        if ($obj->feed) {
            return true;
        }

        return false;
    }
}

<?php

namespace seregazhuk\PinterestBot\Helpers\Providers;

use seregazhuk\PinterestBot\Exceptions\AuthException;
use seregazhuk\PinterestBot\Helpers\RequestHelper;

class PinnerHelper extends RequestHelper
{

    /**
     * Creates Pinterest API request to get user info according to
     * username, API url and bookmarks for pagination
     *
     * @param string $username
     * @param string $sourceUrl
     * @param array  $bookmarks
     * @return array
     */
    public static function createUserDataRequest($username, $sourceUrl, $bookmarks)
    {
        $dataJson = self::createPinnerRequestData($username);

        return self::createRequestData($dataJson, $sourceUrl, $bookmarks);
    }

    /**
     * Parses Pinterest API response with pinner name
     *
     * @param $res
     * @return null
     */
    public static function parseAccountNameResponse($res)
    {
        if (isset($res['resource_data_cache'][1]['resource']['options']['username'])) {
            return $res['resource_data_cache'][1]['resource']['options']['username'];
        }

        return null;
    }

    /**
     * Creates Pinterest API request to login
     *
     * @param string $username
     * @param string $password
     * @return array
     */
    public static function createLoginRequest($username, $password)
    {
        $dataJson = [
            "options" => [
                "username_or_email" => $username,
                "password"          => $password
            ],
        ];
        return self::createRequestData($dataJson, "/login/");
    }

    /**
     * Parses Pintrest Api response after login
     *
     * @param array $res
     * @return bool
     * @throws AuthException
     */
    public static function parseLoginResponse($res)
    {
        if (self::checkMethodCallResult($res)) {
            throw new AuthException($res['resource_response']['error']['message']);
        }

        return true;
    }

    /**
     * Creates common Pinner request data by username
     *
     * @param string $username
     * @return array
     */
    protected static function createPinnerRequestData($username)
    {
        return [
            "options" => [
                "username" => $username,
            ],
        ];
    }

}
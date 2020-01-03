<?php

namespace Sponteweb\API;

class Settings
{
    const BASE_URL = "http://webservices.sponteweb.com.br/WSApiSponteRest/api/";
    private static $API_KEY = "";

    public static function setApiKey(string $apiKey): void
    {
        self::$API_KEY = $apiKey;
    }

    public static function getApiKey(): string
    {
        return self::$API_KEY;
    }
}
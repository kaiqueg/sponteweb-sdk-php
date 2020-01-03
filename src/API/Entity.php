<?php

namespace Sponteweb\API;

use SdkBase\API\Entity as SdkEntity;

abstract class Entity extends SdkEntity
{
    protected function getAuthorizationHeader(): array
    {
        return [
            "api_key: " . Settings::getApiKey(),
        ];
    }

    protected function getEndpointUrlExtension(array $postFields = []): string
    {
        return "?";
    }

    protected function injectSettingsData(array $postFields): array
    {
        return $postFields;
    }
}
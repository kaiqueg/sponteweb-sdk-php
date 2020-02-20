<?php

namespace Sponteweb\API\Entities;

use SdkBase\Exceptions\Flow\UnimplementedMethodException;
use Sponteweb\API\Entity;
use Sponteweb\API\Settings;

class ClassEntity extends Entity
{

    protected function getIdVariableName(): string
    {
        return "class_id";
    }

    protected function getEndpointUrl(): string
    {
        return Settings::BASE_URL . "classes";
    }

    public function toArray(): array
    {
        return [
            $this->getIdVariableName() => $this->getId(),
            "name" => $this->getName(),
            "situation" => $this->getSituation(),
            "time" => $this->getTime(),
        ];
    }

    public function isValid(): bool
    {
        $time = $this->getTime();
        return $time && $time !== "(Migração)";
    }

    public function getName(): ?string
    {
        return $this->getProperty("name");
    }

    public function getSituation(): ?string
    {
        return $this->getProperty("situation");
    }

    public function getTime(): ?string
    {
        return $this->getProperty("time");
    }

    /**
     * @param array $postFields
     * @throws UnimplementedMethodException
     */
    public function save(array $postFields = []): void
    {
        throw new UnimplementedMethodException();
    }

    /**
     * @param array $postFields
     * @throws UnimplementedMethodException
     */
    public function delete(array $postFields = []): void
    {
        throw new UnimplementedMethodException();
    }
}
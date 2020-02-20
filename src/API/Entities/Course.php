<?php

namespace Sponteweb\API\Entities;

use SdkBase\Exceptions\Flow\UnimplementedMethodException;
use Sponteweb\API\Entity;
use Sponteweb\API\Settings;

class Course extends Entity
{

    protected function getIdVariableName(): string
    {
        return "course_id";
    }

    protected function getEndpointUrl(): string
    {
        return Settings::BASE_URL . "courses";
    }

    public function toArray(): array
    {
        return [
            $this->getIdVariableName() => $this->getId(),
            "name" => $this->getName(),
            "abbreviation" => $this->getAbbreviation(),
            "active" => (int)$this->isActive(),
        ];
    }

    public function isActive(): bool
    {
        return $this->getProperty("active") == 1;
    }

    public function getName(): ?string
    {
        return $this->getProperty("name");
    }

    public function getAbbreviation(): ?string
    {
        return $this->getProperty("abbreviation");
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
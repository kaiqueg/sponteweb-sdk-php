<?php

namespace Sponteweb\API\Entities;

use DateTime;
use SdkBase\Exceptions\Http\NotFoundException;
use Sponteweb\API\Entity;
use Sponteweb\API\Settings;

class Student extends Entity
{
    const SITUATION_ACTIVE = -1;
    const SITUATION_INACTIVE = -2;

    protected function getIdVariableName(): string
    {
        return "student_id";
    }

    public function toArray(): array
    {
        return [
            "student_id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "spontenet" => [
                "username" => $this->getSponteNetUsername(),
                "password" => $this->getSponteNetPassword(),
            ],
            "birthdate" => $this->getBirthdate(),
            "situation" => $this->getSituation(),
            "active" => $this->isActive(),
        ];
    }

    protected function getEndpointUrl(): string
    {
        return Settings::BASE_URL . "students";
    }

    public function getSituation(): array
    {
        $situation = $this->getProperty("situation");
        return is_array($situation) ? $situation : [];
    }

    public function isActive(): bool
    {
        $situation = $this->getSituation();
        return !empty($situation['situation_id']) && $situation['situation_id'] === self::SITUATION_ACTIVE;
    }

    public function getName(): ?string
    {
        return $this->getProperty("name");
    }

    public function getEmail(): ?string
    {
        return $this->getProperty("email");
    }

    public function getAge(): int
    {
        $birthdate = $this->getBirthdate();
        if(!$birthdate) {
            return 0;
        }
        try {
            $birthdate = new DateTime($birthdate);
        } catch (\Exception $e) {
            return 0;
        }
        return (new DateTime())->diff($birthdate)->y;
    }

    public function getBirthdate(): ?string
    {
        $birthdate = $this->getProperty("birthdate");
        return $birthdate ? date("Y-m-d", strtotime($birthdate)) : null;
    }

    public function getGender(): ?string
    {
        return $this->getProperty("gender");
    }

    public function getCpf(): ?string
    {
        return $this->getProperty("cpf");
    }

    public function getRg(): ?string
    {
        return $this->getProperty("rg");
    }

    public function getAddress(): ?string
    {
        return $this->getProperty("address");
    }

    public function getNumber(): ?string
    {
        return $this->getProperty("number");
    }

    public function getDistrict(): ?string
    {
        return $this->getProperty("district");
    }

    public function getCity(): ?string
    {
        return $this->getProperty("city");
    }

    public function getState(): ?string
    {
        return $this->getProperty("state");
    }

    public function getZipCode(): ?string
    {
        return $this->getProperty("zip_code");
    }

    public function getHomePhone(): ?string
    {
        return $this->getProperty("home_phone");
    }

    public function getCellPhone(): ?string
    {
        return $this->getProperty("cell_phone");
    }

    public function getJob(): ?string
    {
        return $this->getProperty("job");
    }

    public function getSponteNetUsername(): ?string
    {
        return $this->getProperty("spontenet_username");
    }

    public function getSponteNetPassword(): ?string
    {
        return $this->getProperty("spontenet_password");
    }

    public function fetch($id, array $postFields = []): void
    {
        $postFields[$this->getIdVariableName()] = $id;
        $result = $this->curlPOST(
            "{$this->getEndpointUrl()}",
            $postFields
        );
        $result = $this->decodeResult($result);
        if(empty($result)) {
            throw new NotFoundException();
        }
        $this->fetchResult($result[0], $postFields);
    }
}
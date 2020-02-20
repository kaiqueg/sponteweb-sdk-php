<?php

namespace Sponteweb\API\Entities;

use SdkBase\Exceptions\Flow\UnimplementedMethodException;
use SdkBase\Exceptions\Http\BadRequestException;
use SdkBase\Exceptions\Http\ConflictException;
use SdkBase\Exceptions\Http\ForbiddenException;
use SdkBase\Exceptions\Http\GatewayTimeoutException;
use SdkBase\Exceptions\Http\InternalServerErrorException;
use SdkBase\Exceptions\Http\MethodNotAllowedException;
use SdkBase\Exceptions\Http\NotFoundException;
use SdkBase\Exceptions\Http\NotImplementedException;
use SdkBase\Exceptions\Http\ServiceUnavailableException;
use SdkBase\Exceptions\Http\TooManyRequestsException;
use SdkBase\Exceptions\Http\UnauthorizedException;
use SdkBase\Exceptions\Http\UnavailableForLegalReasonsException;
use SdkBase\Exceptions\Validation\UnexpectedResultException;
use SdkBase\Exceptions\Validation\UnexpectedValueException;
use SdkBase\Exceptions\Validation\WorthlessVariableException;
use Sponteweb\API\Entity;
use Sponteweb\API\Settings;

class Timeline extends Entity
{

    protected function getEndpointUrl(): string
    {
        return Settings::BASE_URL . "timeline";
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "student_id" => $this->getStudentId(),
            "responsible_id" => $this->getResponsibleId(),
            "title" => $this->getTitle(),
            "subtitle" => $this->getSubtitle(),
            "type" => $this->getType(),
            "record_date" => $this->getRecordDate(),
            "readed" => $this->isReaded(),
        ];
    }

    public function isReaded(): bool
    {
        return (bool)$this->getProperty("read");
    }

    public function getTitle(): ?string
    {
        return $this->getProperty("title");
    }

    public function getSubtitle(): ?string
    {
        return $this->getProperty("subtitle");
    }

    public function getType(): ?string
    {
        return $this->getProperty("type");
    }

    public function getRecordDate(): ?string
    {
        $date = $this->getProperty("record_date");
        if(!$date) {
            return null;
        }
        return date("Y-m-d H:i:s", strtotime($date));
    }

    public function getStudentId(): int
    {
        return (int)$this->getProperty("student_id");
    }

    public function getResponsibleId(): int
    {
        return (int)$this->getProperty("responsible_id");
    }

    /**
     * @param $id
     * @param array $postFields
     * @throws UnimplementedMethodException
     */
    public function fetch($id, array $postFields = []): void
    {
        throw new UnimplementedMethodException();
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

    /**
     * @throws UnexpectedValueException
     * @throws BadRequestException
     * @throws ConflictException
     * @throws ForbiddenException
     * @throws GatewayTimeoutException
     * @throws InternalServerErrorException
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws NotImplementedException
     * @throws ServiceUnavailableException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws UnavailableForLegalReasonsException
     * @throws UnexpectedResultException
     * @throws WorthlessVariableException
     */
    public function setReaded(): void
    {
        if(!$this->existsOnVendor()) {
            throw new UnexpectedValueException("Object not populated");
        } elseif($this->isReaded()) {
            throw new UnexpectedValueException("Timeline already readed");
        }
        $id = $this->getId();
        $result = $this->curlPUT(
            $this->getEndpointUrl(),
            [
                "timeline_id" => $id,
                "readed" => true,
            ]
        );
        $result = $this->decodeResult($result);
        if($result['error']) {
            throw new UnexpectedResultException($result['error']);
        }
        $this->setProperty("readed", true);
    }
}
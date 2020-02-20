<?php

namespace Sponteweb\API\Collectors;

use SdkBase\API\Collector;
use SdkBase\Exceptions\Http\BadRequestException;
use SdkBase\Exceptions\Http\ConflictException;
use SdkBase\Exceptions\Http\ForbiddenException;
use SdkBase\Exceptions\Http\InternalServerErrorException;
use SdkBase\Exceptions\Http\MethodNotAllowedException;
use SdkBase\Exceptions\Http\NotFoundException;
use SdkBase\Exceptions\Http\UnauthorizedException;
use SdkBase\Exceptions\Validation\UnexpectedResultException;
use SdkBase\Exceptions\Validation\UnexpectedValueException;
use SdkBase\Exceptions\Validation\WorthlessVariableException;
use Sponteweb\API\Entities\Student;

class StudentCollector extends Collector
{
    const LOOP_ITERATION_LIMIT = 20;

    protected static function getListJsonPath(): string
    {
        return __DIR__ . "/cache/students.json";
    }

    protected static function getCollectionJsonPath(): string
    {
        return __DIR__ . "/cache/students-collection.json";
    }

    protected static function getTemporaryCollectionJsonPath(): string
    {
        return __DIR__ . "/cache/tmp-students-collection.json";
    }

    /**
     * @return array
     * @throws BadRequestException
     * @throws ConflictException
     * @throws ForbiddenException
     * @throws InternalServerErrorException
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws UnexpectedResultException
     * @throws UnexpectedValueException
     * @throws WorthlessVariableException
     */
    protected function getListFromVendor(): array
    {
        $API = new Student();
        $students = $API->search([
            "active" => "true",
        ]);
        $list = [];
        if (!empty($students)) {
            foreach ($students as $student) {
                /** @var Student $student */
                $list[] = $student->toArray();
            }
        }
        return $list;
    }

    /**
     * @param array $item
     * @return array
     * @throws BadRequestException
     * @throws ConflictException
     * @throws ForbiddenException
     * @throws InternalServerErrorException
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws UnexpectedResultException
     * @throws UnexpectedValueException
     * @throws WorthlessVariableException
     */
    protected function collectItem(array $item): array
    {
        $studentEntity = new Student();
        $studentEntity->fetch($item['student_id']);
        sleep(1);
        return $studentEntity->toArray();
    }
}
<?php


namespace Acfabro\RegistrationSiteKit\Core\UseCase;


use Illuminate\Support\MessageBag;

/**
 * Interface ResponseInterface
 *
 * Interface for the output boundary
 *
 * @package Acfabro\RegistrationSiteKit\Core\UseCase
 */
interface ResponseInterface
{
    public function getStatus(): string;
    public function getCode(): string;
    public function getMessage(): string;
    public function getErrors(): MessageBag;
    public function getData(): array;
    public function getDataItem(string $name);

    public function setStatus(string $status): ResponseInterface;
    public function setStatusSuccess(): ResponseInterface;
    public function setStatusFailed(): ResponseInterface;
    public function setCode(string $code): ResponseInterface;
    public function setMessage(string $message): ResponseInterface;
    public function setErrors(MessageBag $errors): ResponseInterface;
    public function setData(array $data): ResponseInterface;
    public function setDataItem(string $name, $value): ResponseInterface;


}

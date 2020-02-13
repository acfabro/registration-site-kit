<?php


namespace Acfabro\RegistrationSiteKit\Core\UseCase;


use Illuminate\Support\MessageBag;

class Response implements ResponseInterface
{
    const STATUS_FAILED = 'failed';
    const STATUS_SUCCESS = 'success';

    public function __construct($status=Response::STATUS_FAILED, $message='', $code=0, $errors=[])
    {
        $this->status = $status;
        $this->message = $message;
        $this->code = $code;
        $this->errors = $errors;
    }

    /**
     * @var string error code if any
     */
    protected $code;

    /**
     * @var MessageBag array of validation errors
     */
    protected $errors;

    /**
     * @var string respone status
     */
    protected $status;

    /**
     * @var string response message
     */
    protected $message;

    /**
     * @var array Data objects that need to be returned to the caller
     */
    protected $data = [];

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return MessageBag
     */
    public function getErrors(): MessageBag
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $code
     * @return Response
     */
    public function setCode(string $code): ResponseInterface
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param MessageBag $errors
     * @return Response
     */
    public function setErrors(MessageBag $errors): ResponseInterface
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param string $status
     * @return Response
     */
    public function setStatus(string $status): ResponseInterface
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage(string $message): ResponseInterface
    {
        $this->message = $message;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getDataItem(string $name)
    {
        return $this->data[$name]? $this->data[$name]: null;
    }

    public function setData(array $data): ResponseInterface
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $name name of the data item
     * @param mixed $value value of any type
     * @return ResponseInterface
     */
    public function setDataItem(string $name, $value): ResponseInterface
    {
        $this->data[$name] = $value;
        return $this;
    }

    public function setStatusSuccess(): ResponseInterface
    {
        $this->setStatus(Response::STATUS_SUCCESS);
        return $this;
    }

    public function setStatusFailed(): ResponseInterface
    {
        $this->setStatus(Response::STATUS_FAILED);
        return $this;
    }
}

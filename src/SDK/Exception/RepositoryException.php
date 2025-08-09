<?php

namespace WeeWorxxSDK\SharedResources\SDK\Exception;

use Exception;

class RepositoryException extends Exception
{
    protected int $status;
    protected $message;

    public function __construct(string $message, int $status = 500)
    {
        $this->message = $message;
        parent::__construct($message, $status);
        $this->status = $status;
    }

    public function render($request)
    {
        return response($this->message, $this->status)->header('Content-Type', 'text/html');
    }
}
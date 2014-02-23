<?php
namespace core;

use core\GException;

class NotfoundException extends GException
{
    public function __construct($message, $code=404)
    {
        parent::__construct($message, $code);
    }
}
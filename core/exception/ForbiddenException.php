<?php

namespace app\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'Acceso no autorizado, no dispones de los permisos suficientes para acceder a esta página.';
    protected $code = 403;
}
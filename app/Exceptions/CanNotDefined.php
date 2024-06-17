<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCodeEnum;
use Exception;

class CanNotDefined extends Exception implements IApplicationException
{
    public function __construct($code = HttpStatusCodeEnum::UNAUTHORIZED)
    {
        $message = trans('Plant Is Not Defined');
        parent::__construct($message, $code);
    }
}

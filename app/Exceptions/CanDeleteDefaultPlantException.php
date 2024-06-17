<?php

namespace App\Exceptions;

use App\Enum\HttpStatusCodeEnum;
use Exception;

class CanDeleteDefaultPlantException extends Exception implements IApplicationException
{
public function __construct( $code = HttpStatusCodeEnum::UNAUTHORIZED){
        $message=trans('can Not Delete this Default Plant');
        parent::__construct($message,$code);
}
}

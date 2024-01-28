<?php

namespace Inklo\Exceptions;

use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class CustomExceptionHandler implements IExceptionHandler
{
	public function handleError(Request $request, \Exception $error): void
	{
        response()->httpCode($error->getCode())->json([
            'error' => $error->getMessage(),
            'code'  => $error->getCode(),
        ]);
	}
    
}

<?php

namespace App\Exceptions;

use Log;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        // ModelNotFoundException::class,
        ValidationException::class,
    ];

    protected $captureException = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(true && $this->captureException($exception)){
            return $this->returnJsonError($exception);
        }

        return parent::render($request, $exception);
    }

    public function returnJsonError($exception)
    {
        if ($exception instanceof ModelNotFoundException){
            return $this->ModelNotFoundToJson($exception);
        }

        try{
            $code = $exception->getCode();
            $message = $exception->getMessage();
            if (method_exists($exception, 'getStatusCode')) {
                $response_code = $exception->getStatusCode();
            }else{
                $response_code = 404;
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
        }

        return response([
            'code'=>$code,
            'message'=>$message,
        ],$response_code);
    }

    public function ModelNotFoundToJson($exception)
    {
        $model = class_basename($exception->getModel());
        $ids = implode($exception->getIds(), ',');
        return response([
            'code'=>$exception->getCode(),
            'message'=>'['.$model.'] 中没有记录 ['.$ids.']',
        ],404);
    }

    public function captureException($exception)
    {
        foreach ($this->captureException as $exc) {
            if ($exception instanceof $exc) {
                return true;
            }
        }
        return false;
    }
}

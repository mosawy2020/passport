<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception) ) {
            $code = $exception->getStatusCode();
            switch ($code) {
                case '404':
                    return response()->json(['status' => 'fail','message' => 'الصفحة غير موجودة' , 'data' => null],404);
                    break;
                case '403':
                    return response()->json(['status' => 'fail','message' => 'ليس لديك صلاحيات الدخول' , 'data' => null],403);
                    break;
                default:
                    return response()->json(['status' => 'fail','message' => 'الصفحة غير موجودة' , 'data' => null],403);
                    break;
            }
        }



        if ($exception instanceof ModelNotFoundException ) {
            return response()->json(['status' => 'fail','message' => "لم يتم العثور علي بيانات",'data'=> null ],404);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json(['status' => 'fail','message' => 'قم بتسجيل الدخول أولا' , 'data' => null ],401);
        }
        return parent::render($request, $exception);


    }

}

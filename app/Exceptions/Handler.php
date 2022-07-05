<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Psy\Exception\FatalErrorException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
    public function register()
    {
        $this->reportable(function (Exception $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        DB::rollback();
        
        if ($request->wantsJson()) {   //Add Accept: application/json in request
            return $this->handleApiException($request, $exception);
        } else {
            $retval = parent::render($request, $exception);
        }
        return $retval;
    }

    private function handleApiException($request, $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }
        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                break;
        }

        $message = $response['message'];
        unset($response['message']);
        if (config('app.debug')) {
            $response['trace'] = $exception->exception ?? "";
            $message = $exception->getMessage();
            return $this->sendResponse($response, $message, $statusCode);
        }
        return $this->sendResponse((object) array(), $message, $statusCode);
    }
}

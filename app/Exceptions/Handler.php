<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     * @var string[]
     * @author JalalZadeh
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var string[]
     * @author JalalZadeh
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * @return void
     * @author JalalZadeh
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Custom unauthenticated exception message
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|RedirectResponse
     * @author JalalZadeh
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? \responseMessage(__('auth.unauthenticated'), 401)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    /**
     * Custom validation exception message, Change exists rule to ModelNotFoundException
     * @param ValidationException $e
     * @param Request $request
     * @return JsonResponse|Response
     * @throws Throwable
     * @author JalalZadeh
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        if ($request->expectsJson()) {
            $this->convertValidationRules($e);

            $e = new ValidationException($e->validator, (
            \response()->json([
                'code' => $e->status,
                'timestamp' => now()->timestamp,
                'message' => __('exceptions.ValidationException'),
                'errors' => $e->errors()
            ], $e->status)
            ), $e->errorBag);
        }
        return parent::convertValidationExceptionToResponse($e, $request);
    }

    /**
     * Convert validation rules
     * @param ValidationException $exception
     * @return void
     * @throws Throwable
     * @author JalalZadeh
     */
    public function convertValidationRules(ValidationException $exception)
    {
        collect($exception->validator->failed())->each(function ($failed, $key) {
            throw_if(collect($failed)->keys()->contains('Exists'), (new ModelNotFoundException())->setModel($key));
        });
    }

    /**
     * Change exception to our response before raising
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     * @author JalalZadeh
     */
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            switch (get_class($e)) {
                case AuthorizationException::class:
                    return responseMessage(__('exceptions.AuthorizationException'), 403);
                case ThrottleRequestsException::class:
                    return responseMessage(__('exceptions.ThrottleRequestsException'), 429);
                case MethodNotAllowedHttpException::class:
                    return responseMessage(__('exceptions.MethodNotAllowedHttpException'), 405);
                case ModelNotFoundException::class:
                    return responseMessage(__('exceptions.ModelNotFoundException', [
                        'attribute' => __('validation.attributes.' . strtolower(last(explode('\\', $e->getModel()))))
                    ]), 404);
                case NotFoundHttpException::class:
                    return responseMessage(__('exceptions.NotFoundHttpException'), 404);
                case \Exception::class:
                    return responseMessage($e->getMessage(), $e->getCode());
                default:
                    return parent::render($request, $e); //!!config('app.debug') ? parent::render($request, $e) : responseMessage($e->getMessage(), $e->getCode());
            }
        }
        return parent::render($request, $e);
    }
}

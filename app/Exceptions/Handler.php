<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Http\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    use JsonResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class,

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->wantsJson()) {
            return $this->jsonResponse(401, __('general::lang.mustLogin'), [__('general::lang.mustLogin')]);
        }

        $guard = Arr::get($exception->guards(), 0);
        switch($guard){
            case 'admin':
                $login = 'admin.auth.getLogin';
                break;
            default:
                $login = 'admin.auth.getLogin';
                break;
        }

        return redirect()->guest(route($login));
    }
}

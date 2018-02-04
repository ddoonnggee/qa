<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Auth;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            if (Auth::check()){
                return parent::render($request, $e);
            }else{
                return redirect(route('admin.dashboard.index'));
            }
        }
        if ($this->isHttpException($e))
        {
            if ($e->getStatusCode() == '403' && $request->ajax()) {
                return response()->json(
                    [
                        'status' => trans('messages.permission_denied'),
                        'type' => 'error',
                        'code' => 403,
                    ]
                );
            }
            else {
                return $this->renderHttpException($e);
            }
        }
        else
        {
            return parent::render($request, $e);
        }
    }
}
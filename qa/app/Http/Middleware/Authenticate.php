<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    protected $permission_fields = [
        'view'   => ['index','show'],
        'create' => ['create','store'],
        'update' => ['edit','update'],
        'delete' => ['destroy'],
    ];

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 403);
            } else {
                return redirect()->guest('auth/login');
            }
        }
        if (!$request->user()->isAdmin() && $request->user()->cannot('dashboard_view')) {
            $this->auth->logout();
            return redirect()->guest('auth/login')->withErrors(trans('messages.permission_denied'));
        }
        $route_array = explode('.', $request->route()->getName());
        $permission_name = array_search($route_array[2],array_dot($this->permission_fields));
        if($permission_name){
            $route_array[2] =  explode('.', $permission_name)[0];
        }
        // $route_name = implode('_', $route_array);
        $route_name = $route_array[1].'_'.$route_array[2];
        if (!$request->user()->isAdmin() && $request->user()->cannot($route_name)) { //PATCH 为null
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => trans('messages.permission_denied'),
                        'type' => 'error',
                        'code' => 403,
                    ]
                );
            }
            else {
                return view('errors.403');
            }
        }

        return $next($request);
    }
}

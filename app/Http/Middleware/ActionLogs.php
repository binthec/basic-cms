<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use App\ActionLog;


class ActionLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        if (!$request->isMethod('GET') && !empty($request->all())){

            $actionLog = new ActionLog();
            $actionLog->user_id = ($request->user()) ? $request->user()->id : null;
            $actionLog->remote_address = $request->ip();
            $actionLog->route_action = preg_replace(['/App\\\Http\\\Controllers\\\Backend\\\/', '/@.*$/'], '', Route::currentRouteAction());
            $actionLog->method = $request->method();

            $requestData = $request->except('_token', 'password', 'password_confirmation');
            $actionLog->request = !empty($requestData)? json_encode($requestData) : null;
            $actionLog->save();
        }

        return $response;

    }
}

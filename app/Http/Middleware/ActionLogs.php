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

        if (!$request->isMethod('GET') && !empty($request->all())) {

            $actionLog = new ActionLog();
            $actionLog->user_id = ($request->user()) ? $request->user()->id : null;
            $actionLog->remote_address = $request->ip();
            $actionLog->controller = preg_replace(['/App\\\Http\\\Controllers\\\Backend\\\/', '/Controller@.*$/'], '', Route::currentRouteAction());
            $actionLog->action = preg_replace('/.*@/', '', Route::currentRouteAction());
            $actionLog->method = $this->getMethod($request, $actionLog->route_action);

            $requestData = $request->except('_token', 'password', 'password_confirmation');
            $actionLog->request = !empty($requestData) ? json_encode($requestData) : null;

            $actionLog->save();

        }

        return $response;

    }

    /**
     * 操作のメソッド名を返すメソッド。
     * ログイン・ログアウトの場合はLOGIN・LOGOUT、それ以外は$request->method()を返す
     *
     * @param $request
     * @param $routeAction
     * @return string
     */
    protected function getMethod($request, $routeAction)
    {

        //ログイン・ログアウトの場合はネーミングルートを大文字にして返す
        if($routeAction === ActionLog::LOGIN_CONTROLLER){
            return strtoupper(Route::currentRouteName());
        }

        return $request->method();

    }
}

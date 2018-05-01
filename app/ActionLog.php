<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ActionLog extends Model
{
    /**
     * 操作内容
     */
    const LOGIN = 'LOGIN';
    const LOGOUT = 'LOGOUT';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    static $actionLabels = [
        self::LOGIN => 'ログイン',
        self::LOGOUT => 'ログアウト',
        self::POST => '新規作成',
        self::PUT => '編　　集',
        self::DELETE => '削　　除',
    ];

    static $labelColor = [
        self::LOGIN => 'label-info',
        self::LOGOUT => 'label-info',
        self::POST => 'label-success',
        self::PUT => 'label-warning',
        self::DELETE => 'label-danger',
    ];

    /**
     * 機能名
     */
    const ACTIVITY_CONTROLLER = 'ActivityController';
    const EVENT_CONTROLLER = 'EventController';
    const HOME_CONTROLLER = 'HomeController';
    const TOPIMAGE_CONTROLLER = 'TopimageController';
    const USER_CONTROLLER = 'UserController';
    const LOGIN_CONTROLLER = 'Auth\LoginController';

    static $controllers = [
        self::ACTIVITY_CONTROLLER => '活動の様子',
        self::EVENT_CONTROLLER => 'カレンダー',
        self::HOME_CONTROLLER => 'ホーム',
        self::TOPIMAGE_CONTROLLER => 'トップ画像',
        self::USER_CONTROLLER => 'ユーザ管理',
        self::LOGIN_CONTROLLER => '認証',
    ];

    /**
     * 検索条件のクエリを返すメソッド
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getSearchQuery($data)
    {

        $query = ActionLog::query();
        $query->orderBy('created_at', 'desc'); //日付の新しい順に並べる

        //機能で検索
        if (!empty($data['func_name'])) {
            $query->where('route_action', $data['func_name']);
        }

        //操作内容で検索
        if (!empty($data['method_name'])) {
            $query->where('method', $data['method_name']);
        }

        //ユーザIDで検索
        if (!empty($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }

        //ログの日時で検索
        if (!empty($data['date_start'])) {
            $query->where('created_at', '>=', getStdDateTimeFromNormal($data['date_start']));
        }
        if (!empty($data['date_end'])) {
            $query->where('created_at', '<=', getStdDateTimeFromNormal($data['date_end']));
        }

        return $query;
    }

    /**
     * ユーザIDに対応するユーザ名を返すメソッド
     *
     * @return mixed|string
     */
    public function getUserName()
    {
        if ($this->user_id !== null) {
            return User::getUserNames()[$this->user_id];
        }
        return 'ー';
    }

    /**
     * 機能名を返すメソッド
     *
     * @return string
     */
    public function getFuncName()
    {

        if ($this->route_action !== null) {

//            if ($this->route_action === self::LOGIN_CONTROLLER) {
//                //ログインの場合は、値の有無によってログインがログアウトか見分ける
//                return empty($this->request)? self::$actionLabels[self::LOGOUT] : self::$actionLabels[self::LOGIN];
//            } else {
                //それ以外はコントローラ名を出力
                return \App\ActionLog::$controllers[$this->route_action];
//            }

        }

        return '-';

    }
}

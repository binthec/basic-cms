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

    public static function getSearchQuery($data)
    {

        $query = ActionLog::query();
        $query->orderBy('created_at', 'desc'); //日付の新しい順に並べる

//        if (!empty($data['start_date'])) {
//            $query->where('email', 'like', '%' . $data['email'] . '%');
//        }

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
}

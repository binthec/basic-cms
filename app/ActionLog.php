<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        if (!empty($data['user_name'])) {
            $query->where('id', $data['user_name']);
        }

        //ログの日時で検索
        if (!empty($data['date_start'])) {
            $query->where('created_at', '>=', getStdDate($data['date_start']) . ' 00:00:00');
        }
        if (!empty($data['date_end'])) {
            $query->where('created_at', '<=', getStdDate($data['date_end']) . ' 23:59:59');
        }

//        dd($query);

        return $query;
    }
}

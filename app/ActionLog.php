<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    /**
     * 操作内容
     */
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public $actionLabels = [
        self::POST => '新規作成',
        self::PUT => '編集',
        self::DELETE => '削除',
    ];
}

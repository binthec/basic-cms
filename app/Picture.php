<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    /**
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 所有している picturable モデルの全取得
     * picturable は多分造語…？
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function picturable()
    {
        return $this->morphTo();
    }
}

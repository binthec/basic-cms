<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable = ['title', 'date'];

//    public $dates = ['date'];

    /**
     * バリデーションルールを返すメソッド
     *
     * @param bool $storeFlg
     * @return array
     */
    static function getValidationRules()
    {
        $rules = [
            'title' => 'required',
            'date' => 'required',
        ];

        return $rules;
    }
}

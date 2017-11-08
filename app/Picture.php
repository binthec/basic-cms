<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Picture extends Model
{

    protected $guarded = ['id'];

    /**
     * mimeTypeを見て、拡張子を統一させる処理
     *
     * @param $file
     * @return string
     */
    public static function getPictExt($file)
    {

        $ext = 'jpg';

        switch ($file->getMimeType()) {
            case 'image/jpeg':
            case 'image/jpg':
                $ext = "jpg";
                break;

            case 'image/png':
                $ext = "png";
                break;

            case 'image/gif':
                $ext = "gif";
                break;
        }

        return $ext;
    }

    /**
     * Dropzone.jsからXHRで渡された画像を一時ディレクトリに保存するメソッド
     *
     * @param Request $request
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public static function pictStore(Request $request, $model)
    {

        Log::info(print_r($model::$paramName, true));

        //画像名生成
        $fileName = $request->baseFileName . '.' . self::getPictExt($request->file($model::$paramName));

        //画像をstorageの一時ファイルに保存
        $request->file($model::$paramName)->move(storage_path($model::$tmpFilePath), $fileName);

        return response()->json(['code' => '200', 'fileName' => $fileName]);

    }

    /**
     * Dropzone.js から削除ボタンを押された時に呼び出されるメソッド
     *
     * @param Request $request
     * @param $model
     * @return \Illuminate\Http\JsonResponse
     */
    public static function pictDelete(Request $request, $model)
    {

        Log::info(print_r($request->fileName, true));

        //一時ディレクトリに該当ファイルがあれば削除
        if (File::exists(storage_path($model::$tmpFilePath) . $request->fileName)) {

            File::delete(storage_path($model::$tmpFilePath) . $request->fileName);
            return response()->json(['code' => '200', 'msg' => '削除に成功しました。']);

        } else {

            return response()->json(['code' => '500', 'msg' => 'ファイルが存在しないため、削除に失敗しました。']);

        }

    }

    public function getPictPath($model, $prefix = '')
    {

        //こっちでもうまくいくけどなぜか構文エラーでPHPStormに怒られる
//        return $this->target_type::$baseFilePath . $this->target_id . '/' . $this->name;

        return $model::$baseFilePath . $this->target_id . '/' . $prefix . $this->name;
    }

}

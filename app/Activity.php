<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Picture;
use Illuminate\Support\Facades\File;

class Activity extends Model
{

    /**
     * ソフトデリートを使う
     */
    use SoftDeletes;

    /**
     * ステータス
     */
    const OPEN = 1;
    const CLOSE = 99;

    static $statusList = [
        self::OPEN => '公　開',
        self::CLOSE => '非公開',
    ];


    /**
     * アップロード先ディレクトリの絶対パス
     *
     * @var string
     */
    public $uploadDir = '';

    /**
     * 活動の様子に使う画像を格納するディレクトリパス
     *
     * @var string
     */
    public $baseFilePath = '/files/activity/';

    /**
     * 活動の様子に使う画像のファイル名
     *
     * @var string
     */
    public $baseFileName = 'photo';

    /**
     * バリデーションメッセージ
     *
     * @var array
     */
    static $validationMessages = [
        //
    ];

    /**
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        //グローバルスコープ追加。活動の様子は基本的に開催日の新しい順に並べる
        static::addGlobalScope('date', function (Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }

    /**
     * コンストラクタ。ちゃんと親を呼び出しましょう。
     */
    public function __construct()
    {
        parent::__construct();
        $this->uploadDir = public_path() . $this->baseFilePath;
    }

    /**
     * 公開ステータスのものだけ取得する場合のローカルスコープ
     *
     * @param $query
     * @return mixed
     */
    public function scopeOpen($query)
    {
        return $query->where('status', self::OPEN);
    }

    /**
     * 活動の様子の全画像の取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany('App\Picture', 'picturable');
    }

    /**
     * バリデーションルールを返すメソッド
     *
     * @param bool $storeFlg
     * @return array
     */
    static function getValidationRules($storeFlg = false)
    {
        $rules = [
            'title' => 'required',
            'date' => 'required',
            'place' => 'required',
            'status' => 'required',
        ];

//        if($storeFlg === true){
//            $rules = array_merge($rules, ['images' => 'required']);
//        }

        return $rules;

    }

    /**
     * 活動の様子を保存するメソッド
     *
     * @param Request $request
     */
    public function saveAll(Request $request)
    {


        $this->title = ($request->title !== null) ? $request->title : null;
        $this->date = getStdDate($request->date); //必須項目
        $this->place = $request->place; //必須項目
        $this->detail = ($request->detail !== null) ? $request->detail : null;
        $this->status = $request->status; //必須項目
        $this->save();

        //画像が設定されている場合は保存処理
        if ($request->hasFile('photo')) {

            $picture = new Picture;
            $picture->name = 'photo';
            $picture->order = 1; //TODO
            $picture->extention = $request->file('photo')->getClientOriginalExtension();
            $picture->picturable_id = $this->id;
            $picture->picturable_type = 'Activity';
            $picture->save();

            $uploadDir = $this->uploadDir . $this->id . '/';
            $fileName = $this->baseFileName . '.' . $picture->extention;

            //ディレクトリが空でなければ一旦空にする
            if (File::exists($uploadDir) && !empty(File::files($uploadDir))) {
                File::cleanDirectory($uploadDir);
            }

            //公開ディレクトリに移動、保存
            $request->file('photo')->move($uploadDir, $fileName);

            /**
             * リサイズ処理
             */
//            $image = Picture::make($uploadDir . $fileName);
//            $image->crop(750, 500)->save($uploadDir . 'h700.' . $this->extention);
        }

    }

}

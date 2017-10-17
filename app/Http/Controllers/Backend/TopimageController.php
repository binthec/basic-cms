<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Topimage;

class TopimageController extends Controller
{
    /**
     * １ページに表示する件数
     */
    const PAGINATION = 10;

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $topimages = Topimage::paginate(self::PAGINATION);
        return view('backend.topimage.index', compact('topimages'));
    }

    /**
     * 新規作成画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $topimage = new Topimage;
        return view('backend.topimage.edit', compact('topimage'));
    }

    /**
     * 新規作成実行
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Topimage::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $topimage = new Topimage;
            $topimage->saveAll($request);

            DB::commit();
            return redirect('/topimage')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }

    }

    /**
     * 編集画面表示
     *
     * @param Topimage $topimage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Topimage $topimage)
    {
        return view('backend.topimage.edit', compact('topimage'));
    }

    public function update(Request $request, Topimage $topimage)
    {
        $validator = Validator::make($request->all(), Topimage::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

//        DB::beginTransaction();
//
//        try {

            $topimage->saveAll($request);

//            DB::commit();
            return redirect('/topimage')->with('flashMsg', '登録が完了しました。');

//        } catch (\Exception $e) {
//
//            Log::error($e->getMessage());
//            DB::rollback();
//            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');
//
//        }
    }
}

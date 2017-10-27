<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Validator;
use App\Activity;

class ActivityController extends Controller
{
    /**
     * １ページに表示する件数
     */
    const PAGINATION = 20;

    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $activities = Activity::paginate(self::PAGINATION);
        return view('backend.activitiy.index', compact('activities'));
    }

    /**
     * 新規作成画面表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $activitiy = new Activity;
        return view('backend.topimage.edit', compact('activitiy'));
    }

    /**
     * 新規作成実行
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Activity::getValidationRules(true));
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $activitiy = new Activity;
            $activitiy->saveAll($request);

            DB::commit();
            return redirect('/activitiy')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }

    }

    /**
     * 編集画面表示
     *
     * @param Activity $activitiy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Activity $activitiy)
    {
        return view('backend.activitiy.edit', compact('activitiy'));
    }

    /**
     * 編集実行
     *
     * @param Request $request
     * @param Activity $activitiy
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Activity $activitiy)
    {
        $validator = Validator::make($request->all(), Activity::getValidationRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $activitiy->saveAll($request);

            DB::commit();
            return redirect('/activitiy')->with('flashMsg', '登録が完了しました。');

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('flashErrMsg', '登録に失敗しました。');

        }
    }

    /**
     * 削除実行
     *
     * @param Activity $activitiy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Activity $activitiy)
    {
        if (File::exists($activitiy->uploadDir . $activitiy->id)) {
            File::deleteDirectory($activitiy->uploadDir . $activitiy->id);
        }

        $activitiy->delete();

        return redirect('/activitiy')->with('flashMsg', '削除が完了しました。');
    }
}

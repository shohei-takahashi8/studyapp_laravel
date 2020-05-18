<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudy;
use App\Http\Requests\EditStudy;
use Carbon\Carbon;
use App\Category;
use App\Study;

class StudyController extends Controller
{
    public function index(Request $request) {
        $dt = Carbon::create($request->year, $request->month,$request->day);
        $dt_formatted = $dt->format('Y-m-d');
        $year = $dt->year;
        $month = sprintf('%02d',$dt->month);
        $day = sprintf('%02d',$dt->day);

        //ログイン中のユーザーのカテゴリのみ取得
        $categories = Category::where('user_id', Auth::id())->get(['id','title']);

        //学習記録を取得
        $study_records = Auth::user()->studies()->where('study_date', $dt_formatted)->get();

        //編集用のid取得
        $edit_id = $request->edit_id;
        
        return view('study/index', [
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'categories' => $categories,
            'study_records' => $study_records,
            'edit_id' => $edit_id
        ]);
    }

    public function create(CreateStudy $request) {
        $study = new Study();
        $study->category_id = $request->category;
        $study->body = $request->body;
        $study->time = $request->time;
        $study->study_date = $request->study_date;
        $study->save();

        return back();
    }

    public function edit(Study $study, EditStudy $request) {
        //403チェック
        $study_edit_check = Auth::user()->studies()->where('studies.id', $study->id)->get();
        if(!$study_edit_check) {
            abort(403);
        }

        $study_edit = Study::find($study->id);
        $study_edit->body = $request->body_edit;
        $study_edit->time = $request->time_edit;
        $study_edit->save();

        $dt = new Carbon($request->date);
        $year = $dt->year;
        $month = $dt->month;
        $day = $dt->day;

        return redirect('/study?year=' . $year . '&month=' . $month . '&day=' . $day);
    }

    public function delete(Study $study) {
        //403チェック
        $study_delete_check = Auth::user()->studies()->where('studies.id', $study->id)->get();
        if(!$study_delete_check) {
            abort(403);
        }

        $study_delete = Study::find($study->id);
        $study_delete->delete();

        return back();
    }
}

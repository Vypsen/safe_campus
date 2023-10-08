<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    function indexScore(Request $request)
    {
        $data = $request->all();
        $sources = Score::query()->pluck('source')->unique();
        $schools = Comment::query()->pluck('school')->unique()->toArray();

        $from = $data['from'] ? : '2000.01.01';
        $to = $data['to'] ? : '9999.12.31';
        $class = $data['class'] ? : '';

        $scorse = DB::select("select * from main_fun('model_nagative', '2021-01-01', '9999-09-01' )
        where label1 = ". $class .";");

        return $scorse;


        array_shift($schools);
//        return $schools;
        return view('map', ['sources' => $sources, 'schools' => $schools, 'opacity' => $opacity]);
    }

    function getSchoolInfo(Request $request)
    {
        $ru_school = Comment::query()->where('school', $request->all()['school'])->get('ru_school')->first();
        return $ru_school['ru_school'];
    }
}

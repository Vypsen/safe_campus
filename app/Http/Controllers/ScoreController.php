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

        $from = !empty($data['from']) ? $data['from'] : '2010-01-01';
        $to =  !empty($data['to']) ? $data['to'] : '2023-12-31';
        $class = !empty($data['class']) ? $data['class'] : 'negative';
        $model =  !empty($data['model']) ? $data['model'] : 'negative_model';

        $opacity = DB::select("select share, school from main_fun2('$model', '$from', '$to' )
        where label1 = '". $class ."' and school!='NaN';");

        array_shift($schools);

        return view('map', ['sources' => $sources, 'schools' => $schools, 'opacity' => $opacity]);
    }

    function getSchoolInfo(Request $request)
    {
        $data = $request->all();

        $from = !empty($data['from']) ? $data['from'] : '2010-01-01';
        $to =  !empty($data['to']) ? $data['to'] : '2023-12-31';
        $class = !empty($data['class']) ? $data['class'] : 'negative';
        $model =  !empty($data['model']) ? $data['model'] : 'negative_model';
        $school = $request->all()['school'];
        $graf = DB::select("select * from main_fun3('$model', '$school')");

        $ru_school = Comment::query()->where('school', $request->all()['school'])->get('ru_school')->first();
        return [$ru_school['ru_school'], $graf] ;
    }
}

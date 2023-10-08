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

        $from = array_key_exists('from', $data) ? $data['from'] : '2000.01.01';
        $to =  array_key_exists('to', $data) ? $data['to'] : '9999.12.31';
        $class = array_key_exists('class', $data) ? $data['class'] : '';
        $model = array_key_exists('model', $data) ? $data['model'] : '';

        $opacity = DB::select("select share, school from main_fun2('$model', '$from', '$to' )
        where label1 = '". $class ."' and school!='NaN';");

        array_shift($schools);

        return view('map', ['sources' => $sources, 'schools' => $schools, 'opacity' => $opacity]);
    }

    function getSchoolInfo(Request $request)
    {
        $ru_school = Comment::query()->where('school', $request->all()['school'])->get('ru_school')->first();
        return $ru_school['ru_school'];
    }
}

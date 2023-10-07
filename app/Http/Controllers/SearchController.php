<?php

namespace App\Http\Controllers;


use App\Models\Score;
use Illuminate\Support\Facades\Request;

class SearchController extends Controller
{
    function indexScore(Request $request)
    {
        $sources = Score::query()->pluck('source')->unique();
        return view('map', ['sources' => $sources]);
    }
}

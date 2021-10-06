<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;

class StudentController extends Controller
{
    public function index()
    {
        $data = DB::connection(session('database'))->table('project__bids')->select(DB::raw('area as area'), DB::raw('count(*) as number'))->groupBy('area')->get();

        $array[] = ['Area', 'Number'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [$value->area, $value->number];
        }
        return view('student.student')->with('area', json_encode($array));
    }
}

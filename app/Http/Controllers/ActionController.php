<?php
namespace App\Http\Controllers;

use App\Models\Report;

class ActionController extends Controller
{
    public function index()
    {
        $reports = Report::where('status_laporan','=','0')->where('skala_prioritas','!=','0')->orderBy('waktu_kejadian','ASC')->get()->groupBy(function ($report) {
            return $report->skala_prioritas >= 2 ? 'Skala Prioritas 1' : 'Skala Prioritas 2';
        })->sortKeys();
        return view('actions.test', compact('reports'));
    }
}
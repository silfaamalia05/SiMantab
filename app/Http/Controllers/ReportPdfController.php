<?php
namespace App\Http\Controllers;

use App\Models\ReportImage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Report;
use Illuminate\Http\Request;


class ReportPdfController extends Controller
{
    public function generate($format, $id = null)
    {
        // Ambil data laporan dan gambar berdasarkan ID
        if ($id !== 'none') {
            $report = Report::findOrFail($id);
            $images = ReportImage::where('report_id', $id)->get();

            // Generate PDF
            // $pdf = PDF::loadView('reports.pdf-'.$format, compact('report', 'images'))->setPaper([0, 0, 595.28, 935.43]);
            $pdf = PDF::loadView('reports.pdf-'.$format, compact('report', 'images'));
        } else {
            $report = Report::get();

            // Generate PDF
            $pdf = PDF::loadView('reports.pdf-'.$format, compact('report'))->setPaper('a4', 'landscape');
        }

        return $pdf->stream('Laporan Bencana.pdf');
    }

    function generateAsCheck(Request $request){
        $data = Report::latest()->get();
        $where = [];
        foreach($data as $r){
            if(isset($request[$r['id']])){
                array_push($where,$r['id']);
            }
        }
       
        $report = Report::whereIn('id',$where)->get();
        foreach($report as $r){
            $r->update([
                'status_laporan' => '2'
            ]);
        }
       
        // Generate PDF
        $pdf = PDF::loadView('reports.pdf-'.$request->format, compact('report'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Bencana.pdf');
    }
    function generateAsPriority(Request $request){
        $report = Report::findOrFail($request->first_priority);  
        $report->update([
            'status_laporan' => '2'
        ]);
        $images = ReportImage::where('report_id', $request->first_priority)->get();      
        // Generate PDF
        $pdf = PDF::loadView('reports.pdf-'.$request->format, compact(['report','images']))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Bencana.pdf');
    }

}
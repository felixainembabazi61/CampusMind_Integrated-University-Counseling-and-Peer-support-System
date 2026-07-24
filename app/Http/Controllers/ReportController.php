<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('reports.index');
    }

public function store(Request $request)
{
    $request->validate([
        'reportable_type' => 'required',
        'reportable_id'   => 'required',
        'reason'          => 'required'
    ]);
    $model = $request->reportable_type::findOrFail($request->reportable_id);
    $model->reports()->create([
        'reporter_id' => auth()->id(),
        'reason'      => $request->reason,
    ]);
    return back()->with('success', 'Report submitted.');
}
}

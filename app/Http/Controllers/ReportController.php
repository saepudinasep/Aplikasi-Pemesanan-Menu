<?php

namespace App\Http\Controllers;

use App\Models\Header_Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'))->startOfDay();
        // $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'))->endOfDay();
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'))->format('Y-m-d H:i:s');
        $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'))->format('Y-m-d H:i:s');
        // return response()->json($fromDate);
        // return response()->json($toDate);

        // Get data from the database
        $reportData = Header_Order::selectRaw('DATE(updated_at) as updated_date, SUM(total) as total')
            ->whereBetween('updated_at', [$fromDate, $toDate])
            ->groupBy('updated_date')
            ->orderBy('updated_date')
            ->get();

        return response()->json($reportData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Detail_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $table_id = Session::get('table_id');
        $data = DB::table('header_orders as ho')
            ->select(
                'do.id as id',
                'm.name as menu',
                'do.qty',
                't.name',
                'do.status'
            )
            ->join('detail_orders as do', 'ho.id', '=', 'do.order_id')
            ->join('menus as m', 'do.menu_id', '=', 'm.id')
            ->join('tables as t', 'ho.table_id', '=', 't.id')
            ->where('do.status', '!=', 'Deliver')
            ->get();
        return view('view-order', ['data' => $data]);
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
        //
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
    public function update(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $DOrder = Detail_Order::findOrFail($id);
        if ($DOrder) {
            $DOrder->status = $status;
            $DOrder->save();
            return response()->json(['message' => 'Status berhasil diperbarui.']);
        }
        // return response()->json(['success' => true]);
        return response()->json(['error' => 'Pesanan tidak ditemukan.'], 404);
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

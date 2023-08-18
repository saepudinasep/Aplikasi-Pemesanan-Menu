<?php

namespace App\Http\Controllers;

use App\Models\Header_Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('header_orders as ho')
            ->select(DB::raw('MAX(ho.id) as max_id'), 't.name')
            ->join('detail_orders as do', 'ho.id', '=', 'do.order_id')
            ->join('menus as m', 'do.menu_id', '=', 'm.id')
            ->join('tables as t', 'ho.table_id', '=', 't.id')
            ->where('t.description', 'Booking')
            ->where('ho.total', '')
            ->groupBy('t.name')
            ->get();
        return view('payment', ['data' => $data]);
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
        $id = $request->input('id');
        $total1 = $request->input('total1');
        $uang = $request->input('uang');

        // $data = [
        //     "total" => $total1,
        //     "uang" => $uang
        // ];

        // $table_id = DB::table('header_orders')
        //     ->where('id', $id)
        //     ->value('table_id');
        $header_order = Header_Order::findOrFail($id);
        $table_id = $header_order->table_id;
        if ($table_id) {
            // return response()->json($table_id);
            // $header_order->update($data);
            Header_Order::where('id', $id)->update([
                "total" => $total1,
                "uang" => $uang
            ]);
            Table::where('id', $table_id)->update(['description' => 'Empty']);

            return response()->json(['message' => 'Transaction successful'], 200);
        }

        // return response()->json(['message' => 'Transaction successful'], 200);
        return response()->json(['error' => 'Pesanan tidak ditemukan.'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('header_orders as ho')
            ->select(
                'm.name as menu',
                'do.qty',
                'do.price',
                DB::raw('do.qty * do.price as total'),
                'do.status'
            )
            ->join('detail_orders as do', 'ho.id', '=', 'do.order_id')
            ->join('menus as m', 'do.menu_id', '=', 'm.id')
            ->join('tables as t', 'ho.table_id', '=', 't.id')
            ->where('ho.id', $id)
            ->where('t.description', 'Booking')
            ->where('do.status', 'Deliver')
            ->get();
        return view('view-payment', ['data' => $data]);
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

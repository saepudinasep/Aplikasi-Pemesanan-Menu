<?php

namespace App\Http\Controllers;

use App\Models\Detail_Order;
use App\Models\Header_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    // public function pesan(Request $request)
    // {
    //     $data_header = new Header_Order();
    //     $data_header->user_id = Auth::user()->id;
    //     $data_header->table_id = $request->input('id_table');
    //     $data_header->date = date("Y-m-d");
    //     $data_header->payment = "";
    //     $data_header->bank = "";
    //     $data_header->save();


    //     $data_detail = new Detail_Order();
    //     $data_detail->order_id = $data_header->id;
    //     $data_detail->menu_id = $request->input('id_menu');
    //     $data_detail->price = $request->input('price');
    //     $data_detail->qty = $request->input('qty');
    //     $data_detail->status = "Pending";
    //     $data_detail->save();

    //     return response()->json(['message' => 'Data berhasil disimpan'], 200);
    // }

    public function pesan(Request $request)
    {
        $data = $request->input('data');

        // Mengambil data dengan indeks 1 (data kedua)
        $selectedData = $data[0];

        $data_header = new Header_Order();
        $data_header->user_id = Auth::user()->id;
        $data_header->table_id = $selectedData['table_id'];
        $data_header->date = date("Y-m-d");
        $data_header->total = "";
        $data_header->uang = "";
        $data_header->save();

        foreach ($data as $item) {
            Detail_Order::create([
                'order_id' => $data_header->id,
                'menu_id' => $item['menu_id'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'status' => "Pending",
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function read()
    {
        $user_id = Auth::user()->id;
        // $table_id = 1;
        $table_id = Session::get('table_id');
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
            ->join('tables as me', 'ho.table_id', '=', 'me.id')
            ->where('ho.user_id', $user_id)
            ->where('ho.table_id', $table_id)
            ->where('do.status', 'Pending')
            ->get();
        // return view('read', ['data' => $data]);
        return view('read', compact('data'));
    }
}

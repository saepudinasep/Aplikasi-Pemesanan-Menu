<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TableController extends Controller
{
    public function index()
    {
        $data = Table::all();
        return view('view-table', ['data' => $data]);
    }

    public function order($id)
    {
        $data = Table::findOrFail($id);
        $menu = Menu::all();

        $table_id = $id;
        Session::put('table_id', $table_id);

        Table::whereId($data->id)->update([
            'description' => 'Booking'
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Booking Table ' . $data->name . ' Success');


        return view('order', [
            'data' => $data,
            'menu' => $menu
        ]);
    }

    public function show($id)
    {
        $data = Menu::findOrFail($id);
        return view('image')->with([
            'data' => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $menu = Menu::whereNotNull('deleted_at')
            ->orwhere('name', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('id')
            ->paginate(10);
        return view('menu', ['menu' => $menu]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newName = "";

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/image', $newName);
        }

        $request['image'] = $newName;
        // dd($request['photo']);
        // dd($request->all());

        $menu = Menu::create($request->all());

        if ($menu) {
            Session::flash('status', 'success');
            Session::flash('message', 'add new Menu success');
        }

        return redirect('/menu');
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
        $menu = Menu::findOrFail($id);
        return view('menu-edit', ['menu' => $menu]);
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
        $menu = Menu::findOrFail($id);

        $newName = $menu->image;

        if ($request->file('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('public/image', $newName);
        }

        $request['image'] = $newName;

        $menu->update($request->all());

        if ($menu) {
            Session::flash('status', 'success');
            Session::flash('message', 'Update Menu Success');
        }

        return redirect('/menu');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Delete Menu Success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete'
            ]);
        }
    }
}

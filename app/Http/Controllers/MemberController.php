<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = Member::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('handphone', 'LIKE', '%' . $keyword . '%')
            ->orderByRaw('id DESC')->paginate(10);
        return view('member', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['joinDate'] = now()->format('Y-m-d');
        // dd($request->all());
        $member = Member::create($request->all());
        if ($member) {
            Session::flash('status', 'success');
            Session::flash('message', 'Add new member success');
        }

        return redirect('/member');
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
        $member = Member::findOrFail($id);
        return view('member-edit', ['member' => $member]);
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
        $member = Member::findOrFail($id);

        $member->update($request->all());

        if ($member) {
            Session::flash('status', 'success');
            Session::flash('message', 'Update member success');
        }

        return redirect('/member');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destro($id)
    {
        $member = Member::findOrFail($id);

        if ($member->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Delete Member Success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete'
            ]);
        }
    }
}

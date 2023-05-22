<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lottery = Lottery::orderBy('created_at', 'desc')->paginate(20);
        return view('lottery_list', compact('lottery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::has('members')->orderBy('created_at', 'desc')->paginate(20);
        return view('lottery_new', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'group' => 'required'
        ]);

        Lottery::create(['title' => $request->title, 'group_id' => $request->group]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lottery $lottery)
    {
        // return view('lotte')
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

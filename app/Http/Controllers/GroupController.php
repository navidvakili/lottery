<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::orderBy('created_at', 'desc')->paginate(20);
        return view('groups_list', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups_new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Group::create(['title' => $request->title]);

        return redirect()->route('groups.index')->with('message', 'گروه ' . $request->title . ' با موفقیت ذخیره شد');
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
    public function edit(Group $group)
    {
        return view('groups_edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $group->update(['title' => $request->title]);

        return redirect()->route('groups.index')->with('message', 'گروه ' . $group->title . ' با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $members = Client::where('group_id', $group->id)->count();
        if ($members > 0)
            return redirect()->route('groups.index')->withErrors('بدلیل وجود تعدادی متقاضی در این گروه، امکان حذف وجود ندارد');

        $group->delete();

        return redirect()->route('groups.index')->with('message', 'گروه ' . $group->title . ' با موفقیت حذف شد');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lottery;
use App\Models\LotteryMember;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lottery = Lottery::orderBy('created_at', 'desc')->paginate(20);
        return view('lottery_index', compact('lottery'));
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
        return redirect()->route('lottery.index')->with('message', 'گروه قرعه کشی ' . $request->title . ' با موفقیت ذخیره شد');
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
        $groups = Group::has('members')->orderBy('created_at', 'desc')->paginate(20);
        return view('lottery_edit', compact('lottery', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lottery $lottery)
    {
        $request->validate([
            'title' => 'required',
            'group' => 'required'
        ]);

        $lottery->update(['title' => $request->title, 'group_id' => $request->group]);
        return redirect()->route('lottery.index')->with('message', 'گروه قرعه کشی ' . $request->title . ' با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lottery $lottery)
    {
        $lottery_members = LotteryMember::where('lottery_id', $lottery->id)->count();

        if ($lottery_members > 0)
            return redirect()->route('lottery.index')->withErrors('بدلیل وجود تعدادی متقاضی در این قرعه کشی، امکان حذف وجود ندارد');

        $lottery->delete();

        return redirect()->route('lottery.index')->with('message', 'قرعه کشی ' . $lottery->title . ' با موفقیت حذف شد');
    }

    public function default(Lottery $lottery)
    {
        $lottery->toggleDefault();

        return redirect()->route('lottery.index');
    }
}

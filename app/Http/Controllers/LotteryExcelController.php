<?php

namespace App\Http\Controllers;

use App\Imports\LotteryImport;
use App\Models\Group;
use App\Models\Lottery;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LotteryExcelController extends Controller
{
    public function import()
    {
        return view('import_lottery');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $group = Group::create(['title' => 'متقاضیان قرعه کشی ' . $request->title]);
        $lottery = Lottery::create(['title' => $request->title, 'group_id' => $group->id, 'default' => 0]);

        Excel::import(new LotteryImport($group->id, $lottery->id, $request->title), $request->file('file'));

        return redirect()->route('lottery.index', $request->group)->with('message', 'فایل با موفقیت بر روی سرور بارگذاری شد');
    }
}

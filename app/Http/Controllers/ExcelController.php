<?php

namespace App\Http\Controllers;

use App\Imports\ClientImport;
use App\Models\Group;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import()
    {
        $groups = Group::all();
        return view('import', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required',
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new ClientImport($request->group), $request->file('file'));

        return redirect()->route('clients.index', $request->group)->with('message', 'فایل با موفقیت بر روی سرور بارگذاری شد');
    }
}

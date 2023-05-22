<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Group $group)
    {
        $clients = Client::where('group_id', $group->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('clients', compact('clients', 'group'));
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index', $client->group->id)->with('message', 'متقاضی با موفقیت حذف شد');
    }
}

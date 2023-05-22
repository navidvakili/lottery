<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use App\Models\LotteryMember;
use Illuminate\Http\Request;

class ExecuteController extends Controller
{
    public function index()
    {
        $lottery_default = Lottery::where('default', 1)->first();
        $lottery_members = LotteryMember::where('lottery_id', $lottery_default->id)->paginate(20);
        return view('dashboard', compact('lottery_default', 'lottery_members'));
    }

    public function store(Request $request)
    {
        $lottery_default = Lottery::where('default', 1)->first();
        $request->validate([
            'min_vahed' => 'required_with:max_vahed|numeric|min:1',
            'max_vahed' => 'required_with:min_vahed|gt:min_vahed',
            'num_peoples' => 'required|numeric|min:1|digits_between: 1,' . $lottery_default->group->members->count()
        ]);

        $num = $request->max_vahed - $request->min_vahed + 1;

        $peoples = $lottery_default->group->members->shuffle();


        $check = 1;
        $lottered_num = 0;

        foreach ($peoples as $people) {
            $vahed = null;
            $check_member = LotteryMember::where('lottery_id', $lottery_default->id)
                ->where('client_id', $people->id)
                ->count();

            if ($check_member > 0) continue;

            while (1) {
                $vahed = mt_rand($request->min_vahed, $request->max_vahed);
                $check = LotteryMember::where('lottery_id', $lottery_default->id)->where('vahed', $vahed)->count();
                if ($check == 0) break;
            }
            if ($vahed !== null) {
                LotteryMember::create(['lottery_id' => $lottery_default->id, 'client_id' => $people->id, 'vahed' => $vahed]);
                $lottered_num++;
            }
            if ($num == $lottered_num) break;
        }
    }
}

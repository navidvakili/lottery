<?php

namespace App\Http\Controllers;

use App\Library\Sms;
use App\Models\Lottery;
use App\Models\LotteryMember;
use Illuminate\Http\Request;

class ExecuteController extends Controller
{
    public function index()
    {
        $lottery_default = Lottery::where('default', 1)->first();
        if ($lottery_default !== null) {
            $lottery_members = LotteryMember::where('lottery_id', $lottery_default->id)->paginate(20);
        } else {
            $lottery_members = null;
        }

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

        $peoples = $lottery_default->group->members->where('group_id', $lottery_default->group_id)->shuffle();


        $lottered_num = 0;

        $vaheds = range($request->min_vahed, $request->max_vahed);

        foreach ($peoples as $people) {
            if (sizeof($vaheds) == 0) break;
            $check_member = LotteryMember::where('lottery_id', $lottery_default->id)
                ->where('client_id', $people->id)
                ->count();

            if ($check_member > 0) continue;

            while (1) {
                $vahed = null;
                if (sizeof($vaheds) == 0) break;

                $vahed = mt_rand($request->min_vahed, $request->max_vahed);

                if (in_array($vahed, $vaheds)) {
                    $key = array_search($vahed, $vaheds);
                    if (false !== $key) {
                        unset($vaheds[$key]);
                    }
                }

                $check = LotteryMember::where('lottery_id', $lottery_default->id)->where('vahed', $vahed)->count();
                if ($check == 0) break;
            }
            if ($vahed !== null) {
                $done = LotteryMember::create(['lottery_id' => $lottery_default->id, 'client_id' => $people->id, 'vahed' => $vahed]);
                $sms = new Sms($people->mobile);
                $send = $sms->sendByPattern('ihbmplfpllrjzfi', ['name' => $people->name, 'vahed' => $vahed, 'tarh' => $done->lottery->title]);
                $lottered_num++;
            }
            if ($num == $lottered_num) break;
        }

        return redirect()->back()->with('message', 'تعداد ' . $lottered_num . ' نفر قرعه کشی شد');
    }
}

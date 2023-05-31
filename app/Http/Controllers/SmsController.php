<?php

namespace App\Http\Controllers;

use App\Library\Sms;
use App\Models\Lottery;
use App\Models\LotteryMember;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function lottery_send(Lottery $lottery)
    {
        $executes = $lottery->exceutes;
        foreach ($executes as $row) {
            if ($row->client->mobile != null) {
                $sms = new Sms($row->client->mobile);
                $sms->sendByPattern('42g8dtgu3o3ohv7', ['name' => $row->client->name, 'vahed' => $row->vahed, 'tarh' => $lottery->title]);
            }
        }

        return redirect()->route('lottery.index')->with('message', 'پیامک های قرعه کشی (' . $lottery->title . ') با موفقیت ارسال شد');
    }
}
